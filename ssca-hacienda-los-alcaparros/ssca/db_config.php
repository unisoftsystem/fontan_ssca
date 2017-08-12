<?php

/*
 * All database connection variables
 */
$_uri = explode('/', $_SERVER['REQUEST_URI']);
define('DB_USER', "root"); // db user
define('DB_PASSWORD', "usc"); // db password (mention your db password here)
define('DB_DATABASE', $_uri[1]); // database name
//define('DB_DATABASE', "ssca-hacienda-los-alcaparros"); // database name
define('DB_SERVER', "localhost"); // db server
?>