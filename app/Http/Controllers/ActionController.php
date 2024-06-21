<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

class ActionController extends Controller
{
    public function index()
    {
        $files = Storage::disk('drive_d')->files('/');
        return view('index', ['files' => $files]);
    }

    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|file',
        ]);

        $file = $request->file('file');
        $path = $file->storeAs('', $file->getClientOriginalName(), 'drive_d');

        return redirect()->back()->with('success', 'File uploaded successfully');
    }

    public function delete($file)
    {
        $filePath = Storage::disk('drive_d')->path($file);
        if (Storage::disk('drive_d')->exists($file)) {
            Storage::disk('drive_d')->delete($file);
            return redirect()->back()->with('success', 'File berhasil dihapus');
        } else {
            return redirect()->back()->with('error', 'File tidak ditemukan');
        }
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

    public function userdownload($file)
    {
        $filePath = Storage::disk('drive_d')->path($file);
        if (file_exists($filePath)) {
            return response()->download($filePath);
        } else {
            abort(404);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
    public function dashboard()
    {
        $files = Storage::disk('drive_d')->files('/');
        return view('dashboard', ['files' => $files]);
    }

}
