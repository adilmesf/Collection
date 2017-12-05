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