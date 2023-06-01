<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Réponse de l\'équipe') }} "{{$team->name}}"
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <a class="voirP rounded-lg" href="javascript:history.back()">Revenir à l'ensemble des équipes</a>
        <div class="overflow-hidden shadow-lg  sm:rounded-lg mt-8">
            <div class="p-6 bg-white border-b border-gray-200">
            <table class="w-full">
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
            @is('manager')
                <form class="mt-6" action="{{ route('grades.store', ['quiz' => $quiz, 'team' => $team]) }}" method="POST">
                    @csrf
                    @method('POST')
                    
                    <label  for="grade">Note</label>
                    <input type="number" id="grade" name="grade" min="0" max="4" required>


                    <button class="voirP rounded-lg" type="submit">Enregistrer</button>
                </form>
            @endis
        </div>
    </div>

</x-app-layout>
