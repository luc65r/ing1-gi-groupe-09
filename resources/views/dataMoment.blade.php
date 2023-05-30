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

        <header class="w-full h-16 fixed top-0 right-0 px-6 py-4 sm:block">
            <img class="logo" src="{{ asset('images/iapau_logo.png') }}" alt="Description de l'image">

            @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="flex justify-end items-center text-sm text-white  underline">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="flex justify-end items-center text-sm text-white  underline">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class=" flex justify-end items-center ml-4 text-sm text-white  underline">Register</a>
                        @endif
                    @endauth
            @endif

            
        </header>

        <main class="w-full mt-16  h-150 rounded-lg bg-data  shadow-lg w-70P  mx-auto">
            
            <div class="flex">
                <div id="photo" class="h-150 w-45P">
                    <img style="height:25em" src="{{ asset('images/14.jpg') }}" alt="Description de l'image">
                </div>

                <div class="h-150  w-70P">
                    <h1 class="text-center">Nom du data du moment</h1>

                    <div class="flex text-center">
                        <div class="h-70 w-demi overflow-hidden">
                            <p class="mt-8">{{'Début de l\'évènement'}}</p>
                            <p class="mt-3">{{'15/05/2023'}}</p>
                        </div>
                        <div class="h-70 w-demi overflow-hidden">
                            <p class="text-black mt-8">{{'Fin de l\'évènement'}}</p>
                            <p class="text-black mt-3">{{'15/05/2023'}}</p>
                        </div>

                    </div>
                    <p class="text-black text-center">{{'Description'}}</p>
                    <p class="text-align">Le Data Challenge de ce mois-ci est dédié à la recherche de solutions innovantes pour relever les défis 
                        environnementaux auxquels notre planète est confrontée. Nous invitons les participants à mettre leurs 
                        compétences en analyse de données au service de l'environnement et à proposer des idées qui pourraient 
                        avoir un impact positif sur la durabilité de notre monde.
                        Que vous soyez un scientifique des données expérimenté, un étudiant passionné 
                        ou un professionnel curieux, ce Data Challenge vous offre une occasion unique d'explorer 
                        des ensembles de données environnementales, d'extraire des informations clés et de proposer
                         des solutions concrètes.</p>


                </div>
            </div>
            <div></div>
            <div></div><div></div>
            
           
     
        </main>
    </body>
</html>