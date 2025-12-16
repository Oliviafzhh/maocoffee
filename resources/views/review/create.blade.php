<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tulis Ulasan - Mao Place</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        body { font-family: 'Poppins', sans-serif; }
        .fade-in { animation: fadeIn 0.4s ease-out; }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        /* Style Bintang Interaktif */
        .star-rating i { transition: transform 0.2s, color 0.2s; }
        .star-rating i:hover,
        .star-rating i.hovered {
            color: #FBBF24; /* Kuning Emas */
            transform: scale(1.2);
        }
        /* Custom Scrollbar */
        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            border-radius: 10px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #a1a1a1;
        }
    </style>
</head>
<body class="bg-[#F8F9FA] text-gray-800">

    <!-- HEADER -->
    <header class="bg-white py-4 sticky top-0 z-50 shadow-sm border-b border-gray-100">
        <div class="container mx-auto px-4 lg:px-8">
            <div class="flex items-center gap-4">
                <!-- Tombol Kembali -->
                <a href="{{ route('reviews.index') }}" class="w-10 h-10 flex items-center justify-center text-gray-800 hover:bg-gray-100 rounded-full transition text-xl">
                    <i class="fas fa-chevron-left"></i>
                </a>

                <!-- Judul -->
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 bg-[#1A2E25] rounded-full flex items-center justify-center text-white">
                        <i class="fas fa-edit text-sm"></i>
                    </div>
                    <span class="text-xl font-bold text-[#1A2E25]">Tulis Ulasan</span>
                </div>
            </div>
        </div>
    </header>

    <div class="container mx-auto px-4 lg:px-8 py-8 fade-in">
        <!-- Form Utama -->
        <form id="reviewForm" action="{{ route('review.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
                
                <!-- === KOLOM KIRI: INPUT DATA === -->
                <div class="lg:col-span-2 space-y-6">
                    
                    <!-- Kartu Input -->
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 lg:p-8">
                        <h2 class="text-xl font-bold text-[#1A2E25] mb-6 flex items-center gap-2">
                            <i class="far fa-smile"></i> Bagikan Pengalamanmu
                        </h2>
                        
                        <div class="space-y-6">
                            <!-- NAMA -->
                            <div class="space-y-2">
                                <label class="text-sm font-semibold text-gray-700">Nama Lengkap <span class="text-red-500">*</span></label>
                                <input type="text" name="nama_review" required
                                    class="w-full px-4 py-3 bg-white border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#1A2E25] focus:border-transparent transition placeholder-gray-400"
                                    placeholder="Contoh: Budi Santoso">
                            </div>

                            <!-- RATING BINTANG -->
                            <div class="space-y-2">
                                <label class="text-sm font-semibold text-gray-700">Beri Rating <span class="text-red-500">*</span></label>
                                <div class="bg-gray-50 border border-gray-200 rounded-xl p-4 flex flex-col items-center justify-center gap-2 transition hover:border-[#1A2E25]">
                                    <div class="flex items-center gap-3 star-rating">
                                        <!-- Input Hidden (Penyimpan Nilai) -->
                                        <input type="hidden" name="bintang" id="ratingInput" required>
                                        
                                        <!-- 5 Bintang -->
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="fas fa-star text-4xl cursor-pointer text-gray-300 transition-all duration-200" 
                                               data-value="{{ $i }}"
                                               onclick="setRating({{ $i }})"></i>
                                        @endfor
                                    </div>
                                    <span id="ratingText" class="text-sm font-medium text-[#1A2E25] mt-1">- Pilih Rating -</span>
                                </div>
                            </div>

                            <!-- DESKRIPSI -->
                            <div class="space-y-2">
                                <label class="text-sm font-semibold text-gray-700">Ulasan Anda <span class="text-red-500">*</span></label>
                                <textarea name="deskripsi_review" required rows="5"
                                    class="w-full px-4 py-3 bg-white border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#1A2E25] focus:border-transparent transition placeholder-gray-400 leading-relaxed"
                                    placeholder="Ceritakan rasa makanan, pelayanan, atau suasana tempatnya..."></textarea>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- === KOLOM KANAN: UPLOAD FOTO & SUBMIT === -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 sticky top-24">
                        <h2 class="text-xl font-bold text-[#1A2E25] mb-6 flex items-center gap-2">
                            <i class="fas fa-camera"></i> Foto Makanan
                        </h2>

                        <!-- UPLOAD FOTO PROFIL -->
                        <div class="mb-6 space-y-3">
                            <label class="text-sm font-bold text-gray-700">Foto Profil Anda (Opsional)</label>
                            
                            <div class="w-full h-32 bg-gray-50 border-2 border-dashed border-gray-300 rounded-xl flex flex-col items-center justify-center overflow-hidden relative group hover:border-[#1A2E25] transition cursor-pointer">
                                
                                <!-- Placeholder (Default) -->
                                <div id="profilPlaceholder" class="flex flex-col items-center text-gray-400 pointer-events-none transition-opacity duration-300">
                                    <i class="fas fa-user-circle text-2xl mb-2 group-hover:scale-110 transition"></i>
                                    <span class="text-xs text-center px-4">Klik untuk upload foto profil</span>
                                </div>
                                
                                <!-- Preview Foto Profil -->
                                <img id="profilPreview" src="" alt="Preview Foto Profil" class="hidden w-full h-full object-cover absolute inset-0 pointer-events-none transition-opacity duration-300">
                                
                                <!-- Tombol Hapus Foto Profil -->
                                <button type="button" id="removeProfilBtn" class="hidden absolute top-2 right-2 w-7 h-7 bg-red-500 text-white rounded-full flex items-center justify-center z-20 hover:bg-red-600 transition shadow-md">
                                    <i class="fas fa-times text-xs"></i>
                                </button>
                                
                                <input type="file" name="profil_review" id="profilInput" accept="image/*"
                                    class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                            </div>
                            <p class="text-[10px] text-gray-400 text-center">Format: jpg, png, jpeg | Max: 2MB</p>
                        </div>

                        <!-- UPLOAD FOTO MAKANAN -->
                        <div class="mb-6 space-y-3">
                            <label class="text-sm font-bold text-gray-700">Foto Makanan (Opsional)</label>
                            
                            <div class="w-full h-48 bg-gray-50 border-2 border-dashed border-gray-300 rounded-xl flex flex-col items-center justify-center overflow-hidden relative group hover:border-[#1A2E25] transition cursor-pointer">
                                
                                <!-- Placeholder (Default) -->
                                <div id="makananPlaceholder" class="flex flex-col items-center text-gray-400 pointer-events-none transition-opacity duration-300">
                                    <i class="fas fa-utensils text-3xl mb-2 group-hover:scale-110 transition"></i>
                                    <span class="text-xs text-center px-4">Klik untuk upload foto menu</span>
                                </div>
                                
                                <!-- Preview Foto Makanan -->
                                <img id="makananPreview" src="" alt="Preview Foto Makanan" class="hidden w-full h-full object-contain absolute inset-0 pointer-events-none transition-opacity duration-300 bg-white">
                                
                                <!-- Tombol Hapus Foto Makanan -->
                                <button type="button" id="removeMakananBtn" class="hidden absolute top-2 right-2 w-7 h-7 bg-red-500 text-white rounded-full flex items-center justify-center z-20 hover:bg-red-600 transition shadow-md">
                                    <i class="fas fa-times text-xs"></i>
                                </button>
                                
                                <input type="file" name="makanan_img" id="makananInput" accept="image/*"
                                    class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                            </div>
                            <p class="text-[10px] text-gray-400 text-center">Format: jpg, png, jpeg | Max: 2MB</p>
                        </div>

                        <!-- Info Box -->
                        <div class="bg-blue-50 border border-blue-100 rounded-xl p-4 mb-6">
                            <div class="flex items-start gap-3">
                                <i class="fas fa-info-circle text-blue-500 mt-1"></i>
                                <p class="text-xs text-blue-700 leading-relaxed">
                                    Foto makanan yang menarik akan membantu pelanggan lain memilih menu!
                                </p>
                            </div>
                        </div>

                        <!-- Tombol Kirim -->
                        <button type="submit" class="w-full bg-[#1A2E25] text-white py-4 rounded-xl font-bold shadow-lg shadow-green-900/10 hover:bg-[#14241d] hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-300 flex items-center justify-center gap-2">
                            <i class="fas fa-paper-plane"></i>
                            Kirim Ulasan
                        </button>
                    </div>
                </div>

            </div>
        </form>
    </div>

    <!-- JAVASCRIPT -->
    <script>
        // 1. Logic Rating Bintang
        const stars = document.querySelectorAll('.star-rating i');
        const ratingInput = document.getElementById('ratingInput');
        const ratingText = document.getElementById('ratingText');
        const ratingLabels = ["Sangat Buruk 😞", "Buruk 😕", "Cukup 🙂", "Baik 😊", "Sangat Baik 😍"];

        function setRating(value) {
            // Isi input hidden
            ratingInput.value = value;
            // Update teks label
            ratingText.textContent = ratingLabels[value - 1];
            
            // Update warna bintang
            stars.forEach(star => {
                const starValue = parseInt(star.getAttribute('data-value'));
                if (starValue <= value) {
                    star.classList.remove('text-gray-300');
                    star.classList.add('text-yellow-400');
                } else {
                    star.classList.remove('text-yellow-400');
                    star.classList.add('text-gray-300');
                }
            });
        }

        // Efek Hover
        stars.forEach(star => {
            star.addEventListener('mouseenter', function() {
                const hoverValue = parseInt(this.getAttribute('data-value'));
                stars.forEach(s => {
                    if (parseInt(s.getAttribute('data-value')) <= hoverValue) {
                        s.classList.add('text-yellow-200'); // Kuning pucat saat hover
                    }
                });
            });
            
            // Saat mouse pergi, kembalikan warna ke status 'selected'
            star.addEventListener('mouseleave', function() {
                stars.forEach(s => s.classList.remove('text-yellow-200'));
            });
        });

        // 2. Logic Preview Foto Profil
        const profilInput = document.getElementById('profilInput');
        const profilPreview = document.getElementById('profilPreview');
        const profilPlaceholder = document.getElementById('profilPlaceholder');
        const removeProfilBtn = document.getElementById('removeProfilBtn');

        profilInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                // Validasi ukuran file (max 2MB)
                if (file.size > 2 * 1024 * 1024) {
                    alert('Ukuran file maksimal 2MB');
                    this.value = '';
                    return;
                }
                
                // Validasi tipe file
                const validTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
                if (!validTypes.includes(file.type)) {
                    alert('Format file harus JPG, PNG, atau GIF');
                    this.value = '';
                    return;
                }
                
                const reader = new FileReader();
                reader.onload = function(e) {
                    profilPreview.src = e.target.result;
                    profilPreview.classList.remove('hidden');
                    profilPlaceholder.classList.add('hidden');
                    removeProfilBtn.classList.remove('hidden');
                }
                reader.readAsDataURL(file);
            }
        });

        // 3. Logic Preview Foto Makanan
        const makananInput = document.getElementById('makananInput');
        const makananPreview = document.getElementById('makananPreview');
        const makananPlaceholder = document.getElementById('makananPlaceholder');
        const removeMakananBtn = document.getElementById('removeMakananBtn');

        makananInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                // Validasi ukuran file (max 2MB)
                if (file.size > 2 * 1024 * 1024) {
                    alert('Ukuran file maksimal 2MB');
                    this.value = '';
                    return;
                }
                
                // Validasi tipe file
                const validTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
                if (!validTypes.includes(file.type)) {
                    alert('Format file harus JPG, PNG, atau GIF');
                    this.value = '';
                    return;
                }
                
                const reader = new FileReader();
                reader.onload = function(e) {
                    makananPreview.src = e.target.result;
                    makananPreview.classList.remove('hidden');
                    makananPlaceholder.classList.add('hidden');
                    removeMakananBtn.classList.remove('hidden');
                }
                reader.readAsDataURL(file);
            }
        });

        // 4. Fungsi Hapus Foto Profil
        removeProfilBtn.addEventListener('click', function(e) {
            e.stopPropagation(); // Mencegah event bubbling ke parent
            profilPreview.src = '';
            profilPreview.classList.add('hidden');
            profilPlaceholder.classList.remove('hidden');
            removeProfilBtn.classList.add('hidden');
            profilInput.value = '';
        });

        // 5. Fungsi Hapus Foto Makanan
        removeMakananBtn.addEventListener('click', function(e) {
            e.stopPropagation(); // Mencegah event bubbling ke parent
            makananPreview.src = '';
            makananPreview.classList.add('hidden');
            makananPlaceholder.classList.remove('hidden');
            removeMakananBtn.classList.add('hidden');
            makananInput.value = '';
        });

        // 6. Form Validation
        document.getElementById('reviewForm').addEventListener('submit', function(e) {
            const rating = document.getElementById('ratingInput').value;
            const nama = document.querySelector('input[name="nama_review"]').value.trim();
            const deskripsi = document.querySelector('textarea[name="deskripsi_review"]').value.trim();
            
            if (!rating) {
                e.preventDefault();
                alert('Harap berikan rating terlebih dahulu!');
                return;
            }
            
            if (!nama) {
                e.preventDefault();
                alert('Harap isi nama lengkap Anda!');
                return;
            }
            
            if (!deskripsi) {
                e.preventDefault();
                alert('Harap tulis ulasan Anda!');
                return;
            }
            
            // Validasi tambahan untuk deskripsi minimal karakter
            if (deskripsi.length < 10) {
                e.preventDefault();
                alert('Ulasan minimal 10 karakter!');
                return;
            }
        });
    </script>
</body>
</html>