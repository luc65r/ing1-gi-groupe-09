<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <a href="{{ route('contests.projects.index', ['contest' => $contest->id]) }}">{{ $contest->name }}</a>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (Route::has('login'))
                @auth
                    <a class="voirP rounded-lg" href="javascript:history.back()">
                        Retour à la liste des évènements
                    </a>
                @else
                <a class="voirP rounded-lg" href="javascript:history.back()">
                        Retour à l'accueil
                    </a>
                @endauth
            @endif
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-6">
                <div class="p-6 bg-white border-b border-gray-200 shadow-lg bg-accueil_pale">
                    <h1 class="text-lg">Description:</h1> 
                    <p>{!! \Illuminate\Support\Str::markdown($contest->description) !!}</p>
                    <br>
                    @if (Route::has('login'))
                        @auth
                        <a class="voirP rounded-lg mt-6" href="{{ route('contests.projects.index', ['contest' => $contest->id]) }}">
                            Accéder aux projets associés
                        </a>
                        @endauth
                    @endif
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
