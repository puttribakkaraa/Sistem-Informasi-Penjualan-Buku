<nav class="bg-gradient-to-r from-blue-600 via-purple-600 to-indigo-600" x-data="{ isOpen: false }">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
      <div class="flex h-16 items-center justify-between">
        <div class="flex items-center">
          <div class="shrink-0">
            <img class="h-12 w-15" src="/images/logomcm.jpg" alt="">
          </div>
          <div class="hidden md:block">
            <div class="ml-10 flex items-baseline space-x-4">
              <!-- Current: "bg-purple-700 text-white", Default: "text-gray-300 hover:bg-purple-500 hover:text-white" -->
              <x-Nav-Link href="/ " :active="request()->is('/')">Dashboard</x-Nav-Link>
              <x-Nav-Link href="/BukuBefore" :active="request()->is('BukuBefore')">Buku</x-Nav-Link>
              <!-- <x-Nav-Link href="/pembelian/history" :active="request()->is('pembelian/history')">Riwayat Pembelian</x-Nav-Link> -->
             
            </div>
          </div>
        </div>
        <div class="hidden md:block">
          <div class="ml-4 flex items-center md:ml-6">
            
            <!-- Profile dropdown -->
            <div class="relative ml-3">
              <div>
                <button type="button" @click="isOpen = !isOpen" class="relative flex max-w-xs items-center rounded-full bg-gradient-to-r from-blue-600 via-purple-600 to-indigo-600 text-sm focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-indigo-600" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                  <span class="absolute -inset-1.5"></span>
                  <span class="sr-only">Open user menu</span>
                  <img class="h-8 w-8 rounded-full" src="/images/hamburger.png" alt="">
                </button>
              </div>

              <div 
                x-show="isOpen"
                x-transition:enter="transition ease-out duration-100 transform"
                x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-75 transform"
                x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-95"
              class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                <!-- Active: "bg-gray-100 outline-none", Not Active: "" -->
                <!-- <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-0">Profil Mu</a> -->
                <!-- <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-1">Settings</a> -->
                    <!-- <a href="" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-2">Keluar</a> -->

                <a href="{{ route('login') }}" 
                           class="mt-4 w-full bg-indigo-600 text-white py-3 px-6 rounded-lg hover:bg-indigo-700 focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-all text-center block">
                            login
                        </a>
              <!-- <form action="{{ route('login') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="block rounded-md px-3 py-2 text-base font-medium text-red-500 hover:bg-purple-500 hover:text-white">
                        Login
                    </button>
                </form> -->

              </div>
            </div>
          </div>
        </div>
        <div class="-mr-2 flex md:hidden">
          <!-- Mobile menu button -->
          <button type="button" @click="isOpen = !isOpen" class="relative inline-flex items-center justify-center rounded-md bg-gradient-to-r from-blue-600 via-purple-600 to-indigo-600 p-2 text-gray-200 hover:bg-purple-500 hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-indigo-600" aria-controls="mobile-menu" aria-expanded="false">
            <span class="absolute -inset-0.5"></span>
            <span class="sr-only">Open main menu</span>
            <!-- Menu open: "hidden", Menu closed: "block" -->
            <svg :class="{'hidden': isOpen, 'block': !isOpen }" class="block h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
              <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
            </svg>
            <!-- Menu open: "block", Menu closed: "hidden" -->
            <svg :class="{'block': isOpen, 'hidden': !isOpen }" class="hidden h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
              <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
            </svg> 
          </button>
        </div>
      </div>
    </div>

    <!-- Mobile menu, show/hide based on menu state. -->
    <div x-show="isOpen" class="md:hidden" id="mobile-menu">
      <div class="space-y-1 px-2 pb-3 pt-2 sm:px-3 mb-5px">
        <!-- Current: "bg-purple-700 text-white", Default: "text-gray-300 hover:bg-purple-500 hover:text-white" -->
              <x-Nav-Link href="/" :active="request()->is('/')">Dashboard</x-Nav-Link>
            <x-Nav-Link href="{{ route('buku.before') }}" :active="request()->is('BukuBefore')">Buku</x-Nav-Link>

      <div class="border-t border-purple-600 pb-3 pt-4">
        <div class="flex items-center px-5">
          <div class="shrink-0">
            <img class="h-10 w-10 rounded-full border-2 border-white" src="/images/hamburger.png" alt="">
          </div>
          <div class="ml-3">
            <div class="text-base font-medium text-white">Belum Login</div>
            <div class="text-sm font-medium text-gray-200">Silahkan Login</div>
          </div>
        </div>
        <div class="mt-3 space-y-1 px-2">
          <!-- <a href="#" class="block rounded-md px-3 py-2 text-base font-medium text-gray-200 hover:bg-purple-500 hover:text-white">Profil Mu</a> -->

           <form action="{{ route('login') }}" method="POST" class="inline">
                @csrf
                <button type="submit" class="block rounded-md px-3 py-2 text-base font-medium text-red-500 hover:bg-purple-500 hover:text-white">
                    login
                </button>
            </form>

        </div>
      </div>
    </div>
  </nav>
