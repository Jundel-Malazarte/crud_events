<?php
// save event.php
include 'db_conn.php'; // Include database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize form data
    $eventCode = intval($_POST['eventCode']);
    $eventName = $_POST['eventName'];
    $eventDate = $_POST['eventDate'];
    $eventVenue = $_POST['eventVenue'];
    $eventFee = floatval($_POST['eventFee']);

    // Insert query to add a new event record
    $sql = "INSERT INTO events (eventCode, eventName, eventDate, eventVenue, eventFee) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    
    // Bind parameters (i = integer, s = string, d = double)
    $stmt->bind_param("isssd", $eventCode, $eventName, $eventDate, $eventVenue, $eventFee);
    
    if ($stmt->execute()) {
        // Redirect with success message
        header("Location: event.php?message=Event added successfully!");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the prepared statement and database connection
    $stmt->close();
}
$conn->close();
?>
