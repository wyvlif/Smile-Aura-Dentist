<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>NEON DENTAL — Modern Dentistry</title>
  <meta name="description" content="A dark, modern dental clinic booking experience." />
  <style>
    :root {
      --bg: #071013;
      --panel: rgba(12, 25, 29, .82);
      --panel-2: #0d1c20;
      --line: rgba(126, 247, 218, .16);
      --text: #ecfffb;
      --muted: #91aaa9;
      --accent: #77f6d7;
      --accent-2: #b6ff78;
      --danger: #ff8096;
      --shadow: 0 0 0 1px rgba(119,246,215,.12), 0 20px 60px rgba(0,0,0,.32);
      --mono: "SFMono-Regular", "Roboto Mono", "Cascadia Code", monospace;
      --sans: Inter, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
    }
    * { box-sizing: border-box; }
    html { scroll-behavior: smooth; }
    body {
      margin: 0;
      background:
        radial-gradient(circle at 85% 5%, rgba(119,246,215,.11), transparent 28rem),
        radial-gradient(circle at 5% 30%, rgba(182,255,120,.05), transparent 24rem),
        var(--bg);
      color: var(--text);
      font-family: var(--sans);
      line-height: 1.5;
    }
    body::before {
      content: "";
      position: fixed;
      inset: 0;
      pointer-events: none;
      opacity: .16;
      background-image: linear-gradient(rgba(255,255,255,.025) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,.025) 1px, transparent 1px);
      background-size: 36px 36px;
      mask-image: linear-gradient(to bottom, black, transparent 85%);
    }
    a { color: inherit; text-decoration: none; }
    button, input, select, textarea { font: inherit; }
    button { cursor: pointer; }
    .container { width: min(1180px, calc(100% - 40px)); margin: 0 auto; }
    .mono { font-family: var(--mono); }
    .eyebrow { color: var(--accent); text-transform: uppercase; letter-spacing: .18em; font: 700 11px var(--mono); }
    .muted { color: var(--muted); }
    .topbar { border-bottom: 1px solid var(--line); background: rgba(7,16,19,.72); backdrop-filter: blur(18px); position: sticky; top: 0; z-index: 10; }
    .nav { min-height: 72px; display: flex; align-items: center; justify-content: space-between; gap: 20px; }
    .brand { display:flex; align-items:center; gap: 11px; font-weight: 800; letter-spacing: .08em; }
    .brand-mark { width: 35px; height: 35px; border: 1px solid var(--accent); color: var(--accent); display:grid; place-items:center; border-radius: 50%; box-shadow: 0 0 24px rgba(119,246,215,.32); font-size: 18px; }
    .nav-links { display:flex; align-items:center; gap: 22px; color: var(--muted); font-size: 14px; }
    .nav-links a:hover { color: var(--accent); }
    .btn { border: 0; border-radius: 8px; padding: 12px 18px; color: #04100e; background: var(--accent); font-weight: 800; transition: transform .2s, box-shadow .2s, background .2s; }
    .btn:hover { transform: translateY(-2px); box-shadow: 0 10px 28px rgba(119,246,215,.2); }
    .btn.secondary { background: transparent; color: var(--accent); border: 1px solid var(--accent); }
    .btn.ghost { background: rgba(119,246,215,.06); color: var(--text); border: 1px solid var(--line); }
    .hero { padding: 96px 0 68px; display: grid; grid-template-columns: 1.1fr .9fr; gap: 50px; align-items:center; }
    h1 { font-size: clamp(46px, 8vw, 86px); line-height: .94; letter-spacing: -.065em; margin: 18px 0 26px; max-width: 760px; }
    h1 span { color: var(--accent); text-shadow: 0 0 28px rgba(119,246,215,.35); }
    h2 { font-size: clamp(30px, 4vw, 48px); line-height: 1; letter-spacing: -.04em; margin: 10px 0 18px; }
    h3 { margin: 0 0 7px; }
    .hero-copy { max-width: 580px; color: var(--muted); font-size: 17px; }
    .actions { display:flex; gap: 12px; flex-wrap: wrap; margin: 30px 0; }
    .terminal {
      border: 1px solid var(--line); background: linear-gradient(145deg, rgba(12,36,38,.94), rgba(8,19,22,.92));
      border-radius: 14px; padding: 21px; box-shadow: var(--shadow); position: relative; overflow: hidden;
    }
    .terminal::after { content:""; position:absolute; width:220px; height:220px; border-radius:50%; background: rgba(119,246,215,.14); filter: blur(50px); right:-90px; bottom:-100px; }
    .terminal-head { display:flex; align-items:center; justify-content:space-between; color: var(--muted); font-size: 12px; margin-bottom: 16px; }
    .dots { display:flex; gap:6px; } .dots i { width:8px; height:8px; border-radius:50%; background:var(--accent); opacity:.8; } .dots i:nth-child(2){background:#b6ff78}.dots i:nth-child(3){background:#ff8096}
    .code-area { width:100%; min-height: 270px; background: rgba(0,0,0,.22); color: var(--accent); border: 1px solid rgba(119,246,215,.12); border-radius: 9px; padding: 16px; resize: vertical; outline: none; font: 13px/1.65 var(--mono); }
    section { padding: 76px 0; }
    .section-head { display:flex; justify-content:space-between; align-items:end; gap: 20px; margin-bottom: 30px; }
    .section-head p { max-width: 460px; color: var(--muted); margin:0; }
    .stats { display:grid; grid-template-columns: repeat(4,1fr); border-top:1px solid var(--line); border-bottom:1px solid var(--line); }
    .stat { padding: 25px 18px; border-right:1px solid var(--line); } .stat:last-child{border:0}
    .stat strong { display:block; font-size: 29px; color:var(--accent); }
    .stat small { color:var(--muted); }
    .cards { display:grid; grid-template-columns: repeat(3,1fr); gap:16px; }
    .card { background:var(--panel); border:1px solid var(--line); border-radius:12px; padding:22px; box-shadow:0 12px 40px rgba(0,0,0,.16); transition:transform .25s, border-color .25s; }
    .card:hover { transform:translateY(-5px); border-color:rgba(119,246,215,.48); }
    .service-icon { color:var(--accent); font-size:28px; margin-bottom: 26px; }
    .card p { color:var(--muted); margin-bottom:0; }
    .gallery { display:grid; grid-template-columns: 1.2fr .8fr .8fr; grid-auto-rows: 180px; gap: 12px; }
    .gallery .photo { border-radius:12px; border:1px solid var(--line); background-size:cover; background-position:center; overflow:hidden; position:relative; }
    .gallery .photo:first-child { grid-row: span 2; background-image: linear-gradient(135deg, rgba(3,18,19,.1), rgba(3,18,19,.75)), url("https://images.unsplash.com/photo-1606811971618-4486d14f3f99?auto=format&fit=crop&w=1000&q=80"); }
    .gallery .photo:nth-child(2) { background-image: linear-gradient(135deg, rgba(3,18,19,.1), rgba(3,18,19,.7)), url("https://images.unsplash.com/photo-1588776814546-1ffcf47267a5?auto=format&fit=crop&w=800&q=80"); }
    .gallery .photo:nth-child(3) { background-image: linear-gradient(135deg, rgba(3,18,19,.1), rgba(3,18,19,.7)), url("https://images.unsplash.com/photo-1550831107-1553da8c8464?auto=format&fit=crop&w=800&q=80"); }
    .gallery .photo:nth-child(4) { background-image: linear-gradient(135deg, rgba(3,18,19,.1), rgba(3,18,19,.7)), url("https://images.unsplash.com/photo-1609840114035-3c981b782dfe?auto=format&fit=crop&w=800&q=80"); }
    .gallery .photo:nth-child(5) { background-image: linear-gradient(135deg, rgba(3,18,19,.1), rgba(3,18,19,.7)), url("https://images.unsplash.com/photo-1598256989800-fe5f95da9787?auto=format&fit=crop&w=800&q=80"); }
    .photo label { position:absolute; left:14px; bottom:12px; font: 12px var(--mono); color:var(--text); }
    .testimonial { display:flex; flex-direction:column; min-height: 190px; }
    .stars { color:var(--accent-2); letter-spacing: .15em; }
    .quote { font-size: 18px; margin: 16px 0; flex:1; }
    .person { display:flex; justify-content:space-between; color:var(--muted); font-size:13px; }
    .contact-grid { display:grid; grid-template-columns: .9fr 1.1fr; gap: 20px; }
    .contact-list { display:grid; gap: 12px; }
    .contact-item { border:1px solid var(--line); padding:16px; border-radius:10px; background:rgba(12,25,29,.66); }
    .contact-item strong { display:block; color:var(--accent); font: 12px var(--mono); text-transform:uppercase; letter-spacing:.14em; margin-bottom:5px; }
    .map { min-height: 310px; border-radius: 12px; border:1px solid var(--line); display:grid; place-items:center; text-align:center; padding:24px; background: linear-gradient(135deg, rgba(119,246,215,.1), rgba(7,16,19,.7)), radial-gradient(circle at 50% 45%, rgba(119,246,215,.25) 0 2px, transparent 3px), repeating-radial-gradient(circle at 50% 45%, transparent 0 33px, rgba(119,246,215,.12) 34px 35px); }
    footer { padding: 28px 0 44px; color:var(--muted); border-top:1px solid var(--line); }
    .modal-backdrop { display:none; position:fixed; inset:0; z-index:30; background:rgba(0,0,0,.72); backdrop-filter:blur(10px); padding:20px; overflow:auto; }
    .modal-backdrop.open { display:grid; place-items:center; animation:fade .25s ease; }
    .modal { width:min(760px,100%); background:#0b1b1f; border:1px solid rgba(119,246,215,.3); border-radius:16px; box-shadow: 0 30px 100px rgba(0,0,0,.6); padding:25px; animation:rise .3s ease; }
    .modal-top { display:flex; justify-content:space-between; align-items:start; margin-bottom: 22px; }
    .close { background:transparent; color:var(--muted); border:0; font-size:26px; }
    .form-grid { display:grid; grid-template-columns: repeat(2,1fr); gap: 14px; }
    label { color:var(--muted); font: 12px var(--mono); text-transform:uppercase; letter-spacing:.1em; }
    input, select { width:100%; margin-top:7px; background:#071013; border:1px solid var(--line); border-radius:8px; color:var(--text); padding:12px; outline:none; }
    input:focus, select:focus { border-color:var(--accent); box-shadow:0 0 0 3px rgba(119,246,215,.08); }
    .full { grid-column:1/-1; }
    .slot-grid { display:grid; grid-template-columns:repeat(4,1fr); gap:8px; margin-top:8px; }
    .slot { border:1px solid var(--line); color:var(--muted); background:transparent; padding:10px 5px; border-radius:7px; font-size:12px; }
    .slot.selected, .slot:hover { color:#03100e; background:var(--accent); border-color:var(--accent); }
    .modal-foot { display:flex; justify-content:space-between; gap:14px; align-items:center; margin-top:20px; }
    .status { padding:11px 13px; border-radius:8px; color:var(--accent); background:rgba(119,246,215,.08); font: 12px var(--mono); }
    .dashboard { display:none; }
    .dashboard.active { display:block; }
    .dash-grid { display:grid; grid-template-columns: 1fr 1fr; gap:16px; }
    .appointment-row { display:grid; grid-template-columns: 1.3fr 1fr .9fr .8fr; gap:10px; align-items:center; padding:14px 0; border-bottom:1px solid var(--line); font-size:13px; }
    .pill { border:1px solid var(--line); color:var(--accent); border-radius:99px; padding:4px 8px; font-size:11px; width:max-content; }
    .empty { color:var(--muted); padding:18px 0; }
    .toast { position:fixed; right:20px; bottom:20px; z-index:50; padding:14px 17px; border:1px solid var(--accent); background:#0b2424; color:var(--text); border-radius:9px; box-shadow:0 10px 35px rgba(0,0,0,.4); transform:translateY(130%); transition:transform .3s; }
    .toast.show { transform:translateY(0); }
    @keyframes fade { from{opacity:0} to{opacity:1} } @keyframes rise { from{transform:translateY(20px);opacity:0} to{transform:none;opacity:1} }

    /* Small add-ons: retain the original visual language */
    .floating-actions{position:fixed;right:20px;bottom:20px;z-index:25;display:grid;gap:10px}
    .float-btn{width:48px;height:48px;border-radius:50%;display:grid;place-items:center;border:1px solid var(--line);background:#0d2425;color:var(--accent);box-shadow:var(--shadow);font-size:21px;transition:transform .2s,box-shadow .2s}
    .float-btn:hover{transform:translateY(-3px);box-shadow:0 12px 30px rgba(0,0,0,.4)}
    .float-btn.whatsapp{background:#123b2d;color:#8fffc0;border-color:rgba(143,255,192,.35)}
    .chat-panel{display:none;position:fixed;right:20px;bottom:132px;width:min(360px,calc(100vw - 40px));height:450px;max-height:65vh;z-index:26;background:#0b1b1f;border:1px solid rgba(119,246,215,.3);border-radius:14px;box-shadow:0 25px 70px rgba(0,0,0,.55);overflow:hidden;flex-direction:column}
    .chat-panel.open{display:flex;animation:rise .2s ease}
    .chat-head{padding:14px 16px;background:rgba(119,246,215,.07);border-bottom:1px solid var(--line);display:flex;justify-content:space-between;align-items:center}
    .chat-messages{padding:14px;overflow:auto;flex:1;display:flex;flex-direction:column;gap:10px}
    .chat-msg{max-width:88%;padding:10px 12px;border:1px solid var(--line);border-radius:10px;background:rgba(119,246,215,.06);font-size:13px;white-space:pre-wrap}
    .chat-msg.user{align-self:flex-end;background:rgba(119,246,215,.15);color:var(--text)}
    .chat-form{display:flex;gap:8px;padding:12px;border-top:1px solid var(--line)}
    .chat-form input{margin:0;min-width:0}
    .chat-form button{padding:0 14px}
    .chat-note{font-size:10px;color:var(--muted);padding:0 14px 10px}
    .login-modal{width:min(420px,100%)}
    .staff-link{color:var(--muted);font:12px var(--mono);text-decoration:underline;text-underline-offset:4px}
    .staff-link:hover{color:var(--accent)}
    .status-select{width:100%;min-width:105px;margin:0;padding:7px 8px;font-size:11px}
    #staffLogout{white-space:nowrap}
    @media(max-width:560px){.floating-actions{right:14px;bottom:14px}.chat-panel{right:14px;bottom:122px;width:calc(100vw - 28px)}}

    @media(max-width: 850px) { .hero, .contact-grid { grid-template-columns:1fr; } .cards { grid-template-columns:1fr 1fr; } .stats { grid-template-columns:1fr 1fr; } .stat:nth-child(2){border-right:0} .stat:nth-child(-n+2){border-bottom:1px solid var(--line)} .gallery { grid-template-columns:1fr 1fr; } .gallery .photo:first-child { grid-row:span 1; } .nav-links { display:none; } }
    @media(max-width: 560px) { .container{width:min(100% - 28px,1180px)} .cards, .dash-grid, .form-grid { grid-template-columns:1fr; } .full{grid-column:auto} h1{font-size:53px} .gallery { grid-template-columns:1fr; grid-auto-rows:180px; } .gallery .photo:first-child { grid-row:span 1; } .section-head{display:block} .appointment-row { grid-template-columns:1fr 1fr; } }
  </style>
</head>
<body>
  <header class="topbar">
    <div class="container nav">
      <a class="brand" href="#home"><span class="brand-mark">✦</span><span>SMILE AURA DENTIST</span></a>
      <nav class="nav-links"><a href="#services">Services</a><a href="#gallery">Gallery</a><a href="#about">About</a><a href="#contact">Contact</a></nav>
      <button class="btn" data-open-booking>Book appointment</button>
    </div>
  </header>

  <main>
    <section id="home" class="container hero">
      <div>
        <div class="eyebrow">precision dentistry / Kigali</div>
        <h1>Dental care,<br><span>re-imagined.</span></h1>
        <p class="hero-copy">A calm, high-tech dental studio for people who want exceptional care without the clinical coldness. Clear plans, modern tools, better smiles.</p>
        <div class="actions"><button class="btn" data-open-booking>Find my appointment</button><a class="btn secondary" href="#about">Explore the studio</a></div>
        <div class="mono muted">OPEN TODAY · 08:00—20:00 · (250) 787-575-201</div>
      </div>
      <div class="terminal">
        <div class="terminal-head"><span class="mono">/patient-console/live</span><span class="dots"><i></i><i></i><i></i></span></div>
        <textarea class="code-area" aria-label="Live patient console" spellcheck="false" readonly>STATUS: accepting new patients
NEXT AVAILABLE: see live slot picker
CARE MODE: gentle + precise
REMINDER: SMS / EMAIL enabled

> Your smile is the interface.
> Let's make it feel like you.</textarea>
        <div class="terminal-head" style="margin:14px 0 0"><span class="next-slot">calculating...</span><span class="eyebrow">online</span></div>
      </div>
    </section>

    <div class="container stats">
      <div class="stat"><strong>98%</strong><small>patients recommend us</small></div>
      <div class="stat"><strong>4.9/5</strong><small>average experience score</small></div>
      <div class="stat"><strong>24h</strong><small>appointment confirmation</small></div>
      <div class="stat"><strong>0%</strong><small>judgement, ever</small></div>
    </div>

    <section id="services" class="container">
      <div class="section-head"><div><div class="eyebrow">what we do</div><h2>Care that feels<br>like an upgrade.</h2></div><p>From your first scan to your final polish, every appointment is designed around comfort, clarity, and long-term health.</p></div>
      <div class="cards">
        <article class="card"><div class="service-icon">◈</div><h3>Preventive care</h3><p>Cleanings, exams, digital X-rays, and a simple plan to keep small things small.</p></article>
        <article class="card"><div class="service-icon">◌</div><h3>Cosmetic studio</h3><p>Whitening, bonding, and veneers that look like your smile — just more confident.</p></article>
        <article class="card"><div class="service-icon">△</div><h3>Restorative care</h3><p>Thoughtful crowns, implants, and emergency support built for everyday life.</p></article>
      </div>
    </section>

    <section id="gallery" class="container">
      <div class="section-head"><div><div class="eyebrow">inside the studio</div><h2>Bright work.<br>Quiet rooms.</h2></div><p>Minimal surroundings let our team focus on the detail that matters — you.</p></div>
      <div class="gallery"><div class="photo"><label>01 / treatment room</label></div><div class="photo"><label>02 / consultation</label></div><div class="photo"><label>03 / team</label></div><div class="photo"><label>04 / precision</label></div><div class="photo"><label>05 / aftercare</label></div></div>
    </section>

    <section id="about" class="container">
      <div class="section-head"><div><div class="eyebrow">the human side</div><h2>Technology is cool.<br>Care is warmer.</h2></div><p>SMILE AURA DENTIST was built by clinician who wanted to make the dentist and patient feel less like a stressed/anxious and more like a reset.</p></div>
      <div class="cards"><article class="card"><h3>Meet Dentist Wiclif Hirwa</h3><p>Cool General dentist, lifelong learner, and believer in explaining the “why” before the “what.”</p></article><article class="card"><h3>Our promise</h3><p>Transparent pricing, no surprise procedures, and a reminder before every visit so your calendar stays in control.</p></article><article class="card"><h3>Our neighborhood</h3><p>Find us at KG 180 St (intersection of KG 180 St and KG 107 St), Remera, KIGALI. Two minutes from Zigama CSS HQ, one step from a better routine.</p></article></div>
    </section>

    <section class="container">
      <div class="section-head"><div><div class="eyebrow">patient notes</div><h2>Good things,<br>said by humans.</h2></div></div>
      <div class="cards"><article class="card testimonial"><div class="stars">★★★★★</div><div class="quote">“The first appointment where I didn’t feel rushed or talked over. The whole team is excellent.”</div><div class="person"><span>Jordan R.</span><span>check-up</span></div></article><article class="card testimonial"><div class="stars">★★★★★</div><div class="quote">“The reminders are actually helpful, and the clinic feels like a design studio. My teeth look amazing.”</div><div class="person"><span>Alex P.</span><span>cosmetic</span></div></article><article class="card testimonial"><div class="stars">★★★★★</div><div class="quote">“Clear pricing, gentle hands, zero judgement. I finally found my dentist.”</div><div class="person"><span>Sam T.</span><span>restorative</span></div></article></div>
    </section>

    <section id="contact" class="container">
      <div class="section-head"><div><div class="eyebrow">come say hi</div><h2>We are easy<br>to find.</h2></div><p>Open Monday through Sunday. New patients are always welcome.</p></div>
      <div class="contact-grid"><div class="contact-list"><div class="contact-item"><strong>Location</strong>180 Kimironko Street, KG<br>KIGALI, KG 180 St</div><div class="contact-item"><strong>Contact</strong>(250) 787-575-201<br>wiclifclinic@gmail.com</div><div class="contact-item"><strong>Hours</strong>Mon–Fri 08:00–20:00<br>Sun 08:00–20:00</div></div><div class="map"><div><div class="eyebrow">live location</div><h3>KGL / REMERA</h3><p class="muted">24R8+H75, Kigali, Rwanda </p><button class="btn ghost" onclick="window.open('https://maps.app.goo.gl/cwr59uxMeFJ1Wy4t6','_blank')">Open in maps ↗</button></div></div></div>
    </section>

    <section id="dashboard" class="container dashboard">
      <div class="section-head"><div><div class="eyebrow">internal console</div><h2>Operations<br>dashboard.</h2></div><p>Private appointment queue for authorized clinic staff.</p><button class="btn secondary" type="button" id="staffLogout">Sign out</button></div>
      <div class="dash-grid">
        <div class="card"><div class="eyebrow">admin / queue</div><h3>All appointments</h3><div id="adminList"></div></div>
        <div class="card"><div class="eyebrow">dentist / today</div><h3>Clinical schedule</h3><div id="dentistList"></div></div>
      </div>
      <div class="card" style="margin-top:16px"><div class="eyebrow">automation / reminder log</div><h3>Patient notification stream</h3><div id="reminderLog" class="mono muted"></div></div>
    </section>
  </main>

  <footer><div class="container" style="display:flex;justify-content:space-between;gap:15px;flex-wrap:wrap"><span>© 2026 SMILE AURA DENTIST</span><span class="mono">care / clarity / confidence</span><a class="staff-link" href="#staff-login" onclick="event.preventDefault();openStaffLogin()">staff portal →</a></div></footer>

  <div class="modal-backdrop" id="bookingModal">
    <div class="modal">
      <div class="modal-top"><div><div class="eyebrow">new patient booking</div><h2>Choose your moment.</h2><p class="muted">We will confirm your visit and schedule a reminder for the day before.</p></div><button class="close" data-close-booking>×</button></div>
      <form id="bookingForm">
        <div class="form-grid">
          <label>Full name<input name="name" placeholder="Alex Morgan" required /></label>
          <label>Mobile number<input name="phone" type="tel" placeholder="+250 780 000 000" required /></label>
          <label>Email<input name="email" type="email" placeholder="alex@email.com" required /></label>
          <label>Visit type<select name="service"><option>New patient exam</option><option>Cleaning + check-up</option><option>Orthodontic treatment consultation</option><option>Cosmetic consultation</option><option>Emergency visit</option></select></label>
          <label>Date<input name="date" type="date" required /></label>
          <div class="full"><label>Available time slot</label><div id="slots" class="slot-grid"></div><input type="hidden" name="time" id="selectedTime" required /></div>
          <label class="full">Reminder channel<select name="reminder"><option>SMS</option><option>Gmail</option></select></label>
        </div>
        <div class="modal-foot"><span id="formStatus" class="status">Pick a slot to continue</span><button class="btn" type="submit">Confirm appointment →</button></div>
      </form>
    </div>
  </div>

  <div class="floating-actions" aria-label="Quick contact">
    <a class="float-btn whatsapp" id="whatsappLink" href="https://wa.me/250787575201?text=Hello%20Smile%20Aura%20Dentist%2C%20I%20would%20like%20to%20make%20an%20inquiry." target="_blank" rel="noopener" aria-label="Chat with Smile Aura Dentist on WhatsApp" title="WhatsApp"> <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640"><!--!Font Awesome Free v7.3.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2026 Fonticons, Inc.--><path fill="rgb(116, 192, 252)" d="M476.9 161.1C435 119.1 379.2 96 319.9 96C197.5 96 97.9 195.6 97.9 318C97.9 357.1 108.1 395.3 127.5 429L96 544L213.7 513.1C246.1 530.8 282.6 540.1 319.8 540.1L319.9 540.1C442.2 540.1 544 440.5 544 318.1C544 258.8 518.8 203.1 476.9 161.1zM319.9 502.7C286.7 502.7 254.2 493.8 225.9 477L219.2 473L149.4 491.3L168 423.2L163.6 416.2C145.1 386.8 135.4 352.9 135.4 318C135.4 216.3 218.2 133.5 320 133.5C369.3 133.5 415.6 152.7 450.4 187.6C485.2 222.5 506.6 268.8 506.5 318.1C506.5 419.9 421.6 502.7 319.9 502.7zM421.1 364.5C415.6 361.7 388.3 348.3 383.2 346.5C378.1 344.6 374.4 343.7 370.7 349.3C367 354.9 356.4 367.3 353.1 371.1C349.9 374.8 346.6 375.3 341.1 372.5C308.5 356.2 287.1 343.4 265.6 306.5C259.9 296.7 271.3 297.4 281.9 276.2C283.7 272.5 282.8 269.3 281.4 266.5C280 263.7 268.9 236.4 264.3 225.3C259.8 214.5 255.2 216 251.8 215.8C248.6 215.6 244.9 215.6 241.2 215.6C237.5 215.6 231.5 217 226.4 222.5C221.3 228.1 207 241.5 207 268.8C207 296.1 226.9 322.5 229.6 326.2C232.4 329.9 268.7 385.9 324.4 410C359.6 425.2 373.4 426.5 391 423.9C401.7 422.3 423.8 410.5 428.4 397.5C433 384.5 433 373.4 431.6 371.1C430.3 368.6 426.6 367.2 421.1 364.5z"/></svg> </a>
    <button class="float-btn" type="button" id="chatToggle" aria-label="Open dental assistant" title="Dental assistant"> <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640"><!--!Font Awesome Free v7.3.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2026 Fonticons, Inc.--><path fill="rgb(116, 192, 252)" d="M241 69.7L320 96L399 69.7C410.3 65.9 422 64 433.9 64C494.7 64 544 113.3 544 174.1L544 242.6C544 272 534.5 300.7 516.8 324.2L515.7 325.7C502.8 342.9 494.4 363.1 491.4 384.4L469.7 535.9C466.4 558.9 446.7 576 423.5 576C400.7 576 381.2 559.5 377.5 537L357.3 415.6C354.3 397.4 338.5 384 320 384C301.5 384 285.8 397.4 282.7 415.6L262.5 537C258.7 559.5 239.3 576 216.5 576C193.3 576 173.6 558.9 170.3 535.9L148.6 384.5C145.6 363.2 137.2 343 124.3 325.8L123.2 324.3C105.5 300.7 96 272.1 96 242.7L96 174.2C96 113.3 145.3 64 206.1 64C218 64 229.7 65.9 241 69.7z"/></svg></button>
  </div>
  <aside class="chat-panel" id="chatPanel" aria-label="Dental FAQ assistant">
    <div class="chat-head"><div><div class="eyebrow">SMILE AURA / ASSISTANT</div><strong>How can I help?</strong></div><button class="close" id="chatClose" aria-label="Close assistant">×</button></div>
    <div class="chat-messages" id="chatMessages" aria-live="polite"><div class="chat-msg">Hello! I can help with common dental questions and appointments. What would you like to know?</div></div>
    <form class="chat-form" id="chatForm"><input id="chatInput" autocomplete="off" placeholder="Ask a dental question..." aria-label="Your question" required><button class="btn" type="submit">Send</button></form>
    <div class="chat-note">General information only — this assistant cannot diagnose. For pain, swelling or urgent concerns, contact the clinic.</div>
  </aside>
  <div class="modal-backdrop" id="staffLoginModal">
    <div class="modal login-modal">
      <div class="modal-top"><div><div class="eyebrow">restricted access</div><h2>Staff sign in.</h2><p class="muted">Authorized clinic personnel only.</p></div><button class="close" type="button" onclick="closeStaffLogin()">×</button></div>
      <form id="staffLoginForm">
        <label>Username<input name="username" autocomplete="username" required></label>
        <label style="display:block;margin-top:14px">Password<input name="password" type="password" autocomplete="current-password" required></label>
        <p id="staffLoginStatus" class="muted" style="font-size:12px">Staff authentication must be configured on the clinic server.</p>
        <button class="btn" style="width:100%;margin-top:8px" type="submit">Sign in securely →</button>
      </form>
    </div>
  </div>
  <div class="toast" id="toast"></div>
  <script>
    const slots = ["08:30", "09:45", "11:00", "13:30", "15:00", "16:15", "17:30", "18:15"];
    const $ = (s) => document.querySelector(s);
    const all = (s) => [...document.querySelectorAll(s)];
    let csrfToken = "";
    let staffUser = null;
    let appointmentsCache = [];
    const todayISO = () => { const d = new Date(); const local = new Date(d.getTime()-d.getTimezoneOffset()*60000); return local.toISOString().slice(0,10); };
    const tomorrowISO = () => { const d = new Date(); d.setDate(d.getDate()+1); const local = new Date(d.getTime()-d.getTimezoneOffset()*60000); return local.toISOString().slice(0,10); };
    const prettyDate = (iso) => new Date(iso+"T12:00:00").toLocaleDateString(undefined,{weekday:"short",month:"short",day:"numeric"});
    const escapeHTML = (value) => String(value ?? "").replace(/[&<>"']/g, c => ({"&":"&amp;","<":"&lt;",">":"&gt;",'"':"&quot;","'":"&#39;"}[c]));
    const showToast = (msg) => { const t=$("#toast"); t.textContent=msg; t.classList.add("show"); setTimeout(()=>t.classList.remove("show"), 3800); };
    async function getCsrf(){
      const response=await fetch("backend/csrf.php",{credentials:"same-origin",cache:"no-store"});
      const result=await response.json(); if(!response.ok || !result.csrfToken) throw new Error("Could not start a secure session.");
      csrfToken=result.csrfToken; return csrfToken;
    }
    async function apiFetch(url, options={}){
      if(!csrfToken && (options.method||"GET").toUpperCase()!=="GET") await getCsrf();
      const headers={...(options.headers||{})};
      if(options.body && !headers["Content-Type"]) headers["Content-Type"]="application/json";
      if((options.method||"GET").toUpperCase()!=="GET") headers["X-CSRF-Token"]=csrfToken;
      const response=await fetch(url,{...options,headers,credentials:"same-origin",cache:"no-store"});
      let result={}; try{result=await response.json();}catch(e){}
      if(!response.ok) throw new Error(result.message||"The request could not be completed.");
      return result;
    }
    function openBooking(){ $("#bookingModal").classList.add("open"); renderSlots(); }
    function closeBooking(){ $("#bookingModal").classList.remove("open"); }
    all("[data-open-booking]").forEach(b=>b.addEventListener("click",openBooking));
    all("[data-close-booking]").forEach(b=>b.addEventListener("click",closeBooking));
    $("#bookingModal").addEventListener("click",e=>{if(e.target.id==="bookingModal")closeBooking()});

    async function renderSlots(){
      const dateInput=$("#bookingForm input[name=date]");
      const date=dateInput.value||tomorrowISO(); dateInput.value=date;
      $("#slots").innerHTML='<span class="muted">Checking available times…</span>';
      $("#selectedTime").value="";
      try{
        const result=await fetch(`backend/booking_slots.php?date=${encodeURIComponent(date)}`,{credentials:"same-origin",cache:"no-store"}).then(r=>r.json());
        if(!result.availableSlots) throw new Error(result.message||"Availability could not be loaded.");
        if(!result.availableSlots.length){$("#slots").innerHTML='<span class="muted">No available times for this date. Please choose another date.</span>';return;}
        $("#slots").innerHTML=result.availableSlots.map(time=>`<button type="button" class="slot available" data-time="${escapeHTML(time)}">${escapeHTML(time)}</button>`).join("");
        all(".slot.available").forEach(btn=>btn.addEventListener("click",()=>{
          all(".slot").forEach(slot=>slot.classList.remove("selected")); btn.classList.add("selected");
          $("#selectedTime").value=btn.dataset.time; $("#formStatus").textContent=`${prettyDate(date)} at ${btn.dataset.time} selected`;
        }));
      }catch(error){$("#slots").innerHTML=`<span class="muted">${escapeHTML(error.message)} Check that the database is installed.</span>`;}
    }
    $("#bookingForm input[name=date]").min=todayISO();
    $("#bookingForm input[name=date]").addEventListener("change",renderSlots);
    $("#bookingForm").addEventListener("submit",async e=>{
      e.preventDefault();
      const form=e.currentTarget; const data=Object.fromEntries(new FormData(form).entries());
      if(!data.time){$("#formStatus").textContent="Please choose an available slot";return;}
      const submit=form.querySelector('button[type="submit"]'); submit.disabled=true; submit.textContent="Saving appointment…";
      try{
        const result=await apiFetch("backend/create_appointment.php",{method:"POST",body:JSON.stringify(data)});
        closeBooking(); form.reset(); $("#selectedTime").value=""; $("#formStatus").textContent="Pick a slot to continue";
        showToast(`Request ${result.appointment.reference} received. The clinic will confirm your appointment.`);
        if(staffUser) await loadAppointments();
      }catch(error){$("#formStatus").textContent=error.message; showToast(error.message); await renderSlots();}
      finally{submit.disabled=false; submit.textContent="Confirm appointment →";}
    });

    function appointmentRow(a, canEdit){
      const statusControl=canEdit
        ? `<select class="status-select" aria-label="Update appointment status" data-status-id="${Number(a.id)}"><option value="pending" ${a.status==='pending'?'selected':''}>Pending</option><option value="confirmed" ${a.status==='confirmed'?'selected':''}>Confirmed</option><option value="completed" ${a.status==='completed'?'selected':''}>Completed</option><option value="cancelled" ${a.status==='cancelled'?'selected':''}>Cancelled</option></select>`
        : `<span class="pill">${escapeHTML(a.status)}</span>`;
      return `<div class="appointment-row"><div><strong>${escapeHTML(a.name)}</strong><br><span class="muted">${escapeHTML(a.service)}</span><br><small class="muted">${escapeHTML(a.phone)}</small></div><div>${prettyDate(a.date)}<br><span class="mono muted">${escapeHTML(String(a.time).slice(0,5))}</span></div><div>${statusControl}</div><div class="muted">${escapeHTML(a.reminder||'—')}</div></div>`;
    }
    async function loadAppointments(){
      const result=await apiFetch("backend/appointments.php"); appointmentsCache=result.appointments||[]; staffUser=result.staff||staffUser;
      const canEdit=['admin','receptionist'].includes(staffUser?.role);
      $("#adminList").innerHTML=appointmentsCache.length?appointmentsCache.map(a=>appointmentRow(a,canEdit)).join(""):'<div class="empty">No appointments yet. The queue is clear.</div>';
      const today=appointmentsCache.filter(a=>a.date===todayISO());
      $("#dentistList").innerHTML=today.length?today.map(a=>appointmentRow(a,canEdit)).join(""):'<div class="empty">No visits today. A quiet chair is a good chair.</div>';
      $("#reminderLog").textContent=`Signed in as ${staffUser?.username||'staff'} (${staffUser?.role||'staff'}). Appointment records are stored centrally in the clinic database.`;
      $("#dashboard").classList.add("active");
      $("#dashboard").scrollIntoView({behavior:"smooth"});
    }
    async function updateAppointmentStatus(id,status){
      try{await apiFetch("backend/appointments.php",{method:"PATCH",body:JSON.stringify({id:Number(id),status})}); showToast("Appointment status updated."); await loadAppointments();}
      catch(error){showToast(error.message); await loadAppointments();}
    }
    document.addEventListener("change",e=>{if(e.target.matches("[data-status-id]")) updateAppointmentStatus(e.target.dataset.statusId,e.target.value);});

    // WhatsApp remains a direct link using the clinic contact number already published on the site.
    const clinicWhatsApp="250787575201";
    const waText="Hello Smile Aura Dentist, I would like to make an inquiry. How can you help me today?";
    $("#whatsappLink").href=`https://wa.me/${clinicWhatsApp}?text=${encodeURIComponent(waText)}`;

    // Dental assistant: uses the server endpoint when an API key is configured; FAQ fallback remains available.
    const chatPanel=$("#chatPanel");
    $("#chatToggle").addEventListener("click",()=>chatPanel.classList.toggle("open"));
    $("#chatClose").addEventListener("click",()=>chatPanel.classList.remove("open"));
    function addChatMessage(text,who="bot"){
      const el=document.createElement("div"); el.className=`chat-msg ${who==="user"?"user":""}`; el.textContent=text;
      $("#chatMessages").appendChild(el); $("#chatMessages").scrollTop=$("#chatMessages").scrollHeight;
    }
    function dentalReply(q){
      const t=q.toLowerCase();
      if(/book|appointment|visit|schedule/.test(t)) return "You can book online using the “Book appointment” button. Choose a date and an available time slot, then submit your details. Would you like to open the booking form?";
      if(/pain|toothache|ache/.test(t)) return "Tooth pain can have several causes and needs a dental assessment. Avoid placing aspirin directly on the tooth. If pain is severe, contact the clinic promptly; facial swelling, fever, or difficulty swallowing or breathing needs urgent in-person care.";
      if(/bleed|gum/.test(t)) return "Bleeding gums can be associated with gum inflammation. Brush gently twice daily with fluoride toothpaste and clean between teeth. Arrange a dental examination if bleeding persists.";
      if(/brush|clean|hygiene/.test(t)) return "Brush twice daily for two minutes using fluoride toothpaste, clean between your teeth daily, and limit frequent sugary snacks and drinks. Regular dental check-ups help detect problems early.";
      if(/braces|orthodont/.test(t)) return "Orthodontic treatment can correct crowding and bite problems. Suitability and treatment duration depend on an examination and appropriate records. Book an orthodontic consultation for an individual plan.";
      if(/whiten|yellow|stain/.test(t)) return "Tooth colour can be affected by stains, restorations and natural tooth shade. A dentist should assess the cause before whitening; avoid unregulated whitening products.";
      if(/scaling|cleaning/.test(t)) return "Professional scaling removes hardened deposits that brushing cannot remove. The dentist or hygienist can advise how often you need it based on your gum health.";
      if(/price|cost|fee/.test(t)) return "Treatment fees depend on the examination and procedure required. Please contact reception on WhatsApp for current pricing or book a consultation.";
      return "I can share general information about brushing, gum health, tooth pain, cleaning, whitening, braces and appointments. For a personal diagnosis or treatment recommendation, please book an examination with the dentist.";
    }
    $("#chatForm").addEventListener("submit",async e=>{
      e.preventDefault(); const input=$("#chatInput"); const question=input.value.trim(); if(!question)return;
      addChatMessage(question,"user"); input.value="";
      try{
        const result=await fetch("backend/chat.php",{method:"POST",headers:{"Content-Type":"application/json"},body:JSON.stringify({message:question}),credentials:"same-origin"}).then(async r=>{const j=await r.json();if(!r.ok)throw new Error(j.message||"Assistant unavailable");return j;});
        addChatMessage(result.reply||dentalReply(question));
      }catch(error){addChatMessage(dentalReply(question));}
      if(/book|appointment|visit|schedule/i.test(question)){
        const action=document.createElement("button"); action.type="button"; action.className="btn"; action.textContent="Book an appointment";
        action.addEventListener("click",()=>{chatPanel.classList.remove("open");openBooking();}); $("#chatMessages").appendChild(action);
      }
    });

    function openStaffLogin(){ $("#staffLoginModal").classList.add("open"); }
    function closeStaffLogin(){ $("#staffLoginModal").classList.remove("open"); }
    window.openStaffLogin=openStaffLogin; window.closeStaffLogin=closeStaffLogin;
    $("#staffLoginForm").addEventListener("submit",async e=>{
      e.preventDefault(); const form=e.currentTarget; const status=$("#staffLoginStatus"); const submit=form.querySelector('button[type="submit"]');
      status.textContent="Verifying credentials…"; submit.disabled=true;
      const credentials=Object.fromEntries(new FormData(form).entries());
      try{
        await getCsrf();
        const result=await apiFetch("backend/staff_login.php",{method:"POST",body:JSON.stringify(credentials)});
        staffUser=result.staff; csrfToken=result.csrfToken||csrfToken; form.reset(); closeStaffLogin(); await loadAppointments();
      }catch(error){status.textContent=error.message||"Sign-in failed. Check your credentials or contact the system administrator.";}
      finally{submit.disabled=false;}
    });
    $("#staffLoginModal").addEventListener("click",e=>{if(e.target.id==="staffLoginModal")closeStaffLogin();});
    $("#staffLogout").addEventListener("click",async()=>{
      try{await apiFetch("backend/staff_logout.php",{method:"POST",body:JSON.stringify({})});}catch(e){}
      staffUser=null; appointmentsCache=[]; $("#dashboard").classList.remove("active"); showToast("You have been signed out.");
    });

    // Restore an existing server-side staff session after a page refresh.
    (async()=>{
      try{await getCsrf();const response=await fetch("backend/staff_me.php",{credentials:"same-origin",cache:"no-store"});if(response.ok){const result=await response.json();staffUser=result.staff;csrfToken=result.csrfToken||csrfToken;await loadAppointments();}}
      catch(e){/* Public website remains usable even if the staff API is not configured yet. */}
      const nextDate=tomorrowISO(); $("#bookingForm input[name=date]").value=nextDate; await renderSlots();
      $(".next-slot").textContent=`${prettyDate(nextDate)} / ${slots[0]}`;
    })();
  </script>
</body>
</html>




