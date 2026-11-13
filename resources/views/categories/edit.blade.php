@extends('layouts.layout')

@section('page-title', 'ویرایش دسته‌بندی')

@section('content')

    <main class="mx-auto max-w-3xl px-4 py-12 sm:px-6">

        {{-- سربرگ صفحه --}}
        <div class="mb-8">

            <a href="{{ route('categories.index') }}"
               class="text-sm text-zinc-400 transition hover:text-white">
                بازگشت به دسته‌بندی‌ها ←
            </a>

            <h1 class="mt-5 bg-gradient-to-r from-white via-zinc-300 to-zinc-500 bg-clip-text text-3xl font-bold text-transparent">
                ویرایش دسته‌بندی
            </h1>

            <p class="mt-2 text-sm text-zinc-400">
                اطلاعات دسته‌بندی خود را ویرایش کنید.
            </p>

        </div>


        {{-- فرم ویرایش دسته‌بندی --}}
        <div class="rounded-3xl border border-white/15 bg-white/10 p-6 shadow-2xl shadow-black/40 backdrop-blur-2xl sm:p-8">

            <form action="{{ route('categories.update', $category) }}" method="POST">

                @csrf
                @method('PUT')

                {{-- نام دسته‌بندی --}}
                <div class="mb-7">

                    <label for="name"
                           class="mb-2 block text-sm font-medium text-zinc-200">
                        نام دسته‌بندی
                    </label>

                    <input
                        type="text"
                        id="name"
                        name="name"
                        value="{{ old('name', $category->name) }}"
                        placeholder="نام دسته‌بندی را وارد کنید..."
                        maxlength="100"
                        required
                        class="w-full rounded-xl border border-white/15 bg-black/20 px-4 py-3 text-sm text-white placeholder-zinc-500 outline-none transition focus:border-white/40 focus:ring-2 focus:ring-white/10"
                    >

                    @error('name')
                    <p class="mt-2 text-sm text-red-400">
                        {{ $message }}
                    </p>
                    @enderror

                </div>


                {{-- توضیحات --}}
                <div class="mb-8">

                    <label for="description"
                           class="mb-2 block text-sm font-medium text-zinc-200">
                        توضیحات
                        <span class="text-zinc-500">(اختیاری)</span>
                    </label>

                    <textarea
                        id="description"
                        name="description"
                        rows="5"
                        placeholder="توضیح کوتاهی درباره این دسته‌بندی بنویسید..."
                        class="w-full resize-none rounded-xl border border-white/15 bg-black/20 px-4 py-3 text-sm text-white placeholder-zinc-500 outline-none transition focus:border-white/40 focus:ring-2 focus:ring-white/10"
                    >{{ old('description', $category->description) }}</textarea>

                    @error('description')
                    <p class="mt-2 text-sm text-red-400">
                        {{ $message }}
                    </p>
                    @enderror

                </div>


                {{-- دکمه‌های عملیات --}}
                <div class="flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">

                    <a href="{{ route('categories.index') }}"
                       class="rounded-xl border border-white/15 px-5 py-3 text-center text-sm font-medium text-zinc-300 transition hover:bg-white/10 hover:text-white">
                        انصراف
                    </a>

                    <button
                        type="submit"
                        class="rounded-xl border border-white/20 bg-white/15 px-6 py-3 text-sm font-semibold text-white shadow-lg transition hover:bg-white/25"
                    >
                        ذخیره تغییرات
                    </button>

                </div>

            </form>

        </div>

    </main>

@endsection
