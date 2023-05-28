<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('QCM') }}
        </h2>
    </x-slot>
    <a href="javascript:history.back()">Revenir en arrière</a>

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
                            @is('manager')
                                <form action="{{ route('quizzes.destroy', $quiz->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"
                                        onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce QCM ?')">Supprimer</button>
                                </form>
                                <a
                                    href="{{ route('quizzes.edit', ['project' => $project, 'quiz' => $quiz->id]) }}">Modifier</a>
                            @endis
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
