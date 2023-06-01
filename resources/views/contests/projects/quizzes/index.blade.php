<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Quiz') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <a class="voirP rounded-lg" href="javascript:history.back()">Revenir au projet</a>
            @is('manager')
                <a class="voirP rounded-lg" href="{{ route('projects.quizzes.create', ['project' => $project]) }}">
                    Nouveau quiz
                </a>
            @endis
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-6">

                <div class="p-6 bg-white border-b border-gray-200">

                    <table class="min-w-full divide-y divide-gray-200">
                        @php
                            $nb_quizz = count($quizzes);
                        @endphp

                        @if ($nb_quizz === 0)
                            <p>Pas de quiz disponible</p>
                        @else
                            <thead>
                                <tr>
                                    <th>Nom</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($quizzes as $quiz)
                                    <tr>
                                        <td class="justify-center text-center">
                                            <a href="{{ route('quizzes.show', ['quiz' => $quiz]) }}">
                                                {{ $quiz->name }}
                                            </a>
                                        </td>
                                        <td class="flex justify-center text-center">
                                            @is('manager')
                                                <form action="{{ route('quizzes.destroy', $quiz->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="voirP mr-2 rounded-lg" type="submit"
                                                        class="btn btn-danger"
                                                        onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce quiz ?')">Supprimer</button>
                                                </form>
                                                <a class="voirP voirP mr-2 rounded-lg"
                                                    href="{{ route('quizzes.edit', ['project' => $project, 'quiz' => $quiz->id]) }}">Modifier
                                                </a>
                                                <a class="voirP rounded-lg"
                                                    href="{{ route('quizzes.teams', ['quiz' => $quiz]) }}">Voir les
                                                    réponses</a>
                                            @else
                                                @is('student')
                                                    @php
                                                        $user = Auth::user();
                                                        $team = $user->student
                                                            ->teams()
                                                            ->whereBelongsTo($project)
                                                            ->first();
                                                    @endphp
                                                    @if ($team->hasAnsweredQuiz($quiz))
                                                        <a class="voirP rounded-lg"
                                                            href="{{ route('answers.show', ['team' => $team, 'quiz' => $quiz]) }}">
                                                            {{ 'Voir les réponses' }}
                                                        </a>
                                                    @else
                                                        <a class="voirP rounded-lg"
                                                            href="{{ route('quizzes.show', ['quiz' => $quiz]) }}">
                                                            {{ 'Voir les questions' }}
                                                        </a>
                                                    @endif
                                                @endis
                                            @endis

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        @endif
                    </table>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
