<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Quizz') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <form action="{{ route('quizzes.update', ['project' => $project, 'quiz' => $quiz]) }}" method="POST">
                @csrf
                @method('PUT')

                <x-form action="{{ route('quizzes.update', ['project' => $project, 'quiz' => $quiz]) }}">

                    <x-form-input name="name" label="Nom" value="{{ $quiz->name }}" required />

                    <x-form-input name="question1" label="Question 1" value="{{ $quiz->questions[0]->question }}"
                        required />
                    <x-form-input name="question2" label="Question 2" value="{{ $quiz->questions[1]->question }}"
                        required />
                    <x-form-input name="question3" label="Question 3" value="{{ $quiz->questions[2]->question }}"
                        required />
                    <x-form-input name="question4" label="Question 4" value="{{ $quiz->questions[3]->question }}"
                        required />
                    <x-form-input name="question5" label="Question 5" value="{{ $quiz->questions[4]->question }}"
                        required />

                    <x-form-submit />
                </x-form>

            </form>

        </div>
    </div>
</x-app-layout>
