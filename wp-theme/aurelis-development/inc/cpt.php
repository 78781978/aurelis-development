<?php
/**
 * Własne typy treści: Realizacje (portfolio) i Opinie (referencje klientów).
 * Obie treści są w pełni edytowalne z panelu WordPress — bez dotykania kodu.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function aurelis_register_post_types() {

	register_post_type( 'realizacja', array(
		'labels' => array(
			'name'               => __( 'Realizacje', 'aurelis-development' ),
			'singular_name'      => __( 'Realizacja', 'aurelis-development' ),
			'add_new_item'       => __( 'Dodaj realizację', 'aurelis-development' ),
			'edit_item'          => __( 'Edytuj realizację', 'aurelis-development' ),
			'all_items'          => __( 'Wszystkie realizacje', 'aurelis-development' ),
			'featured_image'     => __( 'Zdjęcie realizacji', 'aurelis-development' ),
			'set_featured_image' => __( 'Ustaw zdjęcie realizacji', 'aurelis-development' ),
		),
		'public'       => true,
		'show_in_menu' => true,
		'menu_icon'    => 'dashicons-hammer',
		'menu_position' => 20,
		'supports'     => array( 'title', 'thumbnail' ),
		'has_archive'  => false,
		'rewrite'      => array( 'slug' => 'realizacja' ),
		'show_in_rest' => true,
	) );

	register_post_type( 'opinia', array(
		'labels' => array(
			'name'          => __( 'Opinie klientów', 'aurelis-development' ),
			'singular_name' => __( 'Opinia', 'aurelis-development' ),
			'add_new_item'  => __( 'Dodaj opinię', 'aurelis-development' ),
			'edit_item'     => __( 'Edytuj opinię', 'aurelis-development' ),
			'all_items'     => __( 'Wszystkie opinie', 'aurelis-development' ),
		),
		'public'        => false,
		'show_ui'       => true,
		'show_in_menu'  => true,
		'menu_icon'     => 'dashicons-star-filled',
		'menu_position' => 21,
		'supports'      => array( 'title', 'editor' ),
		'has_archive'   => false,
		'rewrite'       => false,
		'show_in_rest'  => true,
	) );
}
add_action( 'init', 'aurelis_register_post_types' );

/**
 * Podpowiedzi w edytorze, żeby było wiadomo, co wpisać gdzie:
 * - Realizacja: tytuł = podpis pod zdjęciem (np. "Dom jednorodzinny — Kraków"), zdjęcie wyróżniające = fotografia.
 * - Opinia: tytuł = autor i miejscowość (np. "Anna K., Kraków"), treść = cytat z opinii.
 */
function aurelis_cpt_title_placeholder( $title, $post ) {
	if ( 'realizacja' === $post->post_type ) {
		return __( 'Np. Dom jednorodzinny — Kraków', 'aurelis-development' );
	}
	if ( 'opinia' === $post->post_type ) {
		return __( 'Np. Anna K., Kraków', 'aurelis-development' );
	}
	return $title;
}
add_filter( 'enter_title_here', 'aurelis_cpt_title_placeholder', 10, 2 );

function aurelis_cpt_editor_hint() {
	global $post;
	if ( $post && 'opinia' === $post->post_type ) {
		echo '<div class="notice notice-info inline"><p>' . esc_html__( 'Wpisz tutaj treść opinii klienta (sam cytat, bez cudzysłowów — dodajemy je automatycznie na stronie).', 'aurelis-development' ) . '</p></div>';
	}
}
add_action( 'edit_form_after_title', 'aurelis_cpt_editor_hint' );
