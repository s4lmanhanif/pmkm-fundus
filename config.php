<?php
// Database configuration used across the app.
$DB_HOST = 'localhost';
$DB_USER = 'root';
$DB_PASS = '';          // <-- set your MySQL password here (empty for default XAMPP)
$DB_NAME = 'gestation';

$con = mysqli_connect($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
if (!$con) {
    die('Cannot connect to database: ' . mysqli_connect_error());
}
mysqli_set_charset($con, 'utf8');
?>
