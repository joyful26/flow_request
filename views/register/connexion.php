<?php

 if(isset($_POST) && !empty($_POST)){

 
        if(isset($_POST["matricule"], $_POST["mdp"]) && !empty($_POST["matricule"]) && !empty($_POST["mdp"])){
          
            $mdp = strip_tags($_POST["mdp"]);
          
            $matricule = strip_tags($_POST["matricule"]);
            $matricule = strtolower($matricule);
           
            $util = $this->Register->verifMat($matricule);
            if($util){
              
            if(password_verify($mdp, $util['mdp']))
              {
                
                $_SESSION['etudiant'] = [
                      "nom" => $util['nom'],
                      "prenom" => $util['prenom'],
                      "matricule" => $matricule,
                      "email" => $util['email']
                ];
                
                header("Location: DashbordEtudiant/");
                exit;
            
              }else{
                echo "Nous rencontrons des difficultés pour la connexion à votre compte. veillez vérifier les infos de connexion";
              }
                 
            }else{
           
              echo "Nous rencontrons des difficultés pour la connexion à votre compte. veillez réessayer plutard ou vérifier les infos de connexion";
            
            }
            
        }else if(isset($_POST["email"], $_POST["mdp"]) && !empty($_POST["email"]) && !empty($_POST["mdp"])){
            $mdp = strip_tags($_POST["mdp"]);
            
            if(filter_var(strip_tags($_POST["email"]), FILTER_VALIDATE_EMAIL)) {
                $email = strip_tags($_POST["email"]);
            }else{
                echo"L'addresse Email n'est pas au bon format";
            }
      

            $util = $this->Register->verifEmail($email);
            if($util){
                if(password_verify($mdp, $util['mdp']))
                {
                  echo"welcome admin";
                  $_SESSION['admin'] = [
                        "nom" => $util['nom'],
                        "prenom" => $util['prenom'],
                        "email" => $email,
                        "id" => $util['id_admin']
                  ];
                  header("Location: DashbordAdmin/");
                  exit;

                }else{
                  echo "Nous rencontrons des difficultés pour la connexion à votre compte. veillez vérifier les infos de connexion";
                  $mdp = password_hash($mdp, PASSWORD_BCRYPT);
                  var_dump($mdp);
                }
            }else{
              echo "Nous rencontrons des difficultés pour la connexion à votre compte. veillez réessayer plutard ou vérifier les infos de connexion";
            }
        }else{
          echo "Remplir tous les champs";
        }
        
 }       
    


?>

