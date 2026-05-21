@extends('layouts.app')

@section('content')
    <section class="p-8 space-y-8 flex-1">
        <div class="flex items-center gap-2 text-slate-500 mb-2">
            <span class="text-label-sm font-label-sm">Data Departemen</span>
            <span class="material-symbols-outlined text-sm" data-icon="chevron_right">chevron_right</span>
            <span class="text-label-sm font-label-sm text-secondary">Tambah Departemen</span>
        </div>
        <h2 class="text-display-xl font-display-xl text-primary-container">Tambah Departemen Baru</h2>
        <!-- Form Layout: Two-Column Bento Style -->
        <form action="{{ route('master-data.department-store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-lg">
                <!-- Right Column: Details Form -->
                <div class="lg:col-span-8">
                    <div class="bg-white rounded-xl custom-shadow border border-slate-100">
                        <div class="p-lg border-b border-slate-100 flex items-center justify-between">
                            <span
                                class="px-3 py-1 bg-secondary/10 text-secondary text-[10px] font-bold rounded-full uppercase tracking-widest">Wajib
                                Diisi</span>
                        </div>
                        <div class="p-lg space-y-lg">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-lg">
                                <!-- Name -->
                                <div class="space-y-xs">
                                    <label
                                        class="text-label-sm font-label-sm text-on-surface-variant flex items-center gap-1">
                                        Nama Departemen <span class="text-error">*</span>
                                    </label>
                                    <input name="name"
                                        class="w-full bg-white border border-outline-variant rounded-lg px-4 py-3 text-body-md font-body-md focus:ring-2 focus:ring-primary-container focus:border-primary-container outline-none transition-all"
                                        type="text" />
                                </div>
                            </div>
                        </div>
                        <!-- Form Actions -->
                        <div class="p-lg bg-slate-50 border-t border-slate-100 flex items-center justify-end gap-md">
                            <button
                                class="px-6 py-2.5 rounded-lg border border-primary-container text-primary-container font-headline-md text-headline-md hover:bg-white active:bg-slate-100 transition-all flex items-center gap-2">
                                Batal
                            </button>
                            <button type="submit"
                                class="px-10 py-2.5 rounded-lg bg-primary-container text-white font-headline-md text-headline-md shadow-md hover:shadow-lg hover:scale-[1.02] active:scale-100 transition-all flex items-center gap-2">
                                <span class="material-symbols-outlined" data-icon="save">save</span>
                                Simpan Data
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>
@endsection
