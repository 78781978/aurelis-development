document.addEventListener('DOMContentLoaded', function () {
  // Mobile nav toggle
  var toggle = document.querySelector('.nav-toggle');
  var nav = document.querySelector('.main-nav');
  if (toggle && nav) {
    toggle.addEventListener('click', function () {
      nav.classList.toggle('open');
      var expanded = nav.classList.contains('open');
      toggle.setAttribute('aria-expanded', expanded);
    });
    nav.querySelectorAll('a').forEach(function (link) {
      link.addEventListener('click', function () {
        nav.classList.remove('open');
      });
    });
  }

  // Footer navigation accordion (mobile)
  document.querySelectorAll('.footer-nav-toggle').forEach(function (btn) {
    var list = document.getElementById(btn.getAttribute('aria-controls'));
    if (!list) return;
    btn.addEventListener('click', function () {
      var expanded = btn.getAttribute('aria-expanded') === 'true';
      btn.setAttribute('aria-expanded', String(!expanded));
      list.classList.toggle('is-open', !expanded);
    });
  });

  // Sticky header shadow on scroll
  var header = document.querySelector('.site-header');
  if (header) {
    window.addEventListener('scroll', function () {
      if (window.scrollY > 10) {
        header.style.boxShadow = '0 6px 20px rgba(27,29,32,0.08)';
      } else {
        header.style.boxShadow = 'none';
      }
    });
  }

  // Footer year
  var yearEl = document.getElementById('year');
  if (yearEl) {
    yearEl.textContent = new Date().getFullYear();
  }

  // Contact form (demo — bez backendu)
  var form = document.querySelector('.contact-form');
  if (form) {
    form.addEventListener('submit', function (e) {
      e.preventDefault();
      var status = form.querySelector('.form-status');
      if (status) {
        status.textContent = 'Dziękujemy! To formularz demonstracyjny — podłącz go do np. Formspree, EmailJS lub własnego backendu, aby zgłoszenia trafiały na maila.';
        status.style.color = '#B8892A';
      }
      form.reset();
    });
  }

  // Scroll-reveal animations
  var revealEls = document.querySelectorAll('.reveal');
  if (revealEls.length) {
    if ('IntersectionObserver' in window) {
      var revealObserver = new IntersectionObserver(function (entries, obs) {
        entries.forEach(function (entry) {
          if (entry.isIntersecting) {
            entry.target.classList.add('is-visible');
            obs.unobserve(entry.target);
          }
        });
      }, { threshold: 0.15, rootMargin: '0px 0px -40px 0px' });
      revealEls.forEach(function (el) { revealObserver.observe(el); });
    } else {
      revealEls.forEach(function (el) { el.classList.add('is-visible'); });
    }
  }

  // Animated count-up for stat numbers (data-count="120+")
  var counters = document.querySelectorAll('[data-count]');
  if (counters.length && 'IntersectionObserver' in window) {
    var counterObserver = new IntersectionObserver(function (entries, obs) {
      entries.forEach(function (entry) {
        if (!entry.isIntersecting) return;
        var el = entry.target;
        var raw = el.getAttribute('data-count');
        var match = raw.match(/^(\d+)(.*)$/);
        if (!match) { el.textContent = raw; obs.unobserve(el); return; }
        var target = parseInt(match[1], 10);
        var suffix = match[2] || '';
        var duration = 1200;
        var start = null;
        function step(ts) {
          if (start === null) start = ts;
          var progress = Math.min((ts - start) / duration, 1);
          var eased = 1 - Math.pow(1 - progress, 3);
          el.textContent = Math.round(eased * target) + suffix;
          if (progress < 1) requestAnimationFrame(step);
        }
        requestAnimationFrame(step);
        obs.unobserve(el);
      });
    }, { threshold: 0.4 });
    counters.forEach(function (el) { counterObserver.observe(el); });
  }

  // Cookie consent banner + "Dostosuj" ustawienia
  var cookieBanner = document.getElementById('cookieBanner');
  var cookieModal = document.getElementById('cookieModal');
  if (cookieBanner) {
    var CONSENT_KEY = 'aurelisCookieConsent';

    function getConsent() {
      var raw = localStorage.getItem(CONSENT_KEY);
      if (!raw) return null;
      try {
        return JSON.parse(raw);
      } catch (e) {
        return null;
      }
    }
    function saveConsent(analytics) {
      localStorage.setItem(CONSENT_KEY, JSON.stringify({ necessary: true, analytics: !!analytics }));
    }
    function updateA11yToggleOffset() {
      if (cookieBanner.classList.contains('is-visible')) {
        document.documentElement.style.setProperty('--cookie-banner-h', cookieBanner.offsetHeight + 'px');
        document.documentElement.classList.add('cookie-banner-visible');
      } else {
        document.documentElement.classList.remove('cookie-banner-visible');
      }
    }
    function hideBanner() {
      cookieBanner.classList.remove('is-visible');
      updateA11yToggleOffset();
    }
    function closeModal() {
      if (cookieModal && cookieModal.open) cookieModal.close();
    }
    function openModal() {
      if (!cookieModal) return;
      var existing = getConsent();
      var analyticsCheckbox = document.getElementById('cookieAnalytics');
      if (analyticsCheckbox) analyticsCheckbox.checked = existing ? !!existing.analytics : false;
      cookieModal.showModal();
    }

    if (!getConsent()) {
      setTimeout(function () {
        cookieBanner.classList.add('is-visible');
        updateA11yToggleOffset();
      }, 400);
    }
    window.addEventListener('resize', updateA11yToggleOffset);

    var acceptBtn = document.getElementById('cookieAcceptBtn');
    var rejectBtn = document.getElementById('cookieRejectBtn');
    var customizeBtn = document.getElementById('cookieCustomizeBtn');
    var saveBtn = document.getElementById('cookieSaveBtn');
    var acceptAllModalBtn = document.getElementById('cookieAcceptAllModalBtn');
    var modalCloseBtn = document.getElementById('cookieModalCloseBtn');
    var settingsLink = document.getElementById('cookieSettingsLink');

    if (acceptBtn) acceptBtn.addEventListener('click', function () { saveConsent(true); hideBanner(); });
    if (rejectBtn) rejectBtn.addEventListener('click', function () { saveConsent(false); hideBanner(); });
    if (customizeBtn) customizeBtn.addEventListener('click', openModal);
    if (settingsLink) settingsLink.addEventListener('click', openModal);
    if (modalCloseBtn) modalCloseBtn.addEventListener('click', closeModal);
    if (saveBtn) {
      saveBtn.addEventListener('click', function () {
        var analyticsCheckbox = document.getElementById('cookieAnalytics');
        saveConsent(analyticsCheckbox && analyticsCheckbox.checked);
        hideBanner();
        closeModal();
      });
    }
    if (acceptAllModalBtn) {
      acceptAllModalBtn.addEventListener('click', function () {
        var analyticsCheckbox = document.getElementById('cookieAnalytics');
        if (analyticsCheckbox) analyticsCheckbox.checked = true;
        saveConsent(true);
        hideBanner();
        closeModal();
      });
    }
  }

  // Widget dostępności (WCAG 2.2) — rozmiar tekstu, kontrast, podkreślenia, animacje
  var a11yToggle = document.getElementById('a11yToggle');
  var a11yPanel = document.getElementById('a11yPanel');
  if (a11yToggle && a11yPanel) {
    var A11Y_KEY = 'aurelisA11yPrefs';
    var html = document.documentElement;

    function getA11yPrefs() {
      var raw = localStorage.getItem(A11Y_KEY);
      if (!raw) return { fontLevel: 0, contrast: false, underline: false, noMotion: false };
      try {
        var parsed = JSON.parse(raw);
        return {
          fontLevel: parsed.fontLevel || 0,
          contrast: !!parsed.contrast,
          underline: !!parsed.underline,
          noMotion: !!parsed.noMotion
        };
      } catch (e) {
        return { fontLevel: 0, contrast: false, underline: false, noMotion: false };
      }
    }
    function saveA11yPrefs(prefs) {
      localStorage.setItem(A11Y_KEY, JSON.stringify(prefs));
    }
    function applyA11yPrefs(prefs) {
      html.classList.remove('a11y-font-1', 'a11y-font-2');
      if (prefs.fontLevel === 1) html.classList.add('a11y-font-1');
      if (prefs.fontLevel === 2) html.classList.add('a11y-font-2');
      html.classList.toggle('a11y-contrast', prefs.contrast);
      html.classList.toggle('a11y-underline-links', prefs.underline);
      html.classList.toggle('a11y-no-motion', prefs.noMotion);

      var contrastCheckbox = document.getElementById('a11yContrast');
      var underlineCheckbox = document.getElementById('a11yUnderline');
      var noMotionCheckbox = document.getElementById('a11yNoMotion');
      if (contrastCheckbox) contrastCheckbox.checked = prefs.contrast;
      if (underlineCheckbox) underlineCheckbox.checked = prefs.underline;
      if (noMotionCheckbox) noMotionCheckbox.checked = prefs.noMotion;
    }

    var a11yPrefs = getA11yPrefs();
    applyA11yPrefs(a11yPrefs);

    a11yToggle.addEventListener('click', function () {
      a11yPanel.showModal();
      a11yToggle.setAttribute('aria-expanded', 'true');
    });
    a11yPanel.addEventListener('close', function () {
      a11yToggle.setAttribute('aria-expanded', 'false');
    });

    var a11yCloseBtn = document.getElementById('a11yCloseBtn');
    if (a11yCloseBtn) a11yCloseBtn.addEventListener('click', function () { a11yPanel.close(); });

    var a11yFontInc = document.getElementById('a11yFontInc');
    var a11yFontDec = document.getElementById('a11yFontDec');
    var a11yFontReset = document.getElementById('a11yFontReset');
    if (a11yFontInc) a11yFontInc.addEventListener('click', function () {
      a11yPrefs.fontLevel = Math.min(2, a11yPrefs.fontLevel + 1);
      applyA11yPrefs(a11yPrefs);
      saveA11yPrefs(a11yPrefs);
    });
    if (a11yFontDec) a11yFontDec.addEventListener('click', function () {
      a11yPrefs.fontLevel = Math.max(0, a11yPrefs.fontLevel - 1);
      applyA11yPrefs(a11yPrefs);
      saveA11yPrefs(a11yPrefs);
    });
    if (a11yFontReset) a11yFontReset.addEventListener('click', function () {
      a11yPrefs.fontLevel = 0;
      applyA11yPrefs(a11yPrefs);
      saveA11yPrefs(a11yPrefs);
    });

    var a11yContrast = document.getElementById('a11yContrast');
    var a11yUnderline = document.getElementById('a11yUnderline');
    var a11yNoMotion = document.getElementById('a11yNoMotion');
    if (a11yContrast) a11yContrast.addEventListener('change', function () {
      a11yPrefs.contrast = a11yContrast.checked;
      applyA11yPrefs(a11yPrefs);
      saveA11yPrefs(a11yPrefs);
    });
    if (a11yUnderline) a11yUnderline.addEventListener('change', function () {
      a11yPrefs.underline = a11yUnderline.checked;
      applyA11yPrefs(a11yPrefs);
      saveA11yPrefs(a11yPrefs);
    });
    if (a11yNoMotion) a11yNoMotion.addEventListener('change', function () {
      a11yPrefs.noMotion = a11yNoMotion.checked;
      applyA11yPrefs(a11yPrefs);
      saveA11yPrefs(a11yPrefs);
    });

    var a11yResetBtn = document.getElementById('a11yResetBtn');
    if (a11yResetBtn) a11yResetBtn.addEventListener('click', function () {
      a11yPrefs = { fontLevel: 0, contrast: false, underline: false, noMotion: false };
      applyA11yPrefs(a11yPrefs);
      saveA11yPrefs(a11yPrefs);
    });
  }
});
