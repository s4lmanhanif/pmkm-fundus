<?php
require 'config.php';

// Update EDD untuk ahmad agar valid (sekitar 13 minggu ke depan = GA ~27 minggu sekarang)
mysqli_query($con, "UPDATE embrio SET embrio_edd='2026-03-15' WHERE embrio_mother_id=1");
echo "Updated EDD to 2026-03-15\n";

// Juga update tanggal pengukuran agar sesuai
mysqli_query($con, "DELETE FROM measurement WHERE measurement_embrio_id=1");
// Embrio ID
$embrio_result = mysqli_query($con, "SELECT embrio_id FROM embrio WHERE embrio_mother_id=1");
$embrio_row = mysqli_fetch_assoc($embrio_result);
$embrio_id = $embrio_row['embrio_id'];

// Insert pengukuran yang valid (GA 27 dan 28 minggu)
mysqli_query($con, "INSERT INTO measurement (measurement_embrio_id, measurement_date, measurement_height) VALUES ($embrio_id, '2025-12-11', 27)");
mysqli_query($con, "INSERT INTO measurement (measurement_embrio_id, measurement_date, measurement_height) VALUES ($embrio_id, '2025-12-18', 28)");
echo "Added measurements for GA ~27 and ~28 weeks\n";

// Verify
$r = mysqli_query($con, "SELECT m.*, e.embrio_edd FROM mother m LEFT JOIN embrio e ON m.mother_id = e.embrio_mother_id WHERE m.mother_name LIKE '%ahmad%'");
echo "\nAhmad's updated data:\n";
while($row = mysqli_fetch_assoc($r)) {
    print_r($row);
}

$r2 = mysqli_query($con, "SELECT * FROM measurement WHERE measurement_embrio_id=$embrio_id");
echo "\nMeasurements:\n";
while($row = mysqli_fetch_assoc($r2)) {
    print_r($row);
}
?>
