<?php if (isset($error)): ?>
    <p>
      <?php echo $error; ?>
    </p>



    <?php

session_start();


?>

  
    <?php else: ?>
      <?php echo "<p>backburner ideas</p>"; ?>

    <?php foreach ($concepts as $concept): ?>


    

    <blockquote style="display: table; margin-bottom: 1em; border-bottom: 1px solid #ccc; padding: 0.5em;">
      <p style="display: table-cell; width: 90%; vertical-align: top;">
      <?php echo htmlspecialchars($concept['concept'], ENT_QUOTES, 'UTF-8');
      
      
      if ($_SESSION["permissions"] === "SPECIAL") {

echo '<form style="display: table-cell; width: 10%;" action="deleteconcept.php" method="post">';
echo '<input type="hidden" name="id" value="'. $concept['id'] . '">';
//echo '<input type="submit" class="bugga5" value="Delete">';

echo '  <input type="submit" class="bugga5" value="Delete" onclick="return confirm(\'Do you want to submit? Yes/No\')">';
echo '  </form>';

      }
      
      ?>




      

    
    







      </p>
    </blockquote>
    <?php endforeach; ?>
    <?php endif; ?>
    
    <?php echo $output2; ?>