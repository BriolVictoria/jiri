{{--Composant pour le header--}}
@component('components.head', ['title' => 'Un contact'])
@endcomponent

<body class="flex flex-col items-center">

{{--Menu--}}
@include('layout.app')

<h1 class="mt-4 text-4xl font-bold text-center text-gray-800">
    Récapitulatif du contact
</h1>

<section class="mt-8  w-2/5 bg-white shadow-lg rounded-2xl p-8 flex flex-col gap-5">

    <div class="flex">
    <div>
        @if(isset($contact->avatar))
            <img
                class="w-50 h-50 object-cover rounded-3xl shadow-xl"
                src="{{ asset('storage/images/contacts/originals/'.$contact->avatar) }}"
                alt="avatar de {{ $contact->name }}">
        @else
            <div
                class="w-50 h-50 flex items-center justify-center  bg-gray-100 rounded-3xl">
                Ne possède pas d’avatar
            </div>
        @endif
    </div>

    <div class="px-6 py-4 ml-10">
        <x-show_div.show_div>
            <x-slot:title>
                Nom
            </x-slot:title>
            <x-slot:text>
                {!! $contact->name  !!}
            </x-slot:text>
        </x-show_div.show_div>

        <x-show_div.show_div>
            <x-slot:title>
                Email
            </x-slot:title>
            <x-slot:text>
                {!! $contact->email  !!}
            </x-slot:text>
        </x-show_div.show_div>

        <x-show_div.show_div>
            <x-slot:title>
                Jiris
            </x-slot:title>
            <x-slot:text>
                {!! $jiris->count()  !!}
            </x-slot:text>
        </x-show_div.show_div>
    </div>

    </div>
    <x-link>
        <x-slot:href>
            {!! route('contacts.edit', $contact->id) !!}
        </x-slot:href>
        <x-slot:class_link>
            {!! 'bg-indigo-600 text-white font-semibold px-6 py-3 rounded-xl shadow-lg hover:bg-indigo-700 transition-colors duration-200' !!}
        </x-slot:class_link>
        Modifiez le contact
    </x-link>
</section>

<form action="{!! route('contacts.destroy', $contact->id)!!}" method="post">
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

