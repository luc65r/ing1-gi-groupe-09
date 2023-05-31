@php
    use App\Models\Team;
@endphp

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $quiz->name }}
        </h2>
    </x-slot>
    <a href="javascript:history.back()">Revenir au projet</a>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    @php
                        $loggedInUser = Auth::user();
                        $team = null;
                        
                        if ($loggedInUser->hasRole('student')) {
                            $team = $loggedInUser->student->teams()->first();
                        }
                    @endphp

                    <x-form action="" method="POST">
                        @foreach ($questions as $question)
                            <div class="p-6 bg-white border-b border-gray-200 block">
                                {{ $question->question }}
                                @if ($team && $team->students->first()->user->id === $loggedInUser->student->user->id)
                                    <x-form-textarea name="reponse" label="Réponse" required />
                                @endif

                            </div>
                        @endforeach


                        @if ($team && $team->students->first()->user->id === $loggedInUser->student->user->id)
                            <div>
                                <x-form-submit></x-form-submit>
                            </div>
                        @elseif ($loggedInUser->hasRole('student'))
                            <div>
                                <div class="p-6 bg-white border-b border-gray-200 block">
                                    Vous n'êtes pas autorisé à répondre
                                </div>
                            </div>
                        @endif

                    </x-form>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
