<header class="relative z-50 border-b border-white/10 bg-slate-950/40 backdrop-blur-2xl">
    <div class="mx-auto flex max-w-7xl flex-wrap items-center justify-between gap-5 px-4 py-5 sm:px-6 lg:px-8">

        {{-- Logo --}}
        <a href="{{ route('home') }}"
           class="text-2xl font-extrabold tracking-wider text-transparent bg-clip-text bg-gradient-to-l from-blue-400 to-purple-400">
            REGISTER
        </a>

        {{-- Navigation --}}
        <nav class="flex flex-wrap items-center gap-5">

            <a href="{{ route('home') }}"
               class="text-sm font-medium text-white/80 transition hover:text-white">
                خانه
            </a>

            {{-- Categories Dropdown --}}
            <details class="group relative">

                <summary class="flex cursor-pointer list-none items-center gap-2 text-sm font-medium text-white/80 transition hover:text-white">
                    دسته‌بندی‌ها

                    <svg class="h-4 w-4 transition-transform group-open:rotate-180"
                         fill="none"
                         stroke="currentColor"
                         viewBox="0 0 24 24">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="m6 9 6 6 6-6"/>
                    </svg>
                </summary>

                <div class="absolute right-0 top-full z-50 mt-3 max-h-64 w-56 overflow-y-auto rounded-2xl border border-white/10 bg-slate-950/95 p-2 shadow-2xl backdrop-blur-xl">

                    <a href="{{ route('home') }}"
                       class="block rounded-xl px-4 py-3 text-sm text-white/80 transition hover:bg-white/10 hover:text-white">
                        همه مطالب
                    </a>

                    @foreach ($categories as $category)
                        <a href="{{ route('home', ['category' => $category->slug]) }}"
                           class="block rounded-xl px-4 py-3 text-sm text-white/80 transition hover:bg-white/10 hover:text-white">
                            {{ $category->name }}
                        </a>
                    @endforeach

                </div>

            </details>

            <a href="{{ route('home') }}"
               class="text-sm font-medium text-white/80 transition hover:text-white">
                مطالب
            </a>

        </nav>

        {{-- Authentication --}}
        <div class="flex items-center gap-3">

            @guest
                <a href="{{ route('login') }}"
                   class="rounded-xl border border-white/20 bg-white/10 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-white/20">
                    ورود
                </a>
            @else
                @if (
                    auth()->user()->hasAllRoles(['reporter', 'admin']) ||
                    auth()->user()->hasAllRoles(['reporter', 'creator'])
                )
                    <a href="{{ route('posts.index') }}"
                       class="rounded-xl border border-purple-400/30 bg-purple-400/10 px-4 py-2.5 text-sm font-semibold text-purple-200 transition hover:bg-purple-400/20">
                        پنل مدیریت
                    </a>
                @endif

                    @if (auth()->check() &&
                    (
                        auth()->user()->hasAllRoles(['reporter', 'creator']) ||
                        auth()->user()->hasAllRoles(['reporter', 'admin'])
                    ))

                        <a href="{{ route('posts.create') }}"
                           class="rounded-xl border border-purple-400/30 bg-purple-400/10 px-4 py-2.5 text-sm font-semibold text-purple-200 transition hover:bg-purple-400/20">
                            ایجاد مطلب جدید

                        </a>

                    @endif

                <form action="{{ route('logout') }}" method="POST">
                    @csrf

                    <button type="submit"
                            class="rounded-xl border border-red-400/20 bg-red-400/10 px-4 py-2.5 text-sm font-semibold text-red-300 transition hover:bg-red-400/20">
                        خروج
                    </button>
                </form>
            @endguest

        </div>

    </div>
</header>
