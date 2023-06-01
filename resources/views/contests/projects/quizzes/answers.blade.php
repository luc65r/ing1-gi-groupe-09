<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Équipes') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <a class="voirP rounded-lg" href="javascript:history.back()">Revenir à la liste des quizz</a>

            <div class="overflow-hidden shadow-xl sm:rounded-lg p-6 bg-accueil_pale mt-6">
                <div class="p-6 bg-white border-b border-gray-200 rounded-lg">
                    <b><h1 class="underline">{{ $quiz->name }}</h1></b>
                    <table>
                        <thead>
                            <tr>
                                <th>Question</th>
                                <th>Réponse</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($quiz->questions as $question)
                                <tr>
                                    <td>{{ $question->question }}</td>
                                    <td>
                                        @foreach ($question->answers as $answer)
                                            {{ $answer->answer }}
                                        @endforeach
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <a href="{{ route('quizzes.edit', $quiz) }}">Modifier</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
