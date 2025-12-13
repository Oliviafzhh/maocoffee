<section class="flex flex-col justify-center items-center gap-2.5 w-full h-[832px] py-[66px] px-[52px] flex-shrink-0">
    <div class="flex flex-col justify-between items-center flex-1 self-stretch">
        <div class="flex flex-col items-center gap-4 w-[899.747px]">
            <div class="text-[#004642] text-center text-[56px] font-bold leading-[120%] self-stretch">Here what they say</div>
            <div class="text-[#5E5E5E] text-center font-['Plus_Jakarta_Sans'] text-[24px] font-normal leading-[120%] self-stretch">Customer experiences are at the heart of what we do. Their words inspire us to continually raise the standard of our coffee and service.</div>
        </div>
    </div>

    </br>
    <!-- Button Review -->
    <a href="/reviews" class="no-underline">
        <div class="flex justify-center items-center gap-2.5 px-6 py-3 rounded-[20px] 
                bg-[#2E4239] text-white font-['Plus_Jakarta_Sans'] text-[16px] font-semibold 
                leading-[120%] shadow-sm hover:shadow-md hover:bg-[#1F2B28] transition-all duration-300 transform hover:-translate-y-0.5">
            Berikan Review Kamu!
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="ml-1">
                <path d="M8 0l8 8-8 8-1.414-1.414L12.172 8 6.586 2.414 8 0z" />
            </svg>
        </div>
    </a>

    </br>


    <div class="grid h-[463.877px] gap-[41px] self-stretch grid-rows-2 grid-cols-3">
        @foreach($reviews as $review)
        <div class="flex flex-col items-start gap-7 flex-1 self-stretch p-6 rounded-[24px] border border-[#D9D9D9]">
            <div class="flex justify-between items-center w-full gap-2">
                <div class="w-[58px] h-[58px] flex-shrink-0 rounded-[64px] overflow-hidden">
                    <!-- Gambar profil dari database -->
                    @if($review->profil_review && Storage::exists('public/' . $review->profil_review))
                    <img src="{{ Storage::url($review->profil_review) }}"
                        alt="{{ $review->nama_review }}"
                        class="w-full h-full object-cover">
                    @else
                    <!-- Fallback jika gambar tidak ada -->
                    <div class="w-full h-full bg-gray-300 rounded-[64px] flex items-center justify-center">
                        <span class="text-white font-bold text-xl">{{ substr($review->nama_review, 0, 1) }}</span>
                    </div>
                    @endif
                </div>
                <div class="flex flex-col items-start gap-1 w-full flex-shrink-0">
                    <div class="text-[#004642] text-[24px] font-semibold leading-[120%] h-[25px] self-stretch">{{ $review->nama_review }}</div>
                    <div class="flex gap-1">
                        @for($i = 1; $i <= 5; $i++)
                            @if($i <=$review->bintang)
                            <!-- Bintang penuh -->
                            <svg xmlns="http://www.w3.org/2000/svg" width="21" height="20" viewBox="0 0 21 20" fill="none">
                                <path d="M10.462 0L12.9319 7.60155H20.9246L14.4584 12.2996L16.9283 19.9011L10.462 15.2031L3.99574 19.9011L6.46563 12.2996L-0.000632286 7.60155H7.99211L10.462 0Z" fill="#FFDD00" />
                            </svg>
                            @else
                            <!-- Bintang kosong -->
                            <svg xmlns="http://www.w3.org/2000/svg" width="21" height="20" viewBox="0 0 21 20" fill="none">
                                <path d="M10.462 0L12.9319 7.60155H20.9246L14.4584 12.2996L16.9283 19.9011L10.462 15.2031L3.99574 19.9011L6.46563 12.2996L-0.000632286 7.60155H7.99211L10.462 0Z" fill="#D9D9D9" />
                            </svg>
                            @endif
                            @endfor
                    </div>
                </div>
            </div>
            <div class="flex justify-center items-center gap-2.5 self-stretch text-[#3C6E71] text-[20px] font-normal leading-[110%]">
                {{ $review->deskripsi_review }}
            </div>
        </div>
        @endforeach
    </div>
</section>