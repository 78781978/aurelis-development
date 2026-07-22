<?php
/**
 * Szablon strony głównej.
 * Aby edytować hero, przypisz tę stronę jako "Stronę główną" w
 * Ustawienia → Czytanie, a pola hero znajdziesz w edytorze tej strony
 * pod treścią (metabox "Hero strony głównej").
 */
get_header();

while ( have_posts() ) :
	the_post();
	$post_id  = get_the_ID();
	$eyebrow  = get_post_meta( $post_id, '_aurelis_home_eyebrow', true );
	$heading1 = get_post_meta( $post_id, '_aurelis_home_heading_1', true );
	$heading2 = get_post_meta( $post_id, '_aurelis_home_heading_2', true );
	$lead     = get_post_meta( $post_id, '_aurelis_home_lead', true );

	if ( ! $eyebrow ) {
		$eyebrow = 'Aurelis Development · Małopolska';
	}
	if ( ! $heading1 ) {
		$heading1 = 'Budujemy solidnie.';
	}
	if ( ! $heading2 ) {
		$heading2 = 'Dotrzymujemy słowa.';
	}
	if ( ! $lead ) {
		$lead = 'Generalne wykonawstwo inwestycji mieszkaniowych i przemysłowych — od osiedli domów jednorodzinnych, przez hale i budynki wielorodzinne, po remonty i wykończenia. Ponad 12 lat doświadczenia na terenie Małopolski.';
	}
	?>

<section class="hero">
  <?php if ( has_post_thumbnail() ) : ?>
    <?php echo get_the_post_thumbnail( $post_id, 'full', array( 'class' => 'hero-bg', 'alt' => '' ) ); ?>
  <?php else : ?>
    <img src="<?php echo esc_url( AURELIS_URI . '/assets/hero-bg.svg' ); ?>" alt="" class="hero-bg">
  <?php endif; ?>
  <div class="hero-overlay"></div>
  <div class="container">
    <div class="hero-content">
      <span class="eyebrow"><?php echo esc_html( $eyebrow ); ?></span>
      <h1><?php echo esc_html( $heading1 ); ?><br><?php echo esc_html( $heading2 ); ?></h1>
      <p class="lead"><?php echo esc_html( $lead ); ?></p>
      <div class="hero-actions">
        <a href="<?php echo esc_url( aurelis_page_url( 'kontakt' ) ); ?>" class="btn btn--accent">Umów bezpłatną wycenę</a>
        <a href="<?php echo esc_url( aurelis_page_url( 'realizacje' ) ); ?>" class="btn btn--outline">Zobacz realizacje</a>
      </div>
      <div class="hero-badges">
        <div><strong data-count="<?php echo esc_attr( aurelis_company( 'stat_projects' ) ); ?>"><?php echo esc_html( aurelis_company( 'stat_projects' ) ); ?></strong><span>Zrealizowanych projektów</span></div>
        <div><strong data-count="<?php echo esc_attr( aurelis_company( 'stat_years' ) ); ?>"><?php echo esc_html( aurelis_company( 'stat_years' ) ); ?></strong><span>Lat doświadczenia</span></div>
        <div><strong data-count="<?php echo esc_attr( aurelis_company( 'stat_satisfaction' ) ); ?>"><?php echo esc_html( aurelis_company( 'stat_satisfaction' ) ); ?></strong><span>Zadowolonych klientów</span></div>
      </div>
    </div>
  </div>
</section>

