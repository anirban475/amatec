/* AMATEC theme — front-end interactions
   Ported from the AMATEC Design System (React/JSX) to vanilla JS. */
(function () {
  'use strict';

  /* ---------------------------------------------------------
     Lucide icons (loaded from CDN in footer)
     --------------------------------------------------------- */
  function drawIcons() {
    if (window.lucide && typeof window.lucide.createIcons === 'function') {
      window.lucide.createIcons({ attrs: { 'stroke-width': 1.9 } });
    }
  }

  /* ---------------------------------------------------------
     NAV — desktop mega-menu (hover) + mobile accordion drawer
     --------------------------------------------------------- */
  function initNav() {
    var header = document.querySelector('.site-header');
    if (!header) return;

    // Desktop hover open/close with small close delay
    var items = header.querySelectorAll('.nav-item');
    var closeTimer = null;
    items.forEach(function (li) {
      if (!li.querySelector('.mega')) return;
      li.addEventListener('mouseenter', function () {
        clearTimeout(closeTimer);
        items.forEach(function (o) { o.classList.remove('open'); });
        li.classList.add('open');
      });
    });
    header.addEventListener('mouseleave', function () {
      closeTimer = setTimeout(function () {
        items.forEach(function (o) { o.classList.remove('open'); });
      }, 120);
    });

    // Mobile burger
    var burger = header.querySelector('.nav-burger');
    var drawer = header.querySelector('.mobile-drawer');
    if (burger && drawer) {
      burger.addEventListener('click', function () {
        var open = drawer.classList.toggle('show');
        var ic = burger.querySelector('i');
        if (ic) { ic.setAttribute('data-lucide', open ? 'x' : 'menu'); drawIcons(); }
      });
    }

    // Mobile accordions
    header.querySelectorAll('.m-acc-head[data-acc]').forEach(function (btn) {
      btn.addEventListener('click', function () {
        var panel = btn.nextElementSibling;
        var open = btn.classList.toggle('open');
        if (panel) panel.classList.toggle('open', open);
      });
    });
    // Close drawer when a mobile link is tapped
    header.querySelectorAll('.m-acc-link, .mobile-cta .btn').forEach(function (a) {
      a.addEventListener('click', function () { if (drawer) drawer.classList.remove('show'); });
    });
  }

  /* ---------------------------------------------------------
     Smooth-scroll for in-page anchor buttons (data-scroll="#id")
     --------------------------------------------------------- */
  function initScrollButtons() {
    document.querySelectorAll('[data-scroll]').forEach(function (el) {
      el.addEventListener('click', function (e) {
        var target = document.querySelector(el.getAttribute('data-scroll'));
        if (target) { e.preventDefault(); target.scrollIntoView({ behavior: 'smooth' }); }
      });
    });
  }

  /* ---------------------------------------------------------
     HOW IT WORKS — interactive stepper
     --------------------------------------------------------- */
  function initStepper() {
    var root = document.querySelector('[data-stepper]');
    if (!root) return;
    var steps = root.querySelectorAll('.how-step');
    var details = root.querySelectorAll('.how-detail-item');
    steps.forEach(function (btn, i) {
      btn.addEventListener('click', function () {
        steps.forEach(function (s) { s.classList.remove('on'); });
        btn.classList.add('on');
        details.forEach(function (d, j) {
          d.style.display = j === i ? 'flex' : 'none';
          if (j === i) {
            d.classList.remove('reveal'); void d.offsetWidth; d.classList.add('reveal');
          }
        });
      });
    });
  }

  /* ---------------------------------------------------------
     Reveal safety-net — never leave .reveal hidden
     --------------------------------------------------------- */
  function initRevealSafety() {
    window.setTimeout(function () {
      document.querySelectorAll('.reveal').forEach(function (el) {
        if (getComputedStyle(el).opacity === '0') {
          el.style.opacity = '1'; el.style.transform = 'none';
        }
      });
    }, 1600);
  }

  /* ---------------------------------------------------------
     HERO — interactive mesh-gradient WebGL shader
     --------------------------------------------------------- */
  function initMeshGradient() {
    var canvas = document.querySelector('[data-mesh]');
    if (!canvas) return;
    var gl = canvas.getContext('webgl', { antialias: true, premultipliedAlpha: false });
    if (!gl) return;

    var vert = 'attribute vec2 p; void main(){ gl_Position = vec4(p,0.0,1.0); }';
    var frag = [
      'precision highp float;',
      'uniform vec2 u_res; uniform float u_time; uniform vec2 u_mouse; uniform float u_active;',
      'const vec3 NAVY=vec3(0.039,0.173,0.286); const vec3 DEEP=vec3(0.027,0.227,0.380);',
      'const vec3 BLUE=vec3(0.027,0.314,0.545); const vec3 BRIGHT=vec3(0.122,0.424,0.671);',
      'const vec3 ORANGE=vec3(0.949,0.576,0.137);',
      'float blob(vec2 uv, vec2 c, float r){ float d=distance(uv,c); return exp(-d*d/(r*r)); }',
      'void main(){',
      '  vec2 uv=gl_FragCoord.xy/u_res.xy; float aspect=u_res.x/u_res.y;',
      '  vec2 auv=vec2(uv.x*aspect, uv.y); float t=u_time*0.10;',
      '  vec2 a0=vec2(0.30*aspect+0.12*aspect*sin(t*0.9), 0.30+0.10*cos(t*1.1));',
      '  vec2 a1=vec2(0.78*aspect+0.10*aspect*cos(t*0.7+1.0), 0.66+0.12*sin(t*0.8+2.0));',
      '  vec2 a2=vec2(0.55*aspect+0.14*aspect*sin(t*0.5+3.0), 0.20+0.09*cos(t*1.3+0.5));',
      '  vec2 a3=vec2(0.20*aspect+0.09*aspect*cos(t*1.2+4.0), 0.80+0.08*sin(t*0.6+1.5));',
      '  vec2 am=vec2(u_mouse.x*aspect, u_mouse.y);',
      '  float w0=blob(auv,a0,0.55); float w1=blob(auv,a1,0.50);',
      '  float w2=blob(auv,a2,0.45); float w3=blob(auv,a3,0.42);',
      '  float wm=blob(auv,am,0.40)*u_active;',
      '  vec3 col=NAVY;',
      '  col=mix(col,DEEP,clamp(w0,0.0,1.0));',
      '  col=mix(col,BLUE,clamp(w1,0.0,1.0));',
      '  col=mix(col,BRIGHT,clamp(w2,0.0,1.0)*0.9);',
      '  col=mix(col,DEEP,clamp(w3,0.0,1.0)*0.7);',
      '  col=mix(col,ORANGE,clamp(wm,0.0,1.0)*0.55);',
      '  float vig=smoothstep(1.25,0.25,distance(uv,vec2(0.5)));',
      '  col*=mix(0.82,1.06,vig);',
      '  float g=fract(sin(dot(gl_FragCoord.xy,vec2(12.9898,78.233)))*43758.5453);',
      '  col+=(g-0.5)/255.0;',
      '  gl_FragColor=vec4(col,1.0);',
      '}'
    ].join('\n');

    function compile(type, src) { var s = gl.createShader(type); gl.shaderSource(s, src); gl.compileShader(s); return s; }
    var prog = gl.createProgram();
    gl.attachShader(prog, compile(gl.VERTEX_SHADER, vert));
    gl.attachShader(prog, compile(gl.FRAGMENT_SHADER, frag));
    gl.linkProgram(prog); gl.useProgram(prog);

    var buf = gl.createBuffer();
    gl.bindBuffer(gl.ARRAY_BUFFER, buf);
    gl.bufferData(gl.ARRAY_BUFFER, new Float32Array([-1, -1, 3, -1, -1, 3]), gl.STATIC_DRAW);
    var loc = gl.getAttribLocation(prog, 'p');
    gl.enableVertexAttribArray(loc);
    gl.vertexAttribPointer(loc, 2, gl.FLOAT, false, 0, 0);

    var uRes = gl.getUniformLocation(prog, 'u_res');
    var uTime = gl.getUniformLocation(prog, 'u_time');
    var uMouse = gl.getUniformLocation(prog, 'u_mouse');
    var uActive = gl.getUniformLocation(prog, 'u_active');

    var target = { x: 0.5, y: 0.5 }, cur = { x: 0.5, y: 0.5 };
    var activeTarget = 0, active = 0;

    function resize() {
      var dpr = Math.min(window.devicePixelRatio || 1, 2);
      var w = canvas.clientWidth, h = canvas.clientHeight;
      canvas.width = Math.max(1, Math.round(w * dpr));
      canvas.height = Math.max(1, Math.round(h * dpr));
      gl.viewport(0, 0, canvas.width, canvas.height);
    }
    resize();
    if (window.ResizeObserver) { new ResizeObserver(resize).observe(canvas); }
    else { window.addEventListener('resize', resize); }

    var sec = canvas.parentElement;
    sec.addEventListener('pointermove', function (e) {
      var r = sec.getBoundingClientRect();
      target.x = (e.clientX - r.left) / r.width;
      target.y = 1.0 - (e.clientY - r.top) / r.height;
      activeTarget = 1;
    });
    sec.addEventListener('pointerleave', function () { activeTarget = 0; });

    var reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    var start = performance.now();
    function render(now) {
      cur.x += (target.x - cur.x) * 0.06;
      cur.y += (target.y - cur.y) * 0.06;
      active += (activeTarget - active) * 0.05;
      var time = reduce ? 8.0 : (now - start) / 1000;
      gl.uniform2f(uRes, canvas.width, canvas.height);
      gl.uniform1f(uTime, time);
      gl.uniform2f(uMouse, cur.x, cur.y);
      gl.uniform1f(uActive, active);
      gl.drawArrays(gl.TRIANGLES, 0, 3);
      requestAnimationFrame(render);
    }
    requestAnimationFrame(render);
  }

  /* ---------------------------------------------------------
     Cal.com inline embed — initialises any [data-cal-inline]
     --------------------------------------------------------- */
  function initCal() {
    var slots = document.querySelectorAll('[data-cal-inline]');
    if (!slots.length) return;

    (function (C, A, L) {
      var p = function (a, ar) { a.q.push(ar); };
      var d = C.document;
      C.Cal = C.Cal || function () {
        var cal = C.Cal; var ar = arguments;
        if (!cal.loaded) { cal.ns = {}; cal.q = cal.q || []; d.head.appendChild(d.createElement('script')).src = A; cal.loaded = true; }
        if (ar[0] === L) {
          var api = function () { p(api, arguments); };
          var namespace = ar[1]; api.q = api.q || [];
          if (typeof namespace === 'string') { cal.ns[namespace] = cal.ns[namespace] || api; p(cal.ns[namespace], ar); p(cal, ['initNamespace', namespace]); }
          else p(cal, ar);
          return;
        }
        p(cal, ar);
      };
    })(window, 'https://app.cal.com/embed/embed.js', 'init');

    var darkVars = {
      'cal-brand': '#f29323', 'cal-bg': '#061C30', 'cal-bg-emphasis': '#0A2C49',
      'cal-bg-muted': '#061C30', 'cal-bg-subtle': '#0A2C49', 'cal-border': 'rgba(255,255,255,0.14)',
      'cal-border-emphasis': 'rgba(255,255,255,0.24)', 'cal-text': '#FFFFFF',
      'cal-text-emphasis': '#FFFFFF', 'cal-text-muted': '#B3D0E8'
    };

    slots.forEach(function (slot) {
      var ns = slot.getAttribute('data-cal-ns') || 'meeting';
      var link = slot.getAttribute('data-cal-link') || 'amatec/meeting';
      var theme = slot.getAttribute('data-cal-theme') === 'dark' ? 'dark' : 'light';
      window.Cal('init', ns, { origin: 'https://app.cal.com' });
      window.Cal.ns[ns]('inline', {
        elementOrSelector: '#' + slot.id,
        config: { layout: 'month_view', useSlotsViewOnSmallScreen: 'true', theme: theme },
        calLink: link
      });
      window.Cal.ns[ns]('ui', {
        theme: theme,
        cssVarsPerTheme: { light: { 'cal-brand': '#F29323' }, dark: darkVars },
        hideEventTypeDetails: true,
        layout: 'month_view'
      });
    });
  }

  /* ---------------------------------------------------------
     BLOG single — auto table of contents from H2 headings
     --------------------------------------------------------- */
  function initBlogToc() {
    var prose = document.querySelector('[data-prose]');
    var tocList = document.querySelector('[data-toc]');
    if (!prose || !tocList) return;

    var heads = prose.querySelectorAll('h2');
    if (!heads.length) {
      var tocWrap = tocList.closest('[data-toc-wrap]');
      if (tocWrap) tocWrap.style.display = 'none';
      return;
    }

    var slug = function (s) {
      return s.toLowerCase().replace(/[^\w\s-]/g, '').trim().replace(/\s+/g, '-').slice(0, 60);
    };
    var entries = [];
    heads.forEach(function (h, i) {
      if (!h.id) h.id = slug(h.textContent) || ('section-' + (i + 1));
      var n = String(i + 1).padStart(2, '0');
      var li = document.createElement('li');
      var a = document.createElement('a');
      a.href = '#' + h.id;
      a.innerHTML = '<span class="n">' + n + '</span><span>' + h.textContent + '</span>';
      a.addEventListener('click', function (e) {
        e.preventDefault();
        var t = document.getElementById(h.id);
        if (t) window.scrollTo({ top: t.getBoundingClientRect().top + window.pageYOffset - 90, behavior: 'smooth' });
      });
      li.appendChild(a);
      tocList.appendChild(li);
      entries.push({ id: h.id, link: a, el: h });
    });

    // scroll-spy
    var onScroll = function () {
      var pos = window.pageYOffset + 120;
      var current = entries[0];
      entries.forEach(function (en) { if (en.el.offsetTop <= pos) current = en; });
      entries.forEach(function (en) { en.link.classList.toggle('is-active', en === current); });
    };
    window.addEventListener('scroll', onScroll, { passive: true });
    onScroll();
  }

  /* ---------------------------------------------------------
     BLOG — "Request a call back" form → opens a prefilled email
     --------------------------------------------------------- */
  function initCallbackForm() {
    var form = document.querySelector('[data-callback-form]');
    if (!form) return;
    form.addEventListener('submit', function (e) {
      e.preventDefault();
      var to = form.getAttribute('data-mailto') || 'anirban@amatec.in';
      var get = function (n) { var f = form.elements[n]; return f ? f.value.trim() : ''; };
      var name = get('cb_name'), email = get('cb_email'), phone = get('cb_phone'), service = get('cb_service');
      var subject = 'Call back request' + (name ? ' from ' + name : '');
      var body = 'New call back request from the website:\n\n'
        + 'Name: ' + name + '\nWork Email: ' + email + '\nContact No.: ' + phone
        + '\n\nService required / message:\n' + service + '\n';
      window.location.href = 'mailto:' + to + '?subject=' + encodeURIComponent(subject) + '&body=' + encodeURIComponent(body);
      var note = form.querySelector('[data-callback-sent]');
      if (note) note.style.display = 'flex';
    });
  }

  /* ---------------------------------------------------------
     LANDING pages — FAQ accordion (single open, first open
     by default; answers are shown/hidden, not height-animated)
     --------------------------------------------------------- */
  function initLpFaq() {
    var faq = document.querySelector('[data-lp-faq]');
    if (!faq) return;
    var items = Array.prototype.slice.call(faq.querySelectorAll('.lp-faq-item'));
    items.forEach(function (item) {
      var btn = item.querySelector('.lp-faq-q');
      var answer = item.querySelector('.lp-faq-a');
      btn.addEventListener('click', function () {
        var wasOpen = item.classList.contains('open');
        items.forEach(function (other) {
          other.classList.remove('open');
          other.querySelector('.lp-faq-q').setAttribute('aria-expanded', 'false');
          other.querySelector('.lp-faq-a').hidden = true;
        });
        if (!wasOpen) {
          item.classList.add('open');
          btn.setAttribute('aria-expanded', 'true');
          answer.hidden = false;
        }
      });
    });
  }

  /* ---------------------------------------------------------
     CONTACT page — message form → POST to REST (store + email),
     then show the success panel ONLY on success.
     --------------------------------------------------------- */
  function initContactForm() {
    var form = document.querySelector('[data-contact-form]');
    if (!form) return;
    var card = form.closest('.cf-card');
    var sent = card ? card.querySelector('.cf-sent') : null;
    var err  = form.querySelector('.cf-error');
    var btn  = form.querySelector('[type="submit"]');
    var cfg  = window.AMATEC_CF || {};
    var get  = function (n) { var f = form.elements[n]; return f ? f.value.trim() : ''; };
    var showErr = function (m) { if (err) { err.textContent = m; err.hidden = false; } };

    form.addEventListener('submit', function (e) {
      e.preventDefault();
      if (err) err.hidden = true;

      var email = get('cf_email'), message = get('cf_message');
      if (!/^[^@\s]+@[^@\s]+\.[^@\s]+$/.test(email)) {
        showErr('Please enter a valid email so we can reply.'); return;
      }
      if (!message) {
        showErr('Tell us a little about the process you want to automate.'); return;
      }
      if (!cfg.url) {
        showErr('Form is not configured yet — please email hello@amatec.in directly.'); return;
      }

      var payload = {
        cf_name: get('cf_name'), cf_email: email, cf_company: get('cf_company'),
        cf_phone: get('cf_phone'), cf_interest: get('cf_interest'),
        cf_message: message, cf_website: get('cf_website')
      };
      var orig = btn ? btn.innerHTML : '';
      if (btn) { btn.disabled = true; btn.innerHTML = 'Sending…'; }

      fetch(cfg.url, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'X-WP-Nonce': cfg.nonce || '' },
        body: JSON.stringify(payload)
      })
        .then(function (r) { return r.json().then(function (d) { return { ok: r.ok, d: d }; }); })
        .then(function (res) {
          if (!res.ok) { throw new Error((res.d && res.d.message) || 'send failed'); }
          if (sent) {
            form.hidden = true;
            sent.hidden = false;
            if (window.lucide) window.lucide.createIcons();
          } else {
            form.reset();
          }
        })
        .catch(function () {
          showErr('Something went wrong sending your message. Please email hello@amatec.in directly.');
        })
        .then(function () { if (btn) { btn.disabled = false; btn.innerHTML = orig; } });
    });

    var again = card ? card.querySelector('[data-contact-again]') : null;
    if (again) again.addEventListener('click', function () {
      form.reset();
      form.hidden = false;
      if (sent) sent.hidden = true;
      if (err) err.hidden = true;
    });
  }

  /* ---------------------------------------------------------
     Newsletter subscribe (single-post sidebar) → POST to REST.
     --------------------------------------------------------- */
  function initNewsletter() {
    var form = document.querySelector('[data-newsletter-form]');
    if (!form) return;
    var msg = form.querySelector('.newsletter-msg');
    var btn = form.querySelector('[type="submit"]');
    var cfg = window.AMATEC_CF || {};
    var say = function (m, ok) {
      if (!msg) return;
      msg.textContent = m;
      msg.hidden = false;
      msg.style.color = ok ? 'var(--success, #15803d)' : 'var(--error, #b3261e)';
    };
    form.addEventListener('submit', function (e) {
      e.preventDefault();
      if (msg) msg.hidden = true;
      var emailEl = form.elements['ns_email'];
      var email = emailEl ? emailEl.value.trim() : '';
      if (!/^[^@\s]+@[^@\s]+\.[^@\s]+$/.test(email)) {
        say('Please enter a valid email address.', false); return;
      }
      if (!cfg.subscribe) {
        say('Subscriptions are not configured yet.', false); return;
      }
      var hp = form.elements['ns_website'];
      var orig = btn ? btn.innerHTML : '';
      if (btn) { btn.disabled = true; btn.innerHTML = '…'; }
      fetch(cfg.subscribe, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'X-WP-Nonce': cfg.nonce || '' },
        body: JSON.stringify({ ns_email: email, ns_website: hp ? hp.value : '', ns_source: location.href })
      })
        .then(function (r) { return r.json().then(function (d) { return { ok: r.ok, d: d }; }); })
        .then(function (res) {
          if (!res.ok) { throw new Error('failed'); }
          form.reset();
          say(res.d && res.d.already ? 'You are already subscribed — thank you!' : 'Thanks! You are on the list.', true);
        })
        .catch(function () { say('Something went wrong. Please try again.', false); })
        .then(function () { if (btn) { btn.disabled = false; btn.innerHTML = orig; } });
    });
  }

  /* ---------------------------------------------------------
     monday.com hero — board mockup, status pills cycle
     --------------------------------------------------------- */
  function initMondayBoard() {
    var board = document.querySelector('[data-monday-board]');
    if (!board) return;
    var ST = {
      work: { label: 'Working on it', c: '#FDAB3D' },
      done: { label: 'Done', c: '#00C875' },
      stuck: { label: 'Stuck', c: '#E2445C' }
    };
    var cells = Array.prototype.slice.call(board.querySelectorAll('.status'));
    var tick = 0;
    var paint = function () {
      cells.forEach(function (el) {
        var seq = (el.getAttribute('data-seq') || 'work').split(',');
        var off = parseInt(el.getAttribute('data-off') || '0', 10);
        var st = ST[seq[(tick + off) % seq.length]] || ST.work;
        el.textContent = st.label;
        el.style.backgroundColor = st.c;
      });
    };
    paint();
    if (window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;
    setInterval(function () { tick += 1; paint(); }, 1900);
  }

  /* ---------------------------------------------------------
     Zoho hero — Deluge editor typewriter (loops with a pause)
     --------------------------------------------------------- */
  function initZohoTyping() {
    var editor = document.querySelector('[data-zoho-code]');
    if (!editor) return;
    var lines = Array.prototype.slice.call(editor.querySelectorAll('.ln'));
    var tokens = [];
    lines.forEach(function (ln, li) {
      Array.prototype.slice.call(ln.querySelectorAll('.tok')).forEach(function (tok) {
        tokens.push({ el: tok, text: tok.getAttribute('data-text') || '', line: li });
      });
    });
    var total = tokens.reduce(function (a, t) { return a + t.text.length; }, 0) + lines.length;
    var caret = document.createElement('span');
    caret.className = 'zoho-caret';
    var render = function (typed) {
      var used = 0, caretTok = null;
      tokens.forEach(function (t) {
        var vis = Math.max(0, Math.min(typed - used, t.text.length));
        t.el.textContent = t.text.slice(0, vis);
        if (vis > 0 && vis <= t.text.length) caretTok = t;
        used += t.text.length;
      });
      if (caret.parentNode) caret.parentNode.removeChild(caret);
      if (typed < total && caretTok) caretTok.el.parentNode.appendChild(caret);
    };
    if (window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches) { render(total); return; }
    var t = 0;
    render(0);
    setInterval(function () {
      t = t + 1 > total + 70 ? 0 : t + 1;
      render(Math.min(t, total));
    }, 34);
  }

  /* ---------------------------------------------------------
     Boot
     --------------------------------------------------------- */
  function boot() {
    drawIcons();
    initNav();
    initScrollButtons();
    initStepper();
    initRevealSafety();
    initMeshGradient();
    initCal();
    initBlogToc();
    initCallbackForm();
    initLpFaq();
    initContactForm();
    initNewsletter();
    initMondayBoard();
    initZohoTyping();
  }
  if (document.readyState === 'loading') document.addEventListener('DOMContentLoaded', boot);
  else boot();
})();
