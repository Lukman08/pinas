<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index()
    {
        $files = Storage::disk('drive_d')->files('/');
        return view('user.index', ['files' => $files]);
    }

    public function download($file)
    {
        $filePath = Storage::disk('drive_d')->path($file);
        if (file_exists($filePath)) {
            return response()->download($filePath);
        } else {
            abort(404);
        }
    }

    
}
