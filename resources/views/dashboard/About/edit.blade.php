@extends('layouts.dashboard')

@section('page-title', 'Edit About')

@php
function aboutImage($path) {
if (!$path) return asset('image/no-image.png');

if (file_exists(public_path('storage/' . $path))) {
return asset('storage/' . $path);
}

if (file_exists(public_path($path))) {
return asset($path);
}

return asset('image/no-image.png');
}
@endphp

@section('dashboard-content')
<div class="p-8 bg-gray-50 min-h-screen">
    <div class="max-w-4xl mx-auto">

        <!-- Header Page -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8 border-b border-gray-200 pb-6">
            <div>
                <h2 class="text-3xl font-bold text-gray-800 tracking-tight">Edit About</h2>
                <p class="text-gray-500 mt-2 text-sm">Perbarui informasi halaman About.</p>
            </div>
        </div>

        @if($errors->any())
        <div class="bg-red-50 border border-red-200 rounded-xl p-4 mb-8 flex items-start gap-3 shadow-sm">
            <div class="bg-red-100 p-2 rounded-full text-red-600 shrink-0">
                <i class="fas fa-exclamation-triangle text-sm"></i>
            </div>
            <div>
                <h3 class="text-red-800 font-semibold text-sm">Terdapat kesalahan input</h3>
                <ul class="list-disc list-inside text-red-600 text-xs mt-1 space-y-1">
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
        @endif

        <form action="{{ route('dashboard.about.update', $about->id) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf
            @method('PUT')

            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                <div class="p-6 md:p-8 border-b border-gray-50 bg-gray-50/30">
                    <h3 class="text-lg font-bold text-gray-800">Informasi About</h3>
                </div>

                <div class="p-6 md:p-8 space-y-8">

                    <!-- Small Title -->
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-gray-700">Small Title <span class="text-red-500">*</span></label>
                        <input type="text" name="small_title"
                            value="{{ old('small_title', $about->small_title) }}"
                            class="w-full px-4 py-3.5 bg-gray-50 border border-gray-200 rounded-xl"
                            required>
                    </div>

                    <!-- Title -->
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-gray-700">Title <span class="text-red-500">*</span></label>
                        <input type="text" name="title"
                            value="{{ old('title', $about->title) }}"
                            class="w-full px-4 py-3.5 bg-gray-50 border border-gray-200 rounded-xl"
                            required>
                    </div>

                    <!-- Description -->
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-gray-700">Deskripsi <span class="text-red-500">*</span></label>
                        <textarea name="description" rows="4"
                            class="w-full px-4 py-3.5 bg-gray-50 border border-gray-200 rounded-xl resize-none"
                            required>{{ old('description', $about->description) }}</textarea>
                    </div>

                    
                    <!-- Gambar -->
                    <div class="space-y-8 pt-4 border-t border-gray-100">

                        <div>
                            <label class="block text-base font-bold text-gray-800 mb-2">Gambar Saat Ini</label>
                            <div class="w-full h-96 bg-gray-50 border rounded-2xl flex items-center justify-center overflow-hidden">
                                <img src="{{ aboutImage($about->image) }}" class="object-cover w-full h-full">
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label class="block text-base font-bold text-gray-800">Ganti Gambar (Opsional)</label>
                            <input type="file" name="image"
                                class="w-full border border-gray-300 rounded-xl p-3 bg-white"
                                accept="image/*">
                        </div>

                    </div>
                </div>
            </div>

            <div class="flex justify-end gap-4">
                <a href="{{ route('dashboard.about.index') }}"
                    class="px-6 py-3 rounded-xl bg-gray-200 text-gray-700 hover:bg-gray-300">
                    Kembali
                </a>

                <button type="submit"
                    class="px-8 py-3 rounded-xl bg-[#2E4239] text-white font-bold hover:bg-[#1a2a22]">
                    Update About
                </button>
            </div>

        </form>
    </div>
</div>
@endsection