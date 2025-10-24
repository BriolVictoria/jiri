{{--Composant pour le header--}}
@component('components.head', ['title' => 'Un jiri'])
@endcomponent

<body class="flex flex-col items-center">

{{--Menu--}}
@include('layout.app')

<h1 class="mt-4 text-4xl font-bold text-center text-gray-800">
    Récapitulatif du jiri
</h1>

<section  class="mt-8  w-2/5 bg-white shadow-lg rounded-2xl p-8 flex flex-col gap-5">

    <div class="flex">
        <div class="px-6 py-4">
            <x-show_div.show_div>
                <x-slot:title>
                    Nom
                </x-slot:title>
                <x-slot:text>
                    {!! $jiri->name  !!}
                </x-slot:text>
            </x-show_div.show_div>

            <x-show_div.show_div>
                <x-slot:title>
                    Date
                </x-slot:title>
                <x-slot:text>
                    {!! $jiri->date  !!}
                </x-slot:text>
            </x-show_div.show_div>

            <div class="mb-5">
                <x-show_div.show_div>
                    <x-slot:title>
                        Description
                    </x-slot:title>
                    <x-slot:text>
                        {!! $jiri->description  !!}
                    </x-slot:text>
                </x-show_div.show_div>
            </div>
        </div>

        <div  class="px-6 py-4 ml-10">
            <x-show_div.show_div>
                <x-slot:title>
                    Evalués
                </x-slot:title>
                <x-slot:text>
                    {!! $jiri->evaluated()->count()  !!}
                </x-slot:text>
            </x-show_div.show_div>

            <x-show_div.show_div>
                <x-slot:title>
                    Evaluateurs
                </x-slot:title>
                <x-slot:text>
                    {!! $jiri->evaluators()->count()  !!}
                </x-slot:text>
            </x-show_div.show_div>

            <x-show_div.show_div>
                <x-slot:title>
                    Projets
                </x-slot:title>
                <x-slot:text>
                    {!! $jiri->homeworks()->count()  !!}
                </x-slot:text>
            </x-show_div.show_div>

        </div>
    </div>

    <x-link>
        <x-slot:href>
            {!! route('jiris.edit', $jiri->id) !!}
        </x-slot:href>
        <x-slot:class_link>
            {!! 'bg-indigo-600 text-white font-semibold px-6 py-3 rounded-xl shadow-lg hover:bg-indigo-700 transition-colors duration-200' !!}
        </x-slot:class_link>
        Modifiez le jiri
    </x-link>
</section>

<form action="{!! route('jiris.destroy', $jiri->id)!!}" method="post">
    @method('DELETE')
    @csrf
    <x-form.buttons.button>
        <x-slot:class>
            {!! 'cursor-pointer text-white p-5 bg-red-700 mt-10 rounded-2xl' !!}
        </x-slot:class>
        <x-slot:text>
            Supprimer
        </x-slot:text>
    </x-form.buttons.button>

</form>

</body>

{{--Composant pour le footer--}}
@component('components.footer')
@endcomponent


