<x-app-layout>

    @push('head')
        <script src="{{ asset('js/quiz.js') }}"></script>
    @endpush

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('QCM') }}
        </h2>
    </x-slot>
    <a href="javascript:history.back()">Revenir en arrière</a>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <x-form action="{{ route('projects.quizzes.store', ['project' => $project]) }}" id="form">
                    <x-form-input name="name" label="Nom" required />
                    <x-form-input name="question1" label="Question 1" required />
                    <x-form-input name="question2" label="Question 2" required />
                    <x-form-input name="question3" label="Question 3" required />
                    <x-form-input name="question4" label="Question 4" required />
                    <x-form-input name="question5" label="Question 5" required />
                    <x-form-submit />
                </x-form>
            </div>
        </div>
    </div>

</x-app-layout>
