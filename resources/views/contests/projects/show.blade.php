<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $project->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        @is('student')
        @php
        $user = Auth::user();
        $team = $user->student
            ->teams()
            ->whereBelongsTo($project)
            ->first();
        @endphp
        @endis
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <a href="{{ route('contests.projects.index', $project->contest) }}" class="voirP rounded-lg ">Revenir à la liste de projets</a>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-6">

                <div class="p-6 bg-white border-b border-gray-200 shadow-lg bg-accueil_pale">

                    <h1 class="text-lg">Description:</h1>
                    {!! \Illuminate\Support\Str::markdown($project->description) !!}

                    <p class="mt-3">
                        Ressources :
                        <br>
                        @php
                        $i =0;
                        @endphp
                        @foreach ($project->resources as $resource)
                            @php
                            $i +=1;
                            @endphp
                            {{$i}})
                            <a class="underline" href="{{ $resource->url }}">  {{$resource->name }}</a>
                            <br>
                        @endforeach

                        <br>
                        @is('admin')
                        <h1>Ajouter une ressource:</h1>
                        <x-form action="{{ route('projects.resources.store', compact('project')) }}">
                            <x-form-input name="name" label="Nom" required />
                            <x-form-input name="url" type="url" label="URL" required />
                            <x-form-submit class="voirP rounded-lg" />
                        </x-form>
                        @endis
                    </p>

                    <div class="mt-6 flex">

                        @if ($project->contest->type === 'battle')
                            @is('student')
                            @if ($team)
                                <div class="p-6 bg-white border-b border-gray-200">
                                    <a href="{{ route('projects.quizzes.index', ['project' => $project]) }}">Quizz</a>
                                </div>
                            @endif
                        @else
                            <div class="p-6 bg-white border-b border-gray-200">
                                <a href="{{ route('projects.quizzes.index', ['project' => $project]) }}">Quizz</a>
                            </div>
                            @endis

                        @endif

                        @if ($project->contest->type === 'battle')
                            <a class="voirP rounded-lg" href="{{ route('projects.quizzes.index', ['project' => $project]) }}">Quizz</a>
                        @endif
                        @is('student')
                        @if ($team)
                            @php
                            $quiz = $project->quizzes()->first();
                            @endphp
                            @if ($team->answers()->whereBelongsTo($quiz->questions()->first())->exists())
                                <a class="voirP rounded-lg"
                                   href="{{ route('projects.quizzes.answers', ['project' => $project, 'quiz' => $quiz]) }}">Voir
                                    les réponses</a>
                            @else
                                <a class="voirP rounded-lg"
                                   href="{{ route('projects.quizzes.index', ['project' => $project, 'team' => $team]) }}">Répondre
                                    au
                                    quizz</a>
                            @endif
                        @endif
                        @if ($team)
                            <a href="{{ route('teams.show', ['team' => $team]) }}"
                               class="voirP rounded-lg ml-2">Voir mon équipe</a>
                        @else
                            <a href="{{ route('projects.teams.create', ['project' => $project]) }}"
                               class="voirP rounded-lg ml-2">Créer mon équipe</a>
                        @endif
                        @endis

                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
