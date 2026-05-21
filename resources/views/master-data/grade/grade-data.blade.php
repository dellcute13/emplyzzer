@extends('layouts.app')

@section('content')
    <section class="p-8 space-y-8 flex-1">
        <!-- Header Section -->
        <div class="flex justify-between items-end">
            <div>
                <h2 class="font-headline-lg text-headline-lg text-on-surface">Data Grade</h2>
                <p class="font-body-md text-body-md text-on-surface-variant">Kelola master data yang ada dalam sistem.</p>
            </div>
            <a class="flex items-center bg-primary text-on-primary px-6 py-3 rounded-lg font-medium hover:opacity-90 transition-all active:scale-95"
                href="{{ route('master-data.grade-add') }}">
                <span class="material-symbols-outlined mr-2" data-icon="add">add</span>
                Tambah Grade
            </a>
        </div>
        <!-- Dashboard Content -->
        <div class="bg-white rounded-xl border border-slate-200 custom-shadow overflow-hidden">
            <!-- Modern Table -->
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50 text-slate-900 font-headline-md border-b border-slate-100">
                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider">No</th>
                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider">Grade</th>
                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider">Level</th>
                            <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @forelse ($grades as $grade)
                            <tr class="hover:bg-slate-50/50 transition-colors group">
                                <td class="px-6 py-4 font-data-tabular">
                                    {{ $loop->iteration }}
                                </td>
                                <td class="px-6 py-4">
                                    <div class="px-6 py-4 font-data-tabular text-slate-600">
                                        {{ $grade->name }}
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="font-semibold text-slate-900">
                                        {{ $grade->level }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex justify-end space-x-2">
                                        <button class="p-2 text-slate-400 hover:text-secondary transition-colors"
                                            title="Detail">
                                            <span class="material-symbols-outlined text-sm">
                                                visibility
                                            </span>
                                        </button>
                                        <a href="#" class="p-2 text-slate-400 hover:text-primary transition-colors"
                                            title="Edit">
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
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="px-6 py-10 text-center text-slate-400">
                                    Belum ada data grade
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <!-- Pagination -->
            <div class="px-6 py-4 border-t border-slate-100 bg-slate-50 flex items-center justify-between">
                <p class="font-body-md text-body-md text-slate-500">Showing {{ $grades->firstItem() }} -
                    {{ $grades->lastItem() }} of {{ $grades->total() }} grades</p>
                <div class="flex space-x-2">

                    @if ($grades->onFirstPage())
                        <button disabled
                            class="px-4 py-1.5 border border-slate-200 bg-white rounded text-sm font-medium text-slate-400">
                            Previous
                        </button>
                    @else
                        <a href="{{ $grades->previousPageUrl() }}"
                            class="px-4 py-1.5 border border-slate-200 bg-white rounded text-sm font-medium text-slate-600 hover:bg-slate-50">
                            Previous
                        </a>
                    @endif

                    @if ($grades->hasMorePages())
                        <a href="{{ $grades->nextPageUrl() }}"
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
    </section>
@endsection
