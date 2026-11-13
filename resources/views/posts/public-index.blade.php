
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>اخبار و مقالات | REGISTER</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            background:
                radial-gradient(circle at 15% 15%, rgba(91, 33, 182, .20), transparent 35%),
                radial-gradient(circle at 85% 75%, rgba(37, 99, 235, .16), transparent 35%),
                #080b18;
            min-height: 100vh;
        }

        .glass {
            background: rgba(255, 255, 255, .045);
            border: 1px solid rgba(255, 255, 255, .09);
            backdrop-filter: blur(16px);
        }

        .glow-text {
            background: linear-gradient(90deg, #a78bfa, #60a5fa);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        .primary-btn {
            background: linear-gradient(90deg, #7c3aed, #2563eb);
            box-shadow: 0 8px 24px rgba(76, 29, 149, .25);
        }

        .primary-btn:hover {
            background: linear-gradient(90deg, #8b5cf6, #3b82f6);
            transform: translateY(-2px);
        }

        .secondary-btn {
            background: rgba(255, 255, 255, .055);
            border: 1px solid rgba(255, 255, 255, .10);
        }

        .secondary-btn:hover {
            background: rgba(255, 255, 255, .11);
            border-color: rgba(167, 139, 250, .35);
            transform: translateY(-2px);
        }

        .danger-btn {
            background: rgba(220, 38, 38, .16);
            border: 1px solid rgba(248, 113, 113, .25);
        }

        .danger-btn:hover {
            background: rgba(220, 38, 38, .28);
            transform: translateY(-2px);
        }

        .btn-transition {
            transition: all .25s ease;
        }

        .news-card {
            transition: transform .3s ease, border-color .3s ease, box-shadow .3s ease;
        }

        .news-card:hover {
            transform: translateY(-5px);
            border-color: rgba(139, 92, 246, .55);
            box-shadow: 0 15px 40px rgba(76, 29, 149, .18);
        }

        .news-image {
            transition: transform .5s ease;
        }

        .news-card:hover .news-image {
            transform: scale(1.04);
        }
    </style>
</head>

<body class="text-white">

@include('layouts.partials.header')

<main class="max-w-7xl mx-auto px-5 py-12 sm:py-16">

    {{-- Hero Section --}}
    <section class="text-center mb-16 sm:mb-20">

        <span class="inline-block px-5 py-2 rounded-full glass text-violet-300 text-sm mb-7">
            آخرین اخبار و مقالات
        </span>

        <h1 class="text-xl sm:text-2xl font-bold mb-6 leading-8">
            دنیای <span class="glow-text">دانش و اخبار</span>
        </h1>

        <p class="text-gray-400 max-w-2xl mx-auto leading-8 text-sm sm:text-base">
            جدیدترین اخبار، مطالب و مقالات منتشرشده را دنبال کنید
            و همیشه یک قدم جلوتر باشید.
        </p>

    </section>

    {{-- News Section --}}
    <section>

        <div class="flex justify-between items-center  border-b border-white/10 ">

            <div class="flex flex-col items-center gap-x-4">
                <h2 class="text-xl sm:text-2xl font-bold ">
                    آخرین مطالب
                </h2>

                <p class="text-gray-500 text-sm ">
                    تازه‌ترین مطالب منتشرشده
                </p>
            </div>

        </div>

        @if ($posts->count())

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 pt-9">

                @foreach ($posts as $post)

                    <article class="news-card glass rounded-2xl overflow-hidden flex flex-col">

                        {{-- Image --}}
                        <div class="h-52 overflow-hidden bg-gradient-to-br from-violet-900/40 to-blue-900/40 shrink-0">

                            @if ($post->featured_image)
                                <img
                                    src="{{ asset('storage/' . $post->featured_image) }}"
                                    alt="{{ $post->title }}"
                                    class="news-image w-full h-full object-cover"
                                    loading="lazy"
                                >
                            @else
                                <div class="w-full h-full flex items-center justify-center">
                                    <span class="text-5xl text-violet-300/60">
                                        ✦
                                    </span>
                                </div>
                            @endif

                        </div>

                        {{-- Content --}}
                        <div class="p-5 sm:p-6 flex flex-col flex-1">

                            <div class="flex items-center gap-2 text-xs text-gray-500 mb-4">

                                <span class="w-2 h-2 rounded-full bg-violet-400 shrink-0"></span>

                                <span>
                                    {{ $post->published_at?->format('Y/m/d') }}
                                </span>

                            </div>

                            <h3 class="text-lg sm:text-xl font-bold mb-3 leading-8 line-clamp-2">
                                {{ $post->title }}
                            </h3>

                            <p class="text-gray-400 text-sm leading-7 mb-6 flex-1 line-clamp-3">
                                {{ $post->excerpt ?: 'برای مطالعه جزئیات این مطلب، ادامه مطلب را انتخاب کنید.' }}
                            </p>

                            <a href="{{ route('posts.show', $post->slug) }}"
                               class="inline-flex items-center gap-2 text-violet-400 hover:text-blue-400 transition text-sm font-bold w-fit">

                                ادامه مطلب

                                <span>←</span>

                            </a>

                        </div>

                    </article>

                @endforeach

            </div>

            {{-- Pagination --}}
            <div class="mt-12">
                {{ $posts->links() }}
            </div>

        @else

            {{-- Empty State --}}
            <div class="glass rounded-2xl py-20 px-5 text-center">

                <div class="text-5xl text-violet-400 mb-5">
                    ✦
                </div>

                <h3 class="text-xl font-bold mb-3">
                    هنوز مطلبی منتشر نشده است
                </h3>

                <p class="text-gray-500 text-sm leading-7">
                    به‌زودی مطالب جدید در این بخش قرار خواهند گرفت.
                </p>

            </div>

        @endif

    </section>

</main>

{{-- Footer --}}
<footer class="border-t border-white/10 mt-16">

    <div class="max-w-7xl mx-auto px-5 py-8 text-center">

        <p class="text-gray-500 text-sm">
            © تمامی حقوق برای وب‌سایت محفوظ است.
        </p>

    </div>

</footer>

</body>
</html>
