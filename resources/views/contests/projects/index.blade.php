<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Projects') }}
        </h2>
    </x-slot>
    <a href="javascript:history.back()">Revenir en arrière</a>
    <div class="py-12">
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
                                    <button onclick="toggleSearchBar()">Assigner un gestionnaire au projet</button>
                                </div>

                                <div id="searchBar" style="display: none;">
                                    <input type="text" id="searchInput" placeholder="Rechercher un gestionnaire"
                                        oninput="searchManagers()">
                                    <ul id="searchResults"></ul>
                                </div>

                                <script>
                                    function toggleSearchBar() {
                                        var searchBar = document.getElementById('searchBar');
                                        if (searchBar.style.display === 'none') {
                                            searchBar.style.display = 'block';
                                        } else {
                                            searchBar.style.display = 'none';
                                        }
                                    }

                                    function searchManagers() {
                                        var searchInput = document.getElementById('searchInput').value;
                                        var searchResults = document.getElementById('searchResults');

                                        // Effacer les résultats de recherche précédents
                                        searchResults.innerHTML = '';

                                        // Vérifier si la recherche n'est pas vide
                                        if (searchInput.trim() !== '') {
                                            // Envoyer une requête AJAX pour effectuer la recherche
                                            var xhr = new XMLHttpRequest();
                                            xhr.open('GET', '{{ route('managers.search') }}?search=' + encodeURIComponent(searchInput), true);
                                            xhr.onreadystatechange = function() {
                                                if (xhr.readyState === 4 && xhr.status === 200) {
                                                    var managers = JSON.parse(xhr.responseText);

                                                    // Afficher les résultats de recherche
                                                    managers.forEach(function(manager) {
                                                        var listItem = document.createElement('li');
                                                        listItem.textContent = manager.name;
                                                        searchResults.appendChild(listItem);
                                                    });
                                                }
                                            };
                                            xhr.send();
                                        }
                                    }
                                </script>
                            @endis
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
