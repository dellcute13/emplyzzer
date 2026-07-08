<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Position;
use App\Models\Department;
use App\Models\Grade;
use App\Models\Period;
use App\Models\Position as ModelsPosition;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::with(['position', 'department'])->get();

        return view('employees.index', compact('employees'));
    }

    public function employeeData(Request $request)
    {
        $sort = $request->get('sort', 'latest');

        $query = Employee::with([
            'position',
            'department'
        ]);

        if ($sort == 'name_asc') {
            $query->orderBy('name', 'asc');
        } elseif ($sort == 'name_desc') {
            $query->orderBy('name', 'desc');
        } elseif ($sort == 'oldest') {
            $query->orderBy('created_at', 'asc');
        } else {
            $query->orderBy('created_at', 'desc');
        }

        $employees = $query->paginate(10)->withQueryString();

        return view('employee.employee-data', compact('employees', 'sort'));
    }

    public function navbarSearch(Request $request)
    {
        $q = $request->query('q', '');
        if (trim($q) === '') {
            return response()->json([]);
        }

        $results = [];

        // 1. Search Employees
        $employees = Employee::where('name', 'like', "%{$q}%")
            ->orWhere('nip', 'like', "%{$q}%")
            ->with(['position', 'department'])
            ->limit(5)
            ->get();

        foreach ($employees as $employee) {
            $results[] = [
                'title' => $employee->name,
                'subtitle' => 'Pegawai - NIP: ' . $employee->nip . ($employee->position ? ' (' . $employee->position->name . ')' : ''),
                'route' => route('employee.employee-edit', $employee->id),
                'icon' => 'person',
                'type' => 'pegawai'
            ];
        }

        // 2. Search Positions
        $positions = Position::where('name', 'like', "%{$q}%")->limit(3)->get();
        foreach ($positions as $pos) {
            $results[] = [
                'title' => $pos->name,
                'subtitle' => 'Posisi / Jabatan',
                'route' => route('master-data.position-edit', $pos->id),
                'icon' => 'account_tree',
                'type' => 'posisi'
            ];
        }

        // 3. Search Departments
        $departments = Department::where('name', 'like', "%{$q}%")->limit(3)->get();
        foreach ($departments as $dept) {
            $results[] = [
                'title' => $dept->name,
                'subtitle' => 'Departemen',
                'route' => route('master-data.department-edit', $dept->id),
                'icon' => 'cases',
                'type' => 'departemen'
            ];
        }

        // 4. Search Grades
        $grades = Grade::where('name', 'like', "%{$q}%")->limit(3)->get();
        foreach ($grades as $grade) {
            $results[] = [
                'title' => $grade->name,
                'subtitle' => 'Grade / Golongan (Level: ' . $grade->level . ')',
                'route' => route('master-data.grade-edit', $grade->id),
                'icon' => 'grading',
                'type' => 'grade'
            ];
        }

        // 5. Search Periods
        $periods = Period::where('name', 'like', "%{$q}%")
            ->orWhere('year', 'like', "%{$q}%")
            ->limit(3)
            ->get();
        foreach ($periods as $period) {
            $results[] = [
                'title' => $period->name . ' - Semester ' . $period->semester,
                'subtitle' => 'Periode Penilaian (Tahun: ' . $period->year . ')',
                'route' => route('master-data.period-edit', $period->id),
                'icon' => 'timeline',
                'type' => 'periode'
            ];
        }

        return response()->json($results);
    }

    public function employeeAdd()
    {
        $positions = Position::all();
        $departments = Department::all();
        return view('employee.employee-add', compact('positions', 'departments'));
    }

    public function create()
    {
        return view('pegawai.create');
    }

    public function employeeEdit($id)
    {
        $employee = Employee::findOrFail($id);
        $positions = ModelsPosition::all();
        $departments = Department::all();
        return view('employee.employee-edit', compact('employee', 'positions', 'departments'));
    }

    public function employeeStoreUpdate(Request $request, $id)
    {
        DB::beginTransaction();

        try {

            $employee = Employee::findOrFail($id);

            $validated = $request->validate([
                'nip' => [
                    'required',
                    Rule::unique('employees')->ignore($employee->id),
                ],
                'name'          => 'required|max:100',
                'gender'        => 'required|in:P,L',
                'photo_ai'      => 'nullable|string',
                'position_id'   => 'required|exists:positions,id',
                'department_id' => 'required|exists:departments,id',
                'join_date'     => 'nullable|date',
                'status'        => 'required|in:permanent,contract',
            ]);

            $validated['photo'] = $request->photo_ai;

            $employee->update($validated);
            DB::commit();
            return redirect()->route('employee.employee-data')->with('success', 'Data pegawai berhasil diperbarui');
        } catch (\Exception $e) {

            DB::rollBack();
            if (
                $request->photo_ai &&
                Storage::disk('public')->exists($request->photo_ai)
            ) {
                Storage::disk('public')->delete($request->photo_ai);
            }
            return back()->withInput()->with('error', 'Update pegawai gagal: ' . $e->getMessage());
        }
    }

    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'name' => 'required',
    //         'photo' => 'required|image'
    //     ]);

    //     $file = $request->file('photo');

    //     $tempName = time() . '_temp.' . $file->extension();
    //     $finalName = time() . '_final.jpg';

    //     $tempPath = storage_path('app/public/temp/' . $tempName);
    //     $finalPath = storage_path('app/public/profile/' . $finalName);

    //     $file->move(dirname($tempPath), basename($tempPath));

    //     $python = "python3";
    //     $script = base_path('scripts/process_photo.py');

    //     exec("$python $script $tempPath $finalPath");

    //     Employee::create([
    //         'name' => $request->name,
    //         'photo' => 'profile/' . $finalName
    //     ]);

    //     return back()->with('success', 'Pegawai berhasil ditambah');
    // }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {

            $validated = $request->validate([
                'nip'           => 'required|unique:employees,nip',
                'name'          => 'required|max:100',
                'gender'        => 'required|in:P,L',
                'photo_ai'      => 'nullable|string',
                'position_id'   => 'required|exists:positions,id',
                'department_id' => 'required|exists:departments,id',
                'join_date'     => 'nullable|date',
                'status'        => 'required|in:permanent,contract',
            ]);

            $validated['photo'] = $request->photo_ai;

            Employee::create($validated);
            DB::commit();
            return redirect()->route('employee.employee-data')->with('success', 'Data pegawai berhasil disimpan');
        } catch (\Exception $e) {

            DB::rollBack();
            if (
                $request->photo_ai &&
                Storage::disk('public')->exists($request->photo_ai)
            ) {
                Storage::disk('public')->delete($request->photo_ai);
            }
            return back()->withInput()->with('error', 'Tambah pegawai gagal: ' . $e->getMessage());
        }
    }

    public function generateAI(Request $request)
    {
        $request->validate([
            'photo' => 'required|image|mimes:jpg,jpeg,png|max:2048'
        ]);


        $file = $request->file('photo');

        $tempName  = time() . '_temp.' . $file->extension();
        $finalName = time() . '_ai.jpg';

        $tempPath  = storage_path('app/public/temp/' . $tempName);
        $finalPath = storage_path('app/public/profile/' . $finalName);

        // simpan file upload sementara
        $file->move(dirname($tempPath), basename($tempPath));

        // path python
        $size = $request->size ?? '3x4';

        $python = "python";
        $script = base_path('scripts/process_photo.py');

        exec("\"$python\" \"$script\" \"$tempPath\" \"$finalPath\" \"$size\"");

        return response()->json([
            'success' => true,
            'url' => asset('storage/profile/' . $finalName),
            'path' => 'profile/' . $finalName
        ]);
    }
}
