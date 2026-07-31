</main>

<footer class="site-footer" id="footer">
  <div class="container">
    <div class="footer-grid">
      <div>
        <div class="footer-logo"><img src="<?php echo esc_url( AURELIS_URI . '/assets/logo.svg' ); ?>" alt="<?php bloginfo( 'name' ); ?>" width="216" height="144"></div>
        <p><?php echo esc_html( aurelis_company( 'footer_about' ) ); ?></p>
        <div class="social-links">
          <?php if ( aurelis_company( 'social_facebook' ) ) : ?><a href="<?php echo esc_url( aurelis_company( 'social_facebook' ) ); ?>" aria-label="Facebook" target="_blank" rel="noopener">FB</a><?php endif; ?>
        </div>
      </div>
      <div>
        <button type="button" class="footer-nav-toggle" aria-expanded="false" aria-controls="footerNavList">Nawigacja</button>
        <?php
        if ( has_nav_menu( 'primary' ) ) {
          wp_nav_menu( array(
            'theme_location' => 'primary',
            'container'      => false,
            'items_wrap'     => '<ul id="footerNavList" class="footer-nav-list">%3$s</ul>',
          ) );
        } else {
          aurelis_fallback_menu( 'id="footerNavList" class="footer-nav-list"' );
        }
        ?>
      </div>
      <div>
        <button type="button" class="footer-nav-toggle" aria-expanded="false" aria-controls="footerUslugiList">Usługi</button>
        <ul id="footerUslugiList" class="footer-nav-list">
          <li><a href="<?php echo esc_url( aurelis_page_url( 'uslugi' ) ); ?>">Budowa domów i osiedli</a></li>
          <li><a href="<?php echo esc_url( aurelis_page_url( 'uslugi' ) ); ?>">Hale przemysłowe</a></li>
          <li><a href="<?php echo esc_url( aurelis_page_url( 'uslugi' ) ); ?>">Roboty żelbetowe</a></li>
          <li><a href="<?php echo esc_url( aurelis_page_url( 'uslugi' ) ); ?>">Wykończenia wnętrz</a></li>
        </ul>
      </div>
      <div>
        <button type="button" class="footer-nav-toggle" aria-expanded="false" aria-controls="footerKontaktList">Kontakt</button>
        <ul id="footerKontaktList" class="footer-nav-list">
          <li><?php echo esc_html( aurelis_company( 'company_name' ) ); ?></li>
          <li><?php echo esc_html( aurelis_company( 'address_street' ) ); ?><br><?php echo esc_html( aurelis_company( 'address_city' ) ); ?></li>
          <li><a href="<?php echo esc_url( aurelis_tel_href( aurelis_company( 'phone_mobile' ) ) ); ?>"><?php echo esc_html( aurelis_company( 'phone_mobile' ) ); ?></a></li>
          <li><a href="<?php echo esc_url( aurelis_tel_href( aurelis_company( 'phone_landline' ) ) ); ?>"><?php echo esc_html( aurelis_company( 'phone_landline' ) ); ?></a></li>
          <li><a href="mailto:<?php echo esc_attr( aurelis_company( 'email' ) ); ?>"><?php echo esc_html( aurelis_company( 'email' ) ); ?></a></li>
        </ul>
      </div>
    </div>
    <div class="footer-bottom">
      <span>© <?php echo esc_html( date_i18n( 'Y' ) ); ?> <?php echo esc_html( aurelis_company( 'company_name' ) ); ?> Wszelkie prawa zastrzeżone.</span>
      <a href="<?php echo esc_url( aurelis_page_url( 'regulamin' ) ); ?>">Regulamin</a>
      <a href="<?php echo esc_url( aurelis_page_url( 'polityka-prywatnosci' ) ); ?>">Polityka prywatności</a>
      <button type="button" class="footer-settings-link" id="cookieSettingsLink">Ustawienia cookies</button>
      <a href="https://www.facebook.com/profile.php?id=61591915780293" target="_blank" rel="noopener" class="footer-credit-link">Projekt i wykonanie: <span class="shine-text">VERO STUDIO</span></a>
    </div>
  </div>
</footer>

<div class="cookie-banner" id="cookieBanner">
  <div class="cookie-banner-inner">
    <p>Ta strona wykorzystuje pliki cookie, aby zapewnić jej prawidłowe działanie oraz — po Twojej zgodzie — do celów statystycznych. Więcej informacji znajdziesz w <a href="<?php echo esc_url( aurelis_page_url( 'polityka-prywatnosci' ) . '#cookies' ); ?>">Polityce prywatności</a>.</p>
    <div class="cookie-banner-actions">
      <button type="button" class="btn btn--outline btn--sm" id="cookieCustomizeBtn">Dostosuj</button>
      <button type="button" class="btn btn--outline btn--sm" id="cookieRejectBtn">Tylko niezbędne</button>
      <button type="button" class="btn btn--accent btn--sm" id="cookieAcceptBtn">Akceptuj wszystkie</button>
    </div>
  </div>
</div>

<dialog class="cookie-modal" id="cookieModal" aria-labelledby="cookieModalTitle">
  <div class="cookie-modal-inner">
    <h2 id="cookieModalTitle">Ustawienia plików cookie</h2>
    <p>Wybierz, które pliki cookie chcesz zaakceptować. Więcej informacji znajdziesz w <a href="<?php echo esc_url( aurelis_page_url( 'polityka-prywatnosci' ) . '#cookies' ); ?>">Polityce prywatności</a>.</p>

    <div class="cookie-option">
      <div class="cookie-option-head">
        <span>Cookies niezbędne</span>
        <input type="checkbox" checked disabled aria-label="Cookies niezbędne (zawsze aktywne)">
      </div>
      <p>Niezbędne do prawidłowego działania strony. Nie można ich wyłączyć.</p>
    </div>

    <div class="cookie-option">
      <div class="cookie-option-head">
        <label for="cookieAnalytics">Cookies analityczne / statystyczne</label>
        <input type="checkbox" id="cookieAnalytics">
      </div>
      <p>Pomagają nam zrozumieć, jak odwiedzający korzystają ze strony (np. Google Analytics).</p>
    </div>

    <div class="cookie-modal-actions">
      <button type="button" class="btn btn--outline btn--sm" id="cookieModalCloseBtn">Anuluj</button>
      <button type="button" class="btn btn--outline btn--sm" id="cookieAcceptAllModalBtn">Akceptuj wszystkie</button>
      <button type="button" class="btn btn--accent btn--sm" id="cookieSaveBtn">Zapisz wybór</button>
    </div>
  </div>
</dialog>

<?php wp_footer(); ?>
</body>
</html>
