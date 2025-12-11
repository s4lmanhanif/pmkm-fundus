<?php
// Test serialized data format
$measurementHeight = array(27, 28);
$measurementRealDate = array('2025-12-11', '2025-12-18');

$tinggi = urlencode(serialize($measurementHeight));
$realdate = urlencode(serialize($measurementRealDate));

echo "tinggi=$tinggi\n";
echo "realdate=$realdate\n";

// Full URL
$url = "make.php?const=3455.6&edd=2026-03-15&std=10&tow=3600&realdate=$realdate&tinggi=$tinggi";
echo "\nFull URL:\n$url\n";
?>
