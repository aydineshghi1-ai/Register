
@extends('layouts.layout')

@section('page-title', 'فهرست دسته‌بندی‌ها')

@section('content')

    <main class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">

        {{-- سربرگ صفحه --}}
        <div class="mb-10 flex flex-col gap-5 sm:flex-row sm:items-center sm:justify-between">

            <div>
                <h1 class="bg-gradient-to-r from-white via-zinc-300 to-zinc-500 bg-clip-text text-3xl font-bold text-transparent">
                    دسته‌بندی‌ها
                </h1>

                <p class="mt-2 text-sm text-zinc-400">
                    دسته‌بندی مطالب خود را مدیریت و سازمان‌دهی کنید.
                </p>
            </div>

            <a href="{{ route('categories.create') }}"
               class="inline-flex items-center justify-center rounded-xl border border-white/20 bg-white/10 px-5 py-3 text-sm font-semibold text-white shadow-lg shadow-black/20 backdrop-blur-xl transition hover:border-white/40 hover:bg-white/20">
                + ایجاد دسته‌بندی
            </a>

        </div>


        {{-- پیام موفقیت --}}
        @if (session('success'))
            <div class="mb-6 rounded-2xl border border-green-400/20 bg-green-400/10 px-5 py-4 text-sm text-green-300 backdrop-blur-xl">
                {{ session('success') }}
            </div>
        @endif


        {{-- جدول دسته‌بندی‌ها --}}
        <div class="overflow-hidden rounded-3xl border border-white/15 bg-white/10 shadow-2xl shadow-black/40 backdrop-blur-2xl">

            <div class="border-b border-white/10 px-6 py-5">
                <h2 class="text-lg font-semibold text-zinc-100">
                    تمام دسته‌بندی‌ها
                </h2>

                <p class="mt-1 text-sm text-zinc-400">
                    دسته‌بندی‌های ایجادشده توسط شما
                </p>
            </div>

            <div class="overflow-x-auto">

                <table class="w-full text-right text-sm">

                    <thead class="border-b border-white/10 bg-white/5 text-xs tracking-wider text-zinc-400">
                    <tr>
                        <th class="px-6 py-4">نام</th>
                        <th class="px-6 py-4">شناسه یکتا (Slug)</th>
                        <th class="px-6 py-4">توضیحات</th>
                        <th class="px-6 py-4 text-left">عملیات</th>
                    </tr>
                    </thead>

                    <tbody class="divide-y divide-white/10">

                    @forelse ($categories as $category)

                        <tr class="transition hover:bg-white/5">

                            <td class="whitespace-nowrap px-6 py-5 font-medium text-zinc-100">
                                {{ $category->name }}
                            </td>

                            <td class="whitespace-nowrap px-6 py-5 text-zinc-400">
                                {{ $category->slug }}
                            </td>

                            <td class="max-w-xs px-6 py-5 text-zinc-400">
                                {{ $category->description ?: 'بدون توضیحات' }}
                            </td>

                            <td class="whitespace-nowrap px-6 py-5 text-left">

                                <div class="flex justify-end gap-3">

                                    <a href="{{ route('categories.edit', $category) }}"
                                       class="text-blue-400 transition hover:text-blue-300">
                                        ویرایش
                                    </a>

                                    <form action="{{ route('categories.destroy', $category) }}"
                                          method="POST"
                                          onsubmit="return confirm('آیا از حذف این دسته‌بندی اطمینان دارید؟')">

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
                            <td colspan="4" class="px-6 py-16 text-center">

                                <p class="text-lg font-medium text-zinc-300">
                                    هیچ دسته‌بندی‌ای پیدا نشد.
                                </p>

                                <p class="mt-2 text-sm text-zinc-500">
                                    برای شروع، اولین دسته‌بندی خود را ایجاد کنید.
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
