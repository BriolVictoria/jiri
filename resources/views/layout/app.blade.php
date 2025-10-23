<aside class="fixed top-0 left-0 bg-white h-screen pr-15 shadow-2xl flex flex-col justify-between rounded-2xl">

    <div class="p-6 border-b border-gray-200">
        <h1 class="text-xl font-bold text-blue-500">
            Bonjour,
            <span class="block text-2xl text-blue-300">{!! auth()->user()->name !!}</span>
        </h1>
    </div>

    <nav class="p-6">
        <ul>
            <li class="mb-5">
                <a href="{{ route('jiris.index')}}" class="text-xl flex items-center px-4 py-2 rounded-lg hover:bg-blue-100 hover:text-blue-500 transition">
                  Mes jiris
                </a>
            </li>

            <li class="mb-5">
                <a href="{{ route('contacts.index')}}" class="text-xl flex items-center px-4 py-2 rounded-lg hover:bg-blue-100 hover:text-blue-500 transition">
                    Mes contacts
                </a>
            </li>

            <li class="mb-5">
                <a href="{{ route('projects.index')}}" class="text-xl flex items-center px-4 py-2 rounded-lg hover:bg-blue-100 hover:text-blue-500 transition">
                    Mes projets
                </a>
            </li>
        </ul>
    </nav>
    <div class="p-6 border-t border-gray-200">
        <form action="{{ route('logout') }}" method="post">
            @csrf
            <button type="submit" class="flex items-center text-blue-500 hover:text-blue-700 transition">Déconnexion</button>
        </form>
    </div>
</aside>
