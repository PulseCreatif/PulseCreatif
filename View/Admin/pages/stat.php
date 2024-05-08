    <?php
    require_once 'C:\xampp\htdocs\skillpulse\Controller\ReclamationsC.php';

    $reclamationsC = new ReclamationsC();
    $reclamationsByType = $reclamationsC->countReclamationsByType();

    // Extracting labels and data from the result
    $labels = [];
    $data = [];
    foreach ($reclamationsByType as $reclamation) {
        $labels[] = $reclamation['Type'];
        $data[] = $reclamation['count'];
    }
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statistiques des Réclamations</title>
    <!-- Include Chart.js JavaScript library -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        html, body {
            margin: 0;
            padding: 0;
            height: 100%;
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }
        #chartContainer {
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .chart {
            width: 80%;
            max-width: 800px;
            height: 80%;
            max-height: 600px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>

<div id="chartContainer">
    <div class="chart">
        <canvas id="reclamationsChart"></canvas>
    </div>
</div>

<script>
    // Retrieve reclamation data from PHP
    var labels = <?php echo json_encode($labels); ?>;
    var data = <?php echo json_encode($data); ?>;

    // Create a new chart with Chart.js
    var ctx = document.getElementById('reclamationsChart').getContext('2d');
    var reclamationsChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: labels,
            datasets: [{
                label: 'Réclamations',
                data: data,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.5)',
                    'rgba(54, 162, 235, 0.5)',
                    'rgba(255, 206, 86, 0.5)',
                    'rgba(75, 192, 192, 0.5)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            legend: {
                position: 'right'
            }
        }
    });
</script>
</body>
</html>
