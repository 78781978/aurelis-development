<?php
/**
 * Aurelis Development — funkcje motywu.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'AURELIS_VERSION', '1.0.0' );
define( 'AURELIS_DIR', get_template_directory() );
define( 'AURELIS_URI', get_template_directory_uri() );

/**
 * Podstawowa konfiguracja motywu.
 */
function aurelis_setup() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ) );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'custom-logo', array(
		'height'      => 90,
		'width'       => 300,
		'flex-height' => true,
		'flex-width'  => true,
	) );

	register_nav_menus( array(
		'primary' => __( 'Menu główne', 'aurelis-development' ),
	) );
}
add_action( 'after_setup_theme', 'aurelis_setup' );

/**
 * Logo w nagłówku wyświetla się maks. ok. 216px szerokości, ale WordPress
 * domyślnie zakłada, że obrazek może zajmować całą szerokość ekranu
 * (sizes="100vw") i pobiera przez to zbyt duży wariant z biblioteki mediów.
 * Podajemy prawdziwy, mały rozmiar, żeby przeglądarka wybrała mniejszy plik.
 */
function aurelis_custom_logo_sizes( $attr ) {
	if ( isset( $attr['class'] ) && false !== strpos( $attr['class'], 'custom-logo' ) ) {
		$attr['sizes'] = '216px';
	}
	return $attr;
}
add_filter( 'wp_get_attachment_image_attributes', 'aurelis_custom_logo_sizes' );

/**
 * Style i skrypty.
 */
function aurelis_assets() {
	wp_enqueue_style( 'aurelis-style', get_stylesheet_uri(), array(), AURELIS_VERSION );
	wp_enqueue_script( 'aurelis-script', AURELIS_URI . '/assets/script.js', array(), AURELIS_VERSION, true );
}
add_action( 'wp_enqueue_scripts', 'aurelis_assets' );

/**
 * Favicon — domyślny znak graficzny logo, ale jeśli ktoś ustawi własną
 * "Ikonę strony" w Ustawienia → Ogólne, WordPress obsłuży ją sam i tu
 * nic nie robimy, żeby nie dublować znacznika <link rel="icon">.
 */
function aurelis_favicon() {
	if ( has_site_icon() ) {
		return;
	}
	echo '<link rel="icon" type="image/svg+xml" href="' . esc_url( AURELIS_URI . '/assets/logo-mark.svg' ) . '">' . "\n";
}
add_action( 'wp_head', 'aurelis_favicon' );

/**
 * Skrót opisu aktualnej strony — z fragmentu (excerpt), z fallbackiem do
 * opisu strony w Ustawieniach. Używane przez meta description i Open Graph.
 */
function aurelis_get_meta_description() {
	$description = '';
	if ( is_singular() ) {
		$description = get_the_excerpt();
	}
	if ( ! $description ) {
		$description = get_bloginfo( 'description' );
	}
	return wp_strip_all_tags( $description );
}

/**
 * Meta description z fragmentu (excerpt) aktualnej strony — bez wtyczek SEO.
 * Uzupełnij "Fragment" w bocznym panelu edycji strony, aby ustawić własny opis.
 */
function aurelis_meta_description() {
	$description = aurelis_get_meta_description();
	if ( $description ) {
		echo '<meta name="description" content="' . esc_attr( $description ) . '">' . "\n";
	}
}
add_action( 'wp_head', 'aurelis_meta_description', 1 );

/**
 * Znaczniki Open Graph / Twitter Card — bez wtyczek SEO. WordPress dodaje
 * canonical URL sam (rdzeń), więc tu tylko OG/Twitter.
 */
function aurelis_opengraph_tags() {
	$title       = wp_get_document_title();
	$description = aurelis_get_meta_description();
	$url         = is_singular() ? get_permalink() : home_url( add_query_arg( array(), $GLOBALS['wp']->request ) );
	$image       = AURELIS_URI . '/assets/zespol.png';

	echo '<meta property="og:type" content="website">' . "\n";
	echo '<meta property="og:site_name" content="' . esc_attr( get_bloginfo( 'name' ) ) . '">' . "\n";
	echo '<meta property="og:locale" content="pl_PL">' . "\n";
	echo '<meta property="og:title" content="' . esc_attr( $title ) . '">' . "\n";
	if ( $description ) {
		echo '<meta property="og:description" content="' . esc_attr( $description ) . '">' . "\n";
	}
	echo '<meta property="og:url" content="' . esc_url( $url ) . '">' . "\n";
	echo '<meta property="og:image" content="' . esc_url( $image ) . '">' . "\n";
	echo '<meta name="twitter:card" content="summary_large_image">' . "\n";
}
add_action( 'wp_head', 'aurelis_opengraph_tags' );

