<?php
$success =0;
$error =0;
if(isset($_POST["id_objet"], $_POST["id_admin"], $_POST["pieces"]) && !empty($_POST["id_objet"]) && !empty($_POST["id_admin"]) && !empty($_POST["pieces"])){
    $id_admin = strip_tags($_POST["id_admin"]);
    $id_objet = strip_tags($_POST["id_objet"]);

    $ids_piece = $_POST['pieces'];

    $donnees_req =[
        "id_objet" => $id_objet,
        "id_admin" => $id_admin,
        "matricule" => $_SESSION['etudiant']['matricule'],
    ];
    
    $add = $this->DashbordEtudiant->insertReq($donnees_req, $ids_piece);
    if($add){
            $success = 1;
            $success_msg = "Requete ajoutée avec succès !";
    }else{
            $error = 1;
            $error_msg ="Nous ne parvenons pas à soumettre votre requete.";
    }
}


?>



<style>
    /* MAIN */
    .main{margin-left:var(--sidebar-w);min-height:100vh;display:flex;flex-direction:column}
    .topbar{height:var(--topbar-h);background:white;border-bottom:1px solid var(--gray-100);display:flex;align-items:center;padding:0 32px;gap:14px;position:sticky;top:0;z-index:50}
    .menu-btn{display:none;background:none;border:none;cursor:pointer;padding:6px;color:var(--gray-700)}
    .menu-btn svg{width:22px;height:22px;stroke:currentColor;fill:none;stroke-width:2;stroke-linecap:round}
    .tb-title{font-family:'Sora',sans-serif;font-size:1.05rem;font-weight:600;color:var(--gray-900)}
    .tb-back{display:inline-flex;align-items:center;gap:6px;font-size:.84rem;color:var(--gray-500);text-decoration:none;transition:color .18s;margin-left:auto}
    .tb-back:hover{color:var(--purple)}
    .tb-back svg{width:15px;height:15px;stroke:currentColor;fill:none;stroke-width:2;stroke-linecap:round;stroke-linejoin:round}

    .content{padding:28px 32px;flex:1;display:flex;gap:24px;align-items:flex-start}

    /* FORM CARD */
    .form-card{flex:1;background:white;border-radius:18px;border:1px solid var(--gray-100);overflow:hidden}
    .fc-header{padding:22px 28px;border-bottom:1px solid var(--gray-100);display:flex;align-items:center;gap:14px}
    .fc-icon{width:42px;height:42px;border-radius:12px;background:var(--grad-soft);display:flex;align-items:center;justify-content:center;flex-shrink:0}
    .fc-icon svg{width:20px;height:20px;stroke:var(--purple);fill:none;stroke-width:2;stroke-linecap:round;stroke-linejoin:round}
    .fc-title{font-family:'Sora',sans-serif;font-size:1rem;font-weight:600;color:var(--gray-900)}
    .fc-sub{font-size:.8rem;color:var(--gray-500);margin-top:2px}
    .fc-body{padding:28px}

    /* ALERTS */
    .alert{display:flex;align-items:center;gap:10px;padding:12px 16px;border-radius:11px;font-size:.86rem;margin-bottom:22px}
    .alert svg{width:17px;height:17px;stroke:currentColor;fill:none;stroke-width:2;stroke-linecap:round;stroke-linejoin:round;flex-shrink:0}
    .alert-success{background:var(--green-pale);color:var(--green)}
    .alert-error{background:var(--red-pale);color:var(--red)}

    /* FORM */
    .form-group{margin-bottom:20px}
    .form-row{display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-bottom:20px}
    label{display:block;font-size:.81rem;font-weight:600;color:var(--gray-700);margin-bottom:7px;letter-spacing:.2px}
    .req{color:var(--purple);margin-left:2px}
    .input-wrap{position:relative}
    .input-wrap svg.ii{position:absolute;left:13px;top:50%;transform:translateY(-50%);width:16px;height:16px;stroke:var(--gray-300);fill:none;stroke-width:2;stroke-linecap:round;stroke-linejoin:round;pointer-events:none;transition:stroke .2s}
    .input-wrap:focus-within svg.ii{stroke:var(--purple)}
    input[type=text],select,textarea{width:100%;padding:11px 13px 11px 40px;border:1.5px solid var(--gray-300);border-radius:10px;font-family:'DM Sans',sans-serif;font-size:.9rem;color:var(--gray-900);background:white;outline:none;transition:border-color .2s,box-shadow .2s;appearance:none}
    textarea{padding:12px 14px 12px 40px;resize:vertical;min-height:100px;line-height:1.5}
    select{background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%236B7280' stroke-width='2'%3E%3Cpolyline points='6 9 12 15 18 9'/%3E%3C/svg%3E");background-repeat:no-repeat;background-position:right 13px center;padding-right:36px;cursor:pointer}
    input:focus,select:focus,textarea:focus{border-color:var(--purple-light);box-shadow:0 0 0 3px rgba(139,92,246,.1)}
    .field-err{font-size:.76rem;color:var(--red);display:none;margin-top:4px}
    .field-err.show{display:block}
    input.err,select.err,textarea.err{border-color:var(--red)}

    /* PIECES CHECKBOXES */
    .pieces-grid{display:flex;flex-direction:column;gap:8px;max-height:240px;overflow-y:auto;padding:4px 2px}
    .pj-check{display:flex;align-items:center;gap:11px;padding:11px 14px;border-radius:10px;border:1.5px solid var(--gray-300);cursor:pointer;transition:all .18s;user-select:none}
    .pj-check:hover{border-color:var(--purple-light);background:var(--purple-pale)}
    .pj-check.checked{border-color:var(--purple);background:var(--purple-pale)}
    .pj-check input[type=checkbox]{display:none}
    .pj-checkbox{width:18px;height:18px;border-radius:5px;border:1.5px solid var(--gray-300);display:flex;align-items:center;justify-content:center;flex-shrink:0;transition:all .18s;background:white}
    .pj-check.checked .pj-checkbox{background:var(--purple);border-color:var(--purple)}
    .pj-check.checked .pj-checkbox::after{content:'✓';font-size:.72rem;color:white;font-weight:700}
    .pj-icon{width:32px;height:32px;border-radius:8px;background:var(--gray-100);display:flex;align-items:center;justify-content:center;flex-shrink:0}
    .pj-check.checked .pj-icon{background:rgba(107,63,212,.12)}
    .pj-icon svg{width:15px;height:15px;stroke:var(--gray-500);fill:none;stroke-width:2;stroke-linecap:round;stroke-linejoin:round}
    .pj-check.checked .pj-icon svg{stroke:var(--purple)}
    .pj-name{font-size:.85rem;font-weight:500;color:var(--gray-900);flex:1}
    .pj-meta{font-size:.74rem;color:var(--gray-500);margin-top:1px}
    .pieces-empty{font-size:.85rem;color:var(--gray-500);text-align:center;padding:20px;background:var(--gray-100);border-radius:10px}
    .pieces-empty a{color:var(--purple);font-weight:500}

    /* SUBMIT */
    .form-footer{display:flex;align-items:center;justify-content:flex-end;gap:12px;margin-top:28px;padding-top:22px;border-top:1px solid var(--gray-100)}
    .btn-cancel{padding:11px 22px;border:1.5px solid var(--gray-300);border-radius:10px;background:white;font-family:'DM Sans',sans-serif;font-size:.88rem;font-weight:500;color:var(--gray-700);cursor:pointer;transition:all .18s;text-decoration:none;display:inline-flex;align-items:center}
    .btn-cancel:hover{border-color:var(--gray-500)}
    .btn-submit{padding:11px 28px;background:var(--grad);color:white;border:none;border-radius:10px;font-family:'DM Sans',sans-serif;font-size:.9rem;font-weight:600;cursor:pointer;display:inline-flex;align-items:center;gap:8px;transition:opacity .18s,transform .15s}
    .btn-submit:hover{opacity:.91;transform:translateY(-1px)}
    .btn-submit svg{width:16px;height:16px;stroke:white;fill:none;stroke-width:2.2;stroke-linecap:round;stroke-linejoin:round}
    .btn-submit .spinner{display:none;width:16px;height:16px;border:2px solid rgba(255,255,255,.35);border-top-color:white;border-radius:50%;animation:spin .7s linear infinite}
    .btn-submit.loading .spinner{display:block}
    .btn-submit.loading .blabel{opacity:.6}

    /* SIDE INFO */
    .side-info{width:280px;flex-shrink:0;display:flex;flex-direction:column;gap:16px}
    .info-card{background:white;border-radius:16px;border:1px solid var(--gray-100);padding:20px}
    .ic-title{font-size:.82rem;font-weight:600;letter-spacing:.4px;text-transform:uppercase;color:var(--gray-500);margin-bottom:14px}
    .ic-step{display:flex;gap:12px;margin-bottom:14px}
    .ic-step:last-child{margin-bottom:0}
    .ic-num{width:26px;height:26px;border-radius:50%;background:var(--grad);color:white;font-size:.75rem;font-weight:700;display:flex;align-items:center;justify-content:center;flex-shrink:0}
    .ic-text{font-size:.83rem;color:var(--gray-700);line-height:1.5;padding-top:3px}
    .ic-text strong{color:var(--gray-900);font-weight:500}
    .tip-item{display:flex;gap:10px;margin-bottom:10px;font-size:.82rem;color:var(--gray-700);line-height:1.5}
    .tip-item:last-child{margin-bottom:0}
    .tip-dot{width:6px;height:6px;border-radius:50%;background:var(--purple);margin-top:6px;flex-shrink:0}

    .nouvelle_requete{background:var(--grad);color:white;font-weight:500;}

    .overlay{display:none;position:fixed;inset:0;background:rgba(0,0,0,.4);z-index:90}
    .overlay.show{display:block}
    @keyframes fadeUp{from{opacity:0;transform:translateY(14px)}to{opacity:1;transform:translateY(0)}}
    @keyframes spin{to{transform:rotate(360deg)}}

    @media(max-width:1100px){.side-info{display:none}}
    @media(max-width:900px){.sidebar{transform:translateX(-100%)}.sidebar.open{transform:translateX(0)}.main{margin-left:0}.menu-btn{display:flex}}
    @media(max-width:600px){.content{padding:18px 14px;flex-direction:column}.topbar{padding:0 14px}.form-row{grid-template-columns:1fr}}
</style>

<header class="topbar">
    <button class="menu-btn" onclick="toggleSB()">
      <svg viewBox="0 0 24 24"><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
    </button>
    <span class="tb-title">Nouvelle requête</span>
    <a href="requete" class="tb-back">
      <svg viewBox="0 0 24 24"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
      Mes requêtes
    </a>
  </header>

  <div class="content">

    <div class="form-card">
      <div class="fc-header">
        <div class="fc-icon">
          <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="16"/><line x1="8" y1="12" x2="16" y2="12"/></svg>
        </div>
        <div>
          <div class="fc-title">Soumettre une nouvelle requête</div>
          <div class="fc-sub">Remplissez le formulaire ci-dessous. Tous les champs marqués * sont obligatoires.</div>
        </div>
      </div>

      <div class="fc-body">

        <?php if($success===1): ?>
          <div class="alert alert-success">
            <svg viewBox="0 0 24 24"><path d="M9 12l2 2 4-4"/><circle cx="12" cy="12" r="10"/></svg>
            Votre requête a été soumise avec succès ! <a href="requete" style="color:var(--green);font-weight:600;margin-left:6px">Voir mes requêtes →</a>
          </div>
        <?php endif; ?>

        <?php if($error===1): ?>
          <div class="alert alert-error">
            <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
            <?php echo htmlspecialchars($error_error); ?>
          </div>
        <?php endif; ?>

        <form id="reqForm" action="" method="POST" novalidate>

          <div class="form-row">
            <div class="form-group" style="margin-bottom:0">
              <label>Objet de la requête <span class="req">*</span></label>
              <div class="input-wrap">
                <select name="id_objet" id="id_objet">
                  <option value="">-- Choisir un objet --</option>
                  <?php foreach($this->DashbordEtudiant->objets as $o): ?>
                    <option value="<?php echo $o['id_objet']; ?>"><?php echo htmlspecialchars($o['libelle_objet']); ?></option>
                  <?php endforeach; ?>
                </select>
                <svg class="ii" viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
              </div>
              <span class="field-err" id="e-objet">Veuillez choisir un objet.</span>
            </div>

            <div class="form-group" style="margin-bottom:0">
              <label>Administrateur concerné <span class="req">*</span></label>
              <div class="input-wrap">
                <select name="id_admin" id="id_admin">
                  <option value="">-- Choisir un administrateur --</option>
                  <?php foreach($this->DashbordEtudiant->admins as $a): ?>
                    <option value="<?php echo $a['id_admin']; ?>"><?php echo htmlspecialchars($a['prenom'].' '.$a['nom']); ?></option>
                  <?php endforeach; ?>
                </select>
                <svg class="ii" viewBox="0 0 24 24"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/></svg>
              </div>
              <span class="field-err" id="e-admin">Veuillez choisir un administrateur.</span>
            </div>
          </div>

          <div class="form-group">
            <label>Choisir les Pièces jointes à associer</label>
            <?php if(empty($this->DashbordEtudiant->pieces)): ?>
              <div class="pieces-empty">
                Aucune pièce jointe dans votre dossier.
                <a href="dossier">Ajouter des documents →</a>
              </div>
            <?php else: ?>
              <div class="pieces-grid" id="piecesGrid">
                <?php foreach($this->DashbordEtudiant->pieces as $pj): ?>
                  <label class="pj-check" onclick="togglePiece(this)">
                    <input type="checkbox" name="pieces[]" value="<?php echo $pj['id_piece']; ?>"/>
                    <div class="pj-checkbox"></div>
                    <div class="pj-icon">
                      <svg viewBox="0 0 24 24"><path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"/><polyline points="13 2 13 9 20 9"/></svg>
                    </div>
                    <div>
                      <div class="pj-name"><?php echo htmlspecialchars($pj['libelle_piece']); ?></div>
                      <div class="pj-meta"><?php echo htmlspecialchars($pj['annee'].' — '.$pj['semestre']); ?></div>
                    </div>
                  </label>
                <?php endforeach; ?>
              </div>
            <?php endif; ?>
          </div>

          <div class="form-footer">
            <a href="requetes.php" class="btn-cancel">Annuler</a>
            <button type="submit" class="btn-submit" id="submitBtn">
              <div class="spinner"></div>
              <span class="blabel">Soumettre la requête</span>
              <svg viewBox="0 0 24 24"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>
            </button>
          </div>

        </form>
      </div>
    </div>

    <!-- SIDE INFO -->
    <div class="side-info">
      <div class="info-card">
        <div class="ic-title">Comment ça marche</div>
        <div class="ic-step">
          <div class="ic-num">1</div>
          <div class="ic-text"><strong>Choisissez l'objet</strong> de votre demande dans la liste disponible.</div>
        </div>
        <div class="ic-step">
          <div class="ic-num">2</div>
          <div class="ic-text"><strong>Sélectionnez l'administrateur</strong> concerné par votre requête.</div>
        </div>
        <div class="ic-step">
          <div class="ic-num">3</div>
          <div class="ic-text"><strong>Associez vos pièces jointes</strong> depuis votre dossier si nécessaire.</div>
        </div>
        <div class="ic-step">
          <div class="ic-num">4</div>
          <div class="ic-text"><strong>Soumettez</strong> et suivez le traitement depuis "Mes requêtes".</div>
        </div>
      </div>
      <div class="info-card">
        <div class="ic-title">Conseils</div>
        <div class="tip-item"><div class="tip-dot"></div><div>Vérifiez que vos pièces jointes sont à jour avant de soumettre.</div></div>
        <div class="tip-item"><div class="tip-dot"></div><div>Vous pouvez suivre le statut de votre requête dans "Mes requêtes".</div></div>
        <div class="tip-item"><div class="tip-dot"></div><div>En cas de question, utilisez la messagerie pour contacter l'administration.</div></div>
      </div>
    </div>

  </div>
</div>

<script>
  function toggleSB(){document.getElementById('sidebar').classList.toggle('open');document.getElementById('overlay').classList.toggle('show')}
  function closeSB(){document.getElementById('sidebar').classList.remove('open');document.getElementById('overlay').classList.remove('show')}

  function togglePiece(lbl) {
    const cb = lbl.querySelector('input[type=checkbox]');
    cb.checked = !cb.checked;
    lbl.classList.toggle('checked', cb.checked);
  }

  document.getElementById('reqForm').addEventListener('submit', function(e) {
    e.preventDefault();
    let ok = true;

    const obj = document.getElementById('id_objet');
    const adm = document.getElementById('id_admin');

    if (!obj.value) { obj.classList.add('err'); document.getElementById('e-objet').classList.add('show'); ok = false; }
    else            { obj.classList.remove('err'); document.getElementById('e-objet').classList.remove('show'); }

    if (!adm.value) { adm.classList.add('err'); document.getElementById('e-admin').classList.add('show'); ok = false; }
    else            { adm.classList.remove('err'); document.getElementById('e-admin').classList.remove('show'); }

    if (!ok) return;

    const btn = document.getElementById('submitBtn');
    btn.classList.add('loading'); btn.disabled = true;
    setTimeout(() => this.submit(), 600);
  });
</script>