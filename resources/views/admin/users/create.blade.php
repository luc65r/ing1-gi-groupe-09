<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Créer un nouvel utilisateur
        </h2>
    </x-slot>

    <div id="choixType" class="py-12">
        <div class="mb-4">
            <a href="{{ route('admin.users.createStudent') }}" class="custom-link bg-indigo-500">
                <div class="flex items-center justify-center h-16 rounded-lg shadow-lg">
                    <span class="text-white text-2xl font-bold" style="color:black;">Etudiant</span>
                </div>
            </a>
        </div>
        <div class="mb-4">
            <a href="{{ route('admin.users.createManager') }}" class="custom-link bg-green-500">
                <div class="flex items-center justify-center h-16 rounded-lg shadow-lg">
                    <span class="text-white text-2xl font-bold" style="color:black;" >Gestionnaire</span>
                </div>
            </a>
        </div>
        <div>
            <a href="{{ route('admin.users.createAdmin') }}" class="custom-link bg-red-500">
                <div class="flex items-center justify-center h-16 rounded-lg shadow-lg">
                    <span class="text-white text-2xl font-bold" style="color:black;">Administrateur</span>
                </div>
            </a>
        </div>
    </div>
</x-app-layout>
