<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmployeePhotoController extends Controller
{
    public function process(Request $request)
    {
        $request->validate([
            'photo' => 'required|image'
        ]);

        $file = $request->file('photo');
        $name = time() . '.png';

        $inputPath = storage_path('app/public/uploads/' . $file->hashName());
        $outputPath = storage_path('app/public/results/' . $name);

        $file->store('public/uploads');

        shell_exec("rembg i \"$inputPath\" \"$outputPath\"");

        return asset('storage/results/' . $name);
    }
}
