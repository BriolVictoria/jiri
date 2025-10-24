<div class="flex flex-col my-3">
    <label for="{!! $field_name !!}" class="font-bold text-gray-700">{!! $slot !!}</label>
    <textarea name="{!! $field_name !!}" id="{!! $field_name !!}" rows="3"
              class="mt-2 border border-gray-300 rounded-xl p-3 focus:outline-none focus:ring-2 focus:ring-indigo-500">{{ old($field_name) }}</textarea>
</div>
