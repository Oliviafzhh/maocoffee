@extends('layouts.auth')

@section('auth-content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-[#2E4239] to-[#1f3028] px-6">

    <div class="w-full max-w-md bg-white rounded-3xl shadow-2xl p-10 flex flex-col gap-8">

        <!-- LOGO -->
        <div class="flex flex-col items-center gap-3">
            <img src="{{ asset('image/LOGO.png') }}" alt="" class="w-28 drop-shadow-md">
            <h2 class="text-3xl font-semibold text-[#212121] text-center">
                Hallo Admin
            </h2>
            <p class="text-gray-500 text-center text-sm">
                Please login to continue
            </p>
        </div>

        <!-- SUCCESS MESSAGE -->
        @if(session('success'))
        <div class="w-full bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl text-sm">
            {{ session('success') }}
        </div>
        @endif

        <!-- LOGIN FORM -->
        <form action="{{ route('login.process') }}" method="POST" class="flex flex-col gap-6">
            @csrf

            <!-- Email -->
            <div class="flex flex-col gap-2">
                <label for="email" class="text-sm font-medium text-[#212121]">
                    Email
                </label>
                <input type="email" name="email" id="email" value="{{ old('email') }}"
                    placeholder="Enter your email"
                    class="w-full h-12 px-4 bg-[#F2F2F2] rounded-xl focus:ring-2 focus:ring-[#2E4239] outline-none
                    @error('email') border border-red-500 @enderror">
                @error('email')
                <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <!-- Password -->
            <div class="flex flex-col gap-2">
                <label for="password" class="text-sm font-medium text-[#212121]">
                    Password
                </label>
                <input type="password" name="password" id="password"
                    placeholder="Enter your password"
                    class="w-full h-12 px-4 bg-[#F2F2F2] rounded-xl focus:ring-2 focus:ring-[#2E4239] outline-none
                    @error('password') border border-red-500 @enderror">
                @error('password')
                <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <!-- ERROR GLOBAL -->
            @if($errors->has('email'))
            <div class="text-red-500 text-xs text-center">
                {{ $errors->first('email') }}
            </div>
            @endif

            <!-- BUTTON -->
            <button type="submit"
                class="w-full py-3 bg-[#2E4239] text-white rounded-xl font-medium
                hover:bg-[#23362f] transition duration-200 shadow-md">
                Login
            </button>
        </form>

    </div>

</div>
@endsection