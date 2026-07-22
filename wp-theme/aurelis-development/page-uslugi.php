<?php
/**
 * Szablon: Usługi.
 * Działa automatycznie dla strony o adresie (slug) "uslugi".
 */
get_header();

while ( have_posts() ) :
	the_post();
	$subtitle = aurelis_hero_subtitle( get_the_ID(), 'Kompleksowa obsługa inwestycji budowlanych na terenie Małopolski — od projektu, przez realizację, po odbiór końcowy.' );

	$services = array(
		array( 'Budowa osiedli domów jednorodzinnych', 'Realizujemy budowę osiedli domów jednorodzinnych w stanie surowym otwartym, zamkniętym oraz pod klucz. Pełna koordynacja wszystkich etapów: fundamenty, konstrukcja, dach, instalacje, wykończenie.' ),
		array( 'Budowa budynków wielorodzinnych', 'Generalne wykonawstwo budynków wielorodzinnych — od stanu zerowego, przez konstrukcję i instalacje, po odbiór końcowy z inwestorem.' ),
		array( 'Budowa hal przemysłowych i magazynowych', 'Realizacja hal przemysłowych i magazynowych w konstrukcji stalowej lub żelbetowej, dopasowanej do potrzeb technologicznych inwestycji.' ),
		array( 'Stan surowy otwarty i zamknięty', 'Wykonawstwo stanu surowego otwartego i zamkniętego — fundamenty, ściany konstrukcyjne, stropy i dach, zgodnie z projektem i sztuką budowlaną.' ),
		array( 'Kompleksowe roboty żelbetowe', 'Deskowanie, zbrojenie i betonowanie konstrukcji żelbetowych — fundamenty, ściany, słupy, stropy i schody.' ),
		array( 'Roboty murarskie', 'Murowanie ścian konstrukcyjnych i działowych w technologiach dostosowanych do projektu i wymagań termicznych budynku.' ),
		array( 'Ocieplenia elewacji i systemy ETICS', 'Docieplenia budynków w systemach ETICS, wykonywanie elewacji i poprawa efektywności energetycznej obiektu.' ),
		array( 'Dachy i konstrukcje dachowe', 'Budowa więźb dachowych, układanie pokryć dachowych, obróbki blacharskie oraz renowacje i naprawy istniejących dachów.' ),
		array( 'Prace wykończeniowe', 'Kompleksowe wykończenia wnętrz: podłogi, glazura, malowanie, zabudowy g-k, instalacje elektryczne i hydrauliczne — realizacja pod klucz z jednym punktem kontaktu.' ),
		array( 'Zagospodarowanie terenu i infrastruktura', 'Utwardzenia, nawierzchnie, ogrodzenia oraz infrastruktura towarzysząca inwestycji — zagospodarowanie terenu wokół budynku.' ),
	);
	?>

<section class="page-hero">
  <div class="container">
    <div class="breadcrumb"><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Strona główna</a> / Usługi</div>
    <h1><?php the_title(); ?></h1>
    <p><?php echo esc_html( $subtitle ); ?></p>
  </div>
</section>

<section class="section">
  <div class="container">
    <?php foreach ( $services as $i => $service ) : ?>
    <div class="service-row reveal">
      <div class="service-num"><?php echo esc_html( sprintf( '%02d', $i + 1 ) ); ?></div>
      <div>
        <h3><?php echo esc_html( $service[0] ); ?></h3>
        <p><?php echo esc_html( $service[1] ); ?></p>
      </div>
    </div>
    <?php endforeach; ?>

    <?php if ( get_the_content() ) : ?>
      <div class="reveal" style="padding-top:32px;"><?php the_content(); ?></div>
    <?php endif; ?>
  </div>
</section>

<section class="section section--cream">
  <div class="container">
    <div class="section-head reveal">
      <span class="eyebrow">Jak pracujemy</span>
      <h2>Prosty proces, jasne zasady</h2>
    </div>
    <div class="grid grid--4">
      <div class="card reveal">
        <div class="icon">1</div>
        <h3>Konsultacja</h3>
        <p>Bezpłatne spotkanie i omówienie zakresu prac oraz oczekiwań.</p>
      </div>
      <div class="card reveal reveal-delay-1">
        <div class="icon">2</div>
        <h3>Wycena</h3>
        <p>Przygotowujemy szczegółowy, przejrzysty kosztorys.</p>
      </div>
      <div class="card reveal reveal-delay-2">
        <div class="icon">3</div>
        <h3>Realizacja</h3>
        <p>Prace prowadzone zgodnie z harmonogramem, z bieżącym raportowaniem.</p>
      </div>
      <div class="card reveal reveal-delay-3">
        <div class="icon">4</div>
        <h3>Odbiór</h3>
        <p>Odbiór końcowy, dokumentacja i gwarancja na wykonane prace.</p>
      </div>
    </div>
  </div>
</section>

<section class="cta-banner">
  <div class="container reveal">
    <span class="eyebrow">Nie wiesz, od czego zacząć?</span>
    <h2>Zadzwoń lub napisz — doradzimy najlepsze rozwiązanie</h2>
    <a href="<?php echo esc_url( aurelis_page_url( 'kontakt' ) ); ?>" class="btn btn--accent">Bezpłatna wycena</a>
  </div>
</section>

<?php
endwhile;

get_footer();
