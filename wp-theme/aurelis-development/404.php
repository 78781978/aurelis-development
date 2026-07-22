<?php
/**
 * Strona błędu 404.
 */
get_header();
?>

<section class="page-hero">
  <div class="container">
    <div class="breadcrumb"><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Strona główna</a> / 404</div>
    <h1>Strona nie została znaleziona</h1>
    <p>Wygląda na to, że podstrona, której szukasz, nie istnieje albo została przeniesiona.</p>
  </div>
</section>

<section class="section" style="text-align:center;">
  <div class="container">
    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn--accent">Wróć na stronę główną</a>
  </div>
</section>

<?php
get_footer();
