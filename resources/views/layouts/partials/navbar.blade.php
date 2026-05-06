<div x-data="{ notificationDrawer: false }" class="relative">
    <header
        class="sticky top-0 z-40 w-full h-16 bg-white/80 backdrop-blur-md border-b border-slate-200 flex justify-between items-center px-8">
        <div class="flex items-center bg-surface-container-low px-4 py-2 rounded-full w-96">
            <span class="material-symbols-outlined text-slate-400 text-sm mr-2" data-icon="search">search</span>
            <input class="bg-transparent border-none focus:ring-0 text-sm w-full text-slate-600"
                placeholder="Search employee data..." type="text" />
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
            <div class="flex items-center space-x-3 cursor-pointer pl-6 border-l border-slate-200">
                <div class="text-right">
                    <p class="text-xs font-bold text-slate-900 leading-none">{{ Auth::user()->name }}</p>
                    <p class="text-[10px] text-slate-500 uppercase tracking-tighter">{{ Auth::user()->role }}</p>
                </div>
                {{-- <img alt="Administrator Profile" class="w-10 h-10 rounded-full border-2 border-primary-fixed object-cover"
                data-alt="professional headshot of a middle-aged male administrator with a confident smile in a clean office setting"
                src="https://lh3.googleusercontent.com/aida-public/AB6AXuCe5AgMJVFL_EO7aHnqH4qhvh4O_ZYvlMv_tpFjOtI0gBwIOh4rH2rgnK1pTsfw0qv-4GD_hsqMc6oASuEhZhYnnR_oVd1xVVsu4bjHO0B9FJYOovFBfaHpujUMQrbdiUvhgTaRf0FJQO7-aAZLgq7w2OLeCqyp7a32dtE2zooAkTbPS3fWCs0xn92jTXxabBmuzqJFNwZyS2rUN1F6ahN0mjILaAEG0PZbg1Vis5k0FQeoSqjyVyOFroqfX3PmCB1huIeWzvievTaX" /> --}}
            </div>
        </div>
    </header>
    <div x-show="notificationDrawer" x-transition.opacity class="fixed inset-0 bg-black/30 backdrop-blur-[2px] z-40"
        @click="notificationDrawer = false">
    </div>

    <!-- 🔥 DRAWER -->
    <div x-show="notificationDrawer" x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
        x-transition:leave="transition ease-in duration-200" x-transition:leave-start="translate-x-0"
        x-transition:leave-end="translate-x-full"
        class="fixed top-0 right-0 h-screen w-[420px] bg-white shadow-2xl z-50 flex flex-col border-l border-slate-200">

        <!-- HEADER -->
        <div class="flex items-center justify-between px-6 h-16 border-b border-slate-100">

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

        <!-- CONTENT -->
        <div class="flex-1 overflow-y-auto">

            <!-- ITEM -->
            <div class="flex gap-4 px-6 py-5 border-b border-slate-100 hover:bg-slate-50 transition cursor-pointer">

                <div
                    class="w-10 h-10 rounded-full bg-green-100 text-green-600 flex items-center justify-center flex-shrink-0">

                    <span class="material-symbols-outlined text-[20px]">
                        person_add
                    </span>

                </div>

                <div class="flex-1">

                    <p class="text-sm text-slate-700 leading-relaxed">
                        Pengguna baru berhasil ditambahkan
                    </p>

                    <span class="text-[11px] text-slate-400">
                        2 menit lalu
                    </span>

                </div>

            </div>

            <div class="flex gap-4 px-6 py-5 border-b border-slate-100 hover:bg-slate-50 transition cursor-pointer">

                <div
                    class="w-10 h-10 rounded-full bg-green-100 text-green-600 flex items-center justify-center flex-shrink-0">

                    <span class="material-symbols-outlined text-[20px]">
                        person_add
                    </span>

                </div>

                <div class="flex-1">

                    <p class="text-sm text-slate-700 leading-relaxed">
                        Pengguna baru berhasil ditambahkan
                    </p>

                    <span class="text-[11px] text-slate-400">
                        2 menit lalu
                    </span>

                </div>

            </div>

            <div class="flex gap-4 px-6 py-5 border-b border-slate-100 hover:bg-slate-50 transition cursor-pointer">

                <div
                    class="w-10 h-10 rounded-full bg-green-100 text-green-600 flex items-center justify-center flex-shrink-0">

                    <span class="material-symbols-outlined text-[20px]">
                        person_add
                    </span>

                </div>

                <div class="flex-1">

                    <p class="text-sm text-slate-700 leading-relaxed">
                        Pengguna baru berhasil ditambahkan
                    </p>

                    <span class="text-[11px] text-slate-400">
                        2 menit lalu
                    </span>

                </div>

            </div>

            <div class="flex gap-4 px-6 py-5 border-b border-slate-100 hover:bg-slate-50 transition cursor-pointer">

                <div
                    class="w-10 h-10 rounded-full bg-green-100 text-green-600 flex items-center justify-center flex-shrink-0">

                    <span class="material-symbols-outlined text-[20px]">
                        person_add
                    </span>

                </div>

                <div class="flex-1">

                    <p class="text-sm text-slate-700 leading-relaxed">
                        Pengguna baru berhasil ditambahkan
                    </p>

                    <span class="text-[11px] text-slate-400">
                        2 menit lalu
                    </span>

                </div>

            </div>

            <div class="flex gap-4 px-6 py-5 border-b border-slate-100 hover:bg-slate-50 transition cursor-pointer">

                <div
                    class="w-10 h-10 rounded-full bg-green-100 text-green-600 flex items-center justify-center flex-shrink-0">

                    <span class="material-symbols-outlined text-[20px]">
                        person_add
                    </span>

                </div>

                <div class="flex-1">

                    <p class="text-sm text-slate-700 leading-relaxed">
                        Pengguna baru berhasil ditambahkan
                    </p>

                    <span class="text-[11px] text-slate-400">
                        2 menit lalu
                    </span>

                </div>

            </div>

            <div class="flex gap-4 px-6 py-5 border-b border-slate-100 hover:bg-slate-50 transition cursor-pointer">

                <div
                    class="w-10 h-10 rounded-full bg-green-100 text-green-600 flex items-center justify-center flex-shrink-0">

                    <span class="material-symbols-outlined text-[20px]">
                        person_add
                    </span>

                </div>

                <div class="flex-1">

                    <p class="text-sm text-slate-700 leading-relaxed">
                        Pengguna baru berhasil ditambahkan
                    </p>

                    <span class="text-[11px] text-slate-400">
                        2 menit lalu
                    </span>

                </div>

            </div>

            <div class="flex gap-4 px-6 py-5 border-b border-slate-100 hover:bg-slate-50 transition cursor-pointer">

                <div
                    class="w-10 h-10 rounded-full bg-green-100 text-green-600 flex items-center justify-center flex-shrink-0">

                    <span class="material-symbols-outlined text-[20px]">
                        person_add
                    </span>

                </div>

                <div class="flex-1">

                    <p class="text-sm text-slate-700 leading-relaxed">
                        Pengguna baru berhasil ditambahkan
                    </p>

                    <span class="text-[11px] text-slate-400">
                        2 menit lalu
                    </span>

                </div>

            </div>

            <div class="flex gap-4 px-6 py-5 border-b border-slate-100 hover:bg-slate-50 transition cursor-pointer">

                <div
                    class="w-10 h-10 rounded-full bg-green-100 text-green-600 flex items-center justify-center flex-shrink-0">

                    <span class="material-symbols-outlined text-[20px]">
                        person_add
                    </span>

                </div>

                <div class="flex-1">

                    <p class="text-sm text-slate-700 leading-relaxed">
                        Pengguna baru berhasil ditambahkan
                    </p>

                    <span class="text-[11px] text-slate-400">
                        2 menit lalu
                    </span>

                </div>

            </div>

            <div class="flex gap-4 px-6 py-5 border-b border-slate-100 hover:bg-slate-50 transition cursor-pointer">

                <div
                    class="w-10 h-10 rounded-full bg-green-100 text-green-600 flex items-center justify-center flex-shrink-0">

                    <span class="material-symbols-outlined text-[20px]">
                        person_add
                    </span>

                </div>

                <div class="flex-1">

                    <p class="text-sm text-slate-700 leading-relaxed">
                        Pengguna baru berhasil ditambahkan
                    </p>

                    <span class="text-[11px] text-slate-400">
                        2 menit lalu
                    </span>

                </div>

            </div>

            <div class="flex gap-4 px-6 py-5 border-b border-slate-100 hover:bg-slate-50 transition cursor-pointer">

                <div
                    class="w-10 h-10 rounded-full bg-green-100 text-green-600 flex items-center justify-center flex-shrink-0">

                    <span class="material-symbols-outlined text-[20px]">
                        person_add
                    </span>

                </div>

                <div class="flex-1">

                    <p class="text-sm text-slate-700 leading-relaxed">
                        Pengguna baru berhasil ditambahkan
                    </p>

                    <span class="text-[11px] text-slate-400">
                        2 menit lalu
                    </span>

                </div>

            </div>

            <div class="flex gap-4 px-6 py-5 border-b border-slate-100 hover:bg-slate-50 transition cursor-pointer">

                <div
                    class="w-10 h-10 rounded-full bg-green-100 text-green-600 flex items-center justify-center flex-shrink-0">

                    <span class="material-symbols-outlined text-[20px]">
                        person_add
                    </span>

                </div>

                <div class="flex-1">

                    <p class="text-sm text-slate-700 leading-relaxed">
                        Pengguna baru berhasil ditambahkan
                    </p>

                    <span class="text-[11px] text-slate-400">
                        2 menit lalu
                    </span>

                </div>

            </div>

            <div class="flex gap-4 px-6 py-5 border-b border-slate-100 hover:bg-slate-50 transition cursor-pointer">

                <div
                    class="w-10 h-10 rounded-full bg-green-100 text-green-600 flex items-center justify-center flex-shrink-0">

                    <span class="material-symbols-outlined text-[20px]">
                        person_add
                    </span>

                </div>

                <div class="flex-1">

                    <p class="text-sm text-slate-700 leading-relaxed">
                        Pengguna baru berhasil ditambahkan
                    </p>

                    <span class="text-[11px] text-slate-400">
                        2 menit lalu
                    </span>

                </div>

            </div>

            <div class="flex gap-4 px-6 py-5 border-b border-slate-100 hover:bg-slate-50 transition cursor-pointer">

                <div
                    class="w-10 h-10 rounded-full bg-green-100 text-green-600 flex items-center justify-center flex-shrink-0">

                    <span class="material-symbols-outlined text-[20px]">
                        person_add
                    </span>

                </div>

                <div class="flex-1">

                    <p class="text-sm text-slate-700 leading-relaxed">
                        Pengguna baru berhasil ditambahkan
                    </p>

                    <span class="text-[11px] text-slate-400">
                        2 menit lalu
                    </span>

                </div>

            </div>

            <div class="flex gap-4 px-6 py-5 border-b border-slate-100 hover:bg-slate-50 transition cursor-pointer">

                <div
                    class="w-10 h-10 rounded-full bg-green-100 text-green-600 flex items-center justify-center flex-shrink-0">

                    <span class="material-symbols-outlined text-[20px]">
                        person_add
                    </span>

                </div>

                <div class="flex-1">

                    <p class="text-sm text-slate-700 leading-relaxed">
                        Pengguna baru berhasil ditambahkan
                    </p>

                    <span class="text-[11px] text-slate-400">
                        2 menit lalu
                    </span>

                </div>

            </div>

            <div class="flex gap-4 px-6 py-5 border-b border-slate-100 hover:bg-slate-50 transition cursor-pointer">

                <div
                    class="w-10 h-10 rounded-full bg-green-100 text-green-600 flex items-center justify-center flex-shrink-0">

                    <span class="material-symbols-outlined text-[20px]">
                        person_add
                    </span>

                </div>

                <div class="flex-1">

                    <p class="text-sm text-slate-700 leading-relaxed">
                        Pengguna baru berhasil ditambahkan
                    </p>

                    <span class="text-[11px] text-slate-400">
                        2 menit lalu
                    </span>

                </div>

            </div>

            <!-- ITEM -->
            <div class="flex gap-4 px-6 py-5 border-b border-slate-100 hover:bg-slate-50 transition cursor-pointer">

                <div
                    class="w-10 h-10 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center flex-shrink-0">

                    <span class="material-symbols-outlined text-[20px]">
                        edit_note
                    </span>

                </div>

                <div class="flex-1">

                    <p class="text-sm text-slate-700 leading-relaxed">
                        Data pegawai berhasil diperbarui
                    </p>

                    <span class="text-[11px] text-slate-400">
                        10 menit lalu
                    </span>

                </div>

            </div>

            <!-- ITEM -->
            <div class="flex gap-4 px-6 py-5 border-b border-slate-100 hover:bg-slate-50 transition cursor-pointer">

                <div
                    class="w-10 h-10 rounded-full bg-amber-100 text-amber-600 flex items-center justify-center flex-shrink-0">

                    <span class="material-symbols-outlined text-[20px]">
                        warning
                    </span>

                </div>

                <div class="flex-1">

                    <p class="text-sm text-slate-700 leading-relaxed">
                        Terdapat perubahan data ranking pegawai
                    </p>

                    <span class="text-[11px] text-slate-400">
                        1 jam lalu
                    </span>

                </div>

            </div>

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
