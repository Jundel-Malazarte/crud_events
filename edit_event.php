<?php
// Include database connection file
include 'db_conn.php';

// Check if the ID is set in the URL
if (isset($_GET['id'])) {
    $idNum = $_GET['id'];

    // Prepare and execute the SQL statement to retrieve the event's current information
    $stmt = $conn->prepare("SELECT * FROM Events WHERE eventId = ?");
    if ($stmt === false) {
        die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
    }
    $stmt->bind_param("i", $idNum);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the event exists
    if ($result->num_rows > 0) {
        $event = $result->fetch_assoc();
    } else {
        echo "Event not found.";
        exit();
    }
} else {
    echo "Invalid request.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Event</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/w3.css">
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #f4f6f8;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .form-container {
            width: 100%;
            max-width: 500px;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <div class="form-container w3-animate-opacity">
        <h2 class="text-center">Edit Event</h2>
        <form action="update_event.php" method="post">
            <input type="hidden" name="eventId" value="<?php echo $event['eventId']; ?>">
            <div class="form-group">
                <label for="eventCode">Event Code</label>
                <input type="text" class="form-control" id="eventCode" name="eventCode" value="<?php echo htmlspecialchars($event['eventCode']); ?>" required>
            </div>

            <div class="form-group">
                <label for="eventName">Event Name</label>
                <input type="text" class="form-control" id="eventName" name="eventName" value="<?php echo htmlspecialchars($event['eventName']); ?>" required>
            </div>

            <div class="form-group">
                <label for="eventDate">Event Date</label>
                <input type="date" class="form-control" id="eventDate" name="eventDate" value="<?php echo htmlspecialchars($event['eventDate']); ?>" required>
            </div>

            <div class="form-group">
                <label for="eventVenue">Event Venue</label>
                <input type="text" class="form-control" id="eventVenue" name="eventVenue" value="<?php echo htmlspecialchars($event['eventVenue']); ?>" required>
            </div>

            <div class="form-group">
                <label for="eventFee">Event Fee</label>
                <input type="number" step="0.01" class="form-control" id="eventFee" name="eventFee" value="<?php echo htmlspecialchars($event['eventFee']); ?>" required>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-success w3-button w3-green">Update</button>
                <a href="event.php" class="btn btn-danger w3-button w3-red">Cancel</a>
            </div>
        </form>
    </div>
    
    <!-- Include Bootstrap and jQuery -->
    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="bootstrap/js/bootstrap.bundle.js"></script>
</body>
</html>
