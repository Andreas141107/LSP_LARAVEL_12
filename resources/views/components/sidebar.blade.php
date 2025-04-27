
<div class="flex h-screen">
    <!-- Sidebar -->
    <div class="group w-16 hover:w-56 bg-blue-500 text-white p-5 rounded-r-lg transition-all duration-300 hover:opacity-90 fixed h-full flex flex-col">
        <!-- Judul Admin -->
        <div class="opacity-0 group-hover:opacity-100 transition-opacity duration-300 mb-4">
            <h2 class="text-xl font-bold">{{ Auth::user()->name }}</h2>
        </div>

        <!-- Menu -->
        <ul class="space-y-1 flex-1">
        @if(Auth::user()->role=='admin')
        <x-responsive-sidebar href="{{ route('admin.index') }}" :active="request()->routeIs('admin.index')">
            <i class="fa-solid fa-chair mr-3"></i>
            <span class="opacity-0 group-hover:opacity-100 transition-all duration-300">Meja</span>
        </x-responsive-sidebar>
        <x-responsive-sidebar href="{{ route('admin.menu') }}" :active="request()->routeIs('admin.menu')">
            <i class="fa-solid fa-bowl-food mr-3"></i>
            <span class="opacity-0 group-hover:opacity-100 transition-all duration-300">Menu</span>
        </x-responsive-sidebar>
        <x-responsive-sidebar href="{{ route('admin.user') }}" :active="request()->routeIs('admin.user')">
            <i class="fa-solid fa-user mr-3"></i>
            <span class="opacity-0 group-hover:opacity-100 transition-all duration-300">User</span>
        </x-responsive-sidebar>
         
        @elseif ((Auth::user()->role == 'waiter'))
        <x-responsive-sidebar href="{{ route('admin.menu') }}" :active="request()->routeIs('admin.menu')">
            <i class="fa-solid fa-bowl-food mr-3"></i>
            <span class="opacity-0 group-hover:opacity-100 transition-all duration-300">Menu</span>
        </x-responsive-sidebar>
        <x-responsive-sidebar href="{{ route('waiter.index') }}" :active="request()->routeIs('waiter.index')">
            <i class="fa-solid fa-money-bill mr-3"></i>
            <span class="opacity-0 group-hover:opacity-100 transition-all duration-300">Order</span>
        </x-responsive-sidebar>
        <x-responsive-sidebar href="{{ route('waiter.laporan') }}" :active="request()->routeIs('waiter.laporan')">
            <i class="fa-solid fa-chart-line mr-3"></i>
            <span class="opacity-0 group-hover:opacity-100 transition-all duration-300">Laporan</span>
        </x-responsive-sidebar>
        @elseif (Auth::user()->role=='kasir')
        <x-responsive-sidebar href="{{ route('kasir.index') }}" :active="request()->routeIs('kasir.index')">
            <i class="fa-solid fa-money-bill-transfer mr-3"></i>
            <span class="opacity-0 group-hover:opacity-100 transition-all duration-300">Transaksi</span>
        </x-responsive-sidebar>
        <x-responsive-sidebar href="{{ route('waiter.laporan') }}" :active="request()->routeIs('waiter.laporan')">
            <i class="fa-solid fa-chart-line mr-3"></i>
            <span class="opacity-0 group-hover:opacity-100 transition-all duration-300">Laporan</span>
        </x-responsive-sidebar>
        @elseif (Auth::user()->role=='owner')
        <x-responsive-sidebar href="{{ route('waiter.laporan') }}" :active="request()->routeIs('waiter.laporan')">
            <i class="fa-solid fa-chart-line mr-3"></i>
            <span class="opacity-0 group-hover:opacity-100 transition-all duration-300">Laporan</span>
        </x-responsive-sidebar>
        @endif

    </ul>
    </div>

    <!-- Main Content -->
    <div class="flex-1 p-6 ml-14 md:ml-56 transition-all duration-300">
        {{ $slot }}    
    </div>
</div>
