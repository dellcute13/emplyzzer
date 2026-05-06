<?php

namespace App\Http\Controllers;

use App\Models\Criteria;
use Illuminate\Http\Request;

class CriteriaController extends Controller
{
    public function index()
    {
        $criteria = Criteria::all();

        return view('criteria.index', compact('criterias'));
    }

    public function store(Request $request)
    {
        Criteria::create($request->all());

        return back()->with('success', 'Criteria created successfully');
    }

    public function update(Request $request, Criteria $criteria)
    {
        $criteria->update($request->all());

        return back()->with('success', 'Criteria updated successfully');
    }

    public function destroy(Criteria $criteria)
    {
        $criteria->delete();

        return back()->with('success', 'Criteria deleted successfully');
    }

    public function criteriaData()
    {
        return view('criteria.criteria-data');
    }

    public function criteriaAdd()
    {
        return view('criteria.criteria-add');
    }
}
