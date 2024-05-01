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
</head>

<body>

<a href="Reclamation.php" class="btn btn-primary mt-3">Back to Reclamation Table</a>

    <!-- Div to display the chart -->
    <div style="width: 600px; height: 400px;">
        <canvas id="reclamationsChart"></canvas>
    </div>

    <script>
        // Retrieve reclamation data from PHP
        var labels = <?php echo json_encode($labels); ?>; // Labels for X-axis (e.g., reclamation types)
        var data = <?php echo json_encode($data); ?>; // Data for Y-axis (e.g., number of reclamations per type)

        // Create a new chart with Chart.js
        var ctx = document.getElementById('reclamationsChart').getContext('2d');
        var reclamationsChart = new Chart(ctx, {
            type: 'bar', // Chart type (bar, pie, line, etc.)
            data: {
                labels: labels, // Labels for X-axis
                datasets: [{
                    label: 'Réclamations', // Data series name
                    data: data, // Data for Y-axis
                    backgroundColor: 'rgba(75, 192, 192, 0.2)', // Background color of bars
                    borderColor: 'rgba(75, 192, 192, 1)', // Border color of bars
                    borderWidth: 1 // Border width of bars
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true // Start Y-axis at zero
                        }
                    }]
                }
            }
        });
    </script>
</body>
</html>
