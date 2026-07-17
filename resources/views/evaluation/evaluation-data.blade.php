@extends('layouts.app')

@section('content')
    <section class="p-8 space-y-8 flex-1">
        <!-- Header Section -->
        <div class="flex justify-between items-end">
            <div>
                <h2 class="font-headline-lg text-headline-lg text-on-surface">Input Penilaian</h2>
                <p class="font-body-md text-body-md text-on-surface-variant">Kelola data penilaian pegawai per periode untuk proses SAW.</p>
            </div>
            <a class="flex items-center bg-primary text-on-primary px-6 py-3 rounded-lg font-medium hover:opacity-90 transition-all active:scale-95"
                href="{{ route('evaluation.evaluation-add') }}">
                <span class="material-symbols-outlined mr-2" data-icon="add">add</span>
                Tambah Penilaian
            </a>
        </div>

        @if(session('success'))
            <div class="flex items-center gap-3 bg-green-50 text-green-700 border border-green-200 px-5 py-4 rounded-xl">
                <span class="material-symbols-outlined text-[20px]">check_circle</span>
                <span class="font-medium">{{ session('success') }}</span>
            </div>
        @endif
        @if(session('error'))
            <div class="flex items-center gap-3 bg-red-50 text-red-700 border border-red-200 px-5 py-4 rounded-xl">
                <span class="material-symbols-outlined text-[20px]">error</span>
                <span class="font-medium">{{ session('error') }}</span>
            </div>
        @endif

        <!-- Filter Period (Alpine.js Style with Search & Pagination) -->
        <form method="GET" action="{{ route('evaluation.evaluation-data') }}" id="periodFilterForm" class="flex items-end gap-4" 
            x-data="{
                open: false,
                search: '',
                page: 1,
                perPage: 15,
                selected: '{{ $selectedPeriod ? ($periods->firstWhere('id', $selectedPeriod)->name ?? 'Semua Periode') : 'Semua Periode' }}',
                selectedVal: '{{ $selectedPeriod ?? '' }}',
                items: [
                    { id: '', name: 'Semua Periode' },
                    @foreach($periods as $period)
                        { id: '{{ $period->id }}', name: '{{ $period->name }} — Semester {{ $period->semester }}/{{ $period->year }}' },
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
                    this.selectedVal = item.id;
                    this.open = false;
                }
            }">
            <div class="space-y-1 relative z-50" @click.outside="open = false">
                <label class="font-label-sm text-slate-700 uppercase">Filter Periode</label>
                <input type="hidden" name="period_id" :value="selectedVal">
                <button type="button" @click="open = !open; if(open) { $nextTick(() => $refs.searchInput.focus()); page = 1; search = ''; }"
                    class="bg-white border border-slate-200 rounded-lg px-4 py-2.5 text-body-md font-semibold text-slate-700 shadow-sm focus:ring-2 focus:ring-indigo-600 h-11 outline-none min-w-[255px] flex items-center justify-between hover:border-indigo-600 text-left">
                    <span x-text="selected"></span>
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
                    class="absolute left-0 mt-2 w-full min-w-[255px] overflow-hidden rounded-xl border border-slate-200 bg-white shadow-xl z-50">
                    
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

        <!-- Table -->
        <div class="bg-white rounded-xl border border-slate-200 custom-shadow overflow-hidden">
            <div class="p-6 border-b border-slate-100 flex justify-between items-center">
                <h3 class="font-headline-md text-headline-md text-on-surface">Daftar Pegawai Ternilai</h3>
                <span class="text-xs font-medium px-2 py-1 bg-primary-fixed text-on-primary-fixed rounded">
                    {{ $criteriaCount }} Kriteria
                </span>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-surface-container-lowest border-b border-slate-100">
                            <th class="px-6 py-4 font-headline-md text-[13px] uppercase tracking-wider text-slate-600">No</th>
                            <th class="px-6 py-4 font-headline-md text-[13px] uppercase tracking-wider text-slate-600">Pegawai</th>
                            <th class="px-6 py-4 font-headline-md text-[13px] uppercase tracking-wider text-slate-600">Divisi/Unit</th>
                            <th class="px-6 py-4 font-headline-md text-[13px] uppercase tracking-wider text-slate-600">Kelengkapan</th>
                            <th class="px-6 py-4 font-headline-md text-[13px] uppercase tracking-wider text-slate-600 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($employees as $index => $employee)
                            @php
                                $evalCount = $selectedPeriod
                                    ? $employee->evaluations->where('period_id', $selectedPeriod)->count()
                                    : $employee->evaluations->count();
                                $pct = $criteriaCount > 0 ? min(100, round($evalCount / $criteriaCount * 100)) : 0;
                            @endphp
                            <tr class="hover:bg-slate-50 transition-colors">
                                <td class="px-6 py-4 text-slate-500 text-sm">{{ $employees->firstItem() + $index }}</td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-9 h-9 rounded-full bg-primary-container flex items-center justify-center text-white font-bold text-sm">
                                            {{ strtoupper(substr($employee->name, 0, 1)) }}
                                        </div>
                                        <div>
                                            <div class="font-medium text-slate-900">{{ $employee->name }}</div>
                                            <div class="text-xs text-slate-400">{{ $employee->nip }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-slate-600 text-sm">
                                    {{ $employee->department?->name ?? '-' }}
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2">
                                        <div class="w-24 bg-slate-100 h-1.5 rounded-full overflow-hidden">
                                            <div class="bg-secondary h-full" style="width: {{ $pct }}%"></div>
                                        </div>
                                        <span class="text-xs text-slate-600">{{ $evalCount }}/{{ $criteriaCount }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex justify-end gap-2">
                                        @if($selectedPeriod)
                                            <a href="{{ route('evaluation.evaluation-edit', [$employee->id, $selectedPeriod]) }}"
                                                class="p-2 hover:bg-slate-100 rounded-lg text-secondary transition-colors">
                                                <span class="material-symbols-outlined text-[20px]" data-icon="edit">edit</span>
                                            </a>
                                            <form action="{{ route('evaluation.evaluation-delete', [$employee->id, $selectedPeriod]) }}"
                                                method="POST" class="inline"
                                                onsubmit="return confirm('Hapus semua nilai {{ $employee->name }} pada periode ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button class="p-2 hover:bg-error/10 rounded-lg text-error transition-colors">
                                                    <span class="material-symbols-outlined text-[20px]" data-icon="delete">delete</span>
                                                </button>
                                            </form>
                                        @else
                                            <a href="{{ route('evaluation.evaluation-add', ['employee_id' => $employee->id]) }}"
                                                class="p-2 hover:bg-slate-100 rounded-lg text-secondary transition-colors">
                                                <span class="material-symbols-outlined text-[20px]" data-icon="edit">edit</span>
                                            </a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center text-slate-400">
                                    @if($selectedPeriod)
                                        Belum ada penilaian pada periode ini.
                                        <a href="{{ route('evaluation.evaluation-add', ['period_id' => $selectedPeriod]) }}" class="text-primary font-medium ml-1">Tambah sekarang</a>
                                    @else
                                        Belum ada data penilaian.
                                    @endif
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="px-6 py-4 border-t border-slate-100">
                {{ $employees->links() }}
            </div>
        </div>
    </section>
@endsection