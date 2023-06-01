<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-6 ">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 ">
            <div class="overflow-hidden shadow-lg sm:rounded-lg ">
                <div class="p-6 bg-white border-b border-gray-200 flex justify-center text-center bg-bleu-logo ">
                    <!-- <p class="text-white">Bienvenue sur votre page</p> -->
                            
                    <!-- Pour le data du moment -->
                    <div class="rounded-md shadow-lg bg-white w-45P h-200 mx-auto mr-6 avanc">
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
                    <div class="rounded-md shadow-lg bg-white w-45P h-200 mx-auto avanc">
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

            </div>
        </div>
    </div>
</x-app-layout>
