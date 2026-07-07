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

        <!-- Filter Period -->
        <form method="GET" action="{{ route('evaluation.evaluation-data') }}" class="flex items-end gap-4">
            <div class="space-y-1">
                <label class="font-label-sm text-slate-700 uppercase">Filter Periode</label>
                <select name="period_id" onchange="this.form.submit()"
                    class="bg-white border border-slate-200 rounded-lg px-3.5 py-2.5 text-body-md font-body-md outline-none focus:ring-2 focus:ring-primary-container">
                    <option value="">Semua Periode</option>
                    @foreach($periods as $period)
                        <option value="{{ $period->id }}" {{ $selectedPeriod == $period->id ? 'selected' : '' }}>
                            {{ $period->name }} — Semester {{ $period->semester }}/{{ $period->year }}
                        </option>
                    @endforeach
                </select>
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