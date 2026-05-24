<?php

class Register extends BdModel
{
    public function __construct()
    {
        $this->getConnexion();
    }
    public function test()
    {
        return "test ok";
    }
    public function err($msg) 
    { 
        echo ('message:: '.$msg); 
        exit;
    }

    public function verifMat($val, string $champ = "matricule" ){
        
        try{
            $sql ="SELECT * FROM etudiant WHERE $champ =:c";
            $requete = $this->connexion->prepare($sql);
            $requete->bindValue(":c", $val);
            $requete->execute();
            return $requete->fetch();
        }catch(PDOException $e){
            return "erreur:: ".$e->getMessage();
        }
    }
    public function verifEmail($val, string $champ = "email" ){
        
        try{
            $sql ="SELECT * FROM administrateur WHERE $champ =:c";
            $requete = $this->connexion->prepare($sql);
            $requete->bindValue(":c", $val);
            $requete->execute();
            return $requete->fetch();
        }catch(PDOException $e){
            return "erreur:: ".$e->getMessage();
        }
    }

    public function insertionEtudiant(array $infos)
    {
        $champs = [];
        $inter =[];
        $valeurs = [];
        
        foreach($infos as  $champ => $valeur){
            
            if($valeur != null && $champ != null)
            {
                $champs[] = $champ;
                $inter[] = "?";
                $valeurs[] = $valeur;
            }
            

        }
        $liste_champs = implode(', ', $champs);
        $liste_inter = implode(', ', $inter);

        
        try{
            $sql ="INSERT INTO etudiant($liste_champs) VALUES($liste_inter)";
            $requete = $this->connexion->prepare($sql);
            
            $i=1;
            foreach($valeurs as $val){
                $requete->bindValue($i++, $val);
            }
    

            $requete->execute();

            $id = $this->connexion->lastInsertId();
            mkdir('upload/'.$infos['matricule'].'--'.$infos['nom'].'--'.$infos['prenom'], 0744, true);
            $libelle =$infos['matricule'].'--'.$infos['nom'].'--'.$infos['prenom'];
            $this->insertionDossier($id, $libelle);

            return $requete->fetch();
        }catch(PDOException $e){
            return "erreur:: ".$e->getMessage();
        }
    }
    public function insertionDossier($id, $libelle)
    {
        try{
            $sql ="INSERT INTO dossier(`id_etudiant`, `libelle_dossier`) VALUES($id, $libelle)";
            $requete = $this->connexion->prepare($sql);    
            $requete->execute();
            return $requete->fetch();
        }catch(PDOException $e){
            return "erreur:: ".$e->getMessage();
        }
    }
}

?>