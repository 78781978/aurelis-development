<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="preconnect" href="https://fonts.googleapis.com">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="site-header">
  <div class="container">
    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo">
      <?php if ( has_custom_logo() ) : ?>
        <?php the_custom_logo(); ?>
      <?php else : ?>
        <img src="<?php echo esc_url( AURELIS_URI . '/assets/logo.svg' ); ?>" alt="<?php bloginfo( 'name' ); ?>">
      <?php endif; ?>
    </a>
    <nav class="main-nav" id="mainNav">
      <?php
      if ( has_nav_menu( 'primary' ) ) {
        wp_nav_menu( array(
          'theme_location' => 'primary',
          'container'      => false,
          'items_wrap'     => '<ul>%3$s</ul>',
        ) );
      } else {
        aurelis_fallback_menu();
      }
      ?>
    </nav>
    <div class="header-cta">
      <div class="header-phone">Zadzwoń: <span><?php echo esc_html( aurelis_company( 'phone_mobile' ) ); ?></span></div>
      <a href="<?php echo esc_url( aurelis_page_url( 'kontakt' ) ); ?>" class="btn btn--dark">Bezpłatna wycena</a>
      <button class="nav-toggle" aria-label="Otwórz menu" aria-expanded="false"><span></span><span></span><span></span></button>
    </div>
  </div>
</header>
