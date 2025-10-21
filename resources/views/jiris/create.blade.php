<!doctype html>
<html lang="{!! app()->getLocale() !!}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{!! __('headings.create_a_jiri') !!}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="flex flex-col items-center bg-gray-50 min-h-screen p-6">
@include('layout.app')

<h1 class="mt-10 text-4xl font-bold text-center text-gray-800">
    {!! __('headings.create_a_jiri') !!}
</h1>

<form action="{!! route('jiris.store') !!}" method="post" class="mt-8 w-full max-w-3xl bg-white shadow-lg rounded-2xl p-8 flex flex-col gap-6">
    @csrf

    <p class="text-red-600 text-xs text-center">{{ __('login.fields_are_required') }}</p>

    {{-- Informations générales --}}
    <fieldset class="border border-gray-200 p-6 rounded-2xl">
        <legend class="text-2xl font-semibold px-2">Informations générales</legend>

        <div class="flex flex-col my-3">
            <label for="name" class="font-bold text-gray-700">Nom <span class="text-red-600">*</span></label>
            <input type="text" name="name" id="name" value="{{ old('name') }}"
                   placeholder="Design Web"
                   class="mt-2 border border-gray-300 rounded-xl p-3 focus:outline-none focus:ring-2 focus:ring-indigo-500">
            @error('name')
            <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex flex-col my-3">
            <label for="date" class="font-bold text-gray-700">Date <span class="text-red-600">*</span></label>
            <input type="date" name="date" id="date" value="{{ old('date') }}"
                   class="mt-2 border border-gray-300 rounded-xl p-3 focus:outline-none focus:ring-2 focus:ring-indigo-500">
            @error('date')
            <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex flex-col my-3">
            <label for="description" class="font-bold text-gray-700">Description</label>
            <textarea name="description" id="description" rows="3"
                      class="mt-2 border border-gray-300 rounded-xl p-3 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                      placeholder="Description du Jiri">{{ old('description') }}</textarea>
            @error('description')
            <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
    </fieldset>

    {{-- Contacts --}}
    <fieldset class="border border-gray-200 p-6 rounded-2xl">
        <legend class="text-2xl font-semibold px-2">Contacts</legend>
        <div class="flex flex-col gap-3 mt-3">
            @foreach($contacts as $contact)
                <div class="flex items-center justify-between border-b border-gray-100 py-2">
                    <div class="flex items-center gap-2">
                        <input class="contact" value="{!! $contact->id !!}" type="checkbox"
                               name="contacts[{!! $contact->id !!}]" id="contact{!! $contact->id !!}">
                        <label for="contact{!! $contact->id !!}" class="font-medium">{{ $contact->name }}</label>
                    </div>
                    <select id="role{!! $contact->id !!}" name="contacts[{!! $contact->id !!}][role]"
                            class="border border-gray-300 rounded-xl p-2 disabled:opacity-50"
                            disabled>
                        <option value="evaluated">Evalué</option>
                        <option value="evaluator">Evaluateur</option>
                    </select>
                </div>
            @endforeach
        </div>
    </fieldset>

    {{-- Projets --}}
    <fieldset class="border border-gray-200 p-6 rounded-2xl">
        <legend class="text-2xl font-semibold px-2">Projets</legend>
        <div class="flex flex-col gap-2 mt-3">
            @foreach($projects as $project)
                <div class="flex items-center gap-2">
                    <input value="1" type="checkbox" name="projects[{!! $project->id !!}]"
                           id="projet{!! $project->id !!}">
                    <label for="projet{!! $project->id !!}" class="font-medium">{{ $project->name }}</label>
                </div>
            @endforeach
        </div>
    </fieldset>

    {{-- Bouton de soumission --}}
    <button type="submit"
            class="mt-6 bg-indigo-600 text-white font-semibold py-3 rounded-2xl shadow-lg hover:bg-indigo-700 transition-colors duration-200">
        {!! __('labels-buttons.create_a_jiri') !!}
    </button>
</form>

{{-- Script pour activer/désactiver les selects --}}
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const checkboxes = document.querySelectorAll('.contact');

        checkboxes.forEach(checkbox => {
            const id = checkbox.value;
            const select = document.getElementById(role${id});

            checkbox.checked ? select.disabled = false : select.disabled = true;

            checkbox.addEventListener('change', () => {
                checkbox.checked ? select.disabled = false : select.disabled = true;
            });
        });
    });
</script>

</body>
</html>
