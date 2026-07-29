@extends('layouts.app')

@section('content')
    <section class="p-8 space-y-8 flex-1">
        <div class="flex items-center gap-2 text-slate-500 mb-2">
            <span class="text-label-sm font-label-sm">Nilai Pegawai</span>
            <span class="material-symbols-outlined text-sm" data-icon="chevron_right">chevron_right</span>
            <span class="text-label-sm font-label-sm text-secondary">Tambah Penilaian</span>
        </div>
        <h2 class="text-display-xl font-display-xl text-primary-container">Tambah Penilaian Pegawai</h2>

        <form action="{{ route('evaluation.evaluation-store') }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-lg">
                <!-- Main Column -->
                <div class="lg:col-span-8 space-y-lg">
                    <!-- Pilih Pegawai & Periode -->
                    <div class="bg-white rounded-xl custom-shadow border border-slate-100">
                        <div class="p-lg border-b border-slate-100 flex items-center justify-between">
                            <h3 class="text-headline-md font-headline-md text-primary-container">Identitas Penilaian</h3>
                            <span class="px-3 py-1 bg-secondary/10 text-secondary text-[10px] font-bold rounded-full uppercase tracking-widest">Wajib Diisi</span>
                        </div>
                        <div class="p-lg grid grid-cols-1 md:grid-cols-2 gap-lg">
                            <!-- Pegawai -->
                            <div x-data="{ open: false, selected: '{{ $selectedEmployee ? $employees->firstWhere('id', $selectedEmployee)?->name : 'Pilih Pegawai' }}', selectedId: {{ $selectedEmployee ?? 'null' }} }" class="space-y-2 relative">
                                <label class="text-label-sm font-label-sm text-on-surface-variant flex items-center gap-1">
                                    Pegawai <span class="text-error">*</span>
                                </label>
                                <input type="hidden" name="employee_id" :value="selectedId">
                                <button type="button" @click="open = !open" @click.away="open = false"
                                    class="w-full bg-white border border-outline-variant rounded-lg px-3.5 py-2.5 text-body-md font-body-md outline-none transition-all flex items-center justify-between hover:border-primary-container focus:border-primary-container focus:ring-2 focus:ring-primary-container">
                                    <span class="text-left" :class="selected == 'Pilih Pegawai' ? 'text-slate-400' : 'text-slate-800'" x-text="selected"></span>
                                    <span class="material-symbols-outlined text-slate-400 transition-transform duration-200" :class="open ? 'rotate-180' : ''">expand_more</span>
                                </button>
                                <div x-show="open" x-transition:enter="transition ease-out duration-200"
                                    x-transition:enter-start="opacity-0 scale-95 -translate-y-1"
                                    x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                                    x-transition:leave="transition ease-in duration-150"
                                    x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                                    x-transition:leave-end="opacity-0 scale-95 -translate-y-1"
                                    class="absolute z-50 mt-2 w-full overflow-hidden rounded-xl border border-slate-200 bg-white shadow-xl max-h-60 overflow-y-auto">
                                    @foreach($employees as $emp)
                                        <button type="button" @click="selected='{{ $emp->name }}'; selectedId={{ $emp->id }}; open=false"
                                            class="w-full px-4 py-3 text-left text-sm text-slate-700 border-b border-slate-100 hover:bg-slate-50 transition">
                                            <div class="font-medium">{{ $emp->name }}</div>
                                            <div class="text-xs text-slate-400">{{ $emp->department?->name }}</div>
                                        </button>
                                    @endforeach
                                </div>
                            </div>
                            <!-- Periode -->
                            <div x-data="{ open: false, selected: '{{ $selectedPeriod ? $periods->firstWhere('id', $selectedPeriod)?->name : 'Pilih Periode' }}', selectedId: {{ $selectedPeriod ?? 'null' }} }" class="space-y-2 relative">
                                <label class="text-label-sm font-label-sm text-on-surface-variant flex items-center gap-1">
                                    Periode <span class="text-error">*</span>
                                </label>
                                <input type="hidden" name="period_id" :value="selectedId">
                                <button type="button" @click="open = !open" @click.away="open = false"
                                    class="w-full bg-white border border-outline-variant rounded-lg px-3.5 py-2.5 text-body-md font-body-md outline-none transition-all flex items-center justify-between hover:border-primary-container focus:border-primary-container focus:ring-2 focus:ring-primary-container">
                                    <span class="text-left" :class="selected == 'Pilih Periode' ? 'text-slate-400' : 'text-slate-800'" x-text="selected"></span>
                                    <span class="material-symbols-outlined text-slate-400 transition-transform duration-200" :class="open ? 'rotate-180' : ''">expand_more</span>
                                </button>
                                <div x-show="open" x-transition:enter="transition ease-out duration-200"
                                    x-transition:enter-start="opacity-0 scale-95 -translate-y-1"
                                    x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                                    x-transition:leave="transition ease-in duration-150"
                                    x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                                    x-transition:leave-end="opacity-0 scale-95 -translate-y-1"
                                    class="absolute z-50 mt-2 w-full overflow-hidden rounded-xl border border-slate-200 bg-white shadow-xl max-h-60 overflow-y-auto">
                                    @foreach($periods as $period)
                                        <button type="button" @click="selected='{{ $period->name }}'; selectedId={{ $period->id }}; open=false"
                                            class="w-full px-4 py-3 text-left text-sm text-slate-700 border-b border-slate-100 hover:bg-slate-50 transition">
                                            {{ $period->name }} — Sem {{ $period->semester }}/{{ $period->year }}
                                        </button>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Nilai per Kriteria -->
                    <div class="bg-white rounded-xl custom-shadow border border-slate-100">
                        <div class="p-lg border-b border-slate-100">
                            <h3 class="text-headline-md font-headline-md text-primary-container">Nilai Setiap Kriteria</h3>
                            <p class="text-xs text-slate-400 mt-1">Masukkan nilai dalam skala 0 – 100 untuk setiap kriteria.</p>
                        </div>
                        <div class="p-lg space-y-lg">
                            @foreach($criterias as $criteria)
                            <div class="grid grid-cols-12 items-center gap-4">
                                <div class="col-span-1">
                                    <span class="inline-block px-2 py-0.5 text-xs font-bold rounded bg-primary-fixed text-on-primary-fixed">{{ $criteria->code }}</span>
                                </div>
                                <div class="col-span-6">
                                    <div class="font-medium text-slate-800 text-sm">{{ $criteria->name }}</div>
                                    <div class="text-xs text-slate-400 mt-0.5">
                                        Bobot: {{ number_format($criteria->weight * 100, 0) }}% —
                                        @if($criteria->attribute === 'benefit')
                                            <span class="text-green-600">Benefit</span>
                                        @else
                                            <span class="text-red-500">Cost</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-span-5">
                                    <input type="number"
                                        name="scores[{{ $criteria->id }}]"
                                        value="{{ old('scores.' . $criteria->id, $existingScores[$criteria->id] ?? '') }}"
                                        min="0" max="100" step="0.01"
                                        placeholder="0 – 100"
                                        class="w-full bg-white border border-outline-variant rounded-lg px-4 py-2.5 text-body-md font-body-md focus:ring-2 focus:ring-primary-container focus:border-primary-container outline-none transition-all @error('scores.' . $criteria->id) border-error @enderror" />
                                    @error('scores.' . $criteria->id)
                                        <p class="text-xs text-error mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <!-- Actions -->
                        <div class="p-lg bg-slate-50 border-t border-slate-100 flex items-center justify-end gap-md">
                            <a href="{{ route('evaluation.evaluation-data') }}"
                                class="px-6 py-2.5 rounded-lg border border-primary-container text-primary-container font-headline-md text-headline-md hover:bg-white active:bg-slate-100 transition-all flex items-center gap-2">
                                Batal
                            </a>
                            <button type="submit"
                                class="px-10 py-2.5 rounded-lg bg-primary-container text-white font-headline-md text-headline-md shadow-md hover:shadow-lg hover:scale-[1.02] active:scale-100 transition-all flex items-center gap-2">
                                <span class="material-symbols-outlined" data-icon="save">save</span>
                                Simpan Penilaian
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Sidebar Info -->
                <div class="lg:col-span-4">
                    <div class="bg-white rounded-xl custom-shadow border border-slate-100 sticky top-24">
                        <div class="p-lg border-b border-slate-100">
                            <h3 class="text-headline-md font-headline-md text-primary-container">Info Kriteria SAW</h3>
                        </div>
                        <div class="p-lg space-y-3">
                            <div class="flex justify-between text-sm">
                                <span class="text-slate-600">Total Kriteria</span>
                                <span class="font-bold">{{ $criterias->count() }}</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-slate-600">Total Bobot</span>
                                <span class="font-bold text-green-600">{{ number_format($criterias->sum('weight') * 100, 0) }}%</span>
                            </div>
                            <div class="pt-3 border-t border-slate-100 space-y-2">
                                @foreach($criterias as $c)
                                    <div class="flex items-center justify-between text-xs">
                                        <span class="text-slate-500">{{ $c->code }}</span>
                                        <span class="font-medium text-slate-700">{{ number_format($c->weight * 100, 0) }}%</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>
@endsection