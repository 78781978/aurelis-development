<?php
/**
 * Szablon: Regulamin.
 * Działa automatycznie dla strony o adresie (slug) "regulamin".
 * Cała treść poniżej pochodzi z edytora tej strony w panelu WP — edytuj swobodnie.
 */
get_header();

while ( have_posts() ) :
	the_post();
	$subtitle = aurelis_hero_subtitle( get_the_ID(), 'Zasady korzystania ze strony internetowej ' . aurelis_company( 'company_name' ) . '.' );
	?>

<section class="page-hero">
  <div class="container">
    <div class="breadcrumb"><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Strona główna</a> / Regulamin</div>
    <h1><?php the_title(); ?></h1>
    <p><?php echo esc_html( $subtitle ); ?></p>
  </div>
</section>

<section class="section">
  <div class="container">
    <div class="legal-content">
      <p class="legal-updated">Ostatnia aktualizacja: <?php echo esc_html( get_the_modified_date( 'j F Y' ) ); ?> r.</p>
      <?php the_content(); ?>
    </div>
  </div>
</section>

<?php
endwhile;

get_footer();
