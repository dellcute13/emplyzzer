@extends('layouts.app')

@section('content')
    <section class="p-8 space-y-8 flex-1">
        <!-- Header Section -->
        <div class="flex justify-between items-end">
            <div>
                <h2 class="font-headline-lg text-headline-lg text-on-surface">Data Pegawai</h2>
                <p class="font-body-md text-body-md text-on-surface-variant">Kelola informasi dasar dan jabatan seluruh
                    karyawan dalam sistem.</p>
            </div>
            <a
                class="flex items-center bg-primary text-on-primary px-6 py-3 rounded-lg font-medium hover:opacity-90 transition-all active:scale-95"
                href="{{ route('employee.employee-add') }}">
                <span class="material-symbols-outlined mr-2" data-icon="add">add</span>
                Tambah Pegawai
            </a>
        </div>
        <!-- Dashboard Content -->
        <div class="bg-white rounded-xl border border-slate-200 custom-shadow overflow-hidden">
            <!-- Table Controls -->
            <div class="p-6 border-b border-slate-100 flex flex-wrap gap-4 justify-between items-center">
                <div class="flex items-center space-x-4">
                    <div class="relative">
                        <div x-data="{ open: false, selected: 'Semua Divisi/Unit' }" class="space-y-2 relative">
                            <label class="font-label-sm text-slate-700 uppercase">Tipe Pegawai</label>
                            <input type="hidden" name="department" :value="selected">
                            <button type="button" @click="open = !open" @click.away="open = false"
                                class="w-full bg-white border-slate-200 border border-outline-variant rounded-lg px-3.5 py-2.5 text-body-md font-body-md outline-none transition-all flex items-center justify-between hover:border-primary-container focus:border-primary-container focus:ring-2 focus:ring-primary-container h-10">
                                <span class="text-left"
                                    :class="selected == 'Semua Divisi/Unit' ? 'text-slate-700' : 'text-slate-800'"
                                    x-text="selected">
                                </span>
                                <span class="material-symbols-outlined text-slate-400 transition-transform duration-200"
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
                                <button type="button" @click="selected='Semua Divisi/Unit'; open=false"
                                    class="w-full px-4 py-3 text-left text-sm text-slate-700 hover:bg-slate-50 transition">
                                    Semua Divisi/Unit
                                </button>
                                <button type="button" @click="selected='Teknologi Informasi'; open=false"
                                    class="w-full px-4 py-3 text-left text-sm text-slate-700 hover:bg-slate-50 transition">
                                    Teknologi Informasi
                                </button>
                                <button type="button" @click="selected='Sumber Daya Manusia'; open=false"
                                    class="w-full px-4 py-3 text-left text-sm text-slate-700 border-t border-slate-100 hover:bg-slate-50 transition">
                                    Sumber Daya Manusia
                                </button>
                                <button type="button" @click="selected='Keuangan'; open=false"
                                    class="w-full px-4 py-3 text-left text-sm text-slate-700 border-t border-slate-100 hover:bg-slate-50 transition">
                                    Keuangan
                                </button>
                                <button type="button" @click="selected='Operasional'; open=false"
                                    class="w-full px-4 py-3 text-left text-sm text-slate-700 border-t border-slate-100 hover:bg-slate-50 transition">
                                    Operasional
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="relative">
                        <div x-data="{ open: false, selected: 'Status: Aktif' }" class="space-y-2 relative">
                            <label class="font-label-sm text-slate-700 uppercase">Status Pegawai</label>
                            <input type="hidden" name="department" :value="selected">
                            <button type="button" @click="open = !open" @click.away="open = false"
                                class="w-full bg-white border-slate-200 border border-outline-variant rounded-lg px-3.5 py-2.5 text-body-md font-body-md outline-none transition-all flex items-center justify-between hover:border-primary-container focus:border-primary-container focus:ring-2 focus:ring-primary-container h-10">
                                <span class="text-left"
                                    :class="selected == 'Status: Aktif' ? 'text-slate-700' : 'text-slate-800'"
                                    x-text="selected">
                                </span>
                                <span class="material-symbols-outlined text-slate-400 transition-transform duration-200"
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
                                <button type="button" @click="selected='Status: Non-Aktif'; open=false"
                                    class="w-full px-4 py-3 text-left text-sm text-slate-700 hover:bg-slate-50 transition">
                                    Status: Non-Aktif
                                </button>
                                <button type="button" @click="selected='Status: Aktif'; open=false"
                                    class="w-full px-4 py-3 text-left text-sm text-slate-700 hover:bg-slate-50 transition">
                                    Status: Aktif
                                </button>
                                <button type="button" @click="selected='Status: Cuti'; open=false"
                                    class="w-full px-4 py-3 text-left text-sm text-slate-700 border-t border-slate-100 hover:bg-slate-50 transition">
                                    Status: Cuti
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-sm text-slate-500">
                    Menampilkan <span class="font-bold text-slate-900">5</span> dari <span
                        class="font-bold text-slate-900">124</span> Pegawai
                </div>
            </div>
            <!-- Modern Table -->
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50 text-slate-900 font-headline-md border-b border-slate-100">
                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider">No</th>
                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider">Foto</th>
                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider">NIP</th>
                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider">Nama</th>
                            <th class="px-6 py-4 text-xs font-bold uppercase tracking -winder">Gender Pegawai</th>
                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider">Jabatan</th>
                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider">Divisi/Unit</th>
                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        <!-- Row 1 -->
                        <tr class="hover:bg-slate-50/50 transition-colors group">
                            <td class="px-6 py-4 font-data-tabular">1</td>
                            <td class="px-6 py-4">
                                <img alt="Employee photo" class="w-10 h-10 rounded-full object-cover"
                                    data-alt="professional headshot of a businessman in a dark suit with short hair against a light grey background"
                                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuChdl7Bwf0t-Hxom6a06MOmLe0y7nkoAFk0wkCRXsGSLqejF0lcu60mfaqlNTKOoM1zYqQ1MFm7tPXzIiyQm3qtAqV9cbz67oc3b-9xqkGRxgCHlZzcm8T621xb0HCSpK5NKZNgHpvFirDokwobttRSezzdVnSi0Zww7J5vsUMo3ePWE6raiSh9ZjevpIPHezRr0ib6WWdDjhUpqgq6YdekPytZuq2VvMQHn1wWQ515lBD4Z9gCMMd9vQ88LcFwWsT2qD3ZFcEsyMoN" />
                            </td>
                            <td class="px-6 py-4 font-data-tabular text-slate-600">19920315201801</td>
                            <td class="px-6 py-4">
                                <div class="font-semibold text-slate-900">Aditya Pratama</div>
                                <div class="text-xs text-slate-400">aditya.p@company.com</div>
                            </td>

                            <td class="px-4 py-5">
                                <span class="px-3 py-1 rounded-full text-sm bg-blue-100 text-blue-700">
                                    Laki-laki
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <span
                                    class="px-3 py-1 bg-primary-fixed text-on-primary-fixed text-xs font-medium rounded-full">Senior
                                    Developer</span>
                            </td>
                            <td class="px-6 py-4 text-slate-600">Teknologi Informasi</td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex justify-end space-x-2">
                                    <button class="p-2 text-slate-400 hover:text-secondary transition-colors"
                                        title="Detail"><span class="material-symbols-outlined text-sm"
                                            data-icon="visibility">visibility</span></button>
                                    <button class="p-2 text-slate-400 hover:text-primary transition-colors"
                                        title="Edit"><span class="material-symbols-outlined text-sm"
                                            data-icon="edit">edit</span></button>
                                    <button class="p-2 text-slate-400 hover:text-error transition-colors"
                                        title="Delete"><span class="material-symbols-outlined text-sm"
                                            data-icon="delete">delete</span></button>
                                </div>
                            </td>
                        </tr>
                        <!-- Row 2 -->
                        <tr class="hover:bg-slate-50/50 transition-colors group">
                            <td class="px-6 py-4 font-data-tabular">2</td>
                            <td class="px-6 py-4">
                                <img alt="Employee photo" class="w-10 h-10 rounded-full object-cover"
                                    data-alt="professional portrait of a confident woman in a business suit with a friendly expression and glasses"
                                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuCapGe8V2GYFH0EV2fZTlvTaZsHV3oFIFaUzUFI1Y-1ZUoZTJh0ZVQMtlSOwd-YTn-SQ-Ew-zNGrRdb-rJPDK-FwCbGNn8sN1NffHOAt6UAoBB5mpBA_4cMblN5FyJV8k_3OeSBub8-GYJiDOSq5-oFBaogPnNK_Bn4o-U-i4zKRZbC6NivuQYD1GoVuenO5R_lsmIPFfyhJkiBO47cj_mDJ9Dum0JJKQVO2oqxtjQeI2NNnBR9kC2amfA7_mE_-Hu8YmJzXs55As1Y" />
                            </td>
                            <td class="px-6 py-4 font-data-tabular text-slate-600">19940522201903</td>
                            <td class="px-6 py-4">
                                <div class="font-semibold text-slate-900">Siti Rahayu</div>
                                <div class="text-xs text-slate-400">siti.rahayu@company.com</div>
                            </td>

                            <td class="px-4 py-5">
                                <span class="px-3 py-1 rounded-full text-sm bg-pink-100 text-pink-700">
                                     Perempuan
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <span
                                    class="px-3 py-1 bg-tertiary-fixed text-on-tertiary-fixed text-xs font-medium rounded-full">HR
                                    Specialist</span>
                            </td>
                            <td class="px-6 py-4 text-slate-600">Sumber Daya Manusia</td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex justify-end space-x-2">
                                    <button class="p-2 text-slate-400 hover:text-secondary transition-colors"
                                        title="Detail"><span class="material-symbols-outlined text-sm"
                                            data-icon="visibility">visibility</span></button>
                                    <button class="p-2 text-slate-400 hover:text-primary transition-colors"
                                        title="Edit"><span class="material-symbols-outlined text-sm"
                                            data-icon="edit">edit</span></button>
                                    <button class="p-2 text-slate-400 hover:text-error transition-colors"
                                        title="Delete"><span class="material-symbols-outlined text-sm"
                                            data-icon="delete">delete</span></button>
                                </div>
                            </td>
                        </tr>
                        <!-- Row 3 -->
                        <tr class="hover:bg-slate-50/50 transition-colors group">
                            <td class="px-6 py-4 font-data-tabular">3</td>
                            <td class="px-6 py-4">
                                <img alt="Employee photo" class="w-10 h-10 rounded-full object-cover"
                                    data-alt="close-up portrait of a young man with a slight smile wearing a blue dress shirt in a professional environment"
                                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuAH_kEbOwpVrhHr5HpFO6wAHesLVYKp9s_8hdTTT2sMLtiJa5G36L6jxj5p5eZcK-u_66eQhRG-eDPankkVy16ui5rUVKulm8HgMmC1Utox7_Uspm9N_9iNZgVS9hO1X037pJ_-ryA2l0Td6-pb9EO9aIyomX14z-V9IGshAeNrg9zM7T2gJ3JZpVutn-d15q5aYk_bJVLD8sRBIoWNfFzlIFlB4A-UPDTKSSXgWwWQrnFRjEOz3RKSJjf9336u5M5tgrAjIZB6qPV5" />
                            </td>
                            <td class="px-6 py-4 font-data-tabular text-slate-600">19890110201511</td>
                            <td class="px-6 py-4">
                                <div class="font-semibold text-slate-900">Budi Santoso</div>
                                <div class="text-xs text-slate-400">budi.s@company.com</div>
                            </td>

                            <td class="px-4 py-5">
                                <span class="px-3 py-1 rounded-full text-sm bg-blue-100 text-blue-700">
                                    Laki-laki
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <span
                                    class="px-3 py-1 bg-secondary-fixed text-on-secondary-fixed text-xs font-medium rounded-full">Financial
                                    Analyst</span>
                            </td>
                            <td class="px-6 py-4 text-slate-600">Keuangan</td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex justify-end space-x-2">
                                    <button class="p-2 text-slate-400 hover:text-secondary transition-colors"
                                        title="Detail"><span class="material-symbols-outlined text-sm"
                                            data-icon="visibility">visibility</span></button>
                                    <button class="p-2 text-slate-400 hover:text-primary transition-colors"
                                        title="Edit"><span class="material-symbols-outlined text-sm"
                                            data-icon="edit">edit</span></button>
                                    <button class="p-2 text-slate-400 hover:text-error transition-colors"
                                        title="Delete"><span class="material-symbols-outlined text-sm"
                                            data-icon="delete">delete</span></button>
                                </div>
                            </td>
                        </tr>
                        <!-- Row 4 -->
                        <tr class="hover:bg-slate-50/50 transition-colors group">
                            <td class="px-6 py-4 font-data-tabular">4</td>
                            <td class="px-6 py-4">
                                <img alt="Employee photo" class="w-10 h-10 rounded-full object-cover"
                                    data-alt="portrait of a professional woman with a warm expression wearing business casual attire in a bright office"
                                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuCF2wSoUBYTo5yPss_SaH05yxxFs52rYF0Kb0EhG_2swgD0P16K2PjaSc5mWRiPNt5XWe2hcOMuaz3FliObH4c0L4Sf8YKV_aAW1gv4WPC-peBx4mY6mDvJFYsQr3XEagene6fzb0cEbTr60kSfFn0kWd3S3CIjAlFTFMjGQbrZQiodECIY-6S6lIp8j34CpJxx6NEdouzpb1kR3nFmDJwJBaWsB81oEANuj_7GU8DACax2D9yaFtm8jn1xoHqcNTi83vczqw1dVicR" />
                            </td>
                            <td class="px-6 py-4 font-data-tabular text-slate-600">19961130202105</td>
                            <td class="px-6 py-4">
                                <div class="font-semibold text-slate-900">Indah Lestari</div>
                                <div class="text-xs text-slate-400">indah.l@company.com</div>
                            </td>

                            <td class="px-4 py-5">
                                <span class="px-3 py-1 rounded-full text-sm bg-pink-100 text-pink-700">
                                     Perempuan
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 bg-slate-100 text-slate-700 text-xs font-medium rounded-full">UI/UX
                                    Designer</span>
                            </td>
                            <td class="px-6 py-4 text-slate-600">Teknologi Informasi</td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex justify-end space-x-2">
                                    <button class="p-2 text-slate-400 hover:text-secondary transition-colors"
                                        title="Detail"><span class="material-symbols-outlined text-sm"
                                            data-icon="visibility">visibility</span></button>
                                    <button class="p-2 text-slate-400 hover:text-primary transition-colors"
                                        title="Edit"><span class="material-symbols-outlined text-sm"
                                            data-icon="edit">edit</span></button>
                                    <button class="p-2 text-slate-400 hover:text-error transition-colors"
                                        title="Delete"><span class="material-symbols-outlined text-sm"
                                            data-icon="delete">delete</span></button>
                                </div>
                            </td>
                        </tr>
                        <!-- Row 5 -->
                        <tr class="hover:bg-slate-50/50 transition-colors group">
                            <td class="px-6 py-4 font-data-tabular">5</td>
                            <td class="px-6 py-4">
                                <img alt="Employee photo" class="w-10 h-10 rounded-full object-cover"
                                    data-alt="candid portrait of a young man with a trendy hairstyle looking directly at the camera with a neutral expression"
                                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuCUlnRAvPc6cU1F0VTMx_CtmNHUSvQnbZAwVb1JNSaTTtxD6g59EK1zw4BtpPwHdROZbTuyvH8-AJJxUNPiJGr9nodoF4Nki2B7twTgdSgYLqp7c2ldisTvmab4BHTTHEwKbgEYU2ULjqv8pZOt91lgbfWIQ9htXl79KY5FSL--I8U7v-kc1ptZyem1FBJpVcsv9ri9JlVZid4cBHjAb03CHjsDeySB7FZVugDOV02r5wq1mleoNCxLJ0eXWLmgCjx8kBwtnaI9D7jo" />
                            </td>
                            <td class="px-6 py-4 font-data-tabular text-slate-600">19910814201709</td>
                            <td class="px-6 py-4">
                                <div class="font-semibold text-slate-900">Rizky Ramadhan</div>
                                <div class="text-xs text-slate-400">rizky.r@company.com</div>
                            </td>

                            <td class="px-4 py-5">
                                <span class="px-3 py-1 rounded-full text-sm bg-blue-100 text-blue-700">
                                    Laki-laki
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <span
                                    class="px-3 py-1 bg-primary-fixed text-on-primary-fixed text-xs font-medium rounded-full">System
                                    Architect</span>
                            </td>
                            <td class="px-6 py-4 text-slate-600">Teknologi Informasi</td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex justify-end space-x-2">
                                    <button class="p-2 text-slate-400 hover:text-secondary transition-colors"
                                        title="Detail"><span class="material-symbols-outlined text-sm"
                                            data-icon="visibility">visibility</span></button>
                                    <button class="p-2 text-slate-400 hover:text-primary transition-colors"
                                        title="Edit"><span class="material-symbols-outlined text-sm"
                                            data-icon="edit">edit</span></button>
                                    <button class="p-2 text-slate-400 hover:text-error transition-colors"
                                        title="Delete"><span class="material-symbols-outlined text-sm"
                                            data-icon="delete">delete</span></button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- Pagination -->
            <div class="p-6 bg-slate-50 border-t border-slate-100 flex items-center justify-between">
                <div class="text-sm text-slate-500">
                    Page <span class="font-bold text-slate-900">1</span> of <span
                        class="font-bold text-slate-900">25</span>
                </div>
                <div class="flex items-center space-x-2">
                    <button
                        class="w-10 h-10 flex items-center justify-center rounded-lg border border-slate-200 bg-white text-slate-400 hover:bg-slate-50 disabled:opacity-50"
                        disabled="">
                        <span class="material-symbols-outlined" data-icon="chevron_left">chevron_left</span>
                    </button>
                    <button
                        class="w-10 h-10 flex items-center justify-center rounded-lg bg-primary text-on-primary font-bold shadow-md">1</button>
                    <button
                        class="w-10 h-10 flex items-center justify-center rounded-lg border border-slate-200 bg-white text-slate-600 hover:bg-slate-50">2</button>
                    <button
                        class="w-10 h-10 flex items-center justify-center rounded-lg border border-slate-200 bg-white text-slate-600 hover:bg-slate-50">3</button>
                    <div class="px-2 text-slate-400">...</div>
                    <button
                        class="w-10 h-10 flex items-center justify-center rounded-lg border border-slate-200 bg-white text-slate-600 hover:bg-slate-50">25</button>
                    <button
                        class="w-10 h-10 flex items-center justify-center rounded-lg border border-slate-200 bg-white text-slate-600 hover:bg-slate-50">
                        <span class="material-symbols-outlined" data-icon="chevron_right">chevron_right</span>
                    </button>
                </div>
            </div>
        </div>
    </section>
    <!-- Quick Info Banner -->
    <section class="px-8 pb-8">
        <div class="bg-primary-container p-6 rounded-xl flex items-center justify-between">
            <div class="flex items-center space-x-6">
                <div
                    class="w-12 h-12 bg-primary-fixed-dim/20 rounded-full flex items-center justify-center text-primary-fixed">
                    <span class="material-symbols-outlined" data-icon="info">info</span>
                </div>
                <div>
                    <h4 class="text-white font-bold">Lengkapi Data Penilaian</h4>
                    <p class="text-on-primary-container text-sm">Beberapa pegawai baru belum memiliki data kriteria yang
                        lengkap untuk perhitungan SAW.</p>
                </div>
            </div>
            <button
                class="px-6 py-2 bg-white text-primary rounded-lg text-sm font-bold hover:bg-slate-100 transition-colors">
                Periksa Sekarang
            </button>
        </div>
    </section>
@endsection
