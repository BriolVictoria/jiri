{{--Composant pour le header--}}
@component('components.head', ['title' => 'Créez un contact'])
@endcomponent

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
    @component('components.form.fields.input', ['type' => 'name', 'field_name' => 'name', 'placeholder' => 'Pedro Pascal', 'required' => 'required'])
        Nom<small class="text-red-600 ml-1">*</small>
    @endcomponent

    {{-- Email --}}
    @component('components.form.fields.input', ['type' => 'email', 'field_name' => 'email', 'placeholder' => 'pedro.pascal@gmail.com', 'required' => 'required'])
        Email<small class="text-red-600 ml-1">*</small>
    @endcomponent


    {{-- Avatar --}}
    @component('components.form.fields.input', ['type' => 'file', 'field_name' => 'avatar'])
        Avatar
    @endcomponent

    {{-- Projets --}}
    <fieldset class="border border-gray-200 p-6 rounded-2xl">
        <legend class="text-2xl font-semibold px-2">Jiris</legend>
        <div class="flex flex-col gap-2 mt-3">
            @foreach($jiris as $jiri)
                {{--@component('components.form.fields.input_checkbox', ['class_div' => 'flex items-center gap-2', 'field_name' => $project->id , 'id' => $project->name])
                {!! $project->name !!}
                @endcomponent--}}
                <div class="flex items-center gap-2">
                    <input class="project" type="checkbox" value="{{ $jiri->id }}"
                           name="projects[{{ $jiri->id }}]" id="project{{ $jiri->id }}">
                    <label for="project{{ $jiri->id }}" class="font-medium">{{ $jiri->name }}</label>
                </div>

            @endforeach
        </div>
    </fieldset>

    {{-- Bouton --}}
    @component('components.form.buttons.button', ['class' => 'mt-5 bg-indigo-600 text-white font-semibold py-3 rounded-2xl shadow-lg hover:bg-indigo-700 transition-colors duration-200', 'text' => 'Créez un contact'])
    @endcomponent


</form>
</body>

{{--Composant pour le footer--}}
@component('components.footer')
@endcomponent

