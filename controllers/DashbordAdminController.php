<?php

class DashbordAdminController extends MainController
{
    public function index()
    {
        $this->loadModel("DashbordAdmin");
        $this->DashbordAdmin->total_req = sizeof($this->DashbordAdmin->getNombre("requete", "id_admin", $_SESSION['admin']['id']));
        $this->DashbordAdmin->total_msg = sizeof($this->DashbordAdmin->getNombre("message", "id_admin", $_SESSION['admin']['id']));
        $this->DashbordAdmin->requetes = $this->DashbordAdmin->getRequete($_SESSION['admin']['id']);
        //$this->DashbordAdmin->EtudCountmsg = $this->DashbordAdmin->getMesgPerEtud();
        $this->DashbordAdmin->Etudmsg = $this->DashbordAdmin->getEtudMsg($_SESSION['admin']['id']);
        $this->DashbordAdmin->objets = $this->DashbordAdmin->getObjet();
        
        //$this->DashbordEtudiant->AdminCountRep = sizeof($this->DashbordEtudiant->getAdminCountRep($_SESSION['etudiant']['matricule']));
        $this->render('index', 'dashbordadmin');
    }
  
    public function requete()
    {
        $this->loadModel("DashbordAdmin");
        $this->DashbordAdmin->total_req = sizeof($this->DashbordAdmin->getNombre("requete", "id_admin", $_SESSION['admin']['id']));
        $this->DashbordAdmin->total_msg = sizeof($this->DashbordAdmin->getNombre("message", "id_admin", $_SESSION['admin']['id']));
        $this->DashbordAdmin->requetes = $this->DashbordAdmin->getRequete($_SESSION['admin']['id']);
        $this->DashbordAdmin->Etudmsg = $this->DashbordAdmin->getEtudMsg($_SESSION['admin']['id']);
        $this->DashbordAdmin->objets = $this->DashbordAdmin->getObjet();/*
        $this->DashbordEtudiant->admins = $this->DashbordEtudiant->getAdmin();
        $this->DashbordEtudiant->msg = $this->DashbordEtudiant->getMsg($_SESSION['etudiant']['matricule']);
        $this->DashbordEtudiant->rep = $this->DashbordEtudiant->getRep($_SESSION['etudiant']['matricule']);
        $this->DashbordEtudiant->Adminrep = $this->DashbordEtudiant->getAdminRep($_SESSION['etudiant']['matricule']);
        $this->DashbordEtudiant->AdminCountRep = sizeof($this->DashbordEtudiant->getAdminCountRep($_SESSION['etudiant']['matricule']));*/
        $this->render('requetes', 'dashbordadmin');
    }
    public function message()
    {
        $this->loadModel("DashbordAdmin");
        $this->DashbordAdmin->total_req = sizeof($this->DashbordAdmin->getNombre("requete", "id_admin", $_SESSION['admin']['id']));
        $this->DashbordAdmin->total_msg = sizeof($this->DashbordAdmin->getNombre("message", "id_admin", $_SESSION['admin']['id']));
        $this->DashbordAdmin->requetes = $this->DashbordAdmin->getRequete($_SESSION['admin']['id']);
        $this->DashbordAdmin->Etudmsg = $this->DashbordAdmin->getEtudMsg($_SESSION['admin']['id']);
        $this->DashbordAdmin->objets = $this->DashbordAdmin->getObjet();/*
        $this->DashbordEtudiant->admins = $this->DashbordEtudiant->getAdmin();
        $this->DashbordEtudiant->msg = $this->DashbordEtudiant->getMsg($_SESSION['etudiant']['matricule']);
        $this->DashbordEtudiant->rep = $this->DashbordEtudiant->getRep($_SESSION['etudiant']['matricule']);
        $this->DashbordEtudiant->Adminrep = $this->DashbordEtudiant->getAdminRep($_SESSION['etudiant']['matricule']);
        $this->DashbordEtudiant->AdminCountRep = sizeof($this->DashbordEtudiant->getAdminCountRep($_SESSION['etudiant']['matricule']));*/
        $this->render('message', 'dashbordadmin');
    }

    
}

?>