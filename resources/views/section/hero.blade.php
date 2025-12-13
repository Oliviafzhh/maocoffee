<section class="bg-cover bg-center bg-no-repeat min-h-screen relative" style="background-image: url('{{ asset('image/bg.png') }}')">
    <!-- Overlay gelap -->
    <div class="absolute inset-0 bg-black/10 z-0"></div>

    <!-- Konten komponen -->
    <div class="text-[#f7f7f7] relative z-10">
        <header class="flex justify-between items-center py-[30px] px-[50px] w-full">
            <div class="flex items-center gap-10">
                @if($konfigurasi && $konfigurasi->logo_web)
                <img src="{{ asset('storage/' . $konfigurasi->logo_web) }}" alt="Logo Web" class="h-12">
                @else
                <div class="h-12 w-32 bg-gray-300 flex items-center justify-center text-gray-600">
                    Logo
                </div>
                @endif
                <nav>
                    <ul class="flex gap-8 list-none justify-center">
                        <li>
                            <a href="{{ route('home') }}" class="no-underline text-[#f7f7f7] font-normal transition-colors duration-300 [text-shadow:1px_1px_2px_rgba(0,0,0,0.3)] hover:text-[#ccc]">Home</a>
                        </li>
                        <li>
                            <a href="#menu" class="no-underline text-[#f7f7f7] font-normal transition-colors duration-300 hover:text-[#ccc]">Menu</a>
                        </li>
                        <li>
                            <a href="#about" class="no-underline text-[#f7f7f7] font-normal transition-colors duration-300 hover:text-[#ccc]">About</a>
                        </li>
                        <li>
                            <a href="{{ route('reviews.index') }}" class="no-underline text-[#f7f7f7] font-normal transition-colors duration-300 [text-shadow:1px_1px_2px_rgba(0,0,0,0.3)] hover:text-[#ccc]">Review</a>
                        </li>
                        <li>
                            <a href="{{ route('reservasi.create') }}" class="no-underline text-[#f7f7f7] font-normal transition-colors duration-300 [text-shadow:1px_1px_2px_rgba(0,0,0,0.3)] hover:text-[#ccc]">Reservasi</a>
                        </li>
                    </ul>
                </nav>

            </div>
            <div class="flex items-center gap-6">
                <div class="flex py-3 px-6 justify-center items-center gap-24 rounded-[20px] border border-white">
                    <input type="text" placeholder="Search" class="text-[#f7f7f7] text-[0.9rem] bg-transparent border-none outline-none">
                    <i class="fas fa-search pointer-events-none"></i>
                </div>

            </div>
        </header>

        <div class="flex flex-col justify-center pl-[50px] pb-[50px] relative overflow-hidden flex-grow min-h-[80vh]">
            <div class="absolute top-[25%] right-[50px] w-[335px] p-5">
                <p class="text-[0.9rem] leading-6 text-right text-[#f7f7f7]">Mao Place is a cozy place in malang where you can hangout with your friend and enjoy your meal with happy hearts</p>
            </div>
            <div class="absolute bottom-[80px] left-[50px] flex gap-7">
                @if($konfigurasi)
                <!-- Card 1 -->
                <div class="w-[208.28px] h-[248.02px] bg-white opacity-100 rounded-[25px] [box-shadow:0_4px_8px_rgba(0,0,0,0.1)] p-4 text-center overflow-hidden transition-transform duration-300 flex flex-col gap-2.5 items-start border-none relative rotate-[-7.558deg] -mr-2 z-2 hover:rotate-[-15deg] hover:scale-105">
                    @if($konfigurasi->img_card1)
                    <img src="{{ asset('storage/' . $konfigurasi->img_card1) }}" alt="{{ $konfigurasi->nama_card1 }}" class="w-full h-[75%] object-cover rounded-[20px] grayscale transition-filter duration-300 hover:grayscale-0">
                    @else
                    <div class="w-full h-[75%] bg-[#e0e0e0] rounded-[20px] flex items-center justify-center">
                        No Image
                    </div>
                    @endif
                    <p class="text-[1.1rem] text-[#2E4239] font-bold">{{ $konfigurasi->nama_card1 ?? 'Card 1' }}</p>
                    <img src="{{ asset('image/Union.png') }}" alt="" class="absolute bottom-[16px] right-[-40px]">
                </div>

                <!-- Card 2 -->
                <div class="w-[208.28px] h-[248.02px] bg-white opacity-100 rounded-[25px] [box-shadow:0_4px_8px_rgba(0,0,0,0.1)] p-4 text-center overflow-hidden transition-transform duration-300 flex flex-col gap-2.5 items-start border-none relative rotate-[7.861deg] -ml-2 top-[30px] z-1 hover:rotate-[15deg] hover:scale-105">
                    @if($konfigurasi->img_card2)
                    <img src="{{ asset('storage/' . $konfigurasi->img_card2) }}" alt="{{ $konfigurasi->nama_card2 }}" class="w-full h-[75%] object-cover rounded-[20px] grayscale transition-filter duration-300 hover:grayscale-0">
                    @else
                    <div class="w-full h-[75%] bg-[#e0e0e0] rounded-[20px] flex items-center justify-center">
                        No Image
                    </div>
                    @endif
                    <p class="text-[1.1rem] text-[#2E4239] font-bold">{{ $konfigurasi->nama_card2 ?? 'Card 2' }}</p>
                    <img src="{{ asset('image/Union.png') }}" alt="" class="absolute bottom-[16px] right-[-40px]">
                </div>
                @else
                <!-- Tampilan default jika tidak ada konfigurasi -->
                <div class="text-white">
                    <p>No configuration found. <a href="{{ route('konfigurasi.create') }}" class="underline">Create configuration first</a></p>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>