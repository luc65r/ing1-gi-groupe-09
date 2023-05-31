<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Contests') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <a class="voirP rounded-lg" href="javascript:history.back()">
                Retour à la liste des évènements
            </a>
            <div class="overflow-hidden shadow-xl sm:rounded-lg p-6 bg-accueil_pale mt-6">
                <x-form action="{{ route('contests.store') }}">
                    <x-form-input name="name" label="Nom" required />
                    <x-form-textarea name="description" label="Description" required />
                    <x-form-select name="type" label="Type du contest" required>
                        <option value="">Sélectionner le type</option>
                        <option value="battle">Battle</option>
                        <option value="challenge">Challenge</option>
                    </x-form-select>

                    <x-form-input type="datetime-local" name="start" label="Début de l'activation" required />
                    <x-form-input type="datetime-local" name="end" label="Fin de l'activation" required />
                    <x-form-submit />
                </x-form>
            </div>
        </div>
    </div>
</x-app-layout>
