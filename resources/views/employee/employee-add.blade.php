@extends('layouts.app')

@section('content')
    <section class="p-8 space-y-8 flex-1">
        <div class="flex items-center gap-2 text-slate-500 mb-2">
            <span class="text-label-sm font-label-sm">Employee Pool</span>
            <span class="material-symbols-outlined text-sm" data-icon="chevron_right">chevron_right</span>
            <span class="text-label-sm font-label-sm text-secondary">Tambah Pegawai</span>
        </div>
        <h2 class="text-display-xl font-display-xl text-primary-container">Tambah Pegawai Baru</h2>
        <p class="text-body-lg font-body-lg text-on-surface-variant max-w-2xl">Lengkapi informasi di bawah ini untuk
            mendaftarkan personil baru ke dalam basis data penilaian Simple Additive Weighting (SAW).</p>
        </div>
        <!-- Form Layout: Two-Column Bento Style -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-lg">
            <!-- Left Column: Photo Upload -->
            <div class="lg:col-span-4 space-y-lg">
                <div class="bg-white rounded-xl custom-shadow border border-slate-100 p-lg">
                    <h3 class="text-headline-md font-headline-md text-primary-container mb-md flex items-center gap-2">
                        <span class="material-symbols-outlined text-secondary" data-icon="add_a_photo">add_a_photo</span>
                        Foto Profil
                    </h3>
                    <div class="relative group">
                        <div
                            class="aspect-square w-full rounded-xl bg-slate-50 border-2 border-dashed border-slate-200 flex flex-col items-center justify-center overflow-hidden transition-all group-hover:border-secondary/50">
                            <img alt="Employee Placeholder" class="w-full h-full object-cover opacity-20 grayscale"
                                data-alt="Abstract minimalist silhouette of a person on a soft gray background with clean lines and geometric shapes"
                                src="https://lh3.googleusercontent.com/aida-public/AB6AXuDuzBkqWpTV5sMrUGEHCO4UhD16PjN81AT9-WEn2ecZHxXrOoAM8734fZVVM28wYrjhVsy82WClISxcjpNISUNo3o-nmbzSKJUCdh5XdY3BDz3yXZV7bvDL-CR_ugrLUPr3egxvZ6XLSyZ8tnlRzQVjoUPGSS7pN3QzAfMHYOEecEXpnc4VvBUKzJl-jpSvem8qTAEC9wKpVlRKdjtEbO9oc7WfLXjFpB3mpOO-3zgq1kifABbSe67OfEBJucapph2DZ-jCVqTC_vCu" />
                            <div
                                class="absolute inset-0 flex flex-col items-center justify-center bg-white/40 backdrop-blur-[2px] opacity-100 group-hover:opacity-0 transition-opacity">
                                <span class="material-symbols-outlined text-slate-400 text-4xl mb-2"
                                    data-icon="cloud_upload">cloud_upload</span>
                                <span class="text-label-sm font-label-sm text-slate-500">Unggah Foto</span>
                            </div>
                            <div
                                class="absolute inset-0 flex flex-col items-center justify-center bg-primary-container/60 opacity-0 group-hover:opacity-100 transition-opacity cursor-pointer">
                                <span class="material-symbols-outlined text-white text-4xl mb-2"
                                    data-icon="edit">edit</span>
                                <span class="text-label-sm font-label-sm text-white">Ganti Foto</span>
                            </div>
                        </div>
                    </div>
                    <div class="mt-md space-y-2">
                        <p class="text-xs text-slate-500 text-center italic">Rekomendasi: File format JPG/PNG, ukuran maks
                            2MB (Ratio 1:1)</p>
                    </div>
                </div>
                <!-- Informational Card -->
                <div class="bg-secondary-container/5 rounded-xl border border-secondary/10 p-lg">
                    <div class="flex gap-4">
                        <span class="material-symbols-outlined text-secondary" data-icon="info"
                            style="font-variation-settings: 'FILL' 1;">info</span>
                        <div>
                            <p class="text-headline-md font-headline-md text-secondary mb-1">Panduan Input</p>
                            <p class="text-body-md font-body-md text-slate-600 leading-relaxed">Pastikan NIP (Nomor Induk
                                Pegawai) unik dan sesuai dengan database pusat HRIS perusahaan untuk menghindari duplikasi
                                data pada sistem scoring.</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Right Column: Details Form -->
            <div class="lg:col-span-8">
                <div class="bg-white rounded-xl custom-shadow border border-slate-100 overflow-hidden">
                    <div class="p-lg border-b border-slate-100 flex items-center justify-between">
                        <h3 class="text-headline-md font-headline-md text-primary-container">Informasi Personal &amp;
                            Pekerjaan</h3>
                        <span
                            class="px-3 py-1 bg-secondary/10 text-secondary text-[10px] font-bold rounded-full uppercase tracking-widest">Wajib
                            Diisi</span>
                    </div>
                    <div class="p-lg space-y-lg">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-lg">
                            <!-- Name -->
                            <div class="space-y-xs">
                                <label class="text-label-sm font-label-sm text-on-surface-variant flex items-center gap-1">
                                    Nama Lengkap <span class="text-error">*</span>
                                </label>
                                <input
                                    class="w-full bg-white border border-outline-variant rounded-lg px-4 py-3 text-body-md font-body-md focus:ring-2 focus:ring-primary-container focus:border-primary-container outline-none transition-all"
                                    placeholder="Masukkan nama sesuai KTP" type="text" />
                            </div>
                            <!-- NIP -->
                            <div class="space-y-xs">
                                <label class="text-label-sm font-label-sm text-on-surface-variant flex items-center gap-1">
                                    Nomor Induk Pegawai (NIP) <span class="text-error">*</span>
                                </label>
                                <input
                                    class="w-full bg-white border border-outline-variant rounded-lg px-4 py-3 text-body-md font-body-md focus:ring-2 focus:ring-primary-container focus:border-primary-container outline-none transition-all"
                                    placeholder="Contoh: 19880521XXXXXXXX" type="text" />
                            </div>
                            <!-- Position -->
                            <div class="space-y-xs">
                                <label class="text-label-sm font-label-sm text-on-surface-variant flex items-center gap-1">
                                    Jabatan / Posisi <span class="text-error">*</span>
                                </label>
                                <div class="relative">
                                    <select
                                        class="w-full bg-white border border-outline-variant rounded-lg px-4 py-3 text-body-md font-body-md focus:ring-2 focus:ring-primary-container focus:border-primary-container outline-none appearance-none transition-all">
                                        <option disabled="" selected="" value="">Pilih Jabatan</option>
                                        <option>Senior Analyst</option>
                                        <option>Division Head</option>
                                        <option>Lead Engineer</option>
                                        <option>Marketing Manager</option>
                                        <option>Operation Staff</option>
                                    </select>
                                    <span
                                        class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400"
                                        data-icon="expand_more">expand_more</span>
                                </div>
                            </div>
                            <!-- Department -->
                            <div class="space-y-xs">
                                <label class="text-label-sm font-label-sm text-on-surface-variant flex items-center gap-1">
                                    Devisi/Unit <span class="text-error">*</span>
                                </label>
                                <div class="relative">
                                    <select
                                        class="w-full bg-white border border-outline-variant rounded-lg px-4 py-3 text-body-md font-body-md focus:ring-2 focus:ring-primary-container focus:border-primary-container outline-none appearance-none transition-all">
                                        <option disabled="" selected="" value="">Pilih Devisi/Unit</option>
                                        <option>Teknologi Informasi</option>
                                        <option>Keuangan &amp; Akuntansi</option>
                                        <option>Sumber Daya Manusia</option>
                                        <option>Pemasaran &amp; Kreatif</option>
                                        <option>Operasional</option>
                                    </select>
                                    <span
                                        class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400"
                                        data-icon="expand_more">expand_more</span>
                                </div>
                            </div>
                            <!-- Join Date -->
                            <div class="space-y-xs">
                                <label class="text-label-sm font-label-sm text-on-surface-variant flex items-center gap-1">
                                    Tanggal Bergabung <span class="text-error">*</span>
                                </label>
                                <div class="relative">
                                    <input
                                        class="w-full bg-white border border-outline-variant rounded-lg px-4 py-3 text-body-md font-body-md focus:ring-2 focus:ring-primary-container focus:border-primary-container outline-none transition-all"
                                        type="date" />
                                    <span
                                        class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400"
                                        data-icon="calendar_today">calendar_today</span>
                                </div>
                            </div>
                            <!-- Status -->
                            <div class="space-y-xs">
                                <label class="text-label-sm font-label-sm text-on-surface-variant flex items-center gap-1">
                                    Status Kepegawaian
                                </label>
                                <div class="flex items-center gap-lg pt-3">
                                    <label class="flex items-center gap-2 cursor-pointer group">
                                        <input checked="" class="w-4 h-4 text-secondary focus:ring-secondary"
                                            name="status" type="radio" />
                                        <span
                                            class="text-body-md font-body-md text-slate-700 group-hover:text-secondary transition-colors">Permanen</span>
                                    </label>
                                    <label class="flex items-center gap-2 cursor-pointer group">
                                        <input class="w-4 h-4 text-secondary focus:ring-secondary" name="status"
                                            type="radio" />
                                        <span
                                            class="text-body-md font-body-md text-slate-700 group-hover:text-secondary transition-colors">Kontrak</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <!-- Additional Notes -->
                        <div class="space-y-xs pt-4">
                            <label class="text-label-sm font-label-sm text-on-surface-variant">Catatan Tambahan
                                (Opsional)</label>
                            <textarea
                                class="w-full bg-white border border-outline-variant rounded-lg px-4 py-3 text-body-md font-body-md focus:ring-2 focus:ring-primary-container focus:border-primary-container outline-none transition-all"
                                placeholder="Keterangan tambahan atau catatan awal kualifikasi..." rows="3"></textarea>
                        </div>
                    </div>
                    <!-- Form Actions -->
                    <div class="p-lg bg-slate-50 border-t border-slate-100 flex items-center justify-end gap-md">
                        <button
                            class="px-6 py-2.5 rounded-lg border border-primary-container text-primary-container font-headline-md text-headline-md hover:bg-white active:bg-slate-100 transition-all flex items-center gap-2">
                            Batal
                        </button>
                        <button
                            class="px-10 py-2.5 rounded-lg bg-primary-container text-white font-headline-md text-headline-md shadow-md hover:shadow-lg hover:scale-[1.02] active:scale-100 transition-all flex items-center gap-2">
                            <span class="material-symbols-outlined" data-icon="save">save</span>
                            Simpan Data
                        </button>
                    </div>
                </div>
                <!-- Progress / Meta data -->
                <div class="mt-md flex justify-between items-center px-2">
                    <p class="text-[11px] text-slate-400">Terakhir diperbarui: Just now oleh Administrator</p>
                    <div class="flex items-center gap-2">
                        <div class="w-2 h-2 rounded-full bg-green-500"></div>
                        <span class="text-[11px] font-bold text-slate-500 uppercase tracking-tighter">System
                            Connected</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
