@extends('layouts.dashboard')
@section('dashboard-content')

@php
use Illuminate\Support\Str;

function fileUrl2($path) {
if (!$path) return '';

// Jika file upload user → storage/app/public/konfigurasi/*
        if (Str::startsWith($path, 'konfigurasi/')) {
        return asset('storage/' . $path);
        }

// Jika file dari seeder → public/image/konfigurasi_web/*
        return asset($path);
        }
@endphp


<div class="p-6">
    <!-- Konfigurasi Web Section -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-semibold text-gray-800">Konfigurasi Website</h2>
            <a href="{{ route('konfigurasi.edit', $konfigurasi->id_konfigurasi) }}"
                class="bg-[#2E4239] hover:bg-[#1a2a22] text-white px-4 py-2 rounded-lg transition duration-200 flex items-center gap-2">
                <i class="fas fa-edit"></i>
                Edit Konfigurasi
            </a>
        </div>

        @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
            {{ session('success') }}
        </div>
        @endif

        <!-- Konfigurasi Data -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

            <!-- Logo Website -->
            <div class="border border-gray-200 rounded-lg p-4">
                <h3 class="text-lg font-semibold text-gray-800 mb-3">Logo Website</h3>
                @if($konfigurasi && $konfigurasi->logo_web)
                <div class="flex flex-col items-center gap-4">
                    <div class="w-32 h-32 flex items-center justify-center bg-gray-100 rounded-lg p-2">
                        <img src="{{ fileUrl2($konfigurasi->logo_web) }}"
                            alt="Logo Website"
                            class="max-w-full max-h-full object-contain">
                    </div>
                    <span class="text-gray-600 text-sm text-center break-all">
                        {{ $konfigurasi->logo_web }}
                    </span>
                </div>
                @else
                <p class="text-gray-500 italic">Belum ada logo yang diupload</p>
                @endif
            </div>

            <!-- Card 1 -->
            <div class="border border-gray-200 rounded-lg p-4">
                <h3 class="text-lg font-semibold text-gray-800 mb-3">Card 1</h3>
                @if($konfigurasi && $konfigurasi->img_card1)
                <div class="space-y-3">
                    <div class="w-full h-48 flex items-center justify-center bg-gray-100 rounded-lg overflow-hidden">
                        <img src="{{ fileUrl2($konfigurasi->img_card1) }}"
                            alt="Card 1 Image"
                            class="max-w-full max-h-full object-contain">
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Nama Card:</p>
                        <p class="font-medium text-gray-800">{{ $konfigurasi->nama_card1 ?? '-' }}</p>
                    </div>
                </div>
                @else
                <p class="text-gray-500 italic">Belum ada data card 1</p>
                @endif
            </div>

            <!-- Card 2 -->
            <div class="border border-gray-200 rounded-lg p-4">
                <h3 class="text-lg font-semibold text-gray-800 mb-3">Card 2</h3>
                @if($konfigurasi && $konfigurasi->img_card2)
                <div class="space-y-3">
                    <div class="w-full h-48 flex items-center justify-center bg-gray-100 rounded-lg overflow-hidden">
                        <img src="{{ fileUrl2($konfigurasi->img_card2) }}"
                            alt="Card 2 Image"
                            class="max-w-full max-h-full object-contain">
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Nama Card:</p>
                        <p class="font-medium text-gray-800">{{ $konfigurasi->nama_card2 ?? '-' }}</p>
                    </div>
                </div>
                @else
                <p class="text-gray-500 italic">Belum ada data card 2</p>
                @endif
            </div>

            <!-- Info Konfigurasi -->
            <div class="border border-gray-200 rounded-lg p-4">
                <h3 class="text-lg font-semibold text-gray-800 mb-3">Informasi Konfigurasi</h3>
                <div class="space-y-2">
                    <p class="text-sm text-gray-600">
                        <span class="font-medium">ID Konfigurasi:</span>
                        {{ $konfigurasi->id_konfigurasi ?? '-' }}
                    </p>
                    <p class="text-sm text-gray-600">
                        <span class="font-medium">Status:</span>
                        @if($konfigurasi)
                        <span class="text-green-600">Aktif</span>
                        @else
                        <span class="text-red-600">Belum dikonfigurasi</span>
                        @endif
                    </p>
                    <p class="text-sm text-gray-600">
                        <span class="font-medium">Terakhir Diupdate:</span>
                        {{ $konfigurasi ? 'Data tersedia' : '-' }}
                    </p>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection