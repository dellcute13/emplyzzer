@extends('layouts.main')

@section('content')
    <div class="min-h-screen bg-[#F4F7FE] flex items-center justify-center px-6">

        <div class="grid grid-cols-1 lg:grid-cols-2 w-full max-w-6xl bg-white rounded-3xl shadow-xl overflow-hidden">

            {{-- Left Side --}}
            <div class="hidden lg:flex flex-col justify-between bg-slate-900 text-white p-12 relative">

                <div>
                    <div class="flex items-center gap-3 mb-10">
                        <div class="w-12 h-12 rounded-xl bg-white/10 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 17v-6m4 6V7m4 10V4M5 20h14" />
                            </svg>
                        </div>

                        <div>
                            <h1 class="text-2xl font-bold">Emplyzer</h1>
                            <p class="text-xs tracking-[0.25em] uppercase text-slate-300">
                                SAW Method System
                            </p>
                        </div>
                    </div>

                    <h2 class="text-4xl font-bold leading-tight mb-4">
                        Sistem Pendukung <br> Keputusan Pegawai Terbaik
                    </h2>

                    <p class="text-slate-300 leading-relaxed max-w-md">
                        Kelola penilaian pegawai, proses perhitungan metode SAW,
                        dan tampilkan ranking terbaik secara profesional.
                    </p>
                </div>

                {{-- Decorative Cards --}}
                <div class="space-y-4">
                    <div class="bg-white/10 rounded-2xl p-5 backdrop-blur">
                        <p class="text-sm text-slate-300 mb-1">Top Performance</p>
                        <h3 class="text-2xl font-bold">0.982</h3>
                        <p class="text-xs text-emerald-300 mt-1">John Doe</p>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-white/10 rounded-2xl p-5">
                            <p class="text-xs text-slate-300">Employees</p>
                            <h4 class="text-2xl font-bold mt-1">150</h4>
                        </div>

                        <div class="bg-white/10 rounded-2xl p-5">
                            <p class="text-xs text-slate-300">Criteria</p>
                            <h4 class="text-2xl font-bold mt-1">5</h4>
                        </div>
                    </div>
                </div>

            </div>

            {{-- Right Side --}}
            <div class="p-8 md:p-14 flex flex-col justify-center">

                <div class="max-w-md w-full mx-auto">

                    <div class="mb-10">
                        <h2 class="text-3xl font-bold text-slate-900">
                            Welcome Back 👋
                        </h2>
                        <p class="text-slate-500 mt-2">
                            Login untuk mengakses dashboard Emplyzer.
                        </p>
                    </div>

                    <form method="POST" action="{{ route('login') }}" class="space-y-5">
                        @csrf

                        {{-- Email --}}
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">
                                Email Address
                            </label>

                            <input type="email" name="email"
                                class="@error('email') is-invalid @enderror w-full rounded-xl border-slate-200 px-4 py-3 focus:ring-2 focus:ring-slate-900 focus:border-slate-900"
                                placeholder="admin@email.com">
                        </div>

                        {{-- Password --}}
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">
                                Password
                            </label>

                            <input type="password" name="password"
                                class="password-input @error('password') is-invalid @enderror w-full rounded-xl border-slate-200 px-4 py-3 focus:ring-2 focus:ring-slate-900 focus:border-slate-900"
                                placeholder="••••••••">
                        </div>

                        {{-- Remember --}}
                        <div class="flex items-center justify-between text-sm">
                            <label class="flex items-center gap-2 text-slate-600">
                                <input type="checkbox" class="rounded border-slate-300">
                                Remember me
                            </label>

                            <a href="#" class="text-slate-900 font-medium hover:underline">
                                Forgot Password?
                            </a>
                        </div>

                        {{-- Button --}}
                        <button type="submit"
                            class="w-full bg-slate-900 text-white py-3.5 rounded-xl font-semibold hover:bg-slate-800 transition">
                            Sign In
                        </button>

                    </form>

                    <div class="mt-8 text-center text-sm text-slate-500">
                        © {{ date('Y') }} Emplyzer. All rights reserved.
                    </div>

                </div>

            </div>

        </div>

    </div>
@endsection
