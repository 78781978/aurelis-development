<?php
/**
 * Pojedyncza realizacja — proste podglądowe okno (rzadko odwiedzane,
 * bo z galerii realizacje otwierają się jako powiększone zdjęcia w kontekście listy).
 */
get_header();

while ( have_posts() ) :
	the_post();
	?>

<section class="page-hero">
  <div class="container">
    <div class="breadcrumb"><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Strona główna</a> / <a href="<?php echo esc_url( aurelis_page_url( 'realizacje' ) ); ?>">Realizacje</a> / <?php the_title(); ?></div>
    <h1><?php the_title(); ?></h1>
  </div>
</section>

<section class="section">
  <div class="container">
    <div class="legal-content">
      <?php if ( has_post_thumbnail() ) : ?>
        <div style="margin-bottom:30px;"><?php the_post_thumbnail( 'large' ); ?></div>
      <?php endif; ?>
      <?php the_content(); ?>
      <a href="<?php echo esc_url( aurelis_page_url( 'realizacje' ) ); ?>" class="btn btn--dark">← Wróć do wszystkich realizacji</a>
    </div>
  </div>
</section>

<?php
endwhile;

get_footer();
