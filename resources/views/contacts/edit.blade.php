{{--Composant pour le header--}}
@component('components.head', ['title' => 'Modifiez le contact'])
@endcomponent

<body class="flex flex-col items-center bg-gray-50 min-h-screen p-6">

{{-- Menu --}}
@include('layout.app')

{{-- Titre --}}
<h1 class="mt-10 text-3xl font-bold text-center text-gray-800">
    Modifiez le contact
</h1>

{{-- Formulaire --}}
<form action="{!! route('contacts.update', $contact->id) !!}" method="post" enctype="multipart/form-data"
      class="mt-8 w-full max-w-lg bg-white shadow-lg rounded-2xl p-8 flex flex-col gap-6">
    @csrf
    @method('PATCH')

    {{-- Message obligatoire --}}
    <p class="text-red-600 text-xs text-center">{{ __('login.fields_are_required') }}</p>

    {{-- Nom --}}
    @component('components.form.fields.input', ['type' => 'name', 'value' => $contact->name,'field_name' => 'name', 'placeholder' => 'Pedro Pascal', 'required' => 'required'])
        Nom<small class="text-red-600 ml-1">*</small>
    @endcomponent

    {{-- Email --}}
    @component('components.form.fields.input', ['type' => 'email', 'value' => $contact->email, 'field_name' => 'email', 'placeholder' => 'pedro.pascal@gmail.com', 'required' => 'required'])
        Email<small class="text-red-600 ml-1">*</small>
    @endcomponent


    {{-- Avatar --}}
    @component('components.form.fields.input', ['type' => 'file', 'value' => assert('storage/'.$contact->avatar),'field_name' => 'avatar'])
        Avatar
    @endcomponent


    {{-- Bouton --}}
    @component('components.form.buttons.button', ['class' => 'mt-5 bg-indigo-600 text-white font-semibold py-3 rounded-2xl shadow-lg hover:bg-indigo-700 transition-colors duration-200', 'text' => 'Modifiez le contact'])
    @endcomponent

</form>
</body>

{{--Composant pour le footer--}}
@component('components.footer')
@endcomponent

