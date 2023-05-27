
<body class="login-page">
<div class="login-box">
    <h2 class="heading-login-box">Login</h2>
    <form method="post" action="{{ route('signin') }}">
        @csrf
        <div class="user-box">
            <input class="user-box-input" name="user_name" type="text" value="{{ old('user_name') }}" required>
            <label class="user-box-label">Username</label>
            @error('user_name')
            <span class='label-text'>{{ $message }}</span>
            @enderror
        </div>
        <div class="user-box">
            <input class="user-box-input" name="password" type="password" required>
            <label class="user-box-label">Password</label>
        </div>
        <button class="login-box-button" type="submit">Submit</button>
    </form>
    <p>
        <a href="{{ route('signup') }}" style="color: white; text-decoration: none;" class="text">Sign up</a>
    </p>
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
