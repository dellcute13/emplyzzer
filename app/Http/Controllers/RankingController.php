<?php

namespace App\Http\Controllers;

use App\Models\Ranking;
use Illuminate\Http\Request;

class RankingController extends Controller
{
    public function index()
    {
        $rankings = Ranking::with([
            'employee',
            'period'
        ])->get();

        return view('rankings.index', compact('rankings'));
    }

    public function create()
    {
        return view('rankings.create');
    }

    public function store(Request $request)
    {
        Ranking::create($request->all());

        return redirect()->route('rankings.index')
                         ->with('success', 'Ranking created successfully');
    }

    public function edit(Ranking $ranking)
    {
        return view('rankings.edit', compact('ranking'));
    }

    public function update(Request $request, Ranking $ranking)
    {
        $ranking->update($request->all());

        return redirect()->route('rankings.index')
                         ->with('success', 'Ranking updated successfully');
    }

    public function destroy(Ranking $ranking)
    {
        $ranking->delete();

        return redirect()->route('rankings.index')
                         ->with('success', 'Ranking deleted successfully');
    }
}