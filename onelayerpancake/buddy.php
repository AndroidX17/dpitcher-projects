<?php
require_once '../keys/storage.php';
$title = 'OneLayerPancake';
session_start();
ob_start();

include  __DIR__ . '/templates/buddy.html.php';

$output = ob_get_clean();

include  __DIR__ . '/templates/layout.html.php';

?>

