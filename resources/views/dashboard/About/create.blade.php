@extends('layouts.dashboard')

@section('page-title', 'Tambah About')

@section('dashboard-content')
<div class="p-8 bg-gray-50 min-h-screen">
    <div class="max-w-3xl mx-auto">

        <!-- Header Page -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8 border-b border-gray-200 pb-6">
            <div>
                <h2 class="text-3xl font-bold text-gray-800 tracking-tight">Tambah About</h2>
                <p class="text-gray-500 mt-2 text-sm">Tambahkan konten About baru.</p>
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

        <form action="{{ route('dashboard.about.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf

            <!-- Card -->
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                <div class="p-6 md:p-8 border-b border-gray-50 bg-gray-50/30">
                    <h3 class="text-lg font-bold text-gray-800">Informasi About</h3>
                </div>

                <div class="p-6 md:p-8 space-y-6">

                    <!-- Small Title -->
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-gray-700">Small Title <span class="text-red-500">*</span></label>
                        <input type="text" name="small_title"
                            class="w-full px-4 py-3.5 bg-gray-50 border border-gray-200 rounded-xl"
                            required>
                    </div>

                    <!-- Title -->
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-gray-700">Title <span class="text-red-500">*</span></label>
                        <input type="text" name="title"
                            class="w-full px-4 py-3.5 bg-gray-50 border border-gray-200 rounded-xl"
                            required>
                    </div>

                    <!-- Description -->
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-gray-700">Description <span class="text-red-500">*</span></label>
                        <textarea name="description" rows="4"
                            class="w-full px-4 py-3.5 bg-gray-50 border border-gray-200 rounded-xl resize-none"
                            required></textarea>
                    </div>

                </div>
            </div>

            <!-- Upload Image -->
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                <div class="p-6 md:p-8 border-b border-gray-50 bg-gray-50/30 flex items-center justify-between">
                    <h3 class="text-lg font-bold text-gray-800">Upload Gambar About</h3>
                    <span class="text-xs text-gray-400 font-medium">* Wajib diisi</span>
                </div>

                <div class="p-6 md:p-8 space-y-6">

                    <div class="space-y-3">
                        <label class="block text-sm font-semibold text-gray-700">
                            Foto About <span class="text-red-500">*</span>
                        </label>

                        <div class="relative group">
                            <label for="image"
                                class="flex flex-col items-center justify-center w-full h-60 border-2 border-dashed border-[#2E4239]/30 rounded-2xl cursor-pointer bg-[#2E4239]/5 hover:bg-[#2E4239]/10 transition-all duration-300 relative overflow-hidden">

                                <!-- Placeholder -->
                                <div class="flex flex-col items-center justify-center pt-5 pb-6 text-center z-10" id="upload-placeholder">
                                    <div class="w-20 h-20 rounded-full bg-white flex items-center justify-center mb-4 shadow-md group-hover:scale-110 transition-transform duration-300">
                                        <i class="fas fa-image text-4xl text-[#2E4239]"></i>
                                    </div>
                                    <p class="text-base text-[#2E4239] font-bold mb-1">Klik untuk upload foto</p>
                                    <p class="text-sm text-gray-500">atau drag file ke area ini</p>
                                    <span class="mt-3 px-3 py-1 bg-white text-xs text-gray-500 rounded-full border border-gray-200">
                                        JPG, PNG (Max. 2MB)
                                    </span>
                                </div>

                                <!-- Preview -->
                                <div id="file-info"
                                    class="hidden absolute inset-0 bg-white/95 flex flex-col items-center justify-center z-20 backdrop-blur-sm">
                                    <div class="w-16 h-16 rounded-full bg-green-50 flex items-center justify-center mb-3 shadow-md border border-green-100">
                                        <i class="fas fa-check text-2xl text-green-600"></i>
                                    </div>
                                    <p class="text-sm font-bold text-gray-800 mb-1" id="file-name">filename.jpg</p>
                                    <p class="text-xs text-gray-500 bg-gray-100 px-2 py-1 rounded">Klik untuk mengganti</p>
                                </div>

                                <input id="image" name="image" type="file" class="hidden" accept="image/*" required>
                            </label>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Action -->
            <div class="flex flex-col sm:flex-row justify-end gap-4 pt-4 border-t border-gray-200">
                <a href="{{ route('dashboard.about.index') }}"
                    class="inline-flex justify-center items-center px-8 py-4 border border-gray-300 shadow-sm text-base font-medium rounded-xl text-gray-700 bg-white hover:bg-gray-50">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali
                </a>

                <button type="submit"
                    class="inline-flex justify-center items-center px-12 py-4 text-base font-bold rounded-xl text-white bg-[#2E4239] hover:bg-[#1a2a22] shadow-lg hover:shadow-xl">
                    <i class="fas fa-save mr-2"></i> Simpan About
                </button>
            </div>

        </form>
    </div>
</div>

<script>
    const fileInput = document.getElementById('image');
    const fileInfo = document.getElementById('file-info');
    const fileNameDisplay = document.getElementById('file-name');
    const uploadPlaceholder = document.getElementById('upload-placeholder');

    fileInput.addEventListener('change', function(e) {
        const fileName = e.target.files[0]?.name;
        if (fileName) {
            fileNameDisplay.textContent = fileName;
            fileInfo.classList.remove('hidden');
            uploadPlaceholder.classList.add('opacity-0');
        } else {
            fileInfo.classList.add('hidden');
            uploadPlaceholder.classList.remove('opacity-0');
        }
    });
</script>
@endsection