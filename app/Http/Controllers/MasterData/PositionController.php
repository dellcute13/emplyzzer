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
     * Show the form for editing the specified resource.
     */
    public function positionEdit($id)
    {
        $position = Position::findOrFail($id);
        $grades = Grade::all();

        return view('master-data.position.position-edit', compact(
            'position',
            'grades'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function positionUpdate(Request $request, $id)
    {
        DB::beginTransaction();

        try {

            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'grade_id' => 'required|exists:grades,id',
            ]);

            $position = Position::findOrFail($id);

            $position->update($validated);

            DB::commit();

            return redirect()
                ->route('master-data.position-data')
                ->with('success', 'Position updated successfully');

        } catch (\Exception $e) {

            DB::rollBack();

            return back()
                ->withInput()
                ->with('error', 'Update position failed: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function positionDelete($id)
    {
        $position = Position::findOrFail($id);

        $position->delete();

        return redirect()
            ->route('master-data.position-data')
            ->with('success', 'Position deleted successfully');
    }
}
