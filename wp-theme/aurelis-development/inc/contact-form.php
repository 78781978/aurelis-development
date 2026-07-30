<?php
/**
 * Formularz kontaktowy — działa od razu po instalacji, bez żadnej wtyczki.
 * Wysyła e-mail przez wp_mail() na adres z Personalizacji (Dane firmy Aurelis → E-mail).
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function aurelis_handle_contact_form() {
	if ( ! isset( $_POST['aurelis_contact_nonce'] ) || ! wp_verify_nonce( $_POST['aurelis_contact_nonce'], 'aurelis_contact_form' ) ) {
		wp_safe_redirect( add_query_arg( 'wyslano', 'blad', wp_get_referer() ? wp_get_referer() : home_url( '/' ) ) );
		exit;
	}

	// Honeypot — jeśli wypełnione, to bot; udajemy sukces i kończymy.
	if ( ! empty( $_POST['aurelis_website'] ) ) {
		wp_safe_redirect( add_query_arg( 'wyslano', '1', wp_get_referer() ? wp_get_referer() : home_url( '/' ) ) );
		exit;
	}

	$name    = isset( $_POST['name'] ) ? sanitize_text_field( wp_unslash( $_POST['name'] ) ) : '';
	$phone   = isset( $_POST['phone'] ) ? sanitize_text_field( wp_unslash( $_POST['phone'] ) ) : '';
	$email   = isset( $_POST['email'] ) ? sanitize_email( wp_unslash( $_POST['email'] ) ) : '';
	$service = isset( $_POST['service'] ) ? sanitize_text_field( wp_unslash( $_POST['service'] ) ) : '';
	$message = isset( $_POST['message'] ) ? sanitize_textarea_field( wp_unslash( $_POST['message'] ) ) : '';

	$redirect_base = wp_get_referer() ? wp_get_referer() : home_url( '/kontakt/' );

	if ( empty( $name ) || empty( $message ) || empty( $email ) || ! is_email( $email ) ) {
		wp_safe_redirect( add_query_arg( 'wyslano', 'blad', $redirect_base ) );
		exit;
	}

	// Załącznik (opcjonalny) — walidacja rozmiaru i typu pliku przed wysyłką.
	$attachments         = array();
	$tmp_attachment_path = '';
	$attachment_name     = '';

	if ( ! empty( $_FILES['attachment'] ) && UPLOAD_ERR_NO_FILE !== $_FILES['attachment']['error'] ) {
		$file = $_FILES['attachment'];

		if ( UPLOAD_ERR_OK !== $file['error'] ) {
			wp_safe_redirect( add_query_arg( 'wyslano', 'blad', $redirect_base ) );
			exit;
		}

		$max_size = 5 * 1024 * 1024; // 5 MB
		if ( $file['size'] > $max_size ) {
			wp_safe_redirect( add_query_arg( 'wyslano', 'zbyt_duzy', $redirect_base ) );
			exit;
		}

		$allowed_ext = array( 'pdf', 'jpg', 'jpeg', 'png', 'doc', 'docx' );
		$filetype    = wp_check_filetype( $file['name'] );
		if ( empty( $filetype['ext'] ) || ! in_array( strtolower( $filetype['ext'] ), $allowed_ext, true ) ) {
			wp_safe_redirect( add_query_arg( 'wyslano', 'zly_plik', $redirect_base ) );
			exit;
		}

		$attachment_name      = sanitize_file_name( $file['name'] );
		$tmp_attachment_path  = trailingslashit( get_temp_dir() ) . 'aurelis-' . wp_generate_password( 12, false ) . '-' . $attachment_name;
		if ( move_uploaded_file( $file['tmp_name'], $tmp_attachment_path ) ) {
			$attachments[] = $tmp_attachment_path;
		} else {
			$tmp_attachment_path = '';
		}
	}

	$to      = aurelis_company( 'email' );
	$subject = sprintf( __( 'Nowe zapytanie ze strony — %s', 'aurelis-development' ), $name );
	$body    = "Imię i nazwisko: {$name}\n";
	$body   .= "Telefon: {$phone}\n";
	$body   .= "E-mail: {$email}\n";
	$body   .= "Rodzaj usługi: {$service}\n\n";
	$body   .= "Wiadomość:\n{$message}\n";
	if ( ! empty( $attachments ) ) {
		$body .= "\n(Do wiadomości dołączono załącznik: " . $attachment_name . ")\n";
	}

	$headers   = array( 'Content-Type: text/plain; charset=UTF-8' );
	$headers[] = 'Reply-To: ' . $name . ' <' . $email . '>';

	$sent = wp_mail( $to, $subject, $body, $headers, $attachments );

	if ( $tmp_attachment_path && file_exists( $tmp_attachment_path ) ) {
		unlink( $tmp_attachment_path );
	}

	wp_safe_redirect( add_query_arg( 'wyslano', $sent ? '1' : 'blad', $redirect_base ) );
	exit;
}
add_action( 'admin_post_nopriv_aurelis_contact_form', 'aurelis_handle_contact_form' );
add_action( 'admin_post_aurelis_contact_form', 'aurelis_handle_contact_form' );

/**
 * Formularz rekrutacyjny (praca.html) korzysta z prostego linku mailto — nie wymaga backendu.
 */
