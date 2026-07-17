@extends('layouts.app')

@section('content')

<div class="p-6">

    <h1 class="text-2xl font-bold mb-6">
        Edit Position
    </h1>

    <form action="{{ route('master-data.position-update', $position->id) }}"
        method="POST">

        @csrf

        <div class="mb-4">

            <label class="block mb-2">
                Position Name
            </label>

            <input type="text"
                name="name"
                value="{{ $position->name }}"
                class="w-full border rounded-lg px-4 py-2">

        </div>

        <div class="mb-4">

            <label class="block mb-2">
                Grade
            </label>

            <div x-data="{
                open: false,
                search: '',
                page: 1,
                perPage: 15,
                selected: '{{ $position->grade->name ?? 'Pilih Grade' }}',
                selectedId: '{{ $position->grade_id }}',
                items: [
                    @foreach($grades as $grade)
                        { id: '{{ $grade->id }}', name: '{{ $grade->name }}' },
                    @endforeach
                ],
                get filteredItems() {
                    return this.items.filter(item => 
                        item.name.toLowerCase().includes(this.search.toLowerCase())
                    );
                },
                get paginatedItems() {
                    let start = (this.page - 1) * this.perPage;
                    return this.filteredItems.slice(start, start + this.perPage);
                },
                get totalPages() {
                    return Math.ceil(this.filteredItems.length / this.perPage) || 1;
                },
                nextPage() {
                    if (this.page < this.totalPages) this.page++;
                },
                prevPage() {
                    if (this.page > 1) this.page--;
                },
                selectItem(item) {
                    this.selected = item.name;
                    this.selectedId = item.id;
                    this.open = false;
                }
            }" class="relative" @click.outside="open = false">
                <input type="hidden" name="grade_id" :value="selectedId">
                <button type="button" @click="open = !open; if(open) { $nextTick(() => $refs.searchInput.focus()); page = 1; search = ''; }"
                    class="w-full bg-white border border-slate-200 rounded-lg px-4 py-2 text-left flex items-center justify-between hover:border-slate-400 focus:ring-2 focus:ring-indigo-500">
                    <span x-text="selected"></span>
                    <span class="material-symbols-outlined text-slate-400 transition-transform duration-200" :class="open ? 'rotate-180' : ''">expand_more</span>
                </button>
                <div x-show="open" x-transition
                    class="absolute z-50 mt-1 w-full overflow-hidden rounded-lg border border-slate-200 bg-white shadow-lg">
                    
                    <!-- Search Input -->
                    <div class="p-2 border-b border-slate-100 bg-slate-50">
                        <input type="text" x-model="search" x-ref="searchInput" @input="page = 1" placeholder="Cari..." 
                            class="w-full px-3 py-1.5 text-xs border border-slate-200 rounded-lg focus:outline-none focus:border-indigo-600 focus:ring-1 focus:ring-indigo-600 bg-white font-normal text-slate-700">
                    </div>

                    <!-- Items List -->
                    <div class="max-h-60 overflow-y-auto font-normal text-slate-700">
                        <template x-for="item in paginatedItems" :key="item.id">
                            <button type="button" @click="selectItem(item)"
                                class="w-full px-4 py-2.5 text-left text-sm hover:bg-slate-50 transition border-b border-slate-100 last:border-0">
                                <span x-text="item.name"></span>
                            </button>
                        </template>
                        <div x-show="filteredItems.length === 0" class="px-4 py-4 text-xs text-slate-400 italic text-center">
                            Data tidak ditemukan
                        </div>
                    </div>

                    <!-- Pagination -->
                    <div x-show="totalPages > 1" class="flex items-center justify-between px-3 py-2 border-t border-slate-100 bg-slate-50 text-[11px] text-slate-500 font-normal font-sans">
                        <button type="button" @click="prevPage()" :disabled="page === 1" class="px-2 py-0.5 rounded border border-slate-200 bg-white hover:bg-slate-50 disabled:opacity-50 disabled:cursor-not-allowed">
                            Prev
                        </button>
                        <span>Page <span x-text="page"></span> of <span x-text="totalPages"></span></span>
                        <button type="button" @click="nextPage()" :disabled="page === totalPages" class="px-2 py-0.5 rounded border border-slate-200 bg-white hover:bg-slate-50 disabled:opacity-50 disabled:cursor-not-allowed">
                            Next
                        </button>
                    </div>

                </div>
            </div>

        </div>

        <button type="submit"
            class="bg-primary text-white px-4 py-2 rounded-lg">

            Update

        </button>

    </form>

</div>

@endsection