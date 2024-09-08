<?php
include "top.php";

// SQL query to fetch activations by activators
$query = "
SELECT my_sig_info, MIN(qso_date) AS first_activation,
       COUNT(DISTINCT IF(activator_calls >= 25, station_callsign, NULL)) AS activation_count,
       SUM(total_qso) AS total_qso,
       GROUP_CONCAT(DISTINCT station_callsign SEPARATOR ', ') AS activators
FROM (
    SELECT my_sig_info, station_callsign, qso_date,
           COUNT(DISTINCT CONCAT(`call`, qso_date)) AS activator_calls,
           COUNT(`call`) AS total_qso
    FROM logstore
    GROUP BY my_sig_info, station_callsign
) AS activator_data
GROUP BY my_sig_info
HAVING activation_count >= 1";

$result = $db->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Activated Bunkers</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
    <script>
        $(document).ready(function() {
            $('#bunkersTable').DataTable({
                "order": [[1, "asc"]], // Sort by the first activation date in ascending order
                "columnDefs": [
                    {
                        "targets": 1, // Apply to the second column (date)
                        "type": "date-eu" // European date format (dd.mm.yyyy)
                    }
                ]
            });
        });
    </script>
</head>
<body>
    <div class="container">
        <h3>Activated Bunkers</h3>
        <table id="bunkersTable" class="display">
            <thead>
                <tr>
                    <th>Reference</th>
                    <th>Date of 1st Activation</th>
                    <th>Number of Valid Activations</th>
                    <th>QSO</th>
                    <th>Activators</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while($row = $result->fetch_assoc()) {
                    $date_for_display = date("d.m.Y", strtotime($row['first_activation']));
                    $date_for_ordering = date("Y-m-d", strtotime($row['first_activation']));

                    echo "<tr>";
                    echo "<td>" . $row['my_sig_info'] . "</td>";
                    // Use data-order attribute for proper sorting
                    echo "<td data-order='" . $date_for_ordering . "'>" . $date_for_display . "</td>";
                    echo "<td>" . $row['activation_count'] . "</td>";
                    echo "<td>" . $row['total_qso'] . "</td>";
                    echo "<td>" . $row['activators'] . "</td>";  // Displaying the activators
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
