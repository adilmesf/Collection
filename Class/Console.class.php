<?php
  class console{
  
    private $_db;
  
    public function __construct($db)
    {
      $this->setDb($db);
    }
  
    public function getList()
    {

      $console = [];
      $sql = 'SELECT 	id_console, nom_console FROM console ORDER BY nom_console';
      $console = $this->_db->query($sql);
        
      return $console;
    }
    
    public function setDb(PDO $db)
    {
      $this->_db = $db;
    }
    
  }
?>