<?php
/**
 * Proste pola dodatkowe (bez wtyczek) dla stron:
 * - każda strona: "Podtytuł (hero)" — tekst pod tytułem w ciemnej belce na górze strony.
 * - strona ustawiona jako "Strona główna" (Ustawienia → Czytanie): dodatkowe pola hero.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function aurelis_is_front_page_post( $post_id ) {
	$front_id = (int) get_option( 'page_on_front' );
	return $front_id && $front_id === (int) $post_id;
}

function aurelis_add_meta_boxes() {
	add_meta_box(
		'aurelis_hero_subtitle',
		__( 'Podtytuł strony (hero)', 'aurelis-development' ),
		'aurelis_render_hero_subtitle_box',
		'page',
		'normal',
		'high'
	);

	global $post;
	if ( $post && aurelis_is_front_page_post( $post->ID ) ) {
		add_meta_box(
			'aurelis_home_hero',
			__( 'Hero strony głównej', 'aurelis-development' ),
			'aurelis_render_home_hero_box',
			'page',
			'normal',
			'high'
		);
	}
	if ( $post && 'praca' === $post->post_name ) {
		add_meta_box(
			'aurelis_job_details',
			__( 'Oferta pracy — stawka i lokalizacja', 'aurelis-development' ),
			'aurelis_render_job_details_box',
			'page',
			'normal',
			'high'
		);
	}
}
add_action( 'add_meta_boxes', 'aurelis_add_meta_boxes' );

function aurelis_render_hero_subtitle_box( $post ) {
	wp_nonce_field( 'aurelis_save_meta', 'aurelis_meta_nonce' );
	$value = get_post_meta( $post->ID, '_aurelis_hero_subtitle', true );
	echo '<p>' . esc_html__( 'Krótki tekst wyświetlany pod tytułem strony w ciemnym pasku na górze. Zostaw puste, aby użyć domyślnego tekstu.', 'aurelis-development' ) . '</p>';
	echo '<textarea style="width:100%;" rows="3" name="aurelis_hero_subtitle">' . esc_textarea( $value ) . '</textarea>';
}

function aurelis_render_home_hero_box( $post ) {
	$eyebrow  = get_post_meta( $post->ID, '_aurelis_home_eyebrow', true );
	$heading1 = get_post_meta( $post->ID, '_aurelis_home_heading_1', true );
	$heading2 = get_post_meta( $post->ID, '_aurelis_home_heading_2', true );
	$lead     = get_post_meta( $post->ID, '_aurelis_home_lead', true );
	?>
	<p><label><strong><?php esc_html_e( 'Nadtytuł (eyebrow)', 'aurelis-development' ); ?></strong><br>
	<input type="text" style="width:100%;" name="aurelis_home_eyebrow" value="<?php echo esc_attr( $eyebrow ); ?>" placeholder="Aurelis Development · Małopolska"></label></p>
	<p><label><strong><?php esc_html_e( 'Nagłówek — linia 1', 'aurelis-development' ); ?></strong><br>
	<input type="text" style="width:100%;" name="aurelis_home_heading_1" value="<?php echo esc_attr( $heading1 ); ?>" placeholder="Budujemy solidnie."></label></p>
	<p><label><strong><?php esc_html_e( 'Nagłówek — linia 2', 'aurelis-development' ); ?></strong><br>
	<input type="text" style="width:100%;" name="aurelis_home_heading_2" value="<?php echo esc_attr( $heading2 ); ?>" placeholder="Dotrzymujemy słowa."></label></p>
	<p><label><strong><?php esc_html_e( 'Tekst wprowadzający (lead)', 'aurelis-development' ); ?></strong><br>
	<textarea style="width:100%;" rows="3" name="aurelis_home_lead" placeholder="Generalne wykonawstwo inwestycji mieszkaniowych i przemysłowych..."><?php echo esc_textarea( $lead ); ?></textarea></label></p>
	<?php
}

function aurelis_render_job_details_box( $post ) {
	$rate     = get_post_meta( $post->ID, '_aurelis_job_rate', true );
	$location = get_post_meta( $post->ID, '_aurelis_job_location', true );
	?>
	<p><label><strong><?php esc_html_e( 'Stawka (badge)', 'aurelis-development' ); ?></strong><br>
	<input type="text" style="width:100%;" name="aurelis_job_rate" value="<?php echo esc_attr( $rate ); ?>" placeholder="35–45 zł/h NETTO"></label></p>
	<p><label><strong><?php esc_html_e( 'Lokalizacja', 'aurelis-development' ); ?></strong><br>
	<input type="text" style="width:100%;" name="aurelis_job_location" value="<?php echo esc_attr( $location ); ?>" placeholder="Kraków i okolice"></label></p>
	<?php
}

function aurelis_save_meta_boxes( $post_id ) {
	if ( ! isset( $_POST['aurelis_meta_nonce'] ) || ! wp_verify_nonce( $_POST['aurelis_meta_nonce'], 'aurelis_save_meta' ) ) {
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( ! current_user_can( 'edit_page', $post_id ) ) {
		return;
	}

	if ( isset( $_POST['aurelis_hero_subtitle'] ) ) {
		update_post_meta( $post_id, '_aurelis_hero_subtitle', sanitize_textarea_field( wp_unslash( $_POST['aurelis_hero_subtitle'] ) ) );
	}

	$home_fields = array(
		'aurelis_home_eyebrow'   => '_aurelis_home_eyebrow',
		'aurelis_home_heading_1' => '_aurelis_home_heading_1',
		'aurelis_home_heading_2' => '_aurelis_home_heading_2',
	);
	foreach ( $home_fields as $field => $meta_key ) {
		if ( isset( $_POST[ $field ] ) ) {
			update_post_meta( $post_id, $meta_key, sanitize_text_field( wp_unslash( $_POST[ $field ] ) ) );
		}
	}
	if ( isset( $_POST['aurelis_home_lead'] ) ) {
		update_post_meta( $post_id, '_aurelis_home_lead', sanitize_textarea_field( wp_unslash( $_POST['aurelis_home_lead'] ) ) );
	}

	if ( isset( $_POST['aurelis_job_rate'] ) ) {
		update_post_meta( $post_id, '_aurelis_job_rate', sanitize_text_field( wp_unslash( $_POST['aurelis_job_rate'] ) ) );
	}
	if ( isset( $_POST['aurelis_job_location'] ) ) {
		update_post_meta( $post_id, '_aurelis_job_location', sanitize_text_field( wp_unslash( $_POST['aurelis_job_location'] ) ) );
	}
}
add_action( 'save_post_page', 'aurelis_save_meta_boxes' );

/**
 * Pobiera podtytuł (hero) danej strony z sensownym tekstem domyślnym.
 */
function aurelis_hero_subtitle( $post_id, $default = '' ) {
	$value = get_post_meta( $post_id, '_aurelis_hero_subtitle', true );
	return $value ? $value : $default;
}

/**
 * Pobiera pole oferty pracy (stawka / lokalizacja) z sensownym tekstem domyślnym.
 */
function aurelis_job_field( $post_id, $meta_key, $default = '' ) {
	$value = get_post_meta( $post_id, $meta_key, true );
	return $value ? $value : $default;
}
