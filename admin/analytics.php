<?php 

$page = "Analytics";
session_start();
if (!isset($_SESSION['role'])) {
    header("Location: ./login.php");
    exit(); // Add exit after redirection to prevent further execution
}
require './db.php';

$records = [];
$query = "SELECT * FROM sessions  WHERE time_out IS NOT NULL ORDER BY time_out asc";
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
      
    <div class="container flex flex-col items-center justify-center">
        <div class="">
            <div class="flex flex-col">
                <labe>Select Day</labe>
                  <input type="text" id="datetimepicker" placeholder="From Date" class="outline-none px-3 p-3 rounded-md form-input w-full">

            </div>
        </div>
        <div class="flex justify-center w-full">
             <div class="chart-container 1">
            <canvas id="purposeChart"></canvas>
        </div>
        <div class="chart-container 2">
            <canvas id="laboratoryChart"></canvas>
        </div>
        </div>
       
    </div>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
    var records_json = <?php echo $records_json; ?>;

var purposeChart;
var laboratoryChart;

flatpickr('#datetimepicker', {
    dateFormat: "F j, Y",
    onChange: function(selectedDates, dateStr, instance) {
        const selectedDate = formatDate(dateStr);
        let filteredRecords = [];
        let old = records_json;
        records_json.forEach(student => {
              console.log(selectedDate)
            const studentDate = student.time_in.split(' ')[0];
          
            if (selectedDate === studentDate) {
                 console.log('yes')
                filteredRecords.push(student);
            }
        });
        
        // Log filtered records to ensure they are being updated correctly
        chartt(filteredRecords);

    }
});

function formatDate(dateString) {
    const date = new Date(dateString);
    const year = date.getFullYear();
    const month = String(date.getMonth() + 1).padStart(2, '0');
    const day = String(date.getDate()).padStart(2, '0');
    const formattedDate = `${year}-${month}-${day}`;
    return formattedDate;
}

function chartt(records_json) {
    var purposes = {};
    records_json.forEach(function(record) {
        var key = record.purpose;
        if (!purposes[key]) {
            purposes[key] = 0;
        }
        purposes[key]++;
    });

    var purposeLabels = Object.keys(purposes);
    var purposeCounts = Object.values(purposes);

    var laboratories = {};
    records_json.forEach(function(record) {
        var key = record.laboratory;
        if (!laboratories[key]) {
            laboratories[key] = 0;
        }
        laboratories[key]++;
    });

    var laboratoryLabels = Object.keys(laboratories);
    var laboratoryCounts = Object.values(laboratories);

    // Log chart data to ensure it's being calculated correctly
    console.log("Purpose Labels: ", purposeLabels);
    console.log("Purpose Counts: ", purposeCounts);
    console.log("Laboratory Labels: ", laboratoryLabels);
    console.log("Laboratory Counts: ", laboratoryCounts);

    // Destroy existing charts if they exist
    if (purposeChart) {
        purposeChart.destroy();
    }
    if (laboratoryChart) {
        laboratoryChart.destroy();
    }

    // Create new purpose chart
    var ctxPurpose = document.getElementById('purposeChart').getContext('2d');
    purposeChart = new Chart(ctxPurpose, {
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

    // Create new laboratory chart
    var ctxLaboratory = document.getElementById('laboratoryChart').getContext('2d');
    laboratoryChart = new Chart(ctxLaboratory, {
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
}

// Initial call to display charts with initial data
chartt(records_json);

    </script>
</body>

</html>
