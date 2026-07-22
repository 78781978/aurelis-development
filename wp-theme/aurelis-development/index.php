<?php
/**
 * Domyślny szablon (wymagany przez WordPress, aby motyw był poprawny).
 * W normalnym użyciu tej strony się nie zobaczy — Strona główna korzysta
 * z front-page.php, a każda Strona z page.php lub dedykowanego page-{slug}.php.
 * Ten plik obsługuje jedynie nietypowe przypadki (np. wyniki wyszukiwania, wpisy bloga).
 */
get_header();
?>

<section class="section">
  <div class="container">
    <?php if ( have_posts() ) : ?>
      <?php while ( have_posts() ) : the_post(); ?>
        <article <?php post_class( 'legal-content' ); ?> style="margin-bottom:60px;">
          <h1><?php the_title(); ?></h1>
          <?php the_content(); ?>
        </article>
      <?php endwhile; ?>
    <?php else : ?>
      <div class="legal-content">
        <h1>Brak wyników</h1>
        <p>Nie znaleziono żadnej treści.</p>
      </div>
    <?php endif; ?>
  </div>
</section>

<?php
get_footer();
