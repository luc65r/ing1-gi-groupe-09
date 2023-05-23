<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Projects') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @is('admin')
                    <a href="{{ route('contests.projects.create', ['contest' => $contest->id]) }}">
                        Nouveau
                    </a>
                @endis
                <div class="p-6 bg-white border-b border-gray-200">
                    @foreach ($projects as $project)
                        <div>
                            <a href="{{ route('projects.show', $project->id) }}">
                                {{ $project->name }}
                            </a>
                            <form action="{{ route('projects.destroy', $project->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')">Supprimer</button>
                            </form>
                            <a href="{{ route('projects.edit', $project->id) }}">Modifier</a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
