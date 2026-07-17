@extends('layouts.app')

@section('content')
    <section class="p-8 space-y-8 flex-1" x-data="{ step: 1 }">

        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6">
            <div>
                <h2 class="text-3xl font-bold tracking-tight text-slate-900 font-sans">Proses Simple Additive Weighting (SAW)</h2>
                <p class="text-slate-500 mt-1">Rincian perhitungan secara menyeluruh untuk evaluasi kinerja pegawai.</p>
            </div>
            
            <!-- Period Selector Form (Alpine.js Style with Search & Pagination) -->
            <div x-data="{
                open: false,
                search: '',
                page: 1,
                perPage: 15,
                selected: '{{ $periods->firstWhere('id', $selectedPeriodId)->name ?? 'Pilih Periode' }}',
                selectedId: {{ $selectedPeriodId ?? 'null' }},
                items: [
                    @foreach ($periods as $period)
                        { id: {{ $period->id }}, name: '{{ $period->name }}' },
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
            }" class="relative z-50" @click.outside="open = false">
                <form method="GET" action="{{ route('sawprocess-data') }}" id="periodForm" class="flex items-center gap-3">
                    <input type="hidden" name="period_id" :value="selectedId">
                    <button type="button" @click="open = !open; if(open) { $nextTick(() => $refs.searchInput.focus()); page = 1; search = ''; }"
                        class="bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-sm font-semibold text-slate-700 shadow-sm focus:ring-2 focus:ring-indigo-600 outline-none min-w-[200px] flex items-center justify-between hover:border-indigo-600">
                        <span x-text="selected" class="text-left mr-2"></span>
                        <span class="material-symbols-outlined text-slate-400 transition-transform duration-200" :class="open ? 'rotate-180' : ''">
                            expand_more
                        </span>
                    </button>
                    <div x-show="open" x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 scale-95 -translate-y-1"
                        x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                        x-transition:leave-end="opacity-0 scale-95 -translate-y-1"
                        class="absolute right-0 mt-2 w-full min-w-[200px] overflow-hidden rounded-xl border border-slate-200 bg-white shadow-xl">
                        
                        <!-- Search Input -->
                        <div class="p-2 border-b border-slate-100 bg-slate-50">
                            <input type="text" x-model="search" x-ref="searchInput" @input="page = 1" placeholder="Cari..." 
                                class="w-full px-3 py-1.5 text-xs border border-slate-200 rounded-lg focus:outline-none focus:border-indigo-600 focus:ring-1 focus:ring-indigo-600 bg-white font-normal text-slate-700">
                        </div>

                        <!-- Items List -->
                        <div class="max-h-60 overflow-y-auto">
                            <template x-for="item in paginatedItems" :key="item.id">
                                <button type="button" @click="selectItem(item); $nextTick(() => $el.closest('form').submit())"
                                    class="w-full px-4 py-3 text-left text-sm text-slate-700 hover:bg-slate-50 transition border-b border-slate-100 last:border-0">
                                    <span x-text="item.name"></span>
                                </button>
                            </template>
                            <div x-show="filteredItems.length === 0" class="px-4 py-4 text-xs text-slate-400 italic text-center">
                                Data tidak ditemukan
                            </div>
                        </div>

                        <!-- Pagination -->
                        <div x-show="totalPages > 1" class="flex items-center justify-between px-3 py-2 border-t border-slate-100 bg-slate-50 text-[11px] text-slate-500 font-normal">
                            <button type="button" @click="prevPage()" :disabled="page === 1" class="px-2 py-0.5 rounded border border-slate-200 bg-white hover:bg-slate-50 disabled:opacity-50 disabled:cursor-not-allowed">
                                Prev
                            </button>
                            <span>Page <span x-text="page"></span> of <span x-text="totalPages"></span></span>
                            <button type="button" @click="nextPage()" :disabled="page === totalPages" class="px-2 py-0.5 rounded border border-slate-200 bg-white hover:bg-slate-50 disabled:opacity-50 disabled:cursor-not-allowed">
                                Next
                            </button>
                        </div>

                    </div>
                </form>
            </div>
        </div>

        @if ($employees->isEmpty())
            <!-- Empty State / Simulation Banner -->
            <div class="bg-white border border-slate-200 rounded-2xl p-12 text-center shadow-sm max-w-2xl mx-auto space-y-6">
                <div class="w-20 h-20 bg-slate-100 rounded-full flex items-center justify-center mx-auto text-slate-400">
                    <span class="material-symbols-outlined text-4xl">calculate</span>
                </div>
                <div class="space-y-2">
                    <h3 class="text-xl font-bold text-slate-900">Belum Ada Data Penilaian</h3>
                    <p class="text-slate-500 text-sm max-w-md mx-auto">
                        Untuk memulai perhitungan SAW pada periode ini, silakan masukkan penilaian pegawai terlebih dahulu atau gunakan fitur simulasi pengisian nilai otomatis di bawah ini.
                    </p>
                </div>
                <div>
                    <form method="GET" action="{{ route('sawprocess-data') }}">
                        <input type="hidden" name="period_id" value="{{ $selectedPeriodId }}">
                        <input type="hidden" name="auto_seed" value="1">
                        <button type="submit" class="inline-flex items-center gap-2 px-6 py-3 bg-indigo-600 text-white font-bold rounded-xl hover:bg-indigo-700 transition shadow-lg shadow-indigo-600/20">
                            <span class="material-symbols-outlined text-sm">auto_awesome</span>
                            Simulasikan Isi Nilai Otomatis
                        </button>
                    </form>
                </div>
            </div>
        @else
            <!-- Step Navigation -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
                <!-- Step 1 Button -->
                <button @click="step = 1"
                    class="flex items-center gap-4 p-4 rounded-xl text-left transition border-2"
                    :class="step === 1 ? 'bg-white border-indigo-600 shadow-md ring-4 ring-indigo-50' : 'bg-white border-slate-200 shadow-sm opacity-70 hover:opacity-100'">
                    <div class="w-10 h-10 rounded-full flex items-center justify-center font-bold text-sm"
                        :class="step === 1 ? 'bg-indigo-600 text-white' : 'bg-slate-100 text-slate-500'">
                        1
                    </div>
                    <div>
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Langkah 1</p>
                        <p class="text-sm font-extrabold text-slate-800">Data Awal (X)</p>
                    </div>
                </button>

                <!-- Step 2 Button -->
                <button @click="step = 2"
                    class="flex items-center gap-4 p-4 rounded-xl text-left transition border-2"
                    :class="step === 2 ? 'bg-white border-indigo-600 shadow-md ring-4 ring-indigo-50' : 'bg-white border-slate-200 shadow-sm opacity-70 hover:opacity-100'">
                    <div class="w-10 h-10 rounded-full flex items-center justify-center font-bold text-sm"
                        :class="step === 2 ? 'bg-indigo-600 text-white' : 'bg-slate-100 text-slate-500'">
                        2
                    </div>
                    <div>
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Langkah 2</p>
                        <p class="text-sm font-extrabold text-slate-800">Normalisasi (R)</p>
                    </div>
                </button>

                <!-- Step 3 Button -->
                <button @click="step = 3"
                    class="flex items-center gap-4 p-4 rounded-xl text-left transition border-2"
                    :class="step === 3 ? 'bg-white border-indigo-600 shadow-md ring-4 ring-indigo-50' : 'bg-white border-slate-200 shadow-sm opacity-70 hover:opacity-100'">
                    <div class="w-10 h-10 rounded-full flex items-center justify-center font-bold text-sm"
                        :class="step === 3 ? 'bg-indigo-600 text-white' : 'bg-slate-100 text-slate-500'">
                        3
                    </div>
                    <div>
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Langkah 3</p>
                        <p class="text-sm font-extrabold text-slate-800">Perkalian Bobot</p>
                    </div>
                </button>

                <!-- Step 4 Button -->
                <button @click="step = 4"
                    class="flex items-center gap-4 p-4 rounded-xl text-left transition border-2"
                    :class="step === 4 ? 'bg-white border-indigo-600 shadow-md ring-4 ring-indigo-50' : 'bg-white border-slate-200 shadow-sm opacity-70 hover:opacity-100'">
                    <div class="w-10 h-10 rounded-full flex items-center justify-center font-bold text-sm"
                        :class="step === 4 ? 'bg-indigo-600 text-white' : 'bg-slate-100 text-slate-500'">
                        4
                    </div>
                    <div>
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Langkah 4</p>
                        <p class="text-sm font-extrabold text-slate-800">Hasil Akhir (V)</p>
                    </div>
                </button>
            </div>

            <div class="grid grid-cols-12 gap-8">
                <!-- Main Calculation Tables -->
                <div class="col-span-12 xl:col-span-8 space-y-6">
                    
                    <!-- STEP 1: MATRIKS KEPUTUSAN (X) -->
                    <div x-show="step === 1" class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden" x-transition>
                        <div class="p-6 border-b border-slate-100 bg-slate-50/50">
                            <h3 class="text-lg font-bold text-slate-900">Matriks Keputusan (X)</h3>
                            <p class="text-sm text-slate-500 mt-1">Berisi skor mentah penilaian setiap alternatif pegawai pada tiap kriteria.</p>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse min-w-[800px]">
                                <thead>
                                    <tr class="bg-slate-50 border-b border-slate-100 text-slate-700">
                                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider">Nama Pegawai</th>
                                        @foreach ($criterias as $crit)
                                            <th class="px-4 py-4 text-xs font-bold uppercase tracking-wider text-center" title="{{ $crit->name }}">
                                                {{ $crit->code }}
                                            </th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-100 text-slate-600">
                                    @foreach ($employees as $emp)
                                        <tr class="hover:bg-slate-50/50 transition-colors">
                                            <td class="px-6 py-4 font-semibold text-slate-900">
                                                <div class="text-sm">{{ $emp->name }}</div>
                                                <div class="text-[10px] text-slate-400">NIP: {{ $emp->nip }}</div>
                                            </td>
                                            @foreach ($criterias as $crit)
                                                <td class="px-4 py-4 text-center font-mono text-sm">
                                                    {{ $matrix[$emp->id][$crit->id] ?? 0 }}
                                                </td>
                                            @endforeach
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- STEP 2: MATRIKS NORMALISASI (R) -->
                    <div x-show="step === 2" class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden" x-transition>
                        <div class="p-6 border-b border-slate-100 bg-slate-50/50">
                            <h3 class="text-lg font-bold text-slate-900">Matriks Normalisasi (R)</h3>
                            <p class="text-sm text-slate-500 mt-1">
                                Skala 0-1 berdasarkan jenis kriteria. Benefit: r<sub>ij</sub> = x<sub>ij</sub>/max(x), Cost: r<sub>ij</sub> = min(x)/x<sub>ij</sub>.
                            </p>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse min-w-[800px]">
                                <thead>
                                    <tr class="bg-slate-50 border-b border-slate-100 text-slate-700">
                                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider">Nama Pegawai</th>
                                        @foreach ($criterias as $crit)
                                            <th class="px-4 py-4 text-xs font-bold uppercase tracking-wider text-center" title="{{ $crit->name }}">
                                                {{ $crit->code }}
                                            </th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-100 text-slate-600">
                                    @foreach ($employees as $emp)
                                        <tr class="hover:bg-slate-50/50 transition-colors">
                                            <td class="px-6 py-4 font-semibold text-slate-900">
                                                <div class="text-sm">{{ $emp->name }}</div>
                                                <div class="text-[10px] text-slate-400">NIP: {{ $emp->nip }}</div>
                                            </td>
                                            @foreach ($criterias as $crit)
                                                <td class="px-4 py-4 text-center font-mono text-sm">
                                                    @php $val = $normalized[$emp->id][$crit->id] ?? 0; @endphp
                                                    <span class="{{ $val == 1 ? 'px-2 py-0.5 bg-green-50 text-green-700 font-bold rounded' : '' }}">
                                                        {{ number_format($val, 4) }}
                                                    </span>
                                                </td>
                                            @endforeach
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- STEP 3: PERKALIAN BOBOT -->
                    <div x-show="step === 3" class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden" x-transition>
                        <div class="p-6 border-b border-slate-100 bg-slate-50/50">
                            <h3 class="text-lg font-bold text-slate-900">Perkalian Bobot Kriteria</h3>
                            <p class="text-sm text-slate-500 mt-1">Mengalikan nilai ter-normalisasi (R) dengan masing-masing bobot kriteria (W).</p>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse min-w-[800px]">
                                <thead>
                                    <tr class="bg-slate-50 border-b border-slate-100 text-slate-700">
                                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider">Nama Pegawai</th>
                                        @foreach ($criterias as $crit)
                                            <th class="px-4 py-4 text-xs font-bold uppercase tracking-wider text-center" title="{{ $crit->name }}">
                                                {{ $crit->code }}<br><span class="text-[10px] text-slate-400">({{ $crit->weight * 100 }}%)</span>
                                            </th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-100 text-slate-600">
                                    @foreach ($employees as $emp)
                                        <tr class="hover:bg-slate-50/50 transition-colors">
                                            <td class="px-6 py-4 font-semibold text-slate-900">
                                                <div class="text-sm">{{ $emp->name }}</div>
                                                <div class="text-[10px] text-slate-400">NIP: {{ $emp->nip }}</div>
                                            </td>
                                            @foreach ($criterias as $crit)
                                                <td class="px-4 py-4 text-center font-mono text-sm">
                                                    @php
                                                        $val = $normalized[$emp->id][$crit->id] ?? 0;
                                                        $weighted = $val * $crit->weight;
                                                    @endphp
                                                    {{ number_format($weighted, 4) }}
                                                </td>
                                            @endforeach
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- STEP 4: HASIL AKHIR (V) -->
                    <div x-show="step === 4" class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden" x-transition>
                        <div class="p-6 border-b border-slate-100 bg-slate-50/50 flex justify-between items-center">
                            <div>
                                <h3 class="text-lg font-bold text-slate-900">Peringkat Hasil Akhir (V)</h3>
                                <p class="text-sm text-slate-500 mt-1">Total nilai preferensi alternatif, diurutkan dari yang tertinggi.</p>
                            </div>
                            <a href="{{ route('employee-rank') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-50 border border-indigo-100 rounded-lg text-xs font-bold text-indigo-700 hover:bg-indigo-100 transition">
                                <span class="material-symbols-outlined text-[14px]">leaderboard</span>
                                Lihat Halaman Ranking
                            </a>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse">
                                <thead>
                                    <tr class="bg-slate-50 border-b border-slate-100 text-slate-700">
                                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-center w-16">Rank</th>
                                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider">Nama Pegawai</th>
                                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider">Divisi / Unit</th>
                                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-center">Nilai Akhir (V)</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-100 text-slate-600">
                                    @foreach ($preferences as $index => $pref)
                                        <tr class="hover:bg-slate-50/50 transition-colors">
                                            <td class="px-6 py-4 text-center font-bold text-slate-955">
                                                @if ($index == 0)
                                                    <span class="w-6 h-6 rounded-full bg-yellow-400 text-yellow-950 flex items-center justify-center mx-auto text-xs">1</span>
                                                @elseif ($index == 1)
                                                    <span class="w-6 h-6 rounded-full bg-slate-300 text-slate-800 flex items-center justify-center mx-auto text-xs">2</span>
                                                @elseif ($index == 2)
                                                    <span class="w-6 h-6 rounded-full bg-amber-600 text-amber-50 flex items-center justify-center mx-auto text-xs">3</span>
                                                @else
                                                    {{ $index + 1 }}
                                                @endif
                                            </td>
                                            <td class="px-6 py-4">
                                                <div class="text-sm font-semibold text-slate-900">{{ $pref['employee']->name }}</div>
                                                <div class="text-[10px] text-slate-400">NIP: {{ $pref['employee']->nip }}</div>
                                            </td>
                                            <td class="px-6 py-4 text-sm text-slate-500">
                                                {{ $pref['employee']->department->name ?? '-' }}
                                            </td>
                                            <td class="px-6 py-4 text-center font-mono font-bold text-slate-900 text-base">
                                                {{ number_format($pref['total'], 4) }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>

                <!-- Right Sidebar: Info & Criteria Weights -->
                <div class="col-span-12 xl:col-span-4 space-y-6">
                    
                    <!-- Criteria Weights Card -->
                    <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm">
                        <h4 class="text-sm font-bold text-slate-900 uppercase tracking-wider mb-4">Bobot Kriteria (W)</h4>
                        <div class="space-y-4">
                            @foreach ($criterias as $crit)
                                <div>
                                    <div class="flex justify-between text-xs mb-1 text-slate-600">
                                        <span class="font-semibold">{{ $crit->code }}: {{ $crit->name }}</span>
                                        <span class="font-bold font-mono">{{ $crit->weight * 100 }}%</span>
                                    </div>
                                    <div class="w-full bg-slate-100 rounded-full h-1.5">
                                        <div class="bg-indigo-600 h-1.5 rounded-full" style="width: {{ $crit->weight * 100 }}%"></div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Reset/Simulate Card -->
                    <div class="bg-indigo-905 text-white p-6 rounded-xl shadow-lg relative overflow-hidden" style="background-color: #1e1b4b;">
                        <div class="relative z-10 space-y-4">
                            <h4 class="text-xs font-bold text-indigo-200 uppercase tracking-wider">Reset & Simulasi</h4>
                            <p class="text-xs text-indigo-100 leading-relaxed">
                                Ingin mengacak nilai baru untuk mensimulasikan hasil pemeringkatan yang berbeda? Klik tombol di bawah ini.
                            </p>
                            <form method="GET" action="{{ route('sawprocess-data') }}">
                                <input type="hidden" name="period_id" value="{{ $selectedPeriodId }}">
                                <input type="hidden" name="auto_seed" value="1">
                                <button type="submit" class="w-full bg-white text-indigo-900 font-extrabold text-sm py-2.5 rounded-lg hover:bg-slate-50 transition shadow">
                                    Refresh Simulasi Nilai
                                </button>
                            </form>
                        </div>
                        <div class="absolute -right-10 -bottom-10 w-40 h-40 bg-white/5 rounded-full blur-3xl"></div>
                    </div>

                    <!-- Quick tips -->
                    <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm space-y-3">
                        <div class="flex items-center gap-2 text-indigo-600">
                            <span class="material-symbols-outlined text-[20px]">info</span>
                            <h4 class="text-sm font-bold text-slate-900">Tips Perhitungan</h4>
                        </div>
                        <p class="text-xs text-slate-500 leading-relaxed">
                            Metode SAW (Simple Additive Weighting) bekerja dengan mencari penjumlahan terbobot dari rating kinerja pada setiap alternatif untuk semua atribut.
                        </p>
                        <p class="text-xs text-slate-500 leading-relaxed">
                            Kriteria bertipe <strong>benefit</strong> berarti semakin besar nilai, semakin baik. Kriteria bertipe <strong>cost</strong> (seperti Pelanggaran) berarti semakin kecil nilai, semakin baik.
                        </p>
                    </div>

                </div>
            </div>
        @endif

    </section>
@endsection
