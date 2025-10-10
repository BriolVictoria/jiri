<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body class="flex flex-col items-center justify-center">
<h1 class="text-center font-bold text-4xl mt-5">Récapitulatif du jiri : {!! $jiri->name !!}</h1>
<a href="{{ route('jiris.edit', $jiri->id) }}"
   class="shadow-2xl w-96 p-5 underline rounded-2xl hover:scale-105 transition-transform duration-200 mt-10 text-center">
    Modifier le jiri
</a>
</body>
</html>
