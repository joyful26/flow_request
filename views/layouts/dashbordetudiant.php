<?php
if (!isset($_SESSION['etudiant'])) {
    header("Location: ../");
    exit;
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>FlowreQuest — Tableau de bord</title>
  <link rel="preconnect" href="https://fonts.googleapis.com"/>
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:opsz,wght@9..40,300;9..40,400;9..40,500;9..40,600&family=Sora:wght@300;400;600&display=swap" rel="stylesheet"/>
  <style>
    *,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
    :root{
      --purple:#6B3FD4;--purple-light:#8B5CF6;--purple-pale:#EDE9FE;
      --blue:#2563EB;--blue-pale:#DBEAFE;
      --grad:linear-gradient(135deg,#6B3FD4 0%,#2563EB 100%);
      --grad-soft:linear-gradient(135deg,#EDE9FE 0%,#DBEAFE 100%);
      --green:#16A34A;--green-pale:#DCFCE7;
      --amber:#D97706;--amber-pale:#FEF3C7;
      --red:#DC2626;
      --gray-900:#1E1B2E;--gray-700:#374151;--gray-500:#6B7280;
      --gray-300:#D1D5DB;--gray-100:#F3F4F6;
      --sidebar-w:260px;--topbar-h:68px;
    }
    html,body{height:100%;font-family:'DM Sans',sans-serif;background:#F4F3FB;color:var(--gray-900)}

    .sidebar{position:fixed;top:0;left:0;width:var(--sidebar-w);height:100vh;background:var(--gray-900);display:flex;flex-direction:column;z-index:100;transition:transform .3s ease}
    .sb-brand{padding:20px 22px 16px;display:flex;align-items:center;gap:12px;border-bottom:1px solid rgba(255,255,255,.07)}
    .sb-logo{width:44px;height:44px;border-radius:12px;overflow:hidden;display:flex;align-items:center;justify-content:center;background:white;flex-shrink:0}
    .sb-logo img{width:40px;height:40px;object-fit:contain}
    .sb-brand-text .bname{font-family:'Sora',sans-serif;font-size:.95rem;font-weight:600;color:white}
    .sb-brand-text .brole{font-size:.7rem;color:rgba(255,255,255,.4);margin-top:2px}

    .sb-user{padding:14px 18px;margin:10px;background:rgba(255,255,255,.05);border-radius:12px;display:flex;align-items:center;gap:10px}
    .avatar{width:38px;height:38px;border-radius:50%;background:var(--grad);display:flex;align-items:center;justify-content:center;font-size:.85rem;font-weight:600;color:white;flex-shrink:0}
    .u-name{font-size:.83rem;font-weight:500;color:white}
    .u-mat{font-size:.72rem;color:rgba(255,255,255,.4);margin-top:2px}

    .nav-sec{padding:6px 10px 4px}
    .nav-lbl{font-size:.67rem;font-weight:600;letter-spacing:.9px;text-transform:uppercase;color:rgba(255,255,255,.28);padding:0 10px;margin-bottom:5px}
    .nav-a{display:flex;align-items:center;gap:11px;padding:10px 14px;border-radius:10px;font-size:.87rem;color:rgba(255,255,255,.58);text-decoration:none;cursor:pointer;transition:all .18s;margin-bottom:2px}
    .nav-a:hover{background:var(--grad);color:white;font-weight:500}
    .nav-a svg{width:18px;height:18px;stroke:currentColor;fill:none;stroke-width:1.8;stroke-linecap:round;stroke-linejoin:round;flex-shrink:0}
    .nb{margin-left:auto;background:var(--purple-light);color:white;font-size:.68rem;font-weight:600;padding:2px 7px;border-radius:20px}
    .nav-a.active .nb{background:rgba(255,255,255,.25)}

    .sb-footer{margin-top:auto;padding:14px 10px}
    .logout{display:flex;align-items:center;gap:10px;padding:10px 14px;border-radius:10px;font-size:.87rem;color:rgba(255,255,255,.42);cursor:pointer;transition:all .18s;text-decoration:none;border:none;background:none;width:100%;font-family:'DM Sans',sans-serif}
    .logout:hover{background:rgba(220,38,38,.12);color:#FCA5A5}
    .logout svg{width:17px;height:17px;stroke:currentColor;fill:none;stroke-width:1.8;stroke-linecap:round;stroke-linejoin:round}

    .main{margin-left:var(--sidebar-w);min-height:100vh;display:flex;flex-direction:column}
    .topbar{height:var(--topbar-h);background:white;border-bottom:1px solid var(--gray-100);display:flex;align-items:center;padding:0 32px;gap:14px;position:sticky;top:0;z-index:50}
    .menu-btn{display:none;background:none;border:none;cursor:pointer;padding:6px;color:var(--gray-700)}
    .menu-btn svg{width:22px;height:22px;stroke:currentColor;fill:none;stroke-width:2;stroke-linecap:round}
    .tb-title{font-family:'Sora',sans-serif;font-size:1.05rem;font-weight:600;color:var(--gray-900);letter-spacing:-.3px}
    .tb-right{margin-left:auto;display:flex;align-items:center;gap:12px}
    .tb-date{font-size:.8rem;color:var(--gray-500)}
    .notif-btn{position:relative;width:38px;height:38px;border-radius:10px;background:var(--gray-100);border:none;cursor:pointer;display:flex;align-items:center;justify-content:center;transition:background .18s}
    .notif-btn:hover{background:var(--gray-300)}
    .notif-btn svg{width:18px;height:18px;stroke:var(--gray-700);fill:none;stroke-width:1.8;stroke-linecap:round;stroke-linejoin:round}
    .ndot{position:absolute;top:8px;right:9px;width:7px;height:7px;border-radius:50%;background:var(--red);border:2px solid white}

    .content{padding:28px 32px;flex:1}

    .welcome{background:var(--grad);border-radius:18px;padding:26px 30px;display:flex;align-items:center;justify-content:space-between;margin-bottom:26px;position:relative;overflow:hidden}
    .welcome::before{content:'';position:absolute;top:-60px;right:-60px;width:220px;height:220px;border-radius:50%;background:rgba(255,255,255,.06)}
    .welcome::after{content:'';position:absolute;bottom:-80px;left:40%;width:200px;height:200px;border-radius:50%;background:rgba(255,255,255,.04)}
    .w-text{z-index:1}
    .w-text h2{font-family:'Sora',sans-serif;font-size:1.35rem;font-weight:600;color:white;margin-bottom:4px}
    .w-text p{font-size:.88rem;color:rgba(255,255,255,.7);font-weight:300}
    .btn-new{display:inline-flex;align-items:center;gap:8px;padding:11px 20px;background:white;color:var(--purple);border:none;border-radius:11px;font-family:'DM Sans',sans-serif;font-size:.87rem;font-weight:600;cursor:pointer;transition:opacity .18s,transform .15s;text-decoration:none;z-index:1}
    .btn-new:hover{opacity:.92;transform:translateY(-1px)}
    .btn-new svg{width:16px;height:16px;stroke:currentColor;fill:none;stroke-width:2.2;stroke-linecap:round;stroke-linejoin:round}

    .stats-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:16px;margin-bottom:26px}
    .stat-card{background:white;border-radius:16px;padding:22px 24px;border:1px solid var(--gray-100);display:flex;align-items:center;gap:16px;transition:box-shadow .2s}
    .stat-card:hover{box-shadow:0 4px 20px rgba(107,63,212,.08)}
    .si{width:50px;height:50px;border-radius:14px;display:flex;align-items:center;justify-content:center;flex-shrink:0}
    .si svg{width:24px;height:24px;stroke:currentColor;fill:none;stroke-width:1.8;stroke-linecap:round;stroke-linejoin:round}
    .si.p{background:var(--purple-pale);color:var(--purple)}
    .si.b{background:var(--blue-pale);color:var(--blue)}
    .si.g{background:var(--green-pale);color:var(--green)}
    .sn{font-family:'Sora',sans-serif;font-size:1.75rem;font-weight:600;color:var(--gray-900);line-height:1}
    .sl{font-size:.8rem;color:var(--gray-500);margin-top:4px}

    .bottom-grid{display:grid;grid-template-columns:1.6fr 1fr;gap:18px}
    .panel{background:white;border-radius:16px;border:1px solid var(--gray-100);overflow:hidden}
    .ph{padding:17px 22px;border-bottom:1px solid var(--gray-100);display:flex;align-items:center;justify-content:space-between}
    .pt{font-size:.93rem;font-weight:600;color:var(--gray-900)}
    .pl{font-size:.79rem;color:var(--purple);text-decoration:none;font-weight:500}
    .pl:hover{text-decoration:underline}

    .req-list{padding:6px 0}
    .ri{padding:13px 22px;display:flex;align-items:center;gap:13px;border-bottom:1px solid var(--gray-100);transition:background .15s;cursor:pointer}
    .ri:last-child{border-bottom:none}
    .ri:hover{background:var(--gray-100)}
    .rn{width:32px;height:32px;border-radius:8px;background:var(--grad-soft);color:var(--purple);font-size:.72rem;font-weight:600;display:flex;align-items:center;justify-content:center;flex-shrink:0}
    .ri-info{flex:1;min-width:0}
    .ro{font-size:.87rem;font-weight:500;color:var(--gray-900);white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
    .ra{font-size:.74rem;color:var(--gray-500);margin-top:2px}
    .rs{display:inline-flex;align-items:center;font-size:.73rem;font-weight:500;padding:3px 10px;border-radius:20px;background:var(--amber-pale);color:var(--amber)}
    .r-empty{padding:34px 22px;text-align:center;color:var(--gray-500);font-size:.87rem;line-height:1.6}
    .r-empty a{color:var(--purple);font-weight:500}

    .act-list{padding:10px 14px;display:flex;flex-direction:column;gap:8px}
    .act{display:flex;align-items:center;gap:12px;padding:12px 14px;border-radius:12px;background:var(--gray-100);cursor:pointer;text-decoration:none;transition:background .18s}
    .act:hover{background:var(--purple-pale)}
    .act:hover .ai{background:var(--purple);color:white}
    .ai{width:36px;height:36px;border-radius:10px;background:white;color:var(--purple);display:flex;align-items:center;justify-content:center;flex-shrink:0;transition:all .18s}
    .ai svg{width:17px;height:17px;stroke:currentColor;fill:none;stroke-width:2;stroke-linecap:round;stroke-linejoin:round}
    .al{font-size:.87rem;font-weight:500;color:var(--gray-700)}
    .ad{font-size:.74rem;color:var(--gray-500);margin-top:1px}
    .aa{margin-left:auto;color:var(--gray-300)}
    .aa svg{width:15px;height:15px;stroke:currentColor;fill:none;stroke-width:2;stroke-linecap:round;stroke-linejoin:round}

    .overlay{display:none;position:fixed;inset:0;background:rgba(0,0,0,.4);z-index:90}
    .overlay.show{display:block}

    @media(max-width:900px){
      .sidebar{transform:translateX(-100%)}
      .sidebar.open{transform:translateX(0)}
      .main{margin-left:0}
      .menu-btn{display:flex}
      .stats-grid{grid-template-columns:1fr 1fr}
      .bottom-grid{grid-template-columns:1fr}
    }
    @media(max-width:540px){
      .stats-grid{grid-template-columns:1fr}
      .content{padding:18px 14px}
      .topbar{padding:0 14px}
      .welcome{flex-direction:column;align-items:flex-start;gap:16px}
    }
  </style>
</head>
<body>

<div class="overlay" id="overlay" onclick="closeSB()"></div>

<aside class="sidebar" id="sidebar">
  <div class="sb-brand">
    <div class="sb-logo"><img src="../assets/logo.png" alt="FlowreQuest"/></div>
    <div class="sb-brand-text">
      <div class="bname">FlowRequest</div>
      <div class="brole">Espace étudiant</div>
    </div>
  </div>

  <div class="sb-user">
    <div class="avatar"><?= strtoupper(substr($_SESSION['etudiant']['nom'],0,1).substr($_SESSION['etudiant']['prenom'], 0,1)); ?></div>
    <div>
      <div class="u-name"><?= strtoupper($_SESSION['etudiant']['nom'].' '.$_SESSION['etudiant']['prenom']); ?></div>
      <div class="u-mat"><?= strtoupper($_SESSION['etudiant']['matricule']) ?></div>
    </div>
  </div>

  <nav class="nav-sec">
    <div class="nav-lbl">Navigation</div>
    <a href="index" class="nav-a index">
      <svg viewBox="0 0 24 24"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>
      Tableau de bord
    </a>
    <a href="requete" class="nav-a requetes">
      <svg viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
      Mes requêtes
      <span class="nb"><?=  $this->DashbordEtudiant->total_req  ?></span>
    </a>
    <a href="nouvelle_requete" class="nav-a nouvelle_requete">
      <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="16"/><line x1="8" y1="12" x2="16" y2="12"/></svg>
      Nouvelle requête
    </a>
    <a href="dossier" class="nav-a dossier">
      <svg viewBox="0 0 24 24"><path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"/></svg>
      Mon dossier
    </a>
    <a href="messages" class="nav-a messages">
      <svg viewBox="0 0 24 24"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
      Mes Messages
      <span class="nb"><?=  $this->DashbordEtudiant->AdminCountRep  ?></span>
    </a>
  </nav>

  <div class="sb-footer">
    <a href="../" class="logout">
      <svg viewBox="0 0 24 24"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
      Déconnexion
    </a>
  </div>
</aside>

<div class="main">
        <?= $content;?>
</div>

<script>
  const d=new Date();
  document.getElementById('dateEl').textContent=d.toLocaleDateString('fr-FR',{weekday:'long',day:'numeric',month:'long',year:'numeric'});
  function toggleSB(){document.getElementById('sidebar').classList.toggle('open');document.getElementById('overlay').classList.toggle('show')}
  function closeSB(){document.getElementById('sidebar').classList.remove('open');document.getElementById('overlay').classList.remove('show')}
</script>
</body>
</html>
