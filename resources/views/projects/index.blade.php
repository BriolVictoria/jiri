<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body class="flex flex-col items-center">

{{--Menu--}}
@include('layout.app')

{{-- SVG + Titre --}}
<div class="flex flex-col items-center mt-10">
    <svg version="1.1" id="Uploaded to svgrepo.com" xmlns="http://www.w3.org/2000/svg"
         xmlns:xlink="http://www.w3.org/1999/xlink"
         width="50px" height="50px" viewBox="0 0 32 32" xml:space="preserve">
            <path class="puchipuchi_een" d="M29,2H3C1.9,2,1,2.9,1,4v19c0,1.1,0.9,2,2,2h26c1.1,0,2-0.9,2-2V4C31,2.9,30.1,2,29,2z M29,20
                c0,0.55-0.45,1-1,1H4c-0.55,0-1-0.45-1-1V5c0-0.55,0.45-1,1-1h24c0.55,0,1,0.45,1,1V20z M22,29c0,0.552-0.447,1-1,1H11
                c-0.553,0-1-0.448-1-1s0.447-1,1-1h1v-2h8v2h1C21.553,28,22,28.448,22,29z M22,14c0,0.552-0.447,1-1,1H11c-0.553,0-1-0.448-1-1
                s0.447-1,1-1h10C21.553,13,22,13.448,22,14z M22,10c0,0.552-0.447,1-1,1H11c-0.553,0-1-0.448-1-1s0.447-1,1-1h10
                C21.553,9,22,9.448,22,10z"/>
        </svg>

    <h1 class="mt-4 text-4xl font-bold text-center text-gray-800">
        Liste des projets
    </h1>
</div>

{{--Créer un nouveau--}}
<div class="mt-6 mb-4">
    <a href="{{ route('projects.create') }}"
       class="bg-indigo-600 text-white font-semibold px-6 py-3 rounded-xl shadow-lg hover:bg-indigo-700 transition-colors duration-200">
        Créer un nouveau projet
    </a>
</div>


{{--Début du tableau--}}
<table class="mt-8 ml-10 min-w-[400px] border-separate border-spacing-0 rounded-2xl shadow-lg overflow-hidden">
    <thead>
    <tr class="bg-gray-100 text-gray-700 uppercase text-sm font-semibold">
        <th class="px-6 py-4 text-left border-b border-gray-200">Numéro</th>
        <th class="px-6 py-4 text-left border-b border-gray-200">Nom du projet</th>
    </tr>
    </thead>
    <tbody>
    @foreach($projects as $project)
        <tr class="hover:bg-indigo-50 transition-all duration-200 border-b border-gray-100">
            <td class="px-6 py-4 font-medium text-gray-700">
                {{ $loop->iteration }}
            </td>
            <td class="px-6 py-4">
                <a class="text-indigo-600 hover:text-indigo-800 font-medium underline-offset-2 hover:underline" href="{{ route('projects.show', $project->id) }}">{{ $project->name }}</a></td>
        </tr>
    @endforeach
    </tbody>
</table>


</body>
</html>
