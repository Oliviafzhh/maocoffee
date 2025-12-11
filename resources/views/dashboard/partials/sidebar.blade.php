<aside class="w-64 bg-[#2E4239] text-white min-h-screen flex flex-col shadow-2xl relative z-30">

    <div class="p-6">
        <img src="{{ asset('image/LOGO WHITE.png') }}" alt="MaoPlace Logo" class="w-auto h-auto">
    </div>

    <nav class="flex-1 px-4 space-y-6 overflow-y-auto custom-scrollbar mt-2">

        <div>
            <p class="px-4 text-[10px] font-extrabold text-[#D4B3AA] tracking-[0.2em] uppercase mb-2 opacity-80">
                Main Menu
            </p>
            <ul class="space-y-1">
                <li>
                    <a href="{{ route('dashboard') }}"
                        class="flex items-center px-4 py-3 rounded-xl text-gray-200 hover:bg-white/10 hover:text-white transition-all duration-300 group">
                        <span class="w-8 h-8 flex items-center justify-center rounded-lg bg-white/5 text-[#D4B3AA] group-hover:bg-[#D4B3AA] group-hover:text-[#2E4239] transition-colors duration-300 mr-3 shadow-sm">
                            <i class="fas fa-home text-xs"></i>
                        </span>
                        <span class="font-medium text-sm tracking-wide">Home</span>
                    </a>
                </li>

                <li>
                    <details class="group">
                        <summary class="flex items-center justify-between px-4 py-3 rounded-xl text-gray-200 hover:bg-white/10 hover:text-white cursor-pointer list-none transition-all duration-300">
                            <div class="flex items-center">
                                <span class="w-8 h-8 flex items-center justify-center rounded-lg bg-white/5 text-[#D4B3AA] group-hover:bg-[#D4B3AA] group-hover:text-[#2E4239] transition-colors duration-300 mr-3 shadow-sm">
                                    <i class="fas fa-utensils text-xs"></i>
                                </span>
                                <span class="font-medium text-sm tracking-wide">Menu</span>
                            </div>
                            <i class="fas fa-chevron-right text-[10px] opacity-60 transition-transform duration-300 group-open:rotate-90"></i>
                        </summary>

                        <ul class="mt-2 ml-4 border-l border-white/10 space-y-1 pl-3">
                            <li>
                                <a href="{{ route('dashboard.menu.index') }}?kategori=Food" class="flex items-center px-4 py-2 text-sm text-gray-400 hover:text-[#D4B3AA] hover:translate-x-1 transition-all duration-300 rounded-lg">
                                    <i class="fas fa-utensil-spoon mr-3 text-xs opacity-70"></i>
                                    Makanan
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('dashboard.menu.index') }}?kategori=Drink" class="flex items-center px-4 py-2 text-sm text-gray-400 hover:text-[#D4B3AA] hover:translate-x-1 transition-all duration-300 rounded-lg">
                                    <i class="fas fa-coffee mr-3 text-xs opacity-70"></i>
                                    Minuman
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('dashboard.menu.index') }}?kategori=Snack" class="flex items-center px-4 py-2 text-sm text-gray-400 hover:text-[#D4B3AA] hover:translate-x-1 transition-all duration-300 rounded-lg">
                                    <i class="fas fa-cookie mr-3 text-xs opacity-70"></i>
                                    Snack
                                </a>
                            </li>
                        </ul>
                    </details>
                </li>
            </ul>
        </div>

        <div>
            <p class="px-4 text-[10px] font-extrabold text-[#D4B3AA] tracking-[0.2em] uppercase mb-2 opacity-80">
                Management
            </p>
            <ul class="space-y-1">


                <li>
                    <a href="{{ route('dashboard.paket.index') }}" class="flex items-center px-4 py-3 rounded-xl text-gray-200 hover:bg-white/10 hover:text-white transition-all duration-300 group">
                        <span class="w-8 h-8 flex items-center justify-center rounded-lg bg-white/5 text-[#D4B3AA] group-hover:bg-[#D4B3AA] group-hover:text-[#2E4239] transition-colors duration-300 mr-3 shadow-sm">
                            <i class="fas fa-box text-xs"></i>
                        </span>
                        <span class="font-medium text-sm tracking-wide">Paket</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('dashboard.about.index') }}"
                        class="flex items-center px-4 py-3 rounded-xl text-gray-200 hover:bg-white/10 hover:text-white transition-all duration-300 group">
                        <span class="w-8 h-8 flex items-center justify-center rounded-lg bg-white/5 text-[#D4B3AA] group-hover:bg-[#D4B3AA] group-hover:text-[#2E4239] transition-colors duration-300 mr-3 shadow-sm">
                            <i class="fas fa-image"></i>
                            </i>
                        </span>
                        <span class="font-medium text-sm tracking-wide">About</span>
                    </a>
                </li>


                <li>
                    <a href="{{ route('dashboard.reviews.index') }}" class="flex items-center px-4 py-3 rounded-xl text-gray-200 hover:bg-white/10 hover:text-white transition-all duration-300 group">
                        <span class="w-8 h-8 flex items-center justify-center rounded-lg bg-white/5 text-[#D4B3AA] group-hover:bg-[#D4B3AA] group-hover:text-[#2E4239] transition-colors duration-300 mr-3 shadow-sm">
                            <i class="fas fa-star text-xs"></i>
                        </span>
                        <span class="font-medium text-sm tracking-wide">Review</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('dashboard.reservasi.index') }}" class="flex items-center px-4 py-3 rounded-xl text-gray-200 hover:bg-white/10 hover:text-white transition-all duration-300 group">
                        <span class="w-8 h-8 flex items-center justify-center rounded-lg bg-white/5 text-[#D4B3AA] group-hover:bg-[#D4B3AA] group-hover:text-[#2E4239] transition-colors duration-300 mr-3 shadow-sm">
                            <i class="fas fa-calendar-alt text-xs"></i>
                        </span>
                        <span class="font-medium text-sm tracking-wide">Reservasi</span>
                    </a>
                </li>
            </ul>
        </div>

        <div class="pb-10">
            <p class="px-4 text-[10px] font-extrabold text-[#D4B3AA] tracking-[0.2em] uppercase mb-2 opacity-80">
                Settings
            </p>
            <ul class="space-y-1">
                <li>
                    <a href="{{ route('dashboard.password.change') }}" class="flex items-center px-4 py-3 rounded-xl text-gray-200 hover:bg-white/10 hover:text-white transition-all duration-300 group">
                        <span class="w-8 h-8 flex items-center justify-center rounded-lg bg-white/5 text-[#D4B3AA] group-hover:bg-[#D4B3AA] group-hover:text-[#2E4239] transition-colors duration-300 mr-3 shadow-sm">
                            <i class="fas fa-key text-xs"></i>
                        </span>
                        <span class="font-medium text-sm tracking-wide">Ubah Password</span>
                    </a>
                </li>
            </ul>
        </div>

    </nav>
</aside>