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
    require("..\Class\Jeux.class.php");
    require("..\Class\Console.class.php");
    $db = new PDO('mysql:host=localhost;dbname=collection', 'root', 'root');
    
    /* Instanciation des objets */
    $oConsole = new console($db);
    $oJeux = new jeux($db);

    $result = $oJeux->getLast();
    if (isset($_POST["nom_jeux"]) && isset($_POST["console_jeux"])){
        
        $oJeux->addJeux($_POST["console_jeux"],$_POST["nom_jeux"],$_POST["id_jeux"],$_POST["annee_jeux"]);
        header('Location: ..\index.php');
    }
    
  ?>
  </head>
  <body>
    <form method="POST" action="#">
      <table>
        <tr>
          <td><label> ID </label></td>
          <td><input type="text" value="<?php echo ($result + 1) ;?>" name="id_jeux" /></td>
        </tr>
        <tr>
          <td><label> Console </label></td>
          <td>
          <select id="console_jeux" name="console_jeux">
            <?php 
              $result = $oConsole->getList();
              foreach ($result as $row) {
                
                echo "<option value=".$row["id_console"].">".$row["nom_console"]."</option>";
              }   
            ?>
          </select>
          </td>
        </tr>
        <tr>
          <td><label> Jeux </label></td>
          <td><input type="text" value="" name="nom_jeux" /></td>
        </tr>
        <tr>
          <td><label> Année </label></td>
          <td><input type="date" value="" name="annee_jeux" /></td>
        </tr>
        <tr>
          <td colspan="2"><input type="submit" /></td>
        </tr>
    </form>    
  </body>
</html>