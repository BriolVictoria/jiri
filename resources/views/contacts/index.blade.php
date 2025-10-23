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
<div class="mt-6 mb-4">
    <a href="{{ route('contacts.create') }}"
       class="bg-indigo-600 text-white font-semibold px-6 py-3 rounded-xl shadow-lg hover:bg-indigo-700 transition-colors duration-200">
        Créer un nouveau contact
    </a>
</div>

{{--Début du tableau--}}

<table class="mb-10 mt-8 ml-10 min-w-[400px] border-separate border-spacing-0 rounded-2xl shadow-lg overflow-hidden">
    <thead>
    <tr class="bg-gray-100 text-gray-700 uppercase text-sm font-semibold">
        <th class="px-6 py-4 text-left border-b border-gray-200">Nom du contact</th>
        <th class="px-6 py-4 text-left border-b border-l border-gray-200">Adresse email</th>
        <th class="px-6 py-4 text-left border-b border-l border-gray-200">Avatar</th>
    </tr>
    </thead>
    <tbody>
    @foreach($contacts as $contact)
        <tr class="hover:bg-indigo-50 transition-all duration-200 border-b border-gray-100">

            <td class="px-6 py-4  border-b border-gray-200">
                <a class="text-indigo-600 hover:text-indigo-800 font-medium underline-offset-2 hover:underline"
                   href="{{ route('contacts.show', $contact->id) }}">{{ $contact->name }}</a></td>

            <td class="px-6 py-4 border-l border-b border-gray-200">
                {{ $contact->email }}
            </td>

            <td class="px-6 py-4 border-l border-b border-gray-200">
                <img class="mt-2 max-w-[150px] rounded-xl text-indigo-600 hover:underline"
                     src="{!! asset('storage/images/contacts/originals/'.$contact->avatar) !!}"
                     alt="avatar de {{ $contact->name }}">
            </td>
        </tr>
    @endforeach
    </tbody>

</table>

</body>

{{--Composant pour le footer--}}
@component('components.footer')
@endcomponent

