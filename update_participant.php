<?php
// update_participant.php
include 'db_conn.php'; // Make sure to include your database connection

// Retrieve form data
$participantID = $_POST['participantID'];
$eventCode = $_POST['eventCode'];
$partFname = $_POST['partFname'];
$partLname = $_POST['partLname'];
$DiscountRate = $_POST['DiscountRate'];

// Check if the participantID exists in participants table
$participantCheckQuery = "SELECT * FROM participants WHERE participantID = ?";
$stmt = $conn->prepare($participantCheckQuery);
$stmt->bind_param("i", $participantID);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Proceed to update participant
    $updateQuery = "UPDATE participants SET eventCode = ?, partFname = ?, partLname = ?, DiscountRate = ? WHERE participantID = ?";
    $updateStmt = $conn->prepare($updateQuery);
    $updateStmt->bind_param("issdi", $eventCode, $partFname, $partLname, $DiscountRate, $participantID);
    
    if ($updateStmt->execute()) {
        // Redirect back with a success message
        header("Location: participants.php?message=Participant updated successfully.");
    } else {
        // Handle update error
        echo "Error: " . $updateStmt->error;
    }
} else {
    // Handle case where participantID does not exist
    echo "Error: The provided participant ID does not exist.";
}

$stmt->close();
$conn->close();
?>
