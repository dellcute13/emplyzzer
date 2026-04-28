<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;

class EmployeeController extends Controller
{
    public function employeeData()
    {
        return view('employee.employee-data');
    }

    public function employeeAdd()
    {
        return view('employee.employee-add');
    }

    public function create()
    {
        return view('pegawai.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'photo' => 'required|image'
        ]);

        $file = $request->file('photo');

        $tempName = time() . '_temp.' . $file->extension();
        $finalName = time() . '_final.jpg';

        $tempPath = storage_path('app/public/temp/' . $tempName);
        $finalPath = storage_path('app/public/profile/' . $finalName);

        $file->move(dirname($tempPath), basename($tempPath));

        $python = "python3";
        $script = base_path('scripts/process_photo.py');

        exec("$python $script $tempPath $finalPath");

        Employee::create([
            'name' => $request->name,
            'photo' => 'profile/' . $finalName
        ]);

        return back()->with('success', 'Pegawai berhasil ditambah');
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

        $python = "C:\Users\zacky\AppData\Local\Programs\Python\Python312\python.exe";
        $script = base_path('scripts/process_photo.py');

        exec("\"$python\" \"$script\" \"$tempPath\" \"$finalPath\" \"$size\"");

        return response()->json([
            'success' => true,
            'url' => asset('storage/profile/' . $finalName),
            'path' => 'profile/' . $finalName
        ]);
    }
}
