<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body class="flex justify-center items-center">
<section>


    <div class="flex mt-5 items-center justify-center">
        <svg fill="#000000" width="50px" height="50px" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg">
            <path
                d="M16 15.503A5.041 5.041 0 1 0 16 5.42a5.041 5.041 0 0 0 0 10.083zm0 2.215c-6.703 0-11 3.699-11 5.5v3.363h22v-3.363c0-2.178-4.068-5.5-11-5.5z"/>
        </svg>
        <h1 class="font-bold text-3xl ml-5">Liste des contacts</h1>
    </div>
    <ul class="mt-5 ml-10">
        @foreach($contacts as $contact)
            <div
                class="shadow-2xl p-5 mb-5 w-96 rounded-2xl hover:scale-105 transition-transform duration-200 text-center">
                <li class="mb-2"><a class="underline"
                                    href="{{ route('contacts.show', $contact->id) }}">{{ $contact->name }}</a></li>
            </div>
        @endforeach
    </ul>
</section>
</body>
</html>
