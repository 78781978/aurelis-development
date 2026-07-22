<?php
/**
 * Uniwersalny szablon strony (fallback) — używany dla dowolnej nowej strony,
 * która nie ma dedykowanego szablonu page-{slug}.php.
 */
get_header();

while ( have_posts() ) :
	the_post();
	$subtitle = aurelis_hero_subtitle( get_the_ID() );
	?>

<section class="page-hero">
  <div class="container">
    <div class="breadcrumb"><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Strona główna</a> / <?php the_title(); ?></div>
    <h1><?php the_title(); ?></h1>
    <?php if ( $subtitle ) : ?><p><?php echo esc_html( $subtitle ); ?></p><?php endif; ?>
  </div>
</section>

<section class="section">
  <div class="container">
    <div class="legal-content">
      <?php the_content(); ?>
    </div>
  </div>
</section>

<?php
endwhile;

get_footer();
