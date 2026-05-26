@extends('layouts.app')

@section('content')
    <section class="p-8 space-y-8 flex-1">
        <div class="mb-8">
            <h2 class="font-headline-lg text-headline-lg text-primary mb-1">Input Nilai Pegawai</h2>
            <p class="font-body-md text-on-surface-variant max-w-2xl">Lakukan penilaian objektif berdasarkan parameter
                kriteria
                yang telah ditentukan untuk mendukung akurasi perhitungan metode Simple Additive Weighting (SAW).</p>
        </div>
        <div class="grid grid-cols-12 gap-8 items-start"
            x-data="{
                open: false,
                selected: 'Pilih salah satu pegawai...',
                selectedId: '',
                search: '',

                selectedEmployee: null,
            
                employees: @js(
                    $employees->map(function ($employee) {
                        return [
                            'id' => $employee->id,
                            'label' => $employee->name . ' (NIP: ' . $employee->nip . ')',
                            'name' => $employee->name,
                            'nip' => $employee->nip,
                            'position' => $employee->position->name ?? '-',
                            'department' => $employee->department->name ?? '-',
                            'status' => $employee->status,
                            'tenure' => \Carbon\Carbon::parse($employee->join_date)->diff(now())->y . ' Tahun ' . \Carbon\Carbon::parse($employee->join_date)->diff(now())->m . ' Bulan ' . \Carbon\Carbon::parse($employee->join_date)->diff(now())->d . ' Hari',
                            'photo' => $employee->photo
                                ? asset('storage/' . $employee->photo)
                                : asset('assets/images/default-user.png'),
                            'join_date' => \Carbon\Carbon::parse($employee->join_date)->diffForHumans(),
                            'score' => '82.45 (B+)'
                        ];
                    }),
                ),
            
                get filteredEmployees() {
            
                    return this.employees.filter(item =>
                        item.label.toLowerCase().includes(this.search.toLowerCase())
                    )
                }
            
            }">
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
                    <div x-cloak class="relative">
                        <div class="space-y-xs">
                            <div class="space-y-2 relative">
                                <label class="block text-label-sm font-bold text-on-surface-variant uppercase mb-2">
                                    Nama Lengkap atau NIP
                                </label>
                                <input type="hidden" name="employee_id" :value="selectedId">
                                <button type="button" @click="open = !open; if(open) $nextTick(() => $refs.search.focus())" @click.away="open = false" class="w-full bg-white border border-outline-variant rounded-lg px-3.5 py-2.5 text-body-md outline-none transition-all flex items-center justify-between hover:border-primary-container focus:ring-2 focus:ring-primary-container">
                                    <span class="text-left truncate"
                                        :class="selected == 'Pilih salah satu pegawai...' ? 'text-slate-400' : 'text-slate-800'"
                                        x-text="selected">
                                    </span>
                                    <span class="material-symbols-outlined text-slate-400 transition-transform duration-200"
                                        :class="open ? 'rotate-180' : ''">
                                        expand_more
                                    </span>
                                </button>
                                <div x-show="open" x-transition
                                    class="absolute z-50 mt-2 w-full overflow-hidden rounded-xl border border-slate-200 bg-white shadow-xl">
                                    <div class="p-3 border-b border-slate-100">
                                        <div class="relative">
                                            <input type="text" x-ref="search" x-model="search"
                                                placeholder="Cari nama pegawai / NIP..."
                                                class="w-full rounded-lg border border-slate-200 pl-10 pr-3 py-2 text-sm focus:ring-2 focus:ring-primary-container focus:border-primary-container outline-none">
                                            <span
                                                class="material-symbols-outlined absolute left-3 top-2.5 text-slate-400 text-[20px]">
                                                search
                                            </span>
                                        </div>
                                    </div>
                                    <div class="max-h-64 overflow-y-auto">
                                        <template x-for="item in filteredEmployees" :key="item.id">
                                            <button type="button" @click=" selected = item.label; selectedId = item.id; selectedEmployee = item; open = false; search = '';" class="w-full px-4 py-3 text-left text-sm text-slate-700 hover:bg-slate-50 border-b border-slate-100 transition">
                                                <span x-text="item.label"></span>
                                            </button>
                                        </template>
                                        <div x-show="filteredEmployees.length === 0" class="px-4 py-5 text-sm text-center text-slate-400">
                                            Pegawai tidak ditemukan
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Assessment Form -->
                <div class="bg-white border border-outline-variant rounded-xl overflow-hidden custom-shadow">
                    <div class="bg-primary-container px-lg py-md">
                        <h3 class="font-headline-md text-headline-md text-on-secondary">Kriteria Penilaian</h3>
                    </div>
                    <div class="p-lg space-y-8">
                        <!-- Criteria Row 1: Numeric Input -->
                        <div x-data="{ score: 75 }"
                            class="flex flex-col md:flex-row md:items-center gap-6 pb-6 border-b border-surface-variant">

                            <div class="md:w-1/3">
                                <label class="font-headline-md text-sm block mb-1">
                                    Kualitas Kerja (C1)
                                </label>

                                <p class="text-xs text-on-surface-variant">
                                    Akurasi dan ketelitian dalam penyelesaian tugas harian.
                                </p>
                            </div>

                            <div class="md:w-2/3 flex items-center gap-4">

                                <!-- Range -->
                                <input x-model="score" min="1" max="100" type="range"
                                    class="w-full h-2 bg-surface-container rounded-lg appearance-none cursor-pointer accent-secondary">

                                <!-- Number -->
                                <input x-model="score" min="1" max="100" type="number"
                                    class="w-20 bg-surface border border-outline-variant rounded-lg px-3 py-2 text-center text-body-md font-bold text-secondary focus:ring-1 focus:ring-secondary outline-none">

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
                        <div x-data="overtimeCalculator()"
                            class="flex flex-col md:flex-row md:items-center gap-6 pb-6 border-b border-surface-variant">
                            <div class="md:w-1/3">
                                <label class="font-headline-md text-sm block mb-1">
                                    Lama Lembur (C3)
                                </label>
                                <p class="text-xs text-on-surface-variant">
                                    Pilih jam mulai dan selesai lembur.
                                </p>
                            </div>
                            <div class="md:w-2/3 space-y-4 w-full">
                                <div class="grid grid-cols-2 gap-4">
                                    <div class="relative">
                                        <input id="start_time" type="text" placeholder="Jam Mulai"
                                            class="w-full bg-surface border border-outline-variant rounded-lg px-4 py-2 text-body-md focus:ring-1 focus:ring-secondary outline-none h-11">
                                        <button type="button" tabindex="-1"
                                            class="absolute right-3 top-2.5 text-outline hover:text-primary transition-colors pointer-events-none">
                                            <span class="material-symbols-outlined">
                                                schedule
                                            </span>
                                        </button>
                                    </div>
                                    <div class="relative">
                                        <input id="end_time" type="text" placeholder="Jam Selesai"
                                            class="w-full bg-surface border border-outline-variant rounded-lg px-4 py-2 text-body-md focus:ring-1 focus:ring-secondary outline-none h-11">
                                        <button type="button" tabindex="-1"
                                            class="absolute right-3 top-2.5 text-outline hover:text-primary transition-colors pointer-events-none">
                                            <span class="material-symbols-outlined">
                                                schedule
                                            </span>
                                        </button>
                                    </div>
                                </div>
                                <div class="rounded-xl bg-secondary/10 border border-secondary/20 px-4 py-3">
                                    <p class="text-[11px] uppercase text-slate-500 mb-1">
                                        Total Jam Lembur
                                    </p>
                                    <p class="text-lg font-bold text-slate-800">
                                        <span x-text="totalHours"></span> Jam
                                    </p>
                                </div>
                                <input type="hidden" name="overtime_hours" :value="totalHours">
                            </div>
                        </div>
                        <!-- Criteria Row 4: Range Selection -->
                        <div x-data="{ score: 85 }"
                            class="flex flex-col md:flex-row md:items-center gap-6 pb-6 border-b border-surface-variant">
                            <div class="md:w-1/3">
                                <label class="font-headline-md text-sm block mb-1">
                                    Perilaku (C4)
                                </label>
                                <p class="text-xs text-on-surface-variant">
                                    Etika kerja, kerjasama tim, dan inisiatif
                                    pribadi.
                                </p>
                            </div>
                            <div class="md:w-2/3 flex items-center gap-4">
                                <input x-model="score" min="1" max="100" type="range"
                                    class="w-full h-2 bg-surface-container rounded-lg appearance-none cursor-pointer accent-secondary">
                                <input x-model="score" min="1" max="100" type="number"
                                    class="w-20 bg-surface border border-outline-variant rounded-lg px-3 py-2 text-center text-body-md font-bold text-secondary focus:ring-1 focus:ring-secondary outline-none">
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
            <div x-show="selectedEmployee" x-cloak class="col-span-12 lg:col-span-4 space-y-6">
                <div class="bg-white border border-outline-variant rounded-xl p-lg custom-shadow sticky top-24">
                    <h3 class="font-headline-md text-headline-md text-primary mb-6 flex items-center gap-2">
                        <span class="material-symbols-outlined text-secondary">account_circle</span>
                        Profil Terpilih
                    </h3>
                    <div class="flex flex-col items-center text-center pb-6 border-b border-surface-variant">
                        <div class="relative mb-4">
                            <img :src="selectedEmployee?.photo" class="w-32 h-32 rounded-full object-cover ring-4 ring-secondary/10" />
                            <div class="absolute bottom-1 right-1 w-6 h-6 bg-green-500 border-4 border-white rounded-full">
                            </div>
                        </div>
                        <h4 class="font-headline-lg text-lg text-primary" x-text="selectedEmployee?.name || 'Nama Karyawan'"></h4>
                        <p class="text-secondary font-bold text-sm tracking-tight mb-1" x-text="selectedEmployee?.position || 'Jabatan'"></p>
                        <p class="text-on-surface-variant text-xs" x-text="selectedEmployee?.department || 'Divisi'""></p>
                    </div>
                    <div class="py-6 space-y-4">
                        <div class="flex justify-between items-center text-sm">
                            <span class="text-on-surface-variant">NIP</span>
                            <span class="font-data-tabular text-primary" x-text="selectedEmployee?.nip || 'NIP tidak tersedia'"></span>
                        </div>
                        <div class="flex justify-between items-center text-sm">
                            <span class="text-on-surface-variant">Status Pegawai</span>
                            <span
                                class="px-2 py-0.5 bg-green-100 text-green-700 text-[10px] font-black rounded uppercase" x-text="selectedEmployee?.status || 'Status tidak tersedia'"></span>
                        </div>
                        <div class="flex justify-between items-center text-sm">
                            <span class="text-on-surface-variant">Lama Bekerja</span>
                            <span class="font-data-tabular text-primary" x-text="selectedEmployee?.tenure || 'Lama bekerja tidak tersedia'">18 Tahun</span>
                        </div>
                        <div class="flex justify-between items-center text-sm">
                            <span class="text-on-surface-variant">Penilaian Terakhir</span>
                            <span class="font-data-tabular text-primary" x-text="selectedEmployee?.lastEvaluation || 'Penilaian terakhir tidak tersedia'">82.45 (B+)</span>
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
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script>
        function overtimeCalculator() {
            return {
                totalHours: 0,

                init() {

                    let self = this;

                    flatpickr("#start_time", {
                        enableTime: true,
                        noCalendar: true,
                        dateFormat: "H:i",
                        time_24hr: true,
                        onChange() {
                            self.calculate();
                        }
                    });

                    flatpickr("#end_time", {
                        enableTime: true,
                        noCalendar: true,
                        dateFormat: "H:i",
                        time_24hr: true,
                        onChange() {
                            self.calculate();
                        }
                    });
                },

                calculate() {

                    let start = document.getElementById('start_time').value;
                    let end = document.getElementById('end_time').value;

                    if (!start || !end) return;

                    let [sh, sm] = start.split(':').map(Number);
                    let [eh, em] = end.split(':').map(Number);

                    let startMinutes = (sh * 60) + sm;
                    let endMinutes = (eh * 60) + em;

                    if (endMinutes < startMinutes) {
                        endMinutes += 1440;
                    }

                    let diff = endMinutes - startMinutes;

                    this.totalHours = (diff / 60).toFixed(1);
                }
            }
        }
    </script>
@endpush
