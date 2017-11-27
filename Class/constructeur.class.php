<?php
  class constructeur{
  
    private $_db;
  
    public function __construct($db)
    {
      $this->setDb($db);
    }
  
    public function getList()
    {

      $constructeur = [];
      $sql = 'SELECT 	id_constructeur, nom_constructeur FROM constructeur ORDER BY nom_constructeur';
      $constructeur = $this->_db->query($sql);
        
      return $constructeur;
    }

    public function getLast()
    {

      $constructeur = [];
      $sql = 'SELECT 	id_constructeur FROM constructeur ORDER BY id_constructeur DESC LIMIT 1';
      $constructeur = $this->_db->query($sql);
       
      foreach ($constructeur as $row){
        return $row["id_constructeur"]; 
      }
           
    }

    public function addConstructeur($idConstructeur, $nomConstructeur)
    {

      $sql = 'insert into constructeur(id_constructeur, nom_constructeur) values ('.$idConstructeur.',"'.$nomConstructeur.'")';
      $this->_db->exec($sql);
      

    }
    
    public function setDb(PDO $db)
    {
      $this->_db = $db;
    }
    
  }
?>