<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
</head>
<body>
    <h1>Listes des jiris</h1>
@foreach($jiris as $jiri)
    {{ $jiri->name }}
@endforeach
</body>
</html>
