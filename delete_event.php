<?php
// delete event
include 'db_conn.php'; // Include your database connection

// Check if the event ID is provided in the URL
if (isset($_GET['id'])) {
    $eventId = $_GET['id'];

    // Prepare the delete query
    $deleteQuery = "DELETE FROM events WHERE eventId = ?";
    $stmt = $conn->prepare($deleteQuery);
    $stmt->bind_param("i", $eventId);
    
    // Execute the delete query
    if ($stmt->execute()) {
        // Redirect back to events.php with a success message
        header("Location: event.php?message=Event deleted successfully.");
        exit();
    } else {
        // Handle deletion error
        echo "Error: " . $stmt->error;
    }
} else {
    // Handle case when no event ID is specified
    echo "No event ID specified.";
}

$stmt->close();
$conn->close();
?>
