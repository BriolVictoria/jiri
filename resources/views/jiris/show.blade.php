<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
</head>
<body>
<h1>Récapitulatif du jiri : {!! $jiri->name !!}</h1>
<a href="{{ route('jiris.edit', $jiri->id) }}">Modifier le jiri</a>
</body>
</html>
