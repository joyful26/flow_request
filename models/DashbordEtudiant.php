<?php
class DashbordEtudiant extends BdModel
{
    public $total_msg;
    public $total_req;
    public $requetes;
    public $objets;
    public $admins;
    public $pieces;
    public $msg;
    public $rep;
    public $Adminrep;
    public $AdminCountRep;
    public function __construct()
    {
        $this->getConnexion();
    }
    public function delete($tab, array $data){
     
        $champs = [];
        $valeurs = [];
        
        foreach($data as  $champ => $valeur){
            
            if($valeur != null && $champ != null)
            {
               
                $champs[] = $champ.'=?';
                $valeurs[] = $valeur;
            }
            

        }
        $liste_champs = implode(' AND ', $champs);
        $champs_asso = $champs[0];
        $val_asso = $valeurs[0];
        if($tab ==="requete" || $tab ==="piece_jointe"){
            try{
                $sql ="DELETE FROM associer WHERE $champs_asso";
                $requete = $this->connexion->prepare($sql);
                
                $requete->bindValue(1, $val_asso);           

                $requete->execute();

            }catch(PDOException $e){
                return false;
            }
        }
        try{
            $sql ="DELETE FROM $tab WHERE $liste_champs";
            $requete = $this->connexion->prepare($sql);
            
            $i=1;
            foreach($valeurs as $val){
                $requete->bindValue($i++, $val);
            }

        
            $requete->execute();

            return true;
        }catch(PDOException $e){
            return false;
        }
    }
    public function getNombre($tab, $champ, $val){
        try{
            $sql ="SELECT * FROM $tab WHERE $champ =:c";
            $requete = $this->connexion->prepare($sql);
            $requete->bindValue(":c", $val);
            $requete->execute();
            return $requete->fetchAll();
        }catch(PDOException $e){
            return "erreur:: ".$e->getMessage();
        }
    }
    public function getRequete($val){
        try{
            $sql ="SELECT * FROM requete AS r  INNER JOIN objet AS o WHERE r.matricule =:c AND r.id_objet=o.id_objet";
            $requete = $this->connexion->prepare($sql);
            $requete->bindValue(":c", $val);
            $requete->execute();
            return $requete->fetchAll();
        }catch(PDOException $e){
            return "erreur:: ".$e->getMessage();
        }
    }
    public function getObjet(){
        try{
            $sql ="SELECT * FROM objet";
            $requete = $this->connexion->prepare($sql);
            $requete->execute();
            return $requete->fetchAll();
        }catch(PDOException $e){
            return "erreur:: ".$e->getMessage();
        }
    }
    public function getAdmin(){
        try{
            $sql ="SELECT * FROM administrateur";
            $requete = $this->connexion->prepare($sql);
            $requete->execute();
            return $requete->fetchAll();
        }catch(PDOException $e){
            return "erreur:: ".$e->getMessage();
        }
    }
    
    public function addPiece(array $data){

        $champs = [];
        $inter =[];
        $valeurs = [];
        
        foreach($data as  $champ => $valeur){
            
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
            $sql ="INSERT INTO piece_jointe($liste_champs) VALUES($liste_inter)";
            $requete = $this->connexion->prepare($sql);
            
            $i=1;
            foreach($valeurs as $val){
                $requete->bindValue($i++, $val);
            }

        
            $requete->execute();

            return true;
        }catch(PDOException $e){
            return false;
        }
    }
    public function getPiece($val){
        try{
            $sql ="SELECT * FROM piece_jointe WHERE matricule =:c";
            $requete = $this->connexion->prepare($sql);
            $requete->bindValue(":c", $val);
            $requete->execute();
            return $requete->fetchAll();
        }catch(PDOException $e){
            return "erreur:: ".$e->getMessage();
        }
    }

    public function insertReq(array $infos, array $info_asso )
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
            $sql ="INSERT INTO requete($liste_champs) VALUES($liste_inter)";
            $requete = $this->connexion->prepare($sql);
            
            $i=1;
            foreach($valeurs as $val){
                $requete->bindValue($i++, $val);
            }
    