/**
 * Dane strukturalne JSON-LD (schema.org GeneralContractor) — dane firmy
 * z Personalizacji, żeby zawsze były aktualne bez edycji kodu.
 */
function aurelis_structured_data() {
	$data = array(
		'@context'   => 'https://schema.org',
		'@type'      => 'GeneralContractor',
		'name'       => aurelis_company( 'company_name' ),
		'image'      => AURELIS_URI . '/assets/zespol.png',
		'url'        => home_url( '/' ),
		'telephone'  => aurelis_company( 'phone_mobile' ),
		'email'      => aurelis_company( 'email' ),
		'address'    => array(
			'@type'           => 'PostalAddress',
			'streetAddress'   => aurelis_company( 'address_street' ),
			'addressLocality' => 'Michałowice',
			'postalCode'      => '32-091',
			'addressCountry'  => 'PL',
		),
		'areaServed' => 'Małopolska',
		'priceRange' => '$$',
	);
	if ( aurelis_company( 'social_facebook' ) ) {
		$data['sameAs'] = array( aurelis_company( 'social_facebook' ) );
	}
	echo '<script type="application/ld+json">' . wp_json_encode( $data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ) . '</script>' . "\n";
}
add_action( 'wp_head', 'aurelis_structured_data' );

/**
 * Wyklucza Regulamin i Politykę prywatności z indeksowania (jak w wersji statycznej) —
 * to treści prawne, nie mają wartości jako wyniki wyszukiwania.
 */
function aurelis_noindex_legal_pages() {
	if ( is_page( 'regulamin' ) || is_page( 'polityka-prywatnosci' ) ) {
		echo '<meta name="robots" content="noindex, follow">' . "\n";
	}
}
add_action( 'wp_head', 'aurelis_noindex_legal_pages', 1 );

/**
 * Fallback menu, gdyby nikt jeszcze nie utworzył menu w Wygląd → Menu.
 */
function aurelis_fallback_menu( $ul_attrs = '' ) {
	$pages = array(
		'/'                     => 'Strona główna',
		'o-nas'                 => 'O nas',
		'uslugi'                => 'Usługi',
		'realizacje'            => 'Realizacje',
		'praca'                 => 'Praca',
		'kontakt'               => 'Kontakt',
	);
	echo '<ul' . ( $ul_attrs ? ' ' . $ul_attrs : '' ) . '>';
	foreach ( $pages as $slug => $label ) {
		$url = ( '/' === $slug ) ? home_url( '/' ) : home_url( '/' . $slug . '/' );
		echo '<li><a href="' . esc_url( $url ) . '">' . esc_html( $label ) . '</a></li>';
	}
	echo '</ul>';
}

/**
 * Zamienia numer telefonu (wpisany w Personalizacji w dowolnym formacie,
 * np. "+48 512 133 322") na bezpieczny link "tel:" — same cyfry i "+".
 */
function aurelis_tel_href( $phone ) {
	return 'tel:' . preg_replace( '/[^0-9+]/', '', $phone );
}

/**
 * Adres URL strony po jej "slugu" (np. 'kontakt'), z bezpiecznym fallbackiem
 * do /{slug}/, gdyby strona o danym slugu nie została jeszcze utworzona.
 */
function aurelis_page_url( $slug ) {
	$page = get_page_by_path( $slug );
	if ( $page ) {
		return get_permalink( $page );
	}
	return home_url( '/' . $slug . '/' );
}

/**
 * Włącza include'y motywu.
 */
require AURELIS_DIR . '/inc/customizer.php';
require AURELIS_DIR . '/inc/cpt.php';
require AURELIS_DIR . '/inc/meta-boxes.php';
require AURELIS_DIR . '/inc/contact-form.php';