<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>FlowreQuest — Connexion</title>
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
    .page { min-height: 100vh; display: grid; grid-template-columns: 1fr 1.8fr; }


    .left-panel { background: var(--grad); display: flex; flex-direction: column; justify-content: center; align-items: center; padding: 60px 50px; position: relative; overflow: hidden; }
    .left-panel::before { content: ''; position: absolute; top: -80px; right: -80px; width: 300px; height: 300px; border-radius: 50%; background: rgba(255,255,255,0.06); }
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
    
    .right-panel { display: flex; flex-direction: column; justify-content: center; align-items: center; height: 100%;padding: 60px 50px; background: white; }
    .card { width: 100%; max-width: 420px; animation: fadeUp 0.6s 0.1s ease both; }
    .card-header { margin-bottom: 36px; }
    .card-header h1 { font-size: 1.75rem; font-weight: 600; color: var(--gray-900); letter-spacing: -0.4px; margin-bottom: 6px; }
    .card-header p { font-size: 0.92rem; color: var(--gray-500); font-weight: 300; }

    
    .role-tabs { display: grid; grid-template-columns: 1fr 1fr; gap: 8px; margin-bottom: 30px; background: var(--gray-100); padding: 5px; border-radius: 12px; }
    .role-tab { padding: 10px 16px; border: none; background: transparent; border-radius: 9px; font-family: 'DM Sans', sans-serif; font-size: 0.88rem; font-weight: 500; color: var(--gray-500); cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 7px; transition: all 0.22s ease; }
    .role-tab svg { width: 16px; height: 16px; stroke: currentColor; fill: none; stroke-width: 2; stroke-linecap: round; stroke-linejoin: round; }
    .role-tab.active { background: white; color: var(--purple); box-shadow: 0 2px 8px rgba(107,63,212,0.14); }
    
    .register-tabs { display: block; margin-bottom: 30px;  padding: 5px; border-radius: 12px; text-align: center; justify-content: center; align-items: center;}
    .register-tab { padding: 10px 16px;width: 100%; margin: 7px 0; border: none;  background: white; color: var(--blue); box-shadow: 0 2px 8px rgba(107,63,212,0.14); border-radius: 9px; font-family: 'DM Sans', sans-serif; font-size: 0.88rem; font-weight: 500;  cursor: pointer; display: flex; align-items: center; justify-content: center;  transition: all 0.22s ease; }
    .register-tab:hover{background: var(--grad); color: var(--white);}
    .register-tab svg { width: 20px; height: 20px; stroke: currentColor; fill: none; stroke-width: 2; stroke-linecap: round; stroke-linejoin: round; }
    a {text-decoration: none;}

    
    .form-group { margin-bottom: 18px; }
    label { display: block; font-size: 0.82rem; font-weight: 500; color: var(--gray-700); margin-bottom: 7px; letter-spacing: 0.2px; }
    .input-wrap { position: relative; }
    .input-icon { position: absolute; left: 14px; top: 50%; transform: translateY(-50%); width: 17px; height: 17px; stroke: var(--gray-300); fill: none; stroke-width: 2; stroke-linecap: round; stroke-linejoin: round; transition: stroke 0.2s; pointer-events: none; }
    input[type="text"], input[type="email"], input[type="password"] { width: 100%; padding: 12px 14px 12px 42px; border: 1.5px solid var(--gray-300); border-radius: 10px; font-family: 'DM Sans', sans-serif; font-size: 0.92rem; color: var(--gray-900); background: white; outline: none; transition: border-color 0.2s, box-shadow 0.2s; }
    input:focus { border-color: var(--purple-light); box-shadow: 0 0 0 3px rgba(139,92,246,0.12); }
    .input-wrap:focus-within .input-icon { stroke: var(--purple); }
    .eye-btn { position: absolute; right: 13px; top: 50%; transform: translateY(-50%); background: none; border: none; cursor: pointer; padding: 4px; color: var(--gray-300); display: flex; align-items: center; transition: color 0.2s; }
    .eye-btn:hover { color: var(--purple); }
    .eye-btn svg { width: 17px; height: 17px; stroke: currentColor; fill: none; stroke-width: 2; stroke-linecap: round; stroke-linejoin: round; }

    
    .error-msg { display: none; align-items: center; gap: 7px; background: #FEF2F2; border: 1px solid #FECACA; border-radius: 9px; padding: 11px 14px; font-size: 0.84rem; color: var(--danger); margin-bottom: 18px; }
    .error-msg.show { display: flex; }
    .error-msg svg { width: 16px; height: 16px; stroke: var(--danger); fill: none; stroke-width: 2; stroke-linecap: round; stroke-linejoin: round; flex-shrink: 0; }

    
    .extras { display: flex; align-items: center; justify-content: space-between; margin-bottom: 26px; }
    .remember { display: flex; align-items: center; gap: 8px; font-size: 0.84rem; color: var(--gray-500); cursor: pointer; user-select: none; }
    .remember input[type="checkbox"] { width: 16px; height: 16px; padding: 0; accent-color: var(--purple); cursor: pointer; }
    .forgot { font-size: 0.84rem; color: var(--purple); text-decoration: none; font-weight: 500; }
    .forgot:hover { text-decoration: underline; }

    
    .btn-submit { width: 100%; padding: 13px; background: var(--grad); color: white; border: none; border-radius: 11px; font-family: 'DM Sans', sans-serif; font-size: 0.96rem; font-weight: 600; cursor: pointer; letter-spacing: 0.2px; display: flex; align-items: center; justify-content: center; gap: 8px; transition: opacity 0.2s, transform 0.15s; }
    .btn-submit:hover { opacity: 0.92; transform: translateY(-1px); }
    .btn-submit:active { transform: translateY(0); }
    .btn-submit .spinner { display: none; width: 18px; height: 18px; border: 2.5px solid rgba(255,255,255,0.4); border-top-color: white; border-radius: 50%; animation: spin 0.7s linear infinite; }
    .btn-submit.loading .spinner { display: block; }
    .btn-submit.loading .btn-text { opacity: 0.6; }

    
    .divider { display: flex; align-items: center; gap: 12px; margin: 24px 0 20px; color: var(--gray-300); font-size: 0.78rem; }
    .divider::before, .divider::after { content: ''; flex: 1; height: 1px; background: var(--gray-300); }

    
    .card-footer { text-align: center; font-size: 0.82rem; color: var(--gray-500); margin-top: 6px; }
    .badge-secure { display: inline-flex; align-items: center; gap: 5px; background: var(--grad-soft); color: var(--purple); font-size: 0.76rem; font-weight: 500; padding: 5px 12px; border-radius: 20px; margin-top: 20px; }
    .badge-secure svg { width: 13px; height: 13px; stroke: var(--purple); fill: none; stroke-width: 2; stroke-linecap: round; stroke-linejoin: round; }

    
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
       
        <a href="inscription">
          <button class="register-tab" >
            <svg viewBox="0 0 24 24"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/></svg>
            Créer un Compte
          </button>
        </a>
      </div>
  </div>
<!--partie du formulaire-->
  <div class="right-panel">
    
    <div class="card">
      <div class="card-header">
        <h1>Bon retour 👋</h1>
        <p>Connectez-vous à votre espace personnel</p>
      </div>

      <div class="role-tabs" role="tablist">
        <button class="role-tab active" id="tab-etudiant" onclick="switchRole('etudiant')" role="tab">
          <svg viewBox="0 0 24 24"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/></svg>
          Étudiant
        </button>
        <button class="role-tab" id="tab-admin" onclick="switchRole('admin')" role="tab">
          <svg viewBox="0 0 24 24"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/></svg>
          Administrateur
        </button>
      </div>

      <div class="error-msg" id="errorMsg">
        <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
        <span id="errorText">Identifiants incorrects. Veuillez réessayer.</span>
      </div>

      <form id="loginForm" action="" method="POST" novalidate>
        <input type="hidden" name="role" id="roleInput" value="etudiant"/>

        <div class="form-group" id="fieldMatricule">
          <label for="matricule">Matricule</label>
          <div class="input-wrap">
            <input type="text" id="matricule" name="matricule" placeholder="Ex : 22B000FS" autocomplete="username"/>
            <svg class="input-icon" viewBox="0 0 24 24"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 7V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v2"/></svg>
          </div>
        </div>

        <div class="form-group" id="fieldEmail" style="display:none;">
          <label for="email">Adresse e-mail</label>
          <div class="input-wrap">
            <input type="email" id="email" name="email" placeholder="admin@universite.cm" autocomplete="email"/>
            <svg class="input-icon" viewBox="0 0 24 24"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
          </div>
        </div>

        <div class="form-group">
          <label for="password">Mot de passe</label>
          <div class="input-wrap">
            <input type="password" id="password" name="mdp" placeholder="••••••••" autocomplete="current-password"/>
            <svg class="input-icon" viewBox="0 0 24 24"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
            <button type="button" class="eye-btn" onclick="togglePwd()" aria-label="Afficher/masquer">
              <svg id="eyeIcon" viewBox="0 0 24 24"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
            </button>
          </div>
        </div>

        

        <button type="submit" class="btn-submit" id="submitBtn">
          <div class="spinner"></div>
          <span class="btn-text">Se connecter</span>
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
        </button>
      </form>

      <div class="card-footer">
        <div class="badge-secure">
          <svg viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
          Connexion sécurisée — données chiffrées
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  function switchRole(role) {
    const isAdmin = role === 'admin';
    document.getElementById('roleInput').value = role;
    document.getElementById('tab-etudiant').classList.toggle('active', !isAdmin);
    document.getElementById('tab-admin').classList.toggle('active', isAdmin);
    document.getElementById('fieldMatricule').style.display = isAdmin ? 'none' : 'block';
    document.getElementById('fieldEmail').style.display = isAdmin ? 'block' : 'none';
    hideError();
  }

  const eyeOpen   = `<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>`;
  const eyeClosed = `<path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94"/><path d="M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19"/><line x1="1" y1="1" x2="23" y2="23"/>`;
  let pwdVisible = false;
  function togglePwd() {
    pwdVisible = !pwdVisible;
    document.getElementById('password').type = pwdVisible ? 'text' : 'password';
    document.getElementById('eyeIcon').innerHTML = pwdVisible ? eyeClosed : eyeOpen;
  }

  document.getElementById('loginForm').addEventListener('submit', function(e) {
    e.preventDefault();
    hideError();
    const role  = document.getElementById('roleInput').value;
    const pwd   = document.getElementById('password').value.trim();
    const ident = role === 'admin'
      ? document.getElementById('email').value.trim()
      : document.getElementById('matricule').value.trim();
    if (!ident || !pwd) { showError('Veuillez remplir tous les champs.'); return; }
    const btn = document.getElementById('submitBtn');
    btn.classList.add('loading'); btn.disabled = true;
    setTimeout(() => this.submit(), 800);
  });

  function showError(msg) {
    document.getElementById('errorText').textContent = msg;
    document.getElementById('errorMsg').classList.add('show');
  }
  function hideError() { document.getElementById('errorMsg').classList.remove('show'); }

  const params = new URLSearchParams(window.location.search);
  if (params.get('error') === '1') showError('Identifiants incorrects. Veuillez réessayer.');
  if (params.get('error') === '2') showError('Compte désactivé. Contactez l\'administration.');
</script>