  <style>.index{background:var(--grad);color:white;font-weight:500}</style>
  <header class="topbar">
    <button class="menu-btn" onclick="toggleSB()">
      <svg viewBox="0 0 24 24"><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
    </button>
    <span class="tb-title">Tableau de bord</span>
    <div class="tb-right">
      <span class="tb-date" id="dateEl"></span>
      <button class="notif-btn">
        <svg viewBox="0 0 24 24"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/></svg>
        <?php if($this->DashbordEtudiant->total_msg!==null): ?><span class="ndot"></span><?php endif; ?>
      </button>
    </div>
  </header>

  <div class="content">

    <div class="welcome">
      <div class="w-text">
        <h2>Hello, <?= strtoupper($_SESSION['etudiant']['nom']); ?> 👋</h2>
        <p>Bienvenue sur FlowreQuest — gérez vos demandes administratives facilement.</p>
      </div>
      <a href="nouvelle_requete" class="btn-new">
        <svg viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
        Nouvelle requête
      </a>
    </div>

    <div class="stats-grid">
      <div class="stat-card">
        <div class="si p"><svg viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg></div>
        <div><div class="sn"><?=  $this->DashbordEtudiant->total_req ?></div><div class="sl">Requêtes soumises</div></div>
      </div>
      <div class="stat-card">
        <div class="si b"><svg viewBox="0 0 24 24"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg></div>
        <div><div class="sn"><?= $this->DashbordEtudiant->total_msg; ?></div><div class="sl">Messages reçus</div></div>
      </div>
      <div class="stat-card">
        <div class="si g"><svg viewBox="0 0 24 24"><path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"/><polyline points="13 2 13 9 20 9"/></svg></div>
        <div><div class="sn"><?php //echo $total_pj; ?></div><div class="sl">Pièces jointes</div></div>
      </div>
    </div>

    <div class="bottom-grid">
      <div class="panel">
        <div class="ph">
          <span class="pt">Requêtes récentes</span>
          <a href="requete" class="pl">Voir tout →</a>
        </div>
        <div class="req-list">
          <?php if($this->DashbordEtudiant->total_msg === null): ?>
            <div class="r-empty">Aucune requête soumise pour le moment.<br><a href="nouvelle_requete">Créer votre première requête</a></div>
          <?php else: ?>
            <?php foreach($this->DashbordEtudiant->requetes as $r): ?>
            <div class="ri" onclick="location.href='requete'">
              <div class="rn">#<?php echo $r['id_requete']; ?></div>
              <div class="ri-info">
                <div class="ro"><?php echo htmlspecialchars($r['libelle_objet']); ?></div>
                <div class="ra">Assigné à <?php //echo htmlspecialchars($r['admin_nom']); ?></div>
              </div>
              <span class="rs">En attente</span>
            </div>
            <?php endforeach; ?>
          <?php endif; ?>
        </div>
      </div>

      <div class="panel">
        <div class="ph"><span class="pt">Actions rapides</span></div>
        <div class="act-list">
          <a href="nouvelle_requete" class="act">
            <div class="ai"><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="16"/><line x1="8" y1="12" x2="16" y2="12"/></svg></div>
            <div><div class="al">Soumettre une requête</div><div class="ad">Nouvelle demande admin.</div></div>
            <span class="aa"><svg viewBox="0 0 24 24"><polyline points="9 18 15 12 9 6"/></svg></span>
          </a>
          <a href="dossier" class="act">
            <div class="ai"><svg viewBox="0 0 24 24"><path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"/></svg></div>
            <div><div class="al">Mon dossier</div><div class="ad">Gérer mes pièces jointes</div></div>
            <span class="aa"><svg viewBox="0 0 24 24"><polyline points="9 18 15 12 9 6"/></svg></span>
          </a>
          <a href="messages" class="act">
            <div class="ai"><svg viewBox="0 0 24 24"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg></div>
            <div><div class="al">Messagerie</div><div class="ad">Contacter l'administration</div></div>
            <span class="aa"><svg viewBox="0 0 24 24"><polyline points="9 18 15 12 9 6"/></svg></span>
          </a>
          <a href="" class="act">
            <div class="ai"><svg viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg></div>
            <div><div class="al">Mon profil</div><div class="ad">Modifier mes informations</div></div>
            <span class="aa"><svg viewBox="0 0 24 24"><polyline points="9 18 15 12 9 6"/></svg></span>
          </a>
        </div>
      </div>
    </div>
  </div>