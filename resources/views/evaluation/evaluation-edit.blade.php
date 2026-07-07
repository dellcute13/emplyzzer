@extends('layouts.app')

@section('content')
    <section class="p-8 space-y-8 flex-1">
        <div class="flex items-center gap-2 text-slate-500 mb-2">
            <span class="text-label-sm font-label-sm">Input Penilaian</span>
            <span class="material-symbols-outlined text-sm" data-icon="chevron_right">chevron_right</span>
            <span class="text-label-sm font-label-sm text-secondary">Edit Penilaian</span>
        </div>
        <h2 class="text-display-xl font-display-xl text-primary-container">Edit Penilaian — {{ $employee->name }}</h2>

        <form action="{{ route('evaluation.evaluation-update', [$employee->id, $period->id]) }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-lg">
                <!-- Main Column -->
                <div class="lg:col-span-8 space-y-lg">
                    <!-- Info Pegawai & Periode (read-only) -->
                    <div class="bg-white rounded-xl custom-shadow border border-slate-100">
                        <div class="p-lg border-b border-slate-100">
                            <h3 class="text-headline-md font-headline-md text-primary-container">Identitas Penilaian</h3>
                        </div>
                        <div class="p-lg grid grid-cols-1 md:grid-cols-2 gap-lg">
                            <div class="space-y-1">
                                <label class="text-label-sm font-label-sm text-on-surface-variant uppercase">Pegawai</label>
                                <div class="bg-slate-50 border border-slate-200 rounded-lg px-4 py-3 text-slate-800 font-medium">
                                    {{ $employee->name }}
                                </div>
                            </div>
                            <div class="space-y-1">
                                <label class="text-label-sm font-label-sm text-on-surface-variant uppercase">Periode</label>
                                <div class="bg-slate-50 border border-slate-200 rounded-lg px-4 py-3 text-slate-800 font-medium">
                                    {{ $period->name }} — Sem {{ $period->semester }}/{{ $period->year }}
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
                                Simpan Perubahan
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
                                        <span class="font-medium {{ isset($existingScores[$c->id]) ? 'text-green-600' : 'text-slate-400' }}">
                                            {{ isset($existingScores[$c->id]) ? number_format($existingScores[$c->id], 2) : '-' }}
                                        </span>
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