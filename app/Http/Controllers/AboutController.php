<?php

namespace App\Http\Controllers;

use App\Models\About;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AboutController extends Controller
{
    // ================= FRONTEND =================
    public function index()
    {
        // Ambil semua About, urut berdasarkan id
        $abouts = About::orderBy('id', 'asc')->get();
        return view('section.about', compact('abouts'));
    }

    // ================= DASHBOARD =================
    public function dashboardIndex()
    {
        // Ambil semua About untuk dashboard
        $abouts = About::orderBy('id', 'asc')->get();
        return view('dashboard.about.index', compact('abouts'));
    }

    public function create()
    {
        return view('dashboard.about.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'small_title' => 'required|string|max:255',
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'image'       => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $imagePath = $request->file('image')->store('abouts', 'public');

        About::create([
            'small_title' => $request->small_title,
            'title'       => $request->title,
            'description' => $request->description,
            'image'       => $imagePath,
        ]);

        return redirect()->route('dashboard.about.index')
            ->with('success', 'About berhasil ditambahkan');
    }

    public function edit($id)
    {
        $about = About::findOrFail($id);
        return view('dashboard.about.edit', compact('about'));
    }

    public function update(Request $request, $id)
    {
        $about = About::findOrFail($id);

        $request->validate([
            'small_title' => 'required|string|max:255',
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $imagePath = $about->image;

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($imagePath && Storage::disk('public')->exists($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }
            $imagePath = $request->file('image')->store('abouts', 'public');
        }

        $about->update([
            'small_title' => $request->small_title,
            'title'       => $request->title,
            'description' => $request->description,
            'image'       => $imagePath,
        ]);

        return redirect()->route('dashboard.about.index')
            ->with('success', 'About berhasil diperbarui');
    }

    public function destroy($id)
    {
        $about = About::findOrFail($id);

        if ($about->image && Storage::disk('public')->exists($about->image)) {
            Storage::disk('public')->delete($about->image);
        }

        $about->delete();

        return redirect()->route('dashboard.about.index')
            ->with('success', 'About berhasil dihapus');
    }
}
