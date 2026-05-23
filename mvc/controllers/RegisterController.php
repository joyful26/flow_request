<?php
class RegisterController extends MainController
{
    public function index()
    {
        $this->loadModel("Register");
        $this->render('index');
    }
    public function connexion()
    {
        $this->loadModel("Register");
        $this->render('connexion');
    }
    public function inscription()
    {
        $this->loadModel("Register");
        $departement = $this->Register->getDepartement();
        $filiere = $this->Register->getFiliere();
        $cycle = $this->Register->getCycle();
        $params = [
            "departement" => $departement,
            "filiere" => $filiere,
            "cycle" => $cycle
        ];
        $this->render('inscription', "",['info' => $params]);
    }
  
    
}