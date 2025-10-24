@props(['column_names' => []])

<table class="mb-10 mt-8 ml-10 min-w-[400px] border-separate border-spacing-0 rounded-2xl shadow-lg overflow-hidden">
    <thead>
    <tr class="bg-gray-100 text-gray-700 uppercase text-sm font-semibold">
        @foreach($column_names as $column_name)

            <th class="px-6 py-4 text-left border-b border-gray-200">
                <div class="flex items-center gap-2"> {!! $column_name !!} @include('SVG.arrow_down')</div>
            </th>

        @endforeach
    </tr>
    </thead>
    <tbody>
    {!! $slot !!}
    </tbody>
</table>
