<?php

 if(isset($_POST) && !empty($_POST)){

 
        if(isset($_POST["nom"], $_POST["prenom"], $_POST["matricule"], $_POST["contact"], $_POST["niveau"], $_POST["filiere"], $_POST["email"], $_POST["mdp"], $_POST["cycle"] )
          && $_POST["nom"] && !empty($_POST["prenom"]) && !empty($_POST["matricule"]) && !empty($_POST["contact"]) && !empty($_POST["niveau"]) && !empty($_POST["filiere"]) && !empty($_POST["email"]) && !empty($_POST["mdp"]) && !empty($_POST["cycle"])){
          
            $mdp = strip_tags($_POST["mdp"]);
            $mdp = password_hash($mdp, PASSWORD_BCRYPT);

            $nom = strip_tags($_POST["nom"]);
            $prenom = strip_tags($_POST["prenom"]);
            $matricule = strip_tags($_POST["matricule"]);
            $niveau = strip_tags($_POST["niveau"]);
            $filiere = strip_tags($_POST["filiere"]);
            $cycle = strip_tags($_POST["cycle"]);
              
            if(filter_var(strip_tags($_POST["email"]), FILTER_VALIDATE_EMAIL)) {
                $email = strip_tags($_POST["email"]);
            }else{
                echo"L'addresse Email n'est pas au bon format";exit;
            }
            if(filter_var(strip_tags($_POST["contact"]), FILTER_VALIDATE_INT)) {
                $contact = strip_tags($_POST["contact"]);
            }else{
                echo"Le contact n'est pas au bon format";exit;
            }
                      
            
            $donnees = [
              "nom" => $nom,
              "prenom" => $nom,
              "matricule" => $matricule,
              "email" => $email,
              "contact" => $contact,
              "niveau" => $niveau,
              "id_cycle" => $cycle,
              "id_filiere" => $filiere,
              "mdp" => $mdp
            ];
            
            

            $util = $this->Register->verifMat($matricule);
            if(!$util){

                $this->Register->insertionEtudiant($donnees);

                $_SESSION['etudiant'] = [
                  "nom" => $nom,
                  "prenom" => $nom,
                  "matricule" => $matricule,
                  "email" => $email,
                ];
                
                header("Location: DashbordEtudiant/");
                exit;
            
            }else{
              echo "Nous rencontrons des difficultés pour la création de votre compte. veillez réessayer plutard";
            }
            
            
        }else{
          echo "Remplir tous les champs";
        }
        
 }       
    


?>

