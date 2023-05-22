<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Contests') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <x-form action="{{ route('contests.store') }}">
                    <x-form-input name="name" label="Nom" required />
                    <x-form-textarea name="description" label="Description" required />
                    <x-form-input type="datetime-local" name="start" label="Début de l'activation" required />
                    <x-form-input type="datetime-local" name="end" label="Fin de l'activation" required />
                    <x-form-submit />
                </x-form>
            </div>
        </div>
    </div>
</x-app-layout>
