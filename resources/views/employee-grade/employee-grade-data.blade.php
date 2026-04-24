@extends('layouts.app')

@section('content')
    <section class="p-8 space-y-8 flex-1">
        <div class="mb-8">
            <h2 class="font-headline-lg text-headline-lg text-primary mb-1">Input Nilai Pegawai</h2>
            <p class="font-body-md text-on-surface-variant max-w-2xl">Lakukan penilaian objektif berdasarkan parameter
                kriteria
                yang telah ditentukan untuk mendukung akurasi perhitungan metode Simple Additive Weighting (SAW).</p>
        </div>
        <div class="grid grid-cols-12 gap-8 items-start">
            <!-- Left Column: Form & Selection -->
            <div class="col-span-12 lg:col-span-8 space-y-6">
                <!-- Selection Card -->
                <div class="bg-white border border-outline-variant rounded-xl p-lg custom-shadow">
                    <div class="mb-6 flex items-center justify-between">
                        <div>
                            <h3 class="font-headline-md text-headline-md text-primary">Pilih Pegawai</h3>
                            <p class="text-label-sm text-on-surface-variant">Tentukan kandidat yang akan dinilai pada periode
                                ini
                            </p>
                        </div>
                        <div class="bg-secondary/10 px-4 py-2 rounded-lg">
                            <span class="text-secondary font-bold text-sm">Periode: Q4 2023</span>
                        </div>
                    </div>
                    <div class="relative">
                        <label class="block text-label-sm font-bold text-on-surface-variant uppercase mb-2">Nama Lengkap
                            atau
                            NIP</label>
                        <select
                            class="w-full bg-surface border border-outline-variant rounded-lg px-4 py-3 text-body-md focus:border-secondary focus:ring-1 focus:ring-secondary transition-all appearance-none cursor-pointer">
                            <option disabled="" selected="" value="">Pilih salah satu pegawai...</option>
                            <option value="1">Budi Setiawan (NIP: 198203102005011001)</option>
                            <option value="2">Siti Aminah (NIP: 198505222010122003)</option>
                            <option value="3">Andi Wijaya (NIP: 199008152015031005)</option>
                            <option value="4">Rina Marlina (NIP: 199312302018012002)</option>
                        </select>
                        <span
                            class="material-symbols-outlined absolute right-3 bottom-3.5 pointer-events-none text-outline">expand_more</span>
                    </div>
                </div>
                <!-- Assessment Form -->
                <div class="bg-white border border-outline-variant rounded-xl overflow-hidden custom-shadow">
                    <div class="bg-primary-container px-lg py-md">
                        <h3 class="font-headline-md text-headline-md text-on-secondary">Kriteria Penilaian</h3>
                    </div>
                    <div class="p-lg space-y-8">
                        <!-- Criteria Row 1: Numeric Input -->
                        <div class="flex flex-col md:flex-row md:items-center gap-6 pb-6 border-b border-surface-variant">
                            <div class="md:w-1/3">
                                <label class="font-headline-md text-sm block mb-1">Kualitas Kerja (C1)</label>
                                <p class="text-xs text-on-surface-variant">Akurasi dan ketelitian dalam penyelesaian tugas
                                    harian.</p>
                            </div>
                            <div class="md:w-2/3 flex items-center gap-4">
                                <input
                                    class="w-full h-2 bg-surface-container rounded-lg appearance-none cursor-pointer accent-secondary"
                                    max="100" min="1" type="range" value="75" />
                                <input
                                    class="w-20 bg-surface border border-outline-variant rounded-lg px-3 py-2 text-center text-body-md font-bold text-secondary"
                                    type="number" value="75" />
                            </div>
                        </div>
                        <!-- Criteria Row 2: Range Selection -->
                        <div class="flex flex-col md:flex-row md:items-center gap-6 pb-6 border-b border-surface-variant">
                            <div class="md:w-1/3">
                                <label class="font-headline-md text-sm block mb-1">Kedisiplinan (C2)</label>
                                <p class="text-xs text-on-surface-variant">Ketaatan terhadap jam kerja dan prosedur
                                    operasional.
                                </p>
                            </div>
                            <div class="md:w-2/3 grid grid-cols-5 gap-2">
                                <button
                                    class="py-2 rounded border border-outline-variant text-xs hover:bg-secondary/5 transition-colors">Sangat
                                    Kurang</button>
                                <button
                                    class="py-2 rounded border border-outline-variant text-xs hover:bg-secondary/5 transition-colors">Kurang</button>
                                <button
                                    class="py-2 rounded border border-secondary bg-secondary/5 text-secondary font-bold text-xs">Cukup</button>
                                <button
                                    class="py-2 rounded border border-outline-variant text-xs hover:bg-secondary/5 transition-colors">Baik</button>
                                <button
                                    class="py-2 rounded border border-outline-variant text-xs hover:bg-secondary/5 transition-colors">Sangat
                                    Baik</button>
                            </div>
                        </div>
                        <!-- Criteria Row 3: Numeric Input -->
                        <div class="flex flex-col md:flex-row md:items-center gap-6 pb-6 border-b border-surface-variant">
                            <div class="md:w-1/3">
                                <label class="font-headline-md text-sm block mb-1">Lama Lembur (C3)</label>
                                <p class="text-xs text-on-surface-variant">Total jam kerja tambahan yang dilakukan (dalam
                                    jam).
                                </p>
                            </div>
                            <div class="md:w-2/3 flex items-center gap-4">
                                <div class="relative w-full">
                                    <input
                                        class="w-full bg-surface border border-outline-variant rounded-lg px-4 py-2 text-body-md focus:border-secondary focus:ring-1 focus:ring-secondary"
                                        placeholder="0" type="number" />
                                    <span
                                        class="absolute right-4 top-1/2 -translate-y-1/2 text-xs text-on-surface-variant font-bold">JAM</span>
                                </div>
                            </div>
                        </div>
                        <!-- Criteria Row 4: Range Selection -->
                        <div class="flex flex-col md:flex-row md:items-center gap-6">
                            <div class="md:w-1/3">
                                <label class="font-headline-md text-sm block mb-1">Perilaku (C4)</label>
                                <p class="text-xs text-on-surface-variant">Etika kerja, kerjasama tim, dan inisiatif
                                    pribadi.
                                </p>
                            </div>
                            <div class="md:w-2/3 flex items-center gap-4">
                                <input
                                    class="w-full h-2 bg-surface-container rounded-lg appearance-none cursor-pointer accent-secondary"
                                    max="100" min="1" type="range" value="85" />
                                <input
                                    class="w-20 bg-surface border border-outline-variant rounded-lg px-3 py-2 text-center text-body-md font-bold text-secondary"
                                    type="number" value="85" />
                            </div>
                        </div>
                    </div>
                    <div class="bg-surface-container-low p-lg flex justify-end gap-4">
                        <button
                            class="px-6 py-2.5 rounded-lg text-secondary border border-secondary font-semibold hover:bg-secondary/5 active:scale-[0.98] transition-all">
                            Reset Form
                        </button>
                        <button
                            class="px-8 py-2.5 rounded-lg bg-tertiary text-white font-semibold hover:opacity-90 active:scale-[0.98] transition-all flex items-center gap-2">
                            <span class="material-symbols-outlined text-sm">save</span>
                            Simpan Nilai
                        </button>
                    </div>
                </div>
            </div>
            <!-- Right Column: Summary Card -->
            <div class="col-span-12 lg:col-span-4 space-y-6">
                <div class="bg-white border border-outline-variant rounded-xl p-lg custom-shadow sticky top-24">
                    <h3 class="font-headline-md text-headline-md text-primary mb-6 flex items-center gap-2">
                        <span class="material-symbols-outlined text-secondary">account_circle</span>
                        Profil Terpilih
                    </h3>
                    <div class="flex flex-col items-center text-center pb-6 border-b border-surface-variant">
                        <div class="relative mb-4">
                            <img alt="Budi Setiawan" class="w-32 h-32 rounded-full object-cover ring-4 ring-secondary/10"
                                data-alt="professional portrait of a middle-aged male employee with glasses smiling warmly against a neutral grey studio background"
                                src="https://lh3.googleusercontent.com/aida-public/AB6AXuBy2KGSeNIk4EsIbXXzGTVhxqvuYjRFk3vboy6h0v-dTa1o5E-EBhpixbYr3cHo0qLV7O7VqmOjzFJCgs5B-wWOqodKJoA7RlA-7EFTBCkflGmktG3muzZ9VM5vIAe047iN2C96KMGrTxDzrRbTmgLmRZkXJWHYOEZU9HzVrON0CRc7woJJYDb6LFTN2_saML6MvlfJGaUCAQNTblV5A-x8oiwZeNquU7OfqBXWrkyStk71RDlMygtry_niAenGBKc1xIvO55h27iF1" />
                            <div class="absolute bottom-1 right-1 w-6 h-6 bg-green-500 border-4 border-white rounded-full">
                            </div>
                        </div>
                        <h4 class="font-headline-lg text-lg text-primary">Budi Setiawan, M.Kom</h4>
                        <p class="text-secondary font-bold text-sm tracking-tight mb-1">Senior Data Analyst</p>
                        <p class="text-on-surface-variant text-xs">Divisi Teknologi Informasi</p>
                    </div>
                    <div class="py-6 space-y-4">
                        <div class="flex justify-between items-center text-sm">
                            <span class="text-on-surface-variant">NIP</span>
                            <span class="font-data-tabular text-primary">198203102005011001</span>
                        </div>
                        <div class="flex justify-between items-center text-sm">
                            <span class="text-on-surface-variant">Status Pegawai</span>
                            <span
                                class="px-2 py-0.5 bg-green-100 text-green-700 text-[10px] font-black rounded uppercase">Tetap</span>
                        </div>
                        <div class="flex justify-between items-center text-sm">
                            <span class="text-on-surface-variant">Lama Bekerja</span>
                            <span class="font-data-tabular text-primary">18 Tahun</span>
                        </div>
                        <div class="flex justify-between items-center text-sm">
                            <span class="text-on-surface-variant">Penilaian Terakhir</span>
                            <span class="font-data-tabular text-primary">82.45 (B+)</span>
                        </div>
                    </div>
                    <div class="pt-6 border-t border-surface-variant">
                        <div class="bg-secondary/5 rounded-lg p-4 flex items-start gap-3">
                            <span class="material-symbols-outlined text-secondary">info</span>
                            <p class="text-[11px] leading-relaxed text-secondary-container">Data nilai akan langsung masuk
                                ke
                                antrian kalkulasi SAW setelah disimpan. Pastikan semua input sudah sesuai dengan bukti fisik
                                kinerja.</p>
                        </div>
                    </div>
                </div>
                <!-- Guidance Mini Card -->
                <div class="bg-surface-container-highest/30 border border-dashed border-outline-variant rounded-xl p-md">
                    <h5 class="text-xs font-black text-on-surface-variant uppercase mb-2">Bantuan Cepat</h5>
                    <ul class="space-y-2">
                        <li class="flex items-center gap-2 text-[11px] text-on-surface">
                            <span class="material-symbols-outlined text-[14px]">chevron_right</span>
                            Klik "Simpan" untuk mengunci nilai permanen
                        </li>
                        <li class="flex items-center gap-2 text-[11px] text-on-surface">
                            <span class="material-symbols-outlined text-[14px]">chevron_right</span>
                            Skala penilaian berkisar antara 1 s/d 100
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
@endsection