<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>FlowreQuest — Inscription</title>
  <link rel="preconnect" href="https://fonts.googleapis.com"/>
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:opsz,wght@9..40,300;9..40,400;9..40,500;9..40,600&display=swap" rel="stylesheet"/>
  <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    :root {
      --purple: #6B3FD4; --purple-light: #8B5CF6; --purple-pale: #EDE9FE;
      --blue: #2563EB; --blue-light: #3B82F6; --blue-pale: #DBEAFE;
      --grad: linear-gradient(135deg, #6B3FD4 0%, #2563EB 100%);
      --grad-soft: linear-gradient(135deg, #EDE9FE 0%, #DBEAFE 100%);
      --gray-900: #1E1B2E; --gray-700: #374151; --gray-500: #6B7280;
      --gray-300: #D1D5DB; --gray-100: #F3F4F6; --white: #FFFFFF;
      --danger: #DC2626; --success: #16A34A;
    }
    html, body { min-height: 100%; font-family: 'DM Sans', sans-serif; background: #F0EFFE; color: var(--gray-900); }
    body::before { content:''; position:fixed; top:-200px; left:-200px; width:600px; height:600px; border-radius:50%; background:radial-gradient(circle,rgba(107,63,212,0.13) 0%,transparent 70%); pointer-events:none; }
    body::after  { content:''; position:fixed; bottom:-150px; right:-150px; width:500px; height:500px; border-radius:50%; background:radial-gradient(circle,rgba(37,99,235,0.10) 0%,transparent 70%); pointer-events:none; }

    
    .page { min-height:100vh; display:grid; grid-template-columns:1fr 1.6fr; }

    .register-tabs { display: block; margin-bottom: 30px;  padding: 5px; border-radius: 12px; text-align: center; justify-content: center; align-items: center;}
    .register-tab { padding: 10px 16px;width: 100%; margin: 7px 0; border: none;  background: white; color: var(--blue); box-shadow: 0 2px 8px rgba(107,63,212,0.14); border-radius: 9px; font-family: 'DM Sans', sans-serif; font-size: 0.88rem; font-weight: 500;  cursor: pointer; display: flex; align-items: center; justify-content: center;  transition: all 0.22s ease; }
    .register-tab:hover{background: var(--grad); color: var(--white);}
    .register-tab svg { width: 20px; height: 20px; stroke: currentColor; fill: none; stroke-width: 2; stroke-linecap: round; stroke-linejoin: round; }
    a {text-decoration: none;}

    .left-panel { background:var(--grad); display:flex; flex-direction:column; justify-content:center; align-items:center; padding:60px 44px; position:relative; overflow:hidden; }
    .left-panel::before { content:''; position:absolute; top:-80px; right:-80px; width:300px; height:300px; border-radius:50%; background:rgba(255,255,255,0.06); }
    .left-panel::after  { content:''; position:absolute; bottom:-100px; left:-60px; width:350px; height:350px; border-radius:50%; background:rgba(255,255,255,0.05); }
    .brand { display:flex; flex-direction:column; align-items:center; gap:18px; z-index:1; animation:fadeUp 0.7s ease both; }
    .logo-wrap { width: 150px; height: 150px; background: rgba(255,255,255,0.15); border-radius: 28px; display: flex; align-items: center; justify-content: center; backdrop-filter: blur(8px); border: 1.5px solid rgba(255,255,255,0.25); }
    .logo-wrap svg { width:60px; height:60px; }
    .logo-wrap img { width: 100%; height: 100%; border-radius: 28px;}
    .brand-name { font-size:2.1rem; font-weight:300; color:white; letter-spacing:-0.5px; text-align:center; }
    .brand-name span { font-weight:600; }
    .brand-tagline { font-size:0.9rem; color:rgba(255,255,255,0.72); text-align:center; min-width:260px; line-height:1.6; font-weight:300; }
    .steps { margin-top:44px; display:flex; flex-direction:column; gap:0; z-index:1; animation:fadeUp 0.7s 0.15s ease both; width:100%; max-width:260px; }
    .step { display:flex; align-items:flex-start; gap:14px; padding:14px 0; position:relative; }
    .step:not(:last-child)::after { content:''; position:absolute; left:17px; top:46px; width:2px; height:calc(100% - 14px); background:rgba(255,255,255,0.2); }
    .step-num { width:34px; height:34px; border-radius:50%; background:rgba(255,255,255,0.18); border:1.5px solid rgba(255,255,255,0.35); display:flex; align-items:center; justify-content:center; font-size:0.82rem; font-weight:600; color:white; flex-shrink:0; }
    .step-num.done { background:rgba(255,255,255,0.3); }
    .step-info { padding-top:6px; }
    .step-title { font-size:0.88rem; font-weight:500; color:white; }
    .step-desc  { font-size:0.78rem; color:rgba(255,255,255,0.65); margin-top:2px; }
    .already-link { margin-top:36px; z-index:1; font-size:0.84rem; color:white; text-align:center; }
    .already-link a { color:white; font-weight:bold; text-decoration:underline; font-size: 17px; }

    
    .right-panel { display:flex; flex-direction:column; justify-content:center; align-items:center; padding:48px 50px; background:white; overflow-y:auto; }
    .card { width:100%; max-width:560px; animation:fadeUp 0.6s 0.1s ease both; }
    .card-header { margin-bottom:28px; }
    .card-header h1 { font-size:1.6rem; font-weight:600; color:var(--gray-900); letter-spacing:-0.4px; margin-bottom:5px; }
    .card-header p { font-size:0.9rem; color:var(--gray-500); font-weight:300; }

    
    .progress-bar { display:flex; gap:6px; margin-bottom:32px; }
    .prog-step { flex:1; height:4px; border-radius:4px; background:var(--gray-100); transition:background 0.3s; }
    .prog-step.active { background:var(--grad); }
    .prog-step.done   { background:var(--purple-pale); }

    
    .step-panel { display:none; animation:fadeUp 0.4s ease both; }
    .step-panel.active { display:block; }

    
    .section-label { font-size:0.74rem; font-weight:600; letter-spacing:0.8px; text-transform:uppercase; color:var(--purple); margin-bottom:16px; display:flex; align-items:center; gap:8px; }
    .section-label::after { content:''; flex:1; height:1px; background:var(--purple-pale); }

    
    .form-grid { display:grid; grid-template-columns:1fr 1fr; gap:16px; }
    .form-grid .full { grid-column:1/-1; }

    
    .form-group { display:flex; flex-direction:column; gap:7px; }
    label { font-size:0.82rem; font-weight:500; color:var(--gray-700); letter-spacing:0.2px; }
    .required { color:var(--purple); margin-left:2px; }
    .input-wrap { position:relative; }
    .input-icon { position:absolute; left:13px; top:50%; transform:translateY(-50%); width:16px; height:16px; stroke:var(--gray-300); fill:none; stroke-width:2; stroke-linecap:round; stroke-linejoin:round; pointer-events:none; transition:stroke 0.2s; }
    .input-wrap:focus-within .input-icon { stroke:var(--purple); }
    input[type="text"], input[type="email"], input[type="password"], input[type="tel"], select {
      width:100%; padding:11px 13px 11px 40px; border:1.5px solid var(--gray-300); border-radius:10px;
      font-family:'DM Sans',sans-serif; font-size:0.9rem; color:var(--gray-900); background:white;
      outline:none; transition:border-color 0.2s,box-shadow 0.2s; appearance:none;
    }
    select { background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%236B7280' stroke-width='2'%3E%3Cpolyline points='6 9 12 15 18 9'/%3E%3C/svg%3E"); background-repeat:no-repeat; background-position:right 13px center; padding-right:36px; cursor:pointer; }
    input:focus, select:focus { border-color:var(--purple-light); box-shadow:0 0 0 3px rgba(139,92,246,0.11); }
    input.err, select.err { border-color:var(--danger); box-shadow:0 0 0 3px rgba(220,38,38,0.08); }
    .field-err { font-size:0.76rem; color:var(--danger); display:none; }
    .field-err.show { display:block; }

    
    .pwd-strength { margin-top:6px; }
    .strength-bar { height:3px; border-radius:3px; background:var(--gray-100); margin-bottom:4px; overflow:hidden; }
    .strength-fill { height:100%; border-radius:3px; width:0%; transition:width 0.3s,background 0.3s; }
    .strength-txt { font-size:0.74rem; color:var(--gray-500); }

    
    .eye-btn { position:absolute; right:12px; top:50%; transform:translateY(-50%); background:none; border:none; cursor:pointer; color:var(--gray-300); display:flex; align-items:center; transition:color 0.2s; padding:3px; }
    .eye-btn:hover { color:var(--purple); }
    .eye-btn svg { width:16px; height:16px; stroke:currentColor; fill:none; stroke-width:2; stroke-linecap:round; stroke-linejoin:round; }

    
    .error-msg { display:none; align-items:center; gap:7px; background:#FEF2F2; border:1px solid #FECACA; border-radius:9px; padding:10px 14px; font-size:0.83rem; color:var(--danger); margin-bottom:16px; }
    .error-msg.show { display:flex; }
    .error-msg svg { width:15px; height:15px; stroke:var(--danger); fill:none; stroke-width:2; stroke-linecap:round; stroke-linejoin:round; flex-shrink:0; }

    
    .form-nav { display:flex; gap:12px; margin-top:28px; }
    .btn-back { flex:1; padding:12px; background:white; color:var(--gray-700); border:1.5px solid var(--gray-300); border-radius:11px; font-family:'DM Sans',sans-serif; font-size:0.92rem; font-weight:500; cursor:pointer; display:flex; align-items:center; justify-content:center; gap:7px; transition:all 0.2s; }
    .btn-back:hover { border-color:var(--purple-light); color:var(--purple); }
    .btn-next { flex:2; padding:12px; background:var(--grad); color:white; border:none; border-radius:11px; font-family:'DM Sans',sans-serif; font-size:0.93rem; font-weight:600; cursor:pointer; display:flex; align-items:center; justify-content:center; gap:8px; transition:opacity 0.2s,transform 0.15s; }
    .btn-next:hover { opacity:0.91; transform:translateY(-1px); }
    .btn-next svg, .btn-back svg { width:17px; height:17px; stroke:currentColor; fill:none; stroke-width:2.2; stroke-linecap:round; stroke-linejoin:round; }
    .btn-next .spinner { display:none; width:17px; height:17px; border:2.5px solid rgba(255,255,255,0.35); border-top-color:white; border-radius:50%; animation:spin 0.7s linear infinite; }
    .btn-next.loading .spinner { display:block; }
    .btn-next.loading .btn-label { opacity:0.6; }

    
    .success-box { text-align:center; padding:32px 24px; animation:fadeUp 0.5s ease both; }
    .success-icon { width:72px; height:72px; border-radius:50%; background:linear-gradient(135deg,#DCFCE7,#BBF7D0); display:flex; align-items:center; justify-content:center; margin:0 auto 20px; }
    .success-icon svg { width:34px; height:34px; stroke:var(--success); fill:none; stroke-width:2.5; stroke-linecap:round; stroke-linejoin:round; }
    .success-box h2 { font-size:1.4rem; font-weight:600; color:var(--gray-900); margin-bottom:8px; }
    .success-box p  { font-size:0.9rem; color:var(--gray-500); line-height:1.6; max-width:360px; margin:0 auto 24px; }
    .btn-login { display:inline-flex; align-items:center; gap:8px; padding:12px 28px; background:var(--grad); color:white; border:none; border-radius:11px; font-family:'DM Sans',sans-serif; font-size:0.93rem; font-weight:600; cursor:pointer; text-decoration:none; transition:opacity 0.2s; }
    .btn-login:hover { opacity:0.9; }
    .btn-login svg { width:16px; height:16px; stroke:white; fill:none; stroke-width:2.2; stroke-linecap:round; stroke-linejoin:round; }

    
    .hint { font-size:0.76rem; color:var(--gray-500); margin-top:4px; }
    .badge-secure { display:inline-flex; align-items:center; gap:5px; background:var(--grad-soft); color:var(--purple); font-size:0.75rem; font-weight:500; padding:5px 12px; border-radius:20px; margin-top:22px; }
    .badge-secure svg { width:12px; height:12px; stroke:var(--purple); fill:none; stroke-width:2; stroke-linecap:round; stroke-linejoin:round; }
    .card-footer { text-align:center; }

    @keyframes fadeUp { from{opacity:0;transform:translateY(18px)} to{opacity:1;transform:translateY(0)} }
    @keyframes spin   { to{transform:rotate(360deg)} }

    @media(max-width:768px) { .page{grid-template-columns:1fr} .left-panel{display:none} .right-panel{padding:32px 20px} .form-grid{grid-template-columns:1fr} }
  </style>
</head>
<body>
<div class="page">

  
  <div class="left-panel">
    <div class="brand">
        <div class="brand">
            <div class="logo-wrap">
              <img src="assets/logo.png" alt="">
            </div>
      <div style="text-align:center;">
        <div class="brand-name">Flow<span>Request</span> univ-ndere</div>
        <p class="brand-tagline">Gestion et suivi des requêtes étudiantes en toute simplicité</p>
      </div>
    </div>
    </div>
    <div class="steps">
      <div class="step">
        <div class="step-num" id="sn1">1</div>
        <div class="step-info">
          <div class="step-title">Informations personnelles</div>
          <div class="step-desc">Nom, prénom, matricule, contact</div>
        </div>
      </div>
      <div class="step">
        <div class="step-num" id="sn2">2</div>
        <div class="step-info">
          <div class="step-title">Cursus académique</div>
          <div class="step-desc">Cycle, filière, niveau</div>
        </div>
      </div>
      <div class="step">
        <div class="step-num" id="sn3">3</div>
        <div class="step-info">
          <div class="step-title">Sécurité du compte</div>
          <div class="step-desc">Email et mot de passe</div>
        </div>
      </div>
    </div>
    <a href="connexion">
          <button class="register-tab" >
            <svg viewBox="0 0 24 24"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/></svg>
                J'ai déjà un compte
          </button>
        </a>
  </div>

<!-- espace du formulaire-->
  <div class="right-panel">
    <div class="card">
      <div class="card-header">
        <h1>Créer un compte</h1>
        <p>Remplissez les informations ci-dessous pour rejoindre FlowreQuest</p>
      </div>

      
      <div class="progress-bar">
        <div class="prog-step active" id="p1"></div>
        <div class="prog-step"        id="p2"></div>
        <div class="prog-step"        id="p3"></div>
      </div>

      
      <div class="error-msg" id="globalErr">
        <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
        <span id="errTxt">Veuillez corriger les erreurs.</span>
      </div>

      <form id="inscription" action="" method="POST" novalidate>

        
        <div class="step-panel active" id="panel1">
          <div class="section-label">Informations personnelles</div>
          <div class="form-grid">
<!--nom utilisateur-->
            <div class="form-group">
              <label>Nom <span class="required">*</span></label>
              <div class="input-wrap">
                <input type="text" name="nom" id="nom" placeholder="Ex : NGUEMA"/>
                <svg class="input-icon" viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
              </div>
              <span class="field-err" id="e-nom">Le nom est requis.</span>
            </div>
<!--prenom utilisateur-->
            <div class="form-group">
              <label>Prénom <span class="required">*</span></label>
              <div class="input-wrap">
                <input type="text" name="prenom" id="prenom" placeholder="Ex : Paul"/>
                <svg class="input-icon" viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
              </div>
              <span class="field-err" id="e-prenom">Le prénom est requis.</span>
            </div>
<!--matricule utilisateur-->
            <div class="form-group">
              <label>Matricule <span class="required">*</span></label>
              <div class="input-wrap">
                <input type="text" name="matricule" id="matricule" placeholder="Ex : 22B000FS" style="text-transform:uppercase"/>
                <svg class="input-icon" viewBox="0 0 24 24"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 7V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v2"/></svg>
              </div>
              <span class="field-err" id="e-mat">Le matricule est requis.</span>
            </div>
<!--contact utilisateur-->
            <div class="form-group">
              <label>Contact <span class="required">*</span></label>
              <div class="input-wrap">
                <input type="tel" name="contact" id="contact" holder="Ex : 699000000"/>
                <svg class="input-icon" viewBox="0 0 24 24"><path d="M22 16.92v3a2 2 0 0 1-2.18 2A19.79 19.79 0 0 1 3.09 5.18 2 2 0 0 1 5.09 3h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L9.09 10.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
              </div>
              <span class="field-err" id="e-contact">Numéro invalide (9 chiffres).</span>
            </div>

          </div>
          <div class="form-nav">
            <button type="button" class="btn-next" onclick="goStep(2)">
              <span class="btn-label">Suivant</span>
              <svg viewBox="0 0 24 24"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
            </button>
          </div>
        </div>

        
        <div class="step-panel" id="panel2">
          <div class="section-label">Cursus académique</div>
          <div class="form-grid">
<!--cursus utilisateur-->
            <div class="form-group full">
              <label>Cycle <span class="required">*</span></label>
              <div class="input-wrap">
<!--cycle utilisateur-->
                    <select name="cycle" id="id_cycle">
                        <option value="">-- Sélectionner un cycle --</option>
                        <?php  foreach($info['cycle'] as $cyc):?>
                                  
                                      <option value="<?= $cyc['id_cycle']; ?>"><?= $cyc['libelle_cycle']; ?></option>
                        <?php  endforeach; ?>
                        
                    </select>
                <svg class="input-icon" viewBox="0 0 24 24"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/></svg>
              </div>
              <span class="field-err" id="e-cycle">Veuillez choisir un cycle.</span>
            </div>

            <div class="form-group full">
              <label>Filière <span class="required">*</span></label>
              <div class="input-wrap">
<!--filiere utilisateur-->
                <select name="filiere" id="id_filiere">
                  <option value="">-- Sélectionner une filière ou saisissez pour vite trouver--</option>
                  <?php foreach($info['departement'] as $dept){ ?>
                      <optgroup label="<?=   "Département de ".$dept['libelle_departement'] ; ?>">
                          <?php  foreach($info['filiere'] as $fil){
                                  if($dept['id_departement'] == $fil['id_departement']){ ?>
                                      <option value="<?= $fil['id_filiere']; ?>"><?= $fil['libelle_filiere']; ?></option>
                          <?php  } } ?>
                      </optgroup>
                  <?php }?>
                  
                </select>
                <svg class="input-icon" viewBox="0 0 24 24"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/></svg>
              </div>
              <span class="field-err" id="e-filiere">Veuillez choisir une filière.</span>
            </div>

            <div class="form-group full">
              <label>Niveau <span class="required">*</span></label>
              <div class="input-wrap">
<!--niveau utilisateur-->
                <select name="niveau" id="niveau">
                  <option value="">-- Sélectionner votre niveau --</option>
                  <option value="1">Niveau 1</option>
                  <option value="2">Niveau 2</option>
                  <option value="3">Niveau 3</option>
                  <option value="4">Niveau 4</option>
                  <option value="5">Niveau 5</option>
                  <option value="6">Thèse</option>
                </select>
                <svg class="input-icon" viewBox="0 0 24 24"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg>
              </div>
              <span class="field-err" id="e-niveau">Veuillez choisir votre niveau.</span>
            </div>

          </div>
          <div class="form-nav">
            <button type="button" class="btn-back" onclick="goStep(1)">
              <svg viewBox="0 0 24 24"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
              Retour
            </button>
            <button type="button" class="btn-next" onclick="goStep(3)">
              <span class="btn-label">Suivant</span>
              <svg viewBox="0 0 24 24"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
            </button>
          </div>
        </div>

        
        <div class="step-panel" id="panel3">
          <div class="section-label">Sécurité du compte</div>
          <div class="form-grid">

            <div class="form-group full">
<!--email utilisateur-->
              <label>Adresse e-mail <span class="required">*</span></label>
              <div class="input-wrap">
                <input type="email" name="email" id="email" placeholder="paul.nguema@etudiant.cm"/>
                <svg class="input-icon" viewBox="0 0 24 24"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
              </div>
              <span class="field-err" id="e-email">Email invalide.</span>
            </div>
<!--mot de passe utilisateur-->
            <div class="form-group full">
              <label>Mot de passe <span class="required">*</span></label>
              <div class="input-wrap">
                <input type="password" name="mdp" id="mdp" placeholder="Minimum 8 caractères" oninput="checkStrength(this.value)"/>
                <svg class="input-icon" viewBox="0 0 24 24"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                <button type="button" class="eye-btn" onclick="toggleEye('mdp','eye1')">
                  <svg id="eye1" viewBox="0 0 24 24"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                </button>
              </div>
              <div class="pwd-strength">
                <div class="strength-bar"><div class="strength-fill" id="strengthFill"></div></div>
                <span class="strength-txt" id="strengthTxt">Entrez un mot de passe</span>
              </div>
              <span class="field-err" id="e-mdp">Minimum 8 caractères requis.</span>
            </div>

            <div class="form-group full">
<!--confirmation mot de passe utilisateur-->
              <label>Confirmer le mot de passe <span class="required">*</span></label>
              <div class="input-wrap">
                <input type="password" name="mdp_confirm" id="mdp_confirm" placeholder="Répétez le mot de passe"/>
                <svg class="input-icon" viewBox="0 0 24 24"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                <button type="button" class="eye-btn" onclick="toggleEye('mdp_confirm','eye2')">
                  <svg id="eye2" viewBox="0 0 24 24"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                </button>
              </div>
              <span class="field-err" id="e-confirm">Les mots de passe ne correspondent pas.</span>
            </div>

          </div>
          <div class="form-nav">
            <button type="button" class="btn-back" onclick="goStep(2)">
              <svg viewBox="0 0 24 24"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
              Retour
            </button>
            <button type="submit" class="btn-next" id="submitBtn">
              <div class="spinner"></div>
              <span class="btn-label">Créer mon compte</span>
              <svg viewBox="0 0 24 24"><path d="M9 12l2 2 4-4"/><rect x="3" y="3" width="18" height="18" rx="2"/></svg>
            </button>
          </div>
        </div>

        
        <div class="step-panel" id="panelSuccess">
          <div class="success-box">
            <div class="success-icon">
              <svg viewBox="0 0 24 24"><path d="M9 12l2 2 4-4"/><circle cx="12" cy="12" r="10"/></svg>
            </div>
            <h2>Compte créé avec succès !</h2>
            <p>Votre espace étudiant FlowreQuest est prêt. Connectez-vous pour soumettre vos premières requêtes.</p>
            <a href="login.html" class="btn-login">
              <svg viewBox="0 0 24 24"><path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"/><polyline points="10 17 15 12 10 7"/><line x1="15" y1="12" x2="3" y2="12"/></svg>
              Se connecter maintenant
            </a>
          </div>
        </div>

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
  let currentStep = 1;
  const eyeOpen   = `<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>`;
  const eyeClosed = `<path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94"/><path d="M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19"/><line x1="1" y1="1" x2="23" y2="23"/>`;

  
  function goStep(n) {
    if (n > currentStep && !validateStep(currentStep)) return;
    hideGlobalErr();
    document.getElementById('panel' + currentStep).classList.remove('active');
    document.getElementById('panel' + n).classList.add('active');
    updateProgress(n);
    updateSideSteps(n);
    currentStep = n;
    window.scrollTo({top:0, behavior:'smooth'});
  }

  function updateProgress(n) {
    for (let i=1; i<=3; i++) {
      const el = document.getElementById('p'+i);
      el.classList.remove('active','done');
      if (i < n)  el.classList.add('done');
      if (i === n) el.classList.add('active');
    }
  }

  function updateSideSteps(n) {
    for (let i=1; i<=3; i++) {
      const el = document.getElementById('sn'+i);
      el.classList.remove('done');
      if (i < n) { el.innerHTML = '✓'; el.classList.add('done'); }
      else el.innerHTML = i;
    }
  }

  
  function validateStep(s) {
    let ok = true;
    if (s === 1) {
      ok = chk('nom',      v => v.length > 0, 'e-nom')     && ok;
      ok = chk('prenom',   v => v.length > 0, 'e-prenom')  && ok;
      ok = chk('matricule',v => v.length > 2, 'e-mat')     && ok;
      ok = chk('contact',  v => /^\d{9}$/.test(v), 'e-contact') && ok;
    }
    if (s === 2) {
      ok = chk('id_cycle',  v => v !== '', 'e-cycle')   && ok;
      ok = chk('id_filiere',v => v !== '', 'e-filiere') && ok;
      ok = chk('niveau',    v => v !== '', 'e-niveau')  && ok;
    }
    if (s === 3) {
      ok = chk('email', v => /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(v), 'e-email') && ok;
      ok = chk('mdp',   v => v.length >= 8, 'e-mdp') && ok;
      const pwd = document.getElementById('mdp').value;
      const conf = document.getElementById('mdp_confirm').value;
      if (pwd !== conf || conf === '') {
        showFErr('e-confirm'); document.getElementById('mdp_confirm').classList.add('err'); ok = false;
      } else {
        hideFErr('e-confirm'); document.getElementById('mdp_confirm').classList.remove('err');
      }
    }
    return ok;
  }

  function chk(id, fn, errId) {
    const el = document.getElementById(id);
    const val = el.value.trim();
    if (!fn(val)) { showFErr(errId); el.classList.add('err'); return false; }
    hideFErr(errId); el.classList.remove('err'); return true;
  }
  function showFErr(id) { document.getElementById(id).classList.add('show'); }
  function hideFErr(id) { document.getElementById(id).classList.remove('show'); }
  function hideGlobalErr() { document.getElementById('globalErr').classList.remove('show'); }
  function showGlobalErr(msg) { document.getElementById('errTxt').textContent = msg; document.getElementById('globalErr').classList.add('show'); }

  
  function checkStrength(v) {
    let score = 0;
    if (v.length >= 8)  score++;
    if (v.length >= 12) score++;
    if (/[A-Z]/.test(v)) score++;
    if (/[0-9]/.test(v)) score++;
    if (/[^A-Za-z0-9]/.test(v)) score++;
    const fill = document.getElementById('strengthFill');
    const txt  = document.getElementById('strengthTxt');
    const levels = [
      {pct:'0%',  bg:'transparent', label:'Entrez un mot de passe'},
      {pct:'25%', bg:'#DC2626',     label:'Très faible'},
      {pct:'50%', bg:'#F97316',     label:'Faible'},
      {pct:'75%', bg:'#EAB308',     label:'Moyen'},
      {pct:'90%', bg:'#22C55E',     label:'Fort'},
      {pct:'100%',bg:'#16A34A',     label:'Très fort'},
    ];
    const l = levels[Math.min(score, 5)];
    fill.style.width = l.pct; fill.style.background = l.bg; txt.textContent = l.label;
  }

  
  function toggleEye(inputId, iconId) {
    const inp = document.getElementById(inputId);
    const ico = document.getElementById(iconId);
    const visible = inp.type === 'text';
    inp.type = visible ? 'password' : 'text';
    ico.innerHTML = visible ? eyeOpen : eyeClosed;
  }


</script>