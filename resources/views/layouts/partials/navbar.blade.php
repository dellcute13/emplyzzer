<header
    class="sticky top-0 z-40 w-full h-16 bg-white/80 backdrop-blur-md border-b border-slate-200 flex justify-between items-center px-8">
    <div class="flex items-center bg-surface-container-low px-4 py-2 rounded-full w-96">
        <span class="material-symbols-outlined text-slate-400 text-sm mr-2" data-icon="search">search</span>
        <input class="bg-transparent border-none focus:ring-0 text-sm w-full text-slate-600"
            placeholder="Search employee data..." type="text" />
    </div>
    <div class="flex items-center space-x-6">
        <button class="text-slate-500 hover:text-slate-900 transition-opacity">
            <span class="material-symbols-outlined" data-icon="notifications">notifications</span>
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