<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservasi - Mao Place</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        body { font-family: 'Poppins', sans-serif; }
        input[type=number]::-webkit-inner-spin-button, 
        input[type=number]::-webkit-outer-spin-button { 
            -webkit-appearance: none; margin: 0; 
        }

        .fade-in { animation: fadeIn 0.3s ease-in; }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(5px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body class="bg-[#F8F9FA] text-gray-800">

    <!-- HEADER: DIPERBAIKI SESUAI GAMBAR (Putih, Simpel, Ikon Bulat) -->
    <header class="bg-white py-4 sticky top-0 z-50 shadow-sm border-b border-gray-100">
        <div class="container mx-auto px-4 lg:px-8">
            <div class="flex items-center gap-4">
                <!-- 1. Tombol Kembali (Hanya Panah <) -->
                <a href="{{ route('home') }}" class="w-10 h-10 flex items-center justify-center text-gray-800 hover:bg-gray-100 rounded-full transition text-xl">
                    <i class="fas fa-chevron-left"></i>
                </a>

                <!-- 2. Logo Bulat & Teks Reservasi -->
                <div class="flex items-center gap-3">
                    <!-- Lingkaran Logo Hijau Gelap -->
                    <div class="w-9 h-9 bg-[#1A2E25] rounded-full flex items-center justify-center text-white">
                        <!-- Ikon M atau Utensils (Ganti img jika ada logo asli) -->
                        <i class="fas fa-utensils text-sm"></i>
                        <!-- <img src="{{ asset('image/LOGO.png') }}" class="w-full h-full object-cover rounded-full"> -->
                    </div>
                    <!-- Teks Reservasi -->
                    <span class="text-xl font-bold text-[#1A2E25]">Reservasi</span>
                </div>
            </div>
        </div>
    </header>

    <div class="container mx-auto px-4 lg:px-8 py-8">
        <!-- Form Utama -->
        <form id="reservasiForm" action="{{ route('reservasi.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
                
                <!-- === KOLOM KIRI: INPUT DATA & PILIH PAKET === -->
                <div class="lg:col-span-2 space-y-8">
                    
                    <!-- Card 1: Data Reservasi -->
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 lg:p-8">
                        <h2 class="text-xl font-bold text-[#1A2E25] mb-6">Data Reservasi</h2>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Nama -->
                            <div class="space-y-2">
                                <label class="text-sm font-semibold text-gray-700">Nama Lengkap <span class="text-red-500">*</span></label>
                                <input type="text" name="nama_reservasi" required
                                    class="w-full px-4 py-3 bg-white border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#1A2E25] focus:border-transparent transition placeholder-gray-400"
                                    placeholder="Masukkan nama lengkap">
                            </div>

                            <!-- No Telepon -->
                            <div class="space-y-2">
                                <label class="text-sm font-semibold text-gray-700">No Telepon <span class="text-red-500">*</span></label>
                                <input type="number" name="no_hp" required
                                    class="w-full px-4 py-3 bg-white border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#1A2E25] focus:border-transparent transition placeholder-gray-400"
                                    placeholder="Contoh: 081234567890">
                            </div>

                            <!-- Tanggal -->
                            <div class="space-y-2">
                                <label class="text-sm font-semibold text-gray-700">Tanggal Reservasi <span class="text-red-500">*</span></label>
                                <input type="date" name="tgl_reservasi" required min="{{ date('Y-m-d') }}"
                                    class="w-full px-4 py-3 bg-white border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#1A2E25] focus:border-transparent transition text-gray-700">
                            </div>

                            <!-- Jam -->
                            <div class="space-y-2">
                                <label class="text-sm font-semibold text-gray-700">Jam Reservasi <span class="text-red-500">*</span></label>
                                <div class="relative">
                                    <select name="jam_reservasi" required
                                        class="w-full px-4 py-3 bg-white border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#1A2E25] focus:border-transparent appearance-none transition cursor-pointer text-gray-700">
                                        <option value="">Pilih Jam</option>
                                        @for($i = 9; $i <= 22; $i++)
                                            @php
                                                $jam = str_pad($i, 2, '0', STR_PAD_LEFT);
                                                $jam_next = str_pad($i + 1, 2, '0', STR_PAD_LEFT);
                                                $val = "$jam:00 - $jam_next:00";
                                            @endphp
                                            <option value="{{ $val }}">{{ $val }}</option>
                                        @endfor
                                    </select>
                                    <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none text-gray-500">
                                        <i class="fas fa-chevron-down text-xs"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Card 2: Pilih Paket (Grid Layout) -->
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 lg:p-8">
                        <h2 class="text-xl font-bold text-[#1A2E25] mb-6">Pilih Paket</h2>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            @foreach($pakets as $paket)
                            <div class="group border border-gray-200 rounded-2xl p-4 hover:border-[#1A2E25] hover:shadow-lg transition-all duration-300 bg-white flex flex-col h-full relative">
                                <!-- Image -->
                                <div class="relative h-48 mb-4 overflow-hidden rounded-xl bg-gray-100">
                                    @if($paket->image_paket)
                                        <img src="{{ asset('storage/' . $paket->image_paket) }}" 
                                             alt="{{ $paket->nama_paket }}" 
                                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-gray-400">
                                            <i class="fas fa-image text-3xl"></i>
                                        </div>
                                    @endif
                                </div>

                                <!-- Info Paket -->
                                <div class="flex-1 flex flex-col">
                                    <h3 class="font-bold text-lg text-gray-900 mb-2">{{ $paket->nama_paket }}</h3>
                                    <p class="text-sm text-gray-500 mb-4 line-clamp-2 leading-relaxed">
                                        {{ $paket->deeskripsi_menu ?? 'Deskripsi paket tersedia.' }}
                                    </p>
                                    
                                    <div class="flex items-end justify-between mt-auto pt-4 border-t border-gray-50">
                                        <div>
                                            <span class="text-lg font-bold text-[#1A2E25]">Rp {{ number_format($paket->harga_paket, 0, ',', '.') }}</span>
                                        </div>
                                        
                                        <!-- Tombol Plus Minus -->
                                        <div class="flex items-center gap-3 bg-gray-50 p-1 rounded-lg border border-gray-100">
                                            <button type="button" 
                                                class="w-7 h-7 rounded bg-white text-gray-600 shadow-sm border border-gray-200 hover:bg-gray-100 flex items-center justify-center transition btn-minus"
                                                data-id="{{ $paket->id_paket }}"
                                                data-price="{{ $paket->harga_paket }}"
                                                data-name="{{ $paket->nama_paket }}">
                                                <i class="fas fa-minus text-xs"></i>
                                            </button>
                                            
                                            <!-- Tampilan angka di kartu -->
                                            <span class="w-6 text-center font-bold text-gray-800 text-sm qty-display" id="qty-card-{{ $paket->id_paket }}">0</span>
                                                
                                            <button type="button" 
                                                class="w-7 h-7 rounded bg-[#1A2E25] text-white shadow-sm hover:bg-[#14241d] flex items-center justify-center transition btn-plus"
                                                data-id="{{ $paket->id_paket }}"
                                                data-price="{{ $paket->harga_paket }}"
                                                data-name="{{ $paket->nama_paket }}">
                                                <i class="fas fa-plus text-xs"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- === KOLOM KANAN: SIDEBAR DETAIL (Sticky) === -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 sticky top-24">
                        <h2 class="text-xl font-bold text-[#1A2E25] mb-6">Detail Pesanan</h2>
                        
                        <!-- List Pesanan (Dibuat mirip gambar referensi) -->
                        <div class="min-h-[100px] mb-6">
                            <!-- State Kosong -->
                            <div id="empty-state" class="flex flex-col items-center justify-center py-8 text-gray-400 border-2 border-dashed border-gray-100 rounded-xl">
                                <i class="fas fa-clipboard-list text-3xl mb-2 opacity-20"></i>
                                <span class="text-sm">Belum ada pesanan</span>
                            </div>
                            
                            <!-- Container List Item -->
                            <div id="pesanan-list" class="space-y-4 hidden">
                                <!-- Item akan dimasukkan lewat JS di sini -->
                            </div>
                        </div>

                        <!-- Total -->
                        <div class="flex justify-between items-center py-4 border-t border-gray-100 mb-6">
                            <span class="font-bold text-lg text-gray-800">Total</span>
                            <span class="font-bold text-xl text-[#1A2E25]" id="total-harga">Rp 0</span>
                        </div>

                        <!-- Catatan -->
                        <div class="mb-6 space-y-2">
                            <label class="text-sm font-bold text-gray-700">Catatan Tambahan</label>
                            <textarea name="catatan" rows="3" 
                                class="w-full px-4 py-3 bg-white border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#1A2E25] text-sm transition placeholder-gray-400"
                                placeholder="Contoh: Tidak pakai pedas, meja dekat jendela, dll."></textarea>
                        </div>

                        <!-- Info DP -->
                        <div class="bg-[#FFF8E1] border border-[#FFE082] rounded-xl p-3 flex items-start gap-3 mb-6">
                            <i class="fas fa-info-circle text-[#F57F17] mt-0.5"></i>
                            <p class="text-xs text-[#F57F17] leading-relaxed">
                                <span class="font-bold">Info Pembayaran:</span><br>
                                Wajib membayar DP 50% dari total harga.
                            </p>
                        </div>

                        <!-- Upload Bukti -->
                        <div class="mb-6 space-y-2">
                            <label class="text-sm font-bold text-gray-700">Upload Bukti Pembayaran <span class="text-red-500">*</span></label>
                            <input type="file" name="bukti_pembayaran" required accept="image/*"
                                class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-bold file:bg-[#1A2E25] file:text-white hover:file:bg-[#14241d] border border-gray-300 rounded-xl cursor-pointer bg-white py-2 px-2">
                            <p class="text-[10px] text-gray-400">Format: jpeg, png, jpg | Max: 2MB</p>
                        </div>

                        <!-- Metode Pembayaran (BARCODE & REKENING) -->
                        <div class="mb-6">
                            <h3 class="font-bold text-gray-800 text-sm mb-3">Metode Pembayaran</h3>
                            <div class="bg-gray-50 rounded-xl p-4 border border-gray-200">
                                <!-- Barcode QRIS -->
                                <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-100 mb-4 flex flex-col items-center justify-center">
                                    <!-- Placeholder Barcode -->
                                    <div class="w-32 h-32 bg-gray-200 rounded-lg flex items-center justify-center mb-2">
                                        <i class="fas fa-qrcode text-5xl text-gray-400"></i>
                                    </div>
                                    <p class="text-[10px] text-gray-500 text-center font-medium">Scan QRIS untuk pembayaran</p>
                                </div>
                                
                                <!-- Rekening Bank -->
                            <div class="space-y-2">
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-600">BCA</span>
                                    <span class="font-medium">228743924028249</span>
                                </div>
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-600">BRI</span>
                                    <span class="font-medium">0232U82219313912</span>
                                </div>
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-600">MANDIRI</span>
                                    <span class="font-medium">247987427947</span>
                                </div>
                            </div>
                        </div>


                        <!-- Tombol Submit -->
                        <button type="submit" class="w-full bg-[#1A2E25] text-white py-4 rounded-xl font-bold shadow-lg shadow-green-900/10 hover:bg-[#14241d] hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-300 flex items-center justify-center gap-2">
                            <i class="fas fa-check-circle"></i>
                            Booking Sekarang
                        </button>
                    </div>
                </div>

            </div>
            
            <!-- Container Input Hidden untuk dikirim ke Controller -->
            <div id="hidden-inputs-container"></div>
        </form>
    </div>

    <!-- JAVASCRIPT ALGORITMA: DISEDERHANAKAN AGAR PASTI JALAN -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            
            // 1. Inisialisasi State
            let cart = {}; 
            
            // Format Rupiah Helper
            const formatRupiah = (angka) => {
                return new Intl.NumberFormat('id-ID', { 
                    style: 'currency', 
                    currency: 'IDR',
                    minimumFractionDigits: 0,
                    maximumFractionDigits: 0
                }).format(angka).replace('IDR', 'Rp'); 
            };

            // 2. Event Listener untuk Tombol Plus & Minus
            document.body.addEventListener('click', function(e) {
                const btnPlus = e.target.closest('.btn-plus');
                const btnMinus = e.target.closest('.btn-minus');

                if (btnPlus) {
                    const id = btnPlus.dataset.id;
                    const price = parseInt(btnPlus.dataset.price);
                    const name = btnPlus.dataset.name;
                    addItem(id, name, price);
                }

                if (btnMinus) {
                    const id = btnMinus.dataset.id;
                    const price = parseInt(btnMinus.dataset.price);
                    const name = btnMinus.dataset.name;
                    removeItem(id, name, price);
                }
            });

            // 3. Fungsi Tambah Item
            function addItem(id, name, price) {
                if (!cart[id]) {
                    cart[id] = { id: id, name: name, price: price, qty: 0 };
                }
                cart[id].qty++;
                updateUI();
            }

            // 4. Fungsi Kurang Item
            function removeItem(id, name, price) {
                if (cart[id] && cart[id].qty > 0) {
                    cart[id].qty--;
                    // Jika 0, bisa kita biarkan objectnya tapi qty 0
                }
                updateUI();
            }

            // 5. Fungsi Update Tampilan (Algoritma Inti)
            function updateUI() {
                const listContainer = document.getElementById('pesanan-list');
                const emptyState = document.getElementById('empty-state');
                const totalEl = document.getElementById('total-harga');
                const hiddenContainer = document.getElementById('hidden-inputs-container');
                
                // Reset HTML
                listContainer.innerHTML = '';
                hiddenContainer.innerHTML = '';
                
                let grandTotal = 0;
                let hasItem = false;
                let index = 0;

                // Loop semua item di cart
                for (let key in cart) {
                    const item = cart[key];
                    
                    // Update angka di kartu paket (Grid Kiri)
                    const cardQtyEl = document.getElementById(`qty-card-${item.id}`);
                    if (cardQtyEl) cardQtyEl.textContent = item.qty;

                    if (item.qty > 0) {
                        hasItem = true;
                        const subtotal = item.qty * item.price;
                        grandTotal += subtotal;

                        // Render List Item di Sidebar (Kanan)
                        const htmlItem = `
                            <div class="flex justify-between items-start pb-3 border-b border-gray-50 last:border-0 fade-in">
                                <div>
                                    <div class="font-bold text-gray-800 text-sm">${item.name}</div>
                                    <div class="text-xs text-gray-400 mt-1">x${item.qty} @ ${formatRupiah(item.price)}</div>
                                </div>
                                <div class="font-bold text-gray-800 text-sm">${formatRupiah(subtotal)}</div>
                            </div>
                        `;
                        listContainer.innerHTML += htmlItem;

                        // Buat Input Hidden untuk Laravel Controller
                        // Format: pakets[0][id] dan pakets[0][qty]
                        const inputId = document.createElement('input');
                        inputId.type = 'hidden';
                        inputId.name = `pakets[${index}][id]`;
                        inputId.value = item.id;
                        
                        const inputQty = document.createElement('input');
                        inputQty.type = 'hidden';
                        inputQty.name = `pakets[${index}][qty]`;
                        inputQty.value = item.qty;

                        hiddenContainer.appendChild(inputId);
                        hiddenContainer.appendChild(inputQty);
                        
                        index++;
                    }
                }

                // Toggle Tampilan Kosong/Isi
                if (hasItem) {
                    emptyState.classList.add('hidden');
                    listContainer.classList.remove('hidden');
                } else {
                    emptyState.classList.remove('hidden');
                    listContainer.classList.add('hidden');
                }

                // Update Total Harga Akhir
                totalEl.textContent = formatRupiah(grandTotal);
            }

            // 6. Validasi Submit
            document.getElementById('reservasiForm').addEventListener('submit', function(e) {
                let totalQty = 0;
                for (let key in cart) {
                    totalQty += cart[key].qty;
                }
                
                if (totalQty === 0) {
                    e.preventDefault();
                    alert('Mohon pilih minimal satu paket menu sebelum booking.');
                }
            });

        });
    </script>
</body>
</html>