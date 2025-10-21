<!doctype html>
<html lang="{!! App::getLocale() !!}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Modifier le Jiri</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="flex flex-col items-center bg-gray-50 min-h-screen p-6">
@include('layout.app')

<h1 class="mt-10 text-3xl font-bold text-center text-gray-800">
    {{ __('edit-view.modify_the_jiri') }}
</h1>

<form action="{!! route('jiris.update', $jiri->id) !!}" method="post" class="mt-8 w-full max-w-3xl bg-white shadow-lg rounded-2xl p-8 flex flex-col gap-6">
    @csrf
    @method('PATCH')

    <p class="text-red-600 text-xs text-center">Les champs * sont obligatoires</p>

    {{-- Informations générales --}}
    <fieldset class="border border-gray-200 p-6 rounded-2xl flex flex-col gap-4">
        <legend class="text-2xl font-semibold px-2">Informations générales</legend>

        <div class="flex flex-col">
            <label for="name" class="font-bold text-gray-700">Nom <span class="text-red-600">*</span></label>
            <input type="text" name="name" id="name" value="{{ $jiri->name }}"
                   placeholder="Design Web"
                   class="mt-2 border border-gray-300 rounded-xl p-3 focus:outline-none focus:ring-2 focus:ring-indigo-500">
            @error('name')
            <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex flex-col">
            <label for="date" class="font-bold text-gray-700">Date <span class="text-red-600">*</span></label>
            <input type="date" name="date" id="date" value="{{ $jiri->date }}"
                   class="mt-2 border border-gray-300 rounded-xl p-3 focus:outline-none focus:ring-2 focus:ring-indigo-500">
            @error('date')
            <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex flex-col">
            <label for="description" class="font-bold text-gray-700">Description</label>
            <textarea name="description" id="description" rows="4"
                      class="mt-2 border border-gray-300 rounded-xl p-3 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                      placeholder="Jury des élèves de B2...">{{ $jiri->description }}</textarea>
            @error('description')
            <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
    </fieldset>

    {{-- Contacts --}}
    <fieldset class="border border-gray-200 p-6 rounded-2xl flex flex-col gap-3">
        <legend class="text-2xl font-semibold px-2">Contacts</legend>
        <div class="flex flex-col gap-2 mt-2">
            @foreach($contacts as $contact)
                @php
                    $attendance = \App\Models\Attendance::where('contact_id', $contact->id)
                        ->where('jiri_id', $jiri->id)
                        ->first();
                @endphp
                <div class="flex items-center justify-between border-b border-gray-100 py-2">
                    <div class="flex items-center gap-2">
                        <input class="contact" type="checkbox" value="{{ $contact->id }}"
                               name="contacts[{{ $contact->id }}]" id="contact{{ $contact->id }}"
                            {{ $attendance ? 'checked' : '' }}>
                        <label for="contact{{ $contact->id }}" class="font-medium">{{ $contact->name }}</label>
                    </div>
                    <select id="role{{ $contact->id }}" name="contacts[{{ $contact->id }}][role]"
                            class="border border-gray-300 rounded-xl p-2 disabled:opacity-50"
                        {{ $attendance ? '' : 'disabled' }}>
                        @foreach(\App\Enums\ContactRoles::cases() as $role)
                            <option value="{{ $role->value }}" {{ $attendance && $attendance->role === $role->value ? 'selected' : '' }}>
                                {{ $role->value }}
                            </option>
                        @endforeach
                    </select>
                </div>
            @endforeach
        </div>
    </fieldset>

    {{-- Projets --}}
    <fieldset class="border border-gray-200 p-6 rounded-2xl flex flex-col gap-2">
        <legend class="text-2xl font-semibold px-2">Projets</legend>
        <div class="flex flex-col gap-2 mt-2">
            @foreach($projects as $project)
                <div class="flex items-center gap-2">
                    <input type="checkbox" value="1" name="projects[{{ $project->id }}]" id="projet{{ $project->id }}">
                    <label for="projet{{ $project->id }}" class="font-medium">{{ $project->name }}</label>
                </div>
            @endforeach
        </div>
    </fieldset>

    {{-- Bouton --}}
    <button type="submit"
            class="mt-6 bg-indigo-600 text-white font-semibold py-3 rounded-2xl shadow-lg hover:bg-indigo-700 transition-colors duration-200">
        Modifier le Jiri
    </button>
</form>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const checkboxes = document.querySelectorAll('.contact');
        checkboxes.forEach(checkbox => {
            const id = checkbox.value;
            const select = document.getElementById(`role${id}`);
            select.disabled = !checkbox.checked;
            checkbox.addEventListener('change', () => select.disabled = !checkbox.checked);
        });
    });
</script>

</body>
</html>
