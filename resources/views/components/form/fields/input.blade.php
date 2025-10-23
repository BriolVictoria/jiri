<div class="flex flex-col flex-1 mb-5">
    <label class="font-bold text-gray-700" for="{!! $field_name !!}">{!! $slot !!}</label>
    <input class="mt-2 border border-gray-300 rounded-xl p-3 focus:outline-none focus:ring-2 focus:ring-indigo-500" type="{!! $type ?? 'text' !!}"
    value="{!! $value ??  old($field_name) !!}"
    name="{!! $field_name !!}"
    id="{!! $field_name !!}"
    placeholder="{!! $placeholder ?? '' !!}"
    {{ $required ?? '' }}>

    @error($field_name)
    <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>
