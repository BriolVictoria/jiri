{{--Composant pour le header--}}
@component('components.head', ['title' => 'Créez un jiri'])
@endcomponent

<body class="flex flex-col items-center bg-gray-50 min-h-screen p-6">

{{-- Menu --}}
@include('layout.app')

{{-- Titre --}}
<h1 class="mt-10 text-4xl font-bold text-center text-gray-800">
    {!! __('headings.create_a_jiri') !!}
</h1>

{{-- Formulaire --}}


<form enctype="multipart/form-data" action="{!! route('jiris.store') !!}" method="post" class="mt-8 w-full max-w-3xl bg-white shadow-lg rounded-2xl p-8 flex flex-col gap-6">
    @csrf

    {{-- Message obligatoire --}}
    <p class="text-red-600 text-xs text-center">{{ __('login.fields_are_required') }}</p>

    {{-- Informations générales --}}
    <fieldset class="border border-gray-200 p-6 rounded-2xl">
        <legend class="text-2xl font-semibold px-2">Informations générales</legend>

        {{-- Nom --}}
        @component('components.form.fields.input', ['type' => 'text', 'field_name' => 'name', 'placeholder' => 'Design Web', 'required' => 'required'])
            Nom<small class="text-red-600 ml-1">*</small>
        @endcomponent

        {{-- Date --}}
        @component('components.form.fields.input', ['type' => 'date', 'field_name' => 'date', 'required' => 'required'])
            Date<small class="text-red-600 ml-1">*</small>
        @endcomponent

        {{-- Description --}}
        @component('components.form.fields.textarea', ['field_name' => 'description'])
            Description
        @endcomponent
        {{--Bien récupérer la value !!--}}

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
                {{--@component('components.form.fields.input_checkbox', ['class_div' => 'flex items-center gap-2', 'field_name' => $project->id , 'id' => $project->name])
                {!! $project->name !!}
                @endcomponent--}}
                <div class="flex items-center gap-2">
                    <input class="project" type="checkbox" value="{{ $project->id }}"
                           name="projects[{{ $project->id }}]" id="project{{ $project->id }}">
                    <label for="project{{ $project->id }}" class="font-medium">{{ $project->name }}</label>
                </div>

            @endforeach
        </div>
    </fieldset>

    {{-- Bouton --}}
    @component('components.form.buttons.button', ['class' => 'mt-6 bg-indigo-600 text-white font-semibold py-3 rounded-2xl shadow-lg hover:bg-indigo-700 transition-colors duration-200', 'text' => 'Créez un jiri'])
    @endcomponent
</form>

{{-- Script pour activer/désactiver les selects --}}
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const checkboxes = document.querySelectorAll('.contact');

        checkboxes.forEach(checkbox => {
            const id = checkbox.value;
            const select = document.getElementById(`role${id}`);

            checkbox.checked ? select.disabled = false : select.disabled = true;

            checkbox.addEventListener('change', () => {
                checkbox.checked ? select.disabled = false : select.disabled = true;
            });
        });
    });
</script>

</body>

{{--Composant pour le footer--}}
@component('components.footer')
@endcomponent

