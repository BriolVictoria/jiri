{{--Composant pour le header--}}
@component('components.head', ['title' => 'Un contact'])
@endcomponent

<body class="flex flex-col items-center">

{{--Menu--}}
@include('layout.app')

<h1 class="mt-4 text-4xl font-bold text-center text-gray-800">
    Récapitulatif du contact
</h1>

{{--Début du tableau--}}
<table class="mt-8 ml-10 min-w-[400px] border-separate border-spacing-0 rounded-2xl shadow-lg overflow-hidden">
    <thead>
    <tr class="bg-gray-100 text-gray-700 uppercase text-sm font-semibold">
        <th class="px-6 py-4 text-left border-b border-gray-200">Champs</th>
        <th class="px-6 py-4 text-left border-b border-gray-200">Valeur</th>
    </tr>
    </thead>

    <tbody>
    <tr class="hover:bg-indigo-50 transition-all duration-200 border-b border-gray-100">
        <td class="px-6 py-4 font-medium text-gray-700">Nom</td>
        <td class="px-6 py-4 text-indigo-600 hover:underline">{!! $contact->name !!}</td>
    </tr>

    <tr class="hover:bg-indigo-50 transition-all duration-200 border-b border-gray-100">
        <td class="px-6 py-4 font-medium text-gray-700">Email</td>
        <td class="px-6 py-4 text-indigo-600 hover:underline">{!! $contact->email !!}</td>
    </tr>

    <tr class="hover:bg-indigo-50 transition-all duration-200 border-b border-gray-100">
        <td class="px-6 py-4 font-medium text-gray-700">Avatar</td>
        <td class="px-6 py-4">
            <img class="mt-2 max-w-[150px] rounded-xl text-indigo-600 hover:underline"
                 src="{!! asset('storage/images/contacts/originals/'.$contact->avatar) !!}"
                 alt="avatar de {{ $contact->name }}">
        </td>
    </tr>

    <tr>
        <td colspan="2" class="px-6 py-4 text-center">
            <a href="{{ route('contacts.edit', $contact->id) }}"
               class="shadow-2xl w-96 p-5 underline rounded-2xl hover:scale-105 transition-transform duration-200 inline-block">
                Modifiez le contact
            </a>
        </td>
    </tr>
    </tbody>

</table>
</body>

{{--Composant pour le footer--}}
@component('components.footer')
@endcomponent

