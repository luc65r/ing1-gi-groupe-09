<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Messages') }}
        </h2>
    </x-slot>

    
    <!-- ... -->

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <x-form action="{{ route('messages.store') }}" id="message-form">
                    <x-form-input name="subject" label="Sujet" required />
                    <x-form-input id="searchbar" onkeyup="search_animal()" placeholder="Rechercher email" label="Destinataires" name="coucou"/>
                    <ol id='list' >
                    @foreach ($users as $user)
                        <li class="animals" style="display:none;">{{ $user->email }}</li>
                    @endforeach
                       
                    </ol>
                    <button type="button" id="add-recipient-button" class="add-button">Ajouter</button>
                    <ul id="recipient-list"></ul>
                    <input type="hidden" name="recipients[]" id="recipients-input" />
                    <x-form-textarea name="body" label="Message" id="body" required />
                    <button type="submit" id="send-button">Envoyer</button>
                </x-form>
            </div>
        </div>
    
        
    
    </div>



   
    <script>
document.addEventListener('DOMContentLoaded', function() {
            const recipientInput = document.getElementById('searchbar');
            const addButton = document.getElementById('add-recipient-button');
            const recipientList = document.getElementById('recipient-list');
            const animals = document.getElementsByClassName('animals');
            const recipientsInput = document.getElementById('recipients-input');

            addButton.addEventListener('click', addRecipient);

            function addRecipient() {
                const recipient = recipientInput.value;

                if (recipient.trim() !== '') {
                    const recipientItem = document.createElement('li');
                    recipientItem.textContent = recipient;

                    const deleteButton = document.createElement('button');
                    deleteButton.textContent = 'Supprimer';
                    deleteButton.classList.add('delete-button');
                    deleteButton.addEventListener('click', function() {
                        recipientList.removeChild(recipientItem);
                        updateRecipientsInput();
                    });

                    recipientItem.appendChild(deleteButton);
                    recipientList.appendChild(recipientItem);
                    recipientInput.value = '';

                    updateRecipientsInput();
                }
            }

            for (let i = 0; i < animals.length; i++) {
                animals[i].addEventListener('click', function() {
                    const email = this.textContent;
                    recipientInput.value = email;
                });
            }

            function updateRecipientsInput() {
                const recipientItems = recipientList.getElementsByTagName('li');
                const recipients = Array.from(recipientItems).map(item => item.textContent);
                recipientsInput.value = JSON.stringify(recipients);
            }

            const messageForm = document.getElementById('message-form');
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
            });

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
