<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Messages') }}
        </h2>
    </x-slot>

    <div class="py-6">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-xl sm:rounded-lg p-6 bg-accueil_pale">
                <x-form action="{{ route('messages.store') }}" id="message-form">
                    <x-form-input name="subject" label="Sujet" required />
                    <x-form-input id="searchbar" onkeyup="search_animal()" placeholder="Rechercher email" label="Destinataires" name="coucou"/>
                    <ol id='list' >
                        @foreach ($users as $user)
                            <li class="animals" style="display:none;">{{ $user->email }}</li>
                        @endforeach
                    </ol>
                    <ul style="background-color: transparent" id="recipient-list"></ul>
                    <x-form-errors name="recievers[]" />
                    <x-form-textarea name="body" label="Message" id="body" required />
                    <button class="voirP rounded-lg mt-6" type="submit" id="send-button">Envoyer</button>
                </x-form>
            </div>
        </div>
    </div>

    <script>
     document.addEventListener('DOMContentLoaded', function() {
         const recipientInput = document.getElementById('searchbar');
         const recipientList = document.getElementById('recipient-list');
         const animals = document.getElementsByClassName('animals');

         function addRecipient(recipient) {
             if (recipient.trim() !== '') {
                 const recipientItem = document.createElement('li');
                 recipientItem.textContent = recipient;

                 const hiddenInput = document.createElement('input');
                 hiddenInput.value = recipient;
                 hiddenInput.type = 'hidden';
                 hiddenInput.name = 'recievers[]';

                 const deleteButton = document.createElement('button');
                 deleteButton.textContent = 'Supprimer';
                 deleteButton.classList.add('delete-button');
                 deleteButton.addEventListener('click', function() {
                     recipientList.removeChild(recipientItem);
                 });

                 recipientItem.appendChild(hiddenInput);
                 recipientItem.appendChild(deleteButton);
                 recipientList.appendChild(recipientItem);
             }
         }

         for (const e of animals) {
             e.addEventListener('click', function() {
                 addRecipient(this.textContent);
             });
         }

         /*const messageForm = document.getElementById('message-form');
         messageForm.addEventListener('submit', function(event) {
             event.preventDefault();

             const subject = document.getElementsByName('subject')[0].value;
             const body = document.getElementById('body').value;

             // Récupérer les destinataires depuis le champ hidden
             const recipients = JSON.parse(recipientsInput.value);

             console.log('Sujet:', subject);
             console.log('Destinataires:', recipients);
             console.log('Message:', body);

             this.submit();
         });*/

     });

     function search_animal() {
         let input = document.getElementById('searchbar').value;
         input = input.toLowerCase();
         let x = document.getElementsByClassName('animals');
         let count = 0;

         for (i = 0; i < x.length; i++) {
             if (!x[i].innerHTML.toLowerCase().includes(input)) {
                 x[i].style.display = "none";
             } else {
                 if (count < 5) {
                     x[i].style.display = "list-item";
                     count++;
                 } else {
                     x[i].style.display = "none";
                 }
             }
         }
     }
    </script>
    <style>
     /* Ajouter une classe CSS pour la décoration des éléments de la liste */
     .animals{
         background-color: #f1f1f1; /* Couleur de fond gris clair */
         padding: 5px; /* Espacement intérieur */
         margin-bottom: 5px; /* Marge inférieure */
     }
     .animals:hover {
         background-color: #e0e0e0; /* Couleur de fond gris clair au survol */
         cursor: pointer; /* Curseur pointeur au survol */
     }
     #recipient-list {
         margin-top: 10px;
         padding: 10px;
         background-color: #f1f1f1;
     }

     /* Style du bouton de suppression */
     .delete-button {
         margin-left: 10px;
         background-color: #e0e0e0;
         border: none;
         padding: 5px 10px;
         cursor: pointer;
     }
     .add-button {
         background-color: #4CAF50;
         color: white;
         border: none;
         padding: 5px 10px;
         cursor: pointer;
         transition: background-color 0.3s;
     }
    </style>
</x-app-layout>
