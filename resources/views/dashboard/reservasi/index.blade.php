@extends('layouts.dashboard')

@section('page-title', 'Manajemen Reservasi')

@section('dashboard-content')
<div class="min-h-screen bg-gray-50/50 p-6 font-sans">
    <div class="mx-auto max-w-7xl">
        
        <!-- Header & Controls -->
        <div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-2xl font-bold tracking-tight text-gray-900">Manajemen Reservasi</h1>
                <p class="mt-1 text-sm text-gray-500">Pantau semua reservasi yang masuk dengan mudah.</p>
            </div>
            
            <!-- Filter Status -->
            <div class="flex flex-col sm:flex-row gap-3 w-full md:w-auto">
                <select id="filterStatus" class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#2E4239] text-sm font-medium text-gray-700 bg-white">
                    <option value="all" {{ $status == 'all' ? 'selected' : '' }}>Semua Status</option>
                    <option value="belum_verifikasi" {{ $status == 'belum_verifikasi' ? 'selected' : '' }}>Belum Verifikasi</option>
                    <option value="terverifikasi" {{ $status == 'terverifikasi' ? 'selected' : '' }}>Terverifikasi</option>
                    <option value="ditolak" {{ $status == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                </select>
            </div>
        </div>


        @if(session('success'))
            <div class="mb-6 flex items-center gap-3 rounded-xl border border-emerald-100 bg-emerald-50 p-4 text-emerald-900 shadow-sm">
                <i class="fas fa-check-circle text-lg text-emerald-600"></i>
                <p class="font-medium">{{ session('success') }}</p>
            </div>
        @endif

        <!-- Table Card -->
        <div class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm whitespace-nowrap">
                    <thead class="bg-gray-50 border-b border-gray-100">
                        <tr>
                            <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider w-16 text-center">ID</th>
                            <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Pelanggan</th>
                            <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Jadwal</th>
                            <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Paket Utama</th>
                            <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Total</th>
                            <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider text-center">Status</th>
                            <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($reservasis as $reservasi)
                        <tr class="group hover:bg-gray-50/60 transition-colors">
                            <!-- ID -->
                            <td class="px-6 py-4 text-center">
                                <span class="inline-flex items-center justify-center h-8 w-8 rounded-lg bg-gray-100 text-gray-600 text-xs font-bold border border-gray-200">
                                    {{ $reservasi->id_reservasi }}
                                </span>
                            </td>

                            <!-- Pelanggan -->
                            <td class="px-6 py-4">
                                <div class="flex flex-col">
                                    <span class="font-semibold text-gray-900">{{ $reservasi->nama_reservasi }}</span>
                                    <a href="https://wa.me/{{ $reservasi->no_hp }}" target="_blank" class="text-xs text-gray-500 font-mono mt-1 flex items-center gap-1.5 hover:text-green-600 transition-colors">
                                        <i class="fab fa-whatsapp text-green-500"></i> {{ $reservasi->no_hp }}
                                    </a>
                                </div>
                            </td>
                            
                            <!-- Jadwal -->
                            <td class="px-6 py-4">
                                <div class="flex flex-col">
                                    <span class="font-medium text-gray-900">{{ \Carbon\Carbon::parse($reservasi->tgl_reservasi)->format('d M Y') }}</span>
                                    <span class="text-xs text-gray-500 mt-0.5">Pukul {{ $reservasi->jam_reservasi }}</span>
                                </div>
                            </td>

                            <!-- Paket -->
                            <td class="px-6 py-4">
                                <div class="flex flex-col gap-1">
                                    @php 
                                        $paketUtama = $reservasi->pakets->first(); 
                                    @endphp
                                    
                                    @if($paketUtama)
                                        <div class="flex items-center gap-2">
                                            <span class="text-gray-900 font-medium text-xs">{{ $paketUtama->nama_paket }}</span>
                                            
                                            @if($paketUtama->pivot && $paketUtama->pivot->jumlah > 1)
                                                <span class="bg-gray-100 text-gray-600 px-1.5 py-0.5 rounded text-[10px] font-bold border border-gray-200">x{{ $paketUtama->pivot->jumlah }}</span>
                                            @elseif($reservasi->jumlah_paket > 1) 
                                                <span class="bg-gray-100 text-gray-600 px-1.5 py-0.5 rounded text-[10px] font-bold border border-gray-200">x{{ $reservasi->jumlah_paket }}</span>
                                            @endif
                                        </div>
                                        
                                        @if($reservasi->pakets->count() > 1)
                                            <span class="text-[10px] text-gray-400 italic font-medium">+{{ $reservasi->pakets->count() - 1 }} lainnya</span>
                                        @endif
                                    @else
                                        <span class="text-gray-400 italic text-xs">-</span>
                                    @endif
                                </div>
                            </td>

                            <!-- Total (DIPERBAIKI: Menggunakan total_formatted atau fallback ke hitungan manual) -->
                            <td class="px-6 py-4">
                                <span class="font-bold text-gray-900">
                                    @if(isset($reservasi->total_formatted))
                                        {{ $reservasi->total_formatted }}
                                    @else
                                        Rp {{ number_format($reservasi->total_bayar ?? $reservasi->total_harga ?? 0, 0, ',', '.') }}
                                    @endif
                                </span>
                            </td>

                            <!-- Status -->
                            <td class="px-6 py-4 text-center">
                                @if(strtolower($reservasi->status) == 'terverifikasi')
                                    <span class="inline-flex items-center gap-1.5 rounded-full bg-green-50 px-2.5 py-1 text-xs font-semibold text-green-700 ring-1 ring-inset ring-green-600/20">
                                        <span class="h-1.5 w-1.5 rounded-full bg-green-600"></span>
                                        Terverifikasi
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 rounded-full bg-red-50 px-2.5 py-1 text-xs font-semibold text-red-700 ring-1 ring-inset ring-red-600/20">
                                        <span class="h-1.5 w-1.5 rounded-full bg-red-600"></span>
                                        {{ $reservasi->status == 'belum_verifikasi' ? 'Belum Verifikasi' : ucfirst($reservasi->status) }}
                                    </span>
                                @endif
                            </td>

                            <!-- Aksi -->
                            <td class="px-6 py-4 text-right">
                                <a href="{{ route('dashboard.reservasi.show', $reservasi->id_reservasi) }}" 
                                   class="inline-flex items-center justify-center rounded-lg border border-gray-200 bg-white px-3 py-1.5 text-xs font-medium text-gray-700 shadow-sm hover:bg-emerald-50 hover:text-emerald-700 hover:border-emerald-200 transition-all">
                                    Detail <i class="fas fa-chevron-right ml-1.5 text-[10px]"></i>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="px-6 py-12 text-center bg-gray-50/30">
                                <div class="mx-auto mb-3 flex h-12 w-12 items-center justify-center rounded-full bg-white border border-gray-100 shadow-sm">
                                    <i class="fas fa-inbox text-gray-300 text-xl"></i>
                                </div>
                                <h3 class="text-sm font-medium text-gray-900">Belum ada data</h3>
                                <p class="mt-1 text-xs text-gray-500">Data reservasi akan muncul di sini.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            @if(method_exists($reservasis, 'links'))
            <div class="border-t border-gray-200 bg-gray-50 px-6 py-4 flex justify-end">
                {{ $reservasis->links() }}
            </div>
            @endif
        </div>
    </div>
</div>

<script>
    document.getElementById('filterStatus').addEventListener('change', function() {
        window.location.href = `{{ route('dashboard.reservasi.index') }}?status=${this.value}`;
    });
</script>
@endsection