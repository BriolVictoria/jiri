{{--Composant pour le header--}}
@component('components.head', ['title' => 'Modifiez le jiri'])
@endcomponent

<body class="flex flex-col items-center bg-gray-50 min-h-screen p-6">

{{-- Menu --}}
@include('layout.app')


<h1 class="mt-10 text-3xl font-bold text-center text-gray-800">
    {{ __('edit-view.modify_the_jiri') }}
</h1>

<form action="{!! route('jiris.update', $jiri->id) !!}" method="post" class="mt-8 w-full max-w-3xl bg-white shadow-lg rounded-2xl p-8 flex flex-col gap-6">
    @csrf
    @method('PATCH')

    {{-- Message obligatoire --}}
    <p class="text-red-600 text-xs text-center">{{ __('login.fields_are_required') }}</p>

    {{-- Informations générales --}}
    <fieldset class="border border-gray-200 p-6 rounded-2xl flex flex-col gap-4">
        <legend class="text-2xl font-semibold px-2">Informations générales</legend>

        {{-- Nom --}}
        @component('components.form.fields.input', ['type' => 'text', 'value' => $jiri->name,'field_name' => 'name', 'placeholder' => 'Design Web', 'required' => 'required'])
            Nom<small class="text-red-600 ml-1">*</small>
        @endcomponent

        {{-- Date --}}
        @component('components.form.fields.input', ['type' => 'date', 'value' => $jiri->date,'field_name' => 'date'])
            Date<small class="text-red-600 ml-1">*</small>
        @endcomponent


        {{-- Description --}}
        @component('components.form.fields.textarea', ['field_name' => 'description'])
            Description
        @endcomponent

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
                @php
                    $homeworks = \App\Models\Homework::where('project_id', $project->id)
                        ->where('jiri_id', $jiri->id)
                        ->first();
                @endphp
                {{--@component('components.form.fields.input_checkbox', ['class_div' => 'flex items-center gap-2', 'field_name' => $project->id , 'id' => $project->name])
                    {!! $project->name !!}
                @endcomponent--}}
            <div class="flex items-center gap-2">
                <input class="project" type="checkbox" value="{{ $project->id }}"
                       name="projects[{{ $project->id }}]" id="project{{ $project->id }}"
                    {{ $homeworks ? 'checked' : '' }}>
                <label for="project{{ $project->id }}" class="font-medium">{{ $project->name }}</label>
            </div>
            @endforeach
        </div>
    </fieldset>

    {{-- Bouton --}}
    @component('components.form.buttons.button', ['class' => 'mt-6 bg-indigo-600 text-white font-semibold py-3 rounded-2xl shadow-lg hover:bg-indigo-700 transition-colors duration-200', 'text' => 'Modifiez le jiri'])
    @endcomponent
</form>

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

