<?php
// save_participant.php

include 'db_conn.php'; // Make sure to include your database connection

// Retrieve form data
$participantID = $_POST['participantID'];
$eventCode = $_POST['eventCode'];
$partFname = $_POST['partFname'];
$partLname = $_POST['partLname'];
$DiscountRate = $_POST['DiscountRate'];

// Check if eventCode exists in events table
$eventCheckQuery = "SELECT * FROM events WHERE eventCode = ?";
$stmt = $conn->prepare($eventCheckQuery);
$stmt->bind_param("i", $eventCode);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Proceed to insert participant
    $insertQuery = "INSERT INTO participants (participantID, eventCode, partFname, partLname, DiscountRate) VALUES (?, ?, ?, ?, ?)";
    $insertStmt = $conn->prepare($insertQuery);
    $insertStmt->bind_param("iissd", $participantID, $eventCode, $partFname, $partLname, $DiscountRate);
    
    if ($insertStmt->execute()) {
        // Redirect back with a success message
        header("Location: participants.php?message=Participant added successfully.");
    } else {
        // Handle insertion error
        echo "Error: " . $insertStmt->error;
    }
} else {
    // Handle case where eventCode does not exist
    echo "Error: The provided event code does not exist.";
}

$stmt->close();
$conn->close();
?>