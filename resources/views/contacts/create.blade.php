<!doctype html>
<html lang="{!! App::getLocale() !!}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ __('create-view-contact.create_a_contact') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="flex flex-col items-center bg-gray-50 min-h-screen">

{{-- Menu --}}
@include('layout.app')

{{-- Titre --}}
<h1 class="mt-10 text-4xl font-bold text-center text-gray-800">
    {{ __('create-view-contact.create_a_contact') }}
</h1>

{{-- Formulaire --}}
<form enctype="multipart/form-data" action="{!! route('contacts.store') !!}" method="post"
      class="mt-8 w-full max-w-lg bg-white shadow-lg rounded-2xl p-8 flex flex-col gap-5">
    @csrf

    {{-- Message obligatoire --}}
    <p class="text-red-600 text-xs text-center">{{ __('login.fields_are_required') }}</p>

    {{-- Nom --}}
    <div class="flex flex-col">
        <label for="name" class="font-bold text-gray-700">Nom <span class="text-red-600">*</span></label>
        <input type="text" name="name" id="name" value="{{ old('name') }}"
               placeholder="Pedro Pascal"
               class="mt-2 border border-gray-300 rounded-xl p-3 focus:outline-none focus:ring-2 focus:ring-indigo-500">
        @error('name')
        <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>

    {{-- Email --}}
    <div class="flex flex-col">
        <label for="email" class="font-bold text-gray-700">Email <span class="text-red-600">*</span></label>
        <input type="email" name="email" id="email" value="{{ old('email') }}"
               placeholder="pedro.pascal@gmail.com"
               class="mt-2 border border-gray-300 rounded-xl p-3 focus:outline-none focus:ring-2 focus:ring-indigo-500">
        @error('email')
        <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>

    {{-- Avatar --}}
    <div class="flex flex-col">
        <label for="avatar" class="font-bold text-gray-700">Avatar</label>
        <input type="file" name="avatar" id="avatar"
               class="mt-2 border border-gray-300 rounded-xl p-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
        @error('avatar')
        <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>

    {{-- Bouton --}}
    <button type="submit"
            class="mt-5 bg-indigo-600 text-white font-semibold py-3 rounded-2xl shadow-lg hover:bg-indigo-700 transition-colors duration-200">
        {!! __('create-view-contact.create_a_contact_button') !!}
    </button>

</form>
</body>
</html>
