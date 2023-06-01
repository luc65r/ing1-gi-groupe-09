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
            <a class="voirP rounded-lg" href="javascript:history.back()">Revenir en arrière</a>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    {!! \Illuminate\Support\Str::markdown($project->description) !!}
                </div>
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

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-6">

                    <div class="p-6 bg-white border-b border-gray-200 shadow-lg bg-accueil_pale">
                        <h1 class="text-lg">Description:</h1>
                        {!! \Illuminate\Support\Str::markdown($project->description) !!}

                        <p>
                            Ressources :
                            @foreach ($project->resources as $resource)
                                <a href="{{ $resource->url }}">{{ $resource->name }}</a>
                            @endforeach

                            @is('admin')
                                <x-form action="{{ route('projects.resources.store', compact('project')) }}">
                                    <x-form-input name="name" label="Nom" required />
                                    <x-form-input name="url" type="url" label="Adresse" required />
                                    <x-form-submit />
                                </x-form>
                            @endis
                        </p>

                        <div class="mt-6 flex">

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
</x-app-layout>
