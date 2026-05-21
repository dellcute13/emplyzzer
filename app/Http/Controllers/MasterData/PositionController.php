<?php

namespace App\Http\Controllers\MasterData;

use App\Http\Controllers\Controller;
use App\Models\Position;
use App\Models\Grade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PositionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function positionData(Request $request)
    {
        $sort = $request->get('sort', 'latest');

        $query = Position::query();

        if ($sort == 'name_asc') {
            $query->orderBy('name', 'asc');
        } elseif ($sort == 'name_desc') {
            $query->orderBy('name', 'desc');
        } elseif ($sort == 'oldest') {
            $query->orderBy('created_at', 'asc');
        } else {
            $query->orderBy('created_at', 'desc');
        }

        $positions = $query->paginate(10)->withQueryString();

        return view('master-data.position.position-data', compact('positions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function positionAdd()
    {
        $grades = Grade::all();

        return view('master-data.position.position-add', compact('grades'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function positionStore(Request $request)
    {
        DB::beginTransaction();

        try {

            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'grade_id' => 'required|exists:grades,id',
            ]);

            Position::create($validated);
            DB::commit();
            return redirect()->route('master-data.position-data')->with('success', 'Data posisi berhasil disimpan');
        } catch (\Exception $e) {

            DB::rollBack();
            return back()->withInput()->with('error', 'Tambah posisi gagal: ' . $e->getMessage());
        }
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
