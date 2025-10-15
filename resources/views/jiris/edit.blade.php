<!doctype html>
<html lang="{!! App::getLocale(); !!} ">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body>
<h1 class="font-bold text-3xl my-5 text-center">{{ __('edit-view.modify_the_jiri') }}</h1>

<form action="{!! route('jiris.update', $jiri->id) !!}" method="post" class="max-w-1/2 mx-auto">
    @method('PATCH')
    @csrf
    <p class="text-red-600 text-xs mb-3 text-center">{{ __('login.fields_are_required') }}</p>
    <fieldset class="border-1 p-4  my-10 rounded-lg">
        <legend class="text-2xl p-2">Informations général</legend>
        <div class="flex flex-col relative">
            <label for="name">Nom <small class="text-red-600 ml-1">*</small></label>
            @error('name')
            <p>{!! $message !!}</p>
            @enderror
            <input type="text" name="name" id="name" value="{{ $jiri->name }}" class="border p-2 rounded-lg"
                   placeholder="Design Web">
        </div>
        <div class="flex flex-col relative my-3">
            <label for="date">Date <small class="text-red-600 ml-1">*</small></label>
            @error('date')
            <p>{!! $message !!}</p>
            @enderror
            <input type="text" name="date" id="date" value="{{ $jiri->date }}" class="border p-2 rounded-lg">
        </div>
        <div class="flex flex-col relative">
            <label for="description">Description</label>
            @error('description')
            <p>{!! $message !!}</p>
            @enderror
            <textarea name="description" id="description" cols="30" rows="5" class="border p-2 rounded-lg"
                      placeholder="Jury des élèves de B2...">{{ $jiri->description }}</textarea>
        </div>

    </fieldset>

    <fieldset class="border-1 p-4  rounded-lg">
        <legend class="text-2xl p-2">Contact</legend>
        <div>
            @foreach($contacts as $contact)
                <div class="border-b-1 m-2 p-2">
                    <input value="1" type="checkbox" name="contacts[1]" id="contact{!! $contact->id !!}">
                    <label for="contact{!! $contact->id !!}">
                        {{ $contact->name }}
                    </label>
                    <select name="contacts[1][role]" class="font-bold mx-5 border-1 rounded-xl p-1  my-1">
                        <option value="evaluated" id="role2" class="m-1">Evalué</option>
                        <option value="evaluator" id="role3">Evaluateur</option>
                    </select>
                </div>
            @endforeach

        </div>
    </fieldset>

    <fieldset class="border-1 p-4 my-10  rounded-lg">
        <legend class="text-2xl p-2">Projets</legend>
        @foreach($projects as $project)
        <div>
            <input value="1" type="checkbox" name="projects[1]" id="projet{!! $project->id !!}">
            <label for="projet{!! $project->id !!}">
                {{ $project->name }}
            </label>
        </div>
        @endforeach
    </fieldset>

    <button type="submit" class="w-1/1 mb-30 border p-2 rounded-lg hover:bg-blue-950 hover:text-white">Modifier le
        jiri
    </button>
</form>

</body>
</html>
