
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Welcome | Register Project</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: Tahoma, sans-serif;
            color: #fff;
            background:
                radial-gradient(circle at 20% 20%, #164e8a 0%, transparent 35%),
                radial-gradient(circle at 80% 80%, #312e81 0%, transparent 40%),
                linear-gradient(135deg, #020617, #0f172a, #172554);
            overflow: hidden;
        }

        .welcome-card {
            width: min(90%, 480px);
            padding: 45px 35px;
            text-align: center;
            border: 1px solid rgba(255,255,255,.15);
            border-radius: 24px;
            background: rgba(255,255,255,.07);
            backdrop-filter: blur(18px);
            box-shadow: 0 20px 60px rgba(0,0,0,.35);
            animation: appear .8s ease;
        }

        .icon {
            font-size: 55px;
            margin-bottom: 25px;
        }

        h1 {
            font-size: 27px;
            margin-bottom: 18px;
        }

        .username {
            color: #60a5fa;
        }

        .description {
            color: #cbd5e1;
            line-height: 2;
            font-size: 14px;
            margin-bottom: 30px;
        }

        .user-info {
            padding: 15px;
            margin-bottom: 28px;
            border-radius: 12px;
            background: rgba(255,255,255,.06);
            color: #e2e8f0;
            font-size: 14px;
            line-height: 2;
        }

        .logout-btn {
            width: 100%;
            padding: 14px;
            border: none;
            border-radius: 12px;
            background: linear-gradient(135deg, #2563eb, #4f46e5);
            color: white;
            font-size: 15px;
            font-weight: bold;
            cursor: pointer;
            transition: .3s;
        }

        .logout-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(37,99,235,.4);
        }

        @keyframes appear {
            from {
                opacity: 0;
                transform: translateY(25px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width: 480px) {
            .welcome-card {
                padding: 35px 22px;
            }

            h1 {
                font-size: 23px;
            }
        }
    </style>
</head>

<body>

<main class="welcome-card">

    <div class="icon">✦</div>

    <h1>
        خوش آمدی
        <span class="username">
                {{ auth()->user()->first_name }}
            </span>
        !
    </h1>

    <p class="description">
        ورود شما با موفقیت انجام شد.
        <br>
        به پنل کاربری خود خوش آمدید.
    </p>

    <div class="user-info">
        <p>
            نام و نام خانوادگی:
            {{ auth()->user()->first_name }}
            {{ auth()->user()->last_name }}
        </p>

        <p>
            ایمیل:
            {{ auth()->user()->email }}
        </p>
    </div>

    <form action="{{ route('logout') }}" method="POST">
        @csrf

        <button type="submit" class="logout-btn">
            خروج از حساب کاربری
        </button>
    </form>

</main>

</body>
</html>
