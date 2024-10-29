<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add/Edit Participant</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/w3.css">
    <style>
        body {
            padding: 20px;
            background-color: #eceff1;
        }
        .form-container {
            max-width: 600px;
            margin: 20px auto; /* Center the form */
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .form-group {
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
<div class="container">
    <h2 class="text-center mb-4">Add/Edit Participant</h2>

    <div class="form-container">
        <form action="save_participant.php" method="post">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="participantID">Participant ID</label>
                    <input type="number" class="form-control" id="participantID" name="participantID" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="eventCode">Event Code</label>
                    <select class="form-control" id="eventCode" name="eventCode" required>
                        <option value="">Select an Event Code</option>
                        <?php
                        // Include database connection
                        include 'db_conn.php'; // Make sure to adjust this path if necessary

                        // Fetch event codes from the events table
                        $eventQuery = "SELECT eventCode FROM events";
                        $eventResult = $conn->query($eventQuery);
                        
                        if ($eventResult && $eventResult->num_rows > 0) {
                            while ($row = $eventResult->fetch_assoc()) {
                                echo "<option value='" . $row['eventCode'] . "'>" . $row['eventCode'] . "</option>";
                            }
                        } else {
                            echo "<option value=''>No events available</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="partFname">First Name</label>
                    <input type="text" class="form-control" id="partFname" name="partFname" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="partLname">Last Name</label>
                    <input type="text" class="form-control" id="partLname" name="partLname" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="DiscountRate">Discount Rate</label>
                    <input type="number" step="0.01" class="form-control" id="DiscountRate" name="DiscountRate" required>
                </div>
            </div>
            <div class="form-group text-center">
                <button type="submit" class="btn btn-success w3-button w3-green">Add Participant</button>
                <a href="participants.php" class="btn btn-danger w3-button w3-red">Cancel</a>
            </div>
        </form>
    </div>
</div>

<!-- Include jQuery and Bootstrap JS -->
<script src="js/jquery-3.6.0.min.js"></script>
<script src="bootstrap/js/bootstrap.bundle.js"></script>
</body>
</html>
