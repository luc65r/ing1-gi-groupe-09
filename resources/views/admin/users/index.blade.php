<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Liste des utilisateurs
        </h2>
    </x-slot>
    
    <div class="flex justify-center" >
        <a class="btn btn-primary custom-link" href="{{ route('admin.users.create') }}" >+</a>
        <x-input id="searchbar" onkeyup="search_animal()" placeholder="Rechercher utilisateur" class="custom-input" />
    </div>
    <div class="flex justify-center">
        <ol id='list' class="w-full max-w-md" class="flex justify-center">
            @foreach ($users as $user)
                <li class="animals" class="flex justify-center">
                <div id="nom" class="font-bold text-lg">{{ $user->name }}</div>
 - {{ $user->email }} 
                    @if ($user->hasRole('admin'))
                        (Administrateur)
                    @endif
                    
                    @if ($user->hasRole('student'))
                        (Etudiant)
                    @endif
                    @if ($user->hasRole('manager'))
                        (Gestionnaire)
                    @endif
                    <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-primary custom-button">Modifier</a>
                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger custom-button" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')">Supprimer</button>
                    </form>
                </li>
            @endforeach   
        </ol>
    </div>   <!-- <ul>
        
        @foreach ($users as $user)
            <li>
                {{ $user->name }} - {{ $user->email }} 
                @if ($user->hasRole('admin'))
                    (Administrateur)
                @endif
                
                @if ($user->hasRole('student'))
                    (Etudiant)
                @endif
                @if ($user->hasRole('manager'))
                    (Gestionnaire)
                @endif
                <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-primary">Modifier</a>
                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')">Supprimer</button>
                </form>
            </li>
        @endforeach
    </ul> -->

    <script>
    function search_animal() {
            let input = document.getElementById('searchbar').value;
            input = input.toLowerCase();
            let x = document.getElementsByClassName('animals');
            
            let count = 0;

            for (i = 0; i < x.length; i++) {
                if (!x[i].innerHTML.toLowerCase().includes(input)) {
                    x[i].style.display = "none";
                } else {
                    
                    x[i].style.display = "list-item";
                    count++;
                    
                }
            }
        }
    </script>
    <style>
        /* Ajouter une classe CSS pour la décoration des éléments de la liste */
        .animals {
            background-color: #f1f1f1; /* Couleur de fond gris clair */
            padding: 5px; /* Espacement intérieur */
            margin-bottom: 5px; /* Marge inférieure */
        }
        .animals:hover {
            background-color: #e0e0e0; /* Couleur de fond gris clair au survol */
            cursor: pointer; /* Curseur pointeur au survol */
        }
        .custom-input {
            /* Ajoutez vos styles personnalisés ici */
            background-color: #f1f1f1;
            border: 1px solid #ccc;
            padding: 5px 10px;
            margin-bottom: 10px;
        }

        /* Styles personnalisés pour les boutons */
        .custom-button {
            /* Ajoutez vos styles personnalisés ici */
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-right: 5px;
        }

        /* Styles personnalisés pour les boutons au survol */
        .custom-button:hover {
            /* Ajoutez vos styles personnalisés ici */
            background-color: #45a049;
        }

        .custom-link {
  /* Ajoutez vos styles personnalisés ici */
  background-color: #4CAF50;
  color: white;
  border: none;
  padding: 10px 20px;
  text-decoration: none;
  transition: background-color 0.3s;
  
}

.custom-link:hover {
  /* Ajoutez vos styles personnalisés pour le survol ici */
  background-color: #45a049;
}

    </style>
</x-app-layout>
