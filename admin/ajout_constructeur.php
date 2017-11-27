<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <head>
  <meta http-equiv="content-type" content="text/html; charset=windows-1250">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title></title>
  <link rel="stylesheet" href="styles.css" />
  <script src="jquery-3.2.1.js"></script>
  <script src="jqueryUI/jquery-ui.js"></script>
  <?php 
    require("..\Class\Constructeur.class.php");
    $db = new PDO('mysql:host=localhost;dbname=collection', 'root', 'root');
    
    $obj = new constructeur($db);
    $result = $obj->getLast();
    
    if (isset($_POST["nom_constructeur"])){
        
        $obj->addConstructeur($_POST["id_constructeur"],$_POST["nom_constructeur"]);
        header('Location: ..\index.php');
    }
    
  ?>
  </head>
  <body>
    <form method="POST" action="#">
      <table>
        <tr>
          <td><label> ID </label></td>
          <td><input type="text" value="<?php echo ($result + 1) ;?>" name="id_constructeur" /></td>
        </tr>
        <tr>
          <td><label> Nom </label></td>
          <td><input type="text" value="" name="nom_constructeur" /></td>
        </tr>
        <tr>
          <td colspan="2"><input type="submit" /></td>
        </tr>
    </form>    
  </body>
</html>