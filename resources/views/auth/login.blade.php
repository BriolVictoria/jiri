<!doctype html>
<html lang="{!! App::getLocale(); !!}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="flex justify-center items-center min-h-screen">
<section class=" shadow-2xl p-10 rounded-2xl">

    <svg class="m-auto" height="100px" width="100px" version="1.1" id="_x32_" xmlns="http://www.w3.org/2000/svg"
         xmlns:xlink="http://www.w3.org/1999/xlink"
         viewBox="0 0 512 512" xml:space="preserve">

        <g>
            <path class="st0" d="M505.837,180.418L279.265,76.124c-7.349-3.385-15.177-5.093-23.265-5.093c-8.088,0-15.914,1.708-23.265,5.093
		L6.163,180.418C2.418,182.149,0,185.922,0,190.045s2.418,7.896,6.163,9.627l226.572,104.294c7.349,3.385,15.177,5.101,23.265,5.101
		c8.088,0,15.916-1.716,23.267-5.101l178.812-82.306v82.881c-7.096,0.8-12.63,6.84-12.63,14.138c0,6.359,4.208,11.864,10.206,13.618
		l-12.092,79.791h55.676l-12.09-79.791c5.996-1.754,10.204-7.259,10.204-13.618c0-7.298-5.534-13.338-12.63-14.138v-95.148
		l21.116-9.721c3.744-1.731,6.163-5.504,6.163-9.627S509.582,182.149,505.837,180.418z"/>
            <path class="st0" d="M256,346.831c-11.246,0-22.143-2.391-32.386-7.104L112.793,288.71v101.638
		c0,22.314,67.426,50.621,143.207,50.621c75.782,0,143.209-28.308,143.209-50.621V288.71l-110.827,51.017
		C278.145,344.44,267.25,346.831,256,346.831z"/>
        </g>
</svg>

    <h1 class="font-bold text-3xl my-5 text-center">{{__('login.identify_yourself')}}</h1>
    <form action="{{ route('login.store') }}" method="post">
        @csrf
        <p class="text-red-600 text-xs mb-3">{{ __('login.fields_are_required') }}</p>
        <fieldset>
            <div class="flex flex-col flex-1 mb-4">
                <label for="email">{{__('login.email')}}<small class="text-red-600 ml-1">*</small></label>
                <input class="border-1 border-gray-300 rounded-sm p-1" type="email" id="email" name="email" value="{{ old('email') }}">
                @error('email')
                <p class="error text-red-600 text-xs">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex flex-col flex-1 relative">
                <label for="password">{{__('login.password')}}<small class="text-red-600 ml-1">*</small></label>
                <input class="border-1 border-gray-300 rounded-sm p-1" type="password" id="password" name="password"  value="{{ old('password') }}">
                <svg class="absolute top-8 right-3" width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M1.5 12c0-2.25 3.75-7.5 10.5-7.5S22.5 9.75 22.5 12s-3.75 7.5-10.5 7.5S1.5 14.25 1.5 12zM12 16.75a4.75 4.75 0 1 0 0-9.5 4.75 4.75 0 0 0 0 9.5zM14.7 12a2.7 2.7 0 1 1-5.4 0 2.7 2.7 0 0 1 5.4 0z" fill="#000000"/></svg>
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
                <p class="text-xs ">{{ __('login.no_account_yet')}}<a class="text-blue-500 ml-3" href="/register">{{ __('login.create_an_account')}}</a></p>

            </div>

        </fieldset>

    </form>
</section>

</body>
</html>
