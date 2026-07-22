<?php
/**
 * Szablon: Praca.
 * Działa automatycznie dla strony o adresie (slug) "praca".
 * Stawkę i lokalizację edytujesz w metaboksie pod treścią strony w edytorze.
 */
get_header();

while ( have_posts() ) :
	the_post();
	$post_id  = get_the_ID();
	$subtitle = aurelis_hero_subtitle( $post_id, 'Generalny wykonawca inwestycji mieszkaniowych i przemysłowych szuka wzmocnienia dla swoich ekip budowlanych na terenie Krakowa i okolic.' );
	$rate     = aurelis_job_field( $post_id, '_aurelis_job_rate', '35–45 zł/h NETTO' );
	$location = aurelis_job_field( $post_id, '_aurelis_job_location', 'Kraków i okolice' );
	?>

<section class="page-hero">
  <div class="container">
    <div class="breadcrumb"><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Strona główna</a> / Praca</div>
    <h1><?php the_title(); ?></h1>
    <p><?php echo esc_html( $subtitle ); ?></p>
  </div>
</section>

<section class="section">
  <div class="container">
    <div class="section-head reveal">
      <span class="eyebrow">Czym się zajmujemy</span>
      <h2>Generalne wykonawstwo inwestycji mieszkaniowych</h2>
      <?php if ( get_the_content() ) : ?>
        <?php the_content(); ?>
      <?php else : ?>
        <p>Aurelis Development Sp. z o.o. realizuje kompleksowe inwestycje budowlane na terenie Małopolski — to na tych projektach będziesz pracować.</p>
      <?php endif; ?>
    </div>
    <div class="grid grid--3">
      <div class="card reveal">
        <div class="icon">01</div>
        <h3>Budowa osiedli i budynków wielorodzinnych</h3>
        <p>Osiedla domów jednorodzinnych oraz budynki wielorodzinne — pełen zakres prac konstrukcyjnych.</p>
      </div>
      <div class="card reveal reveal-delay-1">
        <div class="icon">02</div>
        <h3>Hale przemysłowe i roboty żelbetowe</h3>
        <p>Hale przemysłowe i magazynowe oraz kompleksowe roboty żelbetowe i murarskie.</p>
      </div>
      <div class="card reveal reveal-delay-2">
        <div class="icon">03</div>
        <h3>Elewacje, dachy i wykończenia</h3>
        <p>Ocieplenia elewacji w systemach ETICS, konstrukcje dachowe oraz prace wykończeniowe pod klucz.</p>
      </div>
    </div>
    <div style="text-align:center;margin-top:44px;">
      <a href="<?php echo esc_url( aurelis_page_url( 'uslugi' ) ); ?>" class="btn btn--dark">Zobacz pełen zakres usług</a>
    </div>
  </div>
</section>

<section class="section section--cream">
  <div class="container">
    <div class="job-card reveal">
      <span class="eyebrow">Oferta pracy</span>
      <h2>Pracownik budowlany</h2>
      <div class="job-rate"><?php echo esc_html( $rate ); ?></div>
      <p>Aurelis Development Sp. z o.o. zatrudni pracowników budowlanych do realizacji inwestycji na terenie Krakowa i okolic.</p>

      <div class="job-columns">
        <div>
          <h3>Oferujemy</h3>
          <ul class="job-list">
            <li><span class="tick">✔</span><span>35–45 zł netto/h (w zależności od doświadczenia)</span></li>
            <li><span class="tick">✔</span><span>Stabilne zatrudnienie na pełny etat</span></li>
            <li><span class="tick">✔</span><span>Terminowe wynagrodzenie</span></li>
            <li><span class="tick">✔</span><span>Pracę przez cały rok — bez przestojów</span></li>
            <li><span class="tick">✔</span><span>Premie za zaangażowanie i jakość pracy</span></li>
            <li><span class="tick">✔</span><span>Odzież roboczą i profesjonalny sprzęt</span></li>
          </ul>
        </div>
        <div>
          <h3>Oczekujemy</h3>
          <ul class="job-list">
            <li><span class="tick">✔</span><span>Doświadczenia w pracach budowlanych</span></li>
            <li><span class="tick">✔</span><span>Sumienności i zaangażowania</span></li>
            <li><span class="tick">✔</span><span>Umiejętności pracy w zespole</span></li>
          </ul>
        </div>
      </div>

      <div class="job-location"><?php echo esc_html( $location ); ?></div>
      <p>Dołącz do naszego zespołu! Zadzwoń lub wyślij CV i zacznij pracę od zaraz.</p>
      <div class="job-actions">
        <a href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', aurelis_company( 'phone_mobile' ) ) ); ?>" class="btn btn--accent">Zadzwoń: <?php echo esc_html( aurelis_company( 'phone_mobile' ) ); ?></a>
        <a href="mailto:<?php echo esc_attr( aurelis_company( 'email' ) ); ?>?subject=<?php echo rawurlencode( 'CV — Pracownik budowlany' ); ?>&amp;body=<?php echo rawurlencode( "Dzień dobry,\r\n\r\nW załączeniu przesyłam moje CV na stanowisko pracownika budowlanego.\r\n\r\nPozdrawiam" ); ?>" class="btn btn--outline">Wyślij CV mailem</a>
      </div>
    </div>
  </div>
</section>

<section class="cta-banner">
  <div class="container reveal">
    <span class="eyebrow">Nie widzisz oferty dla siebie?</span>
    <h2>Napisz do nas mimo wszystko</h2>
    <p>Stale poszukujemy doświadczonych fachowców — wyślij CV, a odezwiemy się, gdy pojawi się pasujące stanowisko.</p>
    <a href="<?php echo esc_url( aurelis_page_url( 'kontakt' ) ); ?>" class="btn btn--accent">Skontaktuj się z nami</a>
  </div>
</section>

<?php
endwhile;

get_footer();
