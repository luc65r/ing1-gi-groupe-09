<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Analyse des graphiques
        </h2>
    </x-slot>

    <div class="form">
        <input id="fileInput" type="file" name="file">
        <button id="submitButton" type="button">Envoyer</button>
    </div>

    <canvas id="chart1"></canvas>
    <canvas id="chart2"></canvas>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
    document.getElementById('submitButton').addEventListener('click', function() {
        var fileInput = document.getElementById('fileInput');
        var file = fileInput.files[0];
        var reader = new FileReader();

        reader.onload = function() {
            var arrayBuffer = this.result;
            Promise.all([
                fetch('/stats/lineCount', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/octet-stream' },
                    body: arrayBuffer
                }),
                fetch('/stats/functionCount', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/octet-stream' },
                    body: arrayBuffer
                }) 
            ]).then(responses => 
                Promise.all(responses.map(response => response.json()))
            ).then(data => {
                // Data[0] et data[1] contiennent les données de toutes les réponses
                var ctx1 = document.getElementById('chart1').getContext('2d');
                var ctx2 = document.getElementById('chart2').getContext('2d');

                new Chart(ctx1, {
                    type: 'bar',
                    data: {
                        labels: Object.keys(data[0]),
                        datasets: [{
                            label: 'Nombre de lignes',
                            data: Object.values(data[0]),
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: { y: { beginAtZero: true } }
                    }
                });

                new Chart(ctx2, {
                    type: 'bar',
                    data: {
                        labels: Object.keys(data[1]),
                        datasets: [{
                            label: 'Nombre de fonctions',
                            data: Object.values(data[1]),
                            backgroundColor: 'rgba(255, 99, 132, 0.2)',
                            borderColor: 'rgba(255, 99, 132, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: { y: { beginAtZero: true } }
                    }
                });
            }).catch(error => console.error(error));
        }

        reader.readAsArrayBuffer(file);
    });
    </script>
</x-app-layout>
{{--


    <!-- <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Analyse des graphiques
            </h2>
        </x-slot>

        <canvas id="chart1"></canvas>
        <canvas id="chart2"></canvas>

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            // Simuler les réponses de vos API
            var data = [
                { 'Jan': 10, 'Fév': 15, 'Mar': 12, 'Avr': 8, 'Mai': 20, 'Jun': 25 },
                { 'Jan': 5, 'Fév': 7, 'Mar': 6, 'Avr': 4, 'Mai': 10, 'Jun': 15 }
            ];

            // Créer les graphiques avec ces données
            var ctx1 = document.getElementById('chart1').getContext('2d');
            var ctx2 = document.getElementById('chart2').getContext('2d');

            new Chart(ctx1, {
                type: 'bar',
                data: {
                    labels: Object.keys(data[0]),
                    datasets: [{
                        label: 'Nombre de lignes',
                        data: Object.values(data[0]),
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: { y: { beginAtZero: true } }
                }
            });

            new Chart(ctx2, {
                type: 'bar',
                data: {
                    labels: Object.keys(data[1]),
                    datasets: [{
                        label: 'Nombre de fonctions',
                        data: Object.values(data[1]),
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: { y: { beginAtZero: true } }
                }
            });
        </script>
    </x-app-layout> -->
--}}