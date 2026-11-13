@extends('layouts.layout')

@section('page-title', 'ایجاد مطلب جدید')

@section('content')

    <main class="mx-auto max-w-5xl px-4 py-10 sm:px-6 lg:px-8">

        {{-- Page Header --}}
        <div class="mb-10">
            <h1 class="bg-gradient-to-r from-white via-zinc-300 to-zinc-500 bg-clip-text text-3xl font-bold text-transparent">
                ایجاد مطلب جدید
            </h1>

            <p class="mt-2 text-sm text-zinc-400">
                مطلب جدید خود را ایجاد و منتشر کنید.
            </p>

        </div>

        {{-- Validation Errors --}}
        @if ($errors->any())
            <div class="mb-6 rounded-2xl border border-red-400/20 bg-red-400/10 px-5 py-4 text-sm text-red-300 backdrop-blur-xl">
                <p class="mb-2 font-semibold">لطفاً خطاهای زیر را بررسی کنید:</p>

                <ul class="list-inside list-disc space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Create Post Form --}}
        <div class="overflow-hidden rounded-3xl border border-white/15 bg-white/10 shadow-2xl shadow-black/40 backdrop-blur-2xl">

            <div class="border-b border-white/10 px-6 py-5">
                <h2 class="text-lg font-semibold text-zinc-100">
                    اطلاعات مطلب
                </h2>

                <p class="mt-1 text-sm text-zinc-400">
                    اطلاعات موردنیاز برای ایجاد مطلب را وارد کنید.
                </p>
            </div>

            <form action="{{ route('posts.store') }}" method="POST" class="space-y-7 p-6 sm:p-8">
                @csrf

                @if ($errors->any())
                    <div class="rounded-xl border border-red-400/30 bg-red-500/10 p-4">
                        <p class="mb-2 text-sm font-semibold text-red-300">
                            لطفاً خطاهای زیر را برطرف کنید:
                        </p>

                        <ul class="space-y-1 text-sm text-red-300">
                            @foreach ($errors->all() as $error)
                                <li>• {{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- Title --}}
                <div>
                    <label for="title" class="mb-2 block text-sm font-medium text-zinc-200">
                        عنوان مطلب
                        <span class="text-red-400">*</span>
                    </label>

                    <input
                        type="text"
                        name="title"
                        id="title"
                        value="{{ old('title') }}"
                        required
                        maxlength="200"
                        placeholder="عنوان مطلب را وارد کنید"
                        class="w-full rounded-xl border border-white/15 bg-white/5 px-4 py-3 text-sm text-white placeholder-zinc-500 outline-none transition focus:border-blue-400/50 focus:bg-white/10 focus:ring-2 focus:ring-blue-400/20"

                    >

                    @error('title')
                    <p class="mt-2 text-xs text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Excerpt --}}
                <div>
                    <label for="excerpt" class="mb-2 block text-sm font-medium text-zinc-200">
                        خلاصه مطلب
                    </label>

                    <textarea
                        name="excerpt"
                        id="excerpt"
                        rows="3"
                        placeholder="خلاصه‌ای کوتاه از مطلب بنویسید"
                        class="w-full resize-y rounded-xl border border-white/15 bg-white/5 px-4 py-3 text-sm text-white placeholder-zinc-500 outline-none transition focus:border-blue-400/50 focus:bg-white/10 focus:ring-2 focus:ring-blue-400/20"
                    >{{ old('excerpt') }}</textarea>

                    @error('excerpt')
                    <p class="mt-2 text-xs text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Body --}}
                <div>
                    <label for="body" class="mb-2 block text-sm font-medium text-zinc-200">
                        متن کامل مطلب
                        <span class="text-red-400">*</span>
                    </label>


                    <textarea
                        name="body"
                        id="body"
                        rows="10"
                        required
                        placeholder="متن کامل مطلب را وارد کنید"
                        class="w-full resize-y rounded-xl border border-white/15 bg-white/5 px-4 py-3 text-sm leading-8 text-white placeholder-zinc-500 outline-none transition focus:border-blue-400/50 focus:bg-white/10 focus:ring-2 focus:ring-blue-400/20"
                    >{{ old('body') }}</textarea>

                    @error('body')
                    <p class="mt-2 text-xs text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Categories --}}
                <div>
                    <label class="mb-3 block text-sm font-medium text-zinc-200">
                        دسته‌بندی‌ها
                    </label>

                    <p class="mb-3 text-xs text-zinc-400">
                        می‌توانید یک یا چند دسته‌بندی انتخاب کنید.
                    </p>

                    <div class="grid grid-cols-1 gap-3 rounded-2xl border border-white/10 bg-white/5 p-4 sm:grid-cols-2 lg:grid-cols-3">

                        @forelse ($categories as $category)
                            <label class="flex cursor-pointer items-center gap-3 rounded-xl border border-white/10 bg-white/5 p-3 text-sm text-zinc-300 transition hover:border-white/30 hover:bg-white/10">

                                <input
                                    type="checkbox"
                                    name="category_ids[]"
                                    value="{{ $category->id }}"
                                    @checked(in_array($category->id, old('category_ids', [])))
                                    class="h-4 w-4 rounded border-white/20 bg-white/10 text-blue-500 focus:ring-blue-400/30"
                                >

                                <span>{{ $category->name }}</span>
                            </label>
                        @empty
                            <p class="col-span-full py-3 text-sm text-zinc-500">
                                هنوز دسته‌بندی‌ای ایجاد نشده است.
                            </p>
                        @endforelse

                    </div>

                    @error('category_ids')
                    <p class="mt-2 text-xs text-red-400">{{ $message }}</p>
                    @enderror

                    @error('category_ids.*')
                    <p class="mt-2 text-xs text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Status --}}
                <div>
                    <label for="status" class="mb-2 block text-sm font-medium text-zinc-200">
                        وضعیت مطلب
                        <span class="text-red-400">*</span>
                    </label>

                    <select
                        name="status"
                        id="status"
                        required
                        class="w-full rounded-xl border border-white/15 bg-[#171b35] px-4 py-3 text-sm text-white outline-none transition focus:border-blue-400/50 focus:ring-2 focus:ring-blue-400/20"
                    >
                        <option value="draft" @selected(old('status', 'draft') === 'draft')>
                            پیش‌نویس
                        </option>

                        <option value="published" @selected(old('status') === 'published')>
                            انتشار مطلب
                        </option>

                        <option value="archived" @selected(old('status') === 'archived')>
                            بایگانی
                        </option>
                    </select>

                    @error('status')
                    <p class="mt-2 text-xs text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Actions --}}
                <div class="flex flex-col-reverse gap-3 border-t border-white/10 pt-6 sm:flex-row sm:justify-end">

                    <a
                        href="{{ route('posts.index') }}"
                        class="inline-flex items-center justify-center rounded-xl border border-white/20 bg-white/10 px-6 py-3 text-sm font-semibold text-white transition hover:border-white/40 hover:bg-white/20"
                    >
                        انصراف
                    </a>

                    <button
                        type="submit"
                        class="inline-flex items-center justify-center rounded-xl border border-blue-400/30 bg-blue-500/20 px-6 py-3 text-sm font-semibold text-white shadow-lg shadow-blue-950/30 transition hover:border-blue-400/50 hover:bg-blue-500/30"
                    >
                        ایجاد مطلب
                    </button>

                </div>

            </form>
        </div>

    </main>

@endsection
