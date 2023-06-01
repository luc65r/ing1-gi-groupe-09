<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Contests') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-xl sm:rounded-lg p-6 bg-accueil_pale">


                <x-form action="{{ route('contests.update', $contest) }}" method="PUT">
                    <x-form-input name="name" label="Nom" value="{{ $contest->name }}" required />
                    <x-form-textarea name="description" label="Description" required />
                    <x-form-select name="type" label="Type du contest" required>
                        <option value="">Sélectionner le type</option>
                        <option  value="battle">Battle</option>
                        <option value="challenge">Challenge</option>
                    </x-form-select>                        <x-form-input name="start" label="Début" value="{{ $contest->start }}" required />
                    <x-form-input name="end" label="Fin" value="{{ $contest->end }}" required />
                    <x-form-submit class="voirP rounded-lg" />
                </x-form>
            </div>
        </div>
    </div>
</x-app-layout>
