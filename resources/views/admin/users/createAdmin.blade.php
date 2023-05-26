<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Créer un nouvel administrateur
        </h2>
    </x-slot>

    <a href="{{ route('admin.users.create') }}" id="changerType" style="text-decoration:underline">Changer de type d'utilisateur</a>

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <x-form action="{{ route('admin.users.storeAdmin') }}">
            <x-form-input name="name" :label="__('Name')" required />
            <x-form-input type="email" name="email" :label="__('Email')" required />
            <x-form-input type="tel" name="telephone" :label="__('Telephone')" required />
            <x-form-input type="password" name="password" :label="__('Password')" required />
            <x-form-input type="password" name="password_confirmation" :label="__('Confirm Password')" required />
            <x-form-submit />
        </x-form>
    </div>
</x-app-layout>