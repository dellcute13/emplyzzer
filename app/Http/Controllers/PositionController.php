<?php

namespace App\Http\Controllers;

use App\Models\Position;
use App\Models\Grade;
use Illuminate\Http\Request;


class PositionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $positions = Position::with('grade')->get();
        return view('positions.index', compact('positions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $grades = Grade::all();

        return view('positions.create', compact('grades'));
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Position::create($request->all());

        return redirect()->route('positions.index')
                         ->with('success', 'Position created successfully');
    }

    /**
     * Display the specified resource.
     */
    // public function show(string $id)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Position $position)
    {
        $grades = Grade::all();

        return view('positions.edit', compact('position', 'grades'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Position $position)
    {
        $position->update($request->all());

        return redirect()->route('positions.index')
                         ->with('success', 'Position updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Position $position)
    {
        $position->delete();

        return redirect()->route('positions.index')
                         ->with('success', 'Position deleted successfully.');
    }
}
