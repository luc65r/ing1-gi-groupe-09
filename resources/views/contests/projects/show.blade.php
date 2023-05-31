<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $project->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <a class="voirP rounded-lg" href="javascript:history.back()">Revenir en arrière</a>

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-6">
                <div class="p-6 bg-white border-b border-gray-200 shadow-lg bg-accueil_pale">                
                    <h1 class="text-lg">Description:</h1> 
                        {!! \Illuminate\Support\Str::markdown($project->description) !!}
                    
                        <div class="mt-6 flex">
                            <a class="voirP rounded-lg" href="{{ route('projects.quizzes.index', ['project' => $project]) }}">Répondre au quizz</a>

                            @is('student')
                                @php
                                    $user = Auth::user();
                                    $team = $user->student
                                        ->teams()
                                        ->whereBelongsTo($project)
                                        ->first();
                                @endphp

                                @if ($team)
                                        <a href="{{ route('teams.show', ['team' => $team]) }}" class="voirP rounded-lg">Voir mon équipe</a>
                                @else
                                        <a href="{{ route('projects.teams.create', ['project' => $project]) }}" class="voirP rounded-lg">Créer mon équipe</a>
                                @endif
                            @endis

                        </div>

            </div>
        </div>
    </div>
</x-app-layout>
