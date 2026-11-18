<?php
define('DB_HOST', 'db');
define('DB_USER', 'db');
define('DB_PASS', 'db');
define('DB_NAME', 'db');

global $con;
$con = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if (!$con) {
    die('Could not connect: ' . mysqli_connect_error());
}
