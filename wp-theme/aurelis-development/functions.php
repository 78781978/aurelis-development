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
 * Meta description z fragmentu (excerpt) aktualnej strony — bez wtyczek SEO.
 * Uzupełnij "Fragment" w bocznym panelu edycji strony, aby ustawić własny opis.
 */
function aurelis_meta_description() {
	$description = '';
	if ( is_singular() ) {
		$description = get_the_excerpt();
	}
	if ( ! $description ) {
		$description = get_bloginfo( 'description' );
	}
	if ( $description ) {
		echo '<meta name="description" content="' . esc_attr( wp_strip_all_tags( $description ) ) . '">' . "\n";
	}
}
add_action( 'wp_head', 'aurelis_meta_description', 1 );

/**
 * Wyklucza Regulamin i Politykę prywatności z indeksowania (jak w wersji statycznej) —
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
