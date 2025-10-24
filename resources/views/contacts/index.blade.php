{{--Composant pour le header--}}
@component('components.head', ['title' => 'Liste des contacts'])
@endcomponent

<body class="flex flex-col items-center">

{{--Menu--}}
@include('layout.app')

{{-- SVG + Titre --}}
<div class="flex flex-col items-center mt-10">
    @include('SVG.person')
    <h1 class="mt-4 text-4xl font-bold text-center text-gray-800">
        Liste des contacts
    </h1>
</div>

{{--Créer un nouveau--}}
<x-link>
    <x-slot:href>
        {!! route('contacts.create') !!}
    </x-slot:href>
    <x-slot:class_link>
        {!! 'bg-indigo-600 text-white font-semibold px-6 py-3 rounded-xl shadow-lg hover:bg-indigo-700 transition-colors duration-200' !!}
    </x-slot:class_link>
    Créez un contact
</x-link>

{{--Tableau--}}
<x-table.table :column_names="['Nom', 'Adresse email', 'Avatar']">
    @foreach($contacts as $contact)
        <tr class="hover:bg-indigo-50 transition-all duration-200 border-b border-gray-100">

            <td class="px-6 py-4  border-b border-gray-200">
                <a class="text-indigo-600 hover:text-indigo-800 font-medium underline-offset-2 hover:underline"
                   href="{{ route('contacts.show', $contact->id) }}">{{ $contact->name }}</a></td>

            <td class="px-6 py-4 border-l border-b border-gray-200">
                {{ $contact->email }}
            </td>

            @if(isset($contact->avatar))
                <td class="px-6 py-4 border-l border-b border-gray-200">
                    <img class="mt-2 max-w-[150px] rounded-xl"
                         src="{!! asset('storage/images/contacts/originals/'.$contact->avatar) !!}"
                         alt="avatar de {{ $contact->name }}">
                </td>
            @else
                <td class="px-6 py-4 border-l border-b border-gray-200">
                   <p>Ne possède pas d'avatar</p>
                </td>
            @endif

        </tr>
    @endforeach
</x-table.table>


{{--Composant pour le footer--}}
@component('components.footer')
@endcomponent

