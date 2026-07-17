@extends('layouts.app')

@section('content')
    <!-- Header Section -->
    <section class="p-4 sm:p-6 md:p-8 space-y-6 md:space-y-8 flex-1">

        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8">
            <div>
                <h2 class="font-headline-lg text-headline-lg text-slate-900">Kriteria Penilaian</h2>
                <p class="text-on-primary-container font-body-md mt-1">Atur kriteria, jenis (Benefit/Cost), dan bobot yang digunakan dalam perhitungan metode Simple Additive Weighting (SAW).</p>
            </div>
            <a
                class="flex items-center gap-2 bg-primary-container text-white px-6 py-2.5 rounded-lg font-medium shadow-sm hover:bg-primary transition-all active:scale-95 whitespace-nowrap"
                href="{{ route('criteria.criteria-add') }}">
                <span class="material-symbols-outlined text-[20px]" data-icon="add">add</span>
                Tambah Kriteria
            </a>
        </div>
        <!-- Dashboard Layout (Asymmetric Grid) -->
        <div class="grid grid-cols-12 gap-gutter">
            <!-- Main Table Section (Col 1-8) -->
            <div class="col-span-12 lg:col-span-8 space-y-gutter">
                <div
                    class="bg-white rounded-xl border border-outline-variant shadow-[0px_4px_20px_rgba(0,0,0,0.05)] overflow-hidden">
                    <div
                        class="px-lg py-md border-b border-outline-variant bg-surface-container-low flex justify-between items-center">
                        <h3 class="font-headline-md text-headline-md text-slate-900">Daftar Kriteria</h3>
                        <span class="text-xs font-medium px-2 py-1 bg-primary-fixed text-on-primary-fixed rounded">Total
                            Weight:
                            100%</span>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr
                                    class="bg-surface-container-lowest text-slate-900 font-bold border-b border-outline-variant">
                                    <th class="px-lg py-4 font-headline-md text-[14px] uppercase tracking-wider">Kode</th>
                                    <th class="px-lg py-4 font-headline-md text-[14px] uppercase tracking-wider">Nama
                                        Kriteria
                                    </th>
                                    <th class="px-lg py-4 font-headline-md text-[14px] uppercase tracking-wider">Bobot (%)
                                    </th>
                                    <th class="px-lg py-4 font-headline-md text-[14px] uppercase tracking-wider">Jenis</th>
                                    <th class="px-lg py-4 font-headline-md text-[14px] uppercase tracking-wider text-right">
                                        Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-outline-variant">
                                @forelse ($criterias as $criteria)
                                <tr class="hover:bg-slate-50 transition-colors">
                                    <td class="px-lg py-5 font-data-tabular">{{ $criteria->code }}</td>
                                    <td class="px-lg py-5 font-medium text-slate-900">
                                        <div>{{ $criteria->name }}</div>
                                        @if($criteria->description)
                                            <div class="text-xs text-slate-400 mt-0.5 max-w-xs truncate">{{ $criteria->description }}</div>
                                        @endif
                                    </td>
                                    <td class="px-lg py-5">
                                        <div class="flex items-center gap-2">
                                            <div class="w-16 bg-slate-100 h-1.5 rounded-full overflow-hidden">
                                                <div class="bg-secondary h-full" style="width: {{ $criteria->weight * 100 }}%"></div>
                                            </div>
                                            <span class="font-data-tabular">{{ number_format($criteria->weight * 100, 0) }}%</span>
                                        </div>
                                    </td>
                                    <td class="px-lg py-5">
                                        @if($criteria->attribute === 'benefit')
                                            <span class="bg-[#e7f5ed] text-[#1a7a44] px-3 py-1 rounded-full text-xs font-bold uppercase">Benefit</span>
                                        @else
                                            <span class="bg-[#fef2f2] text-[#b91c1c] px-3 py-1 rounded-full text-xs font-bold uppercase">Cost</span>
                                        @endif
                                    </td>
                                    <td class="px-lg py-5 text-right">
                                        <div class="flex justify-end gap-2">
                                            <a href="{{ route('criteria.criteria-edit', $criteria->id) }}"
                                                class="p-2 hover:bg-slate-100 rounded-lg text-secondary transition-colors">
                                                <span class="material-symbols-outlined text-[20px]" data-icon="edit">edit</span>
                                            </a>
                                            <form action="{{ route('criteria.criteria-delete', $criteria->id) }}"
                                                method="POST" class="inline"
                                                onsubmit="return confirm('Hapus kriteria {{ $criteria->name }}?')">
                                                @csrf
                                                @method('DELETE')
                                                <button class="p-2 hover:bg-error/10 rounded-lg text-error transition-colors">
                                                    <span class="material-symbols-outlined text-[20px]" data-icon="delete">delete</span>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="px-lg py-10 text-center text-slate-400">
                                        Belum ada data kriteria
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Insight Stats Section -->
            <div class="col-span-12 lg:col-span-4">
                <div class="bg-white rounded-xl border border-outline-variant shadow-[0px_4px_20px_rgba(0,0,0,0.05)] sticky top-24">
                    <div class="px-lg py-md border-b border-outline-variant bg-surface-container-low">
                        <h3 class="font-headline-md text-headline-md text-slate-900">Ringkasan Kriteria</h3>
                    </div>
                    <div class="p-lg space-y-4">
                        <!-- Total Bobot -->
                        @php $totalWeight = $criterias->sum('weight'); @endphp
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-slate-600">Total Bobot</span>
                            <span class="font-bold {{ abs($totalWeight - 1) < 0.01 ? 'text-green-600' : 'text-red-500' }}">
                                {{ number_format($totalWeight * 100, 0) }}%
                            </span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-slate-600">Jumlah Kriteria</span>
                            <span class="font-bold text-slate-900">{{ $criterias->total() }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-slate-600">Benefit</span>
                            <span class="font-bold text-green-600">{{ $criterias->filter(fn($c) => $c->attribute === 'benefit')->count() }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-slate-600">Cost</span>
                            <span class="font-bold text-red-500">{{ $criterias->filter(fn($c) => $c->attribute === 'cost')->count() }}</span>
                        </div>
                        <div class="pt-3 border-t border-slate-100">
                            @if(abs($totalWeight - 1) < 0.01)
                                <div class="flex items-center gap-2 text-green-700 bg-green-50 px-3 py-2 rounded-lg">
                                    <span class="material-symbols-outlined text-[18px]">check_circle</span>
                                    <span class="text-sm font-semibold">Bobot valid, siap proses SAW</span>
                                </div>
                            @else
                                <div class="flex items-center gap-2 text-red-700 bg-red-50 px-3 py-2 rounded-lg">
                                    <span class="material-symbols-outlined text-[18px]">warning</span>
                                    <span class="text-sm font-semibold">Total bobot bukan 100%</span>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <!-- Insights Section (Bento Style) -->
            <div class="col-span-12 grid grid-cols-1 md:grid-cols-3 gap-gutter mt-4">
                <div class="bg-white p-lg rounded-xl border border-outline-variant shadow-sm flex items-start gap-4">
                    <div
                        class="w-12 h-12 rounded-xl bg-primary-fixed flex items-center justify-center text-on-primary-fixed">
                        <span class="material-symbols-outlined" data-icon="pie_chart">pie_chart</span>
                    </div>
                    <div>
                        <h4 class="text-xs font-bold text-slate-500 uppercase tracking-wider">Total Bobot</h4>
                        <p class="text-xl font-bold text-slate-900">{{ number_format($criterias->sum('weight') * 100, 0) }}%</p>
                        <p class="text-xs text-slate-400 mt-1">{{ abs($criterias->sum('weight') - 1) < 0.01 ? 'Bobot sudah optimal (100%)' : 'Perlu penyesuaian bobot' }}</p>
                    </div>
                </div>
                <div class="bg-white p-lg rounded-xl border border-outline-variant shadow-sm flex items-start gap-4">
                    <div
                        class="w-12 h-12 rounded-xl bg-secondary-fixed flex items-center justify-center text-on-secondary-fixed-variant">
                        <span class="material-symbols-outlined" data-icon="trending_up">trending_up</span>
                    </div>
                    <div>
                        <h4 class="text-xs font-bold text-slate-500 uppercase tracking-wider">Kriteria Tertinggi</h4>
                        <p class="text-xl font-bold text-slate-900">{{ $criterias->sortByDesc('weight')->first()?->code ?? '-' }}</p>
                        <p class="text-xs text-slate-400 mt-1">{{ $criterias->sortByDesc('weight')->first()?->name ?? 'Belum ada kriteria' }}</p>
                    </div>
                </div>
                <div class="bg-white p-lg rounded-xl border border-outline-variant shadow-sm flex items-start gap-4">
                    <div
                        class="w-12 h-12 rounded-xl bg-tertiary-fixed flex items-center justify-center text-on-tertiary-fixed-variant">
                        <span class="material-symbols-outlined" data-icon="verified_user">verified_user</span>
                    </div>
                    <div>
                        <h4 class="text-xs font-bold text-slate-500 uppercase tracking-wider">Status Sistem</h4>
                        <p class="text-xl font-bold text-slate-900">{{ abs($criterias->sum('weight') - 1) < 0.01 ? 'Valid' : 'Perlu Cek' }}</p>
                        <p class="text-xs text-slate-400 mt-1">{{ $criterias->total() }} kriteria terdaftar</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
