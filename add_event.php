<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add Event</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/w3.css">
    <style>
        body {
            background-color: #eceff1;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }
        .form-container {
            max-width: 800px;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }
        
    </style>
</head>
<body>
    <div class="form-container w3-animate-opacity">
        <h2 class="text-center mb-4">Add Event</h2>
        <form action="save_event.php" method="post">
            <div class="form-group">
                <label for="eventCode">Event Code</label>
                <input type="number" class="form-control" id="eventCode" name="eventCode" required>
            </div>
            <div class="form-group">
                <label for="eventName">Event Name</label>
                <input type="text" class="form-control" id="eventName" name="eventName" required>
            </div>
            <div class="form-group">
                <label for="eventDate">Event Date</label>
                <input type="date" class="form-control" id="eventDate" name="eventDate" required>
            </div>
            <div class="form-group">
                <label for="eventVenue">Event Venue</label>
                <input type="text" class="form-control" id="eventVenue" name="eventVenue" required>
            </div>
            <div class="form-group">
                <label for="eventFee">Event Fee</label>
                <input type="number" step="0.01" class="form-control" id="eventFee" name="eventFee" required>
            </div>
            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-success w3-button w3-green">Save</button>
                <a href="event.php" class="btn btn-danger w3-button w3-red">Cancel</a>
            </div>
        </form>
    </div>
    <script src="bootstrap/js/bootstrap.bundle.js"></script>
</body>
</html>
