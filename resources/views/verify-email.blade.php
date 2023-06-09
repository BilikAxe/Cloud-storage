
<body class="login-page">
    @if (session('status'))
        <div class="flex gap-3 rounded-md border border-green-500 bg-green-50 p-4 mb-6">
            <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm13.36-1.814a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z" clip-rule="evenodd" />
            </svg>
            <h3 class="text-sm font-medium text-green-800">{{ session('status') }}</h3>
        </div>
    @endif
    <div class="login-box">
        <h2 class="heading-login-box">Verify Email</h2>
        <form method="post" action="{{ route('verification.send') }}">
            @csrf
            <button class="login-box-button" type="submit">Resend verification link</button>
        </form>
    </div>
</body>


<style>

    .label-text {
        color: red;
    }

    .login-page {
        font-family: sans-serif;
        background: #243b55;
    }

    .login-box {
        position: absolute;
        top: 50%;
        left: 50%;
        width: 350px;
        padding: 50px;
        transform: translate(-50%, -50%);
        background: rgba(0, 0, 0, 0.5);
        border-radius: 10px;
    }

    .heading-login-box {
        margin-top: 20px;
        margin-bottom: 20px;
        color: #fff;
        text-align: center;
    }

    .user-box {
        position: relative;
    }

    .user-box-input {
        width: 100%;
        padding: 10px 0;
        font-size: 14px;
        color: #fff;
        margin-bottom: 30px;
        border: none;
        border-bottom: 1px solid #fff;
        outline: none;
        background: transparent;
    }

    .user-box-label {
        position: absolute;
        top: 0;
        left: 0;
        padding: 10px 0;
        font-size: 14px;
        color: #fff;
        pointer-events: none;
        transition: 0.5s;
    }

    .login-box .user-box input:focus~label,
    .login-box .user-box input:valid~label {
        top: -20px;
        left: 0;
        color: #8ab0df;
        font-size: 12px;
    }

    .login-box-button {
        cursor: pointer;
        position: relative;
        display: inline-block;
        padding: 10px 20px;
        color: black;
        font-size: 14px;
        text-decoration: none;
        overflow: hidden;
        transition: .5s;
        margin-top: 30px;
        background: #8ab0df;
        border-radius: 10px;
    }

    .login-box a:hover {
        background: #8ab0df;
        color: #fff;
    }

    .login-box a span {
        position: absolute;
        display: block;
    }

    @media screen and (max-width: 576px) and (min-width: 400px) {
        .login-box {
            width: 250px;
        }
    }

    @media screen and (max-width: 400px) {
        .login-box {
            width: 200px;
        }

        .heading-login-box {
            font-size: 16px !important;
        }

        .user-box-input {
            font-size: 12px;
        }

        .user-box-label {
            font-size: 12px;
        }
        .login-box-button {
            font-size: 12px;
        }
    }
</style>
