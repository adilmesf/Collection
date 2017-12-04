<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<?php
session_start();
?>
<html>
  <head>
  <meta http-equiv="content-type" content="text/html; charset=windows-1250">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title></title>
  <link rel="stylesheet" href="styles.css" />
  <script src="jquery-3.2.1.js"></script>
  <script src="jqueryUI/jquery-ui.js"></script>
  </head>
  <body>
  <?php 
    require("Class\Console.class.php");
    require("Class\Jeux.class.php");
    require("Class\Constructeur.class.php");
    $db = new PDO('mysql:host=localhost;dbname=collection', 'root', 'root');
    $oConsole = new console($db);
    $oJeux = new jeux($db);
    $oConstructeur = new constructeur($db);

    /* Validation Saisie formulaire ajout console */
    if (isset($_POST["nom_console"])){
      $oConsole->addConsole($_POST["id_console"],$_POST["nom_console"],$_POST["constructeur_console"]);
    } 

    /* Validation Saisie formulaire ajout jeux */
    if (isset($_POST["nom_jeux"]) && isset($_POST["console_jeux"])){
      $oJeux->addJeux($_POST["console_jeux"],$_POST["nom_jeux"],$_POST["id_jeux"],$_POST["annee_jeux"]);
    }

    /* Validation Saisie formulaire ajout constructeur */
    if (isset($_POST["nom_constructeur"])){
      $oConstructeur->addConstructeur($_POST["id_constructeur"],$_POST["nom_constructeur"]);
    }
  ?>
  <table>
    <tr>
      <td>
        <form>
          <label>Console : </label>
          <select id="console" class="select" name="select_console_index">
            <option value="">&nbsp;</option>
             <?php
              $result = $oConsole->getList();
              
              foreach ($result as $row) {
                if (isset($_SESSION["console_choisie"]) && $_SESSION["console_choisie"] == $row["id_console"]){
                  echo "<option value=".$row["id_console"]." selected>".$row["nom_console"]."</option>";
                } else {
                  echo "<option value=".$row["id_console"].">".$row["nom_console"]."</option>";
                }
              }               
            ?>  
          </select>
          <!-- Champ qui va garder en mémoire l'id de la console choisie -->
          <input type="hidden" value="" class="id_cache"/>
        </form>      
      </td>
      <!--<td><a href="admin\ajout_console.php">Ajouter une console</a></td>-->
      <td><a href="#ajoutConsole" class="lien">Ajouter une console</a></td>
      <td><a href="#ajoutConstructeur" class="lien">Ajouter un constructeur</a></td>
      <td><a href="#ajoutJeux" class="lien">Ajouter un jeu</a></td>
    </tr>
  </table>

  <hr>
  <!-- Ajout d'un jeu -->
  <div id="ajoutJeux" class="div2">
    <?php
      $result = $oJeux->getLast();
    ?>
    <form method="POST" action="">
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
                
                if (isset($_SESSION["console_choisie"]) && $_SESSION["console_choisie"] == $row["id_console"]){
                  echo "<option value=".$row["id_console"]." selected>".$row["nom_console"]."</option>";
                } else {
                  echo "<option value=".$row["id_console"].">".$row["nom_console"]."</option>";
                }
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
      </table>
    </form>      
  </div>
  <!-- Fin Ajout d'un jeu -->

  <!-- Ajout d'une console -->
  <div id="ajoutConsole" class="div2">
    <?php 
      $result = $oConsole->getLast();
      ?>
      <form method="POST" action="">
      <table>
        <tr>
          <td><label> ID </label></td>
          <td><input type="text" value="<?php echo ($result + 1) ;?>" name="id_console" /></td>
        </tr>
        <tr>
          <td><label> Constructeur </label></td>
          <td>
          <select id="constructeur_console" name="constructeur_console">
            <?php 
              $result = $oConstructeur->getList();
              foreach ($result as $row) {
                
                echo "<option value=".$row["id_constructeur"].">".$row["nom_constructeur"]."</option>";
              }   
            ?>
          </select>
          </td>
        </tr>
        <tr>
          <td><label> Console </label></td>
          <td><input type="text" value="" name="nom_console" /></td>
        </tr>
        <tr>
          <td colspan="2"><input type="submit" /></td>
        </tr>
      </table>
    </form>    
  </div>
  <!-- Fin Ajout d'une console -->

  <!-- Ajout d'un constructeur -->
  <div id="ajoutConstructeur" class="div2">
    <?php
      $result = $oConstructeur->getLast();
    ?>
    <form method="POST" action="">
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
        </table>
    </form>      
  </div>
  <!-- Fin Ajout d'un constructeur -->

  <!-- Affichage des resultats -->
  <?php
      $result = $oConsole->getList();
              
      foreach ($result as $row) {         
        echo "<div id='".$row["id_console"]."' class='div'>";

        $resultJeux = $oJeux->getListByConsole($row["id_console"]);
        echo "<table>";
        foreach ($resultJeux as $rowJeux) {          
          echo "<tr>
                  <td>".$rowJeux["nom_jeux"]."</td>
                  <td>Supprimer</td>
                </tr>";
        } 
        echo "</table>";
        echo "</div>";    
      }     
                            
  ?>  
  <!-- Fin Affichage des resultats -->

  <!-- Scripts jQuery / Javascript -->
  <script>  
    
    masquerDiv();
    masquerDiv2();
    
    function masquerDiv(){  
      $(".div").each(function(){ 
        $(this).css({"display":"none"});
      });  
    }

    function masquerDiv2(){  
      $(".div2").each(function(){ 
        $(this).css({"display":"none"});
      });  
    }
    
    function controlerDiv2(valeur){
      $(".div2").each(function(){ 
        if ($(this).dialog('isOpen') === true){
          if ($(this).attr("id") != $(valeur).attr("id"))
            { $(this).dialog("close"); }
        }
      }); 
    }
    
    $(".select").change(function(){
      var consoleChoisie = $("select").val();
      $(".id_cache").attr({value : consoleChoisie});

      /* Pour mettre à jour les variables de session */
      var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                //On ne fait rien de particulier
            }
        };
      xmlhttp.open("GET", "admin/Sessions.php?q=" + consoleChoisie, true);
      xmlhttp.send();

      // Je mets la bonne console 
      if (consoleChoisie !== ""){
        $("#console_jeux").val(consoleChoisie);
      }
      afficherDiv();
    });
    
    function afficherDiv(){
      $(".div").each(function(){ 
        if ($(this).attr("id") === $("select").val()){
           $(this).fadeIn();
        } else {
          $(this).fadeOut();
        }
      });
    }

    /* Quand on clique sur un lien */
    $("a").click(function (){
      masquerDiv2();
      var val = $(this).attr("href");
      $(val).fadeIn();
      $(val).dialog({modal: true});  
      controlerDiv2(val);  
    });

    /* Quand on a fait une saisie, on reaffiche les informations */
    $(document).ready(function() {
      if ($("select").val() !== "") {
        afficherDiv();
      }
    });
    
  </script>
  </body>
</html>