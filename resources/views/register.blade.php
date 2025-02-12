<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
</head>
<body>
<h2>Register</h2>

@if ($errors->any())
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

<form action="{{ route('register') }}" method="POST">
    @csrf
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" value="{{ old('name') }}" required>
    <br>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" value="{{ old('email') }}" required>
    <br>

    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required>
    <br>

    <label for="password_confirmation">Confirm Password:</label>
    <input type="password" id="password_confirmation" name="password_confirmation" required>
    <br>

    <button type="submit">Register</button>
</form>

<p>
    Already have an account? <a href="{{ route('login') }}">Login here</a>.
</p>
</body>
</html>
