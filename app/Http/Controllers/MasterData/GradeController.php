<?php

namespace App\Http\Controllers\MasterData;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Grade;
use Illuminate\Support\Facades\DB;

class GradeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function gradeData(Request $request)
    {
        $sort = $request->get('sort', 'latest');

        $query = Grade::query();

        if ($sort == 'name_asc') {
            $query->orderBy('name', 'asc');
        } elseif ($sort == 'name_desc') {
            $query->orderBy('name', 'desc');
        } elseif ($sort == 'oldest') {
            $query->orderBy('created_at', 'asc');
        } else {
            $query->orderBy('created_at', 'desc');
        }

        $grades = $query->paginate(10)->withQueryString();

        return view('master-data.grade.grade-data', compact('grades'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function gradeAdd()
    {
        return view('master-data.grade.grade-add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function gradeStore(Request $request)
    {
        DB::beginTransaction();

        try {

            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'level' => 'required|string|max:255',
            ]);

            Grade::create($validated);
            DB::commit();
            return redirect()->route('master-data.grade-data')->with('success', 'Data grade berhasil disimpan');
        } catch (\Exception $e) {

            DB::rollBack();
            return back()->withInput()->with('error', 'Tambah grade gagal: ' . $e->getMessage());
        }
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Grade $grade)
    {
        return view('grades.edit', compact('grade'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Grade $grade)
    {
        $grade->update($request->all());

        return redirect()->route('grades.index')
            ->with('success', 'Grade updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Grade $grade)
    {
        $grade->delete();

        return redirect()->route('grades.index')
            ->with('success', 'Grade deleted successfully.');
    }
}
