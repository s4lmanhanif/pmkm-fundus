<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;

class FundusChartService
{
    public function render(float $tow, float $std, ?string $edd, Collection|array $measurements): Response
    {
        require_once public_path('pChart/class/pDraw.class.php');
        require_once public_path('pChart/class/pImage.class.php');
        require_once public_path('pChart/class/pData.class.php');

        $const = 3455.6;
        $cv = $const > 0 ? ($std * 100 / $const) : 0;

        // Normalize measurement data early for axis and plotting
        $normalized = $this->normalizeMeasurements($measurements, $edd);
        $gaValues = array_column($normalized, 'ga');
        $heightValues = array_column($normalized, 'height');

        $gaStart = empty($gaValues) ? 24 : (int) floor(min($gaValues));
        $gaEnd = empty($gaValues) ? 42 : (int) ceil(max($gaValues));

        $gaStart = max(20, $gaStart); // avoid too-low axis
        $gaEnd = max($gaEnd, $gaStart + 5); // ensure width

        $yMin = empty($heightValues) ? 15 : floor(min($heightValues)) - 1;
        $yMax = empty($heightValues) ? 45 : ceil(max($heightValues)) + 1;
        if ($yMax - $yMin < 10) {
            $yMax = $yMin + 10;
        }

        $myData = new \pData();
        $labels = [];
        $curve50 = [];
        $curve10 = [];
        $curve90 = [];
        $curveFH50 = [];
        $curveFH10 = [];
        $curveFH90 = [];

        for ($ga = $gaStart; $ga <= $gaEnd; $ga++) {
            $labels[] = $ga;
            $weight50 = $this->proporsi($ga) * $tow / 100;
            $weight90 = $weight50 + ((1.28 * $cv) * $weight50 / 100);
            $weight10 = $weight50 - ((1.28 * $cv) * $weight50 / 100);

            $curve50[] = $weight50;
            $curve90[] = $weight90;
            $curve10[] = $weight10;

            $curveFH50[] = $this->beratToFundus($weight50);
            $curveFH90[] = $this->beratToFundus($weight90);
            $curveFH10[] = $this->beratToFundus($weight10);
        }

        $myData->addPoints($curveFH50, 'Persentil 50');
        $myData->addPoints($curveFH10, 'Persentil 10');
        $myData->addPoints($curveFH90, 'Persentil 90');
        $myData->setPalette('Persentil 50', ['R' => 0, 'G' => 100, 'B' => 200, 'Alpha' => 100]);
        $myData->setPalette('Persentil 10', ['R' => 200, 'G' => 100, 'B' => 0, 'Alpha' => 100]);
        $myData->setPalette('Persentil 90', ['R' => 200, 'G' => 100, 'B' => 0, 'Alpha' => 100]);

        $myData->addPoints($labels, 'Labels');
        $myData->setSerieDescription('Labels', 'Usia Kehamilan (minggu)');
        $myData->setAbscissa('Labels');
        $myData->setAxisName(0, 'Tinggi Fundus (cm)');

        $myPicture = new \pImage(750, 550, $myData);
        $fontPath = public_path('pChart/fonts/Forgotte.ttf');
        $myPicture->setFontProperties(['FontName' => $fontPath, 'FontSize' => 11]);
        $myPicture->drawFilledRectangle(0, 0, 750, 550, ['R' => 240, 'G' => 245, 'B' => 250]);
        $myPicture->setGraphArea(70, 70, 700, 500);
        $myPicture->drawFilledRectangle(70, 70, 700, 500, ['R' => 255, 'G' => 255, 'B' => 255, 'Surrounding' => -200, 'Alpha' => 100]);

        $myPicture->setFontProperties(['FontName' => $fontPath, 'FontSize' => 16]);
        $myPicture->drawText(385, 35, 'Grafik Pertumbuhan Janin - Customized Growth Chart', ['FontSize' => 16, 'Align' => TEXT_ALIGN_BOTTOMMIDDLE, 'R' => 30, 'G' => 60, 'B' => 120]);
        $myPicture->setFontProperties(['FontName' => $fontPath, 'FontSize' => 10]);
        $myPicture->drawText(385, 52, 'TOW: '.round($tow).' gram | EDD: '.$edd, ['FontSize' => 10, 'Align' => TEXT_ALIGN_BOTTOMMIDDLE, 'R' => 100, 'G' => 100, 'B' => 100]);

        $axisBoundaries = [0 => ['Min' => $yMin, 'Max' => $yMax]];
        $myPicture->setFontProperties(['FontName' => $fontPath, 'FontSize' => 10]);
        $myPicture->drawScale([
            'CycleBackground' => true,
            'GridTicks' => 2,
            'DrawSubTicks' => true,
            'DrawArrows' => true,
            'ArrowSize' => 6,
            'Mode' => SCALE_MODE_MANUAL,
            'ManualScale' => $axisBoundaries,
            'XMargin' => 10,
            'YMargin' => 10,
            'GridR' => 200,
            'GridG' => 200,
            'GridB' => 200,
            'GridAlpha' => 50,
        ]);

        $myPicture->drawSplineChart(['DisplayValues' => false]);

        if (count($normalized['out_range']) > 0) {
            $myPicture->setFontProperties(['FontName' => $fontPath, 'FontSize' => 9]);
            $warning = count($normalized['out_range']).' pengukuran di luar rentang grafik (GA 24-42 minggu)';
            $myPicture->drawText(385, 65, $warning, ['FontSize' => 9, 'Align' => TEXT_ALIGN_BOTTOMMIDDLE, 'R' => 200, 'G' => 100, 'B' => 0]);
        }

        $this->plotMeasurements($myPicture, $normalized['in_range'], $gaStart, $gaEnd, $yMin, $yMax);

        $myPicture->setFontProperties(['FontName' => $fontPath, 'FontSize' => 9]);
        $myPicture->drawFilledRectangle(75, 505, 280, 545, ['R' => 255, 'G' => 255, 'B' => 255, 'Alpha' => 80, 'BorderR' => 200, 'BorderG' => 200, 'BorderB' => 200]);
        $myPicture->drawFilledCircle(90, 517, 4, ['R' => 0, 'G' => 100, 'B' => 200]);
        $myPicture->drawText(100, 520, 'Persentil 50 (median)', ['R' => 50, 'G' => 50, 'B' => 50]);
        $myPicture->drawFilledCircle(90, 532, 4, ['R' => 200, 'G' => 100, 'B' => 0]);
        $myPicture->drawText(100, 535, 'Persentil 10 & 90', ['R' => 50, 'G' => 50, 'B' => 50]);
        $myPicture->drawFilledCircle(210, 517, 5, ['R' => 220, 'G' => 50, 'B' => 50]);
        $myPicture->drawText(220, 520, 'Data Aktual', ['R' => 150, 'G' => 0, 'B' => 0]);
        $myPicture->drawText(385, 545, 'Usia Kehamilan (minggu)', ['FontSize' => 10, 'Align' => TEXT_ALIGN_BOTTOMMIDDLE, 'R' => 50, 'G' => 50, 'B' => 50]);

        $tempFile = tempnam(sys_get_temp_dir(), 'growth_').'.png';
        $myPicture->render($tempFile);
        $binary = file_get_contents($tempFile);
        @unlink($tempFile);

        return response($binary)->header('Content-Type', 'image/png');
    }

