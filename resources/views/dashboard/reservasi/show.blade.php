@extends('layouts.dashboard')

@section('page-title', 'Detail Reservasi')

@section('dashboard-content')
<div class="min-h-screen bg-gray-50/50 p-6 font-sans">
    <div class="mx-auto max-w-6xl">
        
        <!-- Navigation & Title -->
        <div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div class="flex items-center gap-4">
                <a href="{{ route('dashboard.reservasi.index') }}" 
                   class="group flex h-10 w-10 items-center justify-center rounded-full bg-emerald-100 text-emerald-900 shadow-md shadow-emerald-100 transition-all hover:bg-emerald-200 hover:shadow-lg hover:-translate-y-0.5">
                    <i class="fas fa-arrow-left transition-transform group-hover:-translate-x-0.5"></i>
                </a>
                <div>
                    <h1 class="text-2xl font-bold tracking-tight text-gray-900">Reservasi #{{ $reservasi->id_reservasi }}</h1>
                    <div class="flex items-center gap-2 text-sm text-gray-500">
                        <i class="far fa-calendar"></i>
                        <span>{{ \Carbon\Carbon::parse($reservasi->created_at)->format('d F Y, H:i') }}</span>
                    </div>
                </div>
            </div>
            
            <div class="flex items-center gap-3">
                 <span class="inline-flex items-center rounded-full px-3 py-1 text-xs font-medium ring-1 ring-inset
                    {{ $reservasi->status == 'terverifikasi' ? 'bg-emerald-50 text-emerald-700 ring-emerald-600/20' : '' }}
                    {{ $reservasi->status == 'belum_verifikasi' ? 'bg-yellow-50 text-yellow-700 ring-yellow-600/20' : '' }}
                    {{ $reservasi->status == 'ditolak' ? 'bg-red-50 text-red-700 ring-red-600/20' : '' }}">
                    <span class="mr-1.5 h-1.5 w-1.5 rounded-full 
                        {{ $reservasi->status == 'terverifikasi' ? 'bg-emerald-600' : '' }}
                        {{ $reservasi->status == 'belum_verifikasi' ? 'bg-yellow-600' : '' }}
                        {{ $reservasi->status == 'ditolak' ? 'bg-red-600' : '' }}"></span>
                    {{ $reservasi->status_label }}
                </span>
            </div>
        </div>

        @if(session('success'))
            <div class="mb-6 flex items-center gap-3 rounded-lg border border-emerald-100 bg-emerald-50 p-4 text-emerald-900 shadow-sm">
                <i class="fas fa-check-circle text-lg text-emerald-600"></i>
                <p class="font-medium">{{ session('success') }}</p>
            </div>
        @endif

        <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">
            
            <!-- Left Column: Main Details (2/3) -->
            <div class="lg:col-span-2 space-y-6">
                
                <!-- Main Info Card -->
                <div class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm">
                    <!-- Customer Details Header -->
                    <div class="border-b border-gray-100 bg-gray-50/50 p-6">
                        <h2 class="text-sm font-semibold uppercase tracking-wider text-gray-900 mb-4">Informasi Pelanggan</h2>
                        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                            <div>
                                <p class="text-xs text-gray-500">Nama Pemesan</p>
                                <p class="mt-1 font-medium text-gray-900">{{ $reservasi->nama_reservasi }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500">Nomor WhatsApp</p>
                                <p class="mt-1 font-mono font-medium text-gray-900">{{ $reservasi->no_hp }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500">Tanggal Reservasi</p>
                                <div class="mt-1 flex items-center gap-2 font-medium text-gray-900">
                                    <i class="far fa-calendar-alt text-gray-400"></i>
                                    {{ \Carbon\Carbon::parse($reservasi->tgl_reservasi)->format('d F Y') }}
                                </div>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500">Waktu</p>
                                <div class="mt-1 flex items-center gap-2 font-medium text-gray-900">
                                    <i class="far fa-clock text-gray-400"></i>
                                    {{ $reservasi->jam_reservasi }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Order Items -->
                    <div class="p-6">
                        <h2 class="mb-4 text-sm font-semibold uppercase tracking-wider text-gray-900">Rincian Pesanan</h2>
                        <div class="divide-y divide-gray-100 rounded-lg border border-gray-100 bg-white">
                            @foreach($reservasi->pakets as $paket)
                            <div class="flex items-start justify-between p-4 transition hover:bg-gray-50">
                                <div class="flex gap-4">
                                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-gray-100 text-gray-500">
                                        <i class="fas fa-utensils text-sm"></i>
                                    </div>
                                    <div>
                                        <div class="flex items-center gap-2">
                                            <span class="font-medium text-gray-900">{{ $paket->nama_paket }}</span>
                                            <span class="rounded bg-gray-100 px-2 py-0.5 text-xs font-semibold text-gray-700">x{{ $paket->pivot->jumlah }}</span>
                                        </div>
                                        <p class="mt-1 text-sm leading-relaxed text-gray-500">{{ $paket->deeskripsi_menu }}</p>
                                    </div>
                                </div>
                                <div class="whitespace-nowrap font-medium text-gray-900">
                                    {{ $paket->harga_formatted }}
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Footer / Total -->
                    <div class="bg-gray-50 p-6">
                        <div class="flex flex-col items-end gap-1">
                            <span class="text-sm text-gray-500">Total Pembayaran</span>
                            <span class="text-3xl font-bold tracking-tight text-gray-900">{{ $reservasi->total_formatted }}</span>
                            <span class="text-xs text-gray-400">Termasuk pajak & layanan</span>
                        </div>
                    </div>
                </div>

                <!-- Notes Section -->
                @if($reservasi->catatan)
                <div class="rounded-xl border border-amber-200 bg-amber-50 p-4">
                    <div class="flex gap-3">
                        <i class="fas fa-sticky-note mt-0.5 text-amber-400"></i>
                        <div>
                            <h3 class="text-sm font-medium text-amber-900">Catatan Tambahan</h3>
                            <p class="mt-1 text-sm text-amber-800">{{ $reservasi->catatan }}</p>
                        </div>
                    </div>
                </div>
                @endif
            </div>

            <!-- Right Column: Sidebar (1/3) -->
            <div class="space-y-6">
                
                <!-- Status Actions -->
                <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm">
                    <h3 class="mb-4 text-sm font-semibold uppercase tracking-wider text-gray-900">Tindakan</h3>
                    
                    @if($reservasi->status == 'belum_verifikasi')
                        <form action="{{ route('dashboard.reservasi.updateStatus', $reservasi->id_reservasi) }}" method="POST" class="flex gap-3">
                            @csrf
                            <button type="submit" name="status" value="terverifikasi" 
                                    class="flex-1 flex items-center justify-center gap-2 bg-green-500 hover:bg-green-600 text-white py-2.5 px-4 rounded-lg transition duration-200 font-medium">
                                <i class="fas fa-check"></i>
                                Terima
                            </button>
                            
                            <button type="submit" name="status" value="ditolak" 
                                    class="flex-1 flex items-center justify-center gap-2 bg-red-500 hover:bg-red-600 text-white py-2.5 px-4 rounded-lg transition duration-200 font-medium">
                                <i class="fas fa-times"></i>
                                Tolak
                            </button>
                        </form>
                        <p class="mt-3 text-xs text-center text-gray-500">
                            Pastikan bukti pembayaran valid.
                        </p>
                    @else
                        <div class="flex flex-col items-center justify-center py-6 text-center">
                            <div class="mb-3 flex h-12 w-12 items-center justify-center rounded-full 
                                {{ $reservasi->status == 'terverifikasi' ? 'bg-emerald-100 text-emerald-600' : 'bg-red-100 text-red-600' }}">
                                <i class="fas {{ $reservasi->status == 'terverifikasi' ? 'fa-check' : 'fa-times' }} text-lg"></i>
                            </div>
                            <p class="font-medium text-gray-900">Reservasi {{ $reservasi->status_label }}</p>
                            <p class="text-sm text-gray-500">Status telah diperbarui oleh admin.</p>
                        </div>
                    @endif
                </div>

                <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm">
                    <div class="mb-4 flex items-center justify-between">
                        <h3 class="text-sm font-semibold uppercase tracking-wider text-gray-900">Bukti Transfer</h3>
                        <a href="{{ asset('storage/' . $reservasi->bukti_pembayaran) }}" target="_blank" class="text-xs font-medium text-blue-600 hover:underline">
                            Detail
                        </a>
                    </div>
                    
                    <div class="group relative overflow-hidden rounded-lg border border-gray-200 bg-gray-50">
                        <div class="aspect-[4/3] w-full">
                            <img src="{{ asset('storage/' . $reservasi->bukti_pembayaran) }}" 
                                 alt="Bukti Transfer" 
                                 class="h-full w-full object-cover object-center transition duration-300 group-hover:scale-105">
                        </div>
                        <a href="{{ asset('storage/' . $reservasi->bukti_pembayaran) }}" target="_blank" 
                           class="absolute inset-0 flex items-center justify-center bg-black/50 opacity-0 transition-opacity duration-200 group-hover:opacity-100">
                            <div class="rounded-full bg-white/20 px-4 py-2 text-sm font-medium text-white backdrop-blur-sm border border-white/30">
                                <i class="fas fa-search-plus mr-2"></i> Lihat Penuh
                            </div>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection