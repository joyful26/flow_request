<?php
if (!isset($_SESSION['admin'])) {
    header("Location: ../");
    exit;
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>FlowreQuest — Dashboard Admin</title>
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
      --red:#DC2626;--red-pale:#FEE2E2;
      --gray-900:#1E1B2E;--gray-800:#2D2A3E;--gray-700:#374151;
      --gray-500:#6B7280;--gray-300:#D1D5DB;--gray-100:#F3F4F6;
      --sidebar-w:265px;--topbar-h:68px;
    }
    html,body{height:100%;font-family:'DM Sans',sans-serif;background:#F4F3FB;color:var(--gray-900)}

    /* SIDEBAR */
    .sidebar{position:fixed;top:0;left:0;width:var(--sidebar-w);height:100vh;background:var(--gray-800);display:flex;flex-direction:column;z-index:100;transition:transform .3s ease;border-right:1px solid rgba(255,255,255,.05)}
    .sb-brand{padding:20px 22px 16px;display:flex;align-items:center;gap:12px;border-bottom:1px solid rgba(255,255,255,.07)}
    .sb-logo{width:44px;height:44px;border-radius:12px;overflow:hidden;display:flex;align-items:center;justify-content:center;background:white;flex-shrink:0}
    .sb-logo img{width:40px;height:40px;object-fit:contain}
    .sb-brand-text .bname{font-family:'Sora',sans-serif;font-size:.95rem;font-weight:600;color:white}
    .sb-brand-text .brole{font-size:.7rem;color:rgba(255,255,255,.4);margin-top:2px;display:flex;align-items:center;gap:5px}
    .admin-badge{background:rgba(107,63,212,.4);color:#C4B5FD;font-size:.65rem;font-weight:600;padding:1px 7px;border-radius:10px}

    .sb-user{padding:14px 18px;margin:10px;background:rgba(255,255,255,.05);border-radius:12px;display:flex;align-items:center;gap:10px}
    .avatar{width:38px;height:38px;border-radius:50%;background:var(--grad);display:flex;align-items:center;justify-content:center;font-size:.85rem;font-weight:600;color:white;flex-shrink:0}
    .u-name{font-size:.83rem;font-weight:500;color:white}
    .u-role{font-size:.72rem;color:rgba(255,255,255,.4);margin-top:2px}

    .nav-sec{padding:6px 10px 4px}
    .nav-lbl{font-size:.67rem;font-weight:600;letter-spacing:.9px;text-transform:uppercase;color:rgba(255,255,255,.25);padding:0 10px;margin-bottom:5px}
    .nav-a{display:flex;align-items:center;gap:11px;padding:10px 14px;border-radius:10px;font-size:.87rem;color:rgba(255,255,255,.55);text-decoration:none;transition:all .18s;margin-bottom:2px}
    .nav-a:hover{background:rgba(255,255,255,.07);color:white}
    .nav-a.active{background:var(--grad);color:white;font-weight:500}
    .nav-a svg{width:18px;height:18px;stroke:currentColor;fill:none;stroke-width:1.8;stroke-linecap:round;stroke-linejoin:round;flex-shrink:0}
    .nb{margin-left:auto;background:var(--purple-light);color:white;font-size:.68rem;font-weight:600;padding:2px 7px;border-radius:20px}
    .nav-a.active .nb{background:rgba(255,255,255,.25)}
    .sb-footer{margin-top:auto;padding:14px 10px}
    .logout{display:flex;align-items:center;gap:10px;padding:10px 14px;border-radius:10px;font-size:.87rem;color:rgba(255,255,255,.42);cursor:pointer;transition:all .18s;text-decoration:none;border:none;background:none;width:100%;font-family:'DM Sans',sans-serif}
    .logout:hover{background:rgba(220,38,38,.12);color:#FCA5A5}
    .logout svg{width:17px;height:17px;stroke:currentColor;fill:none;stroke-width:1.8;stroke-linecap:round;stroke-linejoin:round}

    /* MAIN */
    .main{margin-left:var(--sidebar-w);min-height:100vh;display:flex;flex-direction:column}
    .topbar{height:var(--topbar-h);background:white;border-bottom:1px solid var(--gray-100);display:flex;align-items:center;padding:0 32px;gap:14px;position:sticky;top:0;z-index:50}
    .menu-btn{display:none;background:none;border:none;cursor:pointer;padding:6px;color:var(--gray-700)}
    .menu-btn svg{width:22px;height:22px;stroke:currentColor;fill:none;stroke-width:2;stroke-linecap:round}
    .tb-title{font-family:'Sora',sans-serif;font-size:1.05rem;font-weight:600;color:var(--gray-900)}
    .tb-right{margin-left:auto;display:flex;align-items:center;gap:12px}
    .tb-date{font-size:.8rem;color:var(--gray-500)}
    .notif-btn{position:relative;width:38px;height:38px;border-radius:10px;background:var(--gray-100);border:none;cursor:pointer;display:flex;align-items:center;justify-content:center;transition:background .18s}
    .notif-btn:hover{background:var(--gray-300)}
    .notif-btn svg{width:18px;height:18px;stroke:var(--gray-700);fill:none;stroke-width:1.8;stroke-linecap:round;stroke-linejoin:round}
    .ndot{position:absolute;top:8px;right:9px;width:7px;height:7px;border-radius:50%;background:var(--red);border:2px solid white}

    .content{padding:28px 32px;flex:1}

    /* WELCOME */
    .welcome{background:var(--grad);border-radius:18px;padding:26px 30px;display:flex;align-items:center;justify-content:space-between;margin-bottom:26px;position:relative;overflow:hidden}
    .welcome::before{content:'';position:absolute;top:-60px;right:-60px;width:220px;height:220px;border-radius:50%;background:rgba(255,255,255,.06)}
    .welcome::after{content:'';position:absolute;bottom:-80px;left:38%;width:200px;height:200px;border-radius:50%;background:rgba(255,255,255,.04)}
    .w-text{z-index:1}
    .w-text h2{font-family:'Sora',sans-serif;font-size:1.3rem;font-weight:600;color:white;margin-bottom:4px}
    .w-text p{font-size:.87rem;color:rgba(255,255,255,.7);font-weight:300}
    .w-badge{z-index:1;background:rgba(255,255,255,.15);border:1px solid rgba(255,255,255,.25);color:white;font-size:.82rem;font-weight:500;padding:8px 16px;border-radius:20px;backdrop-filter:blur(6px)}

    /* STATS */
    .stats-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:14px;margin-bottom:24px}
    .stat-card{background:white;border-radius:16px;padding:20px 22px;border:1px solid var(--gray-100);display:flex;align-items:center;gap:14px;transition:box-shadow .2s;cursor:default}
    .stat-card:hover{box-shadow:0 4px 20px rgba(107,63,212,.08)}
    .si{width:46px;height:46px;border-radius:13px;display:flex;align-items:center;justify-content:center;flex-shrink:0}
    .si svg{width:22px;height:22px;stroke:currentColor;fill:none;stroke-width:1.8;stroke-linecap:round;stroke-linejoin:round}
    .si.p{background:var(--purple-pale);color:var(--purple)}
    .si.b{background:var(--blue-pale);color:var(--blue)}
    .si.g{background:var(--green-pale);color:var(--green)}
    .si.a{background:var(--amber-pale);color:var(--amber)}
    .sn{font-family:'Sora',sans-serif;font-size:1.6rem;font-weight:600;color:var(--gray-900);line-height:1}
    .sl{font-size:.78rem;color:var(--gray-500);margin-top:3px}
    .s-mine{font-size:.72rem;color:var(--purple);font-weight:500;margin-top:2px}

    /* GRID */
    .main-grid{display:grid;grid-template-columns:1.55fr 1fr;gap:18px;margin-bottom:18px}
    .side-grid{display:grid;grid-template-columns:1fr 1fr;gap:18px}

    /* PANEL */
    .panel{background:white;border-radius:16px;border:1px solid var(--gray-100);overflow:hidden}
    .ph{padding:16px 22px;border-bottom:1px solid var(--gray-100);display:flex;align-items:center;justify-content:space-between}
    .pt{font-size:.92rem;font-weight:600;color:var(--gray-900)}
    .pl{font-size:.79rem;color:var(--purple);text-decoration:none;font-weight:500}
    .pl:hover{text-decoration:underline}

    /* TABLE REQUETES */
    .req-table{width:100%;border-collapse:collapse}
    .req-table thead th{padding:11px 18px;text-align:left;font-size:.73rem;font-weight:600;letter-spacing:.5px;text-transform:uppercase;color:var(--gray-500);background:var(--gray-100);border-bottom:1px solid var(--gray-300)}
    .req-table tbody tr{border-bottom:1px solid var(--gray-100);transition:background .15s;cursor:pointer}
    .req-table tbody tr:last-child{border-bottom:none}
    .req-table tbody tr:hover{background:#F9F8FF}
    .req-table td{padding:13px 18px;font-size:.855rem;color:var(--gray-700);vertical-align:middle}
    .rid{width:34px;height:34px;border-radius:8px;background:var(--grad-soft);color:var(--purple);font-size:.76rem;font-weight:700;display:flex;align-items:center;justify-content:center}
    .etu-name{font-weight:500;color:var(--gray-900)}
    .etu-mat{font-size:.76rem;color:var(--gray-500)}
    .objet-lbl{font-size:.84rem;color:var(--gray-700)}
    .status{display:inline-flex;align-items:center;gap:4px;font-size:.74rem;font-weight:500;padding:3px 10px;border-radius:20px}
    .status::before{content:'';width:5px;height:5px;border-radius:50%;flex-shrink:0}
    .s-pending{background:var(--amber-pale);color:var(--amber)}
    .s-pending::before{background:var(--amber)}

    /* MESSAGES LIST */
    .msg-list{padding:6px 0}
    .msg-item{padding:13px 20px;display:flex;align-items:flex-start;gap:11px;border-bottom:1px solid var(--gray-100);transition:background .15s;cursor:pointer}
    .msg-item:last-child{border-bottom:none}
    .msg-item:hover{background:#F9F8FF}
    .msg-av{width:34px;height:34px;border-radius:50%;background:var(--grad);color:white;font-size:.78rem;font-weight:600;display:flex;align-items:center;justify-content:center;flex-shrink:0}
    .msg-sender{font-size:.84rem;font-weight:600;color:var(--gray-900)}
    .to-right{background-color: var(--amber-pale);width:25px;height:25px;display: flex;align-items: center;justify-content:center;border-radius:50%;font-size:.84rem;color:var(--red); float: right;}
    .msg-preview{font-size:.76rem;color:var(--gray-500);margin-top:2px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;max-width:180px}
    .msg-empty,.req-empty{padding:28px 20px;text-align:center;font-size:.84rem;color:var(--gray-500)}

    /* CHART OBJETS */
    .chart-body{padding:16px 20px}
    .bar-row{margin-bottom:14px}
    .bar-row:last-child{margin-bottom:0}
    .bar-label{display:flex;justify-content:space-between;font-size:.8rem;margin-bottom:5px}
    .bar-name{color:var(--gray-700);font-weight:500;max-width:180px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap}
    .bar-count{color:var(--gray-500);font-weight:600}
    .bar-track{height:8px;background:var(--gray-100);border-radius:10px;overflow:hidden}
    .bar-fill{height:100%;border-radius:10px;background:var(--grad);transition:width .6s ease}

    /* ACTIONS RAPIDES */
    .quick-acts{padding:12px 14px;display:flex;flex-direction:column;gap:8px}
    .qa{display:flex;align-items:center;gap:12px;padding:11px 14px;border-radius:11px;background:var(--gray-100);cursor:pointer;text-decoration:none;transition:background .18s}
    .qa:hover{background:var(--purple-pale)}
    .qa:hover .qa-icon{background:var(--purple);color:white}
    .qa-icon{width:34px;height:34px;border-radius:9px;background:white;color:var(--purple);display:flex;align-items:center;justify-content:center;flex-shrink:0;transition:all .18s}
    .qa-icon svg{width:16px;height:16px;stroke:currentColor;fill:none;stroke-width:2;stroke-linecap:round;stroke-linejoin:round}
    .qa-label{font-size:.85rem;font-weight:500;color:var(--gray-700)}
    .qa-desc{font-size:.73rem;color:var(--gray-500);margin-top:1px}
    .qa-arr{margin-left:auto;color:var(--gray-300)}
    .qa-arr svg{width:14px;height:14px;stroke:currentColor;fill:none;stroke-width:2;stroke-linecap:round;stroke-linejoin:round}

    .overlay{display:none;position:fixed;inset:0;background:rgba(0,0,0,.4);z-index:90}
    .overlay.show{display:block}



    @media(max-width:1100px){.stats-grid{grid-template-columns:repeat(2,1fr)}.main-grid{grid-template-columns:1fr}.side-grid{grid-template-columns:1fr}}
    @media(max-width:900px){.sidebar{transform:translateX(-100%)}.sidebar.open{transform:translateX(0)}.main{margin-left:0}.menu-btn{display:flex}}
    @media(max-width:600px){.content{padding:16px 14px}.topbar{padding:0 14px}.welcome{flex-direction:column;align-items:flex-start;gap:14px}.stats-grid{grid-template-columns:1fr 1fr}}
  </style>
</head>
<body>

<div class="overlay" id="overlay" onclick="closeSB()"></div>

<aside class="sidebar" id="sidebar">
  <div class="sb-brand">
    <div class="sb-logo"><img src="../assets/logo.png" alt="FlowreQuest"/></div>
    <div class="sb-brand-text">
      <div class="bname">FlowRequest</div>
      <div class="brole"><span>Administration</span><span class="admin-badge">Admin</span></div>
    </div>
  </div>

  <div class="sb-user">
    <div class="avatar"><?php echo strtoupper(substr($_SESSION['admin']['nom']??'A',0,1).substr($_SESSION['admin']['prenom'],0,1)); ?></div>
    <div>
      <div class="u-name"><?php echo htmlspecialchars(($_SESSION['admin']['nom']??'').' '.$_SESSION['admin']['prenom']); ?></div>
      <div class="u-role">Administrateur</div>
    </div>
  </div>

  <nav class="nav-sec">
    <div class="nav-lbl">Principal</div>
    <a href="index" class="nav-a index">
      <svg viewBox="0 0 24 24"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>
      Tableau de bord
    </a>
    <a href="requete" class="nav-a requetes">
      <svg viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
      Requêtes
    <span class="nb"><?php echo $this->DashbordAdmin->total_req;?> </span>
    </a>
    <a href="message" class="nav-a message">
      <svg viewBox="0 0 24 24"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
      Messagerie
      <span class="nb"><?php echo $this->DashbordAdmin->total_msg;?></span>
    </a>
  </nav>

  <nav class="nav-sec">
    <div class="nav-lbl">Gestion</div>
    <a href="etudiant" class="nav-a etudiant">
      <svg viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
      Étudiants
      <span class="nb"><?php //echo $total_etudiants; ?></span>
    </a>
    <a href="objet" class="nav-a objet">
      <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="3"/><path d="M19.07 4.93a10 10 0 0 1 0 14.14"/><path d="M4.93 4.93a10 10 0 0 0 0 14.14"/></svg>
      Objets de requête
    </a>
    <a href="rapports.php" class="nav-a">
      <svg viewBox="0 0 24 24"><line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/></svg>
      Rapports
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
  <?= $content; ?>
</div>

<script>
  const d=new Date();
  document.getElementById('dateEl').textContent=d.toLocaleDateString('fr-FR',{weekday:'long',day:'numeric',month:'long',year:'numeric'});
  function toggleSB(){document.getElementById('sidebar').classList.toggle('open');document.getElementById('overlay').classList.toggle('show')}
  function closeSB(){document.getElementById('sidebar').classList.remove('open');document.getElementById('overlay').classList.remove('show')}
</script>
  
</body>
</html>
