@extends('layouts.app')

@section('content')
    <!-- Header Section -->
    <section class="p-8 space-y-8 flex-1">

        <div class="flex justify-between items-end mb-8">
            <div>
                <h2 class="font-headline-lg text-headline-lg text-slate-900">Kriteria Penilaian</h2>
                <p class="text-on-primary-container font-body-md mt-1">Configure criteria and weights for Simple Additive
                    Weighting (SAW) calculation.</p>
            </div>
            <a
                class="flex items-center gap-2 bg-primary-container text-white px-6 py-2.5 rounded-lg font-medium shadow-sm hover:bg-primary transition-all active:scale-95"
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
                                <tr class="hover:bg-slate-50 transition-colors">
                                    <td class="px-lg py-5 font-data-tabular">C1</td>
                                    <td class="px-lg py-5 font-medium text-slate-900">Kualitas Kerja</td>
                                    <td class="px-lg py-5">
                                        <div class="flex items-center gap-2">
                                            <div class="w-16 bg-slate-100 h-1.5 rounded-full overflow-hidden">
                                                <div class="bg-secondary h-full" style="width: 30%"></div>
                                            </div>
                                            <span class="font-data-tabular">30%</span>
                                        </div>
                                    </td>
                                    <td class="px-lg py-5">
                                        <span
                                            class="bg-[#e7f5ed] text-[#1a7a44] px-3 py-1 rounded-full text-xs font-bold uppercase">Benefit</span>
                                    </td>
                                    <td class="px-lg py-5 text-right">
                                        <div class="flex justify-end gap-2">
                                            <button
                                                class="p-2 hover:bg-slate-100 rounded-lg text-secondary transition-colors"><span
                                                    class="material-symbols-outlined text-[20px]"
                                                    data-icon="edit">edit</span></button>
                                            <button
                                                class="p-2 hover:bg-error/10 rounded-lg text-error transition-colors"><span
                                                    class="material-symbols-outlined text-[20px]"
                                                    data-icon="delete">delete</span></button>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="hover:bg-slate-50 transition-colors">
                                    <td class="px-lg py-5 font-data-tabular">C2</td>
                                    <td class="px-lg py-5 font-medium text-slate-900">Kedisiplinan</td>
                                    <td class="px-lg py-5">
                                        <div class="flex items-center gap-2">
                                            <div class="w-16 bg-slate-100 h-1.5 rounded-full overflow-hidden">
                                                <div class="bg-secondary h-full" style="width: 25%"></div>
                                            </div>
                                            <span class="font-data-tabular">25%</span>
                                        </div>
                                    </td>
                                    <td class="px-lg py-5">
                                        <span
                                            class="bg-[#e7f5ed] text-[#1a7a44] px-3 py-1 rounded-full text-xs font-bold uppercase">Benefit</span>
                                    </td>
                                    <td class="px-lg py-5 text-right">
                                        <div class="flex justify-end gap-2">
                                            <button
                                                class="p-2 hover:bg-slate-100 rounded-lg text-secondary transition-colors"><span
                                                    class="material-symbols-outlined text-[20px]"
                                                    data-icon="edit">edit</span></button>
                                            <button
                                                class="p-2 hover:bg-error/10 rounded-lg text-error transition-colors"><span
                                                    class="material-symbols-outlined text-[20px]"
                                                    data-icon="delete">delete</span></button>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="hover:bg-slate-50 transition-colors">
                                    <td class="px-lg py-5 font-data-tabular">C3</td>
                                    <td class="px-lg py-5 font-medium text-slate-900">Lama Lembur</td>
                                    <td class="px-lg py-5">
                                        <div class="flex items-center gap-2">
                                            <div class="w-16 bg-slate-100 h-1.5 rounded-full overflow-hidden">
                                                <div class="bg-secondary h-full" style="width: 15%"></div>
                                            </div>
                                            <span class="font-data-tabular">15%</span>
                                        </div>
                                    </td>
                                    <td class="px-lg py-5">
                                        <span
                                            class="bg-[#fef2f2] text-[#b91c1c] px-3 py-1 rounded-full text-xs font-bold uppercase">Cost</span>
                                    </td>
                                    <td class="px-lg py-5 text-right">
                                        <div class="flex justify-end gap-2">
                                            <button
                                                class="p-2 hover:bg-slate-100 rounded-lg text-secondary transition-colors"><span
                                                    class="material-symbols-outlined text-[20px]"
                                                    data-icon="edit">edit</span></button>
                                            <button
                                                class="p-2 hover:bg-error/10 rounded-lg text-error transition-colors"><span
                                                    class="material-symbols-outlined text-[20px]"
                                                    data-icon="delete">delete</span></button>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="hover:bg-slate-50 transition-colors">
                                    <td class="px-lg py-5 font-data-tabular">C4</td>
                                    <td class="px-lg py-5 font-medium text-slate-900">Perilaku</td>
                                    <td class="px-lg py-5">
                                        <div class="flex items-center gap-2">
                                            <div class="w-16 bg-slate-100 h-1.5 rounded-full overflow-hidden">
                                                <div class="bg-secondary h-full" style="width: 30%"></div>
                                            </div>
                                            <span class="font-data-tabular">30%</span>
                                        </div>
                                    </td>
                                    <td class="px-lg py-5">
                                        <span
                                            class="bg-[#e7f5ed] text-[#1a7a44] px-3 py-1 rounded-full text-xs font-bold uppercase">Benefit</span>
                                    </td>
                                    <td class="px-lg py-5 text-right">
                                        <div class="flex justify-end gap-2">
                                            <button
                                                class="p-2 hover:bg-slate-100 rounded-lg text-secondary transition-colors"><span
                                                    class="material-symbols-outlined text-[20px]"
                                                    data-icon="edit">edit</span></button>
                                            <button
                                                class="p-2 hover:bg-error/10 rounded-lg text-error transition-colors"><span
                                                    class="material-symbols-outlined text-[20px]"
                                                    data-icon="delete">delete</span></button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Form Section (Col 9-12) -->
            <div class="col-span-12 lg:col-span-4">
                <div
                    class="bg-white rounded-xl border border-outline-variant shadow-[0px_4px_20px_rgba(0,0,0,0.05)] sticky top-24">
                    <div class="px-lg py-md border-b border-outline-variant bg-surface-container-low">
                        <h3 class="font-headline-md text-headline-md text-slate-900">Tambah / Edit Kriteria</h3>
                    </div>
                    <form class="p-lg space-y-6">
                        <!-- Input Kode -->
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Kode Kriteria</label>
                            <input
                                class="w-full px-4 py-2.5 rounded-lg border border-slate-200 focus:border-secondary focus:ring-1 focus:ring-secondary outline-none transition-all"
                                placeholder="e.g. C5" type="text" />
                        </div>
                        <!-- Input Nama -->
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Nama Kriteria</label>
                            <input
                                class="w-full px-4 py-2.5 rounded-lg border border-slate-200 focus:border-secondary focus:ring-1 focus:ring-secondary outline-none transition-all"
                                placeholder="e.g. Kerjasama Tim" type="text" />
                        </div>
                        <!-- Weight Slider -->
                        <div>
                            <div class="flex justify-between items-center mb-2">
                                <label class="text-sm font-bold text-slate-700">Bobot (%)</label>
                                <span class="text-secondary font-bold" id="weight-value">20%</span>
                            </div>
                            <div class="relative flex items-center h-8">
                                <input
                                    class="w-full h-1.5 bg-slate-200 rounded-lg appearance-none cursor-pointer accent-secondary transition-all"
                                    max="100" min="0" type="range" value="20" />
                            </div>
                            <p class="text-[11px] text-slate-400 mt-2">Weight affects the final scoring impact of this
                                criteria.</p>
                        </div>
                        <!-- Dropdown Jenis -->
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">Jenis Kriteria</label>
                            <div class="relative">
                                <select
                                    class="w-full px-4 py-2.5 rounded-lg border border-slate-200 focus:border-secondary focus:ring-1 focus:ring-secondary outline-none appearance-none bg-white cursor-pointer transition-all">
                                    <option value="benefit">Benefit (Makin besar makin baik)</option>
                                    <option value="cost">Cost (Makin kecil makin baik)</option>
                                </select>
                                <span
                                    class="absolute right-4 top-1/2 -translate-y-1/2 material-symbols-outlined text-slate-400 pointer-events-none">expand_more</span>
                            </div>
                        </div>
                        <!-- Actions -->
                        <div class="pt-4 flex flex-col gap-3">
                            <button
                                class="w-full bg-primary-container text-white py-3 rounded-lg font-bold shadow-md hover:bg-primary active:scale-[0.98] transition-all"
                                type="submit">Simpan Kriteria</button>
                            <button
                                class="w-full border border-slate-200 text-slate-600 py-3 rounded-lg font-bold hover:bg-slate-50 active:scale-[0.98] transition-all"
                                type="reset">Reset Form</button>
                        </div>
                    </form>
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
                        <h4 class="text-xs font-bold text-slate-500 uppercase tracking-wider">Weight Distribution</h4>
                        <p class="text-xl font-bold text-slate-900">Optimal</p>
                        <p class="text-xs text-slate-400 mt-1">Sum of weights equals 100%</p>
                    </div>
                </div>
                <div class="bg-white p-lg rounded-xl border border-outline-variant shadow-sm flex items-start gap-4">
                    <div
                        class="w-12 h-12 rounded-xl bg-secondary-fixed flex items-center justify-center text-on-secondary-fixed-variant">
                        <span class="material-symbols-outlined" data-icon="trending_up">trending_up</span>
                    </div>
                    <div>
                        <h4 class="text-xs font-bold text-slate-500 uppercase tracking-wider">Primary Criteria</h4>
                        <p class="text-xl font-bold text-slate-900">Quality of Work</p>
                        <p class="text-xs text-slate-400 mt-1">Holds the highest weight (30%)</p>
                    </div>
                </div>
                <div class="bg-white p-lg rounded-xl border border-outline-variant shadow-sm flex items-start gap-4">
                    <div
                        class="w-12 h-12 rounded-xl bg-tertiary-fixed flex items-center justify-center text-on-tertiary-fixed-variant">
                        <span class="material-symbols-outlined" data-icon="verified_user">verified_user</span>
                    </div>
                    <div>
                        <h4 class="text-xs font-bold text-slate-500 uppercase tracking-wider">System Status</h4>
                        <p class="text-xl font-bold text-slate-900">Valid</p>
                        <p class="text-xs text-slate-400 mt-1">Criteria ready for SAW calculation</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
