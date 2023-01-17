<?php

$title = 'OneLayerPancake';

ob_start();

include  __DIR__ . '/templates/login.html.php';

$output = ob_get_clean();

include  __DIR__ . '/templates/layout.html.php';

?>

