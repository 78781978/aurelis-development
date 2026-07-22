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

	$to      = aurelis_company( 'email' );
	$subject = sprintf( __( 'Nowe zapytanie ze strony — %s', 'aurelis-development' ), $name );
	$body    = "Imię i nazwisko: {$name}\n";
	$body   .= "Telefon: {$phone}\n";
	$body   .= "E-mail: {$email}\n";
	$body   .= "Rodzaj usługi: {$service}\n\n";
	$body   .= "Wiadomość:\n{$message}\n";

	$headers   = array( 'Content-Type: text/plain; charset=UTF-8' );
	$headers[] = 'Reply-To: ' . $name . ' <' . $email . '>';

	$sent = wp_mail( $to, $subject, $body, $headers );

	wp_safe_redirect( add_query_arg( 'wyslano', $sent ? '1' : 'blad', $redirect_base ) );
	exit;
}
add_action( 'admin_post_nopriv_aurelis_contact_form', 'aurelis_handle_contact_form' );
add_action( 'admin_post_aurelis_contact_form', 'aurelis_handle_contact_form' );

/**
 * Formularz rekrutacyjny (praca.html) korzysta z prostego linku mailto — nie wymaga backendu.
 */
