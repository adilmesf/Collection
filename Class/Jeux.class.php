<?php
  class jeux{
  
    private $_db;
    private $jeux = [];
    private $_cpt = 0;

    public function __construct($db)
    {
      $this->setDb($db);
    }
  
    public function getList()
    {
      $sql = 'SELECT 	id_console, id_jeux, nom_jeux, annee_jeux  FROM jeux ORDER BY nom_jeux';
      $jeux = $this->_db->query($sql);
        
      return $jeux;
    }

    public function afficherCpt()
    {
      echo "Nombre de jeux : " . $this->_cpt . "<br>";
    }
  
    public function addCpt()
    {
      // On ajoute 1 à notre attribut $_experience.
      $this->_cpt = $this->_cpt + 1;
    }

    public function getLast()
    {
      $sql = 'SELECT 	id_jeux  FROM jeux ORDER BY id_jeux DESC LIMIT 1';
      $jeux = $this->_db->query($sql);
        
      foreach ($jeux as $row){
        return $row["id_jeux"]; 
      }
    }
    public function getListByConsole($id_console)
    {

      $sql = 'SELECT 	id_console, id_jeux, nom_jeux, annee_jeux  FROM jeux where id_console = '.$id_console.' ORDER BY nom_jeux';
      $jeux = $this->_db->query($sql);
        
      return $jeux;
    }  

    public function addJeux($id_console,$nom_jeux,$id_jeux,$annee_jeux)
    {
      $sql = 'insert into jeux(id_jeux, nom_jeux, id_console, annee_jeux) values ('.$id_jeux.',"'.$nom_jeux.'",'.$id_console.',"'.$annee_jeux.'")';
      $this->_db->exec($sql);
    }        
    
    public function deleteJeux($id_jeux)
    {
      $sql = 'delete from jeux where id_jeux = '.$id_jeux ;
      $this->_db->exec($sql);
    }

    public function setDb(PDO $db)
    {
      $this->_db = $db;
    }
    
  }
?>