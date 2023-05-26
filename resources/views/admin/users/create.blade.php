<!-- @php use App\View\Components\Form; @endphp -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Créer un nouvel Utilisateur
        </h2>

        <br>

        <div id="choixType" class="py-12">

            <button id="boutonEtudiant" onclick="affihcerForm(this)">Etudiant</button> <br>
            <button id="boutonGestionnaire" onclick="affihcerForm(this)">Gestionnaire</button> <br>
            <button id="boutonAdmin" onclick="affihcerForm(this)">Administrateur</button>
        </div>

        <a href="{{ route('admin.users.create') }}" id="changerType" style="text-decoration:underline" class="hidden">Changer de type d'utilisateur</a>
        <!-- Première partie: Etudiant -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <x-form id="formEtudiant" class="hidden" action="{{ action('App\Http\Controllers\UserController@store') }}" method="POST">
            <input type="hidden" name="type" value="etudiant">

            <legend>{{ __('Informations personnelles') }}</legend>
                <div id="adminQuestions">
                    <x-label for="name" :value="__('Nom')" />
                    <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />

                    <x-label for="firstName" :value="__('Prénom')" />
                    <x-input id="firstName" class="block mt-1 w-full" type="text" name="firstName" :value="old('firstName')" required />

                    <x-label for="email" :value="__('Email')" />
                    <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />

                    <x-label for="telephone" :value="__('Numéro de télételephone')" />
                    <x-input id="telephone" class="block mt-1 w-full" type="text" name="telephone" :value="old('telephone')" required />

                    <x-label for="address" :value="__('Adresse')" />
                    <x-input id="address" class="block mt-1 w-full" type="text" name="address" :value="old('address')" required />
                </div>

                <legend>{{ __('Créer le mot de passe') }}</legend>

                <div id="adminQuestions">
                    <x-label for="password" :value="__('Mot de passe')" />
                    <x-input id="password" class="block mt-1 w-full" type="password" name="adminPassword" required />

                    <x-label for="confirmAdminPassword" :value="__('Confirmez le mot de passe')" />
                    <x-input id="confirmAdminPassword" class="block mt-1 w-full" type="password" name="confirmAdminPassword" required />
                </div>

                <legend>{{ __('Etudes') }}</legend>

                <div id="studentQuestions">
                    <!-- Questions spécifiques pour les étudiants -->
                    <x-label for="studentNumber" :value="__('Numéro étudiant')" />
                    <x-input id="studentNumber" class="block mt-1 w-full" type="text" name="studentNumber" :value="old('studentNumber')" />

                    <x-label for="studyCity" :value="__('Ville d\'études')" />
                    <x-input id="studyCity" class="block mt-1 w-full" type="text" name="studyCity" :value="old('studyCity')" />

                    <x-label for="school" :value="__('École')" />
                    <x-input id="school" class="block mt-1 w-full" type="text" name="school" :value="old('school')" />

                    <!-- Liste déroulante pour l'option -->
                    <x-label for="option" :value="__('Option')" />
                    <select id="option" name="option">
                        <option value="option1">{{ __('Mathématiques') }}</option>
                        <option value="option2">{{ __('Informatique') }}</option>
                        <option value="option3">{{ __('Design') }}</option>
                    </select>

                    <!-- Liste déroulante pour le niveau d'études -->
                    <x-label for="niveauEtude" :value="__('Niveau d\'études')" />
                    <select id="niveauEtude" name="niveauEtude">
                        <option value="option1">{{ __('Licence 1') }}</option>
                        <option value="option2">{{ __('Licence 2') }}</option>
                        <option value="option3">{{ __('Licence 3') }}</option>
                        <option value="option2">{{ __('Master 1') }}</option>
                        <option value="option3">{{ __('Master 2') }}</option>
                        <option value="option3">{{ __('Doctorate') }}</option>

                    </select>
                </div>
                <button id="terminer1" type="submit" style="border: solid 1px blue">Terminer</button>
            </fieldset>
         </x-form>
        </div>

        <!-- Deuxième partie: Gestionnaire -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <x-form id="formGestionnaire" class="hidden" action="{{ action('App\Http\Controllers\UserController@store') }}" method="POST">

            <input type="hidden" name="type" value="manager">

            <legend>{{ __('Informations personnelles') }}</legend>
                <div id="adminQuestions">
                    <x-label for="name" :value="__('Nom')" />
                    <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />

                    <x-label for="firstName" :value="__('Prénom')" />
                    <x-input id="firstName" class="block mt-1 w-full" type="text" name="firstName" :value="old('firstName')" required />

                    <x-label for="email" :value="__('Email')" />
                    <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />

                    <x-label for="telephone" :value="__('Numéro de telephone')" />
                    <x-input id="telephone" class="block mt-1 w-full" type="text" name="telephone" :value="old('telephone')" required />

                    <x-label for="address" :value="__('Adresse')" />
                    <x-input id="address" class="block mt-1 w-full" type="text" name="address" :value="old('address')" required />
                </div>

                <legend>{{ __('Créer le mot de passe') }}</legend>

                <div id="adminQuestions">
                    <x-label for="password" :value="__('Mot de passe')" />
                    <x-input id="password" class="block mt-1 w-full" type="password" name="adminPassword" required />

                    <x-label for="confirmAdminPassword" :value="__('Confirmez le mot de passe')" />
                    <x-input id="confirmAdminPassword" class="block mt-1 w-full" type="password" name="confirmAdminPassword" required />
                </div>

                <legend>{{ __('Entreprise') }}</legend>

                <div id="ManagerQuestions">
                    <!-- Questions spécifiques pour les étudiants -->
                    <x-label for="company" :value="__('Nom de l\'entreprise')" />
                    <x-input id="company" class="block mt-1 w-full" type="text" name="company" :value="old('company')" />

                </div>
                <button id="terminer2" type="submit" style="border: solid 1px blue" >Terminer</button>
         </x-form>
        </div>

        <!-- 3e partie: Admin -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <x-form id="formAdmin" class="hidden" action="{{ action('App\Http\Controllers\UserController@store') }}" method="POST">

            <input type="hidden" name="type" value="admin">

            <legend>{{ __('Informations personnelles') }}</legend>
                <div id="adminQuestions">
                    <x-label for="name" :value="__('Nom')" />
                    <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />

                    <x-label for="firstName" :value="__('Prénom')" />
                    <x-input id="firstName" class="block mt-1 w-full" type="text" name="firstName" :value="old('firstName')" required />

                    <x-label for="email" :value="__('Email')" />
                    <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />

                    <x-label for="telephone" :value="__('Numéro de télételephone')" />
                    <x-input id="telephone" class="block mt-1 w-full" type="text" name="telephone" :value="old('telephone')" required />

                    <x-label for="address" :value="__('Adresse')" />
                    <x-input id="address" class="block mt-1 w-full" type="text" name="address" :value="old('address')" required />
                </div>

                <legend>{{ __('Créer le mot de passe') }}</legend>

                <div id="adminQuestions">
                    <x-label for="password" :value="__('Mot de passe')" />
                    <x-input id="password" class="block mt-1 w-full" type="password" name="adminPassword" required />

                    <x-label for="confirmAdminPassword" :value="__('Confirmez le mot de passe')" />
                    <x-input id="confirmAdminPassword" class="block mt-1 w-full" type="password" name="confirmAdminPassword" required />
                </div>

                <button id="terminer3" type="submit" style="border: solid 1px blue" >Terminer</button>
         </x-form>
         </div>

            <br>
            
    </x-slot>

    <script>
        function affihcerForm(elt){
            var idBouton = elt.id;
            console.log(idBouton);

            switch (idBouton) {
                case "boutonEtudiant":
                    var form = document.getElementById('formEtudiant');
                    form.classList.remove('hidden');
                    break;
                case "boutonGestionnaire":
                    var form = document.getElementById('formGestionnaire');
                    form.classList.remove('hidden');
                    break;

                case "boutonAdmin":
                    var form = document.getElementById('formAdmin');
                    form.classList.remove('hidden');
                default:
                    break;
            }

            // var boutonTerminer = document.getElementById("terminer");
            // boutonTerminer.classList.remove('hidden');
            document.getElementById('choixType').classList.add('hidden');
            document.getElementById('changerType').classList.remove('hidden');
            
        }

    </script>
</x-app-layout>