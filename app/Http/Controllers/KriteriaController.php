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

    public function update(Request $request, Kriteria $kriteria)
    {
        // Logic for the update method
    }
}
