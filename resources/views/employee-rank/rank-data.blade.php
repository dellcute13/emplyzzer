@extends('layouts.app')

@section('content')
    <section class="p-4 sm:p-6 md:p-8 space-y-6 md:space-y-8 flex-1">
        
        <!-- Header & Period Selector -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-end gap-4 mb-8">
            <div>
                <h2 class="text-3xl font-bold tracking-tight text-slate-900">Hasil Perankingan Pegawai</h2>
                <p class="text-slate-500 mt-1">Berdasarkan perhitungan metode Simple Additive Weighting (SAW).</p>
            </div>
            
            <div class="flex items-center gap-3" x-data="{
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
            }">
                <form method="GET" action="{{ route('employee-rank') }}" class="flex items-center gap-3 relative" @click.outside="open = false">
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
                        class="absolute right-0 mt-2 w-full min-w-[200px] overflow-hidden rounded-xl border border-slate-200 bg-white shadow-xl z-50">
                        
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
                </form>
            </div>
        </div>

        @if (empty($preferences))
            <!-- Empty State -->
            <div class="bg-white border border-slate-200 rounded-2xl p-12 text-center shadow-sm max-w-2xl mx-auto space-y-6">
                <div class="w-20 h-20 bg-slate-100 rounded-full flex items-center justify-center mx-auto text-slate-400">
                    <span class="material-symbols-outlined text-4xl">leaderboard</span>
                </div>
                <div class="space-y-2">
                    <h3 class="text-xl font-bold text-slate-900">Belum Ada Hasil Perankingan</h3>
                    <p class="text-slate-500 text-sm max-w-md mx-auto">
                        Hasil perankingan belum terbentuk karena belum ada data penilaian yang masuk untuk periode ini. Silakan kunjungi menu Proses SAW untuk melakukan simulasi nilai.
                    </p>
                </div>
                <div>
                    <a href="{{ route('sawprocess-data', ['period_id' => $selectedPeriodId]) }}" class="inline-flex items-center gap-2 px-6 py-3 bg-indigo-600 text-white font-bold rounded-xl hover:bg-indigo-700 transition shadow-lg shadow-indigo-600/20">
                        <span class="material-symbols-outlined text-sm">calculate</span>
                        Buka Menu Proses SAW
                    </a>
                </div>
            </div>
        @else
            <!-- Podium Top 3 -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8 items-end">
                
                <!-- Rank 2 (Silver) -->
                @if (isset($preferences[1]))
                    @php $p2 = $preferences[1]; @endphp
                    <div class="bg-white rounded-2xl p-6 border border-slate-100 shadow flex flex-col items-center relative overflow-hidden group order-2 md:order-1 h-[280px] justify-center">
                        <div class="absolute top-0 right-0 p-4 opacity-10">
                            <span class="material-symbols-outlined text-6xl">military_tech</span>
                        </div>
                        <div class="w-16 h-16 rounded-full border-4 border-slate-200 mb-3 overflow-hidden bg-slate-100 flex items-center justify-center text-slate-400">
                            <span class="material-symbols-outlined text-3xl">person</span>
                        </div>
                        <div class="bg-slate-100 text-slate-700 text-[10px] font-bold px-3 py-1 rounded-full mb-3 uppercase tracking-wider">
                            RANK 2 - SILVER
                        </div>
                        <h3 class="font-bold text-lg text-slate-900 text-center truncate max-w-full">{{ $p2['employee']->name }}</h3>
                        <p class="text-slate-500 text-xs mt-0.5 truncate max-w-full">{{ $p2['employee']->position->name ?? '-' }}</p>
                        <div class="mt-4 text-slate-800 font-extrabold text-2xl font-mono">{{ number_format($p2['total'], 4) }}</div>
                    </div>
                @endif

                <!-- Rank 1 (Gold) -->
                @if (isset($preferences[0]))
                    @php $p1 = $preferences[0]; @endphp
                    <div class="bg-white rounded-2xl p-8 border-2 border-yellow-400 shadow-xl flex flex-col items-center relative overflow-hidden group order-1 md:order-2 h-[320px] justify-center transform md:-translate-y-4">
                        <div class="absolute top-0 left-0 bg-yellow-400 text-yellow-950 text-[10px] font-extrabold px-4 py-1.5 rounded-br-lg tracking-widest">
                            BEST PERFORMER
                        </div>
                        <div class="absolute top-4 right-4 text-yellow-500">
                            <span class="material-symbols-outlined text-4xl">workspace_premium</span>
                        </div>
                        <div class="w-20 h-20 rounded-full border-4 border-yellow-400 mb-3 overflow-hidden bg-slate-100 flex items-center justify-center text-slate-400">
                            <span class="material-symbols-outlined text-4xl">person</span>
                        </div>
                        <div class="bg-yellow-100 text-yellow-800 text-[10px] font-bold px-3 py-1 rounded-full mb-3 tracking-widest uppercase">
                            RANK 1 - GOLD
                        </div>
                        <h3 class="font-extrabold text-xl text-slate-900 text-center truncate max-w-full">{{ $p1['employee']->name }}</h3>
                        <p class="text-slate-500 text-sm mt-0.5 truncate max-w-full">{{ $p1['employee']->position->name ?? '-' }}</p>
                        <div class="mt-4 text-yellow-600 font-black text-3xl font-mono">{{ number_format($p1['total'], 4) }}</div>
                    </div>
                @endif

                <!-- Rank 3 (Bronze) -->
                @if (isset($preferences[2]))
                    @php $p3 = $preferences[2]; @endphp
                    <div class="bg-white rounded-2xl p-6 border border-slate-100 shadow flex flex-col items-center relative overflow-hidden group order-3 h-[260px] justify-center">
                        <div class="absolute top-0 right-0 p-4 opacity-10">
                            <span class="material-symbols-outlined text-6xl">award_star</span>
                        </div>
                        <div class="w-16 h-16 rounded-full border-4 border-amber-200 mb-3 overflow-hidden bg-slate-100 flex items-center justify-center text-slate-400">
                            <span class="material-symbols-outlined text-3xl">person</span>
                        </div>
                        <div class="bg-amber-50 text-amber-800 text-[10px] font-bold px-3 py-1 rounded-full mb-3 uppercase tracking-wider">
                            RANK 3 - BRONZE
                        </div>
                        <h3 class="font-bold text-lg text-slate-900 text-center truncate max-w-full">{{ $p3['employee']->name }}</h3>
                        <p class="text-slate-500 text-xs mt-0.5 truncate max-w-full">{{ $p3['employee']->position->name ?? '-' }}</p>
                        <div class="mt-4 text-slate-800 font-extrabold text-2xl font-mono">{{ number_format($p3['total'], 4) }}</div>
                    </div>
                @endif

            </div>

            <!-- Complete Ranking List -->
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
                <div class="p-6 border-b border-slate-100 bg-slate-50/50">
                    <h3 class="text-lg font-bold text-slate-900">Daftar Peringkat Keseluruhan</h3>
                    <p class="text-sm text-slate-500 mt-1">Daftar semua pegawai yang dievaluasi beserta nilai akhir metode SAW.</p>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50 text-slate-700 text-xs font-bold uppercase tracking-wider border-b border-slate-100">
                                <th class="px-8 py-4 w-20 text-center">Rank</th>
                                <th class="px-6 py-4">Nama Pegawai</th>
                                <th class="px-6 py-4">Jabatan</th>
                                <th class="px-6 py-4">Departemen</th>
                                <th class="px-6 py-4 text-center">Skor Akhir (V)</th>
                                <th class="px-6 py-4">Kategori Kinerja</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-slate-600">
                            @foreach ($preferences as $index => $pref)
                                <tr class="hover:bg-slate-50/50 transition-colors">
                                    <td class="px-8 py-4 text-center font-extrabold text-slate-950 text-sm">
                                        @if ($index == 0)
                                            <span class="w-6 h-6 rounded-full bg-yellow-400 text-yellow-955 flex items-center justify-center mx-auto text-xs">1</span>
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
                                        {{ $pref['employee']->position->name ?? '-' }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-slate-500">
                                        {{ $pref['employee']->department->name ?? '-' }}
                                    </td>
                                    <td class="px-6 py-4 text-center font-mono font-bold text-slate-900 text-base">
                                        {{ number_format($pref['total'], 4) }}
                                    </td>
                                    <td class="px-6 py-4">
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
            </div>
        @endif

    </section>
@endsection
