<h3>Hello {{ $name }}</h3>
<p>Welcome, click the button below to verify your account.</p>

<a href="{{ route('email.verify', $token) }}">
    <button style="background-color: #0c63e4; color: #fff; font-size:15px;">Verify</button>
</a>
