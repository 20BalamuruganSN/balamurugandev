/* ============================================================
   Portfolio JavaScript — main.js
   Bala Murugan | Full Stack Engineer
   ============================================================ */

(function () {
  'use strict';

  /* -----------------------------------------------------------
     1. NAVBAR — add "scrolled" class on scroll
  ----------------------------------------------------------- */
  const navbar = document.getElementById('navbar');

  if (navbar) {
    const onScroll = () => {
      if (window.scrollY > 30) navbar.classList.add('scrolled');
      else navbar.classList.remove('scrolled');
    };
    window.addEventListener('scroll', onScroll, { passive: true });
    onScroll(); // run once on load
  }

  /* -----------------------------------------------------------
     2. MOBILE MENU — toggle open/close
  ----------------------------------------------------------- */
  const menuButton = document.getElementById('menuButton');
  const mobileMenu = document.getElementById('mobileMenu');

  if (menuButton && mobileMenu) {
    menuButton.addEventListener('click', () => {
      mobileMenu.classList.toggle('hidden');
    });

    // Close mobile menu when any link is clicked
    mobileMenu.querySelectorAll('a').forEach((link) => {
      link.addEventListener('click', () => {
        mobileMenu.classList.add('hidden');
      });
    });
  }

  /* -----------------------------------------------------------
     3. SCROLL REVEAL — IntersectionObserver
  ----------------------------------------------------------- */
  const revealElements = document.querySelectorAll('.reveal');

  if ('IntersectionObserver' in window && revealElements.length) {
    const revealObserver = new IntersectionObserver(
      (entries) => {
        entries.forEach((entry) => {
          if (entry.isIntersecting) {
            entry.target.classList.add('active');
            revealObserver.unobserve(entry.target);
          }
        });
      },
      { threshold: 0.12 }
    );

    revealElements.forEach((el) => revealObserver.observe(el));
  } else {
    // Fallback: show everything
    revealElements.forEach((el) => el.classList.add('active'));
  }

  /* -----------------------------------------------------------
     4. PACKAGE CONFIG — used by lead modal
  ----------------------------------------------------------- */
  const PACKAGES = {
    crm: {
      title: 'Work Smart CRM Subscription',
      price: '₹1,500 / month',
    },
    website: {
      title: 'Website Development',
      price: 'Custom Quote',
    },
    android: {
      title: 'Android App Development',
      price: 'Custom Quote',
    },
  };

  /* -----------------------------------------------------------
     5. LEAD MODAL — open / close / submit
  ----------------------------------------------------------- */
  const leadModal   = document.getElementById('leadModal');
  const leadForm    = document.getElementById('leadForm');
  const modalTitle  = document.getElementById('modalTitle');
  const leadPackage = document.getElementById('leadPackage');
  const leadPrice   = document.getElementById('leadPrice');
  const leadResult  = document.getElementById('leadResult');
  const leadSubmit  = document.getElementById('leadSubmit');

  /**
   * Open the lead modal for a given package.
   * Called by inline onclick="openLeadForm('crm')" in index.php.
   */
  window.openLeadForm = function (pkg) {
    if (!leadModal) return;

    const info = PACKAGES[pkg] || PACKAGES.website;
    if (leadPackage) leadPackage.value = pkg;
    if (modalTitle)  modalTitle.textContent = info.title;
    if (leadPrice)   leadPrice.textContent = '💰 ' + info.price;
    if (leadResult)  { leadResult.textContent = ''; leadResult.className = 'text-xs'; }
    if (leadSubmit)  { leadSubmit.disabled = false; leadSubmit.textContent = 'Send Enquiry & Open WhatsApp'; }

    leadModal.classList.remove('hidden');
    leadModal.classList.add('flex');
    document.body.style.overflow = 'hidden';

    // Focus first input
    const firstName = leadForm?.querySelector('input[name="name"]');
    if (firstName) setTimeout(() => firstName.focus(), 100);
  };

  /**
   * Close the lead modal.
   */
  window.closeLeadForm = function () {
    if (!leadModal) return;
    leadModal.classList.add('hidden');
    leadModal.classList.remove('flex');
    document.body.style.overflow = '';
  };

  // Close modal on backdrop click
  if (leadModal) {
    leadModal.addEventListener('click', (e) => {
      if (e.target === leadModal) window.closeLeadForm();
    });
  }

  // Close modal on Escape key
  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape' && leadModal && !leadModal.classList.contains('hidden')) {
      window.closeLeadForm();
    }
  });

  /**
   * Submit form via fetch → /api/contact.php
   * On success → open WhatsApp with pre-filled message.
   */
  window.submitLead = async function (event) {
    event.preventDefault();
    if (!leadForm || !leadSubmit) return;

    const formData = new FormData(leadForm);
    const btn      = leadSubmit;
    const out      = leadResult;

    btn.disabled = true;
    btn.textContent = 'Sending…';
    if (out) {
      out.textContent = '';
      out.className = 'text-xs';
    }

    try {
      const res  = await fetch('/api/contact.php', {
        method: 'POST',
        body: formData,
        headers: { 'X-Requested-With': 'XMLHttpRequest' },
      });

      const data = await res.json();

      if (data.ok) {
        if (out) {
          out.textContent = data.message || 'Sent! We will reach you on WhatsApp shortly.';
          out.className = 'text-xs text-green-600';
        }
        btn.textContent = '✓ Sent';

        // ---- Build WhatsApp message ----
        const pkg  = formData.get('package') || 'website';
        const info = PACKAGES[pkg] || PACKAGES.website;
        const name = formData.get('name') || '';
        const email = formData.get('email') || '';

        const waText =
          'Hi Bala,\n\n' +
          "I'm " + name + ".\n" +
          'Interested in: ' + info.title + ' (' + info.price + ')\n' +
          'Email: ' + email + '\n\n' +
          'Sent via portfolio website.';

        const waNumber = '919384902854';
        const waURL = 'https://wa.me/' + waNumber + '?text=' + encodeURIComponent(waText);

        // Open WhatsApp after a short delay
        setTimeout(() => {
          window.open(waURL, '_blank');

          // Reset & close modal
          leadForm.reset();
          setTimeout(() => window.closeLeadForm(), 400);
        }, 700);
      } else {
        if (out) {
          out.textContent = (data.errors && data.errors.join(' ')) || data.error || 'Something went wrong.';
          out.className = 'text-xs text-red-600';
        }
        btn.disabled = false;
        btn.textContent = 'Send Enquiry & Open WhatsApp';
      }
    } catch (err) {
      console.error('Submit error:', err);
      if (out) {
        out.textContent = 'Network error. Please try again or WhatsApp directly.';
        out.className = 'text-xs text-red-600';
      }
      btn.disabled = false;
      btn.textContent = 'Send Enquiry & Open WhatsApp';
    }
  };

  /* -----------------------------------------------------------
     6. SMOOTH SCROLL for internal anchors (fallback)
     (CSS already handles most; this ensures mobile works)
  ----------------------------------------------------------- */
  document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
    anchor.addEventListener('click', function (e) {
      const href = this.getAttribute('href');
      if (!href || href === '#') return;

      const target = document.querySelector(href);
      if (!target) return;

      e.preventDefault();
      const offset = 80; // navbar height
      const top = target.getBoundingClientRect().top + window.pageYOffset - offset;
      window.scrollTo({ top, behavior: 'smooth' });
    });
  });

  /* -----------------------------------------------------------
     7. AUTO-UPDATE FOOTER YEAR
  ----------------------------------------------------------- */
  const yearEl = document.querySelector('footer .year');
  if (yearEl) yearEl.textContent = new Date().getFullYear();

  /* -----------------------------------------------------------
     8. LAZY IMAGE FADE-IN
  ----------------------------------------------------------- */
  document.querySelectorAll('img[loading="lazy"]').forEach((img) => {
    img.style.opacity = '0';
    img.style.transition = 'opacity .6s ease';
    const show = () => { img.style.opacity = '1'; };
    if (img.complete) show();
    else {
      img.addEventListener('load', show);
      img.addEventListener('error', show);
    }
  });

  /* -----------------------------------------------------------
     9. TOAST HELPER (optional visual feedback)
  ----------------------------------------------------------- */
  window.showToast = function (msg, type) {
    const t = document.createElement('div');
    const bg = type === 'error' ? 'bg-red-500' : 'bg-green-500';
    t.className =
      'fixed bottom-24 left-1/2 -translate-x-1/2 z-[200] ' + bg +
      ' text-white px-6 py-3 rounded-xl text-sm font-semibold shadow-2xl';
    t.textContent = msg;
    document.body.appendChild(t);
    setTimeout(() => {
      t.style.transition = 'opacity .4s';
      t.style.opacity = '0';
      setTimeout(() => t.remove(), 400);
    }, 3000);
  };

  console.log('%c🚀 Portfolio loaded', 'color:#0f6fff;font-weight:bold');
})();