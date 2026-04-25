@extends('layouts.app')

@section('content')
    <section class="p-8 space-y-8 flex-1">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
            <div>
                <h2 class="font-headline-lg text-headline-lg text-slate-900">Manajemen Pengguna</h2>
                <p class="font-body-md text-body-md text-slate-500 mt-1">Kelola hak akses, peran, dan aktivitas pengguna
                    dalam sistem DSS.</p>
            </div>
            <a
                class="flex items-center justify-center space-x-2 px-6 py-2.5 bg-primary text-white font-semibold rounded-lg hover:bg-slate-800 active:opacity-80 transition-all shadow-sm"
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
                    <button class="p-2 text-slate-400 hover:text-slate-600 transition-colors">
                        <span class="material-symbols-outlined" data-icon="filter_list">filter_list</span>
                    </button>
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
                            <th
                                class="px-6 py-4 font-label-sm text-label-sm text-slate-600 uppercase tracking-wider text-right">
                                Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        <!-- User Row 1 -->
                        <tr class="hover:bg-slate-50/80 transition-colors group">
                            <td class="px-6 py-4">
                                <div class="flex items-center space-x-3">
                                    <div
                                        class="w-9 h-9 rounded-full bg-slate-200 flex items-center justify-center text-slate-600 font-bold text-xs">
                                        AA</div>
                                    <div>
                                        <p class="font-Inter text-sm font-semibold text-slate-900">Ahmad Alfian</p>
                                        <p class="text-[11px] text-slate-500">ID: USR-001</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 font-data-tabular text-data-tabular text-slate-600">alfian.ahmad@dss.com
                            </td>
                            <td class="px-6 py-4">
                                <span
                                    class="px-3 py-1 bg-slate-100 text-slate-800 text-[11px] font-bold rounded-full border border-slate-200">Admin</span>
                            </td>
                            <td class="px-6 py-4 font-data-tabular text-data-tabular text-slate-500">Today, 08:45 AM</td>
                            <td class="px-6 py-4">
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    Active
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div
                                    class="flex items-center justify-end space-x-1 opacity-0 group-hover:opacity-100 transition-opacity">
                                    <button
                                        class="p-2 text-slate-400 hover:text-secondary hover:bg-secondary/10 rounded-lg transition-all"
                                        title="Edit">
                                        <span class="material-symbols-outlined text-[18px]" data-icon="edit">edit</span>
                                    </button>
                                    <button
                                        class="p-2 text-slate-400 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-all"
                                        title="Reset Password">
                                        <span class="material-symbols-outlined text-[18px]"
                                            data-icon="lock_reset">lock_reset</span>
                                    </button>
                                    <button
                                        class="p-2 text-slate-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-all"
                                        title="Delete">
                                        <span class="material-symbols-outlined text-[18px]" data-icon="delete">delete</span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <!-- User Row 2 -->
                        <tr class="hover:bg-slate-50/80 transition-colors group border-y border-slate-50">
                            <td class="px-6 py-4">
                                <div class="flex items-center space-x-3">
                                    <img class="w-9 h-9 rounded-full object-cover"
                                        data-alt="professional portrait of a young woman with dark hair in business attire, clean office background"
                                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuBTt-FHv76-2fS6Im_Yd9JyDAxaGyAgLLKe4eMuDa43LygucVSyxgP7a-i0hCSafIGdmPDm7yTeR71313jyuV_FSHolVw9ByOUjQWBQnxSl3Op8Q5XN0K66LzwMgX0tVshfVG-or-8pk2XmZkh0zRecAW09Au09q5xi9OnH8xcXawau6stcEx4SI9rrYa1hQSxQi7GikMzlT4-l1yFuh2tKdANstYtoqGDj0_SY6H9TID51l4afebLkHPj77EzeWyD7JKTNWgu2X_ln" />
                                    <div>
                                        <p class="font-Inter text-sm font-semibold text-slate-900">Siti Rahmawati</p>
                                        <p class="text-[11px] text-slate-500">ID: USR-002</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 font-data-tabular text-data-tabular text-slate-600">rahma.siti@dss.com</td>
                            <td class="px-6 py-4">
                                <span
                                    class="px-3 py-1 bg-secondary/10 text-secondary text-[11px] font-bold rounded-full border border-secondary/20">Manager</span>
                            </td>
                            <td class="px-6 py-4 font-data-tabular text-data-tabular text-slate-500">Yesterday, 04:12 PM
                            </td>
                            <td class="px-6 py-4">
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    Active
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div
                                    class="flex items-center justify-end space-x-1 opacity-0 group-hover:opacity-100 transition-opacity">
                                    <button
                                        class="p-2 text-slate-400 hover:text-secondary hover:bg-secondary/10 rounded-lg transition-all"
                                        title="Edit">
                                        <span class="material-symbols-outlined text-[18px]" data-icon="edit">edit</span>
                                    </button>
                                    <button
                                        class="p-2 text-slate-400 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-all"
                                        title="Reset Password">
                                        <span class="material-symbols-outlined text-[18px]"
                                            data-icon="lock_reset">lock_reset</span>
                                    </button>
                                    <button
                                        class="p-2 text-slate-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-all"
                                        title="Delete">
                                        <span class="material-symbols-outlined text-[18px]"
                                            data-icon="delete">delete</span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <!-- User Row 3 -->
                        <tr class="hover:bg-slate-50/80 transition-colors group">
                            <td class="px-6 py-4">
                                <div class="flex items-center space-x-3">
                                    <div
                                        class="w-9 h-9 rounded-full bg-slate-200 flex items-center justify-center text-slate-600 font-bold text-xs">
                                        BP</div>
                                    <div>
                                        <p class="font-Inter text-sm font-semibold text-slate-900">Budi Pratama</p>
                                        <p class="text-[11px] text-slate-500">ID: USR-003</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 font-data-tabular text-data-tabular text-slate-600">budi.p@dss.com</td>
                            <td class="px-6 py-4">
                                <span
                                    class="px-3 py-1 bg-slate-100 text-slate-600 text-[11px] font-bold rounded-full border border-slate-200">Staff</span>
                            </td>
                            <td class="px-6 py-4 font-data-tabular text-data-tabular text-slate-500">Oct 12, 2023</td>
                            <td class="px-6 py-4">
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-slate-100 text-slate-600">
                                    Inactive
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div
                                    class="flex items-center justify-end space-x-1 opacity-0 group-hover:opacity-100 transition-opacity">
                                    <button
                                        class="p-2 text-slate-400 hover:text-secondary hover:bg-secondary/10 rounded-lg transition-all"
                                        title="Edit">
                                        <span class="material-symbols-outlined text-[18px]" data-icon="edit">edit</span>
                                    </button>
                                    <button
                                        class="p-2 text-slate-400 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-all"
                                        title="Reset Password">
                                        <span class="material-symbols-outlined text-[18px]"
                                            data-icon="lock_reset">lock_reset</span>
                                    </button>
                                    <button
                                        class="p-2 text-slate-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-all"
                                        title="Delete">
                                        <span class="material-symbols-outlined text-[18px]"
                                            data-icon="delete">delete</span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <!-- User Row 4 -->
                        <tr class="hover:bg-slate-50/80 transition-colors group">
                            <td class="px-6 py-4">
                                <div class="flex items-center space-x-3">
                                    <img class="w-9 h-9 rounded-full object-cover"
                                        data-alt="headshot of a middle-aged male professional with glasses smiling slightly in a modern workspace"
                                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuCUdi6gcQH_Enmf3BkCoBSDl2roV3gpX5OgmGhNkI-8sBKEd30RitXu-3wpJFf9_F_YBEVHqdbnscPkuqwF-RI8AI3nIu0a4TzVru2l30Ttp9NgkXEWLZbury2ikxZaqrN207HrSh0pI04FtjvuwuL6qvBqy8I1UE8EzOsDdrj4FhWGoLjZnK7jZoTCkiQmxe6TMRGNCViiW5p60RVDlnpzbFlqKSa11YUTDT7JPMvJ3HnkXgHMbCEk1DU_2VIQgWrOh06fHxyk4s4b" />
                                    <div>
                                        <p class="font-Inter text-sm font-semibold text-slate-900">Dr. Haryanto</p>
                                        <p class="text-[11px] text-slate-500">ID: USR-004</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 font-data-tabular text-data-tabular text-slate-600">haryanto.dr@dss.com
                            </td>
                            <td class="px-6 py-4">
                                <span
                                    class="px-3 py-1 bg-secondary/10 text-secondary text-[11px] font-bold rounded-full border border-secondary/20">Manager</span>
                            </td>
                            <td class="px-6 py-4 font-data-tabular text-data-tabular text-slate-500">Today, 10:15 AM</td>
                            <td class="px-6 py-4">
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    Active
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div
                                    class="flex items-center justify-end space-x-1 opacity-0 group-hover:opacity-100 transition-opacity">
                                    <button
                                        class="p-2 text-slate-400 hover:text-secondary hover:bg-secondary/10 rounded-lg transition-all"
                                        title="Edit">
                                        <span class="material-symbols-outlined text-[18px]" data-icon="edit">edit</span>
                                    </button>
                                    <button
                                        class="p-2 text-slate-400 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-all"
                                        title="Reset Password">
                                        <span class="material-symbols-outlined text-[18px]"
                                            data-icon="lock_reset">lock_reset</span>
                                    </button>
                                    <button
                                        class="p-2 text-slate-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-all"
                                        title="Delete">
                                        <span class="material-symbols-outlined text-[18px]"
                                            data-icon="delete">delete</span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="px-6 py-4 border-t border-slate-100 bg-slate-50 flex items-center justify-between">
                <p class="font-body-md text-body-md text-slate-500">Showing 4 of 42 users</p>
                <div class="flex space-x-2">
                    <button
                        class="px-4 py-1.5 border border-slate-200 bg-white rounded text-sm font-medium text-slate-600 hover:bg-slate-50 disabled:opacity-50 transition-colors"
                        disabled="">Previous</button>
                    <button
                        class="px-4 py-1.5 border border-slate-200 bg-white rounded text-sm font-medium text-slate-600 hover:bg-slate-50 transition-colors">Next</button>
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
                            <label class="font-label-sm text-label-sm text-slate-700 block">Pilih Peran (Role)</label>
                            <select
                                class="w-full px-4 py-2.5 bg-white border border-slate-200 rounded-lg text-sm focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all">
                                <option>Staff</option>
                                <option>Manager</option>
                                <option>Administrator</option>
                            </select>
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
