<!doctype html>
<html lang="{!! App::getLocale(); !!}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body>
<h1 class="font-bold text-3xl my-5 text-center">Modifiez le contact</h1>

<form action="{!! route('contacts.update', $contact->id) !!}" method="post" class="max-w-1/2 mx-auto">
    @method('PATCH')
    @csrf
    <p class="text-red-600 text-xs mb-3 text-center">{{ __('login.fields_are_required') }}</p>
    <div class="flex flex-col relative">
        <label class="font-bold" for="name">Nom <small class="text-red-600 ml-1">*</small></label>
        <input type="text" name="name" id="name" value="{{ $contact->name }}" class="border p-2 rounded-lg"
               placeholder="Pedro Pascal">
        @error('name')
        <p class="error text-red-600 text-xs">{!! $message !!}</p>
        @enderror
    </div>

    <div class="flex flex-col relative my-3">
        <label class="font-bold" for="email">Email <small class="text-red-600 ml-1">*</small></label>
        <input type="email" name="email" id="email" value="{{ $contact->email }}" class="border p-2 rounded-lg"
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
            class="w-1/1 mb-30 mt-5 border p-2 rounded-lg hover:bg-blue-950 hover:text-white">Modifiez le contact</button>

</form>
</body>
</html>
