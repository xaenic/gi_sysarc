<?php 

$page = "Analytics";
session_start();
if (!isset($_SESSION['role'])) {
    header("Location: ./login.php");
    exit(); // Add exit after redirection to prevent further execution
}
require './db.php';

$records = [];
$query = "SELECT * FROM sessions";
$result = $connection->query($query);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $records[] = $row;
    }
}

// Close the database connection
$connection->close();

// Convert records array to JSON format
$records_json = json_encode($records);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Dashboard</title>
    <link rel="stylesheet" href="../style.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
</head>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .chart-container {
            width: 30%;
            margin: 0 10px;
        }

        canvas {
            max-width: 100%;
            height: auto;
        }
    </style>

<body class="bg-stone-200">
     <?php require './sidebar.php';?>
    <div class="container ">
        <div class="chart-container">
            <canvas id="purposeChart"></canvas>
        </div>
        <div class="chart-container">
            <canvas id="laboratoryChart"></canvas>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
        var records_json = <?php echo $records_json; ?>;

        // Process data to create datasets by purpose
        var purposes = {};
        records_json.forEach(function(record) {
            var key = record.purpose;
            if (!purposes[key]) {
                purposes[key] = 0;
            }
            purposes[key]++;
        });

        // Prepare purpose chart data
        var purposeLabels = Object.keys(purposes);
        var purposeCounts = Object.values(purposes);

        // Process data to create datasets by laboratory
        var laboratories = {};
        records_json.forEach(function(record) {
            var key = record.laboratory;
            if (!laboratories[key]) {
                laboratories[key] = 0;
            }
            laboratories[key]++;
        });

        // Prepare laboratory chart data
        var laboratoryLabels = Object.keys(laboratories);
        var laboratoryCounts = Object.values(laboratories);

        // Purpose chart
        var ctxPurpose = document.getElementById('purposeChart').getContext('2d');
        var purposeChart = new Chart(ctxPurpose, {
            type: 'pie',
            data: {
                labels: purposeLabels,
                datasets: [{
                    data: purposeCounts,
                    backgroundColor: ['rgba(255, 99, 132, 0.2)', 'rgba(54, 162, 235, 0.2)', 'rgba(255, 206, 86, 0.2)'],
                    borderColor: ['rgba(255, 99, 132, 1)', 'rgba(54, 162, 235, 1)', 'rgba(255, 206, 86, 1)'],
                    borderWidth: 1
                }]
            },
            options: {}
        });

        // Laboratory chart
        var ctxLaboratory = document.getElementById('laboratoryChart').getContext('2d');
        var laboratoryChart = new Chart(ctxLaboratory, {
            type: 'pie',
            data: {
                labels: laboratoryLabels,
                datasets: [{
                    data: laboratoryCounts,
                    backgroundColor: ['rgba(255, 99, 132, 0.2)', 'rgba(54, 162, 235, 0.2)', 'rgba(255, 206, 86, 0.2)'],
                    borderColor: ['rgba(255, 99, 132, 1)', 'rgba(54, 162, 235, 1)', 'rgba(255, 206, 86, 1)'],
                    borderWidth: 1
                }]
            },
            options: {}
        });
    </script>
</body>

</html>
