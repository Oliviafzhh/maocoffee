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
            <a href="{{ route('home') }}" 
               onclick="return scrollToTop()" 
               class="no-underline text-[#f7f7f7] font-normal transition-colors duration-300 [text-shadow:1px_1px_2px_rgba(0,0,0,0.3)] hover:text-[#ccc]">Home</a>
        </li>
        <li>
            <a href="#menu" 
               onclick="return smoothScrollToSection('menu')" 
               class="no-underline text-[#f7f7f7] font-normal transition-colors duration-300 hover:text-[#ccc]">
               Menu
            </a>
        </li>
        <li>
            <a href="#about" 
               onclick="return smoothScrollToSection('about')" 
               class="no-underline text-[#f7f7f7] font-normal transition-colors duration-300 hover:text-[#ccc]">
               About
            </a>
        </li>
        <li>
            <a href="#review" 
               onclick="return smoothScrollToSection('review')" 
               class="no-underline text-[#f7f7f7] font-normal transition-colors duration-300 [text-shadow:1px_1px_2px_rgba(0,0,0,0.3)] hover:text-[#ccc]">
               Review
            </a>
        </li>
        <li>
            <a href="{{ route('reservasi.create') }}" 
               class="no-underline text-[#f7f7f7] font-normal transition-colors duration-300 [text-shadow:1px_1px_2px_rgba(0,0,0,0.3)] hover:text-[#ccc]">
               Reservasi
            </a>
        </li>
    </ul>
</nav>

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

<script>
// Fungsi utama untuk scroll tepat ke posisi section
function smoothScrollToSection(targetId) {
    const targetElement = document.getElementById(targetId);
    if (!targetElement) {
        console.warn(`Element dengan id '${targetId}' tidak ditemukan`);
        return false;
    }

    // Hitung posisi element
    const elementRect = targetElement.getBoundingClientRect();
    
    // Posisi yang diinginkan: atas element berada di atas viewport
    // Kita bisa atur berapa offset dari atas viewport
    const offsetFromTop = 0; // Jarak dari atas viewport (sesuaikan dengan tinggi header)
    const targetPosition = elementRect.top + window.pageYOffset - offsetFromTop;
    
    // Pastikan tidak scroll melebihi batas bawah halaman
    const maxScroll = document.documentElement.scrollHeight - window.innerHeight;
    const finalPosition = Math.min(targetPosition, maxScroll);
    
    // Durasi scroll berdasarkan jarak
    const currentPosition = window.pageYOffset;
    const distance = Math.abs(finalPosition - currentPosition);
    const duration = Math.min(1200, Math.max(500, distance * 0.5)); // Durasi dinamis
    
    console.log(`Scrolling to ${targetId}: from ${currentPosition} to ${finalPosition}, distance: ${distance}, duration: ${duration}ms`);

    // Animate scroll
    animateScroll(currentPosition, finalPosition, duration);
    
    // Update URL hash
    history.replaceState(null, null, `#${targetId}`);
    
    return false; // Prevent default
}

// Fungsi animasi dengan easing yang presisi
function animateScroll(start, end, duration) {
    let startTime = null;
    
    function animation(currentTime) {
        if (startTime === null) startTime = currentTime;
        const elapsed = currentTime - startTime;
        const progress = Math.min(elapsed / duration, 1);
        
        // Gunakan easing function yang smooth di akhir
        const easeProgress = easeInOutCubic(progress);
        
        // Hitung posisi saat ini
        const currentPos = start + (end - start) * easeProgress;
        
        // Scroll ke posisi yang tepat
        window.scrollTo(0, Math.round(currentPos));
        
        // Hentikan jika sudah selesai atau sudah mencapai target
        if (elapsed < duration && Math.abs(window.pageYOffset - end) > 1) {
            requestAnimationFrame(animation);
        } else {
            // Pastikan posisi akhir tepat
            window.scrollTo(0, end);
        }
    }
    
    requestAnimationFrame(animation);
}

// Easing functions
function easeInOutCubic(t) {
    return t < 0.5 ? 4 * t * t * t : 1 - Math.pow(-2 * t + 2, 3) / 2;
}

function easeOutQuart(t) {
    return 1 - Math.pow(1 - t, 4);
}

// Handler untuk nav home
function handleNavClick(target) {
    if (target === 'home') {
        smoothScrollToPosition(0, 800); // Scroll ke paling atas
        return false;
    }
    return true;
}

// Fungsi untuk scroll ke posisi tertentu
function smoothScrollToPosition(targetPosition, duration = 800) {
    const startPosition = window.pageYOffset;
    animateScroll(startPosition, targetPosition, duration);
    history.replaceState(null, null, window.location.pathname);
}

// Event listener untuk semua link
document.addEventListener('DOMContentLoaded', function() {
    // Untuk link dengan hash
    document.querySelectorAll('a[href^="#"]').forEach(link => {
        link.addEventListener('click', function(e) {
            const href = this.getAttribute('href');
            if (href === '#') return;
            
            const targetId = href.substring(1);
            if (document.getElementById(targetId)) {
                e.preventDefault();
                smoothScrollToSection(targetId);
            }
        });
    });
    
    // Untuk link home
    document.querySelectorAll('a[href="{{ route("home") }}"]').forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            smoothScrollToPosition(0, 800);
        });
    });
});
</script>