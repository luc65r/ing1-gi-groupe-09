<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Data Challenge</title>

        <!-- Fonts -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">


    </head>
    <body class="antialiased bg-accueil">

        <header class="w-full h-16 fixed top-0 right-0 px-6 py-4 sm:block flex">
            <div class="flex">
                <img class="logo" src="{{ asset('images/iapau_logo.png') }}" alt="Description de l'image">

                @if (Route::has('login'))
                    <div style="float: right" class="ml-auto">
                        @auth
                            <a href="{{ url('/dashboard') }}" style="margin-right: 8px; "  class="text-sm justify-end text-white ml-2 underline">Dashboard</a>
                        @else
                        </div>
                        <div style="float: right" class="ml-auto">
                            <a href="{{ route('login') }}" style="margin-right: 8px; " class="text-sm justify-end text-white ml-2 underline">Log in</a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="text-sm  text-white underline mr-2">Register</a>
                            @endif
                            </div>
                        @endauth
                @endif
            </div>
            
        </header>

        <main class="w-full mt-16 flex justify-center text-center">
        
            <!-- Pour le data du moment -->
            <div class="rounded-md shadow-lg bg-white w-30P h-200 mx-auto mr-6 avanc">
                <!-- Pour l'image -->
                <div class=" w-95P h-150 mt-4 mx-auto">
                    <img style="height:22em" src="{{ asset('images/13.png') }}" alt="Description de l'image">

                </div>

                <!-- Pour le texte -->
                <div class=" h-50 mt-6">
                    <h1>Découvrez notre évènement du moment</h1>
                    <br>
                    <a href="{{ route('contests.show', App\Models\Contest::orderBy('start')->get()->first()) }}" class="voirP rounded-lg">{{ __('Voir plus') }}</a>
                </div>
            </div>

            <!-- Pour les anciens évènements -->
            <div class="rounded-md shadow-lg bg-white w-30P h-200 mx-auto avanc">
                <!-- Pour l'image -->
                <div class="w-95P h-150 mt-4 mx-auto">
                    <img style="height:22em" src="{{ asset('images/9.png') }}" alt="Description de l'image">

                </div>

                <!-- Pour le texte -->
                <div class="h-50 mt-6">
                    <h1>Anciens évènements</h1>
                    <br>
                    <a   href="{{ route('contests.index') }}" class="voirP rounded-lg">{{ __('Voir plus') }}</a>

                </div>         
            </div>         
        </main>
    </body>
</html>