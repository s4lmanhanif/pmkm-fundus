<?php
require_once('config.php');

echo processRequest($con);

function processRequest($con) {
    if (!isset($_GET['tinggi'], $_GET['tanggal'], $_GET['motherID'])) {
        return 'error';
    }

    $height = floatval($_GET['tinggi']);
    $date = mysqli_real_escape_string($con, $_GET['tanggal']);
    $motherID = intval($_GET['motherID']);

    $embrioID = findEmbrioId($con, $motherID);
    if ($embrioID === null) {
        return 'error';
    }

    // If measurement for this date already exists, update height and tell caller to refresh row.
    $existing = mysqli_query($con, "SELECT measurement_id FROM measurement WHERE measurement_embrio_id='$embrioID' AND measurement_date='$date' LIMIT 1");
    if (mysqli_num_rows($existing) > 0) {
        mysqli_query($con, "UPDATE measurement SET measurement_height='$height' WHERE measurement_embrio_id='$embrioID' AND measurement_date='$date'");
        return 'xxx';
    }

    mysqli_query($con, "INSERT INTO measurement(measurement_embrio_id, measurement_date, measurement_height) VALUES('$embrioID', '$date', '$height')");

    // Determine display index (order by date asc)
    $countResult = mysqli_query($con, "SELECT COUNT(*) as c FROM measurement WHERE measurement_embrio_id='$embrioID'");
    $countRow = mysqli_fetch_assoc($countResult);
    $idx = isset($countRow['c']) ? intval($countRow['c']) : 1;

    $row = "<tr><td>".$idx."</td><td id='date_".$date."'>".$date."</td><td id='height_".$date."'>".$height."</td></tr>";
    return $row;
}

function findEmbrioId($con, $motherID) {
    $res = mysqli_query($con, "SELECT embrio_id FROM embrio WHERE embrio_mother_id='$motherID' LIMIT 1");
    if ($res && mysqli_num_rows($res) > 0) {
        $row = mysqli_fetch_assoc($res);
        return $row['embrio_id'];
    }
    return null;
}
?>
