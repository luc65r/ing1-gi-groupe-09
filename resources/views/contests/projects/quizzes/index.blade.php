<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('QCM') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @is('manager')
                    <a href="{{ route('projects.quizzes.create', ['project' => $project]) }}">
                        Nouveau
                    </a>
                @endis
                <div class="p-6 bg-white border-b border-gray-200">
                    @foreach ($quizzes as $quiz)
                        <div>
                            <a href="{{ route('quizzes.show', ['quiz' => $quiz]) }}">
                                {{ $quiz->name }}
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
