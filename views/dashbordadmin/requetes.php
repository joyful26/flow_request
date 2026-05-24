

<style>

    .main{margin-left:var(--sidebar-w);min-height:100vh;display:flex;flex-direction:column}
    .topbar{height:var(--topbar-h);background:white;border-bottom:1px solid var(--gray-100);display:flex;align-items:center;padding:0 32px;gap:14px;position:sticky;top:0;z-index:50}
    .menu-btn{display:none;background:none;border:none;cursor:pointer;padding:6px;color:var(--gray-700)}
    .menu-btn svg{width:22px;height:22px;stroke:currentColor;fill:none;stroke-width:2;stroke-linecap:round}
    .tb-title{font-family:'Sora',sans-serif;font-size:1.05rem;font-weight:600;color:var(--gray-900)}
    .tb-right{margin-left:auto;display:flex;align-items:center;gap:10px}
    .btn-new{display:inline-flex;align-items:center;gap:7px;padding:9px 18px;background:var(--grad);color:white;border:none;border-radius:10px;font-family:'DM Sans',sans-serif;font-size:.85rem;font-weight:600;cursor:pointer;text-decoration:none;transition:opacity .18s}
    .btn-new:hover{opacity:.9}
    .btn-new svg{width:15px;height:15px;stroke:white;fill:none;stroke-width:2.2;stroke-linecap:round;stroke-linejoin:round}

    .content{padding:28px 32px;flex:1}

    .toolbar{display:flex;align-items:center;gap:12px;margin-bottom:22px;flex-wrap:wrap}
    .search-wrap{position:relative;flex:1;min-width:200px}
    .search-wrap svg{position:absolute;left:13px;top:50%;transform:translateY(-50%);width:16px;height:16px;stroke:var(--gray-300);fill:none;stroke-width:2;stroke-linecap:round;stroke-linejoin:round;pointer-events:none}
    .search-input{width:100%;padding:10px 13px 10px 40px;border:1.5px solid var(--gray-300);border-radius:10px;font-family:'DM Sans',sans-serif;font-size:.88rem;color:var(--gray-900);background:white;outline:none;transition:border-color .2s,box-shadow .2s}
    .search-input:focus{border-color:var(--purple-light);box-shadow:0 0 0 3px rgba(139,92,246,.1)}
    .filter-tabs{display:flex;gap:6px}
    .ftab{padding:9px 16px;border-radius:10px;font-size:.82rem;font-weight:500;cursor:pointer;border:1.5px solid var(--gray-300);background:white;color:var(--gray-500);text-decoration:none;transition:all .18s}
    .ftab:hover{border-color:var(--purple-light);color:var(--purple)}
    .ftab.active{background:var(--grad);color:white;border-color:transparent}

    .summary-bar{display:flex;align-items:center;gap:16px;margin-bottom:18px}
    .sum-count{font-size:.88rem;color:var(--gray-500)}
    .sum-count strong{color:var(--gray-900);font-weight:600}

    .req-table{background:white;border-radius:16px;border:1px solid var(--gray-100);overflow:hidden}
    .req-table table{width:100%;border-collapse:collapse}
    .req-table thead th{padding:13px 20px;text-align:left;font-size:.75rem;font-weight:600;letter-spacing:.5px;text-transform:uppercase;color:var(--gray-500);background:var(--gray-100);border-bottom:1px solid var(--gray-300)}
    .req-table tbody tr{border-bottom:1px solid var(--gray-100);transition:background .15s;cursor:pointer}
    .req-table tbody tr:last-child{border-bottom:none}
    .req-table tbody tr:hover{background:#F9F8FF}
    .req-table td{padding:15px 20px;font-size:.875rem;color:var(--gray-700);vertical-align:middle}

    .req-id{display:inline-flex;align-items:center;justify-content:center;width:36px;height:36px;border-radius:9px;background:var(--grad-soft);color:var(--purple);font-size:.78rem;font-weight:700}
    .req-objet{font-weight:500;color:var(--gray-900);margin-bottom:2px}
    .req-admin-name{font-size:.78rem;color:var(--gray-500)}
    .pieces-badge{display:inline-flex;align-items:center;gap:4px;font-size:.76rem;color:var(--gray-500);background:var(--gray-100);padding:3px 9px;border-radius:20px}
    .pieces-badge svg{width:12px;height:12px;stroke:currentColor;fill:none;stroke-width:2;stroke-linecap:round;stroke-linejoin:round}

    .status{display:inline-flex;align-items:center;gap:5px;font-size:.76rem;font-weight:500;padding:4px 11px;border-radius:20px}
    .status::before{content:'';width:6px;height:6px;border-radius:50%;flex-shrink:0}
    .s-pending{background:var(--amber-pale);color:var(--amber)}
    .s-pending::before{background:var(--amber)}
    .s-done{background:var(--green-pale);color:var(--green)}
    .s-done::before{background:var(--green)}
    .s-rejected{background:var(--red-pale);color:var(--red)}
    .s-rejected::before{background:var(--red)}

    .action-btns{display:flex;align-items:center;gap:6px}
    .btn-icon{width:32px;height:32px;border-radius:8px;border:none;background:var(--gray-100);cursor:pointer;display:flex;align-items:center;justify-content:center;transition:all .18s;text-decoration:none}
    .btn-icon:hover{background:var(--purple-pale);color:var(--purple)}
    .btn-icon svg{width:15px;height:15px;stroke:var(--gray-500);fill:none;stroke-width:2;stroke-linecap:round;stroke-linejoin:round}
    .btn-icon:hover svg{stroke:var(--purple)}
    .btn-icon.del:hover{background:var(--red-pale)}
    .btn-icon.del:hover svg{stroke:var(--red)}

    .empty-state{padding:60px 24px;text-align:center}
    .empty-icon{width:64px;height:64px;border-radius:16px;background:var(--grad-soft);display:flex;align-items:center;justify-content:center;margin:0 auto 16px}
    .empty-icon svg{width:30px;height:30px;stroke:var(--purple);fill:none;stroke-width:1.8;stroke-linecap:round;stroke-linejoin:round}
    .empty-state h3{font-size:1rem;font-weight:600;color:var(--gray-900);margin-bottom:6px}
    .empty-state p{font-size:.87rem;color:var(--gray-500);margin-bottom:20px}
    .btn-primary{display:inline-flex;align-items:center;gap:7px;padding:10px 20px;background:var(--grad);color:white;border:none;border-radius:10px;font-family:'DM Sans',sans-serif;font-size:.87rem;font-weight:600;cursor:pointer;text-decoration:none}

    .modal-overlay{display:none;position:fixed;inset:0;background:rgba(0,0,0,.45);z-index:200;align-items:center;justify-content:center}
    .modal-overlay.show{display:flex}
    .modal{background:white;border-radius:18px;padding:32px;width:100%;max-width:480px;margin:16px;animation:fadeUp .25s ease}
    .modal h3{font-size:1.1rem;font-weight:600;color:var(--gray-900);margin-bottom:8px}
    .modal p{font-size:.88rem;color:var(--gray-500);margin-bottom:24px;line-height:1.6}
    .modal-info{background:var(--gray-100);border-radius:10px;padding:14px 16px;margin-bottom:24px}
    .modal-info .mi-row{display:flex;gap:8px;font-size:.85rem;margin-bottom:6px}
    .modal-info .mi-row:last-child{margin-bottom:0}
    .mi-label{color:var(--gray-500);min-width:80px}
    .mi-val{color:var(--gray-900);font-weight:500}
    .modal-actions{display:flex;gap:10px;justify-content:flex-end}
    .btn-cancel{padding:10px 20px;border:1.5px solid var(--gray-300);border-radius:10px;background:white;font-family:'DM Sans',sans-serif;font-size:.87rem;font-weight:500;color:var(--gray-700);cursor:pointer;transition:all .18s}
    .btn-cancel:hover{border-color:var(--gray-500)}
    .btn-danger{padding:10px 20px;border:none;border-radius:10px;background:var(--red);font-family:'DM Sans',sans-serif;font-size:.87rem;font-weight:600;color:white;cursor:pointer;transition:opacity .18s}
    .btn-danger:hover{opacity:.88}

    .detail-panel{background:white;border-radius:16px;border:1px solid var(--gray-100);padding:24px;margin-top:20px;display:none}
    .detail-panel.show{display:block;animation:fadeUp .2s ease}
    .dp-header{display:flex;align-items:center;justify-content:space-between;margin-bottom:18px}
    .dp-title{font-size:1rem;font-weight:600;color:var(--gray-900)}
    .dp-close{background:none;border:none;cursor:pointer;color:var(--gray-500);padding:4px;border-radius:6px;display:flex;align-items:center}
    .dp-close:hover{background:var(--gray-100)}
    .dp-close svg{width:18px;height:18px;stroke:currentColor;fill:none;stroke-width:2;stroke-linecap:round;stroke-linejoin:round}
    .dp-grid{display:grid;grid-template-columns:1fr 1fr;gap:14px}
    .dp-field label{font-size:.74rem;font-weight:600;letter-spacing:.4px;text-transform:uppercase;color:var(--gray-500);display:block;margin-bottom:4px}
    .dp-field span{font-size:.88rem;color:var(--gray-900);font-weight:500}
    .pieces-list{margin-top:16px}
    .pieces-list-title{font-size:.8rem;font-weight:600;letter-spacing:.4px;text-transform:uppercase;color:var(--gray-500);margin-bottom:10px}
    .pj-item{display:flex;align-items:center;gap:10px;padding:10px 14px;border-radius:10px;background:var(--gray-100);margin-bottom:7px}
    .pj-icon{width:30px;height:30px;border-radius:8px;background:var(--purple-pale);display:flex;align-items:center;justify-content:center;flex-shrink:0}
    .pj-icon svg{width:15px;height:15px;stroke:var(--purple);fill:none;stroke-width:2;stroke-linecap:round;stroke-linejoin:round}
    .pj-name{font-size:.84rem;font-weight:500;color:var(--gray-900)}

    /* ALERTS */
    .alert{display:flex;align-items:center;gap:10px;padding:12px 16px;border-radius:11px;font-size:.86rem;margin-bottom:20px}
    .alert svg{width:17px;height:17px;stroke:currentColor;fill:none;stroke-width:2;stroke-linecap:round;stroke-linejoin:round;flex-shrink:0}
    .alert-success{background:var(--green-pale);color:var(--green)}
    .alert-error{background:var(--red-pale);color:var(--red)}


    .requetes{background:var(--grad);color:white;font-weight:500;}

    .overlay{display:none;position:fixed;inset:0;background:rgba(0,0,0,.4);z-index:90}
    .overlay.show{display:block}
    @keyframes fadeUp{from{opacity:0;transform:translateY(14px)}to{opacity:1;transform:translateY(0)}}

    @media(max-width:900px){.sidebar{transform:translateX(-100%)}.sidebar.open{transform:translateX(0)}.main{margin-left:0}.menu-btn{display:flex}.req-table thead th:nth-child(3),.req-table td:nth-child(3){display:none}.dp-grid{grid-template-columns:1fr}}
    @media(max-width:600px){.content{padding:18px 14px}.topbar{padding:0 14px}.filter-tabs{display:none}.req-table thead th:nth-child(4),.req-table td:nth-child(4){display:none}}
  </style>

<header class="topbar">
    <button class="menu-btn" onclick="toggleSB()">
      <svg viewBox="0 0 24 24"><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
    </button>
    <span class="tb-title">Gestion des requêtes </span>
  </header>

  <div class="content">

    <?php if($success===1): ?>
      <div class="alert alert-success">
        <svg viewBox="0 0 24 24"><path d="M9 12l2 2 4-4"/><circle cx="12" cy="12" r="10"/></svg>
        <?= $success_msg ?>
      </div>
    <?php endif; ?>
    <?php if($error===1): ?>
      <div class="alert alert-error">
        <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
        <?php echo htmlspecialchars($error_msg); ?>
      </div>
    <?php endif; ?>


    <div class="req-table">
      <?php if(empty($this->DashbordAdmin->requetes)): ?>
        <div class="empty-state">
          <div class="empty-icon"><svg viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg></div>       
            <a href="" class="btn-primary">
              Aucune requête pour vous 
            </a>
          
        </div>
      <?php  else: ?>
        <table>
          <thead>
            <tr>
              <th style="width:52px">#</th>
              <th>Objet de la requête</th>
              <th>Administrateur</th>
              <th>Pièces jointes</th>
              <th>Statut</th>
              <th style="width:90px">Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($this->DashbordAdmin->requetes as $r): ?>
            <tr onclick="showDetail(<?php echo htmlspecialchars(json_encode($r)); ?>)">
              <td><span class="req-id"><?php echo $r['id_requete']; ?></span></td>
              <td>
                <div class="req-objet"><?php echo htmlspecialchars($r['libelle_objet']); ?></div>
              </td>
              <td>
                <div class="req-admin-name"><?php //echo htmlspecialchars($r['admin_prenom'].' '.$r['admin_nom']); ?></div>
              </td>
              <td>
                <span class="pieces-badge">
                  <svg viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                  <?php //echo $r['nb_pieces']; ?> fichier<?php //echo $r['nb_pieces']>1?'s':''; ?>
                </span>
              </td>
              <td><span class="status s-pending">En attente</span></td>
              <td onclick="event.stopPropagation()">
                <div class="action-btns">
                  <button class="btn-icon" title="Voir détails" onclick="showDetail(<?php echo htmlspecialchars(json_encode($r)); ?>)">
                    <svg viewBox="0 0 24 24"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                  </button>
                  <button class="btn-icon del" title="Supprimer" onclick="confirmDelete(<?php echo $r['id_requete']; ?>, '<?php echo htmlspecialchars($r['libelle_objet'],ENT_QUOTES); ?>')">
                    <svg viewBox="0 0 24 24"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/><path d="M10 11v6"/><path d="M14 11v6"/><path d="M9 6V4h6v2"/></svg>
                  </button>
                </div>
              </td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      <?php endif; ?>
    </div>

    <div class="detail-panel" id="detailPanel">
      <div class="dp-header">
        <span class="dp-title" id="dpTitle">Détails de la requête</span>
        <button class="dp-close" onclick="closeDetail()">
          <svg viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
        </button>
      </div>
      <div class="dp-grid">
        <div class="dp-field"><label>Numéro</label><span id="dpId"></span></div>
        <div class="dp-field"><label>Statut</label><span id="dpStatus"></span></div>
        <div class="dp-field"><label>Objet</label><span id="dpObjet"></span></div>
        <div class="dp-field"><label>Admin assigné</label><span id="dpAdmin"></span></div>
      </div>
      <div class="pieces-list">
        <div class="pieces-list-title">Pièces jointes associées</div>
        <div id="dpPieces"></div>
      </div>
    </div>

  </div>
</div>

<div class="modal-overlay" id="deleteModal">
  <div class="modal">
    <h3>Supprimer la requête</h3>
    <p>Êtes-vous sûr de vouloir supprimer cette requête ? Cette action est irréversible.</p>
    <div class="modal-info">
      <div class="mi-row"><span class="mi-label">Objet :</span><span class="mi-val" id="delObjet"></span></div>
      <div class="mi-row"><span class="mi-label">Numéro :</span><span class="mi-val" id="delId"></span></div>
    </div>
    <div class="modal-actions">
      <button class="btn-cancel" onclick="closeDeleteModal()">Annuler</button>
      <form method="POST" action="" style="display:inline">
        <input type="hidden" name="del_id_requete" id="delRequeteId"/>
        <input type="hidden" name="del_name_requete" id="delRequeteName"/>
        <button type="submit" class="btn-danger">Supprimer</button>
      </form>
    </div>
  </div>
</div>

<script>
  function toggleSB(){document.getElementById('sidebar').classList.toggle('open');document.getElementById('overlay').classList.toggle('show')}
  function closeSB(){document.getElementById('sidebar').classList.remove('open');document.getElementById('overlay').classList.remove('show')}

  function showDetail(r) {
    document.getElementById('dpTitle').textContent = 'Requête #' + r.id_requete;
    document.getElementById('dpId').textContent = '#' + r.id_requete;
    document.getElementById('dpObjet').textContent = r.libelle_objet;
    document.getElementById('dpAdmin').textContent = r.admin_prenom + ' ' + r.admin_nom;
    document.getElementById('dpStatus').innerHTML = '<span class="status s-pending">En attente</span>';
    const pc = document.getElementById('dpPieces');
    if(r.nb_pieces > 0) {
      pc.innerHTML = '<div class="pj-item"><div class="pj-icon"><svg viewBox="0 0 24 24" width="15" height="15" stroke="currentColor" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg></div><span class="pj-name">' + r.nb_pieces + ' pièce(s) jointe(s) associée(s)</span></div>';
    } else {
      pc.innerHTML = '<p style="font-size:.84rem;color:var(--gray-500)">Aucune pièce jointe associée.</p>';
    }
    document.getElementById('detailPanel').classList.add('show');
    document.getElementById('detailPanel').scrollIntoView({behavior:'smooth', block:'nearest'});
  }

  function closeDetail() { document.getElementById('detailPanel').classList.remove('show'); }

  function confirmDelete(id, objet) {
    document.getElementById('delId').textContent = '#' + id;
    document.getElementById('delObjet').textContent = objet;
    document.getElementById('delRequeteId').value = id;
    document.getElementById('delRequeteName').value = objet;
    document.getElementById('deleteModal').classList.add('show');
  }
  function closeDeleteModal() { document.getElementById('deleteModal').classList.remove('show'); }
</script>