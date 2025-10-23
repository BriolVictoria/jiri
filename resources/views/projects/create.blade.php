{{--Composant pour le header--}}
@component('components.head', ['title' => 'Créez un projet'])
@endcomponent


<body class="flex flex-col items-center bg-gray-50 min-h-screen p-6">

{{-- Menu --}}
@include('layout.app')


<h1 class="mt-10 text-4xl font-bold text-center text-gray-800">
    Créez un projet
</h1>

<form enctype="multipart/form-data" action="{!! route('projects.store') !!}" method="post"
      class="mt-8 w-full max-w-lg bg-white shadow-lg rounded-2xl p-8 flex flex-col gap-6">
    @csrf

    {{-- Message obligatoire --}}
    <p class="text-red-600 text-xs text-center">Les champs * sont des champs requis</p>


    {{-- Nom --}}
    @component('components.form.fields.input', ['type' => 'name', 'field_name' => 'name', 'placeholder' => 'Client', 'required' => 'required'])
        Nom<small class="text-red-600 ml-1">*</small>
    @endcomponent

    {{-- Bouton --}}
    @component('components.form.buttons.button', ['class' => 'mt-5 bg-indigo-600 text-white font-semibold py-3 rounded-2xl shadow-lg hover:bg-indigo-700 transition-colors duration-200', 'text' => 'Créez un projet'])
    @endcomponent
</form>
</body>


{{--Composant pour le footer--}}
@component('components.footer')
@endcomponent
