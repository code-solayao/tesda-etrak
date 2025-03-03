<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>E-TRAK - Sign In</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/login/style.css') }}">
</head>
<body>
    <div class="form-box">
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="form-header">
                <h1>Sign In</h1>
            </div>
            <div class="input-box">
                <input type="email" class="input-field" name="email" placeholder="E-mail" required>
            </div>
            <div class="input-box">
                <input type="password" class="input-field" name="password" placeholder="Password" required>
            </div>
            <div class="input-submit">
                <button type="submit" class="submit-btn" id="login" name="login">
                    <label for="login">Confirm</label>
                </button>
            </div>
            <div class="action-link">
                <p>Create an account <a href="{{ route('signup-page') }}">here</a>.</p>
            </div>
        </form>
    </div>
</body>
</html>