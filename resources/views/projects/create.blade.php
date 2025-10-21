<!doctype html>
<html lang="{!! App::getLocale() !!}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Créez un projet</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="flex flex-col items-center bg-gray-50 min-h-screen p-6">
@include('layout.app')

<h1 class="mt-10 text-4xl font-bold text-center text-gray-800">
    Créez un projet
</h1>

<form enctype="multipart/form-data" action="{!! route('projects.store') !!}" method="post"
      class="mt-8 w-full max-w-lg bg-white shadow-lg rounded-2xl p-8 flex flex-col gap-6">
    @csrf

    {{-- Message obligatoire --}}
    <p class="text-red-600 text-xs text-center">Les champs * sont des champs requis</p>

    {{-- Nom du projet --}}
    <div class="flex flex-col">
        <label for="name" class="font-bold text-gray-700">Nom <span class="text-red-600">*</span></label>
        <input type="text" name="name" id="name" value="{{ old('name') }}"
               placeholder="Pedro Pascal"
               class="mt-2 border border-gray-300 rounded-xl p-3 focus:outline-none focus:ring-2 focus:ring-indigo-500">
        @error('name')
        <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>

    {{-- Bouton --}}
    <button type="submit"
            class="mt-6 bg-indigo-600 text-white font-semibold py-3 rounded-2xl shadow-lg hover:bg-indigo-700 transition-colors duration-200">
        Créez un projet
    </button>
</form>
</body>
</html>
