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
     * Show the form for editing the specified resource.
     */
    public function departmentEdit($id)
    {
        $department = Department::findOrFail($id);

        return view('master-data.department.department-edit', compact('department'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function departmentUpdate(Request $request, $id)
    {
        DB::beginTransaction();

        try {

            $validated = $request->validate([
                'name' => 'required|string|max:255',
            ]);

            $department = Department::findOrFail($id);

            $department->update($validated);

            DB::commit();

            return redirect()
                ->route('master-data.department-data')
                ->with('success', 'Department updated successfully');

        } catch (\Exception $e) {

            DB::rollBack();

            return back()
                ->withInput()
                ->with('error', 'Update department failed: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function departmentDelete($id)
    {
        $department = Department::findOrFail($id);

        $department->delete();

        return redirect()
            ->route('master-data.department-data')
            ->with('success', 'Department deleted successfully');
    }
}
