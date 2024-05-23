<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

class AdminController extends Controller
{
    private function humanFileSize($bytes)
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];
        $factor = floor((strlen($bytes) - 1) / 3);
        return sprintf("%.2f", $bytes / pow(1024, $factor)) . ' ' . $units[$factor];
    }
    public function dashboard()
    {
        $files = Storage::disk('drive_d')->files('/');
        $fileCount = count($files);

        // Menghitung jumlah file berdasarkan tipe
        $fileTypes = [];
        foreach ($files as $file) {
            $extension = pathinfo($file, PATHINFO_EXTENSION);
            if (!isset($fileTypes[$extension])) {
                $fileTypes[$extension] = 0;
            }
            $fileTypes[$extension]++;
        }
        // Mencari ekstensi terbanyak
        $mostCommonExtension = null;
        $maxCount = 0;
        foreach ($fileTypes as $extension => $count) {
            if ($count > $maxCount) {
                $maxCount = $count;
                $mostCommonExtension = $extension;
            }
        }

        // Menghitung total ukuran file
        $totalSize = array_reduce($files, function ($carry, $file) {
            return $carry + Storage::disk('drive_d')->size($file);
        }, 0);
        // Konversi ukuran total file ke format yang lebih mudah dibaca
        $readableTotalSize = $this->humanFileSize($totalSize);

        // Menghitung ukuran file berdasarkan jenis ekstensi
        $extensionSizes = [];
        foreach ($files as $file) {
            $extension = pathinfo($file, PATHINFO_EXTENSION);
            $size = Storage::disk('drive_d')->size($file);
            if (!isset($extensionSizes[$extension])) {
                $extensionSizes[$extension] = 0;
            }
            $extensionSizes[$extension] += $size;
        }
        // Menentukan ekstensi terbesar
        $largestExtension = null;
        $largestSize = 0;
        foreach ($extensionSizes as $extension => $size) {
            if ($size > $largestSize) {
                $largestSize = $size;
                $largestExtension = $extension;
            }
        }
        // Konversi ukuran total file dan ukuran ekstensi terbesar ke format yang lebih mudah dibaca
        $readableTotalSize = $this->humanFileSize($totalSize);
        $readableLargestSize = $this->humanFileSize($largestSize);

        return view('admin.index', ['fileCount' => $fileCount, 'mostCommonExtension' => $mostCommonExtension, 'totalSize' => $readableTotalSize, 'largestExtension' => $largestExtension, 'largestSize' => $readableLargestSize]);
    }
    public function nas()
    {
        $files = Storage::disk('drive_d')->files('/');
        return view('admin.nas', ['files' => $files]);
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

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

}
