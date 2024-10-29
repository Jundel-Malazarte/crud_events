<?php
include 'db_conn.php'; // Include your database connection

// SQL query to join events, participants, and registration tables
$query = "
    SELECT 
        e.eventName,
        CONCAT(p.partFname, ' ', p.partLname) AS participantFullName,
        r.regDate,
        r.regFeePaid
    FROM 
        registration r
    JOIN 
        participants p ON r.participantID = p.participantID
    JOIN 
        events e ON p.eventCode = e.eventCode
";

$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Registration Records</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/w3.css">
    <style>
        body {
            padding: 20px;
            background-color: #eceff1;
        }
        .table-container {
            margin-top: 20px;
        }
        .action-buttons .btn {
            margin-right: 5px;
        }

        .btn, btn-primary {
            margin-bottom: 10px;
            margin-top: 10px;
        }

    </style>
</head>
<body>
<div class="container">
    <h2 class="text-center mb-4">Registration Records</h2>

    <form action="record.php" method="post" class="mb-4">
        <div class="form-row">
            <div class="form-group col-md-7 text-right">
                <a href="index.php" class="btn btn-primary w3-button w3-green">Back to menu</a>
            </div>
            <div class="form-group col-md-3">
                <input type="text" class="form-control" name="search_eventCode" placeholder="Search Event Code">
                <button type="submit" name="search" class="btn btn-primary w3-button w3-blue">Search</button>
            </div>
        </div>
    </form>

    <div class="table-container">
        <table class="table table-bordered table-hover w3-table-all">
            <thead class="w3-light-grey">
                <tr>
                    <th>Event Name</th>
                    <th>Participant Full Name</th>
                    <th>Registration Date</th>
                    <th>Registration Fee</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row["eventName"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["participantFullName"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["regDate"]) . "</td>";
                        echo "<td>Php " . number_format($row["regFeePaid"], 2) . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4' class='text-center'>No records found.</td></tr>";
                }

                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Include jQuery and Bootstrap JS -->
<script src="js/jquery-3.6.0.min.js"></script>
<script src="bootstrap/js/bootstrap.bundle.js"></script>
</body>
</html>
