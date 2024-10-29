<?php
include 'db_conn.php'; // Make sure to include your database connection

// Check if ID is passed
if (!isset($_GET['id'])) {
    die("No participant ID specified.");
}

$participantID = $_GET['id'];

// Prepare a delete statement
$deleteQuery = "DELETE FROM participants WHERE participantID = ?";
$stmt = $conn->prepare($deleteQuery);
$stmt->bind_param("i", $participantID);

// Execute the delete statement
if ($stmt->execute()) {
    // Redirect back with a success message
    header("Location: participants.php?message=Participant deleted successfully.");
} else {
    // Handle delete error
    echo "Error deleting participant: " . $stmt->error;
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>