<section class="section">
  <div class="container">
    <div class="section-head reveal">
      <span class="eyebrow">Generalne wykonawstwo</span>
      <h2>Wszystko, czego potrzebuje Twoja inwestycja</h2>
      <p>Od pierwszego szkicu po ostatni gwóźdź — zajmujemy się każdym etapem realizacji inwestycji mieszkaniowej i przemysłowej.</p>
    </div>
    <div class="grid grid--3">
      <div class="card reveal">
        <div class="icon">01</div>
        <h3>Budowa osiedli domów jednorodzinnych</h3>
        <p>Kompleksowa realizacja osiedli, zgodnie z projektem i harmonogramem inwestora.</p>
      </div>
      <div class="card reveal reveal-delay-1">
        <div class="icon">02</div>
        <h3>Budowa budynków wielorodzinnych</h3>
        <p>Generalne wykonawstwo budynków wielorodzinnych — od fundamentów po odbiór końcowy.</p>
      </div>
      <div class="card reveal reveal-delay-2">
        <div class="icon">03</div>
        <h3>Hale przemysłowe i magazynowe</h3>
        <p>Budowa hal przemysłowych i magazynowych w konstrukcji dopasowanej do potrzeb inwestycji.</p>
      </div>
      <div class="card reveal">
        <div class="icon">04</div>
        <h3>Kompleksowe roboty żelbetowe</h3>
        <p>Konstrukcje żelbetowe wykonywane z zachowaniem najwyższych standardów jakości.</p>
      </div>
      <div class="card reveal reveal-delay-1">
        <div class="icon">05</div>
        <h3>Dachy i konstrukcje dachowe</h3>
        <p>Więźby dachowe, pokrycia, obróbki blacharskie i renowacje istniejących dachów.</p>
      </div>
      <div class="card reveal reveal-delay-2">
        <div class="icon">06</div>
        <h3>Prace wykończeniowe</h3>
        <p>Kompleksowe wykończenia wnętrz — od projektu po ostatni detal realizacji.</p>
      </div>
    </div>
    <div style="text-align:center;margin-top:44px;">
      <a href="<?php echo esc_url( aurelis_page_url( 'uslugi' ) ); ?>" class="btn btn--dark">Zobacz pełen zakres usług</a>
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
    <div class="split">
      <div class="reveal">
        <span class="eyebrow">Dlaczego Aurelis Development</span>
        <h2>Solidność, terminowość i przejrzyste zasady współpracy</h2>
        <?php if ( get_the_content() ) : ?>
          <?php the_content(); ?>
        <?php else : ?>
          <p>Działamy na terenie Małopolski od ponad 12 lat. Każdy projekt realizujemy zgodnie z harmonogramem i budżetem, a klient na bieżąco ma wgląd w postępy prac.</p>
        <?php endif; ?>
        <ul class="values-list">
          <li><div><strong>Doświadczony zespół</strong><br>Wykwalifikowani kierownicy budów, majstrowie i ekipy specjalistyczne.</div></li>
          <li><div><strong>Umowa i gwarancja</strong><br>Jasne warunki współpracy, gwarancja na wykonane prace.</div></li>
          <li><div><strong>Materiały sprawdzonych marek</strong><br>Współpracujemy wyłącznie ze sprawdzonymi dostawcami.</div></li>
          <li><div><strong>Stały kontakt</strong><br>Bieżące raportowanie postępu prac i dostępność kierownika budowy.</div></li>
        </ul>
        <a href="<?php echo esc_url( aurelis_page_url( 'o-nas' ) ); ?>" class="btn btn--dark">Poznaj naszą firmę</a>
      </div>
      <div class="reveal reveal-delay-1">
        <img src="<?php echo esc_url( AURELIS_URI . '/assets/zespol.png' ); ?>" alt="Zespół Aurelis Development">
      </div>
    </div>
  </div>
</section>

<section class="cta-banner">
  <div class="container reveal">
    <span class="eyebrow">Masz pomysł na budowę lub remont?</span>
    <h2>Porozmawiajmy o Twoim projekcie</h2>
    <p>Skontaktuj się z nami — przygotujemy bezpłatną, niezobowiązującą wycenę dopasowaną do Twoich potrzeb.</p>
    <a href="<?php echo esc_url( aurelis_page_url( 'kontakt' ) ); ?>" class="btn btn--accent">Skontaktuj się z nami</a>
  </div>
</section>

<?php
endwhile;

get_footer();
