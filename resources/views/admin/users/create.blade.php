<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Créer un nouvel utilisateur
        </h2>
    </x-slot>

    <div class="py-6 ">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 ">
                <div class="p-6 bg-accueil_pale border-b border-gray-200 flex justify-center text-center rounded-lg shadow-lg">
                    <div id="choixType" class="py-12 flex ">
                        <div>
                            <a class="voirP rounded-lg mr-7" href="{{ route('admin.users.createStudent') }}">Etudiant</a>
                        </div>
                        <div>
                            <a class="voirP rounded-lg mr-7" href="{{ route('admin.users.createManager') }}">Gestionnaire</a>
                        </div>
                        <div>
                            <a class="voirP rounded-lg mr-7" href="{{ route('admin.users.createAdmin') }}">Administrateur</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
