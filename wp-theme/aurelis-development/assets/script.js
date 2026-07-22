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

  // Cookie consent banner
  var cookieBanner = document.getElementById('cookieBanner');
  if (cookieBanner) {
    var consent = localStorage.getItem('aurelisCookieConsent');
    if (!consent) {
      setTimeout(function () { cookieBanner.classList.add('is-visible'); }, 400);
    }
    var acceptBtn = document.getElementById('cookieAcceptBtn');
    var rejectBtn = document.getElementById('cookieRejectBtn');
    function hideCookieBanner(value) {
      localStorage.setItem('aurelisCookieConsent', value);
      cookieBanner.classList.remove('is-visible');
    }
    if (acceptBtn) acceptBtn.addEventListener('click', function () { hideCookieBanner('all'); });
    if (rejectBtn) rejectBtn.addEventListener('click', function () { hideCookieBanner('necessary'); });
  }
});
