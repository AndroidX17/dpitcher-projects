<?php if (isset($error)): ?>
    <p>
      <?php echo $error; ?>
    </p>



    <?php

session_start();


?>


    <?php else: ?>
    <?php foreach ($guildevents as $guildevent): ?>
    <blockquote style="display: table; width: 44%; margin-bottom: 1em; border-bottom: 1px solid #ccc; padding: 0.5em;">

      <p style="display: table-cell; width: 90%; vertical-align: top;">
      <?php
    //  echo "<p>";
    
    echo "<BR> - Event name: ";

      echo htmlspecialchars($guildevent['eventname'], ENT_QUOTES, 'UTF-8');
      echo "<BR> - Maxplayers: ";
     echo htmlspecialchars($guildevent['maxplayers'], ENT_QUOTES, 'UTF-8');
     echo "<BR> - Date: ";
     
    echo htmlspecialchars($guildevent['date'], ENT_QUOTES, 'UTF-8');





echo "<BR> - player1: ";
echo htmlspecialchars($guildevent['player1'], ENT_QUOTES, 'UTF-8');
echo "<BR> - player2: ";
echo htmlspecialchars($guildevent['player2'], ENT_QUOTES, 'UTF-8');
echo "<BR> - player3: ";
echo htmlspecialchars($guildevent['player3'], ENT_QUOTES, 'UTF-8');
echo "<BR> - player4: ";
echo htmlspecialchars($guildevent['player4'], ENT_QUOTES, 'UTF-8');
echo "<BR> - player5: ";
echo htmlspecialchars($guildevent['player5'], ENT_QUOTES, 'UTF-8');
  


    echo '<form action="/includes/changeguildeventdate.inc.php" method="post">';
    echo '<input type="hidden" name="eventname" value="'. $guildevent['eventname'] . '">';
    echo "<input step='any' type='datetime-local' name='eventdate' value='".date('Y-m-d H:i:s')."'>";


    echo '<input type="submit"class="bugga3" value="change date">';
    echo '  </form>&nbsp;';
      ?>




      

    
    







      </p>
    </blockquote>
    <?php endforeach; ?>
    <?php endif; ?>
    
    <?php echo $output2; ?>