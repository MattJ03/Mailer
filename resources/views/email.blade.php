<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Email</title>
</head>
<body>
<h1>Welcome to my site {{$user->name}}</h1>
<p>Thanks for joining! Find further access to the app below</p>
<button onclick="{{ route('tasks.index') }}"></button>
</body>
</html>
