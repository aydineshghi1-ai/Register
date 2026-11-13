@extends('layouts.layout')

@section('page-title', 'مدیریت مطالب')

@section('content')

    <main class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">

        {{-- Page Header --}}
        @include('layouts.partials.header')


        {{-- Success Message --}}
        @if (session('success'))

            <div class="mb-6 rounded-2xl border border-green-400/20 bg-green-400/10 px-5 py-4 text-sm text-green-300 backdrop-blur-xl">
                {{ session('success') }}
            </div>

        @endif


        {{-- Posts Table --}}
        <div class="overflow-hidden rounded-3xl border border-white/15 bg-white/10 shadow-2xl shadow-black/40 backdrop-blur-2xl">

            <div class="border-b border-white/10 px-6 py-5">

                <h2 class="text-lg font-semibold text-zinc-100">
                    تمام مطالب
                </h2>

                <p class="mt-1 text-sm text-zinc-400">
                    فهرست مطالب قابل مدیریت توسط شما
                </p>

            </div>


            <div class="overflow-x-auto">

                <table class="w-full text-right text-sm">

                    <thead class="border-b border-white/10 bg-white/5 text-xs tracking-wider text-zinc-400">

                    <tr>
                        <th class="whitespace-nowrap px-6 py-4">عنوان مطلب</th>
                        <th class="whitespace-nowrap px-6 py-4">نویسنده</th>
                        <th class="whitespace-nowrap px-6 py-4">دسته‌بندی‌ها</th>
                        <th class="whitespace-nowrap px-6 py-4">وضعیت</th>
                        <th class="whitespace-nowrap px-6 py-4">تاریخ انتشار</th>
                        <th class="whitespace-nowrap px-6 py-4 text-left">عملیات</th>
                    </tr>

                    </thead>


                    <tbody class="divide-y divide-white/10">

                    @forelse ($posts as $post)

                        <tr class="transition hover:bg-white/5">

                            {{-- Title --}}
                            <td class="min-w-48 px-6 py-5 font-medium text-zinc-100">

                                {{ $post->title }}

                            </td>


                            {{-- Author --}}
                            <td class="whitespace-nowrap px-6 py-5 text-zinc-400">

                                {{ $post->author->first_name ?? '' }}
                                {{ $post->author->last_name ?? '' }}

                            </td>


                            {{-- Categories --}}
                            <td class="min-w-40 px-6 py-5 text-zinc-400">

                                @forelse ($post->categories as $category)

                                    <span class="mb-1 inline-block rounded-lg border border-white/10 bg-white/5 px-2 py-1 text-xs">

                                        {{ $category->name }}

                                    </span>

                                @empty

                                    <span class="text-zinc-500">
                                        بدون دسته‌بندی
                                    </span>

                                @endforelse

                            </td>


                            {{-- Status --}}
                            <td class="whitespace-nowrap px-6 py-5">

                                @if ($post->status === 'published')

                                    <span class="rounded-lg border border-green-400/20 bg-green-400/10 px-3 py-1.5 text-xs text-green-300">
                                        منتشرشده
                                    </span>

                                @else

                                    <span class="rounded-lg border border-yellow-400/20 bg-yellow-400/10 px-3 py-1.5 text-xs text-yellow-300">
                                        پیش‌نویس
                                    </span>

                                @endif

                            </td>


                            {{-- Published Date --}}
                            <td class="whitespace-nowrap px-6 py-5 text-zinc-400">

                                {{ $post->published_at?->format('Y/m/d') ?? '—' }}

                            </td>


                            {{-- Actions --}}
                            <td class="whitespace-nowrap px-6 py-5 text-left">

                                <div class="flex justify-end gap-3">

                                    <a href="{{ route('posts.edit', $post->slug) }}"
                                       class="text-blue-400 transition hover:text-blue-300">

                                        ویرایش

                                    </a>


                                    <form action="{{ route('posts.destroy', $post) }}"
                                          method="POST"
                                          onsubmit="return confirm('آیا از حذف این مطلب اطمینان دارید؟')">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="text-red-400 transition hover:text-red-300">

                                            حذف

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="6" class="px-6 py-16 text-center">

                                <p class="text-lg font-medium text-zinc-300">
                                    هیچ مطلبی پیدا نشد.
                                </p>

                                <p class="mt-2 text-sm text-zinc-500">
                                    برای شروع، اولین مطلب خود را ایجاد کنید.
                                </p>

                            </td>

                        </tr>

                    @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </main>

@endsection
