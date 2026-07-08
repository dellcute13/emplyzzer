@extends('layouts.app')

@section('content')
    <section class="p-8 space-y-8 flex-1">
        <div class="mb-8">
            <h2 class="font-headline-lg text-3xl font-bold text-primary mb-1 font-sans text-slate-900">Input Nilai Kinerja Pegawai</h2>
            <p class="font-body-md text-slate-500 max-w-2xl">Lakukan penilaian objektif berdasarkan parameter kriteria untuk mendukung perhitungan metode Simple Additive Weighting (SAW).</p>
        </div>

        <form action="{{ route('evaluation.evaluation-store') }}" method="POST">
            @csrf

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
                                'tenure' => \Carbon\Carbon::parse($employee->join_date)->diff(now())->y . ' Tahun ' . \Carbon\Carbon::parse($employee->join_date)->diff(now())->m . ' Bulan',
                                'photo' => $employee->photo
                                    ? asset('storage/' . $employee->photo)
                                    : asset('assets/images/default-user.png'),
                                'join_date' => \Carbon\Carbon::parse($employee->join_date)->diffForHumans(),
                            ];
                        })
                    ),
                    get filteredEmployees() {
                        return this.employees.filter(item =>
                            item.label.toLowerCase().includes(this.search.toLowerCase())
                        )
                    }
                }">

                <!-- Left Column: Selection & Form -->
                <div class="col-span-12 lg:col-span-8 space-y-6">
                    
                    <!-- Selection Card -->
                    <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm">
                        <div class="mb-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                            <div>
                                <h3 class="font-bold text-lg text-slate-900">Pilih Pegawai & Periode</h3>
                                <p class="text-xs text-slate-500">Tentukan kandidat dan periode penilaian saat ini</p>
                            </div>
                            <div>
                                <select name="period_id" required class="bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-sm font-semibold text-slate-700 shadow-sm focus:ring-2 focus:ring-primary-container outline-none min-w-[200px]">
                                    <option value="" disabled selected>Pilih Periode Penilaian</option>
                                    @foreach ($periods as $period)
                                        <option value="{{ $period->id }}">
                                            {{ $period->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Autocomplete Employee Select -->
                        <div class="relative">
                            <label class="block text-xs font-bold text-slate-500 uppercase mb-2">
                                Nama Lengkap atau NIP
                            </label>
                            <input type="hidden" name="employee_id" :value="selectedId" required>
                            
                            <button type="button" @click="open = !open; if(open) $nextTick(() => $refs.search.focus())" @click.away="open = false" 
                                class="w-full bg-white border border-slate-200 rounded-xl px-4 py-3 text-sm outline-none transition-all flex items-center justify-between hover:border-slate-400 focus:ring-2 focus:ring-indigo-500">
                                <span class="text-left truncate" :class="selected == 'Pilih salah satu pegawai...' ? 'text-slate-400' : 'text-slate-800'" x-text="selected"></span>
                                <span class="material-symbols-outlined text-slate-400 transition-transform duration-200" :class="open ? 'rotate-180' : ''">expand_more</span>
                            </button>

                            <div x-show="open" x-transition class="absolute space-y-1 z-50 mt-2 w-full overflow-hidden rounded-xl border border-slate-200 bg-white shadow-xl">
                                <div class="p-3 border-b border-slate-100">
                                    <div class="relative">
                                        <input type="text" x-ref="search" x-model="search" placeholder="Cari nama pegawai / NIP..."
                                            class="w-full rounded-lg border border-slate-200 pl-10 pr-3 py-2 text-sm focus:ring-2 focus:ring-indigo-500 outline-none">
                                        <span class="material-symbols-outlined absolute left-3 top-2.5 text-slate-400 text-[20px]">search</span>
                                    </div>
                                </div>
                                <div class="max-h-64 overflow-y-auto">
                                    <template x-for="item in filteredEmployees" :key="item.id">
                                        <button type="button" 
                                            @click="selected = item.label; selectedId = item.id; selectedEmployee = item; open = false; search = '';" 
                                            class="w-full px-4 py-3 text-left text-sm text-slate-700 hover:bg-slate-50 border-b border-slate-100 transition flex flex-col">
                                            <span class="font-bold text-slate-800" x-text="item.name"></span>
                                            <span class="text-xs text-slate-400" x-text="'NIP: ' + item.nip + ' | ' + item.position + ' - ' + item.department"></span>
                                        </button>
                                    </template>
                                    <div x-show="filteredEmployees.length === 0" class="px-4 py-5 text-sm text-center text-slate-400">
                                        Pegawai tidak ditemukan
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Assessment Form -->
                    <div class="bg-white border border-slate-200 rounded-2xl overflow-hidden shadow-sm">
                        <div class="bg-indigo-900 px-6 py-4 text-white">
                            <h3 class="font-bold text-lg">Nilai Per Kriteria</h3>
                            <p class="text-xs text-indigo-200 mt-0.5">Input nilai 0 - 100 untuk setiap parameter kriteria</p>
                        </div>
                        
                        <div class="p-6 divide-y divide-slate-100 space-y-6">
                            @foreach ($criterias as $crit)
                                <div x-data="{ score: 75 }" class="flex flex-col md:flex-row md:items-center gap-6 pt-6 {{ $loop->first ? 'pt-0' : '' }}">
                                    <div class="md:w-1/3">
                                        <label class="font-bold text-sm block mb-1 text-slate-800">
                                            {{ $crit->name }} ({{ $crit->code }})
                                        </label>
                                        <p class="text-xs text-slate-400">
                                            {{ $crit->description }}
                                        </p>
                                        <div class="mt-1">
                                            @if ($crit->attribute === 'benefit')
                                                <span class="px-2 py-0.5 bg-green-50 text-green-700 text-[10px] font-bold rounded">Benefit</span>
                                            @else
                                                <span class="px-2 py-0.5 bg-red-50 text-red-700 text-[10px] font-bold rounded">Cost</span>
                                            @endif
                                            <span class="text-xs text-slate-400 ml-1">Bobot: {{ $crit->weight * 100 }}%</span>
                                        </div>
                                    </div>

                                    <div class="md:w-2/3 flex items-center gap-4">
                                        <!-- Range Slider -->
                                        <input x-model="score" min="0" max="100" type="range"
                                            class="w-full h-2 bg-slate-100 rounded-lg appearance-none cursor-pointer accent-indigo-600">

                                        <!-- Numeric Box Input -->
                                        <input x-model="score" min="0" max="100" type="number" step="0.01"
                                            name="scores[{{ $crit->id }}]"
                                            class="w-24 bg-white border border-slate-200 rounded-lg px-3 py-2 text-center text-sm font-bold text-indigo-600 focus:ring-2 focus:ring-indigo-500 outline-none">
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Actions -->
                        <div class="bg-slate-50 p-6 flex justify-end gap-4 border-t border-slate-100">
                            <button type="button" @click="selectedEmployee = null; selectedId = ''; selected = 'Pilih salah satu pegawai...'"
                                class="px-6 py-2.5 rounded-xl text-slate-600 border border-slate-200 font-semibold hover:bg-slate-100 transition">
                                Reset Form
                            </button>
                            <button type="submit"
                                class="px-8 py-2.5 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white font-semibold shadow-lg shadow-indigo-600/20 transition flex items-center gap-2">
                                <span class="material-symbols-outlined text-sm">save</span>
                                Simpan Nilai
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Summary Profile Card -->
                <div x-show="selectedEmployee" x-cloak class="col-span-12 lg:col-span-4 sticky top-24">
                    <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm">
                        <h3 class="font-bold text-slate-800 text-base mb-6 flex items-center gap-2">
                            <span class="material-symbols-outlined text-indigo-600">account_circle</span>
                            Profil Terpilih
                        </h3>
                        <div class="flex flex-col items-center text-center pb-6 border-b border-slate-100">
                            <div class="relative mb-4">
                                <img :src="selectedEmployee?.photo" class="w-28 h-28 rounded-full object-cover ring-4 ring-indigo-50" />
                                <div class="absolute bottom-1 right-1 w-5 h-5 bg-green-500 border-4 border-white rounded-full"></div>
                            </div>
                            <h4 class="font-bold text-lg text-slate-900" x-text="selectedEmployee?.name"></h4>
                            <p class="text-indigo-600 font-bold text-xs tracking-tight mb-1" x-text="selectedEmployee?.position"></p>
                            <p class="text-slate-400 text-[11px]" x-text="selectedEmployee?.department"></p>
                        </div>
                        <div class="py-6 space-y-4">
                            <div class="flex justify-between items-center text-xs">
                                <span class="text-slate-400">NIP</span>
                                <span class="font-mono text-slate-800 font-bold" x-text="selectedEmployee?.nip"></span>
                            </div>
                            <div class="flex justify-between items-center text-xs">
                                <span class="text-slate-400">Status Pegawai</span>
                                <span class="px-2 py-0.5 bg-green-50 text-green-700 text-[9px] font-extrabold rounded uppercase tracking-wider" x-text="selectedEmployee?.status"></span>
                            </div>
                            <div class="flex justify-between items-center text-xs">
                                <span class="text-slate-400">Lama Bekerja</span>
                                <span class="text-slate-800 font-medium" x-text="selectedEmployee?.tenure"></span>
                            </div>
                        </div>
                        <div class="pt-6 border-t border-slate-100">
                            <div class="bg-indigo-50 rounded-xl p-4 flex items-start gap-3">
                                <span class="material-symbols-outlined text-indigo-600 text-sm">info</span>
                                <p class="text-[10px] leading-relaxed text-indigo-700">
                                    Data nilai akan langsung masuk ke antrian kalkulasi SAW setelah disimpan. Pastikan semua input sudah sesuai dengan bukti fisik kinerja.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </form>
    </section>
@endsection
