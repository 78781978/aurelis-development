<?php
/**
 * Kreator motywu (Customizer) — dane firmowe edytowalne bez dotykania kodu.
 * Wygląd → Personalizacja → "Dane firmy Aurelis" / "Zdjęcia zespołu".
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function aurelis_customize_register( $wp_customize ) {

	$wp_customize->add_section( 'aurelis_company', array(
		'title'    => __( 'Dane firmy Aurelis', 'aurelis-development' ),
		'priority' => 30,
	) );

	$fields = array(
		'aurelis_phone_mobile'   => array( 'label' => 'Telefon komórkowy', 'default' => '+48 512 133 322' ),
		'aurelis_phone_landline' => array( 'label' => 'Telefon stacjonarny', 'default' => '+48 12 373 99 89' ),
		'aurelis_email'          => array( 'label' => 'E-mail', 'default' => 'biuro@aurelis.com.pl' ),
		'aurelis_address_street' => array( 'label' => 'Adres — ulica i numer', 'default' => 'ul. Warszawska 53' ),
		'aurelis_address_city'   => array( 'label' => 'Adres — kod i miejscowość', 'default' => '32-091 Michałowice' ),
		'aurelis_hours'          => array( 'label' => 'Godziny pracy biura', 'default' => 'Pon–Pt: 8:00–16:00' ),
		'aurelis_nip'            => array( 'label' => 'NIP', 'default' => '675-154-51-05' ),
		'aurelis_krs'            => array( 'label' => 'KRS', 'default' => '0000618799' ),
		'aurelis_regon'          => array( 'label' => 'REGON', 'default' => '364479265' ),
		'aurelis_company_name'   => array( 'label' => 'Pełna nazwa spółki', 'default' => 'Aurelis Development Sp. z o.o.' ),
		'aurelis_map_embed_url'  => array(
			'label'   => 'Adres URL mapy (OpenStreetMap embed)',
			'default' => 'https://www.openstreetmap.org/export/embed.html?bbox=19.9527%2C50.1633%2C19.9827%2C50.1793&layer=mapnik&marker=50.1713%2C19.9677',
		),
		'aurelis_social_facebook'  => array( 'label' => 'Facebook — adres URL', 'default' => 'https://www.facebook.com/profile.php?id=61591508803163' ),
		'aurelis_stat_projects'  => array( 'label' => 'Statystyka: liczba projektów', 'default' => '120+' ),
		'aurelis_stat_years'     => array( 'label' => 'Statystyka: lat na rynku', 'default' => '10' ),
		'aurelis_stat_satisfaction' => array( 'label' => 'Hero strony głównej: % zadowolonych klientów', 'default' => '100%' ),
		'aurelis_footer_about'   => array(
			'label'   => 'Krótki opis firmy w stopce',
			'default' => 'Aurelis Development Sp. z o.o. — generalne wykonawstwo inwestycji mieszkaniowych i przemysłowych na terenie całej Małopolski.',
			'type'    => 'textarea',
		),
	);

	foreach ( $fields as $id => $args ) {
		$wp_customize->add_setting( $id, array(
			'default'           => $args['default'],
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'refresh',
		) );

		$description = ( 0 === strpos( $id, 'aurelis_stat_' ) )
			? __( 'Liczby na stronie animują się od zera — zacznij od cyfr, np. „120+" lub „98%".', 'aurelis-development' )
			: '';

		if ( isset( $args['type'] ) && 'textarea' === $args['type'] ) {
			$wp_customize->add_control( $id, array(
				'label'       => $args['label'],
				'description' => $description,
				'section'     => 'aurelis_company',
				'type'        => 'textarea',
			) );
		} else {
			$wp_customize->add_control( $id, array(
				'label'       => $args['label'],
				'description' => $description,
				'section'     => 'aurelis_company',
				'type'        => 'text',
			) );
		}
	}

	/**
	 * Zdjęcia — logo ustawia się w "Identyfikacja strony" (WP dodaje to
	 * automatycznie dzięki add_theme_support('custom-logo') w functions.php).
	 * Tu tylko zdjęcie zespołu na stronie głównej i 3 zdjęcia osób z zespołu.
	 */
	$wp_customize->add_section( 'aurelis_team_images', array(
		'title'    => __( 'Zdjęcia zespołu', 'aurelis-development' ),
		'priority' => 31,
	) );

	$image_fields = array(
		'aurelis_team_photo'          => __( 'Zdjęcie zespołu (Strona główna)', 'aurelis-development' ),
		'aurelis_team_member_1_photo' => __( 'Zdjęcie: Przemysław Pieprzyk (Prezes)', 'aurelis-development' ),
		'aurelis_team_member_2_photo' => __( 'Zdjęcie: Łukasz Pytlic (Kierownik budowy)', 'aurelis-development' ),
		'aurelis_team_member_3_photo' => __( 'Zdjęcie: Barbara Krzyworzeka (Architekt)', 'aurelis-development' ),
	);

	foreach ( $image_fields as $id => $label ) {
		$wp_customize->add_setting( $id, array(
			'default'           => '',
			'sanitize_callback' => 'esc_url_raw',
			'transport'         => 'refresh',
		) );
		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, $id, array(
			'label'   => $label,
			'section' => 'aurelis_team_images',
		) ) );
	}
}
add_action( 'customize_register', 'aurelis_customize_register' );

/**
 * Skrót do pobierania danych firmowych z Customizera.
 */
function aurelis_company( $key ) {
	$defaults = array(
		'phone_mobile'   => '+48 512 133 322',
		'phone_landline' => '+48 12 373 99 89',
		'email'          => 'biuro@aurelis.com.pl',
		'address_street' => 'ul. Warszawska 53',
		'address_city'   => '32-091 Michałowice',
		'hours'          => 'Pon–Pt: 8:00–16:00',
		'nip'            => '675-154-51-05',
		'krs'            => '0000618799',
		'regon'          => '364479265',
		'company_name'   => 'Aurelis Development Sp. z o.o.',
		'map_embed_url'  => 'https://www.openstreetmap.org/export/embed.html?bbox=19.9527%2C50.1633%2C19.9827%2C50.1793&layer=mapnik&marker=50.1713%2C19.9677',
		'social_facebook'  => 'https://www.facebook.com/profile.php?id=61591508803163',
		'stat_projects'  => '120+',
		'stat_years'     => '10',
		'stat_satisfaction' => '100%',
		'footer_about'   => 'Aurelis Development Sp. z o.o. — generalne wykonawstwo inwestycji mieszkaniowych i przemysłowych na terenie całej Małopolski.',
		'team_photo'          => '',
		'team_member_1_photo' => '',
		'team_member_2_photo' => '',
		'team_member_3_photo' => '',
	);
	$default = isset( $defaults[ $key ] ) ? $defaults[ $key ] : '';
	return get_theme_mod( 'aurelis_' . $key, $default );
}
