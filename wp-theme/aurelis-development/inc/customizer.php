<?php
/**
 * Kreator motywu (Customizer) — dane firmowe edytowalne bez dotykania kodu.
 * Wygląd → Personalizacja → "Dane firmy Aurelis".
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
		'aurelis_company_name'   => array( 'label' => 'Pełna nazwa spółki', 'default' => 'Aurelis Development Sp. z o.o.' ),
		'aurelis_map_embed_url'  => array(
			'label'   => 'Adres URL mapy (OpenStreetMap embed)',
			'default' => 'https://www.openstreetmap.org/export/embed.html?bbox=19.7492%2C50.0989%2C19.7792%2C50.1149&layer=mapnik&marker=50.1069%2C19.7642',
		),
		'aurelis_social_facebook'  => array( 'label' => 'Facebook — adres URL', 'default' => '' ),
		'aurelis_social_instagram' => array( 'label' => 'Instagram — adres URL', 'default' => '' ),
		'aurelis_social_linkedin'  => array( 'label' => 'LinkedIn — adres URL', 'default' => '' ),
		'aurelis_stat_projects'  => array( 'label' => 'Statystyka: liczba projektów', 'default' => '120+' ),
		'aurelis_stat_years'     => array( 'label' => 'Statystyka: lat na rynku', 'default' => '12' ),
		'aurelis_stat_team'      => array( 'label' => 'Statystyka: osób w zespole', 'default' => '35' ),
		'aurelis_stat_recommend' => array( 'label' => 'Statystyka: % poleceń', 'default' => '98%' ),
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
		'company_name'   => 'Aurelis Development Sp. z o.o.',
		'map_embed_url'  => 'https://www.openstreetmap.org/export/embed.html?bbox=19.7492%2C50.0989%2C19.7792%2C50.1149&layer=mapnik&marker=50.1069%2C19.7642',
		'social_facebook'  => '',
		'social_instagram' => '',
		'social_linkedin'  => '',
		'stat_projects'  => '120+',
		'stat_years'     => '12',
		'stat_team'      => '35',
		'stat_recommend' => '98%',
		'stat_satisfaction' => '100%',
		'footer_about'   => 'Aurelis Development Sp. z o.o. — generalne wykonawstwo inwestycji mieszkaniowych i przemysłowych na terenie całej Małopolski.',
	);
	$default = isset( $defaults[ $key ] ) ? $defaults[ $key ] : '';
	return get_theme_mod( 'aurelis_' . $key, $default );
}
