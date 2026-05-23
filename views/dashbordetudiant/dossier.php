<?php
$chemin = ROOT.'upload/'.$_SESSION['etudiant']['matricule'].'--'.$_SESSION['etudiant']['nom'].'--'.$_SESSION['etudiant']['prenom'].'/';

$error = 0;
$success = 0;
if(isset($_FILES["fichier"], $_POST["libelle_piece"], $_POST["annee"], $_POST["semestre"]) && $_FILES["fichier"]["error"]===0 
          && !empty($_POST["libelle_piece"]) && !empty($_POST["annee"]) && !empty($_POST["semestre"]) ){
      
        $type =["pdf" => "application/pdf"];
        $f_semestre = strip_tags($_POST['semestre']);
        $f_annee = strip_tags($_POST['annee']);
        $libelle_piece = strip_tags($_POST['libelle_piece']);
       
        $nom_fichier = strip_tags($_FILES["fichier"]["name"]);
        $type_fichier = strip_tags($_FILES["fichier"]["type"]);
        $taille_fichier = $_FILES["fichier"]["size"];
       
        $extension = strtolower(pathinfo($nom_fichier, PATHINFO_EXTENSION));
        try
        {
            if(!array_key_exists($extension, $type) || !in_array($type_fichier,$type)){
                $error_msg = "Erreur:: type de fichier incorrecte. il faut un pdf";
                $error = 1;
            }
        
            if($taille_fichier > 2*(1024*1024)){
                $error_msg = "Erreur:: taille de fichier très grande. Pas plus de 2Mo par fichier.";
                $error = 1;
                $taille_err = 1;
            }else{
                $fichier = $_FILES["fichier"]["tmp_name"];

                $contenu = file_get_contents($fichier);
                
                preg_match_all("/\/Page[^s]/", $contenu, $correspndance) ;

                $nombre_page = count($correspndance[0]);
            }
        
            
            if($taille_err===1 && $nombre_page >3){
               $error_msg = "Erreur:: nombre de page très grand. Pas plus de 3 Pages";
               $error = 1;
            }else{

                

              
                if(move_uploaded_file($_FILES["fichier"]["tmp_name"], $chemin.''.$libelle_piece)){
                    
                    chmod($chemin,0755); 
                    $data =[
                      "libelle_piece" => $libelle_piece,
                      "annee" => $f_annee,
                      "semestre" => $f_semestre,
                      "chemin" => $chemin.''.$libelle_piece,
                      "matricule" => $_SESSION['etudiant']['matricule']
                    ];
                    
                    $verif = 1;
                }else{
                    $verif = 0;
                }
            }
        }catch(ErrorException $e){
            $error_msg = "Erreur:: Nous ne pouvons pas ajouter votre fichier";
            $error = 1;
        }

        if($verif == 1){
          $add = $this->DashbordEtudiant->addPiece($data);
          if($add){
            $success = 1;
            $success_msg = "Document ajouté avec succès !";
            header("Location: dossier");
            exit;
          }else{
            $error = 1;
            $error_msg ="Nous ne pouvons téléverser ce document car il existe déjà.";
          }
        }else{
          $error = 1;
          $error_msg = "Nous ne parevenons pas à ajouter votre document";
        }
                 
}
if(isset($_POST["del_id_piece"], $_POST["del_name_piece"]) && !empty($_POST["del_id_piece"]) && !empty($_POST["del_name_piece"])){
    $id_piece = strip_tags($_POST["del_id_piece"]);
    $name_piece = strip_tags($_POST["del_name_piece"]);

    $donnees =["id_piece" => $id_piece];

    $add = $this->DashbordEtudiant->delete("piece_jointe", $donnees);
    if($add){
     
                if(file_exists($chemin.''.$name_piece)){ 
                        unlink($chemin.''.$name_piece);
                }
            header("Location: dossier");
            exit;
    }else{
            $error = 1;
            $error_msg ="Nous ne pouvons supprimer ceci.";
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
    .tb-right{margin-left:auto}
    .btn-add{display:inline-flex;align-items:center;gap:7px;padding:9px 18px;background:var(--grad);color:white;border:none;border-radius:10px;font-family:'DM Sans',sans-serif;font-size:.85rem;font-weight:600;cursor:pointer;transition:opacity .18s}
    .btn-add:hover{opacity:.9}
    .btn-add svg{width:15px;height:15px;stroke:white;fill:none;stroke-width:2.2;stroke-linecap:round;stroke-linejoin:round}

    .content{padding:28px 32px;flex:1}

    /* ALERTS */
    .alert{display:flex;align-items:center;gap:10px;padding:12px 16px;border-radius:11px;font-size:.86rem;margin-bottom:20px}
    .alert svg{width:17px;height:17px;stroke:currentColor;fill:none;stroke-width:2;stroke-linecap:round;stroke-linejoin:round;flex-shrink:0}
    .alert-success{background:var(--green-pale);color:var(--green)}
    .alert-error{background:var(--red-pale);color:var(--red)}

    /* DOSSIER HEADER */
    .dossier-header{background:var(--grad);border-radius:16px;padding:22px 28px;display:flex;align-items:center;gap:18px;margin-bottom:24px;position:relative;overflow:hidden}
    .dossier-header::before{content:'';position:absolute;top:-40px;right:-40px;width:180px;height:180px;border-radius:50%;background:rgba(255,255,255,.06)}
    .dh-icon{width:52px;height:52px;border-radius:14px;background:rgba(255,255,255,.18);display:flex;align-items:center;justify-content:center;flex-shrink:0;z-index:1}
    .dh-icon svg{width:26px;height:26px;stroke:white;fill:none;stroke-width:1.8;stroke-linecap:round;stroke-linejoin:round}
    .dh-info{z-index:1}
    .dh-name{font-family:'Sora',sans-serif;font-size:1.05rem;font-weight:600;color:white}
    .dh-meta{font-size:.82rem;color:rgba(255,255,255,.7);margin-top:3px}
    .dh-stats{margin-left:auto;display:flex;gap:20px;z-index:1}
    .dh-stat{text-align:center}
    .dh-stat-num{font-family:'Sora',sans-serif;font-size:1.4rem;font-weight:600;color:white}
    .dh-stat-label{font-size:.74rem;color:rgba(255,255,255,.65)}

    /* TOOLBAR */
    .toolbar{display:flex;align-items:center;gap:10px;margin-bottom:18px;flex-wrap:wrap}
    .search-wrap{position:relative;flex:1;min-width:180px}
    .search-wrap svg{position:absolute;left:12px;top:50%;transform:translateY(-50%);width:16px;height:16px;stroke:var(--gray-300);fill:none;stroke-width:2;stroke-linecap:round;stroke-linejoin:round;pointer-events:none}
    .search-input{width:100%;padding:10px 12px 10px 38px;border:1.5px solid var(--gray-300);border-radius:10px;font-family:'DM Sans',sans-serif;font-size:.87rem;color:var(--gray-900);background:white;outline:none;transition:border-color .2s,box-shadow .2s}
    .search-input:focus{border-color:var(--purple-light);box-shadow:0 0 0 3px rgba(139,92,246,.1)}
    .filter-select{padding:9px 32px 9px 12px;border:1.5px solid var(--gray-300);border-radius:10px;font-family:'DM Sans',sans-serif;font-size:.84rem;color:var(--gray-700);background:white;outline:none;appearance:none;background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='11' height='11' viewBox='0 0 24 24' fill='none' stroke='%236B7280' stroke-width='2'%3E%3Cpolyline points='6 9 12 15 18 9'/%3E%3C/svg%3E");background-repeat:no-repeat;background-position:right 10px center;cursor:pointer;transition:border-color .2s}
    .filter-select:focus{border-color:var(--purple-light);outline:none}

    /* GRID PIECES */
    .pieces-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(260px,1fr));gap:14px}
    .pj-card{background:white;border-radius:14px;border:1px solid var(--gray-100);padding:18px 20px;transition:box-shadow .2s,border-color .2s;position:relative;overflow:hidden}
    .pj-card:hover{box-shadow:0 4px 20px rgba(107,63,212,.08);border-color:var(--purple-pale)}
    .pj-card::before{content:'';position:absolute;top:0;left:0;width:4px;height:100%;background:var(--grad)}
    .pj-top{display:flex;align-items:flex-start;gap:12px;margin-bottom:14px}
    .pj-ico{width:42px;height:42px;border-radius:11px;background:var(--grad-soft);display:flex;align-items:center;justify-content:center;flex-shrink:0}
    .pj-ico svg{width:20px;height:20px;stroke:var(--purple);fill:none;stroke-width:1.8;stroke-linecap:round;stroke-linejoin:round}
    .pj-title{font-size:.9rem;font-weight:600;color:var(--gray-900);line-height:1.3;margin-bottom:4px}
    .pj-tags{display:flex;gap:6px;flex-wrap:wrap}
    .tag{font-size:.72rem;font-weight:500;padding:2px 8px;border-radius:20px}
    .tag-annee{background:var(--blue-pale);color:var(--blue)}
    .tag-sem{background:var(--amber-pale);color:var(--amber)}
    .pj-actions{display:flex;gap:6px;justify-content:flex-end}
    .btn-icon{width:32px;height:32px;border-radius:8px;background:var(--gray-100);border:none;cursor:pointer;display:flex;align-items:center;justify-content:center;transition:all .18s;text-decoration:none}
    .btn-icon:hover{background:var(--purple-pale)}
    .btn-icon svg{width:15px;height:15px;stroke:var(--gray-500);fill:none;stroke-width:2;stroke-linecap:round;stroke-linejoin:round}
    .btn-icon:hover svg{stroke:var(--purple)}
    .btn-icon.del:hover{background:var(--red-pale)}
    .btn-icon.del:hover svg{stroke:var(--red)}

    .count-bar{font-size:.84rem;color:var(--gray-500);margin-bottom:14px}
    .count-bar strong{color:var(--gray-900);font-weight:600}

    /* EMPTY */
    .empty-state{background:white;border-radius:16px;border:1px solid var(--gray-100);padding:60px 24px;text-align:center}
    .es-icon{width:64px;height:64px;border-radius:16px;background:var(--grad-soft);display:flex;align-items:center;justify-content:center;margin:0 auto 16px}
    .es-icon svg{width:30px;height:30px;stroke:var(--purple);fill:none;stroke-width:1.8;stroke-linecap:round;stroke-linejoin:round}
    .empty-state h3{font-size:.98rem;font-weight:600;color:var(--gray-900);margin-bottom:6px}
    .empty-state p{font-size:.84rem;color:var(--gray-500);margin-bottom:20px}
    .btn-primary{display:inline-flex;align-items:center;gap:7px;padding:10px 20px;background:var(--grad);color:white;border:none;border-radius:10px;font-family:'DM Sans',sans-serif;font-size:.87rem;font-weight:600;cursor:pointer}

    /* MODAL */
    .modal-overlay{display:none;position:fixed;inset:0;background:rgba(0,0,0,.45);z-index:200;align-items:center;justify-content:center}
    .modal-overlay.show{display:flex}
    .modal{background:white;border-radius:18px;padding:28px;width:100%;max-width:460px;margin:16px;animation:fadeUp .25s ease}
    .modal h3{font-size:1.05rem;font-weight:600;color:var(--gray-900);margin-bottom:18px;display:flex;align-items:center;gap:10px}
    .modal h3 svg{width:20px;height:20px;stroke:var(--purple);fill:none;stroke-width:2;stroke-linecap:round;stroke-linejoin:round}
    .m-group{margin-bottom:14px}
    .m-label{font-size:.79rem;font-weight:600;color:var(--gray-700);margin-bottom:6px;display:block;letter-spacing:.2px}
    .m-req{color:var(--purple);margin-left:2px}
    .m-input,.m-select{width:100%;padding:10px 13px;border:1.5px solid var(--gray-300);border-radius:10px;font-family:'DM Sans',sans-serif;font-size:.88rem;color:var(--gray-900);background:white;outline:none;transition:border-color .2s,box-shadow .2s;appearance:none}
    .m-select{background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='11' height='11' viewBox='0 0 24 24' fill='none' stroke='%236B7280' stroke-width='2'%3E%3Cpolyline points='6 9 12 15 18 9'/%3E%3C/svg%3E");background-repeat:no-repeat;background-position:right 12px center;padding-right:32px;cursor:pointer}
    .m-input:focus,.m-select:focus{border-color:var(--purple-light);box-shadow:0 0 0 3px rgba(139,92,246,.1)}
    .m-input.err,.m-select.err{border-color:var(--red)}
    .m-row{display:grid;grid-template-columns:1fr 1fr;gap:12px}
    .m-err{font-size:.75rem;color:var(--red);display:none;margin-top:3px}
    .m-err.show{display:block}
    .m-file{width:100%;padding:10px 13px;border:1.5px dashed var(--gray-300);border-radius:10px;font-family:'DM Sans',sans-serif;font-size:.84rem;color:var(--gray-500);cursor:pointer;background:var(--gray-100);transition:border-color .2s}
    .m-file:hover{border-color:var(--purple-light)}
    .modal-actions{display:flex;gap:10px;justify-content:flex-end;margin-top:20px}
    .btn-cancel{padding:10px 20px;border:1.5px solid var(--gray-300);border-radius:10px;background:white;font-family:'DM Sans',sans-serif;font-size:.87rem;font-weight:500;color:var(--gray-700);cursor:pointer;transition:all .18s}
    .btn-cancel:hover{border-color:var(--gray-500)}
    .btn-save{padding:10px 22px;background:var(--grad);color:white;border:none;border-radius:10px;font-family:'DM Sans',sans-serif;font-size:.87rem;font-weight:600;cursor:pointer;display:inline-flex;align-items:center;gap:7px;transition:opacity .18s}
    .btn-save:hover{opacity:.9}
    .btn-save .spinner{display:none;width:15px;height:15px;border:2px solid rgba(255,255,255,.35);border-top-color:white;border-radius:50%;animation:spin .7s linear infinite}
    .btn-save.loading .spinner{display:block}
    .btn-save.loading span{opacity:.6}
    .btn-danger{padding:10px 20px;background:var(--red);color:white;border:none;border-radius:10px;font-family:'DM Sans',sans-serif;font-size:.87rem;font-weight:600;cursor:pointer;transition:opacity .18s}
    .btn-danger:hover{opacity:.88}

    .dossier{background:var(--grad);color:white;font-weight:500;}

    .overlay{display:none;position:fixed;inset:0;background:rgba(0,0,0,.4);z-index:90}
    .overlay.show{display:block}
    @keyframes fadeUp{from{opacity:0;transform:translateY(14px)}to{opacity:1;transform:translateY(0)}}
    @keyframes spin{to{transform:rotate(360deg)}}

    @media(max-width:900px){.sidebar{transform:translateX(-100%)}.sidebar.open{transform:translateX(0)}.main{margin-left:0}.menu-btn{display:flex}.dh-stats{display:none}}
    @media(max-width:600px){.content{padding:16px 14px}.topbar{padding:0 14px}.pieces-grid{grid-template-columns:1fr}}

</style>

<header class="topbar">
    <button class="menu-btn" onclick="toggleSB()">
      <svg viewBox="0 0 24 24"><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
    </button>
    <span class="tb-title">Mon dossier</span>
    <div class="tb-right">
      <button class="btn-add" onclick="openAddModal()">
        <svg viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
        Ajouter un document
      </button>
    </div>
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

    <!-- DOSSIER HEADER -->
    <div class="dossier-header">
      <div class="dh-icon">
        <svg viewBox="0 0 24 24"><path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"/></svg>
      </div>
      <div class="dh-info">
        <div class="dh-name"></div>
        <div class="dh-meta">Étudiant : <?php echo htmlspecialchars(($_SESSION['etudiant']['prenom']??'').' '.$_SESSION['etudiant']['nom']); ?> — <?php echo htmlspecialchars($_SESSION['etudiant']['matricule']); ?></div>
      </div>
      <div class="dh-stats">
        <div class="dh-stat">
          <div class="dh-stat-num"><?php echo count($this->DashbordEtudiant->pieces); ?></div>
          <div class="dh-stat-label">Documents</div>
        </div>
        
      </div>
    </div>



    <?php if(empty($this->DashbordEtudiant->pieces)): ?>
      <div class="empty-state">
        <div class="es-icon">
          <svg viewBox="0 0 24 24"><path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"/><polyline points="13 2 13 9 20 9"/></svg>
        </div>
          <button class="btn-primary" onclick="openAddModal()">
            <svg viewBox="0 0 24 24" width="15" height="15" stroke="white" fill="none" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            Ajouter un document
          </button>
      </div>
    <?php else: ?>
      <div class="pieces-grid">
        <?php foreach($this->DashbordEtudiant->pieces as $pj): ?>
          <div class="pj-card">
            <div class="pj-top">
              <div class="pj-ico">
                <svg viewBox="0 0 24 24"><path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"/><polyline points="13 2 13 9 20 9"/></svg>
              </div>
              <div style="flex:1;min-width:0">
                <div class="pj-title"><?php echo htmlspecialchars($pj['libelle_piece']); ?></div>
                <div class="pj-tags">
                  <span class="tag tag-annee"><?php echo htmlspecialchars($pj['annee']); ?></span>
                  <span class="tag tag-sem"><?php echo htmlspecialchars($pj['semestre']); ?></span>
                </div>
              </div>
            </div>
            <div class="pj-actions">
              <button class="btn-icon del" title="Supprimer" onclick="confirmDel(<?php echo $pj['id_piece']; ?>, '<?php echo htmlspecialchars($pj['libelle_piece'],ENT_QUOTES); ?>')">
                <svg viewBox="0 0 24 24"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/><path d="M10 11v6"/><path d="M14 11v6"/><path d="M9 6V4h6v2"/></svg>
              </button>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>

  </div>
</div>

<!-- MODAL AJOUT -->
<div class="modal-overlay" id="addModal">
  <div class="modal">
    <h3>
      <svg viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
      Ajouter un document
    </h3>
    <form id="addForm" action="" method="POST" enctype="multipart/form-data" novalidate>
  
      <div class="m-group">
        <label class="m-label">Nom du document <span class="m-req">*</span></label>
        <input class="m-input" type="text" name="libelle_piece" id="m_libelle" placeholder="Ex : Relevé de notes S1"/>
        <span class="m-err" id="e-libelle">Le nom est requis.</span>
      </div>
      <div class="m-row">
        <div class="m-group">
          <label class="m-label">Année <span class="m-req">*</span></label>
          <input class="m-input" type="text" name="annee" id="m_annee" placeholder="Ex : 2024-2025"/>
          <span class="m-err" id="e-annee">L'année est requise.</span>
        </div>
        <div class="m-group">
          <label class="m-label">Semestre <span class="m-req">*</span></label>
          <select class="m-select" name="semestre" id="m_semestre">
            <option value="">-- Choisir --</option>
            <option value="Semestre 1">Semestre 1</option>
            <option value="Semestre 2">Semestre 2</option>
            <option value="Semestre 1 & 2">Semestre 1 & 2</option>
          </select>
          <span class="m-err" id="e-semestre">Requis.</span>
        </div>
      </div>
      <div class="m-group">
        <label class="m-label">Fichier <span class="m-req">*</span></label>
        <input class="m-file" type="file" name="fichier" id="m_fichier" accept=".pdf,.jpg,.jpeg,.png,.doc,.docx"/>
        <span class="m-err" id="e-fichier">Veuillez sélectionner un fichier.</span>
      </div>
      <div class="modal-actions">
        <button type="button" class="btn-cancel" onclick="closeAddModal()">Annuler</button>
        <button type="submit" class="btn-save" id="saveBtn">
          <div class="spinner"></div>
          <span>Ajouter</span>
        </button>
      </div>
    </form>
  </div>
</div>

<!-- MODAL SUPPRESSION -->
<div class="modal-overlay" id="delModal">
  <div class="modal">
    <h3>Supprimer le document</h3>
    <p style="font-size:.87rem;color:var(--gray-500);margin-bottom:16px">Voulez-vous vraiment supprimer <strong id="delName"></strong> ? Cette action est irréversible.</p>
    <div class="modal-actions">
      <button class="btn-cancel" onclick="closeDelModal()">Annuler</button>
      <form method="POST" action="" style="display:inline">
        <input type="hidden" name="del_id_piece" id="delPieceId"/>
        <input type="hidden" name="del_name_piece" id="delPieceName"/>
        <button type="submit" class="btn-danger">Supprimer</button>
      </form>
    </div>
  </div>
</div>

<script>
  function toggleSB(){document.getElementById('sidebar').classList.toggle('open');document.getElementById('overlay').classList.toggle('show')}
  function closeSB(){document.getElementById('sidebar').classList.remove('open');document.getElementById('overlay').classList.remove('show')}

  function openAddModal(){document.getElementById('addModal').classList.add('show')}
  function closeAddModal(){document.getElementById('addModal').classList.remove('show')}

  function confirmDel(id, name){
    document.getElementById('delName').textContent = name;
    document.getElementById('delPieceId').value = id;
    document.getElementById('delPieceName').value = name;
    document.getElementById('delModal').classList.add('show');
  }
  function closeDelModal(){document.getElementById('delModal').classList.remove('show')}

  document.getElementById('addForm').addEventListener('submit', function(e){
    e.preventDefault();
    let ok = true;
    const chk = (id, errId) => {
      const el = document.getElementById(id);
      const val = el.value.trim();
      if(!val){el.classList.add('err');document.getElementById(errId).classList.add('show');ok=false;}
      else{el.classList.remove('err');document.getElementById(errId).classList.remove('show');}
    };
    chk('m_libelle','e-libelle');
    chk('m_annee','e-annee');
    chk('m_semestre','e-semestre');
    const fich = document.getElementById('m_fichier');
    if(!fich.files.length){fich.classList.add('err');document.getElementById('e-fichier').classList.add('show');ok=false;}
    else{fich.classList.remove('err');document.getElementById('e-fichier').classList.remove('show');}
    if(!ok) return;
    const btn = document.getElementById('saveBtn');
    btn.classList.add('loading'); btn.disabled = true;
    this.submit();
  });
</script>