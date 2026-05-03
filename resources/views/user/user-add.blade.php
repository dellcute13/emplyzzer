@extends('layouts.app')

@section('content')
    <section class="p-8 space-y-8 flex-1">
        <!-- Back Action -->
        <a href="{{ route('users.user-data') }}"
            class="flex items-center text-secondary hover:underline font-label-sm text-label-sm mb-4 transition-all">
            <span class="material-symbols-outlined mr-1 text-sm" data-icon="arrow_back">arrow_back</span>
            Kembali ke Daftar Pengguna
        </a>
        <!-- Bento Grid Layout for Form -->
        <div class="grid grid-cols-12 gap-6">
            <!-- Main Form Section -->
            <div
                class="col-span-12 lg:col-span-8 bg-white p-lg rounded-xl border border-slate-200 shadow-[0px_4px_20px_rgba(0,0,0,0.05)]">
                <div class="mb-6 border-b border-slate-100 pb-4">
                    <h2 class="font-headline-lg text-headline-lg text-primary-container">Informasi Akun</h2>
                    <p class="font-body-md text-body-md text-on-surface-variant mt-1">Lengkapi data di bawah ini untuk
                        membuat kredensial pengguna baru.</p>
                </div>
                <form method="POST" action="{{ route('users.users.store') }}" class="space-y-6">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="font-label-sm text-label-sm text-on-surface-variant" for="fullname">Nama
                                Lengkap</label>
                            <input name="name"
                                class="w-full bg-white border border-outline-variant rounded-lg p-3 text-body-md focus:border-primary-container focus:ring-1 focus:ring-primary-container outline-none transition-all"
                                id="fullname" placeholder="Masukkan nama lengkap" type="text" />
                        </div>
                        <div class="space-y-2">
                            <label class="font-label-sm text-label-sm text-on-surface-variant" for="email">Alamat
                                Email</label>
                            <input name="email"
                                class="w-full bg-white border border-outline-variant rounded-lg p-3 text-body-md focus:border-primary-container focus:ring-1 focus:ring-primary-container outline-none transition-all"
                                id="email" placeholder="contoh@domain.com" type="email" />
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div x-data="{
                            open: false,
                            selected: '',
                            selectedLabel: 'Pilih Peran...'
                        }" class="space-y-2">
                            <label class="block text-sm font-semibold text-slate-700">
                                Peran (Role)
                            </label>
                            <input type="hidden" name="role" :value="selected">
                            <button type="button" @click="open = !open" @click.away="open = false"
                                class="w-full bg-white border border-outline-variant rounded-lg p-3 text-body-md outline-none transition-all flex items-center justify-between hover:border-primary-container focus:border-primary-container focus:ring-1 focus:ring-primary-container">
                                <span class="text-left" :class="selected == '' ? 'text-slate-400' : 'text-slate-800'"
                                    x-text="selectedLabel">
                                </span>
                                <span class="material-symbols-outlined text-outline transition-transform duration-200"
                                    :class="open ? 'rotate-180' : ''">
                                    expand_more
                                </span>
                            </button>
                            <div x-show="open" x-transition
                                class="overflow-hidden rounded-lg border border-slate-200 bg-white shadow-md">
                                <button type="button" @click="selected='Administrator'; selectedLabel='Administrator'; open=false"
                                    class="w-full flex items-center gap-3 px-4 py-3 text-left text-sm text-slate-700 hover:bg-slate-50 transition">

                                    <span>Administrator</span>
                                </button>
                                <button type="button" @click="selected='Manager'; selectedLabel='Manager'; open=false"
                                    class="w-full flex items-center gap-3 px-4 py-3 text-left text-sm text-slate-700 hover:bg-slate-50 border-t border-slate-100 transition">

                                    <span>Manager</span>
                                </button>
                                <button type="button" @click="selected='Staff'; selectedLabel='Staff'; open=false"
                                    class="w-full flex items-center gap-3 px-4 py-3 text-left text-sm text-slate-700 hover:bg-slate-50 border-t border-slate-100 transition">

                                    <span>Staff</span>
                                </button>
                            </div>
                        </div>
                        <div class="space-y-2 relative">
                            <div x-data="{ showPassword: false }" class="space-y-2 relative">
                                <label class="font-label-sm text-label-sm text-on-surface-variant" for="password">
                                    Kata Sandi
                                </label>
                                <div class="relative">
                                    <input id="password" name="password" placeholder="Min. 8 karakter"
                                        :type="showPassword ? 'text' : 'password'"
                                        class="w-full bg-white border border-outline-variant rounded-lg p-3 pr-12 text-body-md focus:border-primary-container focus:ring-1 focus:ring-primary-container outline-none transition-all" />
                                    <button type="button" @click="showPassword = !showPassword"
                                        class="absolute right-3 top-3 text-outline hover:text-primary transition-colors">
                                        <span class="material-symbols-outlined"
                                            x-text="showPassword ? 'visibility_off' : 'visibility'">
                                        </span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="pt-6 border-t border-slate-100 flex items-center justify-between">
                        <div class="flex items-center space-x-2 text-on-surface-variant">
                            <span class="material-symbols-outlined text-sm" data-icon="info">info</span>
                            <p class="text-[12px]">Pengguna akan menerima email aktivasi secara otomatis.</p>
                        </div>
                        <div class="flex space-x-3">
                            <a href="{{ route('users.user-data') }}"
                                class="px-6 py-2 border border-primary-container text-primary-container font-label-sm text-label-sm rounded-lg hover:bg-slate-50 transition-all"
                                type="button">Batal</a>
                            <button
                                class="px-6 py-2 bg-primary-container text-white font-label-sm text-label-sm rounded-lg hover:opacity-90 active:scale-95 transition-all"
                                type="submit">Simpan Pengguna</button>
                        </div>
                    </div>
            </div>
            <!-- Sidebar Configuration Section -->
            <div class="col-span-12 lg:col-span-4 space-y-6">
                <!-- Status Toggle Card -->
                <div class="bg-white p-lg rounded-xl border border-slate-200 shadow-[0px_4px_20px_rgba(0,0,0,0.05)]">
                    <h3 class="font-headline-md text-headline-md text-primary-container mb-4">Status Akun</h3>
                    <div x-data="{ active: true }"
                        class="flex items-center justify-between p-4 bg-surface rounded-lg border border-slate-100">

                        {{-- Text --}}
                        <div class="flex flex-col">
                            <span class="font-label-sm text-label-sm text-on-surface">
                                Status Aktif
                            </span>

                            <span class="text-[11px] text-on-surface-variant">
                                Izinkan akses login segera
                            </span>
                        </div>

                        <input type="hidden" name="status" :value="active ? 'Active' : 'Inactive'">

                        {{-- Switch --}}
                        <button @click="active = !active" :class="active ? 'bg-secondary-container' : 'bg-slate-300'"
                            class="w-12 h-6 rounded-full relative p-1 transition-all duration-300">

                            {{-- Circle --}}
                            <div :class="active ? 'translate-x-3' : 'translate-x-0'"
                                class="w-4 h-4 bg-white rounded-full shadow-md transform transition-all duration-300">
                            </div>

                        </button>

                    </div>
                    <div class="mt-4 p-3 bg-secondary-container/10 border border-secondary-container/20 rounded-lg">
                        <p class="text-[12px] text-on-secondary-fixed-variant leading-relaxed">
                            <span class="font-bold">Aktif:</span> Pengguna dapat langsung mengakses sistem setelah email
                            diverifikasi.
                        </p>
                    </div>
                </div>
                </form>

                <!-- Permissions Preview Card (Glassmorphism effect) -->
                <div class="bg-[#131b2e] p-lg rounded-xl text-white shadow-xl relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-secondary/20 blur-3xl -mr-16 -mt-16"></div>
                    <h3 class="font-headline-md text-headline-md mb-4 relative z-10">Ringkasan Izin</h3>
                    <ul class="space-y-3 relative z-10">
                        <li class="flex items-start space-x-3 text-slate-300">
                            <span class="material-symbols-outlined text-sm mt-1 text-secondary"
                                data-icon="check_circle">check_circle</span>
                            <span class="text-sm">Akses Dashboard Analitik</span>
                        </li>
                        <li class="flex items-start space-x-3 text-slate-300">
                            <span class="material-symbols-outlined text-sm mt-1 text-secondary"
                                data-icon="check_circle">check_circle</span>
                            <span class="text-sm">Melihat Data Karyawan</span>
                        </li>
                        <li class="flex items-start space-x-3 text-slate-400">
                            <span class="material-symbols-outlined text-sm mt-1" data-icon="cancel">cancel</span>
                            <span class="text-sm">Edit Matriks Perhitungan</span>
                        </li>
                        <li class="flex items-start space-x-3 text-slate-400">
                            <span class="material-symbols-outlined text-sm mt-1" data-icon="cancel">cancel</span>
                            <span class="text-sm">Manajemen User (Admin)</span>
                        </li>
                    </ul>
                    <div class="mt-6 pt-4 border-t border-white/10">
                        <p class="text-[10px] text-slate-500 uppercase tracking-widest font-bold">Status Izin Otomatis
                        </p>
                        <p class="text-xs text-slate-400 mt-1 italic">Tergantung pada peran yang dipilih di samping.</p>
                    </div>
                </div>
                <!-- Quick Guide Card -->
                <div class="bg-surface-container-low p-lg rounded-xl border border-slate-200">
                    <div class="flex items-center space-x-2 mb-3">
                        <span class="material-symbols-outlined text-on-tertiary-container" data-icon="help">help</span>
                        <h3 class="font-label-sm text-label-sm text-primary-container">Panduan Cepat</h3>
                    </div>
                    <p class="text-[13px] text-on-surface-variant leading-relaxed">
                        Pastikan alamat email yang dimasukkan valid dan unik. Pengguna akan dikirimi instruksi set-up
                        mandiri jika password tidak ditentukan secara manual oleh administrator.
                    </p>
                </div>
            </div>
        </div>
    </section>
@endsection