            $requete->execute();

            $id = $this->connexion->lastInsertId();
            
        }catch(PDOException $e){
            return false;
        }

        foreach($info_asso as  $val){
            
            if($val !== null)
            {
                try{
                    $sql ="INSERT INTO associer(id_requete, id_piece) VALUES(?, ?)";
                    $requete = $this->connexion->prepare($sql);
                    $requete->bindValue(1, $id);
                    $requete->bindValue(2, $val);
                    $requete->execute();
                    
                }catch(PDOException $e){
                    return false;
                }
            }
            

        }
       
        return true;
    }
    public function inserMessage(string $admin, string $contenu )
    {
        

        try{
            $sql ="INSERT INTO `message`(id_admin, matricule, contenu) VALUES(?,?,?)";

            $requete = $this->connexion->prepare($sql);
            $requete->bindValue(1, $admin);  
            $requete->bindValue(2, $_SESSION['etudiant']['matricule']);  
            $requete->bindValue(3, $contenu);  

            $requete->execute();

            $id = $this->connexion->lastInsertId();

            return true;
            
        }catch(PDOException $e){
            return false;
        }
       
        
    }
   public function getMsg($val){
        try{
            $sql ="SELECT * FROM `message` WHERE matricule =?";
            $requete = $this->connexion->prepare($sql);
            $requete->bindValue(1, $val);
            $requete->execute();
            return $requete->fetchAll();
        }catch(PDOException $e){
            return "erreur:: ".$e->getMessage();
        }
    }

      public function getContentRepAdmin($id_admin, $matricule){
        try{
            $sql ="SELECT contenu_r, date_reponse FROM `reponse`  WHERE matricule_r =:c AND id_admin_r=:d GROUP BY date_reponse";
            $requete = $this->connexion->prepare($sql);
            $requete->bindValue(":c", $matricule);
            $requete->bindValue(":d", $id_admin);
            $requete->execute();
            return $requete->fetchAll();
        }catch(PDOException $e){
            return "erreur:: ".$e->getMessage();
        }
    }
    public function getRep($val){
        try{
            $sql ="SELECT * FROM `reponse` AS `r` INNER JOIN `administrateur` AS `a` , `message` AS `m` WHERE r.matricule_r =:c AND r.id_admin_r=a.id_admin AND r.id_message_r=m.id_message";
            $requete = $this->connexion->prepare($sql);
            $requete->bindValue(":c", $val);
            $requete->execute();
            return $requete->fetchAll();
        }catch(PDOException $e){
            return "erreur:: ".$e->getMessage();
        }
    }
    public function getAdminRep($val){
        try{
            $sql ="SELECT DISTINCT nom, prenom, id_admin FROM `administrateur` AS `a` INNER JOIN `reponse` AS `r` WHERE r.matricule_r =:c AND r.id_admin_r=a.id_admin ";
            $requete = $this->connexion->prepare($sql);
            $requete->bindValue(":c", $val);
            $requete->execute();
            return $requete->fetchAll();
        }catch(PDOException $e){
            return "erreur:: ".$e->getMessage();
        }
    }
    
    public function getRepPerAdmin($mat, $id ){
        try{
            $sql ="SELECT count(*) FROM `reponse`  WHERE matricule_r =:c AND id_admin_r=:d ";
            $requete = $this->connexion->prepare($sql);
            $requete->bindValue(":c", $mat);
            $requete->bindValue(":d", $id);
            $requete->execute();
            return $requete->fetchColumn();
        }catch(PDOException $e){
            return "erreur:: ".$e->getMessage();
        }
    }
    public function getAdminCountRep($val){
        try{
            $sql ="SELECT * FROM `administrateur` AS `a` INNER JOIN `reponse` AS `r` WHERE r.matricule_r =:c AND r.id_admin_r=a.id_admin ";
            $requete = $this->connexion->prepare($sql);
            $requete->bindValue(":c", $val);
            $requete->execute();
            return $requete->fetchAll();
        }catch(PDOException $e){
            return "erreur:: ".$e->getMessage();
        }
    }
    
}
?>