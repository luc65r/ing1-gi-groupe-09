<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Créer un nouvel administrateur
        </h2>
    </x-slot>


    <div class="py-6 ">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 ">
            <a class="btn btn-primary voirP rounded-lg mb-3" href="{{ route('admin.users.create') }}" id="changerType">Changer de type d'utilisateur</a>
                <div class="p-6 bg-accueil border-b border-gray-200 flex justify-center text-center rounded-lg mt-6">
                    <div id="choixType" class="py-12 ">        
                        <x-form action="{{ route('admin.users.storeAdmin') }}">
                        <x-form-input name="name" :label="__('Name')" required />
                        <x-form-input type="email" name="email" :label="__('Email')" required />
                        <x-form-input type="tel" name="telephone" :label="__('Telephone')" required />
                        <x-form-input type="password" name="password" :label="__('Password')" required />
                        <x-form-input type="password" name="password_confirmation" :label="__('Confirm Password')" required />
                        <x-form-submit />
                        </x-form>
                    </div>
                </div>
            </div>

        </div>
</x-app-layout>