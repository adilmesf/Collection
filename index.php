<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
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
    $db = new PDO('mysql:host=localhost;dbname=adil', 'root', 'root');
    $oConsole = new console($db);
    $oJeux = new jeux($db);
  ?>
  <table>
    <tr>
      <td>
        <form>
          <label>Console : </label>
          <select id="console">
            <option value="">&nbsp;</option>
             <?php
              $result = $oConsole->getList();
              
              foreach ($result as $row) {
                
                echo "<option value=".$row["id_console"].">".$row["nom_console"]."</option>";
              }     
                            
            ?>  
          </select>
        </form>      
      </td>
      <td><a href="admin\ajout_console.php">Ajouter une console</a></td>
      <td><a href="ajout_jeux.php">Ajouter un jeu</a></td>
    </tr>
  </table>
  <hr>
  
  <div id="1" class="div">
    <ul>
      <li>Super Mario 64</li>
      <li>1080° Snowboarding</li>
      <li>Mario Kart 64</li>
      <li>Perfect Dark</li>
      <li>Donkey Kong 64</li>
      <li>Mario Golf</li>
      <li>GoldenEye</li>
      <li>F-Zero X</li>
      <li>Diddy Kong Racing</li>
      <li>Wave Race</li>
    </ul>
  </div>
  <div id="3ds" class="div">
    <ul>
      <li>Zelda Ocarina of Time</li>
      <li>Zelda Majora's Mask</li>
      <li>Luigi's Mansion 2</li>
      <li>Resident Evil Revelation</li>
    </ul>
  </div>
  <div id="2" class="div">
    <ul>
      <?php
        $result = $oJeux->getList();
          
        foreach ($result as $row) {
             
           echo "<li>".$row["nom_jeux"]."</li>";
        }     
                            
      ?>      
    </ul>
  </div>
  <div id="xbox360" class="div">
    <ul>
      <li><a href="#RE5">Resident Evil 5</a></li>
      <li><a href="#RE6">Resident Evil 6</a></li>
    </ul>
  </div>
  <div id="RE5" class="div2">blablabla</div>
  <div id="RE6" class="div2">Resident Evil 6</div>
  <script>  
    /*
    $(".div").each(function(){ 
      $(this).css({"display":"none"});
    }); 
    */
    
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
         
    $("select").change(function(){
      $(".div").each(function(){ 
        if ($(this).attr("id") === $("select").val()){
           $(this).fadeIn();
        } else {
          $(this).fadeOut();
        }
      });
    });
    
    $("a").click(function (){
      masquerDiv2();
      var val = $(this).attr("href");
      $(val).fadeIn();
      $(val).dialog({modal: true});  
      controlerDiv2(val);  
    });
    
  </script>
  </body>
</html>