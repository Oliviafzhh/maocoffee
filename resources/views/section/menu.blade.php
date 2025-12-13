@php use Illuminate\Support\Facades\Storage; @endphp

<section class="scroll-mt-[120px] flex w-full p-20 px-10 flex-col items-start gap-2.5" id="menu" class="menu-section">
    <div class="flex flex-col items-center gap-[46px] self-stretch">
        <div class="flex w-[587px] flex-col items-center gap-2">
            <div class="self-stretch text-center font-poppins text-[40px] font-medium leading-normal tracking-[-0.8px] text-[#2E4239]">Recommended <span class="text-[#D4B3AA]">food</span> and <span class="text-[#D4B3AA]">drink</span> to fill your <span class="text-[#D4B3AA]">heart</span></div>
            <div class="self-stretch text-center font-plus-jakarta-sans text-base font-light leading-[120%] tracking-[0.08px] text-[#2E4239]">Lot of combination you can choose</div>
        </div>

        <div class="flex flex-col items-center gap-10 self-stretch">

            <!-- kategori -->
            <div class="flex items-center gap-6">
                <a href="#" 
                   data-category="Food"
                   class="menu-category flex justify-center items-center py-2 px-6 text-center font-poppins text-base font-normal leading-normal tracking-[-0.32px] {{ $kategoriAktif == 'Food' ? 'rounded-[29.878px] bg-[#2E4239] text-white' : 'text-[#51615A]' }}">
                    Food
                </a>
                <a href="#" 
                   data-category="Drink"
                   class="menu-category flex justify-center items-center py-2 px-6 text-center font-poppins text-base font-normal leading-normal tracking-[-0.32px] {{ $kategoriAktif == 'Drink' ? 'rounded-[29.878px] bg-[#2E4239] text-white' : 'text-[#51615A]' }}">
                    Drink
                </a>
                <a href="#" 
                   data-category="Snack"
                   class="menu-category flex justify-center items-center py-2 px-6 text-center font-poppins text-base font-normal leading-normal tracking-[-0.32px] {{ $kategoriAktif == 'Snack' ? 'rounded-[29.878px] bg-[#2E4239] text-white' : 'text-[#51615A]' }}">
                    Snack
                </a>
            </div>

            <!-- Container untuk konten menu yang akan di-update -->
            <div id="menu-content">
                <!-- INCLUDE PARTIAL DI SINI -->
                @include('partials.menu-content')
            </div>
        </div>
    </div>
</section>

<!-- JavaScript untuk AJAX -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Handle kategori click
    document.querySelectorAll('.menu-category').forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const category = this.getAttribute('data-category');
            loadMenuContent(category, 1);
        });
    });

    // Fungsi untuk menangani event delegation untuk tombol navigasi
    document.getElementById('menu-content').addEventListener('click', function(e) {
        // Handle previous button click
        if (e.target.closest('.prev-btn')) {
            e.preventDefault();
            const prevBtn = e.target.closest('.prev-btn');
            const category = prevBtn.getAttribute('data-category');
            const currentPage = parseInt(prevBtn.getAttribute('data-page'));
            
            if (currentPage > 1) {
                loadMenuContent(category, currentPage - 1);
            }
        }
        
        // Handle next button click
        if (e.target.closest('.next-btn')) {
            e.preventDefault();
            const nextBtn = e.target.closest('.next-btn');
            const category = nextBtn.getAttribute('data-category');
            const currentPage = parseInt(nextBtn.getAttribute('data-page'));
            const totalPages = {{ $totalPages }};
            
            if (currentPage < totalPages) {
                loadMenuContent(category, currentPage + 1);
            }
        }
        
        // Handle page indicator click (optional - jika ingin dinonaktifkan)
        if (e.target.closest('.page-indicator')) {
            e.preventDefault();
            // Nonaktifkan klik pada progress indicator
            console.log('Progress indicator tidak aktif. Gunakan tombol panah untuk navigasi.');
            
            // Jika ingin diaktifkan, uncomment kode berikut:
            // const indicator = e.target.closest('.page-indicator');
            // const page = indicator.getAttribute('data-page');
            // const category = indicator.getAttribute('data-category');
            // loadMenuContent(category, parseInt(page));
        }
    });

    function loadMenuContent(category, page) {
        console.log('Loading content for:', category, 'page:', page);
        
        // Show loading
        const menuContent = document.getElementById('menu-content');
        menuContent.innerHTML = '<div class="flex justify-center items-center py-20"><div class="animate-spin rounded-full h-12 w-12 border-b-2 border-[#2E4239]"></div></div>';
        
        // AJAX request
        fetch(`/menu-content?category=${encodeURIComponent(category)}&page=${page}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.text();
            })
            .then(html => {
                menuContent.innerHTML = html;
                
                // Update active category style
                updateActiveCategory(category);
            })
            .catch(error => {
                console.error('Error:', error);
                menuContent.innerHTML = '<div class="flex justify-center py-10 text-red-500">Error: ' + error.message + '</div>';
            });
    }
    
    function updateActiveCategory(activeCategory) {
        const categoryLinks = document.querySelectorAll('.menu-category');
        
        categoryLinks.forEach(link => {
            const linkCategory = link.getAttribute('data-category');
            
            // Hapus semua styles
            link.classList.remove('rounded-[29.878px]', 'bg-[#2E4239]', 'text-white');
            link.classList.add('text-[#51615A]');
            link.style.backgroundColor = '';
            link.style.color = '';
            
            // Tambahkan style untuk kategori aktif
            if (linkCategory === activeCategory) {
                link.classList.remove('text-[#51615A]');
                link.classList.add('rounded-[29.878px]', 'bg-[#2E4239]', 'text-white');
            }
        });
    }
    
    // Set active category saat halaman pertama kali dimuat
    updateActiveCategory('{{ $kategoriAktif }}');
});
</script>