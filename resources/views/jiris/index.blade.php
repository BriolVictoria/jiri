<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body>
    <h1 class="font-bold text-3xl ml-5 mt-5">Listes des jiris</h1>
    <ul class="mt-5 ml-10 list-disc">
        @foreach($jiris as $jiri)
            <li><a href="{{ route('jiris.show', $jiri->id) }}">{{ $jiri->name }}</a></li>
        @endforeach
    </ul>

</body>
</html>
