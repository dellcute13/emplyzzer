<div x-data="{ notificationDrawer: false }" class="relative">
    <header
        class="sticky top-0 z-40 w-full h-16 bg-white/80 backdrop-blur-md border-b border-slate-200 flex justify-between items-center px-4 md:px-8">
        <div class="flex items-center gap-3 flex-1 max-w-xs sm:max-w-sm md:max-w-md">
            <!-- Hamburger Menu Button for Mobile/Tablet -->
            <button @click="sidebarOpen = true" class="lg:hidden text-slate-500 hover:text-slate-900 transition-opacity focus:outline-none flex items-center justify-center p-1 rounded-lg hover:bg-slate-100 transition-colors">
                <span class="material-symbols-outlined text-2xl">menu</span>
            </button>

            <div
                x-data
                class="relative w-full">

                <div class="flex items-center bg-surface-container-low px-4 py-1.5 rounded-full">

                    <span class="material-symbols-outlined text-slate-400 text-sm mr-2">
                        search
                    </span>

                    <input
                        type="text"
                        placeholder="Search menu..."

                        x-model="$store.menuSearch.query"

                        @keydown.escape="$store.menuSearch.query=''"
                        @keydown.arrow-down.prevent="$store.menuSearch.selected = Math.min($store.menuSearch.selected + 1, $store.menuSearch.filtered.length - 1)"
                        @keydown.arrow-up.prevent="$store.menuSearch.selected = Math.max($store.menuSearch.selected - 1, 0)"
                        @keydown.enter.prevent="
                    if($store.menuSearch.filtered.length){
                        window.location.href = $store.menuSearch.filtered[$store.menuSearch.selected].route;
                    }
                "

                        class="bg-transparent border-none focus:ring-0 text-sm w-full text-slate-600 py-0" />

                </div>

            <!-- Dropdown -->
            <div
                x-show="$store.menuSearch.filtered.length"
                x-transition
                @click.outside="$store.menuSearch.query=''"
                class="absolute left-0 right-0 mt-2 bg-white rounded-xl border border-slate-200 shadow-xl overflow-hidden z-50 max-h-96 overflow-y-auto">

                <template
                    x-for="(menu,index) in $store.menuSearch.filtered"
                    :key="index + '-' + menu.title">

                    <a
                        :href="menu.route"
                        class="flex items-center gap-3 px-4 py-2.5 hover:bg-slate-100 transition"
                        :class="{
                    'bg-slate-100': index === $store.menuSearch.selected
                }">

                        <span
                            class="material-symbols-outlined text-slate-400 flex-shrink-0"
                            x-text="menu.icon">
                        </span>

                        <div class="flex flex-col min-w-0">
                            <span
                                class="text-sm font-medium text-slate-700 truncate"
                                x-text="menu.title">
                            </span>
                            <span
                                x-show="menu.subtitle"
                                class="text-[11px] text-slate-400 truncate"
                                x-text="menu.subtitle">
                            </span>
                        </div>

                    </a>

                </template>

            </div>

        </div>
        <div class="flex items-center space-x-6">
            <button @click="notificationDrawer = true"
                class="text-slate-500 hover:text-slate-900 transition-opacity relative">
                <span class="material-symbols-outlined">
                    notifications
                </span>
                <span class="absolute -top-1 -right-1 w-2.5 h-2.5 bg-red-500 rounded-full border border-white">
                </span>
            </button>
            <button class="text-slate-500 hover:text-slate-900 transition-opacity">
                <span class="material-symbols-outlined" data-icon="settings">settings</span>
            </button>
            <div class="hidden sm:flex items-center space-x-3 cursor-pointer pl-4 md:pl-6 border-l border-slate-200">
                <div class="text-right">
                    <p class="text-xs font-bold text-slate-900 leading-none">{{ Auth::user()->name }}</p>
                    <p class="text-[10px] text-slate-500 uppercase tracking-tighter">{{ Auth::user()->role }}</p>
                </div>
            </div>
        </div>
    </header>
    <div x-show="notificationDrawer" x-cloak x-transition.opacity class="fixed inset-0 bg-black/30 backdrop-blur-[2px] z-40"
        @click="notificationDrawer = false">
    </div>
    <div x-show="notificationDrawer" x-cloak x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
        x-transition:leave="transition ease-in duration-200" x-transition:leave-start="translate-x-0"
        x-transition:leave-end="translate-x-full"
        class="fixed top-0 right-0 h-[calc(100vh-3rem)] sm:h-[calc(100vh-4rem)] w-[calc(100vw-2rem)] sm:w-[420px] bg-white shadow-2xl z-50 m-4 sm:m-6 rounded-2xl flex flex-col border-l border-slate-200 px-3.5 py-4.5">
        <div class="flex items-center justify-between px-3 h-16 border-b border-slate-100">
            <div>
                <h3 class="font-bold text-slate-900">
                    Notifikasi
                </h3>
                <p class="text-xs text-slate-500">
                    Aktivitas terbaru sistem
                </p>
            </div>
            <button @click="notificationDrawer = false"
                class="w-9 h-9 rounded-lg hover:bg-slate-100 flex items-center justify-center transition">
                <span class="material-symbols-outlined text-slate-500">
                    close
                </span>
            </button>
        </div>
        <div class="flex-1 overflow-y-auto">
            @forelse ($navbarActivities as $activity)
                <div class="flex gap-4 px-6 py-5 border-b border-slate-100 hover:bg-slate-50 transition cursor-pointer">
                    <div class="w-10 h-10 rounded-full {{ $activity['icon_bg'] }} flex items-center justify-center flex-shrink-0">
                        <span class="material-symbols-outlined text-[20px]">
                            {{ $activity['icon'] }}
                        </span>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm text-slate-700 leading-relaxed">
                            {{ $activity['message'] }}
                        </p>
                        <span class="text-[11px] text-slate-400">
                            {{ $activity['time'] ? $activity['time']->diffForHumans() : '-' }}
                        </span>
                    </div>
                </div>
            @empty
                <div class="flex flex-col items-center justify-center h-48 text-slate-400">
                    <span class="material-symbols-outlined text-4xl mb-2">notifications_off</span>
                    <p class="text-xs">Belum ada aktivitas terbaru.</p>
                </div>
            @endforelse
        </div>
        <!-- FOOTER -->
        <div class="p-4 border-t border-slate-100">

            <button
                class="w-full h-11 rounded-xl bg-slate-900 text-white text-sm font-medium hover:opacity-90 transition">
                Lihat Semua Notifikasi
            </button>

        </div>

    </div>
</div>