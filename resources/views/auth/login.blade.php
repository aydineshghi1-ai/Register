<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ورود به حساب کاربری</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Tahoma, sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
            background:
                radial-gradient(ellipse at 20% 20%, #2563eb 0%, transparent 40%),
                radial-gradient(ellipse at 80% 80%, #1e40af 0%, transparent 45%),
                linear-gradient(135deg, #020617, #0f172a, #172554);
            background-size: 200% 200%;
            animation: galaxy 12s ease infinite;
        }

        @keyframes galaxy {
            0%, 100% { background-position: 0% 0%; }
            50% { background-position: 100% 100%; }
        }

        .login-card {
            width: 100%;
            max-width: 430px;
            padding: 40px 32px;
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 24px;
            background: rgba(255, 255, 255, 0.09);
            backdrop-filter: blur(18px);
            -webkit-backdrop-filter: blur(18px);
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            color: white;
        }

        .header {
            text-align: center;
            margin-bottom: 32px;
        }

        .header h1 {
            font-size: 25px;
            margin-bottom: 12px;
        }

        .header p {
            font-size: 13px;
            color: #cbd5e1;
        }

        .form-group {
            margin-bottom: 22px;
        }

        label {
            display: block;
            font-size: 14px;
            margin-bottom: 10px;
            color: #e2e8f0;
        }

        input {
            width: 100%;
            padding: 14px 16px;
            border-radius: 12px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            outline: none;
            background: rgba(255, 255, 255, 0.08);
            color: white;
            font-size: 14px;
            transition: 0.25s;
        }

        input::placeholder {
            color: #94a3b8;
        }

        input:focus {
            border-color: #60a5fa;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.2);
        }

        .error {
            color: #fca5a5;
            font-size: 12px;
            margin-top: 8px;
        }

        .login-button {
            width: 100%;
            padding: 14px;
            border: none;
            border-radius: 12px;
            background: linear-gradient(135deg, #2563eb, #3b82f6);
            color: white;
            font-size: 15px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.25s;
        }

        .login-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(37, 99, 235, 0.4);
        }

        .footer {
            text-align: center;
            margin-top: 26px;
            font-size: 13px;
            color: #cbd5e1;
        }

        .footer a {
            color: #93c5fd;
            text-decoration: none;
            font-weight: bold;
        }

        .footer a:hover {
            color: white;
        }

        @media (max-width: 480px) {
            .login-card {
                padding: 32px 22px;
            }

            .header h1 {
                font-size: 22px;
            }
        }
    </style>
</head>

<body>

<div class="login-card">

    <div class="header">
        <h1>خوش آمدید</h1>
        <p>برای ورود به حساب کاربری خود اطلاعات زیر را وارد کنید.</p>
    </div>

    <form action="{{ route('login.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="email">آدرس ایمیل</label>

            <input
                type="email"
                id="email"
                name="email"
                value="{{ old('email') }}"
                placeholder="example@gmail.com"
                autocomplete="email"
                required
            >

            @error('email')
            <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="password">رمز عبور</label>

            <input
                type="password"
                id="password"
                name="password"
                placeholder="رمز عبور خود را وارد کنید"
                autocomplete="current-password"
                required
            >

            @error('password')
            <p class="error">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="login-button">
            ورود به حساب
        </button>
    </form>

    <div class="footer">
        حساب کاربری ندارید؟
        <a href="{{ route('register') }}">ثبت‌نام کنید</a>
    </div>

</div>

</body>
</html>
