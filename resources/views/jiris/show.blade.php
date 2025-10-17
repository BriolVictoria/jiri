<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body class="flex flex-col items-center justify-center">
<h1 class="text-center font-bold text-4xl mt-5">Récapitulatif du jiri</h1>
<p class="text-center text-2xl mt-5 font-bold">Nom : </p>
<p  class="text-center mt-5">{!! $jiri->name !!}</p>
<p class="text-center text-2xl mt-5 font-bold">Date : </p>
<p class="text-center mt-5">{!! $jiri->date !!}</p>
<p class="text-center text-2xl mt-5 font-bold">Description : </p>
<p class="text-center mt-5">{!! $jiri->description !!}</p>
<a href="{{ route('jiris.edit', $jiri->id) }}"
   class="shadow-2xl w-96 p-5 underline rounded-2xl hover:scale-105 transition-transform duration-200 mt-10 text-center">
    Modifier le jiri
</a>
</body>
</html>


