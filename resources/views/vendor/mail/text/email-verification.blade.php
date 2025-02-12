<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification</title>
</head>

<body>
    <p>Hello {{ $user->fname }},</p>

    <p>Thank you for registering with us. Please verify your email by clicking the link below:</p>

    <a href="{{ $verificationUrl }}">Verify Email</a>

    <p>If you did not create an account, no further action is required.</p>

    <p>Regards,<br> {{ config('app.name') }}</p>

</body>

</html>