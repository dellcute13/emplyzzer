@extends('layouts.app')

@section('content')
    <section class="p-4 sm:p-6 md:p-8 space-y-6 md:space-y-8 flex-1"
        x-data="{
            detailModalOpen: false,
            selectedEmployee: null,
            activePeriod: '',
            showDetail(employee) {
                this.selectedEmployee = employee;
                this.detailModalOpen = true;
                
                // Set default active period to first available period
                let periods = Object.keys(this.evaluationsGroupedByPeriod);
                this.activePeriod = periods.length > 0 ? periods[0] : '';
            },
            get evaluationsGroupedByPeriod() {
                if (!this.selectedEmployee || !this.selectedEmployee.evaluations) return {};
                let grouped = {};
                this.selectedEmployee.evaluations.forEach(ev => {
                    if (!grouped[ev.period_name]) {
                        grouped[ev.period_name] = [];
                    }
                    grouped[ev.period_name].push(ev);
                });
                return grouped;
            },
            averageScoreForActivePeriod() {
                if (!this.activePeriod) return '0.0';
                let evs = this.evaluationsGroupedByPeriod[this.activePeriod];
                if (!evs || evs.length === 0) return '0.0';
                let sum = evs.reduce((acc, ev) => acc + ev.score, 0);
                return (sum / evs.length).toFixed(1);
            }
        }">
        <!-- Header Section -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h2 class="font-headline-lg text-headline-lg text-on-surface">Data Pegawai</h2>
                <p class="font-body-md text-body-md text-on-surface-variant">Kelola informasi dasar dan jabatan seluruh
                    karyawan dalam sistem.</p>
            </div>
            @can('write-data')
            <a class="flex items-center bg-primary text-on-primary px-6 py-3 rounded-lg font-medium hover:opacity-90 transition-all active:scale-95 whitespace-nowrap"
                href="{{ route('employee.employee-add') }}">
                <span class="material-symbols-outlined mr-2" data-icon="add">add</span>
                Tambah Pegawai
            </a>
            @endcan
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
                        @forelse ($employees as $employee)
                            <tr class="hover:bg-slate-50/50 transition-colors group">
                                <td class="px-6 py-4 font-data-tabular">
                                    {{ $loop->iteration }}
                                </td>
                                <td class="px-6 py-4">
                                    @if ($employee->photo)
                                        <img src="{{ $employee->photo_url }}" alt="{{ $employee->name }}"
                                            class="w-20 h-20 rounded-full object-cover">
                                    @else
                                        <div
                                            class="w-20 h-20 rounded-full bg-slate-200 flex items-center justify-center text-slate-600 font-bold text-xl">
                                            {{ strtoupper(substr($employee->name, 0, 2)) }}
                                        </div>
                                    @endif
                                </td>
                                <td class="px-6 py-4 font-data-tabular text-slate-600">
                                    {{ $employee->nip }}
                                </td>
                                <td class="px-6 py-4">
                                    <div class="font-semibold text-slate-900">
                                        {{ $employee->name }}
                                    </div>
                                </td>
                                <td class="px-4 py-5">
                                    @if ($employee->gender == 'L')
                                        <span class="px-3 py-1 rounded-full text-sm bg-blue-100 text-blue-700">
                                            Laki-laki
                                        </span>
                                    @else
                                        <span class="px-3 py-1 rounded-full text-sm bg-pink-100 text-pink-700">
                                            Perempuan
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <span
                                        class="px-3 py-1 bg-primary-fixed text-on-primary-fixed text-xs font-medium rounded-full">
                                        {{ $employee->position->name ?? '-' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-slate-600">
                                    {{ $employee->department->name ?? '-' }}
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex justify-end space-x-2">
                                         <button type="button" 
                                            @click="showDetail({
                                                name: '{{ addslashes($employee->name) }}',
                                                nip: '{{ $employee->nip }}',
                                                gender: '{{ $employee->gender == 'L' ? 'Laki-laki' : 'Perempuan' }}',
                                                position: '{{ $employee->position->name ?? '-' }}',
                                                department: '{{ $employee->department->name ?? '-' }}',
                                                join_date: '{{ $employee->join_date ? \Carbon\Carbon::parse($employee->join_date)->translatedFormat('d F Y') : '-' }}',
                                                status: '{{ $employee->status == 'permanent' ? 'Permanen' : 'Kontrak' }}',
                                                photo: '{{ $employee->photo_url }}',
                                                evaluations: [
                                                    @foreach($employee->evaluations as $eval)
                                                        {
                                                            criteria_code: '{{ $eval->criteria->code }}',
                                                            criteria_name: '{{ addslashes($eval->criteria->name) }}',
                                                            period_name: '{{ addslashes($eval->period->name) }}',
                                                            score: {{ $eval->score }}
                                                        },
                                                    @endforeach
                                                ]
                                            })"
                                            class="p-2 text-slate-400 hover:text-secondary transition-colors"
                                            title="Detail">
                                            <span class="material-symbols-outlined text-sm">
                                                visibility
                                            </span>
                                         </button>
                                        @can('write-data')
                                        <a href="{{ route('employee.employee-edit', $employee->id) }}"
                                            class="p-2 text-slate-400 hover:text-primary transition-colors" title="Edit">
                                            <span class="material-symbols-outlined text-sm">
                                                edit
                                            </span>
                                        </a>
                                        <button class="p-2 text-slate-400 hover:text-error transition-colors"
                                            title="Delete">
                                            <span class="material-symbols-outlined text-sm">
                                                delete
                                            </span>
                                        </button>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="px-6 py-10 text-center text-slate-400">
                                    Belum ada data pegawai
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <!-- Pagination -->
            <div class="px-6 py-4 border-t border-slate-100 bg-slate-50 flex items-center justify-between">
                <p class="font-body-md text-body-md text-slate-500">Showing {{ $employees->firstItem() }} -
                    {{ $employees->lastItem() }} of {{ $employees->total() }} users</p>
                <div class="flex space-x-2">

                    @if ($employees->onFirstPage())
                        <button disabled
                            class="px-4 py-1.5 border border-slate-200 bg-white rounded text-sm font-medium text-slate-400">
                            Previous
                        </button>
                    @else
                        <a href="{{ $employees->previousPageUrl() }}"
                            class="px-4 py-1.5 border border-slate-200 bg-white rounded text-sm font-medium text-slate-600 hover:bg-slate-50">
                            Previous
                        </a>
                    @endif

                    @if ($employees->hasMorePages())
                        <a href="{{ $employees->nextPageUrl() }}"
                            class="px-4 py-1.5 border border-slate-200 bg-white rounded text-sm font-medium text-slate-600 hover:bg-slate-50">
                            Next
                        </a>
                    @else
                        <button disabled
                            class="px-4 py-1.5 border border-slate-200 bg-white rounded text-sm font-medium text-slate-400">
                            Next
                        </button>
                    @endif

                </div>
            </div>
        </div>
        @include('employee.partials.detail-modal')
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
