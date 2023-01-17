<?php if (isset($error)): ?>
    <p>
      <?php echo $error; ?>
    </p>





    <?php else: ?>


<?php
    
    $num = 0;
    ?>

    <?php foreach ($query as $entry): ?>
    <blockquote style="display: table; margin-bottom: 1em; border-bottom: 1px solid #ccc; padding: 0.5em;">
      <p style="display: table-cell; width: 90%; vertical-align: top;">
      <?php 
      
      
      
      $num=$num+1;
      
      echo "REPORT #".$num;
      
      echo "<BR>";
      echo "<BR>-----------------";
      echo "<BR>";
      echo "<BR>Initial boxes:";
      echo "<BR>";
 
      for ($x=1;$x<=20;$x++) {

      if ($entry['firstbox'.$x] === "0") {
      

      } 
       
        if ($entry['firstbox'.$x] === "1") {
      


            echo "-box ".$x." was checked<BR>";

        }
      
    }
      
      
    echo "<BR>";
    echo "<BR>Secondary boxes";

    echo "<BR>";
    echo "<BR>";


    for ($x=1;$x<=20;$x++) {

        if ($entry['buddybox'.$x] === "0") {
        
  
  
  
        } 
         
          if ($entry['buddybox'.$x] === "1") {
        
  
  
              echo "-buddy box ".$x." was checked<BR>";
  
          }
        
      }







    echo "<BR>";
    echo "<BR>";
    echo "<BR>";
      echo htmlspecialchars($entry['decision'], ENT_QUOTES, 'UTF-8');
      
      




      if ($_SESSION["permissions"] === "SPECIAL") {

echo '<form style="display: table-cell; width: 10%;" action="deletebuddyreport.php" method="post">';
echo '<input type="hidden" name="id" value="'. $entry['id'] . '">';
echo '<input type="submit" value="Delete">';
echo '  </form>';

      }
      
      ?>

      </p>
    </blockquote>
    <?php endforeach; ?>

















    <?php endif; ?>
    