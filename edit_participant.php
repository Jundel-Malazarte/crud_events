<?php
include 'db_conn.php'; // Make sure to include your database connection

// Check if ID is passed
if (!isset($_GET['id'])) {
    die("No participant ID specified.");
}

$participantID = $_GET['id'];

// Fetch participant data
$participantQuery = "SELECT * FROM participants WHERE participantID = ?";
$stmt = $conn->prepare($participantQuery);
$stmt->bind_param("i", $participantID);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Participant not found.");
}

$participant = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Participant</title>
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
    </style>
</head>
<body>
<div class="container">
    <h2 class="text-center mb-4">Edit Participant</h2>

    <div class="form-container">
        <form action="update_participant.php" method="post">
            <input type="hidden" name="participantID" value="<?php echo $participant['participantID']; ?>">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="eventCode">Event Code</label>
                    <select class="form-control" id="eventCode" name="eventCode" required>
                        <option value="">Select an Event Code</option>
                        <?php
                        // Fetch event codes from the events table
                        $eventQuery = "SELECT eventCode FROM events";
                        $eventResult = $conn->query($eventQuery);
                        
                        if ($eventResult && $eventResult->num_rows > 0) {
                            while ($row = $eventResult->fetch_assoc()) {
                                $selected = ($row['eventCode'] == $participant['eventCode']) ? 'selected' : '';
                                echo "<option value='" . $row['eventCode'] . "' $selected>" . $row['eventCode'] . "</option>";
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
                    <input type="text" class="form-control" id="partFname" name="partFname" value="<?php echo $participant['partFname']; ?>" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="partLname">Last Name</label>
                    <input type="text" class="form-control" id="partLname" name="partLname" value="<?php echo $participant['partLname']; ?>" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="DiscountRate">Discount Rate</label>
                    <input type="number" step="0.01" class="form-control" id="DiscountRate" name="DiscountRate" value="<?php echo $participant['DiscountRate']; ?>" required>
                </div>
            </div>
            <div class="form-group text-center">
                <button type="submit" class="btn btn-success w3-button w3-green">Update Participant</button>
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
