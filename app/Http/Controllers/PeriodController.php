<?php

namespace App\Http\Controllers;

use App\Models\Period;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PeriodController extends Controller
{
    public function periodData(Request $request)
    {
        $sort = $request->get('sort', 'latest');

        $query = Period::query();

        if ($sort == 'name_asc') {
            $query->orderBy('name', 'asc');
        } elseif ($sort == 'name_desc') {
            $query->orderBy('name', 'desc');
        } elseif ($sort == 'oldest') {
            $query->orderBy('created_at', 'asc');
        } else {
            $query->orderBy('created_at', 'desc');
        }

        $periods = $query->paginate(10)->withQueryString();

        return view('master-data.period.period-data', compact('periods'));
    }

    public function periodAdd()
    {
        return view('master-data.period.period-add');
    }

    public function periodStore(Request $request)
    {
        DB::beginTransaction();

        try {

            $validated = $request->validate([
                'name'       => 'required|string|max:255',
                'semester'   => 'required|in:1,2',
                'year'       => 'required|integer|min:2000|max:2100',
                'start_date' => 'required|date',
                'end_date'   => 'required|date|after_or_equal:start_date',
                'is_active'  => 'nullable|boolean',
            ]);

            $validated['is_active'] = $request->has('is_active') ? 1 : 0;

            Period::create($validated);

            DB::commit();

            return redirect()
                ->route('master-data.period-data')
                ->with('success', 'Data periode berhasil disimpan');
        } catch (\Exception $e) {

            DB::rollBack();

            return back()
                ->withInput()
                ->with('error', 'Tambah periode gagal: ' . $e->getMessage());
        }
    }

    public function periodEdit($id)
    {
        $period = Period::findOrFail($id);

        return view('master-data.period.period-edit', compact('period'));
    }

    public function periodUpdate(Request $request, $id)
    {
        DB::beginTransaction();

        try {

            $validated = $request->validate([
                'name'       => 'required|string|max:255',
                'semester'   => 'required|in:1,2',
                'year'       => 'required|integer|min:2000|max:2100',
                'start_date' => 'required|date',
                'end_date'   => 'required|date|after_or_equal:start_date',
                'is_active'  => 'nullable|boolean',
            ]);

            $validated['is_active'] = $request->has('is_active') ? 1 : 0;

            $period = Period::findOrFail($id);
            $period->update($validated);

            DB::commit();

            return redirect()
                ->route('master-data.period-data')
                ->with('success', 'Data periode berhasil diperbarui');
        } catch (\Exception $e) {

            DB::rollBack();

            return back()
                ->withInput()
                ->with('error', 'Update periode gagal: ' . $e->getMessage());
        }
    }

    public function periodDelete($id)
    {
        $period = Period::findOrFail($id);

        $period->delete();

        return redirect()
            ->route('master-data.period-data')
            ->with('success', 'Data periode berhasil dihapus');
    }
}

