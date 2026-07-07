@extends('layouts.app')

@section('content')
    <section class="p-8 space-y-8 flex-1">
        <div>
            <h2 class="font-headline-lg text-headline-lg text-on-surface">Edit Kriteria</h2>
            <p class="font-body-md text-body-md text-on-surface-variant">Perbarui parameter kriteria untuk perhitungan Simple
                Additive Weighting (SAW).</p>
        </div>
        <a href="{{ route('criteria.criteria-data') }}"
            class="flex items-center space-x-2 text-on-primary-fixed-variant hover:text-primary transition-colors font-label-sm text-label-sm">
            <span class="material-symbols-outlined text-[18px]" data-icon="arrow_back">arrow_back</span>
            <span>Kembali ke Daftar</span>
        </a>
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-lg">
            <div class="lg:col-span-2 space-y-lg">
                <div class="bg-white rounded-xl card-shadow border border-slate-200 p-lg overflow-hidden relative">
                    <div class="absolute top-0 left-0 w-full h-1 bg-primary-container"></div>
        <form action="{{ route('criteria.criteria-update', $criteria->id) }}" method="POST" class="space-y-xl">
            @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-lg">
                            <div class="space-y-xs">
                                <label
                                    class="font-label-sm text-label-sm text-on-surface-variant block uppercase tracking-wide">Kode
                                    Kriteria <span class="text-error">*</span></label>
                                <input name="code" value="{{ old('code', $criteria->code) }}"
                                    class="w-full bg-white border border-outline-variant rounded-lg px-md py-sm focus:ring-2 focus:ring-primary-container focus:border-primary-container transition-all text-body-md font-body-md @error('code') border-error @enderror"
                                    placeholder="Contoh: C12" type="text" />
                                @error('code')<p class="text-xs text-error mt-1">{{ $message }}</p>@enderror
                                <p class="text-[11px] text-on-surface-variant/70 italic">ID unik untuk referensi matriks
                                    keputusan.</p>
                            </div>
                            <div class="space-y-xs">
                                <label
                                    class="font-label-sm text-label-sm text-on-surface-variant block uppercase tracking-wide">Nama
                                    Kriteria <span class="text-error">*</span></label>
                                <input name="name" value="{{ old('name', $criteria->name) }}"
                                    class="w-full bg-white border border-outline-variant rounded-lg px-md py-sm focus:ring-2 focus:ring-primary-container focus:border-primary-container transition-all text-body-md font-body-md @error('name') border-error @enderror"
                                    placeholder="Contoh: KPI Historis" type="text" />
                                @error('name')<p class="text-xs text-error mt-1">{{ $message }}</p>@enderror
                            </div>
                        </div>
                        <div class="space-y-md" x-data="{ weightPct: {{ old('weight', $criteria->weight) * 100 }} }">
                            <div class="flex justify-between items-end">
                                <div class="space-y-xs">
                                    <label
                                        class="font-label-sm text-label-sm text-on-surface-variant block uppercase tracking-wide">Bobot
                                        Kepentingan (Weight) <span class="text-error">*</span></label>
                                    <p class="text-xs text-on-surface-variant/70">Tentukan persentase pengaruh kriteria ini
                                        terhadap skor total.</p>
                                </div>
                                <div
                                    class="bg-primary-container text-white px-md py-xs rounded-lg font-headline-md text-headline-md" x-text="weightPct + '%'">
                                </div>
                            </div>
                            <div class="relative h-12 flex items-center">
                                <input name="weight_pct" x-model="weightPct"
                                    class="w-full h-2 bg-slate-200 rounded-full appearance-none cursor-pointer accent-primary-container"
                                    max="100" min="1" step="1" type="range" />
                                <input type="hidden" name="weight" :value="weightPct / 100">
                                <div class="absolute -bottom-2 left-0 w-full flex justify-between px-1">
                                    <span class="text-[10px] font-bold text-slate-400">0%</span>
                                    <span class="text-[10px] font-bold text-slate-400">50%</span>
                                    <span class="text-[10px] font-bold text-slate-400">100%</span>
                                </div>
                            </div>
                        </div>
                        <div class="space-y-xs">
                            <label
                                class="font-label-sm text-label-sm text-on-surface-variant block uppercase tracking-wide mb-md">Tipe
                                Kriteria <span class="text-error">*</span></label>
                            <div class="grid grid-cols-2 gap-md">
                                <label
                                    class="relative flex items-center p-lg border border-outline-variant rounded-xl cursor-pointer hover:bg-slate-50 transition-colors group">
                                    <input value="benefit" {{ old('attribute', $criteria->attribute) == 'benefit' ? 'checked' : '' }}
                                        class="hidden peer" name="attribute" type="radio" />
                                    <div
                                        class="w-5 h-5 border-2 border-outline-variant rounded-full peer-checked:border-secondary peer-checked:bg-secondary mr-md flex items-center justify-center transition-all">
                                        <div class="w-2 h-2 bg-white rounded-full"></div>
                                    </div>
                                    <div>
                                        <span class="font-headline-md text-headline-md block text-on-surface">Benefit</span>
                                        <span class="font-body-md text-body-md text-on-surface-variant">Semakin besar nilai
                                            semakin baik.</span>
                                    </div>
                                </label>
                                <label
                                    class="relative flex items-center p-lg border border-outline-variant rounded-xl cursor-pointer hover:bg-slate-50 transition-colors group">
                                    <input value="cost" {{ old('attribute', $criteria->attribute) == 'cost' ? 'checked' : '' }}
                                        class="hidden peer" name="attribute" type="radio" />
                                    <div
                                        class="w-5 h-5 border-2 border-outline-variant rounded-full peer-checked:border-secondary peer-checked:bg-secondary mr-md flex items-center justify-center transition-all">
                                        <div class="w-2 h-2 bg-white rounded-full"></div>
                                    </div>
                                    <div>
                                        <span class="font-headline-md text-headline-md block text-on-surface">Cost</span>
                                        <span class="font-body-md text-body-md text-on-surface-variant">Semakin kecil nilai
                                            semakin baik.</span>
                                    </div>
                                </label>
                            </div>
                        </div>
                        <div class="space-y-xs">
                            <label
                                class="font-label-sm text-label-sm text-on-surface-variant block uppercase tracking-wide">Deskripsi</label>
                            <textarea name="description" rows="3"
                                class="w-full bg-white border border-outline-variant rounded-lg px-md py-sm focus:ring-2 focus:ring-primary-container focus:border-primary-container transition-all text-body-md font-body-md"
                                placeholder="Keterangan tambahan tentang kriteria ini...">{{ old('description', $criteria->description) }}</textarea>
                        </div>
                        <div class="pt-lg border-t border-slate-100 flex justify-end space-x-md">
                            <a href="{{ route('criteria.criteria-data') }}"
                                class="px-xl py-md border border-primary-container text-primary-container font-label-sm text-label-sm rounded-lg hover:bg-slate-50 transition-all uppercase tracking-widest font-bold"
                                >Batal</a>
                            <button
                                class="px-xl py-md bg-primary-container text-white font-label-sm text-label-sm rounded-lg hover:opacity-90 transition-all shadow-md uppercase tracking-widest font-bold"
                                type="submit">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="space-y-lg">
                <div class="bg-white rounded-xl card-shadow border border-slate-200 p-lg">
                    <h3 class="font-headline-md text-headline-md text-on-surface mb-md flex items-center">
                        <span class="material-symbols-outlined mr-sm text-primary-container"
                            data-icon="lightbulb">lightbulb</span>
                        Tips Analisis
                    </h3>
                    <ul class="space-y-md">
                        <li class="flex items-start space-x-md">
                            <div class="mt-1 w-2 h-2 rounded-full bg-secondary shrink-0"></div>
                            <p class="font-body-md text-body-md text-on-surface-variant">Pastikan total bobot dari seluruh
                                kriteria berjumlah 100%.</p>
                        </li>
                        <li class="flex items-start space-x-md">
                            <div class="mt-1 w-2 h-2 rounded-full bg-secondary shrink-0"></div>
                            <p class="font-body-md text-body-md text-on-surface-variant">Gunakan tipe
                                <strong>Benefit</strong> untuk kriteria seperti KPI atau Kompetensi.</p>
                        </li>
                        <li class="flex items-start space-x-md">
                            <div class="mt-1 w-2 h-2 rounded-full bg-secondary shrink-0"></div>
                            <p class="font-body-md text-body-md text-on-surface-variant">Gunakan tipe <strong>Cost</strong>
                                untuk kriteria seperti Riwayat Pelanggaran.</p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
@endsection