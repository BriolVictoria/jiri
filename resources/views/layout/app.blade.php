<!doctype html>
<html lang="{!! App::getLocale(); !!}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
</head>
<body  class="flex min-h-screen bg-gray-50">
<aside class="fixed top-0 left-0 h-screen w-64 bg-white shadow-2xl flex flex-col justify-between">
    <div class="p-6 border-b border-gray-200">
        <h1 class="text-2xl font-bold text-blue-500">Menu</h1>
    </div>

    <nav class="p-6">
        <ul class="space-y-3">
            <li>
                <a href="{{ route('jiris.index')}}" class="flex items-center px-4 py-2 rounded-lg hover:bg-blue-100 hover:text-blue-500 transition">
                  Mes jiris
                </a>
            </li>

            <li>
                <a href="{{ route('contacts.index')}}" class="flex items-center px-4 py-2 rounded-lg hover:bg-blue-100 hover:text-blue-500 transition">
                    Mes contacts
                </a>
            </li>

            <li>
                <a href="{{ route('projects.index')}}" class="flex items-center px-4 py-2 rounded-lg hover:bg-blue-100 hover:text-blue-500 transition">
                    Mes projets
                </a>
            </li>
        </ul>
    </nav>
    <div class="p-6 border-t border-gray-200">
        <a href="{{ route('logout')}}" class="flex items-center text-blue-500 hover:text-blue-700 transition">
            Déconnexion
        </a>
    </div>
</aside>
</body>
</html>
