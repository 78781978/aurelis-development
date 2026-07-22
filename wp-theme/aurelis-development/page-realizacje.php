<?php
/**
 * Szablon: Realizacje.
 * Działa automatycznie dla strony o adresie (slug) "realizacje".
 * Galeria pobiera wpisy z Realizacje (menu boczne w panelu WP), opinie z Opinie klientów.
 * Dopóki nie dodasz żadnych wpisów, wyświetlają się przykładowe treści demonstracyjne.
 */
get_header();

while ( have_posts() ) :
	the_post();
	$subtitle = aurelis_hero_subtitle( get_the_ID(), 'Wybrane projekty zrealizowane na terenie Małopolski.' );

	$realizacje_query = new WP_Query( array(
		'post_type'      => 'realizacja',
		'posts_per_page' => -1,
		'orderby'        => 'menu_order date',
		'order'          => 'DESC',
	) );

	$opinie_query = new WP_Query( array(
		'post_type'      => 'opinia',
		'posts_per_page' => -1,
		'orderby'        => 'date',
		'order'          => 'DESC',
	) );

	$demo_realizacje = array(
		array( 'realizacja-01.svg', 'Dom jednorodzinny — Kraków' ),
		array( 'realizacja-02.svg', 'Remont wnętrz — Wieliczka' ),
		array( 'realizacja-03.svg', 'Elewacja i termomodernizacja' ),
		array( 'realizacja-04.svg', 'Budowa domu — Skawina' ),
		array( 'realizacja-05.svg', 'Wykończenie pod klucz' ),
		array( 'realizacja-06.svg', 'Dach i pokrycie dachowe' ),
	);

	$demo_opinie = array(
		array( '„Ekipa Aurelis Development wybudowała nasz dom zgodnie z harmonogramem i budżetem. Świetna komunikacja na każdym etapie."', 'Anna K., Kraków' ),
		array( '„Profesjonalny remont mieszkania — czysto, terminowo i bez niespodzianek kosztowych. Polecamy!"', 'Marek W., Wieliczka' ),
		array( '„Docieplenie i elewacja domu wykonane solidnie. Widać doświadczenie i dbałość o detale."', 'Katarzyna S., Skawina' ),
	);
	?>

<section class="page-hero">
  <div class="container">
    <div class="breadcrumb"><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Strona główna</a> / Realizacje</div>
    <h1><?php the_title(); ?></h1>
    <p><?php echo esc_html( $subtitle ); ?></p>
  </div>
</section>

<section class="section">
  <div class="container">
    <div class="grid grid--3">
      <?php if ( $realizacje_query->have_posts() ) : ?>
        <?php
        $i = 0;
        while ( $realizacje_query->have_posts() ) :
          $realizacje_query->the_post();
          $i++;
          ?>
          <div class="gallery-item reveal reveal-delay-<?php echo esc_attr( ( $i % 3 ) + 1 ); ?>">
            <?php if ( has_post_thumbnail() ) : ?>
              <?php the_post_thumbnail( 'medium_large' ); ?>
            <?php else : ?>
              <img src="<?php echo esc_url( AURELIS_URI . '/assets/realizacja-0' . ( ( $i - 1 ) % 6 + 1 ) . '.svg' ); ?>" alt="<?php the_title_attribute(); ?>">
            <?php endif; ?>
            <span class="gallery-tag"><?php the_title(); ?></span>
          </div>
        <?php endwhile; ?>
        <?php wp_reset_postdata(); ?>
      <?php else : ?>
        <?php foreach ( $demo_realizacje as $i => $item ) : ?>
          <div class="gallery-item reveal reveal-delay-<?php echo esc_attr( ( $i % 3 ) + 1 ); ?>">
            <img src="<?php echo esc_url( AURELIS_URI . '/assets/' . $item[0] ); ?>" alt="<?php echo esc_attr( $item[1] ); ?> (zdjęcie placeholder)">
            <span class="gallery-tag"><?php echo esc_html( $item[1] ); ?></span>
          </div>
        <?php endforeach; ?>
        <p class="form-note" style="grid-column:1/-1;">Powyższe zdjęcia to placeholdery demonstracyjne. Dodaj własne realizacje w panelu: <strong>Realizacje → Dodaj realizację</strong> (tytuł = podpis pod zdjęciem, zdjęcie wyróżniające = fotografia).</p>
      <?php endif; ?>
    </div>
  </div>
</section>

<section class="section section--cream">
  <div class="container">
    <div class="section-head reveal">
      <span class="eyebrow">Opinie klientów</span>
      <h2>Co mówią o nas klienci</h2>
    </div>
    <div class="grid grid--3">
      <?php if ( $opinie_query->have_posts() ) : ?>
        <?php
        $j = 0;
        while ( $opinie_query->have_posts() ) :
          $opinie_query->the_post();
          $j++;
          ?>
          <div class="card reveal reveal-delay-<?php echo esc_attr( ( $j % 3 ) + 1 ); ?>">
            <p>„<?php echo esc_html( wp_strip_all_tags( get_the_content() ) ); ?>"</p>
            <h3 style="margin-top:20px;">— <?php the_title(); ?></h3>
          </div>
        <?php endwhile; ?>
        <?php wp_reset_postdata(); ?>
      <?php else : ?>
        <?php foreach ( $demo_opinie as $i => $opinia ) : ?>
          <div class="card reveal reveal-delay-<?php echo esc_attr( ( $i % 3 ) + 1 ); ?>">
            <p><?php echo esc_html( $opinia[0] ); ?></p>
            <h3 style="margin-top:20px;">— <?php echo esc_html( $opinia[1] ); ?></h3>
          </div>
        <?php endforeach; ?>
        <p class="form-note" style="grid-column:1/-1;">Powyższe opinie są przykładowe. Dodaj prawdziwe recenzje w panelu: <strong>Opinie klientów → Dodaj opinię</strong> (tytuł = autor i miejscowość, treść = cytat).</p>
      <?php endif; ?>
    </div>
  </div>
</section>

<section class="cta-banner">
  <div class="container reveal">
    <span class="eyebrow">Podoba Ci się nasza praca?</span>
    <h2>Zrealizujmy razem Twój projekt</h2>
    <a href="<?php echo esc_url( aurelis_page_url( 'kontakt' ) ); ?>" class="btn btn--accent">Skontaktuj się z nami</a>
  </div>
</section>

<?php
endwhile;

get_footer();
