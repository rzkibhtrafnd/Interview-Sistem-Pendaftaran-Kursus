<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">

            {{-- LEFT --}}
            <div class="flex">

                {{-- LOGO --}}
                <div class="flex items-center shrink-0">
                    <a href="{{ auth()->check()
                        ? (auth()->user()->role === 'admin'
                            ? route('admin.dashboard')
                            : route('courses.index'))
                        : route('home') }}">
                        <x-application-logo class="block w-auto text-gray-800 fill-current h-9" />
                    </a>
                </div>

                {{-- MENU DESKTOP --}}
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">

                    {{-- ===== GUEST ===== --}}
                    @guest
                        <x-nav-link :href="route('home')" :active="request()->routeIs('home')">
                            <i class="mr-1 fas fa-book-open"></i> Kursus
                        </x-nav-link>
                    @endguest

                    {{-- ===== ADMIN ===== --}}
                    @auth
                        @if(auth()->user()->role === 'admin')
                            <x-nav-link :href="route('admin.dashboard')">
                                Dashboard
                            </x-nav-link>

                            <x-nav-link :href="route('admin.categories.index')">
                                Kategori
                            </x-nav-link>

                            <x-nav-link :href="route('admin.courses.index')">
                                Kursus
                            </x-nav-link>

                            <x-nav-link :href="route('admin.course-materials.index')">
                                Materi
                            </x-nav-link>

                            <x-nav-link :href="route('admin.transactions.index')">
                                Transaksi
                            </x-nav-link>
                        @endif
                    @endauth

                    {{-- ===== USER ===== --}}
                    @auth
                        @if(auth()->user()->role === 'user')
                            <x-nav-link :href="route('courses.index')">
                                Kursus
                            </x-nav-link>

                            <x-nav-link :href="route('my-courses.index')">
                                Kursus Saya
                            </x-nav-link>

                            <x-nav-link :href="route('transactions.index')">
                                Transaksi
                            </x-nav-link>
                        @endif
                    @endauth

                </div>
            </div>

            {{-- RIGHT --}}
            <div class="hidden sm:flex sm:items-center sm:ms-6">

                {{-- GUEST --}}
                @guest
                    <a href="{{ route('login') }}"
                       class="px-4 py-2 text-sm font-medium text-gray-700 hover:text-blue-600">
                        Login
                    </a>

                    <a href="{{ route('register') }}"
                       class="px-4 py-2 ml-2 text-sm font-medium text-white bg-blue-600 rounded hover:bg-blue-700">
                        Register
                    </a>
                @endguest

                {{-- AUTH --}}
                @auth
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-500 bg-white rounded-md hover:text-gray-700">
                                {{ Auth::user()->name }}
                                <svg class="w-4 h-4 fill-current ms-1" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                          d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                          clip-rule="evenodd" />
                                </svg>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                Profile
                            </x-dropdown-link>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                    Log Out
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @endauth

            </div>

            {{-- HAMBURGER --}}
            <div class="flex items-center -me-2 sm:hidden">
                <button @click="open = ! open"
                        class="inline-flex items-center justify-center p-2 text-gray-400 rounded-md hover:bg-gray-100">
                    <svg class="w-6 h-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }"
                              class="inline-flex" stroke-linecap="round"
                              stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }"
                              class="hidden" stroke-linecap="round"
                              stroke-linejoin="round" stroke-width="2"
                              d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

        </div>
    </div>
</nav>
