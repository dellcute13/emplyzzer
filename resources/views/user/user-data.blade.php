@extends('layouts.app')

@section('content')
    <section class="p-8 space-y-8 flex-1">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
            <div>
                <h2 class="font-headline-lg text-headline-lg text-slate-900">Manajemen Pengguna</h2>
                <p class="font-body-md text-body-md text-slate-500 mt-1">Kelola hak akses, peran, dan aktivitas pengguna
                    dalam sistem DSS.</p>
            </div>
            <a class="flex items-center justify-center space-x-2 px-6 py-2.5 bg-primary text-white font-semibold rounded-lg hover:bg-slate-800 active:opacity-80 transition-all shadow-sm"
                href="{{ route('users.user-add') }}">
                <span class="material-symbols-outlined text-sm" data-icon="add">add</span>
                <span>Tambah Pengguna</span>
            </a>
        </div>
        <!-- Stats Bento Grid -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-[0px_4px_20px_rgba(0,0,0,0.05)]">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-2 bg-slate-100 rounded-lg text-slate-600">
                        <span class="material-symbols-outlined" data-icon="group">group</span>
                    </div>
                    <span class="text-[11px] font-bold text-green-600 bg-green-50 px-2 py-0.5 rounded-full">+12%</span>
                </div>
                <p class="font-label-sm text-label-sm text-slate-500 uppercase">Total Pengguna</p>
                <h3 class="font-display-xl text-display-xl text-slate-900">42</h3>
            </div>
            <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-[0px_4px_20px_rgba(0,0,0,0.05)]">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-2 bg-secondary/10 rounded-lg text-secondary">
                        <span class="material-symbols-outlined" data-icon="shield_person">shield_person</span>
                    </div>
                </div>
                <p class="font-label-sm text-label-sm text-slate-500 uppercase">Administrator</p>
                <h3 class="font-display-xl text-display-xl text-slate-900">4</h3>
            </div>
            <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-[0px_4px_20px_rgba(0,0,0,0.05)]">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-2 bg-slate-100 rounded-lg text-slate-600">
                        <span class="material-symbols-outlined"
                            data-icon="supervised_user_circle">supervised_user_circle</span>
                    </div>
                </div>
                <p class="font-label-sm text-label-sm text-slate-500 uppercase">Manager / Staff</p>
                <h3 class="font-display-xl text-display-xl text-slate-900">38</h3>
            </div>
            <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-[0px_4px_20px_rgba(0,0,0,0.05)]">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-2 bg-green-50 rounded-lg text-green-600">
                        <span class="material-symbols-outlined" data-icon="online_prediction">online_prediction</span>
                    </div>
                    <span class="flex h-2 w-2 relative">
                        <span
                            class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-green-500"></span>
                    </span>
                </div>
                <p class="font-label-sm text-label-sm text-slate-500 uppercase">Aktif Sekarang</p>
                <h3 class="font-display-xl text-display-xl text-slate-900">8</h3>
            </div>
        </div>
        <!-- User Table Container -->
        <div class="bg-white rounded-xl border border-slate-200 shadow-[0px_4px_20px_rgba(0,0,0,0.05)] overflow-hidden">
            <div class="px-6 py-5 border-b border-slate-100 flex items-center justify-between">
                <h3 class="font-headline-md text-headline-md text-slate-900">Daftar Pengguna</h3>
                <div class="flex items-center space-x-2">
                    <div x-data="{ open: false, selected: 'Urutkan Data' }" class="relative">
                        <!-- BUTTON -->
                        <button type="button" @click="open = !open" @click.away="open = false"
                            class="p-2 text-slate-400 hover:text-slate-600 transition-colors flex items-center gap-1">
                            <span class="material-symbols-outlined">
                                filter_list
                            </span>
                        </button>
                        <!-- DROPDOWN -->
                        <div x-show="open" x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 scale-95 -translate-y-1"
                            x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                            x-transition:leave-end="opacity-0 scale-95 -translate-y-1"
                            class="absolute right-0 mt-2 w-56 overflow-hidden rounded-xl border border-slate-200 bg-white shadow-xl z-50">
                            <!-- Terbaru -->
                            <a href="?sort=latest" @click="selected='Terbaru'; open=false"
                                class="w-full flex items-center px-4 py-3 text-sm text-slate-700 hover:bg-slate-50 transition {{ $sort == 'latest' ? 'font-bold text-primary bg-slate-50' : '' }}">
                                Terbaru
                            </a>
                            <!-- Terlama -->
                            <a href="?sort=oldest" @click="selected='Terlama'; open=false"
                                class="w-full flex items-center px-4 py-3 text-sm text-slate-700 hover:bg-slate-50 border-t border-slate-100 transition {{ $sort == 'oldest' ? 'font-bold text-primary bg-slate-50' : '' }}">
                                Terlama
                            </a>
                            <!-- A-Z -->
                            <a href="?sort=name_asc" @click="selected='Nama A-Z'; open=false"
                                class="w-full flex items-center px-4 py-3 text-sm text-slate-700 hover:bg-slate-50 border-t border-slate-100 transition {{ $sort == 'name_asc' ? 'font-bold text-primary bg-slate-50' : '' }}">
                                Nama A-Z
                            </a>
                            <!-- Z-A -->
                            <a href="?sort=name_desc" @click="selected='Nama Z-A'; open=false"
                                class="w-full flex items-center px-4 py-3 text-sm text-slate-700 hover:bg-slate-50 border-t border-slate-100 transition {{ $sort == 'name_desc' ? 'font-bold text-primary bg-slate-50' : '' }}">
                                Nama Z-A
                            </a>
                        </div>
                    </div>
                    <button class="p-2 text-slate-400 hover:text-slate-600 transition-colors">
                        <span class="material-symbols-outlined" data-icon="download">download</span>
                    </button>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-slate-50">
                        <tr>
                            <th class="px-6 py-4 font-label-sm text-label-sm text-slate-600 uppercase tracking-wider">Nama
                                Lengkap</th>
                            <th class="px-6 py-4 font-label-sm text-label-sm text-slate-600 uppercase tracking-wider">Email
                            </th>
                            <th class="px-6 py-4 font-label-sm text-label-sm text-slate-600 uppercase tracking-wider">Peran
                            </th>
                            <th class="px-6 py-4 font-label-sm text-label-sm text-slate-600 uppercase tracking-wider">Login
                                Terakhir</th>
                            <th class="px-6 py-4 font-label-sm text-label-sm text-slate-600 uppercase tracking-wider">Status
                            </th>
                            <th class="px-6 py-4 font-label-sm text-label-sm text-slate-600 uppercase tracking-wider">
                                Aktivitas Terakhir</th>
                            <th
                                class="px-6 py-4 font-label-sm text-label-sm text-slate-600 uppercase tracking-wider text-right">
                                Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($users as $user)
                            <tr class="hover:bg-slate-50/80 transition-colors group">
                                <td class="px-6 py-4">
                                    <div class="flex items-center space-x-3">
                                        <div
                                            class="w-9 h-9 rounded-full bg-slate-200 flex items-center justify-center text-slate-600 font-bold text-xs">
                                            {{ strtoupper(substr($user->name, 0, 2)) }}
                                        </div>
                                        <div>
                                            <p class="font-Inter text-sm font-semibold text-slate-900">
                                                {{ $user->name }}
                                            </p>
                                            <p class="text-[11px] text-slate-500">
                                                ID: #{{ $user->id }}
                                            </p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 font-data-tabular text-data-tabular text-slate-600">
                                    {{ $user->email }}
                                </td>
                                <td class="px-6 py-4">
                                    <span
                                        class="px-3 py-1 bg-slate-100 text-slate-800 text-[11px] font-bold rounded-full border border-slate-200">
                                        {{ $user->role }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 font-data-tabular text-data-tabular text-slate-500">
                                    {{ $user->last_login ? \Carbon\Carbon::parse($user->last_login)->translatedFormat('d F Y, H:i') . ' WIB' : '-' }}
                                </td>
                                <td class="px-6 py-4">
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $user->status == 'Active' ? 'bg-green-100 text-green-800' : 'bg-slate-100 text-slate-600' }}">
                                        {{ $user->status ?? 'Inactive' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 font-data-tabular text-data-tabular text-slate-500">
                                    <div class="flex items-center gap-2">

                                        <!-- Dot -->
                                        <div
                                            class="w-2 h-2 rounded-full 
        {{ $user->isOnline() ? 'bg-green-500' : 'bg-slate-400' }}">
                                        </div>

                                        <!-- Text -->
                                        <span class="text-xs text-slate-500">

                                            @if ($user->isOnline())
                                                Online
                                            @else
                                                Terakhir aktif {{ $user->lastSeen() }}
                                            @endif

                                        </span>

                                    </div>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div
                                        class="flex items-center justify-end space-x-1 opacity-0 group-hover:opacity-100 transition-opacity">
                                        <button
                                            class="p-2 text-slate-400 hover:text-secondary hover:bg-secondary/10 rounded-lg transition-all">
                                            <span class="material-symbols-outlined text-[18px]">edit</span>
                                        </button>
                                        <button
                                            class="p-2 text-slate-400 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-all">
                                            <span class="material-symbols-outlined text-[18px]">lock_reset</span>
                                        </button>
                                        <button
                                            class="p-2 text-slate-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-all">
                                            <span class="material-symbols-outlined text-[18px]">delete</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-6 text-slate-400">
                                    Data user belum ada
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="px-6 py-4 border-t border-slate-100 bg-slate-50 flex items-center justify-between">
                <p class="font-body-md text-body-md text-slate-500">Showing {{ $users->firstItem() }} -
                    {{ $users->lastItem() }} of {{ $users->total() }} users</p>
                <div class="flex space-x-2">

                    @if ($users->onFirstPage())
                        <button disabled
                            class="px-4 py-1.5 border border-slate-200 bg-white rounded text-sm font-medium text-slate-400">
                            Previous
                        </button>
                    @else
                        <a href="{{ $users->previousPageUrl() }}"
                            class="px-4 py-1.5 border border-slate-200 bg-white rounded text-sm font-medium text-slate-600 hover:bg-slate-50">
                            Previous
                        </a>
                    @endif

                    @if ($users->hasMorePages())
                        <a href="{{ $users->nextPageUrl() }}"
                            class="px-4 py-1.5 border border-slate-200 bg-white rounded text-sm font-medium text-slate-600 hover:bg-slate-50">
                            Next
                        </a>
                    @else
                        <button disabled
                            class="px-4 py-1.5 border border-slate-200 bg-white rounded text-sm font-medium text-slate-400">
                            Next
                        </button>
                    @endif

                </div>
            </div>
        </div>
        <!-- Add User Form Section (Inline Layout) -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div
                class="lg:col-span-2 bg-white rounded-xl border border-slate-200 shadow-[0px_4px_20px_rgba(0,0,0,0.05)] p-8">
                <div class="flex items-center space-x-3 mb-6">
                    <div class="p-2 bg-primary/10 rounded-lg text-primary">
                        <span class="material-symbols-outlined" data-icon="person_add">person_add</span>
                    </div>
                    <h3 class="font-headline-md text-headline-md text-slate-900">Tambah Pengguna Baru</h3>
                </div>
                <form class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="font-label-sm text-label-sm text-slate-700 block">Nama Lengkap</label>
                            <input
                                class="w-full px-4 py-2.5 bg-white border border-slate-200 rounded-lg text-sm focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all"
                                placeholder="e.g. John Doe" type="text" />
                        </div>
                        <div class="space-y-2">
                            <label class="font-label-sm text-label-sm text-slate-700 block">Alamat Email</label>
                            <input
                                class="w-full px-4 py-2.5 bg-white border border-slate-200 rounded-lg text-sm focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all"
                                placeholder="john.doe@company.com" type="email" />
                        </div>
                        <div class="space-y-2">
                            <div x-data="{ open: false, selected: 'Pilih Peran (Role)' }" class="space-y-2 relative">

                                <label class="text-label-sm font-label-sm text-on-surface-variant flex items-center gap-1">
                                    Peran (Role)
                                    <span class="text-error">*</span>
                                </label>

                                <input type="hidden" name="role" :value="selected">

                                <button type="button" @click="open = !open" @click.away="open = false"
                                    class="w-full bg-white border border-outline-variant rounded-lg p-3 text-body-md outline-none transition-all flex items-center justify-between hover:border-primary-container focus:border-primary-container focus:ring-1 focus:ring-primary-container h-11">

                                    <span class="text-left"
                                        :class="selected == 'Pilih Peran (Role)' ? 'text-slate-800' : 'text-slate-800user'"
                                        x-text="selected">
                                    </span>

                                    <span
                                        class="material-symbols-outlined text-slate-400 transition-transform duration-200"
                                        :class="open ? 'rotate-180' : ''">
                                        expand_more
                                    </span>
                                </button>

                                <div x-show="open" x-transition:enter="transition ease-out duration-200"
                                    x-transition:enter-start="opacity-0 scale-95 -translate-y-1"
                                    x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                                    x-transition:leave="transition ease-in duration-150"
                                    x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                                    x-transition:leave-end="opacity-0 scale-95 -translate-y-1"
                                    class="absolute z-50 mt-2 w-full overflow-hidden rounded-xl border border-slate-200 bg-white shadow-xl">

                                    <button type="button" @click="selected='Administrator'; open=false"
                                        class="w-full flex items-center gap-3 px-4 py-3 text-left text-sm text-slate-700 hover:bg-slate-50 border-t border-slate-100 transition">
                                        Administrator
                                    </button>

                                    <button type="button" @click="selected='Manager'; open=false"
                                        class="w-full flex items-center gap-3 px-4 py-3 text-left text-sm text-slate-700 hover:bg-slate-50 border-t border-slate-100 transition">
                                        Manager
                                    </button>

                                    <button type="button" @click="selected='Staff'; open=false"
                                        class="w-full flex items-center gap-3 px-4 py-3 text-left text-sm text-slate-700 hover:bg-slate-50 border-t border-slate-100 transition">
                                        Staff
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="space-y-2">
                            <label class="font-label-sm text-label-sm text-slate-700 block">Status Awal</label>
                            <div class="flex items-center space-x-4 h-[45px]">
                                <label class="flex items-center cursor-pointer">
                                    <input checked=""
                                        class="w-4 h-4 text-primary border-slate-300 focus:ring-primary/20" name="status"
                                        type="radio" />
                                    <span class="ml-2 text-sm text-slate-600">Aktif</span>
                                </label>
                                <label class="flex items-center cursor-pointer">
                                    <input class="w-4 h-4 text-primary border-slate-300 focus:ring-primary/20"
                                        name="status" type="radio" />
                                    <span class="ml-2 text-sm text-slate-600">Non-Aktif</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="pt-4 border-t border-slate-100 flex justify-end space-x-4">
                        <button
                            class="px-6 py-2 border border-slate-200 text-slate-600 font-semibold rounded-lg hover:bg-slate-50 transition-all"
                            type="button">Batalkan</button>
                        <button
                            class="px-8 py-2 bg-primary text-white font-semibold rounded-lg hover:bg-slate-800 active:scale-[0.98] transition-all"
                            type="submit">Simpan Pengguna</button>
                    </div>
                </form>
            </div>
            <!-- Info Sidebar/Help -->
            <div class="space-y-6">
                <div class="bg-primary text-white rounded-xl p-8 shadow-lg relative overflow-hidden">
                    <div class="relative z-10">
                        <h4 class="font-headline-md text-headline-md mb-3">Keamanan Sistem</h4>
                        <p class="text-white/80 text-sm leading-relaxed mb-6">
                            Setiap penambahan pengguna akan dicatat dalam audit log. Pastikan memberikan peran yang sesuai
                            dengan prinsip <span class="font-bold italic">Least Privilege</span>.
                        </p>
                        <div class="flex items-center space-x-2 text-sm font-semibold">
                            <span class="material-symbols-outlined" data-icon="verified_user">verified_user</span>
                            <span>SSL Encrypted Connection</span>
                        </div>
                    </div>
                    <div class="absolute -bottom-10 -right-10 w-40 h-40 bg-white/10 rounded-full blur-2xl"></div>
                    <div class="absolute -top-10 -left-10 w-32 h-32 bg-white/5 rounded-full blur-xl"></div>
                </div>
                <div class="bg-white rounded-xl border border-slate-200 shadow-[0px_4px_20px_rgba(0,0,0,0.05)] p-6">
                    <h4 class="font-Inter text-sm font-bold text-slate-900 mb-4 flex items-center">
                        <span class="material-symbols-outlined text-amber-500 mr-2" data-icon="lightbulb">lightbulb</span>
                        Panduan Peran
                    </h4>
                    <div class="space-y-4">
                        <div class="flex space-x-3">
                            <div class="w-1.5 h-1.5 rounded-full bg-slate-900 mt-1.5"></div>
                            <div>
                                <p class="text-xs font-bold text-slate-900">Administrator</p>
                                <p class="text-[11px] text-slate-500">Akses penuh ke semua modul, pengaturan sistem, dan
                                    manajemen database.</p>
                            </div>
                        </div>
                        <div class="flex space-x-3">
                            <div class="w-1.5 h-1.5 rounded-full bg-secondary mt-1.5"></div>
                            <div>
                                <p class="text-xs font-bold text-slate-900">Manager</p>
                                <p class="text-[11px] text-slate-500">Dapat mengelola kriteria, melakukan perhitungan SAW,
                                    dan melihat laporan.</p>
                            </div>
                        </div>
                        <div class="flex space-x-3">
                            <div class="w-1.5 h-1.5 rounded-full bg-slate-400 mt-1.5"></div>
                            <div>
                                <p class="text-xs font-bold text-slate-900">Staff</p>
                                <p class="text-[11px] text-slate-500">Hanya dapat menginput data nilai pegawai dan melihat
                                    hasil perangkingan.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
<script>
    setInterval(() => {
        fetch('/heartbeat', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        });
    }, 30000); // tiap 30 detik
</script>
<script>
    setInterval(() => {
        location.reload();
    }, 60000); // tiap 1 menit
</script>
