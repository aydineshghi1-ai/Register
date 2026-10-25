
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>فرم ثبت‌نام</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="galaxy-bg min-h-screen px-4 py-10">

<main class="mx-auto max-w-2xl">

    <section class="mb-6 text-center">
        <div class="mx-auto mb-3 flex h-16 w-16 items-center justify-center rounded-2xl bg-indigo-600 text-3xl text-white shadow-lg">
            ✦
        </div>

        <h1 class="text-3xl font-bold text-zinc-100">
            فرم ثبت‌نام
        </h1>

        <p class="mt-2 text-sm text-gray-200">
            لطفاً اطلاعات خود را با دقت وارد کنید.
        </p>
    </section>

    <section class="rounded-2xl border border-white bg-white/90 p-6 shadow-xl sm:p-8">

        @if (session('success'))
            <div class="mb-5 rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">
                {{ session('success') }}
            </div>
        @endif
        @if ($errors->any())
                <div class="mb-5 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
                    <ul class="list-inside list-disc space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
        @endif

        <div class="mb-6 border-b border-gray-200 pb-4">
            <h2 class="text-lg font-semibold text-indigo-700">
                اطلاعات شخصی
            </h2>
            <p class="mt-1 text-sm text-blue-400">
                تمام فیلدهای زیر باید تکمیل شوند.
            </p>
        </div>

        <form action="{{ route('register.store') }}" method="POST" class="space-y-5">
            @csrf

            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">

                <div>
                    <label for="first_name" class="mb-2 block text-sm font-medium text-gray-700">
                        نام
                    </label>
                    <input
                        type="text"
                        id="first_name"
                        name="first_name"
                        value="{{ old('first_name') }}"
                        placeholder="نام خود را وارد کنید"
                        class="w-full rounded-xl border border-gray-300 bg-gray-50 px-4 py-3 outline-none transition focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-100"
                        required
                    >
                </div>

                <div>
                    <label for="last_name" class="mb-2 block text-sm font-medium text-gray-700">
                        نام خانوادگی
                    </label>
                    <input
                        type="text"
                        id="last_name"
                        name="last_name"
                        value="{{ old('last_name') }}"
                        placeholder="نام خانوادگی"
                        class="w-full rounded-xl border border-gray-300 bg-gray-50 px-4 py-3 outline-none transition focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-100"
                        required
                    >
                </div>

                <div>
                    <label for="mobile" class="mb-2 block text-sm font-medium text-gray-700">
                        شماره موبایل
                    </label>
                    <input
                        type="tel"
                        id="mobile"
                        name="mobile"
                        placeholder="09123456789"
                        class="w-full rounded-xl border border-gray-300 bg-gray-50 px-4 py-3 outline-none transition focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-100"
                        required
                    >
                </div>

                <div>
                    <label for="email" class="mb-2 block text-sm font-medium text-gray-700">
                        ایمیل
                    </label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        placeholder="example@email.com"
                        dir="ltr"
                        class="w-full rounded-xl border border-gray-300 bg-gray-50 px-4 py-3 text-left outline-none transition focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-100"
                        required
                    >
                </div>

                <div>
                    <label for="birth_date" class="mb-2 block text-sm font-medium text-gray-700">
                        تاریخ تولد
                    </label>
                    <input
                        type="date"
                        id="birth_date"
                        name="birth_date"
                        value="{{ old('birth_date') }}"
                        class="w-full rounded-xl border border-gray-300 bg-gray-50 px-4 py-3 outline-none transition focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-100"
                        required
                    >
                </div>

                <div>
                    <label for="national_id" class="mb-2 block text-sm font-medium text-gray-700">
                        کد ملی
                    </label>
                    <input
                        type="text"
                        id="national_id"
                        name="national_id"
                        maxlength="10"
                        inputmode="numeric"
                        placeholder="کد ملی ۱۰ رقمی"
                        class="w-full rounded-xl border border-gray-300 bg-gray-50 px-4 py-3 outline-none transition focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-100"
                        required
                    >
                </div>

            </div>

            <div class="border-t border-gray-200 pt-5">
                <button
                    type="submit"
                    class="w-full rounded-xl bg-indigo-600 px-5 py-3 font-semibold text-white shadow-md transition hover:bg-indigo-700 focus:outline-none focus:ring-4 focus:ring-indigo-200"
                >
                    ثبت اطلاعات
                </button>

                <p class="mt-3 text-center text-xs text-gray-500">
                    لطفاً پیش از ثبت، اطلاعات واردشده را بررسی کنید.
                </p>
            </div>
        </form>
    </section>

    <footer class="mt-6 text-center text-xs text-gray-300">
        سامانه ثبت‌نام
    </footer>

</main>

</body>
</html>
