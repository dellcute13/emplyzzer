<?php

namespace App\Http\Controllers\MasterData;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function departmentData(Request $request)
    {
        $sort = $request->get('sort', 'latest');

        $query = Department::query();

        if ($sort == 'name_asc') {
            $query->orderBy('name', 'asc');
        } elseif ($sort == 'name_desc') {
            $query->orderBy('name', 'desc');
        } elseif ($sort == 'oldest') {
            $query->orderBy('created_at', 'asc');
        } else {
            $query->orderBy('created_at', 'desc');
        }

        $departments = $query->paginate(10)->withQueryString();

        return view('master-data.department.department-data', compact('departments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function departmentAdd()
    {
        return view('master-data.department.department-add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function departmentStore(Request $request)
    {
        DB::beginTransaction();

        try {

            $validated = $request->validate([
                'name' => 'required|string|max:255',
            ]);

            Department::create($validated);
            DB::commit();
            return redirect()->route('master-data.department-data')->with('success', 'Data department berhasil disimpan');
        } catch (\Exception $e) {

            DB::rollBack();
            return back()->withInput()->with('error', 'Tambah department gagal: ' . $e->getMessage());
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
    // public function edit(string $id)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Department $department)
    {
        $department->update($request->all());

        return back()->with('success', 'Department updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Department $department)
    {
        $department->delete();

        return redirect()->route('departments.index')
            ->with('success', 'Department deleted successfully.');
    }
}
