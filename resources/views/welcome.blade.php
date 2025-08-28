<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>อบต.DEMO</title>
  <!-- Google Font for Thai -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@300;400;600;700&display=swap" rel="stylesheet">
  <style>
    :root{
      /* 👉 Replace the URL below with your image path. Example: url('introweb.jpg') */
      --bg-image: url('https://images.unsplash.com/photo-1502082553048-f009c37129b9?q=80&w=2060&auto=format&fit=crop');
      --brand-1: #1a3a8a;  /* deep blue */
      --brand-2: #c8102e;  /* red */
      --brand-3: #ffffff;  /* white */
      --glow: rgba(255, 233, 138, 0.55);
    }

    *{box-sizing:border-box}
    html,body{height:100%}
    body{
      margin:0; font-family:'Noto Sans Thai', system-ui, -apple-system, Segoe UI, Roboto, 'Helvetica Neue', Arial, "Noto Sans", "Liberation Sans", sans-serif;
      background: #001d52;
      color:#fff; overflow:hidden;
    }

    /* --- Fullscreen container --- */
    .hero{
      position:relative; width:100%; height:100%;
      display:grid; place-items:center;
      isolation:isolate; /* allow overlays */
    }

    /* Background image with slow Ken-Burns zoom */
    .hero::before{
      content:""; position:absolute; inset:0; z-index:-3;
      background-image: var(--bg-image);
      background-size: cover; background-position:center;
      filter: saturate(0.9) contrast(1.05);
      transform: scale(1.05);
      animation: kenburns 40s ease-in-out infinite alternate;
    }

    /* Dark blue overlay */
    .hero::after{
      content:""; position:absolute; inset:0; z-index:-2;
      background: radial-gradient(100% 60% at 50% 70%, rgba(0,0,0,0.25) 0%, rgba(0,0,0,0.65) 55%, rgba(0,0,0,0.8) 100%),
                  linear-gradient(180deg, rgba(7,26,74,0.2) 0%, rgba(7,26,74,0.9) 100%);
    }

    @keyframes kenburns{
      0%{transform:scale(1.05) translateY(0)}
      100%{transform:scale(1.15) translateY(-1.5%)}
    }

    /* Floating particles (soft fireflies/birds) */
    .particle{ position:absolute; width:6px; height:6px; border-radius:50%; background:rgba(255,255,255,.8); box-shadow:0 0 10px 3px rgba(255,255,255,.65); opacity:.8;}
    @keyframes floatUp{
      0%{ transform:translateY(20vh) translateX(0); opacity:0 }
      10%{ opacity:.8 }
      100%{ transform:translateY(-85vh) translateX(var(--drift, 60px)); opacity:0 }
    }

    /* Center stage content */
    .stage{ position:relative; max-width:1100px; padding:2rem; text-align:center; z-index:5;}

    .title{ font-weight:700; font-size:clamp(1.1rem, 1.2rem + 1.4vw, 2.2rem); line-height:1.45; text-shadow:0 2px 20px rgba(0,0,0,.6); margin-bottom:0.75rem;}
    .subtitle{ font-weight:400; font-size:clamp(.95rem, .9rem + .6vw, 1.35rem); opacity:.95; text-shadow:0 2px 14px rgba(0,0,0,.65); }

    /* Ground glow */
    .glow{
      position:absolute; left:50%; bottom:18vh; transform:translateX(-50%);
      width:min(900px, 78vw); height:160px; border-radius:50%;
      background: radial-gradient(50% 70% at 50% 50%, var(--glow) 0%, rgba(255,244,161,0.25) 50%, rgba(255,244,161,0.08) 70%, rgba(255,244,161,0) 100%);
      filter: blur(18px); opacity:.7; z-index:1;
      animation: glowPulse 7s ease-in-out infinite;
    }
    @keyframes glowPulse{ 0%,100%{opacity:.55; transform:translateX(-50%) scale(1)} 50%{opacity:.9; transform:translateX(-50%) scale(1.05)} }

    
    /* CTA button */
    .cta{
      position:relative; display:inline-flex; align-items:center; justify-content:center; gap:.75rem;
      margin-top:2.2rem; padding:1rem 1.75rem; border:none; cursor:pointer; text-decoration:none;
      font-weight:700; font-size:1.1rem; letter-spacing:.2px; border-radius:999px; color:#051038; background:#fff;
      box-shadow:0 10px 20px rgba(0,0,0,.35), 0 0 0 4px rgba(255,255,255,.06) inset;
      transition: transform .15s ease, box-shadow .2s ease, background .2s ease;
    }
    .cta small{ display:block; font-weight:700; font-size:.78rem; color:#0b2c8a; opacity:.85; }
    .cta:hover{ transform:translateY(-2px); box-shadow:0 14px 28px rgba(0,0,0,.45), 0 0 0 4px rgba(255,255,255,.12) inset; }
    .cta:active{ transform:translateY(0) scale(.99) }

    /* Optional: press ripple */
    .cta:focus-visible{ outline:3px solid rgba(255,255,255,.55); outline-offset:4px }

    /* Footer note */
    .org{ position:absolute; bottom:2rem; width:100%; text-align:center; opacity:.9; font-weight:600; letter-spacing:.2px;}

    /* Responsive tweaks */
    @media (max-width:520px){
      .glow{ bottom:14vh }
    }
  </style>
</head>
<body>
  <main class="hero" role="main" aria-label="Intro">

    <!-- Soft floating particles -->
    <script>
      // create some floating lights
      const makeParticles = () => {
        const root = document.querySelector('.hero');
        const total = 26;
        for(let i=0;i<total;i++){
          const p = document.createElement('span');
          p.className = 'particle';
          p.style.left = Math.random()*100 + 'vw';
          p.style.bottom = (-10 + Math.random()*20) + 'vh';
          p.style.setProperty('--drift', (Math.random()*140 - 70) + 'px');
          const d = 12 + Math.random()*24; // duration seconds
          p.style.animation = `floatUp ${d}s linear ${Math.random()*d}s infinite`;
          root.appendChild(p);
        }
      }
      addEventListener('DOMContentLoaded', makeParticles);
    </script>

    <div class="stage">
      <h1 class="title">ขอเป็นกำลังใจให้แก่พี่น้องประชาชนและเจ้าหน้าที่ผู้เสียสละในพื้นที่</h1>
      <p class="subtitle">พวกเราขอร่วมส่งความห่วงใยและอยู่เคียงข้างทุกท่าน<br>เพื่อคลี่คลายสถานการณ์ให้กลับสู่ภาวะปกติโดยเร็ว</p>

      <div class="glow" aria-hidden="true"></div>

      <!-- CTA: Replace href with your login URL -->
      <a class="cta" href="/home">
        <div>
          <small>อบต.DEMO</small>
          เข้าสู่เว็บไซต์
        </div>
      </a>
    </div>

    <div class="org">อบต.DEMO จังหวัดDEMO</div>
  </main>
</body>
</html>
