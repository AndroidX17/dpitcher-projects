<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Script Output</title>
  </head>
  <body>

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

  <?=$output2?>
<BR>
      <?php echo $output; echo $output2; ?>
  </body>
</html>