<?php

namespace App\Http\Controllers;

use App\Models\Embrio;
use App\Models\Measurement;
use App\Models\Mother;
use App\Services\FundusChartService;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class PatientController extends Controller
{
    public function index(Request $request)
    {
        $motherList = Mother::orderBy('mother_name')->get(['mother_id', 'mother_name']);
        $motherId = $request->integer('mother_id');

        if (! $motherId && $request->filled('mother_name')) {
            $motherId = Mother::where('mother_name', $request->string('mother_name'))->value('mother_id');
        }

        $mother = $motherId
            ? Mother::with(['embrio.measurements'])->find($motherId)
            : null;

        $embrio = $mother?->embrio;
        $measurements = $embrio?->measurements ?? collect();

        $tow = ($mother && $embrio) ? $this->calculateTow($mother, $embrio) : null;

        return view('layouts.pengukuran', [
            'motherList' => $motherList,
            'mother' => $mother,
            'embrio' => $embrio,
            'measurements' => $measurements,
            'tow' => $tow,
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'mother_name' => 'required|string|max:120',
            'mother_address' => 'nullable|string',
            'mother_edd' => 'nullable|date',
            'mother_etnis' => 'required|integer|min:0',
            'mother_parity' => 'required|integer|min:0',
            'mother_height' => 'required|numeric|min:0',
            'mother_weight' => 'required|numeric|min:0',
            'kelamin' => 'required|integer',
        ]);

        $mother = Mother::create([
            'mother_name' => $data['mother_name'],
            'mother_address' => $data['mother_address'] ?? null,
            'mother_etnis' => $data['mother_etnis'],
            'mother_parity' => $data['mother_parity'],
            'mother_weight' => $data['mother_weight'],
            'mother_height' => $data['mother_height'],
        ]);

        Embrio::create([
            'embrio_mother_id' => $mother->mother_id,
            'embrio_edd' => $data['mother_edd'] ?? null,
            'embrio_sex' => $data['kelamin'],
        ]);

        return redirect()
            ->route('pengukuran', ['mother_id' => $mother->mother_id])
            ->with('status', 'Pasien baru berhasil ditambahkan.');
    }

    public function update(Request $request, Mother $mother)
    {
        $data = $request->validate([
            'mother_name' => 'required|string|max:120',
            'mother_address' => 'nullable|string',
            'mother_edd' => 'nullable|date',
            'mother_etnis' => 'required|integer|min:0',
            'mother_parity' => 'required|integer|min:0',
            'mother_height' => 'required|numeric|min:0',
            'mother_weight' => 'required|numeric|min:0',
            'kelamin' => 'required|integer',
        ]);

        $mother->update([
            'mother_name' => $data['mother_name'],
            'mother_address' => $data['mother_address'] ?? null,
            'mother_etnis' => $data['mother_etnis'],
            'mother_parity' => $data['mother_parity'],
            'mother_weight' => $data['mother_weight'],
            'mother_height' => $data['mother_height'],
        ]);

        $embrio = $mother->embrio ?? new Embrio(['embrio_mother_id' => $mother->mother_id]);
        $embrio->fill([
            'embrio_edd' => $data['mother_edd'] ?? null,
            'embrio_sex' => $data['kelamin'],
        ]);
        $embrio->save();

        return redirect()
            ->route('pengukuran', ['mother_id' => $mother->mother_id])
            ->with('status', 'Data pasien diperbarui.');
    }

    public function destroy(Mother $mother)
    {
        $name = $mother->mother_name;
        $mother->delete();

        return redirect()
            ->route('pengukuran')
            ->with('status', "Data pasien {$name} telah dihapus.");
    }

    public function storeMeasurement(Request $request, Mother $mother)
    {
        $data = $request->validate([
            'measurement_date' => 'required|date',
            'measurement_height' => 'required|numeric|min:0',
        ]);

        $embrio = $mother->embrio ?? Embrio::create([
            'embrio_mother_id' => $mother->mother_id,
            'embrio_sex' => -1,
        ]);

        $measurement = Measurement::firstOrNew([
            'measurement_embrio_id' => $embrio->embrio_id,
            'measurement_date' => $data['measurement_date'],
        ]);

        $measurement->measurement_height = $data['measurement_height'];
        $measurement->save();

        return redirect()
            ->route('pengukuran', ['mother_id' => $mother->mother_id])
            ->with('status', 'Data pengukuran tersimpan.');
    }

    public function searchNames(Request $request)
    {
        $term = $request->query('term', '');
        $names = Mother::query()
            ->when($term, fn ($q) => $q->where('mother_name', 'like', '%'.$term.'%'))
            ->orderBy('mother_name')
            ->limit(10)
            ->pluck('mother_name');

        return response()->json($names);
    }

    public function chart(Mother $mother, FundusChartService $chartService)
    {
        $embrio = $mother->embrio;

        if (! $embrio) {
            abort(404, 'Data embrio belum tersedia.');
        }

        $tow = $this->calculateTow($mother, $embrio);

        return $chartService->render(
            tow: $tow,
            std: 10,
            edd: optional($embrio->embrio_edd)->format('Y-m-d'),
            measurements: $embrio->measurements
        );
    }

    private function calculateTow(Mother $mother, Embrio $embrio): float
    {
        $const = 3455.6;
        $tinggiPopulasi = 163;
        $beratPopulasi = 64;

        $etnis = $this->etnisAdjustment($mother->mother_etnis);
        $par = $this->parityAdjustment($mother->mother_parity);
        $kelamin = $this->sexAdjustment($embrio->embrio_sex);

        return $const
            + ($mother->mother_height - $tinggiPopulasi) * 6.7
            + ($mother->mother_weight - $beratPopulasi) * 9.173
            + $etnis + $par + $kelamin;
    }

    private function etnisAdjustment(int $code): float
    {
        return match ($code) {
            0 => -206.4, // Indian
            1 => -156.8, // Pakistani
            2 => -125.7, // Bangladeshi
            3 => -166.0, // African Caribbean
            4 => -63.7,  // African (sub Sahara)
            5 => -90.0,  // Middle East
            6 => 64.0,   // Far East Asian
            7 => 71.5,   // South East Asia
            default => -60.0,
        };
    }

    private function parityAdjustment(int $parity): float
    {
        return match ($parity) {
            1 => 111.0,
            2 => 154.8,
            default => $parity >= 3 ? 151.3 : 0.0,
        };
    }

    private function sexAdjustment(int $sex): float
    {
        return match ($sex) {
            0 => -48.9,
            1 => 48.9,
            default => 0.0,
        };
    }
}
