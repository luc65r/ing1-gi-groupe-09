<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Créer un nouvel utilisateur
        </h2>
    </x-slot>

    <div id="choixType" class="py-12">
        <div>
            <a href="{{ route('admin.users.createStudent') }}">Etudiant</a>
        </div>
        <div>
            <a href="{{ route('admin.users.createManager') }}">Gestionnaire</a>
        </div>
        <div>
            <a href="{{ route('admin.users.createAdmin') }}">Administrateur</a>
        </div>
    </div>
</x-app-layout>
