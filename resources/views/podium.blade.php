<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Podium') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-lg  sm:rounded-lg mt-8">
                <div class="p-6 bg-white border-b border-gray-200">
                @foreach ($quizzes as $quiz)
                        <div>

                            @if ($team->hasAnsweredQuiz($quiz))
                                <a href="{{ route('quizzes.answers', ['quiz' => $quiz]) }}">Voir les
                                    réponses</a>
                            @else
                                <a href="{{ route('quizzes.show', ['quiz' => $quiz]) }}">
                                    {{ $quiz->name }}
                                </a>
                            @endif

                            @is('manager')
                                <form action="{{ route('quizzes.destroy', $quiz->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"
                                        onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce QCM ?')">Supprimer</button>
                                </form>
                                <a href="{{ route('quizzes.edit', ['project' => $project, 'quiz' => $quiz->id]) }}">Modifier
                                </a>
                            @endis
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
