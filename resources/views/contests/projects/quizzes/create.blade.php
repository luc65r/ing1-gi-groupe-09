<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('QCM') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <a class="voirP rounded-lg" href="javascript:history.back()">
                Retour à la liste des quiz
            </a>
            <div class="overflow-hidden shadow-xl sm:rounded-lg p-6 bg-accueil_pale mt-6">


                    <x-form action="{{ route('projects.quizzes.store', ['project' => $project]) }}" id="form">
                        <x-form-input name="name" label="Nom" required />
                        <x-form-input name="question1" label="Question 1" required />
                        <x-form-input name="question2" label="Question 2" required />
                        <x-form-input name="question3" label="Question 3" required />
                        <x-form-input name="question4" label="Question 4" required />
                        <x-form-input name="question5" label="Question 5" required />
                        <x-form-input type="datetime-local" name="start" label="Début du quiz" required />
                        <x-form-input type="datetime-local" name="end" label="Fin du quiz" required />
                        <x-form-submit class="voirP rounded-lg" />
                    </x-form>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
