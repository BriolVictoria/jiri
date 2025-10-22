{{--Composant pour le header--}}
@component('components.head', ['title' => 'Se connecter'])
@endcomponent


<body class="flex justify-center items-center min-h-screen bg-gray-100 px-4">

<section class="bg-white shadow-2xl rounded-2xl p-10 w-full max-w-md mx-auto">

    {{--Importation du SVG--}}
   @include('SVG.student_cap')

    <h1 class="font-bold text-3xl my-5 text-center">{{__('login.identify_yourself')}}</h1>
    <form action="{{ route('login.store') }}" method="post">
        @csrf
        <p class="text-red-600 text-xs mb-3">{{ __('login.fields_are_required') }}</p>
        <fieldset>
            <div class="flex flex-col flex-1 mb-4">
                <label for="email">{{__('login.email')}}<small class="text-red-600 ml-1">*</small></label>
                <input class="border-1 border-gray-300 rounded-sm p-1" type="email" id="email" name="email"
                       value="{{ old('email') }}">
                @error('email')
                <p class="error text-red-600 text-xs">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex flex-col flex-1 relative">
                <label for="password">{{__('login.password')}}<small class="text-red-600 ml-1">*</small></label>
                <input class="border-1 border-gray-300 rounded-sm p-1" type="password" id="password" name="password"
                       value="{{ old('password') }}">
                <svg class="absolute top-8 right-3" width="20px" height="20px" viewBox="0 0 24 24"
                     xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                          d="M1.5 12c0-2.25 3.75-7.5 10.5-7.5S22.5 9.75 22.5 12s-3.75 7.5-10.5 7.5S1.5 14.25 1.5 12zM12 16.75a4.75 4.75 0 1 0 0-9.5 4.75 4.75 0 0 0 0 9.5zM14.7 12a2.7 2.7 0 1 1-5.4 0 2.7 2.7 0 0 1 5.4 0z"
                          fill="#000000"/>
                </svg>
                @error('password')
                <p class="error text-red-600 text-xs">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex mt-5">
                <input class="mr-2" type="checkbox" id="checkbox" name="checkbox">
                <label class="text-xs" for="checkbox">{{ __('login.remember_me') }}</label>

                <a class="text-xs ml-3 text-blue-500" href="#">{{ __('login.forgotten_password') }}</a>
            </div>

            <div>
                <button class="bg-blue-500 text-white p-2 rounded-sm mt-5 w-1/1 hover:bg-sky-700"
                        type="submit">{{__('login.button_login')}}</button>
            </div>

            <div class="flex mt-5">
                <p class="text-xs ">{{ __('login.no_account_yet')}}<a class="text-blue-500 ml-3"
                                                                      href="{{ route('register') }}">{{ __('login.create_an_account')}}</a>
                </p>

            </div>

        </fieldset>

    </form>
</section>

</body>
</html>
