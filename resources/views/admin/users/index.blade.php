<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Liste des utilisateurs
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <a class="btn btn-primary voirP rounded-lg mb-3" href="{{ route('admin.users.create') }}">Créer un nouvel utilisateur</a>
            <input id="filterbar" onkeyup="filter_users()" placeholder="Filtrer utilisateurs" />

            <div class="overflow-hidden shadow-lg  sm:rounded-lg mt-8">
                <div class="p-6 bg-white border-b border-gray-200">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th>Nom</th>
                                <th>Email</th>
                                <th>Type</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr class="user">
                                    <td class="px-6 py-4 text-center">{{ $user->name }}</td>
                                    <td class="px-6 py-4 text-center">{{ $user->email }}</td>
                                    @if ($user->hasRole('student'))
                                        <td class="px-6 py-4 text-center">{{'Etudiant'}}</td>
                                    @else
                                        @if ($user->hasRole('admin'))
                                            <td class="px-6 py-4 text-center">{{'Administrateur'}}</td>
                                        @else
                                            <td class="px-6 py-4 text-center">{{'Gestionnaire'}}</td>
                                        @endif
                                    @endif
                                    <td class="px-6 py-4 text-center">
                                        <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-primary voirP rounded-lg">Modifier</a>
                                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-primary voirP rounded-lg" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')">Supprimer</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script>
     function filter_users() {
         const input = document.querySelector('#filterbar').value
                               .toLowerCase();

         for (const e of document.querySelectorAll('.user')) {
             e.style.display = e.innerHTML.toLowerCase().includes(input)
                             ? "" : "none";
         }
     }
    </script>
</x-app-layout>
