<?php if (isset($error)): ?>
    <p>
      <?php echo $error; ?>
    </p>



  
    <?php else: ?>
    <?php foreach ($concepts as $concept): ?>
    <blockquote style="display: table; margin-bottom: 1em; border-bottom: 1px solid #ccc; padding: 0.5em;">
      <p style="display: table-cell; width: 90%; vertical-align: top;">
      <?php echo htmlspecialchars($concept['concept'], ENT_QUOTES, 'UTF-8') ?>

      </p>
    </blockquote>
    <?php endforeach; ?>
    <?php endif; ?>
    
    <?php echo $output2; ?>