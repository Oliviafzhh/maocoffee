<header class="bg-[#D4B3AA] shadow-sm border-b border-gray-200">
    <div class="flex justify-between items-center px-6 py-4">
        <!-- Greeting untuk User -->
        <div>
            <h1 class="text-2xl font-semibold text-white">
                Hello, Admin Mao! 👋
            </h1>
        </div>

        <!-- Logout Button -->
        <div class="flex items-center gap-4">
            <button onclick="openLogoutModal()"
                class="flex items-center gap-1.5 px-3 py-1.5 bg-red-500 text-white rounded-lg
               text-sm font-medium shadow hover:bg-red-600 active:scale-95 transition-all duration-150">

                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 fill-white" viewBox="0 0 24 24">
                    <path d="M14 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h9a2 2 0 0 0 2-2v-4h-2v4H5V5h9v4h2V5a2 2 0 0 0-2-2zm7.71 9.29-4-4-1.42 1.42L18.59 11H9v2h9.59l-2.3 2.29 1.42 1.42 4-4a1 1 0 0 0 0-1.42z" />
                </svg>

                <span>Logout</span>
            </button>
        </div>
        <!-- MODAL LOGOUT -->
        <div id="logoutModal" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">

            <div class="bg-white rounded-2xl shadow-xl w-full max-w-sm p-6 text-center space-y-4">
                <h2 class="text-lg font-semibold text-gray-800">
                    Konfirmasi Logout
                </h2>

                <p class="text-sm text-gray-600">
                    Yakin ingin keluar dari dashboard ini?
                </p>

                <div class="flex justify-center gap-3 pt-4">
                    <button onclick="closeLogoutModal()"
                        class="px-4 py-2 text-sm rounded-lg border border-gray-300
                       hover:bg-gray-100 transition">
                        Batal
                    </button>

                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="px-4 py-2 text-sm rounded-lg bg-[#2E4239] hover:bg-[#1a2a22] text-white transition duration-200">
                            Ya, saya ingin keluar
                        </button>

                    </form>
                </div>
            </div>

        </div>


    </div>
</header>

<script>
    function openLogoutModal() {
        document.getElementById('logoutModal').classList.remove('hidden');
        document.getElementById('logoutModal').classList.add('flex');
    }

    function closeLogoutModal() {
        document.getElementById('logoutModal').classList.remove('flex');
        document.getElementById('logoutModal').classList.add('hidden');
    }
</script>