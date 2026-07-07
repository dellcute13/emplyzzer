@extends('layouts.app')

@section('content')
    <section class="p-8 space-y-8 flex-1">
        <div class="flex items-center gap-2 text-slate-500 mb-2">
            <span class="text-label-sm font-label-sm">Data Posisi</span>
            <span class="material-symbols-outlined text-sm" data-icon="chevron_right">chevron_right</span>
            <span class="text-label-sm font-label-sm text-secondary">Tambah Posisi</span>
        </div>
        <h2 class="text-display-xl font-display-xl text-primary-container">Tambah Posisi Baru</h2>
        <!-- Form Layout: Two-Column Bento Style -->
        <form action="{{ route('master-data.position-store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-lg">
                <!-- Right Column: Details Form -->
                <div class="lg:col-span-8">
                    <div class="bg-white rounded-xl custom-shadow border border-slate-100">
                        <div class="p-lg border-b border-slate-100 flex items-center justify-between">
                            <h3 class="text-headline-md font-headline-md text-primary-container">Informasi Personal &amp;
                                Pekerjaan</h3>
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
                                        Nama Posisi <span class="text-error">*</span>
                                    </label>
                                    <input name="name"
                                        class="w-full bg-white border border-outline-variant rounded-lg px-4 py-3 text-body-md font-body-md focus:ring-2 focus:ring-primary-container focus:border-primary-container outline-none transition-all"
                                        type="text" />
                                </div>
                                <!-- Grade -->
                                <div class="space-y-xs">
                                    <div x-data="{ open: false, selected: 'Pilih Grade', selectedId: null }" class="space-y-2 relative">
                                        <label
                                            class="text-label-sm font-label-sm text-on-surface-variant flex items-center gap-1">
                                            Grade
                                            <span class="text-error">*</span>
                                        </label>
                                        <input type="hidden" name="grade_id" :value="selectedId">
                                        <button type="button" @click="open = !open" @click.away="open = false"
                                            class="w-full bg-white border border-outline-variant rounded-lg px-3.5 py-2.5 text-body-md font-body-md outline-none transition-all flex items-center justify-between hover:border-primary-container focus:border-primary-container focus:ring-2 focus:ring-primary-container">
                                            <span class="text-left"
                                                :class="selected == 'Pilih Grade' ? 'text-slate-400' : 'text-slate-800'"
                                                x-text="selected">
                                            </span>
                                            <span
                                                class="material-symbols-outlined text-slate-400 transition-transform duration-200"
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
                                            @foreach ($grades as $grade)
                                                <button type="button"
                                                    @click=" selected='{{ $grade->name }}'; selectedId={{ $grade->id }}; open=false"
                                                    class="w-full px-4 py-3 text-left text-sm text-slate-700 border-b border-slate-100 hover:bg-slate-50 transition">

                                                    <div class="flex items-center justify-between">
                                                        <span>
                                                            {{ $grade->name }}
                                                        </span>
                                                    </div>

                                                </button>
                                            @endforeach
                                        </div>
                                    </div>
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
