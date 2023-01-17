<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
 
    <title>  <?php echo $title; ?></title>
  </head>
  <body>

  <header>
    <h1>FORM RESULTS</h1>
  </header>
  <nav>
    <ul>
      <li><a href="https://www.onelayerpancake.com">Home</a></li>
      <li><a href="https://www.onelayerpancake.com/database.php">Database test</a></li>
    </ul>
  </nav>

  <main>
  <?php echo $output; ?>
  <BR> 
  So here are the form results:
    <BR>

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


  <?php echo $output2; ?>
  </main>

  <footer>
  &copy; OneLayerPancake 2022
  </footer>
  </body>
</html>