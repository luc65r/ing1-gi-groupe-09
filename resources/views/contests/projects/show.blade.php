<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $project->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    {!! \Illuminate\Support\Str::markdown($project->description) !!}
                </div>
                <div class="p-6 bg-white border-b border-gray-200">
                    <a href="{{ route('projects.quizzes.index', ['project' => $project]) }}">Quizz</a>
                </div>
                @php
                    $loggedInUser = Auth::user();
                    $hasTeam = false;
                    
                    if ($loggedInUser->type === 'student') {
                        $student = \App\Models\Student::where('user_id', $loggedInUser->id)->first();
                        $hasTeam = $student && $student->teams->isNotEmpty();
                    }
                @endphp

                @if ($hasTeam)
                    <div class="p-6 bg-white border-b border-gray-200">
                        <a href="">Voir mon équipe</a>
                    </div>
                @else
                    <div class="p-6 bg-white border-b border-gray-200">
                        <a href="{{ route('projects.teams.create', ['project' => $project]) }}">Créer mon
                            équipe</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
