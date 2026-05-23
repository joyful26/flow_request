<?php
$success = 0;
$error = 0;
/*if(isset($_POST["contenu"], $_POST["id_admin"]) && !empty($_POST["matricule"]) && !empty($_POST["contenu"])){
    $id_admin = strip_tags($_POST["id_admin"]);
    $contenu = strip_tags($_POST["contenu"]);

    
    $add = $this->DashbordEtudiant->inserMessage($id_admin, $contenu);
    if($add){
          
            header("Location: messages");
            
    }else{
            $error = 1;
            $error_msg ="Nous ne parvenons pas à soumettre votre message.";
    }
}
*/
?>

<style>
    .main{margin-left:var(--sidebar-w);min-height:100vh;display:flex;flex-direction:column}
    .topbar{height:var(--topbar-h);background:white;border-bottom:1px solid var(--gray-100);display:flex;align-items:center;padding:0 32px;gap:14px;position:sticky;top:0;z-index:50}
    .menu-btn{display:none;background:none;border:none;cursor:pointer;padding:6px;color:var(--gray-700)}
    .menu-btn svg{width:22px;height:22px;stroke:currentColor;fill:none;stroke-width:2;stroke-linecap:round}
    .tb-title{font-family:'Sora',sans-serif;font-size:1.05rem;font-weight:600;color:var(--gray-900)}
    .tb-right{margin-left:auto}
    .btn-compose{display:inline-flex;align-items:center;gap:7px;padding:9px 18px;background:var(--grad);color:white;border:none;border-radius:10px;font-family:'DM Sans',sans-serif;font-size:.85rem;font-weight:600;cursor:pointer;transition:opacity .18s}
    .btn-compose:hover{opacity:.9}
    .btn-compose svg{width:15px;height:15px;stroke:white;fill:none;stroke-width:2.2;stroke-linecap:round;stroke-linejoin:round}

    /* LAYOUT */
    .content{padding:28px 32px;flex:1;display:grid;grid-template-columns:320px 1fr;gap:20px;align-items:start}

    /* ALERTS */
    .alert-wrap{grid-column:1/-1}
    .alert{display:flex;align-items:center;gap:10px;padding:12px 16px;border-radius:11px;font-size:.86rem}
    .alert svg{width:17px;height:17px;stroke:currentColor;fill:none;stroke-width:2;stroke-linecap:round;stroke-linejoin:round;flex-shrink:0}
    .alert-success{background:var(--green-pale);color:var(--green)}
    .alert-error{background:var(--red-pale);color:var(--red)}

    /* MESSAGES LIST */
    .msg-list-panel{background:white;border-radius:16px;border:1px solid var(--gray-100);overflow:hidden}
    .mlp-header{padding:16px 20px;border-bottom:1px solid var(--gray-100);display:flex;align-items:center;justify-content:space-between}
    .mlp-title{font-size:.9rem;font-weight:600;color:var(--gray-900)}
    .msg-count{font-size:.76rem;color:var(--gray-500);background:var(--gray-100);padding:2px 8px;border-radius:20px}
    .msg-items{max-height:calc(100vh - 220px);overflow-y:auto}
    .msg-item{padding:14px 18px;border-bottom:1px solid var(--gray-100);cursor:pointer;transition:background .15s;display:flex;align-items:flex-start;gap:12px}
    .msg-item:last-child{border-bottom:none}
    .msg-item:hover{background:#F9F8FF}
    .msg-item.active{background:var(--purple-pale);border-left:3px solid var(--purple)}
    .msg-avatar{width:36px;height:36px;border-radius:50%;background:var(--grad);display:flex;align-items:center;justify-content:center;font-size:.78rem;font-weight:600;color:white;flex-shrink:0}
    .msg-meta{flex:1;min-width:0}
    .msg-sender{font-size:.85rem;font-weight:600;color:var(--gray-900)}
    .msg-preview{font-size:.78rem;color:var(--gray-500);margin-top:2px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
    .msg-nbre{font-size:.78rem;color:#fff;display:flex;font-weight: bold;background-color: var(--purple-light);width: 25px;height: 25px;border-radius: 50%;text-align: center; justify-content:center; align-items:center  ;white-space:nowrap;overflow:hidden;text-overflow:ellipsis; float: right;}
    .msg-empty{padding:40px 20px;text-align:center}
    .me-icon{width:52px;height:52px;border-radius:14px;background:var(--grad-soft);display:flex;align-items:center;justify-content:center;margin:0 auto 12px}
    .me-icon svg{width:24px;height:24px;stroke:var(--purple);fill:none;stroke-width:1.8;stroke-linecap:round;stroke-linejoin:round}
    .msg-empty h4{font-size:.92rem;font-weight:600;color:var(--gray-900);margin-bottom:5px}
    .msg-empty p{font-size:.82rem;color:var(--gray-500)}

    /* CONVERSATION / COMPOSE */
    .right-panel{background:white;border-radius:16px;border:1px solid var(--gray-100);overflow:hidden;display:flex;flex-direction:column;min-height:500px;  }

    /* PLACEHOLDER */
    .rp-placeholder{flex:1;display:flex;flex-direction:column;align-items:center;justify-content:center;padding:40px;text-align:center}
    .rp-placeholder svg{width:48px;height:48px;stroke:var(--gray-300);fill:none;stroke-width:1.5;stroke-linecap:round;stroke-linejoin:round;margin-bottom:16px}
    .rp-placeholder h3{font-size:.95rem;font-weight:600;color:var(--gray-700);margin-bottom:6px}
    .rp-placeholder p{font-size:.83rem;color:var(--gray-500)}

    /* CONVERSATION VIEW */
    .conv-header{padding:16px 22px;border-bottom:1px solid var(--gray-100);display:flex;align-items:center;gap:12px}
    .conv-avatar{width:40px;height:40px;border-radius:50%;background:var(--grad);display:flex;align-items:center;justify-content:center;font-size:.85rem;font-weight:600;color:white;flex-shrink:0}
    .conv-name{font-size:.95rem;font-weight:600;color:var(--gray-900)}
    .conv-role{font-size:.74rem;color:var(--gray-500);margin-top:1px}
    .conv-close{margin-left:auto;background:none;border:none;cursor:pointer;color:var(--gray-400);padding:5px;border-radius:8px;display:flex;align-items:center}
    .conv-close:hover{background:var(--gray-100)}
    .conv-close svg{width:18px;height:18px;stroke:var(--gray-500);fill:none;stroke-width:2;stroke-linecap:round;stroke-linejoin:round}

    .conv-body{flex:1;padding:0 22px;overflow-y:auto;display:flex;flex-direction:column;}
    .conv-body div{max-width:100%;padding:12px 16px;font-size:.875rem;line-height:1.55; }
    .conv-body div div{color:var(--gray-900);align-self:left;}
    .conv-body div{font-size:.90rem;font-weight:600;margin-bottom:4px; align-items:center; justify-content: center;}
    .conv-body span{top: 0;left:-30px;position:relative;background:var(--grad); border-start-start-radius: 50%; font-size: 15px; padding: 6px;display: flex;width: 30px;height:30px;align-items:center;justify-content:center;float:left;color: #F9F8FF;}
    .rep{background: var(--grad-soft); border-radius:  0 0 20px 0 ;}
    .msg{background: #f0f0f0; border-radius:0 20px 0 0 ;}

    /* COMPOSE PANEL */
    .compose-panel{padding:16px 22px;border-top:1px solid var(--gray-100);background:white}
    .compose-panel.hidden{display:none}
    .compose-header{font-size:.9rem;font-weight:600;color:var(--gray-900);margin-bottom:14px;display:flex;align-items:center;justify-content:space-between}
    .compose-close{background:none;border:none;cursor:pointer;color:var(--gray-500);padding:3px;border-radius:6px;display:flex}
    .compose-close:hover{background:var(--gray-100)}
    .compose-close svg{width:16px;height:16px;stroke:currentColor;fill:none;stroke-width:2;stroke-linecap:round;stroke-linejoin:round}
    .cp-field{margin-bottom:12px}
    .cp-label{font-size:.78rem;font-weight:600;color:var(--gray-700);margin-bottom:6px;display:block;letter-spacing:.2px}
    .cp-select,.cp-textarea{width:100%;border:1.5px solid var(--gray-300);border-radius:10px;font-family:'DM Sans',sans-serif;font-size:.88rem;color:var(--gray-900);outline:none;transition:border-color .2s,box-shadow .2s;background:white;padding:10px 14px}
    .cp-select{appearance:none;background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%236B7280' stroke-width='2'%3E%3Cpolyline points='6 9 12 15 18 9'/%3E%3C/svg%3E");background-repeat:no-repeat;background-position:right 12px center;padding-right:34px;cursor:pointer}
    .cp-textarea{resize:none;height:90px;line-height:1.5}
    .cp-select:focus,.cp-textarea:focus{border-color:var(--purple-light);box-shadow:0 0 0 3px rgba(139,92,246,.1)}
    .cp-footer{display:flex;align-items:center;justify-content:flex-end;float: right; margin-right:10px; box-shadow: none;}
    .btn-send{display:inline-flex;align-items:center;gap:7px;padding:10px 22px;background:var(--grad);color:white;border:none;border-radius:10px;font-family:'DM Sans',sans-serif;font-size:.87rem;font-weight:600;cursor:pointer;transition:opacity .18s}
    .btn-send:hover{opacity:.9}
    .btn-send svg{width:15px;height:15px;stroke:white;fill:none;stroke-width:2.2;stroke-linecap:round;stroke-linejoin:round}
    .btn-send .spinner{display:none;width:15px;height:15px;border:2px solid rgba(255,255,255,.35);border-top-color:white;border-radius:50%;animation:spin .7s linear infinite}
    .btn-send.loading .spinner{display:block}
    .btn-send.loading span{opacity:.6}
    .err-msg{font-size:.78rem;color:var(--red);display:none;margin-top:4px}
    .err-msg.show{display:block}


    .messages{background:var(--grad);color:white;font-weight:500;}

    .overlay{display:none;position:fixed;inset:0;background:rgba(0,0,0,.4);z-index:90}
    .overlay.show{display:block}
    @keyframes spin{to{transform:rotate(360deg)}}
    @keyframes fadeUp{from{opacity:0;transform:translateY(10px)}to{opacity:1;transform:translateY(0)}}

    @media(max-width:960px){.content{grid-template-columns:1fr}.right-panel{display:none}.right-panel.show{display:flex}}
    @media(max-width:900px){.sidebar{transform:translateX(-100%)}.sidebar.open{transform:translateX(0)}.main{margin-left:0}.menu-btn{display:flex}}
    @media(max-width:600px){.content{padding:16px 14px}.topbar{padding:0 14px}}
</style>


<header class="topbar">
    <button class="menu-btn" onclick="toggleSB()">
      <svg viewBox="0 0 24 24"><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
    </button>
    <span class="tb-title">Messagerie</span>
  </header>

  <div class="content">


    <div class="alert-wrap">
      <?php if($success==1): ?>
        <div class="alert alert-success">
          <svg viewBox="0 0 24 24"><path d="M9 12l2 2 4-4"/><circle cx="12" cy="12" r="10"/></svg>
          <?= $success_msg?>
        </div>
      <?php endif; ?>
      <?php if($error==1): ?>
        <div class="alert alert-error">
          <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
          <?php echo htmlspecialchars($error_msg); ?>
        </div>
      <?php endif; ?>
    </div>
 

    <!-- LISTE MESSAGES -->
    <div class="msg-list-panel">
      <div class="mlp-header">
        <span class="mlp-title">Messages reçus</span>
        <span class="msg-count"><?php //echo count($messages); ?> message<?php //echo count($messages)>1?'s':''; ?></span>
      </div>
      <div class="msg-items">
        <?php  if($this->DashbordAdmin->Etudmsg ==""): ?>
          <div class="msg-empty">
            <div class="me-icon">
              <svg viewBox="0 0 24 24"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
            </div>
            <h4>Aucun message</h4>
            <p>Les etudiants n'ont pas encore de problèmes.</p>
          </div>
        <?php  else: ?>
          <?php foreach($this->DashbordAdmin->Etudmsg as $m):
                  $contenu=  $this->DashbordAdmin->getContentMsgEtud($m['matricule']);
                  $contenu2=  $this->DashbordAdmin->getContentMsgEtud2($m['matricule']);
                  
                  $initials = strtoupper(substr($m['prenom'],0,1).substr($m['nom'],0,1));
                ob_start(); 
                    $i=0;
                    $c =htmlspecialchars('onclick="openCompose()"');
                    $style = htmlspecialchars('class="msg"');
                    $style2 = htmlspecialchars('class="rep"');
                    $span1 = htmlspecialchars('class="span1"');
                    $span2 = htmlspecialchars('class="span2"');
                    $c = htmlspecialchars('class="cp-footer"');
                    $cp = htmlspecialchars('class="btn-send"');
                    $svg = htmlspecialchars('<svg viewBox="0 0 24 24"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>');

                    foreach($contenu as $cont ):
            
                         
                              if($i<=sizeof($contenu2 )&& !empty($contenu2[$i]['contenu']))
                              {
                                $date1 = new DateTime($cont['date_reponse']);
                                $date2 = new DateTime($contenu2[$i]['date_message']);
                                $d1 = $date1->format('Y-m-d H:i:s');
                                $d2 = $date2->format('Y-m-d H:i:s');
                                if($d1 > $d2)
                                {
                                  $id= htmlspecialchars('id="').$cont['id_message'].htmlspecialchars('"');
                                  $id2=htmlspecialchars('id="').$contenu2[$i]['id_message'].htmlspecialchars('"');
                                   echo "<div {$id2}><span>{$initials}</span><div {$style}>{$contenu2[$i++]['contenu']}</div><div {$c}><button {$cp}>Répondre{$svg}</button></div></div>"; 
                                   echo "<div {$span1} {$id}><span>{$initials}</span><div {$style}>{$cont['contenu']}</div><span>moi</span> <div {$style2}>{$cont['contenu_r']}</div> <div {$c}> <button {$cp}>Répondre{$svg}</button></div></div>";
                                }else{
                                  $id= htmlspecialchars('id="').$cont['id_message'].htmlspecialchars('"');
                                  $id2=htmlspecialchars('id="').$contenu2[$i]['id_message'].htmlspecialchars('"');
                                  echo "<div {$span1} {$id}><span>{$initials}</span><div {$style}> {$cont['contenu']}</div><span>moi</span><div {$style2}>{$cont['contenu_r']}</div> <div {$c}><button {$cp}>Répondre{$svg}</button></div></div>";
                                  echo "<div {$span2} {$id2}><span>{$initials}</span><div {$style}> {$contenu2[$i]['contenu']}</div> <div {$c}><button {$cp}>Répondre{$svg}</button></div></div>"; 
                                }
                                $i++;
                              }else{
                                $id= htmlspecialchars('id="').$cont['id_message'].htmlspecialchars('"');
                                 echo "<div {$span1} {$id}><span>{$initials}</span><div {$style}> {$cont['contenu']}</div><span>moi</span><div>{$cont['contenu_r']}</div><div {$c}><button {$cp}>Répondre{$svg}</button></div></div>";
                              }                
                   
                    endforeach;
                    while($i<=sizeof($contenu2) && !empty($contenu2[$i]['contenu']))
                    {
                       $id2=htmlspecialchars('id="').$contenu2[$i]['id_message'].htmlspecialchars('"');
                      echo "<div {$span2} {$id2}><span>{$initials}</span><div {$style}> {$contenu2[$i]['contenu']}</div><div {$c}><button {$cp}>Répondre{$svg}</button></div></div>"; 
                      $i++;
                    }
                $content = ob_get_clean();
                 ?>
            <div class="msg-item" id="item-<?php echo $m['id_message']; ?>"
                 onclick="openMessage('<?php echo $m['matricule']; ?>', '<?php echo htmlspecialchars($m['prenom'].' '.$m['nom'],ENT_QUOTES); ?>', '<?php echo $initials; ?>', '<?php echo $content; ?>')">
              <div class="msg-avatar"><?php echo $initials; ?></div>
              <div class="msg-meta">
                <div class="msg-sender"><?php echo htmlspecialchars($m['prenom'].' '.$m['nom']); ?></div>
                <div class="msg-nbre"><?php echo $this->DashbordAdmin->getMsgPerEtud($m['matricule'] ) ?></div>
              </div>
            </div>
         <?php endforeach; ?>
        <?php  endif; ?>
      </div>
    </div>
    <!-- PANNEAU DROIT -->
    <div class="right-panel" id="rightPanel">

      <!-- Placeholder par défaut -->
      <div class="rp-placeholder" id="placeholder">
        <svg viewBox="0 0 24 24"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
        <h3>Sélectionnez un message</h3>
        <p>Cliquez sur un message dans la liste pour le lire, ou composez un nouveau message.</p>
      </div>


      <!-- Vue conversation -->
      <div id="convView" style="display:none;flex-direction:column;flex:1">
        <div class="conv-header">
          <div class="conv-avatar" id="convAvatar"></div>
          <div>
            <div class="conv-name" id="convName"></div>
            <div class="conv-role">Administrateur</div>
          </div>
          <button class="conv-close" onclick="closeConv()">
            <svg viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
          </button>
        </div>
        <div class="conv-body" id="convBody"></div>
      </div>
          <!---->


      <!-- Formulaire de composition -->
      <div class="compose-panel hidden" id="composePanel">
        <div class="compose-header">
          Repondre
          <button class="compose-close" onclick="closeCompose()">
            <svg viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
          </button>
        </div>
        <form id="msgForm" action="" method="POST" novalidate>
         
          <div class="cp-field">
            <inpput type="hidden" id="id_msg">
              <div id="msg"></div>
            <label class="cp-label">Message <span style="color:var(--purple)">*</span></label>
            <textarea name="contenu" id="cp_contenu" class="cp-textarea" placeholder="Écrivez votre message ici..."></textarea>
            <span class="err-msg" id="e-contenu">Le message ne peut pas être vide.</span>
          </div>
          <div class="cp-footer">
            <button type="submit" class="btn-send" id="sendBtn">
              <div class="spinner"></div>
              <span>Envoyer</span>
              <svg viewBox="0 0 24 24"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>
            </button>
          </div>
        </form>
      </div>

    </div>
  </div>
</div>

<script>
  function toggleSB(){document.getElementById('sidebar').classList.toggle('open');document.getElementById('overlay').classList.toggle('show')}
  function closeSB(){document.getElementById('sidebar').classList.remove('open');document.getElementById('overlay').classList.remove('show')}

  let activeItem = null;

  function openMessage(id, name, initials, contenu) {
    if (activeItem) activeItem.classList.remove('active');
    activeItem = document.getElementById('item-' + id);
    if (activeItem) activeItem.classList.add('active');

    document.getElementById('placeholder').style.display = 'none';
    document.getElementById('composePanel').classList.add('hidden');

    const cv = document.getElementById('convView');
    cv.style.display = 'flex';
    document.getElementById('convAvatar').textContent = initials;
    document.getElementById('convName').textContent = name;

    document.getElementById('convBody').innerHTML = contenu;


    document.getElementById('rightPanel').classList.add('show');

       

  }

  function closeConv() {
    document.getElementById('convView').style.display = 'none';
    document.getElementById('placeholder').style.display = 'flex';
    if (activeItem) { activeItem.classList.remove('active'); activeItem = null; }
    document.getElementById('rightPanel').classList.remove('show');
  }

  function openCompose() {
    document.getElementById('convView').style.display = 'none';
    document.getElementById('placeholder').style.display = 'none';
    document.getElementById('composePanel').classList.remove('hidden');
    document.getElementById('rightPanel').classList.add('show');
    if (activeItem) { activeItem.classList.remove('active'); activeItem = null; }
  }

  function closeCompose() {
    document.getElementById('composePanel').classList.add('hidden');
    document.getElementById('placeholder').style.display = 'flex';
    document.getElementById('rightPanel').classList.remove('show');
  }

  function escHtml(s) {
    return s.replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;');
  }

  document.getElementById('msgForm').addEventListener('submit', function(e) {
    e.preventDefault();
    let ok = true;
    const adm = document.getElementById('cp_admin');
    const cnt = document.getElementById('cp_contenu');

    if (!adm.value) { document.getElementById('e-admin').classList.add('show'); ok = false; }
    else            { document.getElementById('e-admin').classList.remove('show'); }

    if (!cnt.value.trim()) { document.getElementById('e-contenu').classList.add('show'); ok = false; }
    else                   { document.getElementById('e-contenu').classList.remove('show'); }

    if (!ok) return;
    const btn = document.getElementById('sendBtn');
    btn.classList.add('loading'); btn.disabled = true;
    setTimeout(() => this.submit(), 600);
  });
</script>