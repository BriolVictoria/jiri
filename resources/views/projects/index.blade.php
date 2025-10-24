{{--Composant pour le header--}}
@component('components.head', ['title' => 'Liste des projets'])
@endcomponent

<body class="flex flex-col items-center">

{{--Menu--}}
@include('layout.app')

{{-- SVG + Titre --}}
<div class="flex flex-col items-center mt-10">

    @include('SVG.project')

    <h1 class="mt-4 text-4xl font-bold text-center text-gray-800">
        Liste des projets
    </h1>
</div>

{{--Créer un nouveau--}}
<x-link>
    <x-slot:href>
        {!! route('projects.create') !!}
    </x-slot:href>
    <x-slot:class_link>
        {!! 'bg-indigo-600 text-white font-semibold px-6 py-3 rounded-xl shadow-lg hover:bg-indigo-700 transition-colors duration-200' !!}
    </x-slot:class_link>
    Créez un projet
</x-link>

{{--Tableau--}}
<x-table.table :column_names="['Nom']">
    @foreach($projects as $project)
        <tr class="hover:bg-indigo-50 transition-all duration-200 border-b border-gray-100">
            <td class="px-6 py-4 border-l border-b border-gray-200">
                <a class="text-indigo-600 hover:text-indigo-800 font-medium underline-offset-2 hover:underline" href="{{ route('projects.show', $project->id) }}">{{ $project->name }}</a></td>
        </tr>
    @endforeach
</x-table.table>

</body>

{{--Composant pour le footer--}}
@component('components.footer')
@endcomponent

