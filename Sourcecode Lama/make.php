<?php 
// Get parameters with safe defaults
$const = isset($_GET['const']) && floatval($_GET['const']) > 0 ? floatval($_GET['const']) : 3455.6;
$std = isset($_GET['std']) && floatval($_GET['std']) > 0 ? floatval($_GET['std']) : 10;
$tow = isset($_GET['tow']) && floatval($_GET['tow']) > 0 ? floatval($_GET['tow']) : 3500;
$edd = isset($_GET['edd']) ? $_GET['edd'] : '';

// Get measurement data
$tinggiArr = isset($_GET['tinggi']) ? @unserialize(urldecode($_GET['tinggi'])) : array();
$realDateArr = isset($_GET['realdate']) ? @unserialize(urldecode($_GET['realdate'])) : array();

if (!is_array($tinggiArr)) $tinggiArr = array();
if (!is_array($realDateArr)) $realDateArr = array();

include("pChart/class/pDraw.class.php");  
include("pChart/class/pImage.class.php");  
include("pChart/class/pData.class.php"); 

// Fungsi proporsi berat janin berdasarkan usia kehamilan (dalam persentase TOW)
function proporsi($ga)
{
	return 299.1 - 31.85 * $ga + 1.094*$ga*$ga - 0.01055*$ga*$ga*$ga;
}

// Fungsi konversi berat janin ke tinggi fundus (cm)
// Berdasarkan formula: FH = (EFW + 5012) / 226 atau sekitar FH ≈ GA (minggu)
function beratToFundus($berat)
{
	return ($berat + 5012) / 226;
}

// Fungsi menghitung usia kehamilan dari tanggal pengukuran dan EDD
function hitungGA($tanggalPengukuran, $edd)
{
	if (empty($edd) || empty($tanggalPengukuran)) return 0;
	
	$eddDate = strtotime($edd);
	$measureDate = strtotime($tanggalPengukuran);
	
	if (!$eddDate || !$measureDate) return 0;
	
	// GA = 40 - (EDD - tanggal_pengukuran) / 7
	$daysToEDD = ($eddDate - $measureDate) / 86400;
	$ga = 40 - ($daysToEDD / 7);
	
	return round($ga, 1);
}

// Perhitungan koefisien variasi
$cv = ($const > 0) ? ($std * 100 / $const) : 0;

$MyData = new pData();  
$index = 0;
$down = array();
$curva_tow = array();
$curva_tow90 = array();
$curva_tow10 = array();
$curva_fh50 = array();
$curva_fh90 = array();
$curva_fh10 = array();

// Generate kurva untuk GA 24-42 minggu
for ($i = 24; $i <= 42; $i++)
{
	$down[] = $i;
	
	// Perkiraan berat janin (gram)
	$curva_tow[$index] = proporsi($i) * $tow / 100;
	$curva_tow90[$index] = $curva_tow[$index] + ((1.28 * $cv) * $curva_tow[$index] / 100);
	$curva_tow10[$index] = $curva_tow[$index] - ((1.28 * $cv) * $curva_tow[$index] / 100);
	
	// Konversi ke tinggi fundus (cm) - untuk axis kiri
	$curva_fh50[$index] = beratToFundus($curva_tow[$index]);
	$curva_fh90[$index] = beratToFundus($curva_tow90[$index]);
	$curva_fh10[$index] = beratToFundus($curva_tow10[$index]);
	
	$index++;
}

// Siapkan data pengukuran aktual
$measurementGA = array();
$measurementFH = array();
$measurementWeight = array();
$outOfRangeData = array();

if (!empty($edd) && count($tinggiArr) > 0) {
	for ($i = 0; $i < count($tinggiArr); $i++) {
		$tanggal = isset($realDateArr[$i]) ? $realDateArr[$i] : '';
		$tinggi = floatval($tinggiArr[$i]);
		
		if (!empty($tanggal) && $tinggi > 0) {
			$ga = hitungGA($tanggal, $edd);
			// Simpan semua data, tapi hanya plot yang dalam range
			if ($ga >= 24 && $ga <= 42) {
				$measurementGA[] = $ga;
				$measurementFH[] = $tinggi;
				$measurementWeight[] = ($tinggi * 226) - 5012;
			} else {
				$outOfRangeData[] = array('ga' => $ga, 'fh' => $tinggi, 'date' => $tanggal);
			}
		}
	}
}

