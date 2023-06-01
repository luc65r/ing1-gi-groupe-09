<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Analyse des graphiques
        </h2>
    </x-slot>

    <div class="form">
        <p> Veuillez choisir un fichier .py </p>
        <input id="fileInput" type="file" name="file">
        <button class="voirP rounded-lg" id="submitButton" type="button">Envoyer</button>
    </div>
    <div class="charts-container">
        <canvas id="chart1"></canvas>
        <canvas id="chart2"></canvas>
        <canvas id="chart3"></canvas>

    </div>

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
                }),
                fetch('/stats/functionAnalysis', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/octet-stream' },
                    body: arrayBuffer
                }),
                fetch('/stats/grep?a=if', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/octet-stream' },
                    body: arrayBuffer
                }),
                fetch('/stats/grep?a=while', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/octet-stream' },
                    body: arrayBuffer
                }),
                fetch('/stats/grep?a=for', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/octet-stream' },
                    body: arrayBuffer
                }),
                fetch('/stats/grep?a=switch', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/octet-stream' },
                    body: arrayBuffer
                })
            ]).then(responses => 
                Promise.all(responses.map(response => response.json()))
            ).then(data => {
                var ctx1 = document.getElementById('chart1').getContext('2d');
                var ctx2 = document.getElementById('chart2').getContext('2d');
                var ctx3 = document.getElementById('chart3').getContext('2d');

                new Chart(ctx1, {
                    type: 'bar',
                    data: {
                        labels: ['Nombres de fonctions', 'Minimum de lignes dans une fonction', 'Nombres moyens de lignes dans une fonctions', 'Nombres maximum de lignes dans une fonction'],
                        datasets: [{
                            label: 'Analyse de fonctions',
                            data: [
                                data[2].functionCount,
                                data[2].functionMin,
                                data[2].functionAvg,
                                data[2].functionMax
                            ],
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(255, 159, 64, 0.2)',
                                'rgba(255, 205, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)'
                            ],
                            borderColor: [
                                'rgba(255, 99, 132, 1)',
                                'rgba(255, 159, 64, 1)',
                                'rgba(255, 205, 86, 1)',
                                'rgba(75, 192, 192, 1)'
                            ],
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
                        labels: ['Nombres de lignes', 'Nombres de fonctions'],
                        datasets: [{
                            label: 'Analyse du code',
                            data: [
                                data[0].lineCount,
                                data[2].functionCount
                            ],
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(255, 159, 64, 0.2)',
                                'rgba(255, 205, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)'
                            ],
                            borderColor: [
                                'rgba(255, 99, 132, 1)',
                                'rgba(255, 159, 64, 1)',
                                'rgba(255, 205, 86, 1)',
                                'rgba(75, 192, 192, 1)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: { y: { beginAtZero: true } }
                    }
                });


                new Chart(ctx3, {
    type: 'pie',
    data: {
        labels: ['if', 'while', 'for', 'switch'],
        datasets: [{
            label : 'Analyse des structures de contrôle',
            data: [data[3].hits, data[4].hits, data[5].hits, data[6].hits],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(255, 159, 64, 0.2)',
                'rgba(255, 205, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(255, 159, 64, 1)',
                'rgba(255, 205, 86, 1)',
                'rgba(75, 192, 192, 1)'
            ],
            borderWidth: 1
        }]
    }
});

            }).catch(error => console.error(error));
        }

        reader.readAsArrayBuffer(file);
    });
    </script>
    <style>
.form {
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    width: 100%;
    margin: 0 auto;
    padding: 20px;
    box-shadow: 0px 0px 8px 2px rgba(0, 0, 0, 0.1);
    border-radius: 5px;
}

.form input[type="file"] {
    margin-bottom: 10px;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
}







    .charts-container {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        width: 100%;
        margin: 0 auto;
        padding: 20px;
        box-shadow: 0px 0px 8px 2px rgba(0, 0, 0, 0.1);
        border-radius: 5px;
    }
    .charts-container canvas {
        max-width: 550px;
        max-height : 600px; /* Adjust the max-width as per your needs */
        width: 100%;
    }

#fileInput {
    display: inline-block;
    padding: 10px 15px;
    color: #5A5A5A;
    font-size: 16px;
    line-height: 20px;
    background-color: #F5F5F5;
    border: 1px solid #D9D9D9;
    border-radius: 4px;
    transition: background-color 0.2s ease-in-out, border 0.2s ease-in-out;
}

#fileInput:hover {
    cursor: pointer;
    background-color: #E8E8E8;
}

#fileInput:focus {
    outline: none;
    border-color: #4CAF50;
}
p {
    font-family: Arial, sans-serif;
    color: #333;
    font-size: 20px;
    text-align: center;
    margin-top: 20px;
    margin-bottom: 20px;
    padding: 10px;
    border-radius: 5px;
    background-color: #f5f5f5;
    border: 2px solid #ddd;
}





</style>

</x-app-layout>
