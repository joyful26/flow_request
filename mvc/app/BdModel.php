<?php
use PDO;
use PDOException;
abstract class BdModel extends PDO
{
    //informationde base de donnéé
    private const DBHOST = 'localhost';
    private const DBUSER = 'root';
    private const DBPASS = '';
    private const DBNAME = 'geco_requete';

    //propriété contenant  la connexion

    protected $connexion;
    //propriété concernant la table
    public $table;
    public $matricule;
    public $email;
    

    public function getConnexion()
    {
        $this->connexion = null;

        $dsn = 'mysql:host='.self::DBHOST.';dbname='.self::DBNAME;
        try{
            $this->connexion = new PDO($dsn, self::DBUSER, self::DBPASS);
            $this->connexion->exec('set names utf8');
        }catch(PDOException $e){
            echo"Erreur de connexion :: ".$e->getMessage();
        }
    }
/*
   public function getAll()
    {
        $sql ="SELECT * FROM $this->table";
        $requete = $this->connexion->prepare($sql);
        $requete->execute();
        return $requete->fetchAll();
    }
    
    public function getOne($id)
    {
        $sql ="SELECT * FROM $this->table WHERE id = :id";
        $requete = $this->connexion->prepare($sql);
        $requete->bindValue(":id", $id);
        $requete->execute();
        return $requete->fetch();
    }
*/
    public function getByMatricule()
    {
        try{
            $sql ="SELECT * FROM $this->table WHERE matricule = ?";
            $requete = $this->connexion->prepare($sql);
            $requete->bindValue(1, $this->matricule);
            $requete->execute();
            return $requete->fetch();
        }catch(PDOException $e){
            return "erreur:: ".$e->getMessage();
        }
    }
    public function getDepartement()
    {   
        try{
            $sql ="SELECT DISTINCT * FROM departement ";
            $requete = $this->connexion->prepare($sql);
            $requete->execute();
            return $requete->fetchAll();
        }catch(PDOException $e){
            return "erreur:: ".$e->getMessage();
        }
    }
    public function getFiliere()
    {   
        try{
            $sql ="SELECT DISTINCT * FROM filiere ";
            $requete = $this->connexion->prepare($sql);
            $requete->execute();
            return $requete->fetchAll();
        }catch(PDOException $e){
            return "erreur:: ".$e->getMessage();
        }
    }
    public function getCycle()
    {
        try{
            $sql ="SELECT DISTINCT * FROM cycle ";
            $requete = $this->connexion->prepare($sql);
            $requete->execute();
            return $requete->fetchAll();
        }catch(PDOException $e){
            return "erreur:: ".$e->getMessage();
        }
    }
    
    

}

?>