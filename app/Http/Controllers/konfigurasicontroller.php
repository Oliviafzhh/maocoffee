<?php

namespace App\Http\Controllers;

use App\Models\konfigurasi_web;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class konfigurasicontroller extends Controller
{
    public function index()
    {
        $konfigurasi = konfigurasi_web::first();
        return view('konfigurasi.index', compact('konfigurasi'));
    }

    public function create()
    {
        return view('form.createkonfigurasi');
    }

    public function store(Request $request)
    {
        $request->validate([
            'logo_web' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'img_card1' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'nama_card1' => 'required|string|max:255',
            'img_card2' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'nama_card2' => 'required|string|max:255',
        ]);

        $logoPath = $request->file('logo_web')->store('konfigurasi', 'public');
        $card1Path = $request->file('img_card1')->store('konfigurasi', 'public');
        $card2Path = $request->file('img_card2')->store('konfigurasi', 'public');

        konfigurasi_web::create([
            'logo_web' => $logoPath,
            'img_card1' => $card1Path,
            'nama_card1' => $request->nama_card1,
            'img_card2' => $card2Path,
            'nama_card2' => $request->nama_card2,
        ]);

        return redirect()->route('konfigurasi.index')
            ->with('success', 'Konfigurasi web berhasil ditambahkan.');
    }

    // Edit Method - sekarang mengarah ke folder dashboard
    public function edit($id)
    {
        $konfigurasi = konfigurasi_web::findOrFail($id);
        return view('dashboard.konfigurasi.edit', compact('konfigurasi'));
    }

    // Update Method
    public function update(Request $request, $id)
    {
        $request->validate([
            'logo_web' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'img_card1' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'nama_card1' => 'required|string|max:255',
            'img_card2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'nama_card2' => 'required|string|max:255',
        ]);

        $konfigurasi = konfigurasi_web::findOrFail($id);

        // ================= LOGO =================
        if ($request->hasFile('logo_web')) {

            // ✅ HAPUS FILE LAMA HANYA JIKA DIA ADA DI STORAGE
            if ($konfigurasi->logo_web && str_starts_with($konfigurasi->logo_web, 'konfigurasi/')) {
                Storage::disk('public')->delete($konfigurasi->logo_web);
            }

            $konfigurasi->logo_web = $request->file('logo_web')
                ->store('konfigurasi', 'public');
        }

        // ================= CARD 1 =================
        if ($request->hasFile('img_card1')) {

            if ($konfigurasi->img_card1 && str_starts_with($konfigurasi->img_card1, 'konfigurasi/')) {
                Storage::disk('public')->delete($konfigurasi->img_card1);
            }

            $konfigurasi->img_card1 = $request->file('img_card1')
                ->store('konfigurasi', 'public');
        }

        // ================= CARD 2 =================
        if ($request->hasFile('img_card2')) {

            if ($konfigurasi->img_card2 && str_starts_with($konfigurasi->img_card2, 'konfigurasi/')) {
                Storage::disk('public')->delete($konfigurasi->img_card2);
            }

            $konfigurasi->img_card2 = $request->file('img_card2')
                ->store('konfigurasi', 'public');
        }

        // ================= TEXT =================
        $konfigurasi->nama_card1 = $request->nama_card1;
        $konfigurasi->nama_card2 = $request->nama_card2;

        $konfigurasi->save();

        return redirect()->route('dashboard')
            ->with('success', 'Konfigurasi web berhasil diupdate.');
    }
}