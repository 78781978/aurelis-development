<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="preload" href="<?php echo esc_url( AURELIS_URI . '/assets/fonts/montserrat-500-700-latin-ext.woff2' ); ?>" as="font" type="font/woff2" crossorigin>
<link rel="preload" href="<?php echo esc_url( AURELIS_URI . '/assets/fonts/poppins-400-latin-ext.woff2' ); ?>" as="font" type="font/woff2" crossorigin>
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="skip-link" href="#main-content">Przejdź do treści</a>

<button type="button" class="a11y-toggle" id="a11yToggle" aria-haspopup="dialog" aria-expanded="false" aria-controls="a11yPanel" aria-label="Ustawienia dostępności (WCAG)">
  <svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false">
    <circle cx="12" cy="12" r="10"></circle>
    <circle cx="12" cy="7" r="1.5" fill="currentColor" stroke="none"></circle>
    <path d="M6.5 10c1.9.9 3.7 1.3 5.5 1.3s3.6-.4 5.5-1.3M12 11.3v4.2M9.5 19l2.5-4 2.5 4"></path>
  </svg>
</button>

<dialog class="a11y-panel" id="a11yPanel" aria-labelledby="a11yPanelTitle">
  <div class="a11y-panel-inner">
    <div class="a11y-panel-head">
      <h2 id="a11yPanelTitle">Ustawienia dostępności</h2>
      <button type="button" class="a11y-panel-close" id="a11yCloseBtn" aria-label="Zamknij ustawienia dostępności">&times;</button>
    </div>
    <p>Strona jest dostosowana do wytycznych WCAG 2.2. Możesz dodatkowo zmienić poniższe ustawienia wyświetlania.</p>

    <div class="a11y-row">
      <span>Rozmiar tekstu</span>
      <div class="a11y-btn-group">
        <button type="button" id="a11yFontDec" aria-label="Zmniejsz rozmiar tekstu">A-</button>
        <button type="button" id="a11yFontReset" aria-label="Domyślny rozmiar tekstu">A</button>
        <button type="button" id="a11yFontInc" aria-label="Zwiększ rozmiar tekstu">A+</button>
      </div>
    </div>

    <div class="a11y-row a11y-row--toggle">
      <label for="a11yContrast">Wysoki kontrast</label>
      <input type="checkbox" id="a11yContrast">
    </div>

    <div class="a11y-row a11y-row--toggle">
      <label for="a11yUnderline">Podkreślone linki</label>
      <input type="checkbox" id="a11yUnderline">
    </div>

    <div class="a11y-row a11y-row--toggle">
      <label for="a11yNoMotion">Wyłącz animacje</label>
      <input type="checkbox" id="a11yNoMotion">
    </div>

    <button type="button" class="btn btn--outline btn--sm" id="a11yResetBtn">Przywróć ustawienia domyślne</button>
  </div>
</dialog>

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
      <div class="header-phone">Zadzwoń: <a href="<?php echo esc_url( aurelis_tel_href( aurelis_company( 'phone_mobile' ) ) ); ?>"><?php echo esc_html( aurelis_company( 'phone_mobile' ) ); ?></a></div>
      <a href="<?php echo esc_url( aurelis_page_url( 'kontakt' ) ); ?>" class="btn btn--dark">Bezpłatna wycena</a>
      <button class="nav-toggle" aria-label="Otwórz menu" aria-controls="mainNav" aria-expanded="false"><span></span><span></span><span></span></button>
    </div>
  </div>
</header>

<main id="main-content">
