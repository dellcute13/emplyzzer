@extends('layouts.app')

@section('content')
    <div class="p-4 sm:p-6 md:p-8 space-y-6 md:space-y-8">
        <!-- Header Section -->
        <div class="flex flex-col gap-1">
            <h2 class="font-headline-lg text-headline-lg text-slate-900">Dashboard Overview</h2>
            <p class="text-on-primary-container text-body-md">Sistem Pendukung Keputusan Pemilihan Pegawai Terbaik -
                Metode SAW</p>
        </div>
        <!-- Stat Cards Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-gutter">
            <!-- Card 1 -->
            <div class="bg-white p-lg rounded-xl border border-slate-200 ambient-shadow flex items-start justify-between">
                <div class="space-y-sm">
                    <p class="text-label-sm text-on-primary-container font-label-sm uppercase tracking-wider">Total
                        Pegawai</p>
                    <h3 class="text-display-xl font-display-xl text-slate-900">150</h3>
                    <p class="text-[10px] text-secondary font-medium flex items-center gap-1">
                        <span class="material-symbols-outlined text-xs" data-icon="trending_up">trending_up</span>
                        +12 New this month
                    </p>
                </div>
                <div class="w-12 h-12 bg-primary-fixed rounded-full flex items-center justify-center">
                    <span class="material-symbols-outlined text-slate-900" data-icon="person">person</span>
                </div>
            </div>
            <!-- Card 2 -->
            <div class="bg-white p-lg rounded-xl border border-slate-200 ambient-shadow flex items-start justify-between">
                <div class="space-y-sm">
                    <p class="text-label-sm text-on-primary-container font-label-sm uppercase tracking-wider">Total
                        Kriteria</p>
                    <h3 class="text-display-xl font-display-xl text-slate-900">5</h3>
                    <p class="text-[10px] text-on-primary-container font-medium">Standardized Evaluation</p>
                </div>
                <div class="w-12 h-12 bg-tertiary-fixed rounded-full flex items-center justify-center">
                    <span class="material-symbols-outlined text-on-tertiary-fixed" data-icon="rule">rule</span>
                </div>
            </div>
            <!-- Card 3 -->
            <div class="bg-white p-lg rounded-xl border border-slate-200 ambient-shadow flex items-start justify-between">
                <div class="space-y-sm">
                    <p class="text-label-sm text-on-primary-container font-label-sm uppercase tracking-wider">
                        Pegawai Terbaik</p>
                    <h3 class="text-headline-md font-headline-md text-slate-900 mt-2">John Doe</h3>
                    <p class="text-[10px] bg-green-100 text-green-700 px-2 py-0.5 rounded-full inline-block font-bold">
                        Top Score: 0.982</p>
                </div>
                <div class="w-12 h-12 bg-secondary-fixed rounded-full flex items-center justify-center overflow-hidden">
                    <img alt="John Doe" class="w-full h-full object-cover"
                        data-alt="professional headshot of a young male employee with short dark hair and a confident smile"
                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuCMT-6MZac4IOnkSbngSrThNfZQFqJwKW1CADwtlkAqswQEaSKqKyJ5IfDXTx2Jw59vUA9YOu3Rzl31BKa6bR7mXxTTfqEEa1Jo0Ci8WAYMWB12Y2oOpx04jwrOCz18tcIyCTUFxIdVLrKltj3OwN2_-HqEQPlWZ-HYA54_SNcUAq417wxxoKhy1UqLE9ixNisEJTCRh3d_bK-QIKSmoHu0cG8q8mcb6HzpvQgO7pzRKkLkLRXCHzzKFSQkuv9F6VPNPmXPumhRvz3Z" />
                </div>
            </div>
            <!-- Card 4 -->
            <div class="bg-white p-lg rounded-xl border border-slate-200 ambient-shadow flex items-start justify-between">
                <div class="space-y-sm">
                    <p class="text-label-sm text-on-primary-container font-label-sm uppercase tracking-wider">
                        Rata-rata Nilai</p>
                    <h3 class="text-display-xl font-display-xl text-slate-900">85.5</h3>
                    <p class="text-[10px] text-on-primary-container font-medium">Global performance average</p>
                </div>
                <div class="w-12 h-12 bg-surface-container-highest rounded-full flex items-center justify-center">
                    <span class="material-symbols-outlined text-slate-900" data-icon="avg_time">avg_time</span>
                </div>
            </div>
            <!-- Card 5 --->
             <div class="bg-white p-lg rounded-xl border border-slate-200 ambient-shadow">
        <div class="space-y-sm mb-4">
            <p class="text-label-sm text-on-primary-container font-label-sm uppercase tracking-wider">
                Gender Pegawai
            </p>
            <h3 class="text-display-xl font-display-xl text-slate-900">150</h3>
            <p class="text-[10px] text-on-primary-container font-medium">
                Total berdasarkan jenis kelamin
            </p>
        </div>

        <!-- Bawah -->
        <div class="grid grid-cols-2 gap-2 mt-3">
            <div class="bg-pink-50 rounded-lg p-3 text-center">
                <span class="material-symbols-outlined text-pink-500 text-xl">female</span>
                <p class="text-sm font-semibold text-slate-800">Perempuan</p>
                <p class="text-lg font-bold text-pink-600">70</p>
            </div>

            <div class="bg-blue-50 rounded-lg p-3 text-center">
                <span class="material-symbols-outlined text-blue-500 text-xl">male</span>
                <p class="text-sm font-semibold text-slate-800">Laki-laki</p>
                <p class="text-lg font-bold text-blue-600">80</p>
            </div>
        </div>
    </div>


        </div>
        <!-- Main Section: Charts & Tables -->
        <div class="grid grid-cols-12 gap-gutter">
            <!-- Large Area Chart Container -->
            <div class="col-span-12 lg:col-span-8 bg-white p-lg rounded-xl border border-slate-200 ambient-shadow">
                <div class="flex items-center justify-between mb-lg">
                    <div>
                        <h4 class="text-headline-md font-headline-md text-slate-900">Grafik Ranking Pegawai</h4>
                        <p class="text-sm text-on-primary-container">Top performances trends (Monthly normalized
                            score)</p>
                    </div>
                    <div class="flex gap-2">
                        <button
                            class="px-4 py-2 text-xs font-bold bg-slate-100 rounded-lg hover:bg-slate-200 transition-colors">Export
                            CSV</button>
                        <button
                            class="px-4 py-2 text-xs font-bold bg-primary-container text-white rounded-lg active:opacity-80 transition-all">Update
                            Calculations</button>
                    </div>
                </div>
                <div class="h-64 relative mt-8">
                    <!-- Mock Chart Visualization -->
                    <div class="absolute inset-0 flex items-end gap-2 px-2">
                        <div class="w-full bg-slate-50 h-[40%] rounded-t-md relative group">
                            <div
                                class="absolute bottom-full mb-2 left-1/2 -translate-x-1/2 bg-slate-900 text-white text-[10px] px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-opacity">
                                72.4</div>
                        </div>
                        <div class="w-full bg-slate-100 h-[55%] rounded-t-md relative group">
                            <div
                                class="absolute bottom-full mb-2 left-1/2 -translate-x-1/2 bg-slate-900 text-white text-[10px] px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-opacity">
                                78.1</div>
                        </div>
                        <div class="w-full bg-slate-200 h-[65%] rounded-t-md relative group">
                            <div
                                class="absolute bottom-full mb-2 left-1/2 -translate-x-1/2 bg-slate-900 text-white text-[10px] px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-opacity">
                                82.3</div>
                        </div>
                        <div class="w-full bg-primary-fixed h-[80%] rounded-t-md relative group">
                            <div
                                class="absolute bottom-full mb-2 left-1/2 -translate-x-1/2 bg-slate-900 text-white text-[10px] px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-opacity">
                                88.5</div>
                        </div>
                        <div class="w-full bg-primary-container h-[95%] rounded-t-md relative group">
                            <div
                                class="absolute bottom-full mb-2 left-1/2 -translate-x-1/2 bg-slate-900 text-white text-[10px] px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-opacity">
                                94.2</div>
                        </div>
                        <div class="w-full bg-primary-fixed h-[85%] rounded-t-md relative group">
                            <div
                                class="absolute bottom-full mb-2 left-1/2 -translate-x-1/2 bg-slate-900 text-white text-[10px] px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-opacity">
                                89.9</div>
                        </div>
                        <div class="w-full bg-slate-100 h-[60%] rounded-t-md relative group">
                            <div
                                class="absolute bottom-full mb-2 left-1/2 -translate-x-1/2 bg-slate-900 text-white text-[10px] px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-opacity">
                                79.2</div>
                        </div>
                    </div>
                    <!-- Axis lines -->
                    <div class="absolute inset-0 border-b border-l border-slate-100 pointer-events-none"></div>
                </div>
                <div class="flex justify-between mt-4 text-[10px] font-bold text-on-primary-container px-2">
                    <span>JAN</span><span>FEB</span><span>MAR</span><span>APR</span><span>MAY</span><span>JUN</span><span>JUL</span>
                </div>
            </div>
            <!-- Latest Activities Sidebar -->
            <div class="col-span-12 lg:col-span-4 bg-white p-lg rounded-xl border border-slate-200 ambient-shadow">
                <h4 class="text-headline-md font-headline-md text-slate-900 mb-lg">Aktivitas Terbaru</h4>
                <div class="space-y-6">
                    <div class="flex gap-4">
                        <div class="w-2 bg-secondary rounded-full"></div>
                        <div>
                            <p class="text-body-md font-semibold text-slate-900">Perhitungan SAW Selesai</p>
                            <p class="text-xs text-on-primary-container">Nilai akhir untuk 150 pegawai telah
                                diperbarui.</p>
                            <span class="text-[10px] text-slate-400 mt-1 block">2 mins ago</span>
                        </div>
                    </div>
                    <div class="flex gap-4">
                        <div class="w-2 bg-tertiary-fixed-dim rounded-full"></div>
                        <div>
                            <p class="text-body-md font-semibold text-slate-900">Kriteria Ditambahkan</p>
                            <p class="text-xs text-on-primary-container">Kriteria 'Loyalitas' ditambahkan oleh
                                Admin.</p>
                            <span class="text-[10px] text-slate-400 mt-1 block">4 hours ago</span>
                        </div>
                    </div>
                    <div class="flex gap-4">
                        <div class="w-2 bg-slate-200 rounded-full"></div>
                        <div>
                            <p class="text-body-md font-semibold text-slate-900">Data Pegawai Baru</p>
                            <p class="text-xs text-on-primary-container">Berhasil mengimpor 5 pegawai baru dari
                                HRIS.</p>
                            <span class="text-[10px] text-slate-400 mt-1 block">Yesterday</span>
                        </div>
                    </div>
                    <div class="flex gap-4">
                        <div class="w-2 bg-slate-200 rounded-full"></div>
                        <div>
                            <p class="text-body-md font-semibold text-slate-900">Laporan Bulanan</p>
                            <p class="text-xs text-on-primary-container">Laporan ranking periode Mei telah diunduh.
                            </p>
                            <span class="text-[10px] text-slate-400 mt-1 block">2 days ago</span>
                        </div>
                    </div>
                </div>
                <button
                    class="w-full mt-lg py-3 text-sm font-bold text-secondary border border-secondary rounded-lg hover:bg-secondary/5 transition-colors">
                    Lihat Semua Aktivitas
                </button>
            </div>
            <!-- Top 10 Pegawai Table -->
            <div class="col-span-12 bg-white rounded-xl border border-slate-200 ambient-shadow overflow-hidden">
                <div class="p-lg border-b border-slate-100 flex items-center justify-between">
                    <div>
                        <h4 class="text-headline-md font-headline-md text-slate-900">Top 10 Pegawai</h4>
                        <p class="text-sm text-on-primary-container">Ranking teratas berdasarkan perhitungan SAW
                            periode berjalan</p>
                    </div>
                    <button class="p-2 hover:bg-slate-50 rounded-lg">
                        <span class="material-symbols-outlined text-slate-400" data-icon="more_vert">more_vert</span>
                    </button>
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                    <thead class="bg-slate-50">
                        <tr>
                            <th
                                class="px-lg py-4 text-label-sm font-label-sm text-on-primary-container uppercase tracking-wider">
                                Rank</th>
                            <th
                                class="px-lg py-4 text-label-sm font-label-sm text-on-primary-container uppercase tracking-wider">
                                Pegawai</th>
                            <th
                                class="px-lg py-4 text-label-sm font-label-sm text-on-primary-container uppercase tracking-wider">
                                Divisi/Unit</th>
                            <th
                                class="px-lg py-4 text-label-sm font-label-sm text-on-primary-container uppercase tracking-wider">
                                Nilai Akhir</th>
                            <th
                                class="px-lg py-4 text-label-sm font-label-sm text-on-primary-container uppercase tracking-wider text-right">
                                Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        <!-- Row 1 -->
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="px-lg py-4">
                                <span
                                    class="w-8 h-8 rounded-full bg-yellow-100 text-yellow-700 flex items-center justify-center font-bold text-xs">01</span>
                            </td>
                            <td class="px-lg py-4">
                                <div class="flex items-center gap-3">
                                    <img alt="John Doe" class="w-10 h-10 rounded-full"
                                        data-alt="professional male employee headshot in high quality"
                                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuB--t3ok_jfSELT2KNtieYPzK7HYvCH-YAZQWtiqpGTNbh5kmF3WVoXNaNPDqTo1Rz5oMNMRQSezERMblgwUMQDaQkWP1FtZ6aTIMSEsAloqJObCT9aJPllWq5UyZWQiXVofiQDHirZ_exRdVgYkbpka-9xhJwmh_2UoJm_wGjZpz8jHlj2RrnUH0AkMIkJ8mFsdU8gXOWpXsIre0_VmMCpH1KRI-QS15aKid-3I-1IQSKxsZyGqK5LFI85dFAmdDK59cUrLsgWR6f1" />
                                    <div>
                                        <p class="font-semibold text-slate-900">John Doe</p>
                                        <p class="text-xs text-on-primary-container">ID: EMP-001</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-lg py-4 text-sm font-medium text-slate-600">Information Technology</td>
                            <td class="px-lg py-4">
                                <span
                                    class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-bold">0.982</span>
                            </td>
                            <td class="px-lg py-4 text-right">
                                <button class="text-secondary text-xs font-bold hover:underline">Detail</button>
                            </td>
                        </tr>
                        <!-- Row 2 -->
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="px-lg py-4">
                                <span
                                    class="w-8 h-8 rounded-full bg-slate-200 text-slate-700 flex items-center justify-center font-bold text-xs">02</span>
                            </td>
                            <td class="px-lg py-4">
                                <div class="flex items-center gap-3">
                                    <img alt="Sarah Connor" class="w-10 h-10 rounded-full"
                                        data-alt="close up headshot of a smiling female employee with professional lighting"
                                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuCJkEEP1bENndrxcjoLgCbz9scGLF91RSlVnxKVXiDMFhmj9t7ZWOjHOPL_iscg8VIfurXFwxzuUVFVW5z6KTjiA3vPLo86g6PorZVLMtDdglK8SpPawHUyKGAXO_2r2nVwNlL8GTNnwKrSn1Jgls146d0IfMRQZjQmkkXrTtYKPfsBwrgRMwqhoMA8Fiz5rPgdHkpTmpTSo--ZxmDVtU9EtwhQlCdo2h_hHs0bQhi76ngU2SBPLZGeqQ9fj7d7oDx1w9Fcqszwuf-8" />
                                    <div>
                                        <p class="font-semibold text-slate-900">Sarah Connor</p>
                                        <p class="text-xs text-on-primary-container">ID: EMP-042</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-lg py-4 text-sm font-medium text-slate-600">Marketing &amp; Sales</td>
                            <td class="px-lg py-4">
                                <span
                                    class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-bold">0.945</span>
                            </td>
                            <td class="px-lg py-4 text-right">
                                <button class="text-secondary text-xs font-bold hover:underline">Detail</button>
                            </td>
                        </tr>
                        <!-- Row 3 -->
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="px-lg py-4">
                                <span
                                    class="w-8 h-8 rounded-full bg-orange-100 text-orange-700 flex items-center justify-center font-bold text-xs">03</span>
                            </td>
                            <td class="px-lg py-4">
                                <div class="flex items-center gap-3">
                                    <img alt="Michael Scott" class="w-10 h-10 rounded-full"
                                        data-alt="professional male portrait with a slight smile in business attire"
                                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuBhK9I998mnsaLTmitTEt6YHUIOsv5M_hxOodVCt3B5FoSw0dqnXT7oukc_0lBj-a0og9_3QzSL7R96mE9A6Mk8Uysn_RC7VBzyEKpUbI2cUBY7yMKTj8LV9DHfCfvrdZ79MbrdEXPprbCmk4YdYH9fh2zM8M48nwUm5whefw108pAGYDeJi7XJyyCmCzgRTV4VUyOVjMnWPXBFM0fflEuRFRDztWB6_HfhkiJY97-Iu7l7mfnZm8v84dWhj8doML_zbJPzWPPjEppA" />
                                    <div>
                                        <p class="font-semibold text-slate-900">Michael Scott</p>
                                        <p class="text-xs text-on-primary-container">ID: EMP-112</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-lg py-4 text-sm font-medium text-slate-600">Customer Support</td>
                            <td class="px-lg py-4">
                                <span
                                    class="px-3 py-1 bg-green-50 text-green-600 rounded-full text-xs font-bold">0.891</span>
                            </td>
                            <td class="px-lg py-4 text-right">
                                <button class="text-secondary text-xs font-bold hover:underline">Detail</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                </div>
                <div class="px-lg py-4 bg-slate-50 flex items-center justify-between">
                    <p class="text-xs text-on-primary-container font-medium">Showing 1 to 3 of 10 entries</p>
                    <div class="flex gap-2">
                        <button
                            class="px-3 py-1 border border-slate-300 rounded text-xs font-bold text-slate-600 disabled:opacity-50"
                            disabled="">Prev</button>
                        <button
                            class="px-3 py-1 border border-slate-300 rounded text-xs font-bold text-slate-600 hover:bg-slate-100 transition-colors">Next</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
