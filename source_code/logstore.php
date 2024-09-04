<?php
include "top.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DataTables with DB loading</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
    <script>
        $(document).ready(function() {
            $('#logstoreTable').DataTable({
                "order": [[1, "desc"]], // Sort by the second column (combined date and time) in descending order
            });
        });
    </script>
</head>
<body>
    <div class="container">
        <table id="logstoreTable" class="display">
            <thead>
                <tr>
                    <th>Activator</th>
                    <th>Date & Time</th> <!-- Combined Date and Time column -->
                    <th>Band</th>
                    <th>Mode</th>
                    <th>RSTsent</th>
                    <th>RSTrcvd</th>
                    <th>Hunter</th>
                    <th>Reference</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = "SELECT `station_callsign`, `qso_date`, `time_on`, `band`, `mode`, `rst_sent`, `rst_rcvd`, `call`, `my_sig_info` FROM logstore";
                $result = $db->query($query);

                while($row = $result->fetch_assoc()) {
                    // Combining date and time into a display format
                    $datetime_display = date("d.m.Y H:i", strtotime($row['qso_date'] . ' ' . $row['time_on']));
                    // Format for sorting (ISO 8601)
                    $datetime_order = date("Y-m-d H:i:s", strtotime($row['qso_date'] . ' ' . $row['time_on']));

                    echo "<tr>";
                    echo "<td>" . $row['station_callsign'] . "</td>";
                    // Here we use 'data-order' for sorting and display nicely formatted time
                    echo "<td data-order='" . $datetime_order . "'>" . $datetime_display . "</td>";
                    echo "<td>" . $row['band'] . "</td>";
                    echo "<td>" . $row['mode'] . "</td>";
                    echo "<td>" . $row['rst_sent'] . "</td>";
                    echo "<td>" . $row['rst_rcvd'] . "</td>";
                    echo "<td>" . $row['call'] . "</td>";
                    echo "<td>" . $row['my_sig_info'] . "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
