@extends('layouts.layout')

@section('page-title', $post->title)

@section('content')

    <div class="mx-auto max-w-5xl px-4 py-10 sm:px-6 lg:px-8">

        {{-- Header --}}
        @include('layouts.partials.header')

        {{-- Main Content --}}
        <article class="overflow-hidden rounded-3xl border border-white/10 bg-white/[0.06] shadow-2xl shadow-black/30 backdrop-blur-2xl">

            {{-- Featured Image --}}
            @if ($post->featured_image)
                <div class="h-64 w-full overflow-hidden sm:h-96">
                    <img
                        src="{{ asset('storage/' . $post->featured_image) }}"
                        alt="{{ $post->title }}"
                        class="h-full w-full object-cover"
                    >
                </div>
            @endif

            <div class="p-6 sm:p-10">

                {{-- Categories --}}
                @if ($post->categories->isNotEmpty())
                    <div class="mb-6 flex flex-wrap gap-2">
                        @foreach ($post->categories as $category)
                            <span class="rounded-full border border-purple-400/20 bg-purple-400/10 px-4 py-2 text-xs font-medium text-purple-300">
                            {{ $category->name }}
                        </span>
                        @endforeach
                    </div>
                @endif

                {{-- Title --}}
                <h1 class="mb-6 text-2xl font-extrabold leading-relaxed text-white sm:text-4xl">
                    {{ $post->title }}
                </h1>

                {{-- Author and Date --}}
                <div class="mb-8 flex flex-wrap items-center gap-x-6 gap-y-3 border-b border-white/10 pb-6 text-sm text-white/50">

                    <div class="flex items-center gap-2">
                        <span class="text-purple-300">نویسنده:</span>

                        <span class="text-white/80">
                        {{ $post->author->first_name ?? '' }}
                            {{ $post->author->last_name ?? '' }}
                    </span>
                    </div>

                    @if ($post->published_at)
                        <div class="flex items-center gap-2">
                            <span class="text-purple-300">تاریخ انتشار:</span>

                            <span class="text-white/80">
                            {{ $post->published_at->format('Y/m/d') }}
                        </span>
                        </div>
                    @endif

                </div>

                {{-- Excerpt --}}
                @if ($post->excerpt)
                    <div class="mb-8 rounded-2xl border border-blue-400/10 bg-blue-400/5 p-5">
                        <p class="text-base leading-9 text-blue-100/90">
                            {{ $post->excerpt }}
                        </p>
                    </div>
                @endif

                {{-- Post Body --}}
                <div class="text-justify text-base leading-10 text-white/80 sm:text-lg">
                    {!! nl2br(e($post->body)) !!}
                </div>

            </div>
        </article>

        {{-- Footer --}}
        <div class="mt-8 text-center text-sm text-white/30">
            © {{ date('Y') }} REGISTER — تمامی حقوق محفوظ است.
        </div>

    </div>

@endsection
