@extends('layouts.auth')

@section('auth-content')
<div class="flex items-stretch gap-4 p-6 h-screen">

    <!-- LEFT PANEL (WELCOME) -->
    <div class="flex flex-col justify-center items-center gap-10 flex-1 bg-[#2E4239] rounded-[40px] h-full p-10 shadow-xl">

        <div class="flex flex-col items-center gap-4 max-w-md">
            <h1 class="text-7xl font-semibold text-white leading-[110%] tracking-tight text-center">
                Hello<br>Welcome
            </h1>

            <p class="text-2xl font-light text-white opacity-90 text-center tracking-tight">
                If you don’t have an account, please sign up
            </p>
        </div>

        <a href="{{ route('signup') }}"
           class="px-10 py-4 border border-white rounded-2xl text-white text-2xl font-medium hover:bg-white hover:text-[#2E4239] transition-all duration-200 shadow-lg">
            Sign Up
        </a>
    </div>

    <!-- RIGHT PANEL (LOGIN FORM) -->
    <div class="flex flex-col justify-center items-center flex-1 px-10">

        <div class="flex flex-col items-center gap-10 w-full max-w-xl">

            <!-- LOGO + TITLE -->
            <div class="flex flex-col items-center gap-4">
                <img src="{{ asset('image/LOGO.png') }}" alt="" class="w-40 drop-shadow-lg">
                <h2 class="text-5xl font-semibold text-[#212121] tracking-tight text-center">
                    Make Your Journey Better
                </h2>
            </div>

            <!-- SUCCESS MESSAGE -->
            @if(session('success'))
                <div class="w-full bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl shadow-sm">
                    {{ session('success') }}
                </div>
            @endif

            <!-- LOGIN FORM -->
            <form action="{{ route('login.process') }}" method="POST"
                  class="flex flex-col gap-10 w-full">
                @csrf

                <!-- INPUT FIELDS -->
                <div class="flex flex-col gap-6">

                    <!-- Email -->
                    <div class="flex flex-col gap-2">
                        <label for="email" class="text-2xl text-[#212121] font-medium tracking-tight">
                            Email
                        </label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}"
                               placeholder="Enter your Email"
                               class="w-full h-16 px-6 bg-[#F2F2F2] rounded-3xl shadow-sm focus:ring-2 focus:ring-[#2E4239] outline-none
                               @error('email') border border-red-500 @enderror">
                        @error('email')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="flex flex-col gap-2">
                        <label for="password" class="text-2xl text-[#212121] font-medium tracking-tight">
                            Password
                        </label>
                        <input type="password" name="password" id="password"
                               placeholder="Enter your Password"
                               class="w-full h-16 px-6 bg-[#F2F2F2] rounded-3xl shadow-sm focus:ring-2 focus:ring-[#2E4239] outline-none
                               @error('password') border border-red-500 @enderror">
                        @error('password')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                </div>

                <!-- COMMON ERROR -->
                @if($errors->has('email'))
                    <div class="text-red-500 text-sm text-center">
                        {{ $errors->first('email') }}
                    </div>
                @endif

                <!-- LOGIN BUTTON -->
                <button type="submit"
                        class="w-full py-4 bg-[#2E4239] text-white text-2xl rounded-2xl font-medium tracking-tight
                        hover:bg-[#23362f] transition-all duration-200 shadow-md">
                    Login
                </button>

            </form>

            <!-- SIGN UP LINK -->
            <p class="text-2xl text-[#212121] font-normal tracking-tight">
                Don’t have an account?
                <a href="{{ route('signup') }}"
                   class="font-semibold underline hover:text-[#2E4239] transition">
                    Sign Up First
                </a>
            </p>
        </div>

    </div>
</div>
@endsection
