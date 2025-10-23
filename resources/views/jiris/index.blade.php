{{--Composant pour le header--}}
@component('components.head', ['title' => 'Liste des jiris'])
@endcomponent

<body class="flex flex-col items-center">

{{--Menu--}}
@include('layout.app')

{{-- SVG + Titre --}}
<div class="flex flex-col items-center mt-10">

    {{--SVG--}}
    @include('SVG.student_cap')

    <h1 class="mt-4 text-4xl font-bold text-center text-gray-800">
        Liste des jiris
    </h1>
</div>

{{--Créer un nouveau--}}
<div class="mt-6 mb-4">
    <a href="{{ route('jiris.create') }}"
       class="bg-indigo-600 text-white font-semibold px-6 py-3 rounded-xl shadow-lg hover:bg-indigo-700 transition-colors duration-200">
        Créer un nouveau jiri
    </a>
</div>


{{--Début du tableau--}}

<table class="mb-10 mt-8 ml-10 min-w-[400px] border-separate border-spacing-0 rounded-2xl shadow-lg overflow-hidden">
    <thead>
    <tr class="bg-gray-100 text-gray-700 uppercase text-sm font-semibold">
        <th class="px-6 py-4 text-left border-b border-gray-200">Nom du jiri</th>
        <th class="px-6 py-4 text-left border-b  border-l border-gray-200">Date</th>
        <th class="px-6 py-4 text-left border-b  border-l border-gray-200">Evalué</th>
        <th class="px-6 py-4 text-left border-b  border-l border-gray-200">Evaluateurs</th>
        <th class="px-6 py-4 text-left border-b  border-l border-gray-200">Projets</th>
    </tr>
    </thead>
    <tbody>
    @foreach($jiris as $jiri)
        <tr class="hover:bg-indigo-50 transition-all duration-200 border-b border-gray-100">
            <td class="px-6 py-4 border-b border-gray-200">
                <a class="text-indigo-600 hover:text-indigo-800 font-medium underline-offset-2 hover:underline"
                   href="{{ route('jiris.show', $jiri->id) }}">{{ $jiri->name }}</a></td>

            <td class="px-6 py-4 border-l border-b border-gray-200">
                {{ \Carbon\Carbon::parse($jiri->date)->translatedFormat('d/m/Y') }}
            </td>

            <td class="px-6 py-4 border-l border-b border-gray-200">
                {!! $jiri->evaluated()->count() !!}
            </td>

            <td class="px-6 py-4 border-l border-b border-gray-200">
                {!! $jiri->evaluators()->count() !!}
            </td>

            <td class="px-6 py-4 border-l border-b border-gray-200">
                {!! $jiri->homeworks()->count() !!}
            </td>


        </tr>
    @endforeach
    </tbody>

</table>


</body>

{{--Composant pour le footer--}}
@component('components.footer')
@endcomponent


