<?php if (isset($error)): ?>
  <p>
    <?php echo $error; ?>
  </p>


  <?php else: ?>
  <?php foreach ($names as $name): ?>
  <blockquote>
    <p>
    <?php echo htmlspecialchars($name, ENT_QUOTES, 'UTF-8') ?>
    </p>
  </blockquote>
  <?php endforeach; ?>
  <?php endif; ?>
  