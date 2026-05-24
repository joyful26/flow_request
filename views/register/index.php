
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>FlowRquest</title>
  <link rel="preconnect" href="https://fonts.googleapis.com"/>
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;1,9..40,300&display=swap" rel="stylesheet"/>
  <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    :root {
      --purple: #6B3FD4; --purple-light: #8B5CF6; --purple-pale: #EDE9FE;
      --blue: #2563EB; --blue-light: #3B82F6; --blue-pale: #DBEAFE;
      --grad: linear-gradient(135deg, #6B3FD4 0%, #2563EB 100%);
      --grad-soft: linear-gradient(135deg, #EDE9FE 0%, #DBEAFE 100%);
      --gray-900: #1E1B2E; --gray-700: #374151; --gray-500: #6B7280;
      --gray-300: #D1D5DB; --gray-100: #F3F4F6; --white: #FFFFFF;
      --danger: #DC2626; --radius: 14px;
    }
    html, body { height: 100%; font-family: 'DM Sans', sans-serif; background: #F0EFFE; color: var(--gray-900); }
    body::before { content: ''; position: fixed; top: -200px; left: -200px; width: 600px; height: 600px; border-radius: 50%; background: radial-gradient(circle, rgba(107,63,212,0.15) 0%, transparent 70%); pointer-events: none; }
    body::after  { content: ''; position: fixed; bottom: -150px; right: -150px; width: 500px; height: 500px; border-radius: 50%; background: radial-gradient(circle, rgba(37,99,235,0.12) 0%, transparent 70%); pointer-events: none; }
    .page { height: 100vh;}

    
    .left-panel { background: var(--grad); display: flex; flex-direction: column; justify-content: center; align-items: center; padding: 60px 50px; position: relative; overflow: hidden; height: 100vh;}
    .left-panel { background: var(--grad); display: flex; flex-direction: column; justify-content: center; align-items: center; padding: 60px 50px; position: relative; overflow: hidden; }
    .left-panel::before { content: ''; position: absolute; top: -80px; right: -80px; width: 350px; height: 350px; border-radius: 50%; background: rgba(255,255,255,0.06); }
    .left-panel::after  { content: ''; position: absolute; bottom: -100px; left: -60px; width: 350px; height: 350px; border-radius: 50%; background: rgba(255,255,255,0.05); }
    
    .brand { display: flex; flex-direction: column; align-items: center; gap: 20px; z-index: 1; animation: fadeUp 0.7s ease both; }
    .logo-wrap { width: 150px; height: 150px; background: rgba(255,255,255,0.15); border-radius: 28px; display: flex; align-items: center; justify-content: center; backdrop-filter: blur(8px); border: 1.5px solid rgba(255,255,255,0.25); }
    .logo-wrap img { width: 100%; height: 100%; border-radius: 28px;}
    .brand-name { font-size: 2.4rem; font-weight: 300; color: white; letter-spacing: -0.5px; }
    .brand-name span { font-weight: 600; }
    .brand-tagline { font-size: 1rem; color: rgba(255,255,255,0.72); text-align: center; flex-wrap: wrap; line-height: 1.6; font-weight: 300; }
    .features { margin-top: 48px; display: flex; flex-direction: column; gap: 18px; z-index: 1; animation: fadeUp 0.7s 0.15s ease both; }
    .feat { display: flex; align-items: center; gap: 14px; color: rgba(255,255,255,0.88); font-size: 0.92rem; }
    .feat-icon { width: 36px; height: 36px; background: rgba(255,255,255,0.12); border-radius: 10px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; border: 1px solid rgba(255,255,255,0.18); }
    .feat-icon svg { width: 18px; height: 18px; stroke: white; fill: none; stroke-width: 2; stroke-linecap: round; stroke-linejoin: round; }

    .register-tabs { display: block; margin-bottom: 30px;  padding: 5px; border-radius: 12px; text-align: center; justify-content: center; align-items: center;}
    .register-tab { padding: 10px 16px;width: 100%; margin: 7px 0; border: none;  background: white; color: var(--blue); box-shadow: 0 2px 8px rgba(107,63,212,0.14); border-radius: 9px; font-family: 'DM Sans', sans-serif; font-size: 0.88rem; font-weight: 500;  cursor: pointer; display: flex; align-items: center; justify-content: center;  transition: all 0.22s ease; }
    .register-tab:hover{background: var(--grad); color: var(--white);}
    .register-tab svg { width: 20px; height: 20px; stroke: currentColor; fill: none; stroke-width: 2; stroke-linecap: round; stroke-linejoin: round; }
    a {text-decoration: none;}
    @keyframes fadeUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
    @keyframes spin { to { transform: rotate(360deg); } }

    @media (max-width: 768px) { .page { grid-template-columns: 1fr; } .left-panel { display: none; } .right-panel { padding: 40px 24px; } }
  </style>
</head>
<body>
<div class="page">

  <div class="left-panel">
    <div class="brand">
            <div class="logo-wrap">
              <img src="assets/logo.png" alt="">
            </div>
      <div style="text-align:center;">
        <div class="brand-name welcome"><span>Bienvenue sur</span></div>
        <div class="brand-name">Flow<span>Request</span> univ-ndere</div>
        <p class="brand-tagline">Gestion et suivi des requêtes étudiantes en toute simplicité</p>
      </div>
    </div>
    <div class="features">
      <div class="feat">
        <div class="feat-icon"><svg viewBox="0 0 24 24"><path d="M9 12l2 2 4-4"/><rect x="3" y="3" width="18" height="18" rx="2"/></svg></div>
        Soumettez vos requêtes en quelques clics
      </div>
      <div class="feat">
        <div class="feat-icon"><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><polyline points="12 7 12 12 15 15"/></svg></div>
        Suivez l'état de vos demandes en temps réel
      </div>
      <div class="feat">
        <div class="feat-icon"><svg viewBox="0 0 24 24"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg></div>
        Messagerie intégrée avec l'administration
      </div>
      <div class="feat">
        <div class="feat-icon"><svg viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg></div>
        Gérez vos dossiers et pièces jointes
      </div>
    </div>
    <div class="register-tabs" >
        <a href="connexion">
          <button class="register-tab active" >
            <svg viewBox="0 0 24 24"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/></svg>
            Se Connecter
          </button>
        </a>
        <a href="inscription">
          <button class="register-tab" >
            <svg viewBox="0 0 24 24"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/></svg>
            Créer un Compte
          </button>
        </a>
      </div>
  </div>
 
</div>

