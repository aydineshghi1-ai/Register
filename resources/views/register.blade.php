<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ایجاد حساب کاربری | ثبت‌نام</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="galaxy-bg min-h-screen px-4 py-10 sm:py-14">

<main class="mx-auto max-w-3xl">

    <!-- Header -->
    <header class="mb-8 text-center">
        <div class="mx-auto mb-5 flex h-16 w-16 items-center justify-center
                    rounded-2xl border border-white/30 bg-white/15
                    text-3xl text-white shadow-xl backdrop-blur-xl
                    transition duration-300 hover:scale-105 hover:bg-white/25">
            ✦
        </div>

        <h1 class="text-3xl font-extrabold tracking-tight text-white sm:text-4xl">
            ایجاد حساب کاربری
        </h1>

        <p class="mt-3 text-sm leading-7 text-white/75 sm:text-base">
            اطلاعات خود را وارد کنید و به جمع ما بپیوندید.
        </p>
    </header>

    <!-- Glass Form Card -->
    <section class="overflow-hidden rounded-3xl border border-white/25
                    bg-white/10 shadow-2xl shadow-black/20
                    backdrop-blur-2xl">

        <!-- Card Header -->
        <div class="border-b border-white/15 bg-white/5 px-6 py-6 sm:px-9">
            <h2 class="text-xl font-bold text-white">
                فرم ثبت‌نام
            </h2>

            <p class="mt-2 text-sm leading-6 text-white/70">
                فیلدهای ستاره‌دار الزامی هستند.
            </p>
        </div>

        <div class="p-6 sm:p-9">

            <!-- Success Message -->
            @if (session('success'))
                <div role="status"
                     class="mb-6 rounded-2xl border border-emerald-300/40
                            bg-emerald-400/15 px-4 py-4 text-sm
                            leading-6 text-emerald-50 shadow-lg backdrop-blur-md">
                    <div class="flex items-start gap-3">
                        <span class="text-lg">✓</span>
                        <p>{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            <!-- Validation Errors -->
            @if ($errors->any())
                <div role="alert"
                     class="mb-6 rounded-2xl border border-red-300/40
                            bg-red-400/15 px-4 py-4 text-sm
                            leading-6 text-red-50 shadow-lg backdrop-blur-md">
                    <p class="mb-2 font-bold">
                        لطفاً موارد زیر را بررسی کنید:
                    </p>

                    <ul class="list-inside list-disc space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('register.store') }}"
                  method="POST"
                  class="space-y-8">
                @csrf

                <!-- Personal Information -->
                <section>
                    <div class="mb-5 flex items-center gap-3">
                        <div class="flex h-10 w-10 items-center justify-center
                                    rounded-xl border border-white/20
                                    bg-white/10 text-lg text-white shadow-md">
                            ♙
                        </div>

                        <div>
                            <h3 class="font-bold text-white">
                                اطلاعات شخصی
                            </h3>
                            <p class="mt-1 text-xs text-white/60">
                                مشخصات هویتی خود را وارد کنید.
                            </p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">

                        <!-- First Name -->
                        <div>
                            <label for="first_name"
                                   class="mb-2 block text-sm font-medium text-white/90">
                                نام <span class="text-rose-300">*</span>
                            </label>

                            <input
                                type="text"
                                id="first_name"
                                name="first_name"
                                value="{{ old('first_name') }}"
                                placeholder=""
                                autocomplete="given-name"
                                maxlength="100"
                                required
                                class="w-full rounded-xl border border-white/25
                                       bg-white/10 px-4 py-3 text-white
                                       placeholder:text-white/45 shadow-sm
                                       outline-none backdrop-blur-md
                                       transition duration-200
                                       hover:border-white/45 hover:bg-white/15
                                       focus:border-indigo-300 focus:bg-white/15
                                       focus:ring-4 focus:ring-indigo-400/20"
                            >
                        </div>

                        <!-- Last Name -->
                        <div>
                            <label for="last_name"
                                   class="mb-2 block text-sm font-medium text-white/90">
                                نام خانوادگی <span class="text-rose-300">*</span>
                            </label>

                            <input
                                type="text"
                                id="last_name"
                                name="last_name"
                                value="{{ old('last_name') }}"
                                placeholder=""
                                autocomplete="family-name"
                                maxlength="100"
                                required
                                class="w-full rounded-xl border border-white/25
                                       bg-white/10 px-4 py-3 text-white
                                       placeholder:text-white/45 shadow-sm
                                       outline-none backdrop-blur-md
                                       transition duration-200
                                       hover:border-white/45 hover:bg-white/15
                                       focus:border-indigo-300 focus:bg-white/15
                                       focus:ring-4 focus:ring-indigo-400/20"
                            >
                        </div>

                        <!-- Mobile -->
                        <div>
                            <label for="mobile"
                                   class="mb-2 block text-sm font-medium text-white/90">
                                شماره موبایل <span class="text-rose-300">*</span>
                            </label>

                            <input
                                type="tel"
                                id="mobile"
                                name="mobile"
                                value="{{ old('mobile') }}"
                                placeholder="09123456789"
                                autocomplete="tel"
                                inputmode="numeric"
                                dir="ltr"
                                maxlength="11"
                                required
                                class="w-full rounded-xl border border-white/25
                                       bg-white/10 px-4 py-3 text-left text-white
                                       placeholder:text-white/45 shadow-sm
                                       outline-none backdrop-blur-md
                                       transition duration-200
                                       hover:border-white/45 hover:bg-white/15
                                       focus:border-indigo-300 focus:bg-white/15
                                       focus:ring-4 focus:ring-indigo-400/20"
                            >
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email"
                                   class="mb-2 block text-sm font-medium text-white/90">
                                ایمیل <span class="text-rose-300">*</span>
                            </label>

                            <input
                                type="email"
                                id="email"
                                name="email"
                                value="{{ old('email') }}"
                                placeholder="example@email.com"
                                autocomplete="email"
                                dir="ltr"
                                maxlength="255"
                                required
                                class="w-full rounded-xl border border-white/25
                                       bg-white/10 px-4 py-3 text-left text-white
                                       placeholder:text-white/45 shadow-sm
                                       outline-none backdrop-blur-md
                                       transition duration-200
                                       hover:border-white/45 hover:bg-white/15
                                       focus:border-indigo-300 focus:bg-white/15
                                       focus:ring-4 focus:ring-indigo-400/20"
                            >
                        </div>

                        <!-- Birth Date -->
                        <div>
                            <label for="birth_date"
                                   class="mb-2 block text-sm font-medium text-white/90">
                                تاریخ تولد <span class="text-rose-300">*</span>
                            </label>

                            <input
                                type="date"
                                id="birth_date"
                                name="birth_date"
                                value="{{ old('birth_date') }}"
                                autocomplete="bday"
                                required
                                class="w-full rounded-xl border border-white/25
                                       bg-white/10 px-4 py-3 text-white
                                       shadow-sm outline-none backdrop-blur-md
                                       transition duration-200
                                       hover:border-white/45 hover:bg-white/15
                                       focus:border-indigo-300 focus:bg-white/15
                                       focus:ring-4 focus:ring-indigo-400/20"
                            >
                        </div>

                        <!-- National ID -->
                        <div>
                            <label for="national_id"
                                   class="mb-2 block text-sm font-medium text-white/90">
                                کد ملی <span class="text-rose-300">*</span>
                            </label>

                            <input
                                type="text"
                                id="national_id"
                                name="national_id"
                                value="{{ old('national_id') }}"
                                placeholder="کد ملی ۱۰ رقمی"
                                inputmode="numeric"
                                autocomplete="off"
                                dir="ltr"
                                maxlength="10"
                                minlength="10"
                                required
                                class="w-full rounded-xl border border-white/25
                                       bg-white/10 px-4 py-3 text-left text-white
                                       placeholder:text-white/45 shadow-sm
                                       outline-none backdrop-blur-md
                                       transition duration-200
                                       hover:border-white/45 hover:bg-white/15
                                       focus:border-indigo-300 focus:bg-white/15
                                       focus:ring-4 focus:ring-indigo-400/20"
                            >
                        </div>

                    </div>
                </section>

                <!-- Password Information -->
                <section class="border-t border-white/15 pt-7">
                    <div class="mb-5 flex items-center gap-3">
                        <div class="flex h-10 w-10 items-center justify-center
                                    rounded-xl border border-white/20
                                    bg-white/10 text-lg text-white shadow-md">
                            ♙
                        </div>

                        <div>
                            <h3 class="font-bold text-white">
                                اطلاعات ورود
                            </h3>
                            <p class="mt-1 text-xs text-white/60">
                                برای حساب خود یک رمز عبور انتخاب کنید.
                            </p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">

                        <!-- Password -->
                        <div>
                            <label for="password"
                                   class="mb-2 block text-sm font-medium text-white/90">
                                رمز عبور <span class="text-rose-300">*</span>
                            </label>

                            <input
                                type="password"
                                id="password"
                                name="password"
                                placeholder="حداقل ۸ کاراکتر"
                                autocomplete="new-password"
                                minlength="8"
                                required
                                class="w-full rounded-xl border border-white/25
                                       bg-white/10 px-4 py-3 text-white
                                       placeholder:text-white/45 shadow-sm
                                       outline-none backdrop-blur-md
                                       transition duration-200
                                       hover:border-white/45 hover:bg-white/15
                                       focus:border-indigo-300 focus:bg-white/15
                                       focus:ring-4 focus:ring-indigo-400/20"
                            >
                        </div>

                        <!-- Password Confirmation -->
                        <div>
                            <label for="password_confirmation"
                                   class="mb-2 block text-sm font-medium text-white/90">
                                تکرار رمز عبور <span class="text-rose-300">*</span>
                            </label>

                            <input
                                type="password"
                                id="password_confirmation"
                                name="password_confirmation"
                                placeholder="رمز عبور را دوباره وارد کنید"
                                autocomplete="new-password"
                                minlength="8"
                                required
                                class="w-full rounded-xl border border-white/25
                                       bg-white/10 px-4 py-3 text-white
                                       placeholder:text-white/45 shadow-sm
                                       outline-none backdrop-blur-md
                                       transition duration-200
                                       hover:border-white/45 hover:bg-white/15
                                       focus:border-indigo-300 focus:bg-white/15
                                       focus:ring-4 focus:ring-indigo-400/20"
                            >
                        </div>

                    </div>

                    <p class="mt-3 text-xs leading-6 text-white/60">
                        برای امنیت بیشتر، از رمز عبور اختصاصی استفاده کنید.
                    </p>
                </section>

                <!-- Submit -->
                <div class="border-t border-white/15 pt-6">
                    <button
                        type="submit"
                        class="group flex w-full items-center justify-center gap-2
                               rounded-xl border border-indigo-300/30
                               bg-indigo-500 px-5 py-3.5 font-bold text-white
                               shadow-lg shadow-indigo-950/25
                               transition duration-300
                               hover:-translate-y-0.5 hover:bg-indigo-400
                               hover:shadow-xl hover:shadow-indigo-950/35
                               focus:outline-none focus:ring-4
                               focus:ring-indigo-300/30
                               active:translate-y-0"
                    >
                        <span>ایجاد حساب کاربری</span>
                        <span class="transition-transform duration-300 group-hover:-translate-x-1">
                            ←
                        </span>
                    </button>

                    <p class="mt-4 text-center text-xs leading-6 text-white/60">
                        با ثبت‌نام، اطلاعات واردشده برای ایجاد حساب کاربری استفاده می‌شوند.
                    </p>
                </div>

                <div class="text-center mt-6 text-white">
                    <span>قبلاً ثبت‌نام کرده‌اید؟</span>

                    <a href="{{ route('login') }}"
                       class="text-blue-400 hover:text-blue-300 font-semibold">
                        وارد شوید
                    </a>
                </div>

            </form>
        </div>
    </section>

    <footer class="mt-7 text-center text-xs text-white/60">
        سامانه ثبت‌نام
    </footer>

</main>

</body>
</html>

