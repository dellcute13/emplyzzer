@extends('layouts.app')

@section('content')
    <section class="p-8 space-y-8 flex-1 ">
        <div class="flex justify-between items-end mb-8">
            <div>
                <h2 class="font-headline-lg text-headline-lg text-slate-900">Hasil Perankingan Pegawai</h2>
                <p class="text-slate-500 text-body-md mt-1 mb-8">Berdasarkan perhitungan metode Simple Additive Weighting (SAW)
                    periode 2024.</p>
            </div>
            <div class="flex gap-3">
                <button
                    class="flex items-center gap-2 px-4 py-2 border border-slate-200 rounded-lg text-sm font-medium hover:bg-slate-50 transition-colors">
                    <span class="material-symbols-outlined text-sm" data-icon="print">print</span>
                    Cetak
                </button>
                <button
                    class="flex items-center gap-2 px-4 py-2 border border-slate-200 rounded-lg text-sm font-medium hover:bg-slate-50 transition-colors">
                    <span class="material-symbols-outlined text-sm text-green-600" data-icon="table_chart">table_chart</span>
                    Export Excel
                </button>
                <button
                    class="flex items-center gap-2 px-4 py-2 bg-primary text-white rounded-lg text-sm font-medium hover:opacity-90 transition-opacity">
                    <span class="material-symbols-outlined text-sm" data-icon="picture_as_pdf">picture_as_pdf</span>
                    Export PDF
                </button>
            </div>
        </div>
        <div class="grid grid-cols-12 gap-8 mb-8">
            <div class="col-span-12 lg:col-span-8 grid grid-cols-3 gap-6">
                <div
                    class="bg-white podium-shadow rounded-xl p-6 border border-slate-100 flex flex-col items-center relative overflow-hidden group">
                    <div class="absolute top-0 right-0 p-4 opacity-40 group-hover:opacity-10 transition-opacity">
                        <span class="material-symbols-outlined text-6xl" data-icon="military_tech">military_tech</span>
                    </div>
                    <div class="w-16 h-16 rounded-full border-4 border-slate-100 mb-4 overflow-hidden">
                        <img alt="Rank 2 Employee" class="w-full h-full object-cover"
                            data-alt="portrait of a smiling female professional wearing glasses and a blazer in a modern office environment"
                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuCQAMmw4Q8FF6n17hVlhOxFdJq0Z3dM_TW2sC6LOePIER0x4xEqvlnFXcJ_9MZyd_9nB9XqXvTutv-g8CSFZ7aqHHB9xKYA8_3Hv1618vSjI2mxsOa5dRRL-vXCcDda6aH64Mb6n6uAmuFiMyStfJtIyhjOlRWfr07xM7qOBFgAfPJygV7tC8Ud3GI0qDU8b2zI_OFbB1UppDj-Mev4Psx-VKCcbn9yiwysJoC9rdMIGotB1Lbfpj_lOcf9TSdfsJ6SB9rHCCFabLKH" />
                    </div>
                    <div class="bg-slate-200 text-slate-700 text-[10px] font-bold px-3 py-1 rounded-full mb-3">RANK 2 -
                        SILVER
                    </div>
                    <h3 class="font-headline-md text-headline-md text-slate-900 text-center">Maya Arisandi</h3>
                    <p class="text-slate-500 text-sm mt-1">IT Support</p>
                    <div class="mt-4 text-slate-900 font-bold text-xl">0.892</div>
                </div>
                <div
                    class="bg-white podium-shadow rounded-xl p-8 border-2 border-primary-fixed ring-4 ring-primary-fixed/20 flex flex-col items-center relative overflow-hidden transform -translate-y-4 scale-105 z-10 group">
                    <div
                        class="absolute top-0 left-0 bg-primary text-white text-[10px] font-bold px-4 py-1.5 rounded-br-lg">
                        BEST PERFORMER</div>
                    <div class="absolute top-4 right-4 text-yellow-500">
                        <span class="material-symbols-outlined text-4xl" data-icon="workspace_premium"
                            style="font-variation-settings: 'FILL' 1;">workspace_premium</span>
                    </div>
                    <div class="w-24 h-24 rounded-full border-4 border-primary-fixed mb-4 overflow-hidden">
                        <img alt="Rank 1 Employee" class="w-full h-full object-cover"
                            data-alt="successful young businessman in a dark suit looking directly at the camera with a confident smile"
                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuCXhZcHI5xJP99ULtD4CNvSrlVZRG6nm8R0KDBzE02kw3Y59cKtjeOjTsQfuOXMpa8GUatsHPRNEzOHFXGuqe-mBh2taoLFX81HjjiglkbFx1BYTyOiDWe01gac_4UyMF6WwGUP_-I01i93fmv0XnlIsWI8c9UBLAAbbqXgJ5I9x4FW4L3dApXqeh_8wfFJQ5q7PNrBZ05hJM8xkWQFYR97QTbKggAiA7FkmeUdt6ujrS8eISzD4Ifxgvx70yi0D-9Z8XxUzIRGpNFo" />
                    </div>
                    <div
                        class="bg-yellow-100 text-yellow-800 text-[10px] font-bold px-3 py-1 rounded-full mb-3 tracking-widest uppercase">
                        Rank 1 - Gold</div>
                    <h3 class="font-display-xl text-headline-lg text-slate-900 text-center">Bambang Wijaya</h3>
                    <p class="text-slate-500 text-sm mt-1">Senior Developer</p>
                    <div class="mt-6 text-primary font-bold text-3xl">0.975</div>
                </div>
                <div
                    class="bg-white podium-shadow rounded-xl p-6 border border-slate-100 flex flex-col items-center relative overflow-hidden group">
                    <div class="absolute top-0 right-0 p-4 opacity-40 group-hover:opacity-10 transition-opacity">
                        <span class="material-symbols-outlined text-6xl" data-icon="award">award_star</span>
                    </div>
                    <div class="w-16 h-16 rounded-full border-4 border-slate-100 mb-4 overflow-hidden">
                        <img alt="Rank 3 Employee" class="w-full h-full object-cover"
                            data-alt="portrait of a man in professional business attire with a neutral expression against a clean grey background"
                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuBnSoAzj8LrmttvxzU2i9OB5DD1CP_0J4CEPTk37cpT7CSFvOtVsgUDtIa6oLBr2XyZbSvNTdfbx2p-8m7zntzOfnFHGGfthzIfiUWfM-u3c0MIUhpb_5yTs8z8i4CSiUDh0g6HQ3kuoVZOaq1ctN6iVXYK2EPSytjqiME0Jh9smIEHQtsg0yY6u84lIXIzWuC35UEYrykvpSB01rFYrlT77hFyRlF-Znqt-db25kuPIBEyzvbbf4tX_Lt7UHxDSBQcioKiXV58XJuv" />
                    </div>
                    <div class="bg-orange-100 text-orange-800 text-[10px] font-bold px-3 py-1 rounded-full mb-3">RANK 3 -
                        BRONZE
                    </div>
                    <h3 class="font-headline-md text-headline-md text-slate-900 text-center">Deni Pratama</h3>
                    <p class="text-slate-500 text-sm mt-1">Project Manager</p>
                    <div class="mt-4 text-slate-900 font-bold text-xl">0.865</div>
                </div>
            </div>
            <div class="col-span-12 lg:col-span-4">
                <div class="bg-primary text-white rounded-xl p-8 h-full relative overflow-hidden">
                    <div class="relative z-10">
                        <h4 class="text-white/70 text-xs font-bold tracking-widest uppercase mb-2">Analisis Terbaik</h4>
                        <h3 class="font-display-xl text-display-xl mb-4 leading-tight">Bambang Wijaya</h3>
                        <p class="text-white/80 text-body-md mb-8">Unggul dalam kriteria <span
                                class="text-white font-bold">Inovasi</span> dan <span
                                class="text-white font-bold">Kedisiplinan</span> dengan skor rata-rata kriteria di atas
                            0.95.
                        </p>
                        <div class="space-y-4">
                            <div class="flex justify-between items-center text-sm">
                                <span class="text-white/60">Kualitas Kerja</span>
                                <div class="flex items-center gap-3">
                                    <div class="w-24 h-1.5 bg-white/20 rounded-full">
                                        <div class="w-[95%] h-full bg-white rounded-full"></div>
                                    </div>
                                    <span class="font-bold">95%</span>
                                </div>
                            </div>
                            <div class="flex justify-between items-center text-sm">
                                <span class="text-white/60">Kerjasama Tim</span>
                                <div class="flex items-center gap-3">
                                    <div class="w-24 h-1.5 bg-white/20 rounded-full">
                                        <div class="w-[90%] h-full bg-white rounded-full"></div>
                                    </div>
                                    <span class="font-bold">90%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="absolute -bottom-10 -right-10 opacity-10">
                        <span class="material-symbols-outlined text-[200px]" data-icon="stars"
                            style="font-variation-settings: 'FILL' 1;">stars</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-white podium-shadow rounded-xl border border-slate-100 overflow-hidden">
            <div class="p-6 border-b border-slate-100 flex justify-between items-center bg-slate-50/50">
                <h3 class="font-headline-md text-headline-md text-slate-900">Ranking 1 - 10</h3>
                <div class="text-xs text-slate-500 font-medium italic">Data diperbarui secara otomatis berdasarkan bobot
                    kriteria terbaru</div>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-slate-50 text-slate-500 text-[11px] font-bold uppercase tracking-wider">
                            <th class="px-8 py-4 w-20">Rank</th>
                            <th class="px-6 py-4">Nama Pegawai</th>
                            <th class="px-6 py-4">Jabatan</th>
                            <th class="px-6 py-4">Skor SAW</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-8 py-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="px-8 py-4">
                                <span
                                    class="w-8 h-8 rounded-full bg-yellow-400 text-white flex items-center justify-center font-bold text-sm">1</span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-slate-200 overflow-hidden">
                                        <img alt="Rank 1" class="w-full h-full object-cover"
                                            data-alt="profile photo of a smiling professional male"
                                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuC3Uee07sz_rHxORBHyp0x4BAEoejRsdDHkwvVgcPSi4yS9SUbiz0-aj00F6bWwL09u9A-Ho5KwfFXThLEJx1eY1KExTTpQpP5HMb3erYzVOr_g1eQBqEXQclc5z0l2VZZgXsAhZ9v4Z9CVupz2tix3l1nnJa_NQ4wksVWZ7osN1KsuIs-irNw-2HXMyeLm5Z8UFC6ykgxtUDePG07pVXiv4PY2x3sTTWy0srFBkbNAGPlnfZkkrjuFuchYjzlDNjIKmCG2Av1bUcDy" />
                                    </div>
                                    <span class="font-bold text-slate-900">Bambang Wijaya</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm text-slate-500">Senior Developer</td>
                            <td class="px-6 py-4 font-bold text-slate-900">0.975</td>
                            <td class="px-6 py-4">
                                <span
                                    class="px-3 py-1 bg-green-50 text-green-700 rounded-full text-[10px] font-bold uppercase">Sangat
                                    Baik</span>
                            </td>
                            <td class="px-8 py-4 text-right">
                                <button class="p-2 text-slate-400 hover:text-primary transition-colors">
                                    <span class="material-symbols-outlined text-lg"
                                        data-icon="visibility">visibility</span>
                                </button>
                            </td>
                        </tr>
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="px-8 py-4">
                                <span
                                    class="w-8 h-8 rounded-full bg-slate-300 text-white flex items-center justify-center font-bold text-sm">2</span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-slate-200 overflow-hidden">
                                        <img alt="Rank 2" class="w-full h-full object-cover"
                                            data-alt="profile photo of a professional female"
                                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuA5DrmewcmgapXyaFn7HH-yC6mDs6NIcWyZQt7A9jcxP6uUOo7L2ZXdC5HVzGwdyms5iP9VTt0lLAG8DuaNiFSn5ixp0JFec7YtMaJCQUpnKI81mG9IYTqmqw3xmWBfNUnI9Trl7x4CWP3SeXqysSw7w3Vtiuq72JIMIwAyPtfOZb9Xdu0xKsJ09ULiBQFLKEvJyX7YfOdgVQD09tjmFKp3k5MfkogRUN58IpG1vhjG6Wit03s8vZB9ijdGON2HFYbk6A_7k1ilrzuc" />
                                    </div>
                                    <span class="font-bold text-slate-900">Maya Arisandi</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm text-slate-500">IT Support</td>
                            <td class="px-6 py-4 font-bold text-slate-900">0.892</td>
                            <td class="px-6 py-4">
                                <span
                                    class="px-3 py-1 bg-green-50 text-green-700 rounded-full text-[10px] font-bold uppercase">Sangat
                                    Baik</span>
                            </td>
                            <td class="px-8 py-4 text-right">
                                <button class="p-2 text-slate-400 hover:text-primary transition-colors">
                                    <span class="material-symbols-outlined text-lg"
                                        data-icon="visibility">visibility</span>
                                </button>
                            </td>
                        </tr>
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="px-8 py-4">
                                <span
                                    class="w-8 h-8 rounded-full bg-orange-300 text-white flex items-center justify-center font-bold text-sm">3</span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-slate-200 overflow-hidden">
                                        <img alt="Rank 3" class="w-full h-full object-cover"
                                            data-alt="profile photo of a professional male"
                                            src="https://lh3.googleusercontent.com/aida-public/AB6AXuCQa4lxBxRPh2of1PpvtXIqD6cGdWfxS4UBd4nwn5Db-7QxpxKTkOh6ipSoh1ud9Jvjll24cA0enl07E95A4lVpku7xSWx6yCG-4F_U3_16fNG_lisLwx60f9TmhBlW45nTKoo_Ey8nd9wE-bUNcpeBRLYWRlAoR6SV7T9E7vT0GywPrhgnC79uST3tMDz3-Gj_ljBAnD-dS4LrY08KxdvmVQoTk-wU9VY7-pL-KIZJQJlDYRBojZwrJI6aw8fbdaJCPRlN05DY5CNw" />
                                    </div>
                                    <span class="font-bold text-slate-900">Deni Pratama</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm text-slate-500">Project Manager</td>
                            <td class="px-6 py-4 font-bold text-slate-900">0.865</td>
                            <td class="px-6 py-4">
                                <span
                                    class="px-3 py-1 bg-green-50 text-green-700 rounded-full text-[10px] font-bold uppercase">Sangat
                                    Baik</span>
                            </td>
                            <td class="px-8 py-4 text-right">
                                <button class="p-2 text-slate-400 hover:text-primary transition-colors">
                                    <span class="material-symbols-outlined text-lg"
                                        data-icon="visibility">visibility</span>
                                </button>
                            </td>
                        </tr>
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="px-8 py-4">
                                <span
                                    class="w-8 h-8 rounded-full bg-slate-100 text-slate-500 flex items-center justify-center font-bold text-sm border border-slate-200">4</span>
                            </td>
                            <td class="px-6 py-4 text-slate-900 font-medium">Siti Aminah</td>
                            <td class="px-6 py-4 text-sm text-slate-500">Finance Staff</td>
                            <td class="px-6 py-4 font-bold text-slate-900">0.812</td>
                            <td class="px-6 py-4">
                                <span
                                    class="px-3 py-1 bg-blue-50 text-blue-700 rounded-full text-[10px] font-bold uppercase">Baik</span>
                            </td>
                            <td class="px-8 py-4 text-right">
                                <button class="p-2 text-slate-400 hover:text-primary transition-colors">
                                    <span class="material-symbols-outlined text-lg"
                                        data-icon="visibility">visibility</span>
                                </button>
                            </td>
                        </tr>
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="px-8 py-4">
                                <span
                                    class="w-8 h-8 rounded-full bg-slate-100 text-slate-500 flex items-center justify-center font-bold text-sm border border-slate-200">5</span>
                            </td>
                            <td class="px-6 py-4 text-slate-900 font-medium">Budi Santoso</td>
                            <td class="px-6 py-4 text-sm text-slate-500">Marketing Lead</td>
                            <td class="px-6 py-4 font-bold text-slate-900">0.784</td>
                            <td class="px-6 py-4">
                                <span
                                    class="px-3 py-1 bg-blue-50 text-blue-700 rounded-full text-[10px] font-bold uppercase">Baik</span>
                            </td>
                            <td class="px-8 py-4 text-right">
                                <button class="p-2 text-slate-400 hover:text-primary transition-colors">
                                    <span class="material-symbols-outlined text-lg"
                                        data-icon="visibility">visibility</span>
                                </button>
                            </td>
                        </tr>
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="px-8 py-4">
                                <span
                                    class="w-8 h-8 rounded-full bg-slate-100 text-slate-500 flex items-center justify-center font-bold text-sm border border-slate-200">6</span>
                            </td>
                            <td class="px-6 py-4 text-slate-900 font-medium">Rina Fitriani</td>
                            <td class="px-6 py-4 text-sm text-slate-500">UX Designer</td>
                            <td class="px-6 py-4 font-bold text-slate-900">0.762</td>
                            <td class="px-6 py-4">
                                <span
                                    class="px-3 py-1 bg-blue-50 text-blue-700 rounded-full text-[10px] font-bold uppercase">Baik</span>
                            </td>
                            <td class="px-8 py-4 text-right">
                                <button class="p-2 text-slate-400 hover:text-primary transition-colors">
                                    <span class="material-symbols-outlined text-lg"
                                        data-icon="visibility">visibility</span>
                                </button>
                            </td>
                        </tr>
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="px-8 py-4">
                                <span
                                    class="w-8 h-8 rounded-full bg-slate-100 text-slate-500 flex items-center justify-center font-bold text-sm border border-slate-200">7</span>
                            </td>
                            <td class="px-6 py-4 text-slate-900 font-medium">Ahmad Fauzi</td>
                            <td class="px-6 py-4 text-sm text-slate-500">Security Officer</td>
                            <td class="px-6 py-4 font-bold text-slate-900">0.710</td>
                            <td class="px-6 py-4">
                                <span
                                    class="px-3 py-1 bg-blue-50 text-blue-700 rounded-full text-[10px] font-bold uppercase">Cukup</span>
                            </td>
                            <td class="px-8 py-4 text-right">
                                <button class="p-2 text-slate-400 hover:text-primary transition-colors">
                                    <span class="material-symbols-outlined text-lg"
                                        data-icon="visibility">visibility</span>
                                </button>
                            </td>
                        </tr>
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="px-8 py-4">
                                <span
                                    class="w-8 h-8 rounded-full bg-slate-100 text-slate-500 flex items-center justify-center font-bold text-sm border border-slate-200">8</span>
                            </td>
                            <td class="px-6 py-4 text-slate-900 font-medium">Indah Permata</td>
                            <td class="px-6 py-4 text-sm text-slate-500">Admin Support</td>
                            <td class="px-6 py-4 font-bold text-slate-900">0.685</td>
                            <td class="px-6 py-4">
                                <span
                                    class="px-3 py-1 bg-orange-50 text-orange-700 rounded-full text-[10px] font-bold uppercase">Cukup</span>
                            </td>
                            <td class="px-8 py-4 text-right">
                                <button class="p-2 text-slate-400 hover:text-primary transition-colors">
                                    <span class="material-symbols-outlined text-lg"
                                        data-icon="visibility">visibility</span>
                                </button>
                            </td>
                        </tr>
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="px-8 py-4">
                                <span
                                    class="w-8 h-8 rounded-full bg-slate-100 text-slate-500 flex items-center justify-center font-bold text-sm border border-slate-200">9</span>
                            </td>
                            <td class="px-6 py-4 text-slate-900 font-medium">Eko Prasetyo</td>
                            <td class="px-6 py-4 text-sm text-slate-500">Junior Dev</td>
                            <td class="px-6 py-4 font-bold text-slate-900">0.654</td>
                            <td class="px-6 py-4">
                                <span
                                    class="px-3 py-1 bg-orange-50 text-orange-700 rounded-full text-[10px] font-bold uppercase">Cukup</span>
                            </td>
                            <td class="px-8 py-4 text-right">
                                <button class="p-2 text-slate-400 hover:text-primary transition-colors">
                                    <span class="material-symbols-outlined text-lg"
                                        data-icon="visibility">visibility</span>
                                </button>
                            </td>
                        </tr>
                        <tr class="hover:bg-slate-50/50 transition-colors">
                            <td class="px-8 py-4">
                                <span
                                    class="w-8 h-8 rounded-full bg-slate-100 text-slate-500 flex items-center justify-center font-bold text-sm border border-slate-200">10</span>
                            </td>
                            <td class="px-6 py-4 text-slate-900 font-medium">Laras Wati</td>
                            <td class="px-6 py-4 text-sm text-slate-500">General Affair</td>
                            <td class="px-6 py-4 font-bold text-slate-900">0.612</td>
                            <td class="px-6 py-4">
                                <span
                                    class="px-3 py-1 bg-red-50 text-red-700 rounded-full text-[10px] font-bold uppercase">Perlu
                                    Evaluasi</span>
                            </td>
                            <td class="px-8 py-4 text-right">
                                <button class="p-2 text-slate-400 hover:text-primary transition-colors">
                                    <span class="material-symbols-outlined text-lg"
                                        data-icon="visibility">visibility</span>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="p-6 border-t border-slate-100 bg-slate-50/30 flex justify-between items-center">
                <p class="text-xs text-slate-400">Menampilkan 10 dari 45 data pegawai</p>
                <div class="flex gap-2">
                    <button
                        class="px-3 py-1.5 border border-slate-200 rounded text-xs font-bold text-slate-400 cursor-not-allowed">Previous</button>
                    <button
                        class="px-3 py-1.5 border border-primary bg-primary text-white rounded text-xs font-bold">1</button>
                    <button
                        class="px-3 py-1.5 border border-slate-200 rounded text-xs font-bold text-slate-600 hover:bg-slate-100">2</button>
                    <button
                        class="px-3 py-1.5 border border-slate-200 rounded text-xs font-bold text-slate-600 hover:bg-slate-100">3</button>
                    <button
                        class="px-3 py-1.5 border border-slate-200 rounded text-xs font-bold text-slate-600 hover:bg-slate-100">Next</button>
                </div>
            </div>
        </div>
    </section>
@endsection
