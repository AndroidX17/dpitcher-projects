<?php
require_once '../keys/storage.php';
$title = 'OneLayerPancake';

ob_start();

include  __DIR__ . '/templates/checkboxes.html.php';

$output = ob_get_clean();

include  __DIR__ . '/templates/layout.html.php';

?>

