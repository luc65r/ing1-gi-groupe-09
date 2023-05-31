<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Projects') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <a class="voirP rounded-lg" href="javascript:history.back()">Revenir à l'évènement</a>

            @is('admin')
                <a class="voirP rounded-lg" href="{{ route('contests.projects.create', ['contest' => $contest]) }}">
                    Ajouter un projet à l'évènement
                </a>
            @endis
            <div class="overflow-hidden shadow-lg  sm:rounded-lg mt-8">
                <div class="p-6 bg-white border-b border-gray-200">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th>Nom</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($projects as $project)
                                <tr>
                                    <div>
                                        <td class="px-6 py-4 text-center">
                                            <a>
                                                {{ $project->name }}
                                            </a>
                                        </td>

                                        <td class="px-6 py-4 text-center ">

                                            @is('admin')
                                                <form action="{{ route('projects.destroy', $project->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="voirP rounded-lg"type="submit" class="btn btn-danger"
                                                        onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')">Supprimer</button>
                                                </form>
                                                <div>
                                                    <a class="voirP rounded-lg"
                                                        href="{{ route('projects.edit', $project->id) }}">Modifier</a>
                                                </div>
                                                <div>
                                                    <button class="voirP rounded-lg" onclick="toggleSearchBar()">Assigner un
                                                        gestionnaire au projet</button>
                                                </div>

                                                <div id="searchBar" style="display: none;">
                                                    <input type="text" id="searchInput"
                                                        placeholder="Rechercher un gestionnaire" oninput="searchManagers()">
                                                    <ul id="searchResults"></ul>
                                                </div>
                                            @endis

                                            <a href="{{ route('projects.show', $project->id) }}"
                                                class="voirP rounded-lg">Voir le détails</a>
                                        </td>

                                    </div>
                                </tr>
                            @endforeach


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @is('admin')
    <a href="{{ route('contests.projects.create', ['contest' => $contest]) }}">
                            Nouveau
                        </a>
@endis

                <div class="p-6 bg-white border-b border-gray-200">
                    @foreach ($projects as $project)
<div>
                            <a href="{{ route('projects.show', $project->id) }}">
                                {{ $project->name }}
                            </a>
                            @is('admin')
    <form action="{{ route('projects.destroy', $project->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"
                                            onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')">Supprimer</button>
                                    </form>
                                    <div>
                                        <a href="{{ route('projects.edit', $project->id) }}">Modifier</a>
                                    </div>
                                    <div>
                                        <form action="{{ route('projects.assign', ['project' => $project->id]) }}"
                                            method="POST">
                                            @csrf
                                            <div>
                                                <label for="manager-choice">Sélectionner un manager :</label>
                                                <input list="list-manager" id="manager-choice" name="manager-choice"
                                                    autocomplete="off">

                                                <datalist id="list-manager">
                                                    @foreach ($managers as $manager)
    <option value="{{ $manager->user->name }}">
    @endforeach
                                                </datalist>
                                            </div>
                                            <button type="submit">Assigner</button>
                                        </form>
                                    </div>
@endis
                        </div>
@endforeach


                </div>
            </div>
        </div>
    </div> -->
</x-app-layout>