    private function proporsi(float $ga): float
    {
        return 299.1 - 31.85 * $ga + 1.094 * $ga * $ga - 0.01055 * $ga * $ga * $ga;
    }

    private function beratToFundus(float $berat): float
    {
        return ($berat + 5012) / 226;
    }

    private function calculateGA(string $measureDate, string $edd): float
    {
        $eddDate = Carbon::parse($edd);
        $date = Carbon::parse($measureDate);

        $daysToEDD = $eddDate->diffInDays($date, false);

        return round(40 - ($daysToEDD / 7), 1);
    }

    /**
     * Normalize, sort, and split measurements into in-range and out-of-range buckets (GA 24-42).
     */
    private function normalizeMeasurements(Collection|array $measurements, ?string $edd): array
    {
        if (! $edd) {
            return ['in_range' => [], 'out_range' => []];
        }

        // Ensure chronological order to connect lines properly
        $sorted = collect($measurements)
            ->sortBy(fn ($m) => $m->measurement_date ?? now())
            ->values();

        $inRange = [];
        $outRange = [];

        foreach ($sorted as $measurement) {
            $ga = $this->calculateGA((string) $measurement->measurement_date, $edd);
            $height = (float) $measurement->measurement_height;

            if ($ga >= 24 && $ga <= 42 && $height > 0) {
                $inRange[] = ['ga' => $ga, 'height' => $height];
            } else {
                $outRange[] = ['ga' => $ga, 'height' => $height];
            }
        }

        return ['in_range' => $inRange, 'out_range' => $outRange];
    }

    private function plotMeasurements(\pImage $picture, array $measurements, int $xMin, int $xMax, float $yMin, float $yMax): void
    {
        if (empty($measurements)) {
            return;
        }

        $picture->setFontProperties(['FontName' => public_path('pChart/fonts/Forgotte.ttf'), 'FontSize' => 9]);

        $graphAreaX1 = 70;
        $graphAreaY1 = 70;
        $graphAreaX2 = 700;
        $graphAreaY2 = 500;

        $xScale = ($graphAreaX2 - $graphAreaX1) / ($xMax - $xMin);
        $yScale = ($graphAreaY2 - $graphAreaY1) / ($yMax - $yMin);

        foreach ($measurements as $point) {
            $x = $graphAreaX1 + ($point['ga'] - $xMin) * $xScale;
            $y = $graphAreaY2 - ($point['height'] - $yMin) * $yScale;

            $picture->drawFilledCircle($x, $y, 6, ['R' => 220, 'G' => 50, 'B' => 50, 'Alpha' => 100]);
            $picture->drawCircle($x, $y, 6, 6, ['R' => 150, 'G' => 0, 'B' => 0, 'Alpha' => 100]);
            $picture->drawText($x, $y - 12, round($point['height'], 1).' cm', [
                'FontSize' => 8,
                'Align' => TEXT_ALIGN_BOTTOMMIDDLE,
                'R' => 150,
                'G' => 0,
                'B' => 0,
            ]);
        }

        if (count($measurements) > 1) {
            for ($i = 0; $i < count($measurements) - 1; $i++) {
                $x1 = $graphAreaX1 + ($measurements[$i]['ga'] - $xMin) * $xScale;
                $y1 = $graphAreaY2 - ($measurements[$i]['height'] - $yMin) * $yScale;
                $x2 = $graphAreaX1 + ($measurements[$i + 1]['ga'] - $xMin) * $xScale;
                $y2 = $graphAreaY2 - ($measurements[$i + 1]['height'] - $yMin) * $yScale;

                $picture->drawLine($x1, $y1, $x2, $y2, ['R' => 220, 'G' => 50, 'B' => 50, 'Alpha' => 80, 'Weight' => 2]);
            }
        }
    }
}
