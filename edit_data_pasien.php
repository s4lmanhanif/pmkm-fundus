<?php
require_once('config.php');

$motherID = isset($_GET['mother_id']) ? intval($_GET['mother_id']) : 0;
$embrioID = isset($_GET['embrio_id']) ? intval($_GET['embrio_id']) : 0;
$motherName = isset($_GET['mother_name']) ? mysqli_real_escape_string($con, $_GET['mother_name']) : '';
$motherAddr = isset($_GET['mother_address']) ? mysqli_real_escape_string($con, $_GET['mother_address']) : '';
$motherWeight = isset($_GET['mother_weight']) ? floatval($_GET['mother_weight']) : 0;
$motherHeight = isset($_GET['mother_height']) ? floatval($_GET['mother_height']) : 0;
$motherEtnis = isset($_GET['mother_etnis']) ? intval($_GET['mother_etnis']) : 0;
$motherPar = isset($_GET['mother_parity']) ? intval($_GET['mother_parity']) : 0;
$motherEDD = isset($_GET['mother_edd']) ? mysqli_real_escape_string($con, $_GET['mother_edd']) : '';
$embrioSex = isset($_GET['kelamin']) ? intval($_GET['kelamin']) : -1;

if ($motherID === 0 || $embrioID === 0) {
    exit('error');
}

$updateMother = "UPDATE mother SET mother_name='$motherName', mother_address='$motherAddr', mother_etnis='$motherEtnis', mother_parity='$motherPar', mother_weight='$motherWeight', mother_height='$motherHeight' WHERE mother_id='$motherID'";
$updateEmbrio = "UPDATE embrio SET embrio_edd='$motherEDD', embrio_sex='$embrioSex' WHERE embrio_id='$embrioID'";

if (mysqli_query($con, $updateMother) && mysqli_query($con, $updateEmbrio)) {
    echo 'oke';
} else {
    echo 'error';
}
?>
