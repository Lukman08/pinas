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
            'offset' => 'required|integer',
            'totalChunks' => 'required|integer',
            'originalName' => 'required|string',
        ]);

        $file = $request->file('file');
        $originalName = $request->input('originalName');
        $offset = $request->input('offset');
        $totalChunks = $request->input('totalChunks');

        // Simpan sementara di folder temp
        $tempDir = storage_path('app/temp');
        if (!is_dir($tempDir)) {
            mkdir($tempDir, 0777, true);
        }

        $tempFilePath = $tempDir . '/' . $originalName . '.part';
        $handle = fopen($tempFilePath, 'ab');
        fwrite($handle, file_get_contents($file->getRealPath()));
        fclose($handle);

        // Jika ini adalah bagian terakhir, pindahkan file dari temp ke tujuan akhir
        if ($offset + 1 >= $totalChunks) {
            $finalPath = Storage::disk('drive_d')->path($originalName);
            rename($tempFilePath, $finalPath);
            return response()->json(['success' => 'File berhasil di-upload'], 200);
        }

        return response()->json(['success' => 'Chunk uploaded successfully'], 200);
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
