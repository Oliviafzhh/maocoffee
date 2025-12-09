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
            'profil_review'    => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = [
            'nama_review'      => $request->nama_review,
            'bintang'          => $request->bintang,
            'deskripsi_review' => $request->deskripsi_review,
        ];

        if ($request->hasFile('profil_review')) {
            $path = $request->file('profil_review')->store('reviews', 'public');
            $data['profil_review'] = $path;
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

    // --- TAMBAHAN BARU UNTUK DETAIL REVIEW ---
    public function show($id)
    {
        $review = Review::findOrFail($id);
        return view('dashboard.reviews.show', compact('review'));
    }

    public function destroy($id)
    {
        $review = Review::findOrFail($id);
        
        if ($review->profil_review) {
            if (Storage::disk('public')->exists($review->profil_review)) {
                Storage::disk('public')->delete($review->profil_review);
            }
        }
        
        $review->delete();

        return redirect()->route('dashboard.reviews.index')
            ->with('success', 'Review berhasil dihapus.');
    }
}