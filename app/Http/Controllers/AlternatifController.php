<?php

namespace App\Http\Controllers;

use App\DataTables\AlternatifDataTable;
use App\DataTables\BansosDataTable;
use App\Models\Alternatif;
use App\Models\Keluarga;
use App\Models\Kriteria;
use App\Models\SkorMethodA;
use App\Models\SkorMethodB;
use Illuminate\Http\Request;

class AlternatifController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }
    public function list(AlternatifDataTable $dataTable)
    {
        return $dataTable->render('auth.rw.bansos');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Calculate the resources.
     */
    public function spk()
    {
        $sumBobot = 0;
        $bobots = Kriteria::all()->pluck('bobot_ktr');
        foreach ($bobots as $bobot) {
            $sumBobot += $bobot;
        }

        $normalizedBobot = [];
        foreach ($bobots as $bobot) {
            $normalizedBobot[] = $bobot / $sumBobot;
        };

        $kriterias = Kriteria::all();
        foreach ($kriterias as $index => $kriteria) {
            $kriteria->update(['bobot_ktr' => $normalizedBobot[$index]]);
        }

        $alternatifs = Alternatif::all()->toArray();
        // Menghapus kolom 'nkk' dari setiap item dalam array
        // foreach ($alternatifs as &$alternatif) {
        //     unset($alternatif['nkk']);
        // }
        $normalizedAlternatifs = [];
        $allValues = [];
        $allValues['penghasilan'] = Alternatif::all()->pluck('penghasilan')->toArray();
        $allValues['tanggungan'] = Alternatif::all()->pluck('tanggungan')->toArray();
        $allValues['pajak_bumibangunan'] = Alternatif::all()->pluck('pajak_bumibangunan')->toArray();
        $allValues['pajak_kendaraan'] = Alternatif::all()->pluck('pajak_kendaraan')->toArray();
        $allValues['daya_listrik'] = Alternatif::all()->pluck('daya_listrik')->toArray();
        // dd($alternatifs);
        // Normalisasi setiap atribut
        foreach ($alternatifs as $index => $alternatif) {
            foreach ($alternatif as $key => $value) {
                if (isset($allValues[$key])) {
                    $minValue = min($allValues[$key]);
                    $maxValue = max($allValues[$key]);
                    if ($maxValue - $minValue == 0) {
                        $normalizedAlternatifs[$index][$key] = 0; // atau beberapa nilai default
                    } else {
                        if ($key == 'tanggungan') { // BENEFIT
                            # code...
                            $normalizedAlternatifs[$index][$key] = ($value - $minValue) / ($maxValue - $minValue);
                        } else { // COST
                            $normalizedAlternatifs[$index][$key] = ($maxValue - $value) / ($maxValue - $minValue);
                        }
                    }
                } else {
                    $normalizedAlternatifs[$index][$key] = $value; // Menjaga nilai non-numeric apa adanya
                }
            }
        }

        $finalAlternatifs = $normalizedAlternatifs;
        // foreach ($finalAlternatifs as $index => $value) {
        //     unset($finalAlternatifs[$index]['nkk']);
        // }
        // dd($finalAlternatifs);
        $bobotKriterias = Kriteria::all()->pluck('bobot_ktr', 'nama_ktr')->toArray();
        // dd($bobotKriterias);
        foreach ($finalAlternatifs as $index => $alternatif) {
            foreach ($alternatif as $key => $value) {
                if (isset($bobotKriterias[$key])) {
                    $bobotKriteria = $bobotKriterias[$key];
                    $finalAlternatifs[$index][$key] *= $bobotKriteria;
                } else {
                    $finalAlternatifs[$index][$key] = $value; // Menjaga nilai non-numeric apa adanya
                }
            }
        }
        // dd($finalAlternatifs);

        $calculateAlternatifs = $finalAlternatifs;
        $keluargas = Alternatif::all()->pluck('nkk')->toArray();
        $ranks = [];
        // $ranks['nkk'] = $keluargas;
        foreach ($calculateAlternatifs as $index => $alternatif) {
            $ranks[$index]['nkk'] = $keluargas[$index];
            $ranks[$index]['skor'] = $alternatif['penghasilan'] + $alternatif['tanggungan'] + $alternatif['pajak_bumibangunan'] + $alternatif['pajak_kendaraan'] + $alternatif['daya_listrik'];
        }
        // dd($ranks);

        foreach ($ranks as $rank) {
            SkorMethodA::updateOrCreate(
                ['nkk' => $rank['nkk']],
                ['skor' => $rank['skor']]
            );
        }

        return view('auth.rw.spk');
    }

    public function spkk()
    {
        $sumBobot = 0;
        $bobots = Kriteria::all()->pluck('bobot_ktr');
        foreach ($bobots as $bobot) {
            $sumBobot += $bobot;
        }

        $normalizedBobot = [];
        foreach ($bobots as $bobot) {
            $normalizedBobot[] = $bobot / $sumBobot;
        };

        $kriterias = Kriteria::all();
        foreach ($kriterias as $index => $kriteria) {
            $kriteria->update(['bobot_ktr' => $normalizedBobot[$index]]);
        }

        $normalizedAlternatifs = [];
        $alternatifs = Alternatif::all()->toArray();
        $bobotKriterias = Kriteria::all()->pluck('bobot_ktr', 'nama_ktr')->toArray();

        foreach ($alternatifs as $index => $alternatif) {
            foreach ($alternatif as $key => $value) {
                // if (isset($alternatif[$key])) {
                if (isset($bobotKriterias[$key])) {
                    $normalizedAlternatifs[$index][$key] = $alternatif[$key] * $bobotKriterias[$key]; // Menjaga nilai non-numeric apa adanya
                } else {
                    $normalizedAlternatifs[$index][$key] = $value; // Menjaga nilai non-numeric apa adanya
                }
                // } else {
                //     $normalizedAlternatifs[$index][$key] = $value; // Menjaga nilai non-numeric apa adanya
                // }
            }
        }

        // dd($normalizedAlternatifs);

        $calculateAlternatifs = $normalizedAlternatifs;
        $keluargas = Alternatif::all()->pluck('nkk')->toArray();
        $ranks = [];
        // $ranks['nkk'] = $keluargas;
        foreach ($calculateAlternatifs as $index => $alternatif) {
            $ranks[$index]['nkk'] = $keluargas[$index];
            $ranks[$index]['skor'] = $alternatif['penghasilan'] + $alternatif['tanggungan'] + $alternatif['pajak_bumibangunan'] + $alternatif['pajak_kendaraan'] + $alternatif['daya_listrik'];
        }
        // dd($ranks);

        foreach ($ranks as $rank => $value) {
            SkorMethodB::create([
                'nkk' => $ranks[$rank]['nkk'],
                'skor' => $ranks[$rank]['skor'],
            ]);
        }

        return view('auth.rw.spk');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Alternatif $alternatif)
    {
        $alternatif->delete();

        return redirect()->back()
            ->with('success', 'Data calon penerima bansos berhasil dihapus.');
    }
}
