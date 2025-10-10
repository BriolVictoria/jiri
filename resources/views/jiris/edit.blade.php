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

<form action="{!! route('jiris.store') !!}" method="post" class="max-w-1/2 mx-auto">
    @csrf
    <p class="text-red-600 text-xs mb-3 text-center">{{ __('login.fields_are_required') }}</p>
    <fieldset class="border-1 p-4  my-10 rounded-lg">
        <legend class="text-2xl p-2">Informations général</legend>
        <div class="flex flex-col relative">
            <label for="name">Nom <small class="text-red-600 ml-1">*</small></label>
            @error('name')
            <p>{!! $message !!}</p>
            @enderror
            <input type="text" name="name" id="name" value="{{ $jiri->name }}" class="border p-2 rounded-lg" placeholder="Design Web">
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
            <textarea name="description" id="description" cols="30" rows="5" class="border p-2 rounded-lg" placeholder="Jury des élèves de B2...">{{ $jiri->description }}</textarea>
        </div>

    </fieldset>

    <fieldset class="border-1 p-4  rounded-lg">
        <legend class="text-2xl p-2">Contact</legend>
        <div>
            <div class="border-b-1 m-2 p-2">
                <input  value="1" type="checkbox" name="contacts[1]" id="JP">
                <label for="JP">
                    Jean-Paul
                    {{-- @foreach()
                         --}}{{--Récuperer les contacts--}}{{--
                     @endforeach--}}
                </label>
                <select name="contacts[1][role]" class="font-bold mx-5 border-1 rounded-xl p-1  my-1">
                    <option value="evaluated" id="role2" class="m-1">Evalué</option>
                    <option value="evaluator"  id="role3">Evaluateur</option>
                </select>
            </div>

            <div class="border-b-1 m-2 p-2">
                <input  value="2" type="checkbox" name="contacts[2]" id="JM">
                <label for="JM">
                    Jean-Michel

                </label>
                <select name="contacts[2][role]" class="font-bold mx-5 border-1 rounded-xl p-1  my-1">
                    <option value="evaluated" id="role2" class="m-1">Evalué</option>
                    <option value="evaluator"  id="role3">Evaluateur</option>
                </select>
            </div>

            <div class="border-b-1 m-2 p-2">
                <input value="3" type="checkbox" name="contacts[3]" id="PM">
                <label for="PM">
                    Paul-Michel

                </label>
                <select name="contacts[3][role]" class="font-bold mx-5 border-1 rounded-xl p-1  my-1">
                    <option value="evaluated" id="role2" class="m-1">Evalué</option>
                    <option value="evaluator"  id="role3">Evaluateur</option>
                </select>
            </div>

            <div class="border-b-1 m-2 p-2">
                <input value="4" type="checkbox" name="contacts[4]" id="JJ">
                <label for="JJ">
                    Jean-Jean

                </label>
                <select name="contacts[4][role]" class="font-bold mx-5 border-1 rounded-xl p-1 my-1 ">
                    <option value="evaluated" id="role2" class="m-1">Evalué</option>
                    <option value="evaluator"  id="role3">Evaluateur</option>
                </select>
            </div>
        </div>
    </fieldset>

    <fieldset class="border-1 p-4 my-10  rounded-lg">
        <legend class="text-2xl p-2">Projets</legend>
        <div>
            <input value="1" type="checkbox" name="projects[1]" id="cv">
            <label for="cv">
                CV

            </label>
        </div>
        <div>
            <input value="2" type="checkbox" name="projects[2]" id="portfolio">
            <label for="portfolio">
                Portfolio

            </label>
        </div>
        <div>
            <input value="3" type="checkbox" name="projects[3]" id="client">
            <label for="client">
                Client

            </label>
        </div>
    </fieldset>

    <button type="submit" class="w-1/1 mb-30 border p-2 rounded-lg hover:bg-blue-950 hover:text-white">Modifier le jiri</button>
</form>

</body>
</html>
