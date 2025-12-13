<footer class="bg-[#2E4239] flex flex-col items-start gap-6 w-full p-[26px_25px] text-white">
    <div class="flex justify-between items-start self-stretch">
        <!-- Logo Section -->
        <div class="w-[152px] h-[143px] bg-gray-300 bg-cover bg-center bg-no-repeat rounded-3xl">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3951.6120465146355!2d112.61180957476756!3d-7.935523592088423!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e788346ec872b2b%3A0xabcd4fbde20cab8b!2smao.place!5e0!3m2!1sen!2sid!4v1763517503126!5m2!1sen!2sid" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" class="rounded-3xl"></iframe>
        </div>

        <!-- Navigation & Contact Section -->
        <div class="flex items-start gap-[117px] w-[745px]">
            <!-- Our Cafe Links -->
            <div class="flex flex-col items-start gap-4 w-[89px] flex-shrink-0">
                <div class="text-white font-['Plus_Jakarta_Sans'] text-[18px] font-semibold leading-normal">Our Cafe</div>
                <ul class="flex flex-col items-start gap-2 text-white font-['Plus_Jakarta_Sans'] text-[14px] font-normal leading-relaxed list-none p-0 m-0">
                    <li>
                        <a href="{{ route('home') }}" class="no-underline text-white hover:text-gray-300 transition-colors duration-300 cursor-pointer">Home</a>
                    </li>
                    <li>
                        <a href="#about" class="no-underline text-white hover:text-gray-300 transition-colors duration-300 cursor-pointer">About</a>
                    </li>
                    <li>
                        <a href="#menu" class="no-underline text-white hover:text-gray-300 transition-colors duration-300 cursor-pointer">Menu</a>
                    </li>
                    <li>
                        <a href="{{ route('reviews.index') }}" class="no-underline text-white hover:text-gray-300 transition-colors duration-300 cursor-pointer">Review</a>
                    </li>
                    <li>
                        <a href="{{ route('reservasi.create') }}" class="no-underline text-white hover:text-gray-300 transition-colors duration-300 cursor-pointer">Reservasi</a>
                    </li>
                </ul>
            </div>


            <!-- Contacts Section -->
            <div class="flex flex-col items-start gap-4">
                <div class="text-white font-['Plus_Jakarta_Sans'] text-[18px] font-semibold leading-normal">Contacts</div>
                <ul class="flex flex-col items-start gap-3 text-white font-['Plus_Jakarta_Sans'] text-[14px] font-normal leading-relaxed list-none p-0 m-0">
                    <li class="flex items-center gap-2 hover:text-gray-300">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="currentColor">
                            <path d="M14.93 16C13.2447 16 11.5167 15.578 9.746 14.734C7.97533 13.89 6.32733 12.705 4.802 11.179C3.28867 9.65367 2.11 8.00867 1.266 6.244C0.422 4.47933 0 2.75467 0 1.07C0 0.77 0.1 0.516667 0.3 0.31C0.5 0.103333 0.75 0 1.05 0H3.523C3.795 0 4.03233 0.0856666 4.235 0.257C4.43767 0.428333 4.57467 0.648 4.646 0.916L5.142 3.3C5.18867 3.58 5.18033 3.82433 5.117 4.033C5.05367 4.24167 4.94267 4.41267 4.784 4.546L2.59 6.592C3.00067 7.33667 3.45433 8.02867 3.951 8.668C4.44767 9.30733 4.97767 9.913 5.541 10.485C6.121 11.065 6.74567 11.605 7.415 12.105C8.08433 12.6043 8.819 13.0757 9.619 13.519L11.758 11.342C11.9207 11.1667 12.1037 11.051 12.307 10.995C12.5097 10.9397 12.7343 10.9287 12.981 10.962L15.084 11.392C15.356 11.4587 15.5767 11.5957 15.746 11.803C15.9153 12.0103 16 12.2477 16 12.515V14.95C16 15.25 15.8967 15.5 15.69 15.7C15.4833 15.9 15.23 16 14.93 16Z" />
                        </svg>
                        (62) 765 897 908
                    </li>
                    <li class="flex items-center gap-2 hover:text-gray-300">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="14" viewBox="0 0 18 14" fill="currentColor">
                            <path d="M1.616 14C1.15533 14 0.771 13.846 0.463 13.538C0.155 13.23 0.000666667 12.8453 0 12.384V1.616C0 1.15533 0.154333 0.771 0.463 0.463C0.771667 0.155 1.15567 0.000666667 1.615 0H16.385C16.845 0 17.229 0.154333 17.537 0.463C17.845 0.771666 17.9993 1.156 18 1.616V12.385C18 12.845 17.8457 13.2293 17.537 13.538C17.2283 13.8467 16.8443 14.0007 16.385 14H1.616ZM9 7.116L1 1.885V12.385C1 12.5643 1.05767 12.7117 1.173 12.827C1.28833 12.9423 1.436 13 1.616 13H16.385C16.5643 13 16.7117 12.9423 16.827 12.827C16.9423 12.7117 17 12.564 17 12.384V1.884L9 7.116ZM9 6L16.692 1H1.308L9 6ZM1 1.885V1V12.385C1 12.5643 1.05767 12.7117 1.173 12.827C1.28833 12.9423 1.436 13 1.616 13H1V1.885Z" />
                        </svg>
                        info@maocoffee.com
                    </li>
                    <li class="flex items-start gap-2 hover:text-gray-300 max-w-[300px]">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="21" viewBox="0 0 16 21" fill="currentColor" class="flex-shrink-0 mt-0.5">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M7.262 20.134C7.262 20.134 0 14.018 0 8C0 5.87827 0.842855 3.84344 2.34315 2.34315C3.84344 0.842855 5.87827 0 8 0C10.1217 0 12.1566 0.842855 13.6569 2.34315C15.1571 3.84344 16 5.87827 16 8C16 14.018 8.738 20.134 8.738 20.134C8.334 20.506 7.669 20.502 7.262 20.134ZM8 11.5C8.45963 11.5 8.91475 11.4095 9.33939 11.2336C9.76403 11.0577 10.1499 10.7999 10.4749 10.4749C10.7999 10.1499 11.0577 9.76403 11.2336 9.33939C11.4095 8.91475 11.5 8.45963 11.5 8C11.5 7.54037 11.4095 7.08525 11.2336 6.66061C11.0577 6.23597 10.7999 5.85013 10.4749 5.52513C10.1499 5.20012 9.76403 4.94231 9.33939 4.76642C8.91475 4.59053 8.45963 4.5 8 4.5C7.07174 4.5 6.1815 4.86875 5.52513 5.52513C4.86875 6.1815 4.5 7.07174 4.5 8C4.5 8.92826 4.86875 9.8185 5.52513 10.4749C6.1815 11.1313 7.07174 11.5 8 11.5Z" />
                        </svg>
                        <span>Jl. Simpang Candi Panggung No.123A, Mojolangu, Kec. Lowokwaru, Kota Malang.</span>
                    </li>
                </ul>
            </div>

            <!-- Social Media Section (Kosong untuk sekarang) -->
            <div class="flex flex-col items-start gap-4">
                <div class="text-white font-['Plus_Jakarta_Sans'] text-[18px] font-semibold leading-normal">Find Us!</div>

                <!-- icon sosial media -->
                <div class="flex flex-col gap-2">
                    <!-- Instagram -->
                    <a href="https://www.instagram.com/mao.place/?hl=en" target="_blank" class="flex items-center gap-2 hover:opacity-70 transition-opacity text-white">
                        <i class="fab fa-instagram fa-lg"></i>
                        <span class="text-white text-sm font-normal">Instagram</span>
                    </a>

                    <!-- Shopee (pakai icon shopping bag / cart) -->
                    <a href="https://shopee.co.id/now-food/shop/983613" target="_blank" class="flex items-center gap-2 hover:opacity-70 transition-opacity text-white">
                        <i class="fas fa-shopping-bag fa-lg"></i>
                        <span class="text-white text-sm font-normal">Shopee</span>
                    </a>

                    <!-- Gojek (pakai icon motor / bike) -->
                    <a href="https://gofood.co.id/malang/restaurant/mao-simpang-candi-panggung-0a2187b2-9927-4056-baa8-06b708992d8b" target="_blank" class="flex items-center gap-2 hover:opacity-70 transition-opacity text-white">
                        <i class="fas fa-motorcycle fa-lg"></i>
                        <span class="text-white text-sm font-normal">Gojek</span>
                    </a>

                </div>

            </div>
        </div>


    </div>

    <!-- Copyright Section -->
    <div class="flex justify-between items-center self-stretch h-[19px] border-t border-gray-500 pt-4 mt-4">
        <div class="text-white font-['Plus_Jakarta_Sans'] text-[12px] font-normal leading-normal">
            © 2024 Mao Coffee. All rights reserved.
        </div>
        <div class="text-white font-['Plus_Jakarta_Sans'] text-[12px] font-normal leading-normal">
            Privacy Policy | Terms of Service
        </div>
    </div>
</footer>