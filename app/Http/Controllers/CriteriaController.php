<?php

namespace App\Http\Controllers;

use App\Models\Criteria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CriteriaController extends Controller
{
    public function criteriaData(Request $request)
    {
        $sort = $request->get('sort', 'latest');

        $query = Criteria::query();

        if ($sort == 'name_asc') {
            $query->orderBy('name', 'asc');
        } elseif ($sort == 'name_desc') {
            $query->orderBy('name', 'desc');
        } elseif ($sort == 'oldest') {
            $query->orderBy('created_at', 'asc');
        } else {
            $query->orderBy('created_at', 'desc');
        }

        $criterias = $query->paginate(10)->withQueryString();

        return view('criteria.criteria-data', compact('criterias'));
    }

    public function criteriaAdd()
    {
        return view('criteria.criteria-add');
    }

    public function criteriaStore(Request $request)
    {
        DB::beginTransaction();

        try {

            $validated = $request->validate([
                'code'        => 'required|string|max:10|unique:criterias,code',
                'name'        => 'required|string|max:150',
                'weight'      => 'required|numeric|min:0|max:1',
                'attribute'   => 'required|in:benefit,cost',
                'description' => 'nullable|string',
            ]);

            Criteria::create($validated);

            DB::commit();

            return redirect()
                ->route('criteria.criteria-data')
                ->with('success', 'Data kriteria berhasil disimpan');
        } catch (\Exception $e) {

            DB::rollBack();

            return back()
                ->withInput()
                ->with('error', 'Tambah kriteria gagal: ' . $e->getMessage());
        }
    }

    public function criteriaEdit($id)
    {
        $criteria = Criteria::findOrFail($id);

        return view('criteria.criteria-edit', compact('criteria'));
    }

    public function criteriaUpdate(Request $request, $id)
    {
        DB::beginTransaction();

        try {

            $criteria = Criteria::findOrFail($id);

            $validated = $request->validate([
                'code'        => 'required|string|max:10|unique:criterias,code,' . $criteria->id,
                'name'        => 'required|string|max:150',
                'weight'      => 'required|numeric|min:0|max:1',
                'attribute'   => 'required|in:benefit,cost',
                'description' => 'nullable|string',
            ]);

            $criteria->update($validated);

            DB::commit();

            return redirect()
                ->route('criteria.criteria-data')
                ->with('success', 'Data kriteria berhasil diperbarui');
        } catch (\Exception $e) {

            DB::rollBack();

            return back()
                ->withInput()
                ->with('error', 'Update kriteria gagal: ' . $e->getMessage());
        }
    }

    public function criteriaDelete($id)
    {
        $criteria = Criteria::findOrFail($id);

        $criteria->delete();

        return redirect()
            ->route('criteria.criteria-data')
            ->with('success', 'Data kriteria berhasil dihapus');
    }
}

