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