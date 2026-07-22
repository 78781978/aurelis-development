<?php
/**
 * Szablon: O nas.
 * Działa automatycznie dla strony o adresie (slug) "o-nas".
 * Treść w edytorze (dwa akapity historii firmy) wyświetla się w sekcji "Nasza historia".
 */
get_header();

while ( have_posts() ) :
	the_post();
	$subtitle = aurelis_hero_subtitle( get_the_ID(), 'Aurelis Development Sp. z o.o. to zespół inżynierów, kierowników budów i wykonawców, którzy od 12 lat budują i remontują na terenie całej Małopolski.' );
	?>

<section class="page-hero">
  <div class="container">
    <div class="breadcrumb"><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Strona główna</a> / O nas</div>
    <h1><?php the_title(); ?></h1>
    <p style="max-width: 820px;"><?php echo esc_html( $subtitle ); ?></p>
  </div>
</section>

<section class="section">
  <div class="container">
    <div class="split">
      <div class="reveal">
        <?php if ( has_post_thumbnail() ) : ?>
          <?php the_post_thumbnail( 'large' ); ?>
        <?php else : ?>
          <img src="<?php echo esc_url( AURELIS_URI . '/assets/budowa.png' ); ?>" alt="Plac budowy Aurelis Development">
        <?php endif; ?>
      </div>
      <div class="reveal reveal-delay-1">
        <span class="eyebrow">Nasza historia</span>
        <h2>Budujemy zaufanie tak samo jak budynki</h2>
        <?php if ( get_the_content() ) : ?>
          <?php the_content(); ?>
        <?php else : ?>
          <p>Firma Aurelis Development powstała z pasji do budownictwa i chęci robienia rzeczy solidnie. Zaczynaliśmy jako mały zespół realizujący remonty mieszkań w Krakowie — dziś zajmujemy się kompleksowymi realizacjami domów jednorodzinnych, osiedli, hal przemysłowych i dużych remontów na terenie całej Małopolski.</p>
          <p>Każdy projekt traktujemy indywidualnie — niezależnie od tego, czy to niewielki remont łazienki, czy budowa osiedla od podstaw. Stawiamy na przejrzystą komunikację, dotrzymywanie terminów i uczciwe rozliczenia.</p>
        <?php endif; ?>
        <a href="<?php echo esc_url( aurelis_page_url( 'kontakt' ) ); ?>" class="btn btn--dark">Porozmawiajmy o Twoim projekcie</a>
      </div>
    </div>
  </div>
</section>

<section class="section section--cream">
  <div class="container">
    <div class="section-head reveal">
      <span class="eyebrow">Nasze wartości</span>
      <h2>To, na czym się opieramy</h2>
    </div>
    <div class="grid grid--3">
      <div class="card reveal">
        <div class="icon">✓</div>
        <h3>Jakość</h3>
        <p>Sprawdzone materiały, wykwalifikowani wykonawcy i dbałość o każdy detal realizacji.</p>
      </div>
      <div class="card reveal reveal-delay-1">
        <div class="icon">✓</div>
        <h3>Terminowość</h3>
        <p>Realny harmonogram prac, którego się trzymamy — na bieżąco informujemy o postępach.</p>
      </div>
      <div class="card reveal reveal-delay-2">
        <div class="icon">✓</div>
        <h3>Uczciwość</h3>
        <p>Przejrzysta wycena bez ukrytych kosztów i jasne zasady współpracy od pierwszego spotkania.</p>
      </div>
    </div>
  </div>
</section>

<section class="stat-strip">
  <div class="container">
    <div class="grid grid--4">
      <div><strong data-count="<?php echo esc_attr( aurelis_company( 'stat_projects' ) ); ?>"><?php echo esc_html( aurelis_company( 'stat_projects' ) ); ?></strong><span>Projektów</span></div>
      <div><strong data-count="<?php echo esc_attr( aurelis_company( 'stat_years' ) ); ?>"><?php echo esc_html( aurelis_company( 'stat_years' ) ); ?></strong><span>Lat na rynku</span></div>
      <div><strong data-count="<?php echo esc_attr( aurelis_company( 'stat_team' ) ); ?>"><?php echo esc_html( aurelis_company( 'stat_team' ) ); ?></strong><span>Osób w zespole</span></div>
      <div><strong data-count="<?php echo esc_attr( aurelis_company( 'stat_recommend' ) ); ?>"><?php echo esc_html( aurelis_company( 'stat_recommend' ) ); ?></strong><span>Poleceń klientów</span></div>
    </div>
  </div>
</section>

<section class="section">
  <div class="container">
    <div class="section-head reveal">
      <span class="eyebrow">Zespół</span>
      <h2>Ludzie, którzy budują Aurelis Development</h2>
      <p>Zdjęcia i sylwetki członków zespołu — miejsce do uzupełnienia.</p>
    </div>
    <div class="grid grid--3">
      <div class="card reveal" style="text-align:center;">
        <img src="<?php echo esc_url( AURELIS_URI . '/assets/about-bg.svg' ); ?>" alt="Placeholder zdjęcia" style="border-radius:50%; width:120px; height:120px; object-fit:cover; margin:0 auto 18px;">
        <h3>Imię Nazwisko</h3>
        <p>Prezes / Właściciel</p>
      </div>
      <div class="card reveal reveal-delay-1" style="text-align:center;">
        <img src="<?php echo esc_url( AURELIS_URI . '/assets/about-bg.svg' ); ?>" alt="Placeholder zdjęcia" style="border-radius:50%; width:120px; height:120px; object-fit:cover; margin:0 auto 18px;">
        <h3>Imię Nazwisko</h3>
        <p>Kierownik budowy</p>
      </div>
      <div class="card reveal reveal-delay-2" style="text-align:center;">
        <img src="<?php echo esc_url( AURELIS_URI . '/assets/about-bg.svg' ); ?>" alt="Placeholder zdjęcia" style="border-radius:50%; width:120px; height:120px; object-fit:cover; margin:0 auto 18px;">
        <h3>Imię Nazwisko</h3>
        <p>Architekt / Projektant</p>
      </div>
    </div>
  </div>
</section>

<section class="cta-banner">
  <div class="container reveal">
    <span class="eyebrow">Zainteresowana/y współpracą?</span>
    <h2>Skontaktuj się z naszym zespołem</h2>
    <a href="<?php echo esc_url( aurelis_page_url( 'kontakt' ) ); ?>" class="btn btn--accent">Przejdź do kontaktu</a>
  </div>
</section>

<?php
endwhile;

get_footer();
