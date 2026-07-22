<?php
/**
 * Szablon: Kontakt.
 * Działa automatycznie dla strony o adresie (slug) "kontakt".
 * Formularz wysyła e-mail przez wp_mail() na adres z Personalizacja → Dane firmy Aurelis.
 */
get_header();

while ( have_posts() ) :
	the_post();
	$subtitle = aurelis_hero_subtitle( get_the_ID(), 'Odpowiadamy w ciągu 24 godzin. Zadzwoń, napisz lub wypełnij formularz — przygotujemy bezpłatną wycenę.' );

	$sent = isset( $_GET['wyslano'] ) ? sanitize_text_field( wp_unslash( $_GET['wyslano'] ) ) : '';
	?>

<section class="page-hero">
  <div class="container">
    <div class="breadcrumb"><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Strona główna</a> / Kontakt</div>
    <h1><?php the_title(); ?></h1>
    <p><?php echo esc_html( $subtitle ); ?></p>
  </div>
</section>

<section class="section">
  <div class="container">
    <div class="contact-grid">

      <div class="reveal">
        <div class="contact-info-card">
          <h3>Dane kontaktowe</h3>

          <div class="contact-info-item">
            <div class="ic">Tel.</div>
            <div><strong><?php echo esc_html( aurelis_company( 'phone_mobile' ) ); ?></strong><strong><?php echo esc_html( aurelis_company( 'phone_landline' ) ); ?></strong><span><?php echo esc_html( aurelis_company( 'hours' ) ); ?></span></div>
          </div>

          <div class="contact-info-item">
            <div class="ic">Mail</div>
            <div><strong><?php echo esc_html( aurelis_company( 'email' ) ); ?></strong><span>Odpowiadamy w ciągu 24h</span></div>
          </div>

          <div class="contact-info-item">
            <div class="ic">Adres</div>
            <div><strong><?php echo esc_html( aurelis_company( 'address_street' ) ); ?></strong><span><?php echo esc_html( aurelis_company( 'address_city' ) ); ?></span></div>
          </div>

          <div class="contact-info-item">
            <div class="ic">Firma</div>
            <div><strong><?php echo esc_html( aurelis_company( 'company_name' ) ); ?></strong><span>NIP: <?php echo esc_html( aurelis_company( 'nip' ) ); ?></span></div>
          </div>

          <div class="social-links">
            <?php if ( aurelis_company( 'social_facebook' ) ) : ?><a href="<?php echo esc_url( aurelis_company( 'social_facebook' ) ); ?>" aria-label="Facebook" target="_blank" rel="noopener">FB</a><?php endif; ?>
            <?php if ( aurelis_company( 'social_instagram' ) ) : ?><a href="<?php echo esc_url( aurelis_company( 'social_instagram' ) ); ?>" aria-label="Instagram" target="_blank" rel="noopener">IG</a><?php endif; ?>
            <?php if ( aurelis_company( 'social_linkedin' ) ) : ?><a href="<?php echo esc_url( aurelis_company( 'social_linkedin' ) ); ?>" aria-label="LinkedIn" target="_blank" rel="noopener">IN</a><?php endif; ?>
          </div>
        </div>

        <div class="map-wrap">
          <iframe
            src="<?php echo esc_url( aurelis_company( 'map_embed_url' ) ); ?>"
            loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"
            title="Mapa — <?php echo esc_attr( aurelis_company( 'address_street' ) ); ?>, <?php echo esc_attr( aurelis_company( 'address_city' ) ); ?>">
          </iframe>
        </div>
      </div>

      <div class="reveal reveal-delay-1">
        <span class="eyebrow">Formularz kontaktowy</span>
        <h2>Napisz do nas</h2>
        <p>Wypełnij poniższy formularz — oddzwonimy lub odpiszemy z wyceną.</p>

        <?php if ( 'blad' === $sent ) : ?>
          <p class="form-status is-error">Ups, coś poszło nie tak — sprawdź, czy wszystkie wymagane pola są wypełnione, i spróbuj ponownie, albo zadzwoń bezpośrednio.</p>
        <?php elseif ( '1' === $sent ) : ?>
          <p class="form-status is-success">Dziękujemy! Wiadomość została wysłana — odezwiemy się jak najszybciej.</p>
        <?php endif; ?>

        <form class="contact-form" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post">
          <input type="hidden" name="action" value="aurelis_contact_form">
          <?php wp_nonce_field( 'aurelis_contact_form', 'aurelis_contact_nonce' ); ?>
          <div class="hp-field" aria-hidden="true">
            <label for="aurelis_website">Zostaw to pole puste</label>
            <input type="text" id="aurelis_website" name="aurelis_website" tabindex="-1" autocomplete="off">
          </div>
          <div>
            <label for="name">Imię i nazwisko</label>
            <input type="text" id="name" name="name" required placeholder="Jan Kowalski">
          </div>
          <div>
            <label for="phone">Telefon</label>
            <input type="tel" id="phone" name="phone" placeholder="+48 000 000 000">
          </div>
          <div>
            <label for="email">E-mail</label>
            <input type="email" id="email" name="email" required placeholder="jan.kowalski@email.pl">
          </div>
          <div>
            <label for="service">Rodzaj usługi</label>
            <select id="service" name="service">
              <option>Budowa domu</option>
              <option>Remont / wykończenie</option>
              <option>Elewacja / termomodernizacja</option>
              <option>Dach</option>
              <option>Inne</option>
            </select>
          </div>
          <div>
            <label for="message">Wiadomość</label>
            <textarea id="message" name="message" rows="5" required placeholder="Opisz krótko swój projekt..."></textarea>
          </div>
          <button type="submit" class="btn btn--accent">Wyślij zapytanie</button>
        </form>
      </div>

    </div>
  </div>
</section>

<?php
endwhile;

get_footer();
