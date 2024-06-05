<?php

// app/Http/Controllers/AlternativeController.php

namespace App\Http\Controllers;

use App\Models\Alternative;
use App\Models\Criteria;
use Illuminate\Http\Request;

class AlternativeController extends Controller
{
    public function index()
    {
        $alternatives = Alternative::all();
        $criterias = Criteria::all();
        return view('alternatives.index', compact('alternatives', 'criterias'));
    }

    public function create()
    {
        $criterias = Criteria::all();
        return view('alternatives.create', compact('criterias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'scores' => 'required|array',
            'scores.*' => 'required|numeric',
        ]);

        $alternative = Alternative::create(['name' => $request->name]);

        foreach ($request->scores as $criteria_id => $score) {
            $alternative->criterias()->attach($criteria_id, ['score' => $score]);
        }

        return redirect()->route('alternatives.index')->with('success', 'Alternative created successfully.');
    }

    public function edit(Alternative $alternative)
    {
        $criterias = Criteria::all();
        return view('alternatives.edit', compact('alternative', 'criterias'));
    }

    public function update(Request $request, Alternative $alternative)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'scores' => 'required|array',
            'scores.*' => 'required|numeric',
        ]);

        $alternative->update(['name' => $request->name]);

        $alternative->criterias()->detach();
        foreach ($request->scores as $criteria_id => $score) {
            $alternative->criterias()->attach($criteria_id, ['score' => $score]);
        }

        return redirect()->route('alternatives.index')->with('success', 'Alternative updated successfully.');
    }

    public function destroy(Alternative $alternative)
    {
        $alternative->delete();
        return redirect()->route('alternatives.index')->with('success', 'Alternative deleted successfully.');
    }

    public function calculateScores()
    {
        $criterias = Criteria::all();
        $alternatives = Alternative::all();

        $totalWeight = $criterias->sum('weight');

        $results = [];
        foreach ($alternatives as $alternative) {
            $totalScore = 0;
            foreach ($criterias as $criteria) {
                $score = $alternative->criterias->find($criteria->id)->pivot->score ?? 0;
                $weight = $criteria->weight;
                $totalScore += $score * ($weight / $totalWeight);
            }
            $results[] = [
                'alternative' => $alternative->name,
                'score' => $totalScore,
            ];
        }

        usort($results, function ($a, $b) {
            return $b['score'] <=> $a['score'];
        });

        return view('alternatives.result', compact('results'));
    }
}
