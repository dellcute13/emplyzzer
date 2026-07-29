@extends('layouts.app')

@section('content')
    @php
        $selectedPeriod = $periods->firstWhere('id', $selectedPeriodId);
        $selectedPeriodRange = $selectedPeriod ? $selectedPeriod->start_date . ' to ' . $selectedPeriod->end_date : '';
    @endphp

    <section class="p-8 space-y-8 flex-1" 
        x-data="{ 
            previewModal: false, 
            reportName: '', 
            reportDate: '', 
            reportType: '', 
            reportBy: '', 
            reportPeriodId: null, 
            rankings: [], 
            loading: false,
            async fetchRankings(periodId) {
                if (!periodId) return;
                this.loading = true;
                this.rankings = [];
                try {
                    const res = await fetch(`/report-data/rankings/${periodId}`);
                    if (res.ok) {
                        const data = await res.json();
                        this.rankings = data.rankings;
                    }
                } catch (err) {
                    console.error('Error fetching rankings:', err);
                } finally {
                    this.loading = false;
                }
            },
            async downloadReportFileWithRankings(fileName, createdDate, fileType, employeeName, periodId) {
                if (!periodId) return;
                try {
                    const res = await fetch(`/report-data/rankings/${periodId}`);
                    if (res.ok) {
                        const data = await res.json();
                        const list = data.rankings;
                        
                        let textContent = `LAPORAN EVALUASI KINERJA KARYAWAN (METODE SAW)\n`;
                        textContent += `==================================================\n`;
                        textContent += `Nama Laporan   : ${fileName}\n`;
                        textContent += `Tanggal Dibuat : ${createdDate}\n`;
                        textContent += `Tipe File      : ${fileType.toUpperCase()}\n`;
                        textContent += `Periode        : ${data.period_name}\n`;
                        textContent += `Dibuat Oleh    : ${employeeName}\n`;
                        textContent += `==================================================\n\n`;
                        
                        textContent += `DAFTAR PERINGKAT PEGAWAI:\n`;
                        textContent += `------------------------------------------------------------------\n`;
                        textContent += `Rank | Nama Pegawai         | NIP        | Jabatan         | Skor\n`;
                        textContent += `------------------------------------------------------------------\n`;
                        
                        list.forEach((r, idx) => {
                            const rank = (idx + 1).toString().padEnd(4);
                            const name = r.name.padEnd(20).substring(0, 20);
                            const nip = r.nip.padEnd(10).substring(0, 10);
                            const pos = r.position.padEnd(15).substring(0, 15);
                            const total = Number(r.total).toFixed(4);
                            textContent += `${rank} | ${name} | ${nip} | ${pos} | ${total}\n`;
                        });
                        textContent += `------------------------------------------------------------------\n`;
                        textContent += `\n* Laporan ini dibuat secara otomatis oleh sistem evaluasi SAW Emplyzzer.\n`;

                        const blob = new Blob([textContent], { type: 'text/plain' });
                        const url = window.URL.createObjectURL(blob);
                        const a = document.createElement('a');
                        a.setAttribute('href', url);
                        a.setAttribute('download', fileName);
                        a.click();
                        window.URL.revokeObjectURL(url);
                    }
                } catch (err) {
                    console.error('Error downloading report rankings:', err);
                }
            }
        }">
        
        <!-- Filter & Generator Form Card -->
        <section class="bg-white p-lg rounded-xl custom-shadow border border-slate-100">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-end">
                
                <!-- Period Filter (GET Form - Alpine Style with Search & Pagination) -->
                <div class="lg:col-span-4 space-y-sm" x-data="{
                    openPeriod: false,
                    search: '',
                    page: 1,
                    perPage: 15,
                    selectedPeriodName: '{{ $periods->firstWhere('id', $selectedPeriodId)->name ?? 'Pilih Periode' }}',
                    selectedPeriodVal: {{ $selectedPeriodId ?? 'null' }},
                    items: [
                        @foreach ($periods as $period)
                            { id: {{ $period->id }}, name: '{{ $period->name }} {{ $period->is_active ? '(Aktif)' : '' }}' },
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
                        this.selectedPeriodName = item.name;
                        this.selectedPeriodVal = item.id;
                        this.openPeriod = false;
                    }
                }">
                    <form method="GET" action="{{ route('report-data') }}" id="periodFilterForm" class="space-y-2">
                        <label class="font-label-sm text-slate-700 uppercase">Pilih Periode Tinjauan</label>
                        <div class="relative" @click.outside="openPeriod = false">
                            <input type="hidden" name="period_id" :value="selectedPeriodVal">
                            <button type="button" @click="openPeriod = !openPeriod; if(openPeriod) { $nextTick(() => $refs.searchInput.focus()); page = 1; search = ''; }"
                                class="w-full bg-slate-50 border border-slate-200 rounded-lg px-4 py-2.5 text-body-md focus:ring-2 focus:ring-indigo-600 h-11 outline-none transition-all flex items-center justify-between font-semibold text-slate-700 text-left">
                                <span x-text="selectedPeriodName"></span>
                                <span class="material-symbols-outlined text-slate-400 transition-transform duration-200" :class="openPeriod ? 'rotate-180' : ''">
                                    expand_more
                                </span>
                            </button>
                            <div x-show="openPeriod" x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="opacity-0 scale-95 -translate-y-1"
                                x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                                x-transition:leave="transition ease-in duration-150"
                                x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                                x-transition:leave-end="opacity-0 scale-95 -translate-y-1"
                                class="absolute z-50 mt-2 w-full overflow-hidden rounded-xl border border-slate-200 bg-white shadow-xl">
                                
                                <!-- Search Input -->
                                <div class="p-2 border-b border-slate-100 bg-slate-50">
                                    <input type="text" x-model="search" x-ref="searchInput" @input="page = 1" placeholder="Cari..." 
                                        class="w-full px-3 py-1.5 text-xs border border-slate-200 rounded-lg focus:outline-none focus:border-indigo-600 focus:ring-1 focus:ring-indigo-600 bg-white font-normal text-slate-700">
                                </div>

                                <!-- Items List -->
                                <div class="max-h-60 overflow-y-auto font-normal text-slate-700">
                                    <template x-for="item in paginatedItems" :key="item.id">
                                        <button type="button" @click="selectItem(item); $nextTick(() => $el.closest('form').submit())"
                                            class="w-full px-4 py-3 text-left text-sm hover:bg-slate-50 transition border-b border-slate-100 last:border-0">
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
                        </div>
                    </form>
                </div>

                <!-- Report Generator (POST Form) -->
                <div class="lg:col-span-8">
                    <form action="{{ route('report-generate') }}" method="POST">
                        @csrf
                        <input type="hidden" name="period_id" value="{{ $selectedPeriodId }}">
                        
                        <div class="flex flex-col md:flex-row gap-md items-end">
                            <div class="flex-1 grid grid-cols-1 md:grid-cols-2 gap-md w-full">
                                <div class="space-y-sm">
                                    <div x-data="{ open: false, selected: 'Ringkasan Kinerja Bulanan' }" class="space-y-2 relative">
                                        <label class="font-label-sm text-slate-700 uppercase">Report Type</label>
                                        <input type="hidden" name="report_type" :value="selected">
                                        <button type="button" @click="open = !open" @click.away="open = false"
                                            class="w-full bg-slate-50 border-slate-200 border border-outline-variant rounded-lg px-3.5 py-2.5 text-body-md font-body-md outline-none transition-all flex items-center justify-between hover:border-indigo-600 focus:border-indigo-600 focus:ring-2 focus:ring-indigo-600 h-11">
                                            <span class="text-left" x-text="selected"></span>
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
                                            <button type="button" @click="selected='Ringkasan Kinerja Bulanan'; open=false"
                                                class="w-full px-4 py-3 text-left text-sm text-slate-700 hover:bg-slate-50 transition">
                                                Ringkasan Kinerja Bulanan
                                            </button>
                                            <button type="button" @click="selected='Audit Eksekutif Tahunan'; open=false"
                                                class="w-full px-4 py-3 text-left text-sm text-slate-700 border-t border-slate-100 hover:bg-slate-50 transition">
                                                Audit Eksekutif Tahunan
                                            </button>
                                            <button type="button" @click="selected='Perbandingan SAW Berkala'; open=false"
                                                class="w-full px-4 py-3 text-left text-sm text-slate-700 border-t border-slate-100 hover:bg-slate-50 transition">
                                                Perbandingan SAW Berkala
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="space-y-sm">
                                    <label class="font-label-sm text-slate-500 uppercase">Periode Tanggal</label>
                                    <div class="relative">
                                        <input id="date_range" name="date_range" type="text" placeholder="Pilih rentang tanggal"
                                            value="{{ $selectedPeriodRange }}"
                                            class="w-full bg-slate-50 border border-slate-200 rounded-lg px-4 pr-11 text-body-md focus:ring-2 focus:ring-indigo-600 h-11 outline-none transition-all">
                                        <button type="button" tabindex="-1"
                                            class="absolute right-3 top-2.5 text-outline hover:text-primary transition-colors pointer-events-none">
                                            <span class="material-symbols-outlined">date_range</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            @can('write-data')
                            <button type="submit"
                                class="bg-indigo-600 text-white px-xl h-11 rounded-lg font-data-tabular hover:bg-indigo-700 transition-colors flex items-center gap-2">
                                <span class="material-symbols-outlined text-sm">summarize</span>
                                Generate Report
                            </button>
                            @else
                            <button type="button" disabled
                                class="bg-slate-200 text-slate-400 px-xl h-11 rounded-lg font-data-tabular flex items-center gap-2 cursor-not-allowed">
                                <span class="material-symbols-outlined text-sm">summarize</span>
                                Generate Report
                            </button>
                            @endcan
                        </div>
                    </form>
                </div>
            </div>
        </section>

        <!-- Summary Cards Bento Grid -->
        <section class="grid grid-cols-1 md:grid-cols-3 gap-lg">
            <!-- Total Reports -->
            <div class="bg-white p-lg rounded-xl custom-shadow border border-slate-100 flex items-center justify-between">
                <div>
                    <p class="font-label-sm text-slate-500 uppercase mb-1">Total Laporan Dibuat</p>
                    <h3 class="font-display-xl text-slate-900 font-bold">{{ number_format($totalReports) }}</h3>
                    <p class="text-xs text-success flex items-center gap-1 mt-2">
                        <span class="material-symbols-outlined text-sm">trending_up</span>
                        <span class="text-green-600 font-semibold">+100% dari awal</span>
                    </p>
                </div>
                <div class="w-14 h-14 bg-slate-50 rounded-full flex items-center justify-center text-primary-container">
                    <span class="material-symbols-outlined text-3xl">summarize</span>
                </div>
            </div>
            <!-- Last Generated -->
            <div class="bg-white p-lg rounded-xl custom-shadow border border-slate-100 flex items-center justify-between">
                <div>
                    <p class="font-label-sm text-slate-500 uppercase mb-1">Laporan Terakhir Dibuat</p>
                    <h3 class="font-bold text-slate-950 text-sm truncate max-w-[200px]" title="{{ $lastReport ? $lastReport->file_name : '-' }}">
                        {{ $lastReport ? $lastReport->file_name : 'Belum ada' }}
                    </h3>
                    <p class="text-xs text-slate-500 mt-2">{{ $lastReport ? $lastReport->created_at->diffForHumans() : '-' }}</p>
                </div>
                <div class="w-14 h-14 bg-slate-50 rounded-full flex items-center justify-center text-primary-container">
                    <span class="material-symbols-outlined text-3xl">schedule</span>
                </div>
            </div>
            <!-- High Performing Dept -->
            <div class="bg-white p-lg rounded-xl custom-shadow border border-slate-100 flex items-center justify-between">
                <div>
                    <p class="font-label-sm text-slate-500 uppercase mb-1">Divisi Kinerja Terbaik ({{ $selectedPeriod->name ?? '-' }})</p>
                    <h3 class="font-bold text-slate-900 text-sm truncate max-w-[200px]" title="{{ $bestDeptName }}">
                        {{ $bestDeptName }}
                    </h3>
                    <p class="text-xs text-slate-500 mt-2">{{ $bestDeptScore > 0 ? 'Score: ' . number_format($bestDeptScore, 3) . ' (SAW)' : '-' }}</p>
                </div>
                <div class="w-14 h-14 bg-green-50 rounded-full flex items-center justify-center text-green-600">
                    <span class="material-symbols-outlined text-3xl" style="font-variation-settings: 'FILL' 1;">stars</span>
                </div>
            </div>
        </section>

        <!-- Hasil Perankingan Pegawai (SAW) -->
        <section class="bg-white rounded-xl custom-shadow border border-slate-100 overflow-hidden">
            <div class="p-lg border-b border-slate-100 bg-slate-50/50 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                <div>
                    <h3 class="font-headline-md text-slate-900">Hasil Perankingan Kinerja Pegawai</h3>
                    <p class="text-xs text-slate-500 mt-1">Dihitung otomatis menggunakan metode SAW untuk periode <strong>{{ $selectedPeriod->name ?? '-' }}</strong></p>
                </div>
                <div class="flex items-center gap-2">
                    <span class="px-3 py-1 bg-indigo-50 text-indigo-700 text-xs font-bold rounded-full">
                        {{ count($preferences) }} Pegawai Dinilai
                    </span>
                </div>
            </div>
            
            @if (empty($preferences))
                <div class="p-xl text-center space-y-4">
                    <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mx-auto text-slate-400">
                        <span class="material-symbols-outlined text-3xl">leaderboard</span>
                    </div>
                    <div class="space-y-1">
                        <p class="font-semibold text-slate-800 text-sm">Belum Ada Hasil Perankingan</p>
                        <p class="text-xs text-slate-500 max-w-md mx-auto">
                            Hasil perankingan belum terbentuk karena belum ada data penilaian yang dimasukkan untuk periode ini.
                        </p>
                    </div>
                    <div>
                        <a href="{{ route('sawprocess-data', ['period_id' => $selectedPeriodId]) }}" class="inline-flex items-center gap-1.5 px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-bold rounded-lg transition shadow-sm">
                            <span class="material-symbols-outlined text-xs">calculate</span>
                            Mulai Penilaian
                        </a>
                    </div>
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50/50 text-slate-700 text-xs font-bold uppercase tracking-wider border-b border-slate-100">
                                <th class="px-lg py-4 w-20 text-center">Rank</th>
                                <th class="px-lg py-4">Nama Pegawai</th>
                                <th class="px-lg py-4">Jabatan</th>
                                <th class="px-lg py-4">Departemen</th>
                                <th class="px-lg py-4 text-center">Skor Akhir (V)</th>
                                <th class="px-lg py-4">Kategori Kinerja</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-slate-600">
                            @foreach ($preferences as $index => $pref)
                                <tr class="hover:bg-slate-50/50 transition-colors">
                                    <td class="px-lg py-4 text-center font-extrabold text-slate-950 text-sm">
                                        @if ($index == 0)
                                            <span class="w-6 h-6 rounded-full bg-yellow-400 text-yellow-950 flex items-center justify-center mx-auto text-xs">1</span>
                                        @elseif ($index == 1)
                                            <span class="w-6 h-6 rounded-full bg-slate-300 text-slate-800 flex items-center justify-center mx-auto text-xs">2</span>
                                        @elseif ($index == 2)
                                            <span class="w-6 h-6 rounded-full bg-amber-600 text-amber-55 flex items-center justify-center mx-auto text-xs">3</span>
                                        @else
                                            {{ $index + 1 }}
                                        @endif
                                    </td>
                                    <td class="px-lg py-4">
                                        <div class="text-sm font-semibold text-slate-900">{{ $pref['name'] }}</div>
                                        <div class="text-[10px] text-slate-400">NIP: {{ $pref['nip'] }}</div>
                                    </td>
                                    <td class="px-lg py-4 text-sm text-slate-500">
                                        {{ $pref['position'] }}
                                    </td>
                                    <td class="px-lg py-4 text-sm text-slate-500">
                                        {{ $pref['department'] }}
                                    </td>
                                    <td class="px-lg py-4 text-center font-mono font-bold text-indigo-600 text-base">
                                        {{ number_format($pref['total'], 4) }}
                                    </td>
                                    <td class="px-lg py-4">
                                        @if ($pref['total'] >= 0.85)
                                            <span class="px-2.5 py-1 bg-green-50 text-green-700 rounded-full text-xs font-bold uppercase tracking-wider">Sangat Baik</span>
                                        @elseif ($pref['total'] >= 0.70)
                                            <span class="px-2.5 py-1 bg-blue-50 text-blue-700 rounded-full text-xs font-bold uppercase tracking-wider">Baik</span>
                                        @elseif ($pref['total'] >= 0.55)
                                            <span class="px-2.5 py-1 bg-yellow-50 text-yellow-700 rounded-full text-xs font-bold uppercase tracking-wider">Cukup</span>
                                        @else
                                            <span class="px-2.5 py-1 bg-red-50 text-red-700 rounded-full text-xs font-bold uppercase tracking-wider">Kurang</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </section>

        <!-- Visual Analytics & History Layout -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-lg">
            <!-- Bar Chart Comparison (Visual Analytics) -->
            <section class="lg:col-span-4 bg-white p-lg rounded-xl custom-shadow border border-slate-100">
                <div class="flex justify-between items-center mb-xl">
                    <h4 class="font-headline-md text-slate-900">Analisis Visual</h4>
                    <span class="material-symbols-outlined text-slate-400">more_horiz</span>
                </div>
                <p class="text-body-md text-slate-500 mb-lg leading-relaxed">Perbandingan indeks kinerja antar divisi berdasarkan kriteria SAW.</p>
                <div class="space-y-6 mt-4">
                    @forelse ($deptAverages as $deptName => $score)
                        <div class="space-y-2">
                            <div class="flex justify-between text-xs font-semibold uppercase tracking-wider text-slate-600">
                                <span>{{ $deptName }}</span>
                                <span>{{ round($score * 100) }}%</span>
                            </div>
                            <div class="w-full bg-slate-100 h-2.5 rounded-full overflow-hidden">
                                <div class="bg-indigo-900 h-full rounded-full" style="width: {{ round($score * 100) }}%"></div>
                            </div>
                        </div>
                    @empty
                        <p class="text-xs text-slate-400 italic">Belum ada analisis data</p>
                    @endforelse
                </div>
                <div class="mt-xl pt-lg border-t border-slate-100">
                    <a href="{{ route('employee-rank') }}" class="text-indigo-600 font-semibold text-sm hover:underline flex items-center gap-1">
                        Lihat Analisis Detail <span class="material-symbols-outlined text-sm">arrow_forward</span>
                    </a>
                </div>
            </section>
            <!-- Report History Table -->
            <section class="lg:col-span-8 bg-white rounded-xl custom-shadow border border-slate-100 overflow-hidden">
                <div class="p-lg flex justify-between items-center border-b border-slate-100">
                    <div>
                        <h4 class="font-headline-md text-slate-900">Riwayat Laporan</h4>
                        <p class="text-xs text-slate-500 mt-1">Log audit seluruh laporan sistem</p>
                    </div>
                    <div class="flex gap-2">
                        <button class="p-2 border border-slate-200 rounded-lg hover:bg-slate-50"><span
                                class="material-symbols-outlined">search</span></button>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50/50">
                                <th class="px-lg py-4 font-label-sm text-slate-500 uppercase tracking-wider">Nama Laporan
                                </th>
                                <th class="px-lg py-4 font-label-sm text-slate-500 uppercase tracking-wider">Tanggal</th>
                                <th class="px-lg py-4 font-label-sm text-slate-500 uppercase tracking-wider">Dibuat Oleh
                                </th>
                                <th class="px-lg py-4 font-label-sm text-slate-500 uppercase tracking-wider text-right">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @forelse ($reports as $report)
                                <tr class="hover:bg-slate-50/80 transition-colors">
                                    <td class="px-lg py-4">
                                        <div class="flex items-center gap-3">
                                            <span class="material-symbols-outlined text-slate-400">
                                                {{ $report->file_type === 'XLSX' ? 'table_chart' : 'picture_as_pdf' }}
                                            </span>
                                            <span class="font-data-tabular text-slate-900 truncate max-w-[200px]" title="{{ $report->file_name }}">
                                                {{ $report->file_name }}
                                            </span>
                                        </div>
                                    </td>
                                    <td class="px-lg py-4 text-body-md text-slate-600">
                                        {{ $report->created_at->format('M d, Y') }}
                                    </td>
                                    <td class="px-lg py-4">
                                        <span class="px-3 py-1 bg-slate-100 text-slate-700 rounded-full text-xs font-semibold">
                                            {{ $report->employee->name ?? 'System' }}
                                        </span>
                                    </td>
                                    <td class="px-lg py-4">
                                        <div class="flex justify-end gap-3">
                                            <button type="button" @click="
                                                reportName = '{{ $report->file_name }}';
                                                reportDate = '{{ $report->created_at->format('M d, Y H:i') }}';
                                                reportType = '{{ $report->file_type }}';
                                                reportBy = '{{ $report->employee->name ?? 'System' }}';
                                                reportPeriodId = {{ $report->period_id }};
                                                fetchRankings({{ $report->period_id }});
                                                previewModal = true;
                                            " class="text-slate-400 hover:text-indigo-600 transition-colors" title="View">
                                                <span class="material-symbols-outlined text-xl">visibility</span>
                                            </button>
                                            <a href="{{ route('report-export-pdf') }}?period_id={{ $report->period_id }}" class="text-slate-400 hover:text-indigo-600 transition-colors flex items-center justify-center" title="Download">
                                                <span class="material-symbols-outlined text-xl">download</span>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-lg py-8 text-center text-sm text-slate-400 italic">
                                        Belum ada riwayat laporan yang dibuat.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="p-lg bg-slate-50 border-t border-slate-100 flex items-center justify-between">
                    <span class="text-xs text-slate-500 font-medium">
                        Showing {{ $reports->firstItem() ?? 0 }} to {{ $reports->lastItem() ?? 0 }} of {{ $reports->total() }} reports
                    </span>
                    <div class="flex items-center">
                        {{ $reports->links() }}
                    </div>
                </div>
            </section>
        </div>

        <!-- Preview Modal Dialog -->
        <div x-show="previewModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-black/40 backdrop-blur-sm">
            <div x-show="previewModal" x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-90"
                class="w-full max-w-2xl bg-white rounded-2xl shadow-2xl overflow-hidden border border-slate-100 flex flex-col max-h-[85vh]">
                
                <!-- Modal Header -->
                <div class="px-6 py-4 bg-indigo-900 text-white flex items-center justify-between">
                    <div>
                        <h3 class="font-bold text-base">Preview Dokumen Laporan</h3>
                        <p class="text-[11px] text-indigo-200 mt-0.5 truncate max-w-lg" x-text="reportName"></p>
                    </div>
                    <button @click="previewModal = false" class="w-8 h-8 rounded-lg hover:bg-white/10 flex items-center justify-center text-white transition">
                        <span class="material-symbols-outlined text-lg">close</span>
                    </button>
                </div>

                <!-- Modal Body: Document Preview -->
                <div class="p-8 overflow-y-auto bg-slate-50 flex-1">
                    <div class="bg-white border border-slate-200 rounded-xl p-8 shadow-sm space-y-6 min-h-[400px] flex flex-col justify-between">
                        <div class="space-y-6">
                            <!-- Doc Header -->
                            <div class="flex justify-between items-start border-b border-slate-200 pb-4">
                                <div>
                                    <h4 class="font-extrabold text-slate-800 text-base">EMPLYZER REPORT SYSTEM</h4>
                                    <p class="text-xs text-slate-500">Sistem Pendukung Keputusan Metode SAW</p>
                                </div>
                                <span class="px-3 py-1 bg-indigo-50 text-indigo-700 text-[10px] font-bold rounded" x-text="reportType"></span>
                            </div>

                            <!-- Doc Metadata -->
                            <div class="grid grid-cols-2 gap-4 text-xs bg-slate-50 p-4 rounded-xl">
                                <div>
                                    <p class="text-slate-400">Nama Laporan</p>
                                    <p class="font-bold text-slate-800" x-text="reportName"></p>
                                </div>
                                <div>
                                    <p class="text-slate-400">Tanggal Pembuatan</p>
                                    <p class="font-bold text-slate-800" x-text="reportDate"></p>
                                </div>
                                <div>
                                    <p class="text-slate-400">Karyawan / Detail</p>
                                    <p class="font-bold text-slate-800" x-text="reportBy"></p>
                                </div>
                                <div>
                                    <p class="text-slate-400">Status Validasi</p>
                                    <p class="font-bold text-green-600 flex items-center gap-1">
                                        <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span> Verified by System
                                    </p>
                                </div>
                            </div>

                             <!-- Doc Content Dynamic -->
                             <div class="space-y-4">
                                 <h5 class="text-xs font-bold uppercase tracking-wider text-slate-600">Daftar Peringkat Karyawan</h5>
                                 
                                 <div x-show="loading" class="flex items-center justify-center py-8">
                                     <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-indigo-600"></div>
                                     <span class="text-xs text-slate-500 ml-2">Loading data peringkat...</span>
                                 </div>
                                 
                                 <div x-show="!loading && rankings.length > 0" class="border border-slate-200 rounded-xl overflow-hidden bg-white max-h-[300px] overflow-y-auto">
                                     <table class="w-full text-left text-[11px] border-collapse">
                                         <thead>
                                             <tr class="bg-slate-50 text-slate-500 font-bold border-b border-slate-150 sticky top-0">
                                                 <th class="px-3 py-2 text-center w-10">Rank</th>
                                                 <th class="px-3 py-2">Nama Karyawan</th>
                                                 <th class="px-3 py-2">Jabatan</th>
                                                 <th class="px-3 py-2 text-center">Skor Akhir (V)</th>
                                             </tr>
                                         </thead>
                                         <tbody class="divide-y divide-slate-100 text-slate-600">
                                             <template x-for="(r, idx) in rankings" :key="r.employee_id">
                                                 <tr class="hover:bg-slate-50">
                                                     <td class="px-3 py-2 text-center font-bold text-slate-900" x-text="idx + 1"></td>
                                                     <td class="px-3 py-2">
                                                         <div class="font-semibold text-slate-900" x-text="r.name"></div>
                                                         <div class="text-[9px] text-slate-400" x-text="'NIP: ' + r.nip"></div>
                                                     </td>
                                                     <td class="px-3 py-2 text-slate-500" x-text="r.position"></td>
                                                     <td class="px-3 py-2 text-center font-mono font-bold text-indigo-600" x-text="Number(r.total).toFixed(4)"></td>
                                                 </tr>
                                             </template>
                                         </tbody>
                                     </table>
                                 </div>
                                 
                                 <div x-show="!loading && rankings.length === 0" class="text-center py-8 text-xs text-slate-400 italic">
                                     Belum ada data evaluasi untuk periode laporan ini.
                                 </div>
                                 
                                 <p class="text-[10px] text-slate-500 leading-relaxed">
                                     Dokumen ini memuat data rekapitulasi penilaian kinerja karyawan yang dihitung secara matematis menggunakan model Simple Additive Weighting (SAW) berdasarkan matriks normalisasi kriteria benefit dan cost.
                                 </p>
                                 <div class="border border-slate-100 rounded-lg p-3 bg-slate-50 text-[10px] text-slate-400 leading-relaxed">
                                     *Catatan: Dokumen ini diterbitkan secara elektronik oleh Emplyzer SAW Method System dan dilindungi secara logistik pada database server.
                                 </div>
                             </div>
                         </div>
 
                         <!-- Signatures Mockup -->
                         <div class="flex justify-end pt-4 border-t border-slate-100 text-xs">
                             <div class="text-center space-y-8">
                                 <p class="text-slate-400">Dibuat Oleh,</p>
                                 <div class="font-bold text-slate-800 border-t border-slate-300 pt-1" x-text="reportBy"></div>
                             </div>
                         </div>
                     </div>
                 </div>
 
                 <!-- Modal Footer -->
                 <div class="px-6 py-4 bg-slate-100 border-t border-slate-200 flex justify-end gap-3">
                     <button @click="previewModal = false" class="px-5 py-2 rounded-xl text-slate-600 border border-slate-300 hover:bg-white font-semibold transition text-sm">
                         Tutup
                     </button>
                     <a :href="'/report-export-pdf?period_id=' + reportPeriodId" @click="previewModal = false" class="px-6 py-2 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white font-semibold shadow transition text-sm flex items-center gap-2">
                        <span class="material-symbols-outlined text-sm">download</span>
                        Download PDF
                    </a>
                 </div></div>

            </div>
        </div>
    </section>
@endsection
@push('scripts')
    {{-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            flatpickr("#date_range", {
                mode: "range",
                dateFormat: "Y-m-d",
                altInput: true,
                altFormat: "d M Y",
                conjunction: " to ",
                locale: "id"
                appendTo: document.body,
            });
        });
    </script> --}}
    <script>
        function downloadReportFile(fileName, content) {
            const blob = new Blob([content], { type: 'text/plain' });
            const url = window.URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.setAttribute('href', url);
            a.setAttribute('download', fileName);
            a.click();
            window.URL.revokeObjectURL(url);
        }

        document.addEventListener('DOMContentLoaded', function() {

            flatpickr("#date_range", {
                mode: "range",
                dateFormat: "Y-m-d",
                altInput: true,
                altFormat: "d M Y",
                conjunction: " to ",
                locale: "id",
                appendTo: document.body,
            });

        });
    </script>
@endpush
