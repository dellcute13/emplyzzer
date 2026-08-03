@extends('layouts.main')

@section('content')
    <div class="min-h-screen bg-[#F4F7FE] flex items-center justify-center px-6">

        <div class="w-full max-w-md bg-white rounded-[2rem] shadow-xl border border-slate-100 p-8 md:p-10 flex flex-col justify-center">

            {{-- Header --}}
            <div class="mb-8 text-center">
                <div class="inline-flex items-center gap-2 mb-4">
                    <div class="w-8 h-8 rounded-lg bg-slate-900 flex items-center justify-center text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 17v-6m4 6V7m4 10V4M5 20h14" />
                        </svg>
                    </div>
                    <span class="text-xl font-bold text-slate-900 tracking-tight">Emplyzer</span>
                </div>
                <h2 class="text-2xl font-bold text-slate-900">
                    Welcome Back
                </h2>
                <p class="text-sm text-slate-500 mt-1">
                    Sign in to your account
                </p>
            </div>

            {{-- Form --}}
            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                {{-- Email --}}
                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-slate-500 mb-2">
                        Email Address
                    </label>

                    <input type="email" name="email" value="{{ old('email') }}" required autofocus
                        class="@error('email') border-red-500 @enderror w-full rounded-xl border-slate-200 px-4 py-3 focus:ring-2 focus:ring-slate-900 focus:border-slate-900 text-slate-900 placeholder:text-slate-400"
                        placeholder="admin@email.com">
                    @error('email')
                        <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Password --}}
                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-slate-500 mb-2">
                        Password
                    </label>

                    <input type="password" name="password" required
                        class="@error('password') border-red-500 @enderror w-full rounded-xl border-slate-200 px-4 py-3 focus:ring-2 focus:ring-slate-900 focus:border-slate-900 text-slate-900 placeholder:text-slate-400"
                        placeholder="••••••••">
                    @error('password')
                        <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Remember & Forgot --}}
                <div class="flex items-center justify-between text-xs">
                    <label class="flex items-center gap-2 text-slate-500 cursor-pointer">
                        <input type="checkbox" name="remember" class="rounded border-slate-300 text-slate-900 focus:ring-slate-900">
                        Remember me
                    </label>

                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-slate-900 font-semibold hover:underline">
                            Forgot Password?
                        </a>
                    @endif
                </div>

                {{-- Button --}}
                <button type="submit"
                    class="w-full bg-slate-900 hover:bg-slate-950 text-white py-3.5 rounded-xl font-semibold transition duration-200 shadow-md shadow-slate-900/10">
                    Sign In
                </button>

            </form>

            <div class="mt-8 text-center text-xs text-slate-400">
                © {{ date('Y') }} Emplyzer. All rights reserved.
            </div>

        </div>

    </div>
@endsection
