
<?php

DEFINE('DB_USER', 'root');
DEFINE('DB_PASSWORD', NULL);
DEFINE('DB_HOST', '127.0.0.1');
DEFINE('DB_NAME', 'Vladuvja_EmberAlpha');

$dbconnection = @mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);

?>
