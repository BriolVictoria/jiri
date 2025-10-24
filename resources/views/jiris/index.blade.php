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
<x-link>
    <x-slot:href>
        {!! route('jiris.create') !!}
    </x-slot:href>
    <x-slot:class_link>
        {!! 'bg-indigo-600 text-white font-semibold px-6 py-3 rounded-xl shadow-lg hover:bg-indigo-700 transition-colors duration-200' !!}
    </x-slot:class_link>
    Créez un jiri
</x-link>

{{--Tableau--}}
<x-table.table :column_names="['Nom', 'Date', 'Evalués', 'Evaluateurs', 'Projets', 'Action']">
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

            <td class="px-6 py-4 border-l border-b border-gray-200 text-red-500">
                <form action="{!! route('jiris.destroy', $jiri->id)!!}" method="post">
                    @method('DELETE')
                    @csrf
                    <x-form.buttons.button>
                        <x-slot:class>
                            {!! 'cursor-pointer' !!}
                        </x-slot:class>
                       <x-slot:text>
                           Supprimer
                       </x-slot:text>
                    </x-form.buttons.button>

                </form>
            </td>

        </tr>
    @endforeach
</x-table.table>
{!! $jiris->links() !!}



</body>

{{--Composant pour le footer--}}
@component('components.footer')
@endcomponent


