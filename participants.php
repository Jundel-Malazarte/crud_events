<!DOCTYPE html>
<html lang="en">
<head>
    <title>Participants Table</title>
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
            margin: 2px;
        }
        .form-group, col-md-3 {
            margin-top: 10px;
        }
    </style>
</head>
<body>
<div class="container">
    <h2 class="text-center mb-4">Registered Participants</h2>

    <!-- Form to add or search for a participant -->
    <form action="participants.php" method="post" class="mb-4">
        <div class="form-row">
            <div class="form-group col-md-7 text-right">
                <a href="index.php" class="btn btn-primary w3-button w3-blue">Back to menu</a>
            </div>
            <div class="form-group col-md-7 text-right">
                <a href="add_participant.php" class="btn btn-success w3-button w3-green">Add New Participant</a>
            </div>
            <div class="form-group col-md-3">
                <input type="text" class="form-control" name="search_eventCode" placeholder="Search Event Code">
                <button type="submit" name="search" class="btn btn-primary w3-button w3-blue">Search</button>
            </div>
        </div>
    </form>

    <!-- Display message alerts -->
    <?php if (isset($_GET['message'])): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <span><?php echo htmlspecialchars($_GET['message']); ?></span>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <?php endif; ?>

    <div class="table-container">
        <table class="table table-bordered table-hover w3-table-all">
            <thead class="w3-light-grey">
                <tr>
                    <th>ID Number</th> <!-- Participant ID -->
                    <th>Event Code</th> 
                    <th>Firstname</th> 
                    <th>Lastname</th> 
                    <th>Discount Rate</th> 
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include 'db_conn.php';

                // Search function
                $query = "SELECT * FROM participants";
                if (isset($_POST['search'])) {
                    $search_eventCode = $_POST['search_eventCode'];
                    $query .= " WHERE eventCode LIKE '%$search_eventCode%'";
                }

                $result = $conn->query($query);

                if ($result && $result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["participantID"] . "</td>"; // Participant ID
                        echo "<td>" . $row["eventCode"] . "</td>";     // Event Code
                        echo "<td>" . $row["partFname"] . "</td>";     // Firstname
                        echo "<td>" . $row["partLname"] . "</td>";     // Lastname
                        echo "<td>Php " . number_format($row["DiscountRate"], 2) . "</td>"; // Discount Rate
                        echo "<td class='action-buttons'>
                                <a href='edit_participant.php?id=" . $row["participantID"] . "' class='btn btn-warning btn-sm w3-button w3-blue'>Edit</a>
                                <a href='delete_participant.php?id=" . $row["participantID"] . "' class='btn btn-danger btn-sm w3-button w3-red' onclick='return confirm(\"Are you sure you want to delete this participant?\")'>Delete</a>
                              </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5' class='text-center'>No participants found.</td></tr>";
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
