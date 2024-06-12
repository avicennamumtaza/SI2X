<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use Illuminate\Http\Request;

class KriteriaController extends Controller
{
    //
    public function index()
    {
        $kriterias = Kriteria::all();
        return view('auth.rw.kriteria', compact('kriterias'));
    }

    public function updatee(Request $request, $id_ktr)
    {
        $kriteria = Kriteria::findOrFail($id_ktr);
        $kriteria->bobot_ktr = $request->input('bobot_ktr');
        $kriteria->save();

        return redirect()->route('kriteria.manage')->with('success', 'Bobot kriteria berhasil diperbarui.');
    }
}