/* Prepare data series */
$MyData->addPoints($curva_fh50, "Persentil 50");
$MyData->addPoints($curva_fh10, "Persentil 10");
$MyData->addPoints($curva_fh90, "Persentil 90");

// Set warna untuk kurva
$MyData->setPalette("Persentil 50", array("R" => 0, "G" => 100, "B" => 200, "Alpha" => 100));
$MyData->setPalette("Persentil 10", array("R" => 200, "G" => 100, "B" => 0, "Alpha" => 100));
$MyData->setPalette("Persentil 90", array("R" => 200, "G" => 100, "B" => 0, "Alpha" => 100));

/* Bind a data serie to the X axis */
$MyData->addPoints($down, "Labels");
$MyData->setSerieDescription("Labels", "Usia Kehamilan (minggu)");
$MyData->setAbscissa("Labels");

$MyData->setAxisName(0, "Tinggi Fundus (cm)");
 
/* Create a pChart object and associate your dataset */  
$myPicture = new pImage(750, 550, $MyData); 
$myPicture->setFontProperties(array("FontName" => "pChart/fonts/Forgotte.ttf", "FontSize" => 11));

// Background gradient
$myPicture->drawFilledRectangle(0, 0, 750, 550, array("R" => 240, "G" => 245, "B" => 250));
 
/* Define the graph area */
$myPicture->setGraphArea(70, 70, 700, 500);
$myPicture->drawFilledRectangle(70, 70, 700, 500, array("R" => 255, "G" => 255, "B" => 255, "Surrounding" => -200, "Alpha" => 100));

/* Draw title */
$myPicture->setFontProperties(array("FontName" => "pChart/fonts/Forgotte.ttf", "FontSize" => 16));
$myPicture->drawText(385, 35, "Grafik Pertumbuhan Janin - Customized Growth Chart", array("FontSize" => 16, "Align" => TEXT_ALIGN_BOTTOMMIDDLE, "R" => 30, "G" => 60, "B" => 120));

$myPicture->setFontProperties(array("FontName" => "pChart/fonts/Forgotte.ttf", "FontSize" => 10));
$myPicture->drawText(385, 52, "TOW: " . round($tow) . " gram | EDD: " . $edd, array("FontSize" => 10, "Align" => TEXT_ALIGN_BOTTOMMIDDLE, "R" => 100, "G" => 100, "B" => 100));

// Warning jika ada data di luar range
if (count($outOfRangeData) > 0) {
	$myPicture->setFontProperties(array("FontName" => "pChart/fonts/Forgotte.ttf", "FontSize" => 9));
	$warningText = count($outOfRangeData) . " pengukuran di luar rentang grafik (GA 24-42 minggu)";
	$myPicture->drawText(385, 65, $warningText, array("FontSize" => 9, "Align" => TEXT_ALIGN_BOTTOMMIDDLE, "R" => 200, "G" => 100, "B" => 0));
}

/* Compute and draw the scale */
$AxisBoundaries = array(0 => array("Min" => 15, "Max" => 45));

$myPicture->setFontProperties(array("FontName" => "pChart/fonts/Forgotte.ttf", "FontSize" => 10));
$myPicture->drawScale(array(
	"CycleBackground" => TRUE, 
	"GridTicks" => 2, 
	"DrawSubTicks" => TRUE, 
	"DrawArrows" => TRUE, 
	"ArrowSize" => 6, 
	"Mode" => SCALE_MODE_MANUAL, 
	"ManualScale" => $AxisBoundaries,
	"XMargin" => 10,
	"YMargin" => 10,
	"GridR" => 200,
	"GridG" => 200,
	"GridB" => 200,
	"GridAlpha" => 50
));

