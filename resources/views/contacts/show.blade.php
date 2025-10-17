<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body class="flex flex-col items-center justify-center">
<h1 class="text-center font-bold text-4xl mt-5">Récapitulatif du contact</h1>
<p class="text-center text-2xl mt-5 font-bold">Nom : </p>
<p  class="text-center mt-5">{!! $contact->name !!}</p>
<p class="text-center text-2xl mt-5 font-bold">Email : </p>
<p class="text-center mt-5">{!! $contact->email !!}</p>
<p class="text-center text-2xl mt-5 font-bold">Avatar : </p>
<img class="mt-5" src="{!! asset('storage/'.$contact->avatar) !!}" alt="avatar de {{ $contact->name }}">
<a href="{{ route('contacts.edit', $contact->id) }}"
   class="shadow-2xl w-96 p-5 underline rounded-2xl hover:scale-105 transition-transform duration-200 mt-10 text-center">
    Modifiez le contact
</a>

</body>
</html>

