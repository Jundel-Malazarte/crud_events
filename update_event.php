<?php
// Update event.php
// Include database connection file
include 'db_conn.php';

// Check if form data is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $eventId = $_POST['eventId']; // Change this to eventId
    $eventCode = $_POST['eventCode'];
    $eventName = $_POST['eventName'];
    $eventDate = $_POST['eventDate'];
    $eventVenue = $_POST['eventVenue'];
    $eventFee = $_POST['eventFee'];

    // Prepare and execute the SQL statement to update the event's information
    $sql = "UPDATE Events SET eventCode=?, eventName=?, eventDate=?, eventVenue=?, eventFee=? WHERE eventId=?";
    $stmt = $conn->prepare($sql);
    
    if ($stmt === false) {
        die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
    }

    // Bind parameters correctly (note the change from idNum to eventId)
    $stmt->bind_param("ssssdi", $eventCode, $eventName, $eventDate, $eventVenue, $eventFee, $eventId);

    if ($stmt->execute()) {
        // Redirect to events.php after successful update
        header("Location: event.php");
        exit();
    } else {
        echo "Error updating record: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