/* Draw the spline chart for growth curves */
$myPicture->drawSplineChart(array("DisplayValues" => FALSE));

/* Draw measurement points */
if (count($measurementGA) > 0) {
	$myPicture->setFontProperties(array("FontName" => "pChart/fonts/Forgotte.ttf", "FontSize" => 9));
	
	// Get graph coordinates
	$graphAreaX1 = 70;
	$graphAreaY1 = 70;
	$graphAreaX2 = 700;
	$graphAreaY2 = 500;
	
	$xMin = 24;
	$xMax = 42;
	$yMin = 15;
	$yMax = 45;
	
	$xScale = ($graphAreaX2 - $graphAreaX1) / ($xMax - $xMin);
	$yScale = ($graphAreaY2 - $graphAreaY1) / ($yMax - $yMin);
	
	for ($i = 0; $i < count($measurementGA); $i++) {
		$ga = $measurementGA[$i];
		$fh = $measurementFH[$i];
		
		// Calculate pixel position
		$x = $graphAreaX1 + ($ga - $xMin) * $xScale;
		$y = $graphAreaY2 - ($fh - $yMin) * $yScale;
		
		// Draw measurement point (red filled circle)
		$myPicture->drawFilledCircle($x, $y, 6, array("R" => 220, "G" => 50, "B" => 50, "Alpha" => 100));
		$myPicture->drawCircle($x, $y, 6, 6, array("R" => 150, "G" => 0, "B" => 0, "Alpha" => 100));
		
		// Label the point
		$label = round($fh, 1) . " cm";
		$myPicture->drawText($x, $y - 12, $label, array(
			"FontSize" => 8, 
			"Align" => TEXT_ALIGN_BOTTOMMIDDLE, 
			"R" => 150, "G" => 0, "B" => 0
		));
	}
	
	// Connect measurement points with line if more than 1
	if (count($measurementGA) > 1) {
		for ($i = 0; $i < count($measurementGA) - 1; $i++) {
			$x1 = $graphAreaX1 + ($measurementGA[$i] - $xMin) * $xScale;
			$y1 = $graphAreaY2 - ($measurementFH[$i] - $yMin) * $yScale;
			$x2 = $graphAreaX1 + ($measurementGA[$i + 1] - $xMin) * $xScale;
			$y2 = $graphAreaY2 - ($measurementFH[$i + 1] - $yMin) * $yScale;
			
			$myPicture->drawLine($x1, $y1, $x2, $y2, array("R" => 220, "G" => 50, "B" => 50, "Alpha" => 80, "Weight" => 2));
		}
	}
}

/* Draw legend */
$myPicture->setFontProperties(array("FontName" => "pChart/fonts/Forgotte.ttf", "FontSize" => 9));

// Legend box
$myPicture->drawFilledRectangle(75, 505, 280, 545, array("R" => 255, "G" => 255, "B" => 255, "Alpha" => 80, "BorderR" => 200, "BorderG" => 200, "BorderB" => 200));

// Legend items
$myPicture->drawFilledCircle(90, 517, 4, array("R" => 0, "G" => 100, "B" => 200));
$myPicture->drawText(100, 520, "Persentil 50 (median)", array("R" => 50, "G" => 50, "B" => 50));

$myPicture->drawFilledCircle(90, 532, 4, array("R" => 200, "G" => 100, "B" => 0));
$myPicture->drawText(100, 535, "Persentil 10 & 90", array("R" => 50, "G" => 50, "B" => 50));

$myPicture->drawFilledCircle(210, 517, 5, array("R" => 220, "G" => 50, "B" => 50));
$myPicture->drawText(220, 520, "Data Aktual", array("R" => 150, "G" => 0, "B" => 0));

// X-axis label
$myPicture->drawText(385, 545, "Usia Kehamilan (minggu)", array("FontSize" => 10, "Align" => TEXT_ALIGN_BOTTOMMIDDLE, "R" => 50, "G" => 50, "B" => 50));

$myPicture->autoOutput("mypic.png");
?>