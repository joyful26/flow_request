<?php
class DashbordAdmin extends BdModel
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
    public $Etudmsg;
    public $EtudCountmsg;
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
            $sql ="SELECT * FROM requete AS r  INNER JOIN objet AS o, etudiant AS e WHERE r.id_admin =:c AND r.id_objet=o.id_objet AND r.matricule=e.matricule ORDER BY r.id_requete ";
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

    
    public function inserReponse(string $mat, string $contenu )
    {
        

        try{
            $sql ="INSERT INTO `reponse`(id_admin_r, matricule_r, contenu_r) VALUES(?,?,?)";

            $requete = $this->connexion->prepare($sql);
            $requete->bindValue(1, $_SESSION['admin']['id']);
            $requete->bindValue(2, $mat);  
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
            $sql ="SELECT * FROM `message` AS m INNER JOIN `etudiant` AS e WHERE m.id_admin =? AND m.matricule=e.matricule=";
            $requete = $this->connexion->prepare($sql);
            $requete->bindValue(1, $_SESSION['admin']['id']);
            $requete->bindValue(2, $val);
            $requete->bindValue(3, $val);
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
     public function getContentMsgEtud($matricule){
        try{
            $sql ="SELECT * FROM `message` AS m INNER JOIN `reponse` AS r ON m.id_message =r.id_message_r WHERE m.id_admin =:e AND m.matricule= :c ";
            $requete = $this->connexion->prepare($sql);
            $requete->bindValue(":c", $matricule);
            $requete->bindValue(":e", $_SESSION['admin']['id']);
            $requete->execute();
            return $requete->fetchAll();
        }catch(PDOException $e){
            return "erreur:: ".$e->getMessage();
        }
     }
     public function getContentMsgEtud2($matricule){
        try{
            $id= $_SESSION['admin']['id'];
            $sql ="SELECT contenu, date_message, id_message FROM `message` AS m LEFT JOIN reponse AS r ON m.id_message = r.id_message_r WHERE r.id_message_r IS NULL AND m.matricule =:c AND m.id_admin=:d;";
            $requete = $this->connexion->prepare($sql);
            $requete->bindValue(":c", $matricule);
            $requete->bindValue(":d", $_SESSION['admin']['id']);
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
    //recupere les etudiant qui ont mis des messages
    public function getEtudMsg($val){
        try{
            $sql ="SELECT DISTINCT nom, prenom, e.matricule, m.matricule FROM `etudiant` AS `e` INNER JOIN `message` AS `m` WHERE m.id_admin =:c AND e.matricule=m.matricule  ";
            $requete = $this->connexion->prepare($sql);
            $requete->bindValue(":c", $val);
            $requete->execute();
            return $requete->fetchAll();
        }catch(PDOException $e){
            return "erreur:: ".$e->getMessage();
        }
    }
    //le nombre de message pour un etudiant par
    public function getMsgPerEtud($mat){
        try{
            $sql ="SELECT count(*) FROM `message`  WHERE matricule =:c AND id_admin=:d ";
            $requete = $this->connexion->prepare($sql);
            $requete->bindValue(":c", $mat);
            $requete->bindValue(":d", $_SESSION['admin']['id']);
            $requete->execute();
            return 1;
        }catch(PDOException $e){
            return "erreur:: ".$e->getMessage();
        }
    }
    
}
?>