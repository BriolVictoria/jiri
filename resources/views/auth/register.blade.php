{{--Composant pour le header--}}
@component('components.head', ['title' => 'Créez un compte'])
@endcomponent

<body class="flex justify-center items-center min-h-screen">
<section class=" shadow-2xl p-10 rounded-2xl">

    {{--Importation du SVG--}}
    @include('SVG.student_cap')

    <h1 class="font-bold text-3xl my-5 text-center">{{ __('register.create_an_account') }}</h1>
    <form action="{{ route('register.store') }}" method="post">
        @csrf
        <p class="text-red-600 text-xs mb-3">{{ __('register.fields_are_required') }}</p>
        <fieldset>

            @component('components.form.fields.input', ['type' => 'name', 'field_name' => 'name', 'placeholder' => 'Pedro Pascal', 'required' => 'required'])
                Nom<small class="text-red-600 ml-1">*</small>
            @endcomponent


            @component('components.form.fields.input', ['type' => 'email', 'field_name' => 'email', 'placeholder' => 'pedro.pascal@gmail.com', 'required' => 'required'])
                Email<small class="text-red-600 ml-1">*</small>
            @endcomponent


            @component('components.form.fields.input', ['type' => 'password', 'field_name' => 'password', 'required' => 'required'])
                Mot de passe<small class="text-red-600 ml-1">*</small>
            @endcomponent




            @component('components.form.buttons.button', ['class' => 'bg-blue-500 text-white p-2 rounded-sm mt-5 w-1/1 hover:bg-sky-700', 'text' => 'Identifiez-vous'])
            @endcomponent


            @component('components.form.fields.link', ['text' => 'Pas encore de compte ? ', 'href' => route('register.store'),'text_link' => 'Créer un compte'])
            @endcomponent

        </fieldset>

    </form>
</section>

</body>

{{--Composant pour le footer--}}
@component('components.footer')
@endcomponent
