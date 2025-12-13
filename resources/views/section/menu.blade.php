@php use Illuminate\Support\Facades\Storage; @endphp

    <section class="flex w-full p-20 px-10 flex-col items-start gap-2.5" id="menu">
        <div class="flex flex-col items-center gap-[46px] self-stretch">
            <div class="flex w-[587px] flex-col items-center gap-2">
                <div class="self-stretch text-center font-poppins text-[40px] font-medium leading-normal tracking-[-0.8px] text-[#2E4239]">Recommended <span class="text-[#D4B3AA]">food</span> and <span class="text-[#D4B3AA]">drink</span> to fill your <span class="text-[#D4B3AA]">heart</span></div>
                <div class="self-stretch text-center font-plus-jakarta-sans text-base font-light leading-[120%] tracking-[0.08px] text-[#2E4239]">Lot of combination you can choose</div>
            </div>

            <div class="flex flex-col items-center gap-10 self-stretch">

                <!-- KATEGORI: Food, Drink, DAN SNACK (Sudah Ditambahkan) -->
                <div class="flex items-center gap-6">
                    <!-- Food -->
                    <a href="#"
                        data-category="Food"
                        class="menu-category flex justify-center items-center py-2 px-6 text-center font-poppins text-base font-normal leading-normal tracking-[-0.32px] {{ $kategoriAktif == 'Food' ? 'rounded-[29.878px] bg-[#2E4239] text-white' : 'text-[#51615A]' }}">
                        Food
                    </a>

                    <!-- Drink -->
                    <a href="#"
                        data-category="Drink"
                        class="menu-category flex justify-center items-center py-2 px-6 text-center font-poppins text-base font-normal leading-normal tracking-[-0.32px] {{ $kategoriAktif == 'Drink' ? 'rounded-[29.878px] bg-[#2E4239] text-white' : 'text-[#51615A]' }}">
                        Drink
                    </a>

                    <!-- Snack (BARU DITAMBAHKAN) -->
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

            // Handle page indicator click
            document.addEventListener('click', function(e) {
                if (e.target.classList.contains('page-indicator')) {
                    e.preventDefault();
                    const page = e.target.getAttribute('data-page');
                    const category = e.target.getAttribute('data-category');
                    loadMenuContent(category, parseInt(page));
                }
            });

            // Handle previous button click
            document.addEventListener('click', function(e) {
                if (e.target.closest('.prev-btn')) {
                    e.preventDefault();
                    const currentPage = {
                        {
                            $page
                        }
                    };
                    const currentCategory = '{{ $kategoriAktif }}';
                    if (currentPage > 1) {
                        loadMenuContent(currentCategory, currentPage - 1);
                    }
                }
            });

            // Handle next button click
            document.addEventListener('click', function(e) {
                if (e.target.closest('.next-btn')) {
                    e.preventDefault();
                    const currentPage = {
                        {
                            $page
                        }
                    };
                    const currentCategory = '{{ $kategoriAktif }}';
                    const totalPages = {
                        {
                            $totalPages
                        }
                    };
                    if (currentPage < totalPages) {
                        loadMenuContent(currentCategory, currentPage + 1);
                    }
                }
            });

            function loadMenuContent(category, page) {
                console.log('Loading content for:', category, page);

                // Show loading
                document.getElementById('menu-content').innerHTML = '<div class="flex justify-center py-10">Loading...</div>';

                // AJAX request
                fetch(`/menu-content?category=${category}&page=${page}`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error(`HTTP error! status: ${response.status}`);
                        }
                        return response.text();
                    })
                    .then(html => {
                        document.getElementById('menu-content').innerHTML = html;

                        // Update active category style dengan INLINE STYLE
                        document.querySelectorAll('.menu-category').forEach(link => {
                            const linkCategory = link.getAttribute('data-category');

                            if (linkCategory === category) {
                                link.classList.add('rounded-[29.878px]', 'text-white');
                                link.classList.remove('text-[#51615A]');
                                // Tambahkan inline style untuk background dan warna teks
                                link.style.backgroundColor = '#2E4239';
                                link.style.borderRadius = '29.878px';
                                link.style.color = '#ffffff';
                            } else {
                                link.classList.remove('rounded-[29.878px]', 'text-white');
                                link.classList.add('text-[#51615A]');
                                // Hapus inline style
                                link.style.backgroundColor = '';
                                link.style.borderRadius = '';
                                link.style.color = '';
                            }
                        });
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        document.getElementById('menu-content').innerHTML = '<div class="flex justify-center py-10 text-red-500">Error: ' + error.message + '</div>';
                    });
            }
        });
    </script>