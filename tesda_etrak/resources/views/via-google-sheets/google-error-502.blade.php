<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error 502! (Server Error)</title>
    @vite(['resources/css/e-trak/google-error-502.css'])
</head>
<body>
    <a href="//www.google.com/">
        <span id="logo" aria-label="Google"></span>
    </a>
    <p>
        <b>502.</b> <ins>That's an error.</ins>
    </p>
    <p>The server encountered a temporary error and could not complete your request.</p>
    <p>
        Please try again in 30 seconds. <ins>That's all we know.</ins>
        {"userId":1,"exception":"[object] (Google\\Service\\Exception(code: 502): 
    </p>
</body>
</html>