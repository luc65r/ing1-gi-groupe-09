<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Créer un nouvel étudiant
        </h2>
    </x-slot>

    <a href="{{ route('admin.users.create') }}" id="changerType" style="text-decoration:underline" class="hidden">Changer de type d'utilisateur</a>

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <x-form action="{{ route('admin.users.storeStudent') }}">
            <x-form-input name="name" :label="__('Name')" required />
            <x-form-input type="email" name="email" :label="__('Email')" required />
            <x-form-input type="tel" name="telephone" :label="__('Telephone')" required />
            <x-form-input name="school" :label="__('School')" required />
            <x-form-select name="educationLevel" :label="__('Education level')" required>
                <option value="L1">{{ __('Licence 1') }}</option>
                <option value="L2">{{ __('Licence 2') }}</option>
                <option value="L3">{{ __('Licence 3') }}</option>
                <option value="M1">{{ __('Master 1') }}</option>
                <option value="M2">{{ __('Master 2') }}</option>
                <option value="D">{{ __('Doctorate') }}</option>
            </x-form-select>
            <x-form-input name="city" :label="__('City')" required />
            <x-form-input type="password" name="password" :label="__('Password')" required />
            <x-form-input type="password" name="password_confirmation" :label="__('Confirm Password')" required />
            <x-form-submit />
        </x-form>
    </div>
</x-app-layout>
