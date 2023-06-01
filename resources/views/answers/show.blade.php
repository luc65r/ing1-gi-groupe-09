<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('QCM') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
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
                    @is('manager')
                        <td>
                            <form action="{{ route('grades.store', ['quiz' => $quiz, 'team' => $team]) }}" method="POST">
                                @csrf
                                @method('POST')
                                <label for="grade">Note</label>
                                <input type="number" id="grade" name="grade" required>

                                <button type="submit">Enregistrer</button>
                            </form>


                        </td>
                    @endis
                </tbody>
            </table>
        </div>
    </div>

</x-app-layout>
