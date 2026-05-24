<?php

class DashbordEtudiantController extends MainController
{
    public function index()
    {
        $this->loadModel("DashbordEtudiant");
        $this->DashbordEtudiant->total_req = sizeof($this->DashbordEtudiant->getNombre("requete", "matricule", $_SESSION['etudiant']['matricule']));
        $this->DashbordEtudiant->total_msg = sizeof($this->DashbordEtudiant->getNombre("message", "matricule", $_SESSION['etudiant']['matricule']));
        $this->DashbordEtudiant->requetes = $this->DashbordEtudiant->getRequete($_SESSION['etudiant']['matricule']);
        $this->DashbordEtudiant->AdminCountRep = sizeof($this->DashbordEtudiant->getAdminCountRep($_SESSION['etudiant']['matricule']));
        $this->render('index', 'dashbordetudiant');
    }
    public function dossier()
    {
        $this->loadModel("DashbordEtudiant");
        $this->DashbordEtudiant->total_req = sizeof($this->DashbordEtudiant->getNombre("requete", "matricule", $_SESSION['etudiant']['matricule']));
        $this->DashbordEtudiant->total_msg = sizeof($this->DashbordEtudiant->getNombre("message", "matricule", $_SESSION['etudiant']['matricule']));
        $this->DashbordEtudiant->requetes = $this->DashbordEtudiant->getRequete($_SESSION['etudiant']['matricule']);
        $this->DashbordEtudiant->pieces = $this->DashbordEtudiant->getPiece($_SESSION['etudiant']['matricule']);
        $this->DashbordEtudiant->AdminCountRep = sizeof($this->DashbordEtudiant->getAdminCountRep($_SESSION['etudiant']['matricule']));
        $this->render('dossier', 'dashbordetudiant');
    }
    public function nouvelle_requete()
    {
        $this->loadModel("DashbordEtudiant");
        $this->DashbordEtudiant->total_req = sizeof($this->DashbordEtudiant->getNombre("requete", "matricule", $_SESSION['etudiant']['matricule']));
        $this->DashbordEtudiant->total_msg = sizeof($this->DashbordEtudiant->getNombre("message", "matricule", $_SESSION['etudiant']['matricule']));
        $this->DashbordEtudiant->requetes = $this->DashbordEtudiant->getRequete($_SESSION['etudiant']['matricule']);
        $this->DashbordEtudiant->objets = $this->DashbordEtudiant->getObjet();
        $this->DashbordEtudiant->admins = $this->DashbordEtudiant->getAdmin();
        $this->DashbordEtudiant->pieces = $this->DashbordEtudiant->getPiece($_SESSION['etudiant']['matricule']);
        $this->DashbordEtudiant->AdminCountRep = sizeof($this->DashbordEtudiant->getAdminCountRep($_SESSION['etudiant']['matricule']));
        $this->render('nouvelle_requete', 'dashbordetudiant');
    }
    public function requete()
    {
        $this->loadModel("DashbordEtudiant");
        $this->DashbordEtudiant->total_req = sizeof($this->DashbordEtudiant->getNombre("requete", "matricule", $_SESSION['etudiant']['matricule']));
        $this->DashbordEtudiant->total_msg = sizeof($this->DashbordEtudiant->getNombre("message", "matricule", $_SESSION['etudiant']['matricule']));
        $this->DashbordEtudiant->requetes = $this->DashbordEtudiant->getRequete($_SESSION['etudiant']['matricule']);
        $this->DashbordEtudiant->AdminCountRep = sizeof($this->DashbordEtudiant->getAdminCountRep($_SESSION['etudiant']['matricule']));
        $this->render('requete', 'dashbordetudiant');
    }
    public function messages()
    {
        $this->loadModel("DashbordEtudiant");
        $this->DashbordEtudiant->total_req = sizeof($this->DashbordEtudiant->getNombre("requete", "matricule", $_SESSION['etudiant']['matricule']));
        $this->DashbordEtudiant->total_msg = sizeof($this->DashbordEtudiant->getNombre("message", "matricule", $_SESSION['etudiant']['matricule']));
        $this->DashbordEtudiant->requetes = $this->DashbordEtudiant->getRequete($_SESSION['etudiant']['matricule']);
        $this->DashbordEtudiant->admins = $this->DashbordEtudiant->getAdmin();
        $this->DashbordEtudiant->msg = $this->DashbordEtudiant->getMsg($_SESSION['etudiant']['matricule']);
        $this->DashbordEtudiant->rep = $this->DashbordEtudiant->getRep($_SESSION['etudiant']['matricule']);
        $this->DashbordEtudiant->Adminrep = $this->DashbordEtudiant->getAdminRep($_SESSION['etudiant']['matricule']);
        $this->DashbordEtudiant->AdminCountRep = sizeof($this->DashbordEtudiant->getAdminCountRep($_SESSION['etudiant']['matricule']));
        $this->render('messages', 'dashbordetudiant');
    }

    
}

?>