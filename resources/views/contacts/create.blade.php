<!doctype html>
<html lang="{!! App::getLocale(); !!}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body>
<h1 class="font-bold text-4xl my-4 text-center">{{ __('create-view-contact.create_a_contact') }}</h1>

<form enctype="multipart/form-data" action="{!! route('contacts.store') !!}" method="post" class="max-w-1/2 mx-auto">
    @csrf
    <p class="text-red-600 text-xs mb-3 text-center">{{ __('login.fields_are_required') }}</p>
    <div class="flex flex-col relative">
        <label class="font-bold" for="name">Nom <small class="text-red-600 ml-1">*</small></label>
        <input type="text" name="name" id="name" value="{{ old('name') }}" class="border p-2 rounded-lg"
               placeholder="Pedro Pascal">
        @error('name')
        <p class="error text-red-600 text-xs">{!! $message !!}</p>
        @enderror
    </div>

    <div class="flex flex-col relative my-3">
        <label class="font-bold" for="email">Email <small class="text-red-600 ml-1">*</small></label>
        <input type="email" name="email" id="email" value="{{ old('email') }}" class="border p-2 rounded-lg"
               placeholder="pedro.pascal@gmail.com">
        @error('email')
        <p class="error text-red-600 text-xs">{!! $message !!}</p>
        @enderror
    </div>

    <div class="flex flex-col relative my-3">
        <label class="font-bold" for="avatar">Avatar</label>
        <input type="file" name="avatar" id="avatar" class="border p-2 rounded-lg">
        @error('file')
        <p class="error text-red-600 text-xs">{!! $message !!}</p>
        @enderror
    </div>

    <button type="submit"
            class="w-1/1 mb-30 mt-5 border p-2 rounded-lg hover:bg-blue-950 hover:text-white">{!! __('create-view-contact.create_a_contact_button') !!}</button>

</form>
</body>
</html>
