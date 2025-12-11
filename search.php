<?php
require_once('config.php');

header('Content-Type: application/json');
$term = isset($_GET['term']) ? trim($_GET['term']) : '';
$out = array();
if ($term !== '') {
    $safe = mysqli_real_escape_string($con, $term);
    $result = mysqli_query($con, "SELECT mother_name FROM mother WHERE mother_name LIKE '%$safe%' ORDER BY mother_name LIMIT 10");
    while ($row = mysqli_fetch_assoc($result)) {
        $out[] = $row['mother_name'];
    }
}
echo json_encode($out);
?>
