{{--Composant pour le header--}}
@component('components.head', ['title' => 'Un jiri'])
@endcomponent

<body class="flex flex-col items-center">

{{--Menu--}}
@include('layout.app')

<h1 class="mt-4 text-4xl font-bold text-center text-gray-800">
    Récapitulatif du jiri
</h1>

{{--Début du tableau--}}

<table class="mt-8 w-full max-w-xl border-separate border-spacing-0 rounded-2xl shadow-lg overflow-hidden mx-auto">
    <thead>
    <tr class="bg-gray-100 text-gray-700 uppercase text-sm font-semibold">
        <th class="px-6 py-4 text-left border-b border-gray-200">Champs</th>
        <th class="px-6 py-4 text-left border-b border-gray-200">Valeur</th>
    </tr>
    </thead>

    <tbody>
    <tr class="hover:bg-indigo-50 transition-all duration-200 border-b border-gray-100">
        <td class="px-6 py-4 font-medium text-gray-700">Nom</td>
        <td class="px-6 py-4 text-indigo-600 hover:underline">{!! $jiri->name !!}</td>
    </tr>

    <tr class="hover:bg-indigo-50 transition-all duration-200 border-b border-gray-100">
        <td class="px-6 py-4 font-medium text-gray-700">Date</td>
        <td class="px-6 py-4 text-indigo-600 hover:underline">{!! $jiri->date !!}</td>
    </tr>

    <tr class="hover:bg-indigo-50 transition-all duration-200 border-b border-gray-100">
        <td class="px-6 py-4 font-medium text-gray-700">Description</td>
        <td class="px-6 py-4 text-indigo-600 hover:underline">{!! $jiri->description !!}</td>
    </tr>

    <tr>
        <td colspan="2" class="px-6 py-4 text-center">
            <a href="{{ route('jiris.edit', $jiri->id)}}"
               class="shadow-2xl w-96 p-5 underline rounded-2xl hover:scale-105 transition-transform duration-200 inline-block">
                Modifiez le jiri
            </a>
        </td>
    </tr>
    </tbody>

</table>


</body>

{{--Composant pour le footer--}}
@component('components.footer')
@endcomponent


