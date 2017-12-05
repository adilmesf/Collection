<?php
   require("..\Class\Jeux.class.php");
   $db = new PDO('mysql:host=localhost;dbname=collection', 'root', 'root');
   $oJeux = new jeux($db);

   $oJeux->deleteJeux($_GET["id"]);
   header("location:..\index.php");
?>