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
use App\Models\Rw;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Validation\Rule;
use App\Enums\DayaListrik as DayaListrik;


class AlternatifController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bansos = Alternatif::all();
        $nkks = Keluarga::select('nkk')->get();
        return view('global.bansos')->with('bansos', $bansos)->with('nkks', $nkks);
    }
    public function list(AlternatifDataTable $dataTable)
    {
        return $dataTable->render('auth.rw.bansos');
    }

    /**
     * Show the form for creating a new resource.
     */
     /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nkk' => 'required|string|min:15|max:17',
            'penghasilan' => 'required|integer',
            'tanggungan' => 'required|integer',
            'pajak_bumibangunan' => 'required|integer',
            'pajak_kendaraan' => 'required|integer',
            'daya_listrik' => 'required|integer',
        ], [
            'nkk.required' => 'NIK pemilik UMKM wajib diisi.',
            'nkk.string' => 'NIK pemilik UMKM harus berupa teks.',
            'nkk.min' => 'NKK harus harus memiliki panjang minimal :min karakter.',
            'nkk.max' => 'NKK harus memiliki panjang maksimal :max karakter.',
            'penghasilan.required' => 'Penghasilan wajib diisi.',
            'penghasilan.integer' => 'Penghasilan harus berupa angka.',
            'tanggungan.required' => 'Tanggungan wajib diunggah.',
            'tanggungan.integer' => 'Tanggungan harus berupa angka.',
            'pajak_bumibangunan.required' => 'Pajak Bumi dan Bangunan wajib diisi.',
            'pajak_bumibangunan.integer' => 'Pajak Bumi dan Bangunan harus berupa angka.',
            'pajak_kendaraan.required' => 'Pajak Kendaraan wajib diisi.',
            'pajak_kendaraan.integer' => 'Pajak Kendaraan harus berupa angka.',
            'daya_listrik.required' => 'Daya Listrik wajib diisi.',
            'daya_listrik.integer' => 'Daya Listrik harus berupa angka.',
        ]);

        // Cek apakah ada pengajuan dokumen dengan nik_pemohon yang sama dan status "Baru"
        $existingPengajuan = Alternatif::where('nkk', $validated['nkk'])
            ->first();

        if ($existingPengajuan) {
            $rw = Rw::first();
            Alert::error('Anda Sudah Mengajukan Bansos!', 'Silahkan tunggu informasi lebih lanjut dari Ketua RW atau hubungi Ketua RW melalui nomor ' . $rw->wa_rw);
            return redirect()->back();
        }
        
        try {
            Alternatif::create([
                'nkk' => $validated['nkk'],
                'penghasilan' => $validated['penghasilan'],
                'tanggungan' => $validated['tanggungan'],
                'pajak_bumibangunan' => $validated['pajak_bumibangunan'],
                'pajak_kendaraan' => $validated['pajak_kendaraan'],
                'daya_listrik' => $validated['daya_listrik'],
              ]);
            return redirect()->back()->with('success', 'Anda berhasil mengajukan bantuan sosial!');
        } catch (\Illuminate\Database\QueryException $e) {
            $no_rw = Rw::all()->pluck('nik_rw');
            Alert::error('NKK Anda Tidak Terdata!', 'Silahkan hubungi RW anda untuk keperluan kelengkapan data kependudukan di Sistem Informasi Rukun Warga ini melalui nomor ' . $no_rw);
            return redirect()->back();
        } catch (\Exception $e) {
            Alert::error('Oops!', $e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Calculate the resources.
     */
    public function spk()
    {
        $ktr = Kriteria::all();
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

        return view('auth.rw.spk', compact('ktr', 'alternatifs', 'normalizedAlternatifs', 'finalAlternatifs', 'ranks'));
    }

    public function spkk()
    {
        $ktr = Kriteria::all();
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
            SkorMethodB::updateOrCreate([
                'nkk' => $ranks[$rank]['nkk'],
                'skor' => $ranks[$rank]['skor'],
            ]);
        }

        return view('auth.rw.spkk', compact('ktr', 'alternatifs', 'normalizedAlternatifs', 'ranks'));
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