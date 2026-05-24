

<style>    .index{background:var(--grad);color:white;font-weight:500;}</style>
<header class="topbar">
    <button class="menu-btn" onclick="toggleSB()">
      <svg viewBox="0 0 24 24"><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
    </button>
    <span class="tb-title">Tableau de bord</span>
    <div class="tb-right">
      <span class="tb-date" id="dateEl"></span>
      <button class="notif-btn">
        <svg viewBox="0 0 24 24"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/></svg>
        <?php //if(count($derniers_msgs)>0): ?><span class="ndot"></span><?php //endif; ?>
      </button>
    </div>
</header>

<div class="content">

    <!-- WELCOME -->
    <div class="welcome">
      <div class="w-text">
        <h2>Bonjour, <?php echo htmlspecialchars($_SESSION['admin']['nom']); ?> 👋</h2>
        <p>Voici un aperçu de l'activité de la plateforme FlowreQuest.</p>
      </div>
      <div class="w-badge">
        <?php echo $this->DashbordAdmin->total_req; ?> requête<?php echo $this->DashbordAdmin->total_req>1?'s':''; ?> vous <?php echo $this->DashbordAdmin->total_req==1?'est':'sont'; ?> assignée<?php echo $this->DashbordAdmin->total_req>1?'s':''; ?>
      </div>
    </div>

    <!-- STATS -->
    <div class="stats-grid">
      <div class="stat-card">
        <div class="si p"><svg viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg></div>
        <div>
          <div class="sn"><?php echo $this->DashbordAdmin->total_req; ?></div>
          <div class="sl">Total requêtes</div>
          <div class="s-mine"><?php echo $this->DashbordAdmin->total_req; ?> assignée<?php echo $this->DashbordAdmin->total_req>1?'s':''; ?> à moi</div>
        </div>
      </div>
      <div class="stat-card">
        <div class="si b"><svg viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg></div>
        <div>
          <div class="sn"><?php //echo $total_etudiants; ?></div>
          <div class="sl">Étudiants inscrits</div>
        </div>
      </div>
      <div class="stat-card">
        <div class="si g"><svg viewBox="0 0 24 24"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg></div>
        <div>
          <div class="sn"><?php echo $this->DashbordAdmin->total_msg;?></div>
          <div class="sl">Messages échangés</div>
        </div>
      </div>
      <div class="stat-card">
        <div class="si a"><svg viewBox="0 0 24 24"><path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"/><polyline points="13 2 13 9 20 9"/></svg></div>
        <div>
          <div class="sn"><?php //echo $total_pieces; ?></div>
          <div class="sl">Pièces jointes</div>
        </div>
      </div>
    </div>

    <!-- MAIN GRID -->
    <div class="main-grid">

      <!-- Dernières requêtes -->
      <div class="panel">
        <div class="ph">
          <span class="pt">Dernières requêtes</span>
          <a href="requete" class="pl">Voir tout →</a>
        </div>
        <div style="overflow-x:auto">
          <?php if(empty($this->DashbordAdmin->requetes)): ?>
            <div class="req-empty">Aucune requête enregistrée.</div>
          <?php else: ?>
            <table class="req-table">
              <thead>
                <tr>
                  <th style="width:48px">#</th>
                  <th>Étudiant</th>
                  <th>Objet</th>
                  <th>Statut</th>
                </tr>
              </thead>
              <tbody>
                <?php $i=1; foreach($this->DashbordAdmin->requetes as $r):  if($i>1): break; endif;?>
                  <tr onclick="location.href='requete'">
                    <td><div class="rid"><?php echo $r['id_requete']; ?></div></td>
                    <td>
                      <div class="etu-name"><?php echo htmlspecialchars($r['nom'].' '.$r['nom']); ?></div>
                      <div class="etu-mat"><?php echo htmlspecialchars($r['matricule']); ?></div>
                    </td>
                    <td><span class="objet-lbl"><?php echo htmlspecialchars($r['libelle_objet']); ?></span></td>
                    <td><span class="status s-pending">En attente</span></td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          <?php endif; ?>
        </div>
      </div>

      <!-- Messages reçus -->
      <div class="panel">
        <div class="ph">
          <span class="pt">Messages reçus</span>
          <a href="message" class="pl">Voir tout →</a>
        </div>
        <div class="msg-list">
          <?php
              
              if(empty($this->DashbordAdmin->Etudmsg)): ?>
            <div class="msg-empty">Aucun message reçu.</div>
          <?php else:?>
            
            <?php $i=1; foreach($this->DashbordAdmin->Etudmsg as $m): if($i>1): break; endif;?>
              <div class="msg-item" onclick="location.href='message'">
                <div class="msg-av"><?php echo strtoupper(substr($m['prenom'],0,1).substr($m['nom'],0,1)); ?></div>
                <div style="min-width:0">
                  <div class="msg-sender"><?php echo htmlspecialchars($m['prenom'].' '.$m['nom']); ?></div>
                  <div class="msg-sender to-right"><?php echo($n  = $this->DashbordAdmin->getMsgPerEtud($m['matricule'])); ?></div>
                </div>
              </div>
            <?php endforeach; ?>
          <?php endif; ?>
          
        </div>
      </div>
    </div>

    <!-- SIDE GRID -->
    <div class="side-grid">

      <!-- Répartition par objet -->
      <div class="panel">
        <div class="ph"><span class="pt">Requêtes par objet</span></div>
        <div class="chart-body">
          <?php
          $max = empty($this->DashbordAdmin->objets) ? sizeof($this->DashbordAdmin->objets) : 1;
          foreach($this->DashbordAdmin->objets as $obj):
            $tot = $this->DashbordAdmin->getNombre("requete", "id_objet", $obj['id_objet']);
            $pct = round((sizeof($tot)/ $max) * 100);
          ?>
            <div class="bar-row">
              <div class="bar-label">
                <span class="bar-name"><?php echo htmlspecialchars($obj['libelle_objet']); ?></span>
                <span class="bar-count"><?php echo sizeof($tot); ?></span>
              </div>
              <div class="bar-track"><div class="bar-fill" style="width:<?php echo $pct; ?>%"></div></div>
            </div>
          <?php endforeach; ?>
          <?php if(empty($this->DashbordAdmin->objets)): var_dump($this->DashbordAdmin->objets); ?>
            <p style="font-size:.84rem;color:var(--gray-500);text-align:center;padding:16px 0">Aucune donnée disponible.</p>
          <?php endif; ?>
        </div>
      </div>

      <!-- Actions rapides -->
      <div class="panel">
        <div class="ph"><span class="pt">Actions rapides</span></div>
        <div class="quick-acts">
          <a href="requete" class="qa">
            <div class="qa-icon"><svg viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg></div>
            <div><div class="qa-label">Gérer les requêtes</div><div class="qa-desc">Traiter les demandes en attente</div></div>
            <span class="qa-arr"><svg viewBox="0 0 24 24"><polyline points="9 18 15 12 9 6"/></svg></span>
          </a>
          <a href="message" class="qa">
            <div class="qa-icon"><svg viewBox="0 0 24 24"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg></div>
            <div><div class="qa-label">Messagerie</div><div class="qa-desc">Répondre aux étudiants</div></div>
            <span class="qa-arr"><svg viewBox="0 0 24 24"><polyline points="9 18 15 12 9 6"/></svg></span>
          </a>
          <a href="etudiant" class="qa">
            <div class="qa-icon"><svg viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg></div>
            <div><div class="qa-label">Étudiants</div><div class="qa-desc">Voir la liste complète</div></div>
            <span class="qa-arr"><svg viewBox="0 0 24 24"><polyline points="9 18 15 12 9 6"/></svg></span>
          </a>
          <a href="objet" class="qa">
            <div class="qa-icon"><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="3"/><path d="M19.07 4.93a10 10 0 0 1 0 14.14"/><path d="M4.93 4.93a10 10 0 0 0 0 14.14"/></svg></div>
            <div><div class="qa-label">Objets de requête</div><div class="qa-desc">Gérer les types de demandes</div></div>
            <span class="qa-arr"><svg viewBox="0 0 24 24"><polyline points="9 18 15 12 9 6"/></svg></span>
          </a>
          <a href="rapport" class="qa">
            <div class="qa-icon"><svg viewBox="0 0 24 24"><line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/></svg></div>
            <div><div class="qa-label">Rapports</div><div class="qa-desc">Statistiques et analyses</div></div>
            <span class="qa-arr"><svg viewBox="0 0 24 24"><polyline points="9 18 15 12 9 6"/></svg></span>
          </a>
        </div>
      </div>
    </div>

</div>
