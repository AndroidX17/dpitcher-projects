

</section>


<?php

include_once 'footer.php';

?><?php

$title = 'OneLayerPancake';

ob_start();

include  __DIR__ . '/templates/signup.html.php';

$output = ob_get_clean();

include  __DIR__ . '/templates/layout.html.php';

?>

