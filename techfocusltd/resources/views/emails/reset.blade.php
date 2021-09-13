<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
</head>

<body>
<h2>Welcome to Techfocus Ltd</h2>
<br/>
Hello!
<br/>
You are receiving this email because we received a password reset request for your account.
<br/>
<a href="{{url('/reset/verify', $reset->token)}}">Reset Password</a>
<br/>
If you did not request a password reset, no further action is required.
<br/>

Regards,
<br/>
Offtica
</body>

</html>