<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Symfony\Component\Process\Process;

class PhotoAIController extends Controller
{
    public function generate(Request $request)
    {
        $file = $request->file('photo');

        $input = storage_path('app/temp/input.jpg');
        $output = storage_path('app/temp/output.png');

        $file->move(dirname($input), 'input.jpg');

        $process = new Process([
            'C:\Users\asus\AppData\Local\Programs\Python\Python312\python.exe',
            '-m',
            'rembg',
            'i',
            $input,
            $output
        ]);

        $process->run();

        if (!$process->isSuccessful()) {
            return response()->json([
                'error' => $process->getErrorOutput()
            ], 500);
        }

        return response()->file($output);
    }
}
