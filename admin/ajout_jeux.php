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