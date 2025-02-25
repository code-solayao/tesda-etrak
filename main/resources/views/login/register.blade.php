<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>E-TRAK - Create account</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div class="form-box">
        <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
            <div class="form-header">
                <h1>New Account</h1>
            </div>
            <div class="input-box">
                <input type="text" class="input-field" name="username" placeholder="Username" required />
            </div>
            <div class="input-box">
                <input type="password" class="input-field" name="password" placeholder="Password" required />
            </div>
            <div class="input-submit">
                <button type="submit" class="submit-btn" name="register" id="submit">
                    <label for="submit">Create</label>
                </button>
            </div>
            <div class="action-link">
                <p>Return to <a href="index.php">login</a>.</p>
            </div>
        </form>
    </div>
</body>
</html>