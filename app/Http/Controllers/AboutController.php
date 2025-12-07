<?php

namespace App\Http\Controllers;

use App\Models\About;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AboutController extends Controller
{
    /**
     * Menampilkan data About ke halaman frontend (home)
     */
    public function index()
    {
        $about = About::first();
        return view('section.about', compact('about'));
    }

    /**
     * Menampilkan gambar About di dashboard
     */
    public function dashboardIndex()
    {
        $about = About::all();
        return view('dashboard.about.index', compact('about'));
    }

    /**
     * Form tambah gambar About
     */
    public function create()
    {
        return view('dashboard.about.create');
    }

    /**
     * Simpan gambar About
     */
    public function store(Request $request)
    {
        $request->validate([
            'img_about' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        // Upload file
        $path = $request->file('img_about')->store('about', 'public');

        About::create([
            'img_about' => $path
        ]);

        return redirect()
            ->route('dashboard.about.index')
            ->with('success', 'Gambar About berhasil ditambahkan');
    }

    /**
     * Form edit
     */
    public function edit($id)
    {
        $about = About::findOrFail($id);
        return view('dashboard.about.edit', compact('about'));
    }

    /**
     * Update gambar
     */
    public function update(Request $request, $id)
    {
        $about = About::findOrFail($id);

        $request->validate([
            'img_about' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $path = $about->img_about;

        // Jika upload baru
        if ($request->hasFile('img_about')) {
            // hapus file lama
            if ($path && Storage::disk('public')->exists($path)) {
                Storage::disk('public')->delete($path);
            }

            // upload baru
            $path = $request->file('img_about')->store('about', 'public');
        }

        $about->update(['img_about' => $path]);

        return redirect()
            ->route('dashboard.about.index')
            ->with('success', 'Gambar About berhasil diperbarui');
    }

    /**
     * Hapus data + gambar
     */
    public function destroy($id)
    {
        $about = About::findOrFail($id);

        if ($about->img_about && Storage::disk('public')->exists($about->img_about)) {
            Storage::disk('public')->delete($about->img_about);
        }

        $about->delete();

        return redirect()
            ->route('dashboard.about.index')
            ->with('success', 'Gambar About berhasil dihapus');
    }
}
