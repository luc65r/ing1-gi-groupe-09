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
            @php
                $currentDateTime = now();
                $activeQuiz = DB::table('quizzes')
                    ->where('start', '<=', $currentDateTime)
                    ->where('end', '>=', $currentDateTime)
                    ->first();
                // dd($activeQuiz);
            @endphp
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
                                    @is('student')
                                        <th>Action</th>
                                    @else
                                        @is('manager')
                                            <th>Actions</th>
                                        @endis
                                    @endis
                                </tr>
                            </thead>

                            <tbody>
                                
                                    @is('manager')
                                        @foreach ($quizzes as $quiz)
                                        <tr>
                                            <td class="justify-center text-center">
                                                <a href="{{ route('quizzes.show', ['quiz' => $quiz]) }}">
                                                    {{ $quiz->name }}
                                                </a>
                                            </td>
                                            <td class="flex justify-center text-center">

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
                                            </td>
                                        </tr>
                                        @endforeach
                                    @endis
                                    @is('student')
                                        @php
                                            $user = Auth::user();
                                            $team = $user->student
                                                ->teams()
                                                ->whereBelongsTo($project)
                                                ->first();
                                        @endphp
                                        <td class="justify-center text-center">
                                            <a href="{{ route('quizzes.show', ['quiz' => $activeQuiz->id]) }}">
                                                {{ $activeQuiz->name }}
                                            </a>
                                        </td>
                                        @dump($team->hasAnsweredQuiz($activeQuiz))
                                        @if ($team && $team->hasAnsweredQuiz($activeQuiz))
                                            <a class="voirP rounded-lg"
                                                href="{{ route('quizzes.show', ['quiz' => $activeQuiz->id]) }}">
                                                {{ 'Voir les quetions' }}
                                            </a>
                                        @else
                                            <a class="voirP rounded-lg"
                                                href="{{ route('quizzes.show', ['quiz' => $activeQuiz->id]) }}">
                                                {{ 'Voir les quedsqtions' }}
                                            </a>
                                        @endif
                                    @else

                                    @endis

                                </tr>

                            </tbody>
                        @endif
                    </table>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
