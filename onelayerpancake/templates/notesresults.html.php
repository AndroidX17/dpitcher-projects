<?php if (isset($error)): ?>
    <p>
      <?php echo $error; ?>
    </p>



    <?php

session_start();


?>


    <?php else: ?>
    <?php foreach ($wallets as $wallet): ?>
    <blockquote style="display: table; width: 44%; margin-bottom: 1em; border-bottom: 1px solid #ccc; padding: 0.5em;">

      <p style="display: table-cell; width: 90%; vertical-align: top;">
      <?php
    //  echo "<p>";
      echo htmlspecialchars($wallet['wallet'], ENT_QUOTES, 'UTF-8');
       echo "<BR> - ";
      echo htmlspecialchars($wallet['note'], ENT_QUOTES, 'UTF-8');
      
  
        echo '<form style="display: table-cell; width: 10%;" action="bitcoin2.php" method="post">';
        echo '<input type="hidden" name="cryptowallet" value="'. $wallet['wallet'] . '">';
        echo '<input type="hidden" name="postoffset" value="1">';
        echo '<input type="hidden" name="lasthash" value="">';
        echo '<input type="hidden" name="lastpage" value="1">';
        echo '<input type="hidden" name="currentpage" value="1">';
        echo '<input type="hidden" name="usehash" value="0">';
        echo '<input type="submit"class="bugga3" value="search">';
        echo '  </form>&nbsp;';
        
       
     // echo "</p>";
      if ($_SESSION["permissions"] === "SPECIAL") {

      /*
echo '<form style="display: table-cell; width: 10%;" action="deletewallet.php" method="post">';
echo '<input type="hidden" name="id" value="'. $wallet['id'] . '">';
echo '<input type="submit" value="Delete">';
echo '  </form>';*/

echo  '<form style="display: table-cell; width: 10%;" action="deletewallet.php" method="post">';
echo '  <input type="hidden"  name="id" value="'. $wallet['id'] . '">';
echo '  <input type="submit" class="bugga5" value="Delete" onclick="return confirm(\'Do you want to submit? Yes/No\')">';
echo '</form>';

      }
      
      ?>




      

    
    







      </p>
    </blockquote>
    <?php endforeach; ?>
    <?php endif; ?>
    
    <?php echo $output2; ?>