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

    public function getLast()
    {

      $console = [];
      $sql = 'SELECT 	id_console FROM console ORDER BY id_console DESC LIMIT 1';
      $console = $this->_db->query($sql);
       
      foreach ($console as $row){
        return $row["id_console"]; 
      }
           
    }

    public function addConsole($idConsole, $nomConsole, $constructeurConsole)
    {

      $sql = 'insert into console(id_console, nom_console, constructeur_Console) values ('.$idConsole.',"'.$nomConsole.'",'.$constructeurConsole.')';
      $this->_db->exec($sql);
      

    }
    
    public function setDb(PDO $db)
    {
      $this->_db = $db;
    }
    
  }
?>