<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Projects') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-xl sm:rounded-lg p-6 bg-accueil_pale">
                <x-form action="{{ route('contests.projects.store', ['contest' => $contest->id]) }}">
                    <x-form-input name="name" label="Nom" required />
                    <x-form-textarea name="description" label="Description" required />
                    <x-form-submit />
                </x-form>
            </div>
        </div>
    </div>
</x-app-layout>
