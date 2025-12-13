<section class="scroll-mt-[120px] flex w-full min-h-screen p-20 flex-col items-start gap-8" id="about" class="moment-section">

    <!-- HEADER -->
    <div class="flex w-full justify-between items-start">
        <div class="text-black text-[16px] font-normal w-36 h-[43px]">Your daily partner with flavour</div>
        <div class="text-black font-poppins text-[32px] font-medium leading-normal tracking-[-0.64px] w-[587px] h-[143px] flex-shrink-0">
            There is always a new moment that we want to create for our customers through the warmth of Mao Coffee
        </div>
    </div>

    <!-- CARDS CONTAINER -->
    <div class="flex items-stretch gap-14 w-full h-full flex-1 relative" id="cardsContainer">

        @foreach ($abouts as $index => $about)
        <div class="flex flex-col items-start gap-4 flex-1 transition-all duration-500 ease-in-out card"
             data-card="{{ $index + 1 }}"
             data-position="{{ $index == 0 ? 'middle' : ($index == 1 ? 'right' : 'left') }}">

            <!-- IMAGE -->
            <div class="flex w-full h-[500px] flex-col items-start gap-2.5 rounded-2xl bg-cover bg-center"
                 style="background-image: url('{{ asset('storage/'.$about->image) }}');">

                <!-- ICON CARD (SAMA UNTUK SEMUA) -->
                <div class="flex p-3 items-center gap-2 rounded-[14px] bg-white m-4">
                    <img src="{{ asset('image/moment-icon.png') }}" alt="" class="w-6 h-6">
                    <div class="font-semibold text-lg">{{ $about->small_title }}</div>
                </div>
            </div>

            <!-- CONTENT -->
            <div class="flex flex-col items-start gap-3 w-full flex-1 card-content {{ $index == 0 ? '' : 'hidden' }}">
                <div class="w-full text-black font-poppins text-2xl font-medium leading-tight">{{ $about->title }}</div>
                <div class="w-full text-black font-poppins text-base font-normal leading-relaxed flex-1">{{ $about->description }}</div>
            </div>

            <!-- NAVIGATION (Hanya untuk card kiri) -->
            <div class="flex items-start gap-4 w-full card-nav {{ $index == 0 ? '' : 'hidden' }}">
                <button class="w-16 h-16 rounded-full bg-white border border-gray-300 flex items-center justify-center hover:bg-gray-100 prev-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M15 18l-6-6 6-6"/>
                    </svg>
                </button>
                <button class="w-16 h-16 rounded-full bg-white border border-gray-300 flex items-center justify-center hover:bg-gray-100 next-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M9 18l6-6-6-6"/>
                    </svg>
                </button>
            </div>

        </div>
        @endforeach

    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const cards = document.querySelectorAll('.card');
    const prevButtons = document.querySelectorAll('.prev-btn');
    const nextButtons = document.querySelectorAll('.next-btn');

    // State awal berdasarkan data-card
    let currentState = {};
    cards.forEach((card, i) => {
        currentState[card.getAttribute('data-card')] = card.getAttribute('data-position');
    });

    function updateCardAppearance() {
        cards.forEach(card => {
            const cardNumber = card.getAttribute('data-card');
            const position = currentState[cardNumber];

            card.setAttribute('data-position', position);
            card.classList.remove('order-1','order-2','order-3','opacity-50','scale-95');

            card.querySelectorAll('.card-content').forEach(c => c.classList.add('hidden'));
            card.querySelectorAll('.card-nav').forEach(c => c.classList.add('hidden'));

            switch(position) {
                case 'left':
                    card.classList.add('order-1','opacity-50','scale-95');
                    card.querySelectorAll('.card-nav').forEach(nav => nav.classList.remove('hidden'));
                    break;
                case 'middle':
                    card.classList.add('order-2');
                    card.querySelectorAll('.card-content').forEach(c => c.classList.remove('hidden'));
                    break;
                case 'right':
                    card.classList.add('order-3','opacity-50','scale-95');
                    break;
            }
        });
    }

    function moveLeft() {
        const temp = {...currentState};
        const keys = Object.keys(temp);
        currentState[keys[0]] = temp[keys[1]];
        currentState[keys[1]] = temp[keys[2]];
        currentState[keys[2]] = temp[keys[0]];
        updateCardAppearance();
    }

    function moveRight() {
        const temp = {...currentState};
        const keys = Object.keys(temp);
        currentState[keys[2]] = temp[keys[1]];
        currentState[keys[1]] = temp[keys[0]];
        currentState[keys[0]] = temp[keys[2]];
        updateCardAppearance();
    }

    prevButtons.forEach(btn => btn.addEventListener('click', moveLeft));
    nextButtons.forEach(btn => btn.addEventListener('click', moveRight));

    updateCardAppearance();
});
</script>
