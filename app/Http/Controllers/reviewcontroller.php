<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ReviewController extends Controller
{
    // =========================================================
    // BAGIAN 1: PUBLIC (PELANGGAN)
    // =========================================================

    public function createPublic()
    {
        return view('review.create');
    }

    public function storePublic(Request $request)
    {
        $request->validate([
            'nama_review'      => 'required|string|max:255',
            'bintang'          => 'required|integer|min:1|max:5',
            'deskripsi_review' => 'required|string',
            'profil_review'    => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Foto profil
            'makanan_img'      => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Foto makanan (BARU)
        ]);

        $data = [
            'nama_review'      => $request->nama_review,
            'bintang'          => $request->bintang,
            'deskripsi_review' => $request->deskripsi_review,
        ];

        // Upload foto profil (jika ada)
        if ($request->hasFile('profil_review')) {
            $path = $request->file('profil_review')->store('reviews/profil', 'public');
            $data['profil_review'] = $path;
        }

        // Upload foto makanan (BARU)
        if ($request->hasFile('makanan_img')) {
            $path = $request->file('makanan_img')->store('reviews/makanan', 'public');
            $data['makanan_img'] = $path;
        }

        Review::create($data);

        return view('review.success');
    }

    public function index()
    {
        $reviews = Review::orderBy('id_review', 'desc')->take(9)->get();
        return view('review.index', compact('reviews'));
    }


    // =========================================================
    // BAGIAN 2: ADMIN DASHBOARD
    // =========================================================

    public function dashboardIndex()
    {
        $reviews = Review::orderBy('id_review', 'desc')->get();
        return view('dashboard.reviews.index', compact('reviews'));
    }

    public function show($id)
    {
        $review = Review::findOrFail($id);
        return view('dashboard.reviews.show', compact('review'));
    }

    public function destroy($id)
    {
        $review = Review::findOrFail($id);
        
        // Hapus foto profil jika ada
        if ($review->profil_review) {
            if (Storage::disk('public')->exists($review->profil_review)) {
                Storage::disk('public')->delete($review->profil_review);
            }
        }
        
        // Hapus foto makanan jika ada (BARU)
        if ($review->makanan_img) {
            if (Storage::disk('public')->exists($review->makanan_img)) {
                Storage::disk('public')->delete($review->makanan_img);
            }
        }
        
        $review->delete();

        return redirect()->route('dashboard.reviews.index')
            ->with('success', 'Review berhasil dihapus.');
    }
}