<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ulasan Terkirim - Mao Place</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        * { font-family: 'Poppins', sans-serif; }
        .fade-in { animation: fadeIn 0.5s ease-out; }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen flex items-center justify-center p-4">
    
    <div class="max-w-md w-full fade-in">
        <div class="bg-white rounded-2xl shadow-lg p-8 text-center border border-gray-100">
            
            <!-- Tombol Kembali -->
            <div class="text-left mb-6">
                <a href="{{ route('home') }}" class="inline-flex items-center gap-2 text-gray-500 hover:text-[#1A2E25] transition-colors duration-200 font-medium text-sm">
                    <i class="fas fa-arrow-left"></i>
                    Kembali ke Home
                </a>
            </div>

            <!-- Icon Success (Menggunakan warna Hijau Mao Place atau Green Standard) -->
            <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6 shadow-sm">
                <i class="fas fa-check text-green-600 text-3xl"></i>
            </div>

            <!-- Judul -->
            <h1 class="text-2xl font-bold text-gray-800 mb-2">Ulasan Terkirim!</h1>
            <p class="text-lg font-medium text-green-600 mb-6">Terima Kasih Atas Ulasan Anda</p>

            <!-- Pesan -->
            <div class="bg-blue-50 border border-blue-100 rounded-xl p-4 mb-8">
                <div class="flex flex-col gap-2">
                    <i class="fas fa-smile-wink text-blue-400 text-xl mb-1"></i>
                    <p class="text-blue-800 text-sm leading-relaxed">
                        Pendapat Anda sangat berarti bagi kami. Masukan Anda membantu <strong>Mao Place</strong> memberikan pelayanan yang lebih baik lagi.
                    </p>
                </div>
            </div>

            <!-- Tombol Lihat Review (Opsional - Agar user bisa melihat ulasannya) -->
            <!-- <a href="#" class="block w-full bg-[#1A2E25] text-white py-3 rounded-xl font-bold shadow-lg shadow-green-900/10 hover:bg-[#14241d] transition mb-6">
                Lihat Semua Ulasan
            </a> -->

            <!-- Info Tambahan -->
            <div class="text-xs text-gray-400 space-y-2 border-t border-gray-100 pt-6">
                <p>Mao Place Malang</p>
                <div class="flex justify-center gap-4 text-gray-400">
                    <span><i class="fab fa-whatsapp"></i> 0812-3456-7890</span>
                    <span><i class="fas fa-envelope"></i> admin@maoplace.com</span>
                </div>
            </div>
        </div>
    </div>

</body>
</html>