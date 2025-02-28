<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-TRAK - Sign In</title>
    @vite(['resources/css/login/style.css'])
</head>
<body>
    <div class="form-box">
        <form action="" method="POST">
            <div class="form-header">
                <h1>Sign In</h1>
            </div>
            <div class="input-box">
                <input type="text" class="input-field" name="name" placeholder="Username" required />
            </div>
            <div class="input-box">
                <input type="password" class="input-field" name="password" placeholder="Password" required />
            </div>
            <div class="input-submit">
                <button type="submit" class="submit-btn" name="login" id="confirm">
                    <label for="confirm">Confirm</label>
                </button>
            </div>
            <div class="action-link">
                <p>Create an account <a href="{{ route('login.register') }}">here</a>.</p>
            </div>
        </form>
    </div>
</body>
</html>