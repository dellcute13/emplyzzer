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
        <form action="{{ route('employee.employee-store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-lg">
                <!-- Left Column: Photo Upload -->
                <div class="lg:col-span-4 space-y-lg">
                    <div class="bg-white rounded-xl custom-shadow border border-slate-100 p-lg" x-data="photoUploader()">
                        <h3 class="text-headline-md font-headline-md text-primary-container mb-md flex items-center gap-2">
                            <span class="material-symbols-outlined text-secondary">
                                add_a_photo
                            </span>
                            Foto Profil
                        </h3>
                        <div class="relative group">
                            <input type="file" name="photo" accept="image/*" class="hidden" x-ref="file"
                                @change="previewImage($event)">
                            <div @click="$refs.file.click()"
                                class="aspect-square w-full rounded-xl bg-slate-50 border-2 border-dashed border-slate-200 flex flex-col items-center justify-center overflow-hidden transition-all cursor-pointer group-hover:border-secondary/50">
                                <template x-if="imageUrl && !resultUrl">
                                    <img :src="imageUrl" class="w-full h-full object-cover">
                                </template>

                                {{-- Preview Result AI --}}
                                <template x-if="resultUrl">
                                    <img :src="resultUrl" class="w-full h-full object-cover">
                                </template>
                                <template x-if="!imageUrl && !resultUrl">
                                    <div class="text-center">
                                        <span class="material-symbols-outlined text-slate-400 text-4xl mb-2">
                                            cloud_upload
                                        </span>
                                        <p class="text-sm text-slate-500">
                                            Unggah Foto
                                        </p>
                                    </div>
                                </template>
                            </div>
                        </div>
                        {{-- Hidden final path untuk dikirim ke Laravel --}}
                        <input type="hidden" name="photo_ai" x-model="photoAi">
                        <div class="mt-4 space-y-3">
                            <button type="button" x-show="imageUrl && !resultUrl" @click="generateAI()"
                                class="w-full bg-slate-900 text-white py-3 rounded-xl font-semibold">
                                <span x-show="!loading">Generate AI Background</span>
                                <span x-show="loading">Processing...</span>
                            </button>
                            <button type="button" x-show="resultUrl" @click="usePhoto()"
                                class="w-full bg-emerald-500 text-white py-3 rounded-xl font-semibold">
                                Gunakan Foto Ini
                            </button>
                            <button type="button" x-show="imageUrl" @click="$refs.file.click()"
                                class="w-full border border-slate-200 py-3 rounded-xl font-semibold text-slate-600">
                                Ganti Foto
                            </button>
                            <div class="grid grid-cols-2 gap-3" x-show="imageUrl && !resultUrl">
                                <label @click="size = '3x4'"
                                    :class="size === '3x4'
                                        ?
                                        'border-secondary bg-secondary/10 text-secondary' :
                                        'border-slate-200 bg-white text-slate-600'"
                                    class="cursor-pointer rounded-xl border-2 p-4 transition-all">
                                    <input type="radio" value="3x4" x-model="size" class="hidden">
                                    <div class="flex flex-col items-center gap-3">
                                        <div class="w-10 h-14 rounded-md border-2 border-current"></div>
                                        <div class="text-center">
                                            <p class="font-semibold">3x4</p>
                                            <p class="text-xs opacity-70">Standar Pegawai</p>
                                        </div>
                                    </div>
                                </label>
                                <label @click="size = '4x6'"
                                    :class="size === '4x6'
                                        ?
                                        'border-secondary bg-secondary/10 text-secondary' :
                                        'border-slate-200 bg-white text-slate-600'"
                                    class="cursor-pointer rounded-xl border-2 p-4 transition-all">
                                    <input type="radio" value="4x6" x-model="size" class="hidden">
                                    <div class="flex flex-col items-center gap-3">
                                        <div class="w-10 h-16 rounded-md border-2 border-current"></div>
                                        <div class="text-center">
                                            <p class="font-semibold">4x6</p>
                                            <p class="text-xs opacity-70">Lebih Tinggi</p>
                                        </div>
                                    </div>
                                </label>
                            </div>
                        </div>
                        <p class="text-xs text-slate-500 text-center italic mt-3">
                            JPG/PNG maks 2MB
                        </p>
                    </div>
                    <!-- Informational Card -->
                    <div class="bg-secondary-container/5 rounded-xl border border-secondary/10 p-lg">
                        <div class="flex gap-4">
                            <span class="material-symbols-outlined text-secondary" data-icon="info"
                                style="font-variation-settings: 'FILL' 1;">info</span>
                            <div>
                                <p class="text-headline-md font-headline-md text-secondary mb-1">Panduan Input</p>
                                <p class="text-body-md font-body-md text-slate-600 leading-relaxed">Pastikan NIP (Nomor
                                    Induk
                                    Pegawai) unik dan sesuai dengan database pusat HRIS perusahaan untuk menghindari
                                    duplikasi
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
                                    <label
                                        class="text-label-sm font-label-sm text-on-surface-variant flex items-center gap-1">
                                        Nama Lengkap <span class="text-error">*</span>
                                    </label>
                                    <input name="name"
                                        class="w-full bg-white border border-outline-variant rounded-lg px-4 py-3 text-body-md font-body-md focus:ring-2 focus:ring-primary-container focus:border-primary-container outline-none transition-all"
                                        placeholder="Masukkan nama sesuai KTP" type="text" />
                                </div>
                                <!-- NIP -->
                                <div class="space-y-xs">
                                    <label
                                        class="text-label-sm font-label-sm text-on-surface-variant flex items-center gap-1">
                                        Nomor Induk Pegawai (NIP) <span class="text-error">*</span>
                                    </label>
                                    <input name="nip"
                                        class="w-full bg-white border border-outline-variant rounded-lg px-4 py-3 text-body-md font-body-md focus:ring-2 focus:ring-primary-container focus:border-primary-container outline-none transition-all"
                                        placeholder="Contoh: 19880521XXXXXXXX" type="text" />
                                </div>
                                <!-- Gender Pegawai -->
                                <div class="space-y-xs">
                                    <div x-data="{ open: false, selected: 'Pilih Gender Pegawai' }" class="space-y-2 relative">

                                        <label
                                            class="text-label-sm font-label-sm text-on-surface-variant flex items-center gap-1">
                                            Gender Pegawai
                                            <span class="text-error">*</span>
                                        </label>

                                        <input type="hidden" name="gender" :value="selected">

                                        <button type="button" @click="open = !open" @click.away="open = false"
                                            class="w-full bg-white border border-outline-variant rounded-lg px-3.5 py-2.5 text-body-md font-body-md outline-none transition-all flex items-center justify-between hover:border-primary-container focus:border-primary-container focus:ring-2 focus:ring-primary-container">

                                            <span class="text-left"
                                                :class="selected == 'Pilih Gender Pegawai' ? 'text-slate-400' : 'text-slate-800'"
                                                x-text="selected == 'L' ? 'Laki-laki' : selected == 'P' ? 'Perempuan' : 'Pilih Gender Pegawai'">
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

                                            <button type="button" @click="selected='L'; open=false"
                                                class="w-full px-4 py-3 text-left text-sm text-slate-700 hover:bg-slate-50 transition">
                                                Laki-laki
                                            </button>

                                            <button type="button" @click="selected='P'; open=false"
                                                class="w-full px-4 py-3 text-left text-sm text-slate-700 border-t border-slate-100 hover:bg-slate-50 transition">
                                                Perempuan
                                            </button>

                                        </div>
                                    </div>
                                </div>
                                <!-- Position -->
                                <div class="space-y-xs">
                                    <div x-data="{
                                        open: false,
                                        search: '',
                                        page: 1,
                                        perPage: 15,
                                        selected: 'Pilih Jabatan',
                                        selectedId: null,
                                        items: [
                                            @foreach ($positions as $position)
                                                { id: {{ $position->id }}, name: '{{ $position->name }}', extra: '{{ $position->grade->name }}' },
                                            @endforeach
                                        ],
                                        get filteredItems() {
                                            return this.items.filter(item => 
                                                item.name.toLowerCase().includes(this.search.toLowerCase())
                                            );
                                        },
                                        get paginatedItems() {
                                            let start = (this.page - 1) * this.perPage;
                                            return this.filteredItems.slice(start, start + this.perPage);
                                        },
                                        get totalPages() {
                                            return Math.ceil(this.filteredItems.length / this.perPage) || 1;
                                        },
                                        nextPage() {
                                            if (this.page < this.totalPages) this.page++;
                                        },
                                        prevPage() {
                                            if (this.page > 1) this.page--;
                                        },
                                        selectItem(item) {
                                            this.selected = item.name;
                                            this.selectedId = item.id;
                                            this.open = false;
                                        }
                                    }" class="space-y-2 relative" @click.outside="open = false">
                                        <label
                                            class="text-label-sm font-label-sm text-on-surface-variant flex items-center gap-1">
                                            Jabatan / Posisi
                                            <span class="text-error">*</span>
                                        </label>
                                        <input type="hidden" name="position_id" :value="selectedId">
                                        <button type="button" @click="open = !open; if(open) { $nextTick(() => $refs.searchPosition.focus()); page = 1; search = ''; }"
                                            class="w-full bg-white border border-outline-variant rounded-lg px-3.5 py-2.5 text-body-md font-body-md outline-none transition-all flex items-center justify-between hover:border-primary-container focus:border-primary-container focus:ring-2 focus:ring-primary-container">
                                            <span class="text-left"
                                                :class="selected == 'Pilih Jabatan' ? 'text-slate-400' : 'text-slate-800'"
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
                                            class="absolute z-[100] mt-2 w-full overflow-hidden rounded-xl border border-slate-200 bg-white shadow-xl">
                                            
                                            <!-- Search Input -->
                                            <div class="p-2 border-b border-slate-100 bg-slate-50">
                                                <input type="text" x-model="search" x-ref="searchPosition" @input="page = 1" placeholder="Cari..." 
                                                    class="w-full px-3 py-1.5 text-xs border border-slate-200 rounded-lg focus:outline-none focus:border-indigo-600 focus:ring-1 focus:ring-indigo-600 bg-white">
                                            </div>

                                            <!-- Items List -->
                                            <div class="max-h-60 overflow-y-auto">
                                                <template x-for="item in paginatedItems" :key="item.id">
                                                    <button type="button" @click="selectItem(item)"
                                                        class="w-full px-4 py-2.5 text-left text-sm text-slate-700 hover:bg-slate-50 transition border-b border-slate-100 last:border-0 flex items-center justify-between">
                                                        <span x-text="item.name"></span>
                                                        <span class="text-xs text-slate-400" x-text="item.extra"></span>
                                                    </button>
                                                </template>
                                                <div x-show="filteredItems.length === 0" class="px-4 py-4 text-xs text-slate-400 italic text-center">
                                                    Data tidak ditemukan
                                                </div>
                                            </div>

                                            <!-- Pagination -->
                                            <div x-show="totalPages > 1" class="flex items-center justify-between px-3 py-2 border-t border-slate-100 bg-slate-50 text-[11px] text-slate-500">
                                                <button type="button" @click="prevPage()" :disabled="page === 1" class="px-2 py-0.5 rounded border border-slate-200 bg-white hover:bg-slate-50 disabled:opacity-50 disabled:cursor-not-allowed">
                                                    Prev
                                                </button>
                                                <span>Page <span x-text="page"></span> of <span x-text="totalPages"></span></span>
                                                <button type="button" @click="nextPage()" :disabled="page === totalPages" class="px-2 py-0.5 rounded border border-slate-200 bg-white hover:bg-slate-50 disabled:opacity-50 disabled:cursor-not-allowed">
                                                    Next
                                                </button>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <!-- Department -->
                                <div class="space-y-xs">
                                    <div x-data="{
                                        open: false,
                                        search: '',
                                        page: 1,
                                        perPage: 15,
                                        selected: 'Pilih Divisi/Unit',
                                        selectedId: null,
                                        items: [
                                            @foreach ($departments as $department)
                                                { id: {{ $department->id }}, name: '{{ $department->name }}' },
                                            @endforeach
                                        ],
                                        get filteredItems() {
                                            return this.items.filter(item => 
                                                item.name.toLowerCase().includes(this.search.toLowerCase())
                                            );
                                        },
                                        get paginatedItems() {
                                            let start = (this.page - 1) * this.perPage;
                                            return this.filteredItems.slice(start, start + this.perPage);
                                        },
                                        get totalPages() {
                                            return Math.ceil(this.filteredItems.length / this.perPage) || 1;
                                        },
                                        nextPage() {
                                            if (this.page < this.totalPages) this.page++;
                                        },
                                        prevPage() {
                                            if (this.page > 1) this.page--;
                                        },
                                        selectItem(item) {
                                            this.selected = item.name;
                                            this.selectedId = item.id;
                                            this.open = false;
                                        }
                                    }" class="space-y-2 relative" @click.outside="open = false">
                                        <label
                                            class="text-label-sm font-label-sm text-on-surface-variant flex items-center gap-1">
                                            Divisi/Unit
                                            <span class="text-error">*</span>
                                        </label>
                                        <input type="hidden" name="department_id" :value="selectedId">
                                        <button type="button" @click="open = !open; if(open) { $nextTick(() => $refs.searchDept.focus()); page = 1; search = ''; }"
                                            class="w-full bg-white border border-outline-variant rounded-lg px-3.5 py-2.5 text-body-md font-body-md outline-none transition-all flex items-center justify-between hover:border-primary-container focus:border-primary-container focus:ring-2 focus:ring-primary-container">
                                            <span class="text-left"
                                                :class="selected == 'Pilih Divisi/Unit' ? 'text-slate-400' : 'text-slate-800'"
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
                                            class="absolute z-[100] mt-2 w-full overflow-hidden rounded-xl border border-slate-200 bg-white shadow-xl">
                                            
                                            <!-- Search Input -->
                                            <div class="p-2 border-b border-slate-100 bg-slate-50">
                                                <input type="text" x-model="search" x-ref="searchDept" @input="page = 1" placeholder="Cari..." 
                                                    class="w-full px-3 py-1.5 text-xs border border-slate-200 rounded-lg focus:outline-none focus:border-indigo-600 focus:ring-1 focus:ring-indigo-600 bg-white">
                                            </div>

                                            <!-- Items List -->
                                            <div class="max-h-60 overflow-y-auto">
                                                <template x-for="item in paginatedItems" :key="item.id">
                                                    <button type="button" @click="selectItem(item)"
                                                        class="w-full px-4 py-2.5 text-left text-sm text-slate-700 hover:bg-slate-50 transition border-b border-slate-100 last:border-0">
                                                        <span x-text="item.name"></span>
                                                    </button>
                                                </template>
                                                <div x-show="filteredItems.length === 0" class="px-4 py-4 text-xs text-slate-400 italic text-center">
                                                    Data tidak ditemukan
                                                </div>
                                            </div>

                                            <!-- Pagination -->
                                            <div x-show="totalPages > 1" class="flex items-center justify-between px-3 py-2 border-t border-slate-100 bg-slate-50 text-[11px] text-slate-500">
                                                <button type="button" @click="prevPage()" :disabled="page === 1" class="px-2 py-0.5 rounded border border-slate-200 bg-white hover:bg-slate-50 disabled:opacity-50 disabled:cursor-not-allowed">
                                                    Prev
                                                </button>
                                                <span>Page <span x-text="page"></span> of <span x-text="totalPages"></span></span>
                                                <button type="button" @click="nextPage()" :disabled="page === totalPages" class="px-2 py-0.5 rounded border border-slate-200 bg-white hover:bg-slate-50 disabled:opacity-50 disabled:cursor-not-allowed">
                                                    Next
                                                </button>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <!-- Join Date -->
                                <div class="space-y-2">
                                    <label
                                        class="text-label-sm font-label-sm text-on-surface-variant flex items-center gap-1">
                                        Tanggal Bergabung
                                        <span class="text-error">*</span>
                                    </label>
                                    <div class="relative">
                                        <input id="join_date" name="join_date" type="text"
                                            placeholder="Pilih tanggal"
                                            class="w-full bg-white border border-outline-variant rounded-lg p-3 pr-12 text-body-md font-body-md focus:ring-2 focus:ring-primary-container focus:border-primary-container outline-none transition-all">
                                        <button type="button" tabindex="-1"
                                            class="absolute right-3 top-2.5 text-outline hover:text-primary transition-colors pointer-events-none">
                                            <span class="material-symbols-outlined">
                                                event
                                            </span>
                                        </button>
                                    </div>
                                </div>
                                <!-- Status -->
                                <div class="space-y-xs">
                                    <label
                                        class="text-label-sm font-label-sm text-on-surface-variant flex items-center gap-1">
                                        Status Kepegawaian
                                    </label>

                                    <div class="flex items-center gap-lg pt-3">

                                        {{-- Tetap --}}
                                        <label class="flex items-center gap-2 cursor-pointer group">

                                            <input type="radio" name="status" value="permanent" checked
                                                class="w-4 h-4 text-secondary focus:ring-secondary" />

                                            <span
                                                class="text-body-md font-body-md text-slate-700 group-hover:text-secondary transition-colors">

                                                Tetap

                                            </span>
                                        </label>

                                        {{-- Kontrak --}}
                                        <label class="flex items-center gap-2 cursor-pointer group">

                                            <input type="radio" name="status" value="contract"
                                                class="w-4 h-4 text-secondary focus:ring-secondary" />

                                            <span
                                                class="text-body-md font-body-md text-slate-700 group-hover:text-secondary transition-colors">

                                                Kontrak

                                            </span>
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
                            <button type="submit"
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
        </form>
    </section>
