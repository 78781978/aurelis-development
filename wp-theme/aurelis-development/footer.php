<footer class="site-footer" id="footer">
  <div class="container">
    <div class="footer-grid">
      <div>
        <div class="footer-logo"><img src="<?php echo esc_url( AURELIS_URI . '/assets/logo.svg' ); ?>" alt="<?php bloginfo( 'name' ); ?>"></div>
        <p><?php echo esc_html( aurelis_company( 'footer_about' ) ); ?></p>
        <div class="social-links">
          <?php if ( aurelis_company( 'social_facebook' ) ) : ?><a href="<?php echo esc_url( aurelis_company( 'social_facebook' ) ); ?>" aria-label="Facebook" target="_blank" rel="noopener">FB</a><?php endif; ?>
          <?php if ( aurelis_company( 'social_instagram' ) ) : ?><a href="<?php echo esc_url( aurelis_company( 'social_instagram' ) ); ?>" aria-label="Instagram" target="_blank" rel="noopener">IG</a><?php endif; ?>
          <?php if ( aurelis_company( 'social_linkedin' ) ) : ?><a href="<?php echo esc_url( aurelis_company( 'social_linkedin' ) ); ?>" aria-label="LinkedIn" target="_blank" rel="noopener">IN</a><?php endif; ?>
        </div>
      </div>
      <div>
        <h4>Nawigacja</h4>
        <?php
        if ( has_nav_menu( 'primary' ) ) {
          wp_nav_menu( array(
            'theme_location' => 'primary',
            'container'      => false,
            'items_wrap'     => '<ul>%3$s</ul>',
          ) );
        } else {
          aurelis_fallback_menu();
        }
        ?>
      </div>
      <div>
        <h4>Usługi</h4>
        <ul>
          <li><a href="<?php echo esc_url( aurelis_page_url( 'uslugi' ) ); ?>">Budowa domów i osiedli</a></li>
          <li><a href="<?php echo esc_url( aurelis_page_url( 'uslugi' ) ); ?>">Hale przemysłowe</a></li>
          <li><a href="<?php echo esc_url( aurelis_page_url( 'uslugi' ) ); ?>">Roboty żelbetowe</a></li>
          <li><a href="<?php echo esc_url( aurelis_page_url( 'uslugi' ) ); ?>">Wykończenia wnętrz</a></li>
        </ul>
      </div>
      <div>
        <h4>Kontakt</h4>
        <ul>
          <li><?php echo esc_html( aurelis_company( 'company_name' ) ); ?></li>
          <li><?php echo esc_html( aurelis_company( 'address_street' ) ); ?><br><?php echo esc_html( aurelis_company( 'address_city' ) ); ?></li>
          <li><?php echo esc_html( aurelis_company( 'phone_mobile' ) ); ?></li>
          <li><?php echo esc_html( aurelis_company( 'phone_landline' ) ); ?></li>
          <li><?php echo esc_html( aurelis_company( 'email' ) ); ?></li>
        </ul>
      </div>
    </div>
    <div class="footer-bottom">
      <span>© <?php echo esc_html( date_i18n( 'Y' ) ); ?> <?php echo esc_html( aurelis_company( 'company_name' ) ); ?> Wszelkie prawa zastrzeżone.</span>
      <a href="<?php echo esc_url( aurelis_page_url( 'regulamin' ) ); ?>">Regulamin</a>
      <a href="<?php echo esc_url( aurelis_page_url( 'polityka-prywatnosci' ) ); ?>">Polityka prywatności</a>
    </div>
  </div>
</footer>

<div class="cookie-banner" id="cookieBanner">
  <div class="cookie-banner-inner">
    <p>Ta strona wykorzystuje pliki cookie, aby zapewnić jej prawidłowe działanie oraz — po Twojej zgodzie — do celów statystycznych. Więcej informacji znajdziesz w <a href="<?php echo esc_url( aurelis_page_url( 'polityka-prywatnosci' ) . '#cookies' ); ?>">Polityce prywatności</a>.</p>
    <div class="cookie-banner-actions">
      <button type="button" class="btn btn--outline btn--sm" id="cookieRejectBtn">Tylko niezbędne</button>
      <button type="button" class="btn btn--accent btn--sm" id="cookieAcceptBtn">Akceptuj wszystkie</button>
    </div>
  </div>
</div>

<?php wp_footer(); ?>
</body>
</html>
