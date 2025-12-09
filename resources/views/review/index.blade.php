<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ulasan Pelanggan - Mao Place</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        body { font-family: 'Poppins', sans-serif; }
        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        .fade-in { animation: fadeIn 0.5s ease-out; }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body class="bg-[#F8F9FA] text-gray-800">

    <!-- HEADER -->
    <header class="bg-white py-4 sticky top-0 z-50 shadow-sm border-b border-gray-100">
        <div class="container mx-auto px-4 lg:px-8">
            <div class="flex items-center justify-between">
                
                <!-- Kiri: Tombol Kembali & Judul -->
                <div class="flex items-center gap-4">
                    <a href="{{ route('home') }}" class="w-10 h-10 flex items-center justify-center text-gray-800 hover:bg-gray-100 rounded-full transition text-xl">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 bg-[#1A2E25] rounded-full flex items-center justify-center text-white">
                            <i class="fas fa-star text-sm"></i>
                        </div>
                        <span class="text-xl font-bold text-[#1A2E25]">Ulasan Pelanggan</span>
                    </div>
                </div>

                <!-- Kanan: Tombol Tulis Review (Desktop) -->
                <a href="{{ route('review.create') }}" class="hidden md:flex items-center gap-2 bg-[#1A2E25] text-white px-5 py-2.5 rounded-xl font-semibold shadow-lg shadow-green-900/10 hover:bg-[#14241d] transition transform hover:-translate-y-0.5">
                    <i class="fas fa-pen text-sm"></i>
                    <span>Tulis Ulasan</span>
                </a>
            </div>
        </div>
    </header>

    <!-- CONTENT -->
    <div class="container mx-auto px-4 lg:px-8 py-8 fade-in">
        
        <!-- Tombol Tulis Review (Mobile Only) -->
        <div class="md:hidden mb-8">
            <a href="{{ route('review.create') }}" class="w-full flex items-center justify-center gap-2 bg-[#1A2E25] text-white px-5 py-3 rounded-xl font-bold shadow-lg shadow-green-900/10">
                <i class="fas fa-pen text-sm"></i>
                <span>Tulis Ulasan Saya</span>
            </a>
        </div>

        @if(isset($reviews) && $reviews->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($reviews as $review)
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition duration-300 flex flex-col h-full group">
                    
                    <!-- Header Card: Nama & Tanggal -->
                    <div class="flex justify-between items-start mb-4">
                        <div class="flex items-center gap-3">
                            <!-- Avatar / Inisial -->
                            @if($review->profil_review)
                                <img src="{{ asset('storage/' . $review->profil_review) }}" class="w-10 h-10 rounded-full object-cover border border-gray-100">
                            @else
                                <div class="w-10 h-10 rounded-full bg-[#1A2E25]/10 flex items-center justify-center text-[#1A2E25] font-bold text-lg uppercase">
                                    {{ substr($review->nama_review, 0, 1) }}
                                </div>
                            @endif
                            
                            <div>
                                <h3 class="font-bold text-gray-900 text-sm line-clamp-1">{{ $review->nama_review }}</h3>
                                <p class="text-xs text-gray-400">{{ $review->created_at ? $review->created_at->diffForHumans() : 'Baru saja' }}</p>
                            </div>
                        </div>

                        <!-- Rating Bintang -->
                        <div class="flex items-center gap-1 bg-yellow-50 px-2 py-1 rounded-lg border border-yellow-100">
                            <i class="fas fa-star text-yellow-400 text-xs"></i>
                            <span class="font-bold text-gray-700 text-xs">{{ $review->bintang }}.0</span>
                        </div>
                    </div>

                    <!-- Isi Review -->
                    <div class="mb-4 flex-1">
                        <p class="text-gray-600 text-sm leading-relaxed italic relative pl-3 border-l-2 border-gray-200 line-clamp-3">
                            "{{ $review->deskripsi_review }}"
                        </p>
                    </div>

                    <!-- Foto Review (Jika Ada) -->
                    @if($review->profil_review)
                    <div class="mt-auto pt-4 border-t border-gray-50">
                        <div class="h-48 rounded-xl overflow-hidden bg-gray-50 relative cursor-pointer" onclick="openModal('{{ asset('storage/' . $review->profil_review) }}')">
                            <!-- UBAH DI SINI: object-cover menjadi object-contain -->
                            <img src="{{ asset('storage/' . $review->profil_review) }}" 
                                 alt="Foto Review" 
                                 class="w-full h-full object-contain bg-gray-100 transition duration-500 group-hover:scale-105">
                            
                            <div class="absolute inset-0 bg-black/0 group-hover:bg-black/10 transition flex items-center justify-center opacity-0 group-hover:opacity-100">
                                <i class="fas fa-search-plus text-white text-2xl drop-shadow-md"></i>
                            </div>
                        </div>
                    </div>
                    @endif

                </div>
                @endforeach
            </div>
        @else
            <!-- Empty State (Jika belum ada review) -->
            <div class="flex flex-col items-center justify-center py-20 text-center">
                <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mb-6">
                    <i class="far fa-comments text-4xl text-gray-300"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-2">Belum ada ulasan</h3>
                <p class="text-gray-500 max-w-sm mb-8 text-sm">Jadilah yang pertama membagikan pengalaman makan Anda di Mao Place!</p>
                <a href="{{ route('review.create') }}" class="bg-white border-2 border-[#1A2E25] text-[#1A2E25] px-6 py-3 rounded-xl font-bold hover:bg-[#1A2E25] hover:text-white transition">
                    Tulis Ulasan Sekarang
                </a>
            </div>
        @endif

    </div>

    <!-- MODAL FOTO (Simple Lightbox) -->
    <div id="imageModal" class="fixed inset-0 z-[60] hidden bg-black/90 backdrop-blur-sm flex items-center justify-center p-4" onclick="closeModal()">
        <img id="modalImage" src="" class="max-w-full max-h-[90vh] rounded-lg shadow-2xl object-contain">
        <button class="absolute top-4 right-4 text-white hover:text-gray-300 text-3xl focus:outline-none">
            &times;
        </button>
    </div>

    <script>
        function openModal(src) {
            document.getElementById('modalImage').src = src;
            document.getElementById('imageModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('imageModal').classList.add('hidden');
        }
    </script>

</body>
</html>