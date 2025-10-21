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
    <svg fill="#000000" width="50px" height="50px" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg">
        <path
            d="M16 15.503A5.041 5.041 0 1 0 16 5.42a5.041 5.041 0 0 0 0 10.083zm0 2.215c-6.703 0-11 3.699-11 5.5v3.363h22v-3.363c0-2.178-4.068-5.5-11-5.5z"/>
    </svg>
    <h1 class="mt-4 text-4xl font-bold text-center text-gray-800">
        Liste des contacts
    </h1>
</div>

{{--Créer un nouveau--}}
<div class="mt-6 mb-4">
    <a href="{{ route('contacts.create') }}"
       class="bg-indigo-600 text-white font-semibold px-6 py-3 rounded-xl shadow-lg hover:bg-indigo-700 transition-colors duration-200">
        Créer un nouveau contact
    </a>
</div>

{{--Début du tableau--}}

<table class="mt-8 ml-10 min-w-[400px] border-separate border-spacing-0 rounded-2xl shadow-lg overflow-hidden">
    <thead>
    <tr class="bg-gray-100 text-gray-700 uppercase text-sm font-semibold">
        <th class="px-6 py-4 text-left border-b border-gray-200">Numéro</th>
        <th class="px-6 py-4 text-left border-b border-gray-200">Nom du contact</th>
    </tr>
    </thead>
    <tbody>
    @foreach($contacts as $contact)
        <tr class="hover:bg-indigo-50 transition-all duration-200 border-b border-gray-100">

            <td class="px-6 py-4 font-medium text-gray-700">
                {{ $loop->iteration }}
            </td>
            <td class="px-6 py-4">
                <a class="text-indigo-600 hover:text-indigo-800 font-medium underline-offset-2 hover:underline"
                   href="{{ route('contacts.show', $contact->id) }}">{{ $contact->name }}</a></td>
        </tr>
    @endforeach
    </tbody>

</table>

</body>
</html>
