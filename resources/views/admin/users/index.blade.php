<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Liste des utilisateurs
        </h2>
    </x-slot>

    <div class="py-6 ">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 ">
        <a class="btn btn-primary" href="{{ route('admin.users.create') }}">Créer un nouvel utilisateur</a>

            <div class="overflow-hidden shadow-sm sm:rounded-lg ">

                <div class="p-6 bg-white border-b border-gray-200 flex justify-center text-center bg-bleu-logo ">
                    <ul>
                        
                        @foreach ($users as $user)
                            <li>
                                {{ $user->name }} - {{ $user->email }}
                                <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-primary">Modifier</a>
                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')">Supprimer</button>
                                </form>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