@endsection
@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            flatpickr("#join_date", {
                locale: Indonesian,
                dateFormat: "Y-m-d",
                altInput: true,
                altFormat: "d F Y",
                allowInput: false,
                appendTo: document.body,
            });
        });
    </script>
    <script>
        function photoUploader() {
            return {
                imageUrl: null,
                resultUrl: null,
                loading: false,
                file: null,
                photoAi: '',
                size: '3x4',

                previewImage(event) {
                    const file = event.target.files[0];
                    if (!file) return;

                    this.file = file;
                    this.resultUrl = null;
                    this.photoAi = '';
                    this.imageUrl = URL.createObjectURL(file);
                },

                async generateAI() {
                    this.loading = true;

                    console.log("Ukuran dipilih:", this.size);

                    let formData = new FormData();
                    formData.append('photo', this.file);
                    formData.append('size', this.size);

                    try {

                        let csrf = document.querySelector('meta[name="csrf-token"]')?.content;

                        let response = await fetch('/generate-photo-ai', {
                            method: 'POST',
                            body: formData,
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest',
                                'X-CSRF-TOKEN': csrf
                            }
                        });

                        let data = await response.json();

                        if (data.success) {
                            this.resultUrl = data.url;
                            this.photoAi = data.path;
                        } else {
                            alert('Generate gagal');
                        }

                    } catch (error) {
                        console.log(error);
                        alert('Terjadi error');
                    }

                    this.loading = false;
                }
            }
        }
    </script>
@endpush
