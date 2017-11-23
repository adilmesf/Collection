<?php
  class jeux{
  
    private $_db;
  
    public function __construct($db)
    {
      $this->setDb($db);
    }
  
    public function getList()
    {

      $jeux = [];
      $sql = 'SELECT 	id_console, id_jeux, nom_jeux, annee_jeux  FROM jeux ORDER BY nom_jeux';
      $jeux = $this->_db->query($sql);
        
      return $jeux;
    }
    
    public function setDb(PDO $db)
    {
      $this->_db = $db;
    }
    
  }
?>