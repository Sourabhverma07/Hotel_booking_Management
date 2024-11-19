<?php
// Check if roomId is set
if(isset($_POST['roomId'])) {
    $roomId = $_POST['roomId'];
} else {
    // Redirect or show an error if roomId is not set
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Form</title>
    <link rel="stylesheet" href="booking.css">
</head>
<body>

    <div class="form-container">
        <h2>Booking Form</h2>
        <form action="submit_booking.php" method="post">
            <label for="fullName"> Name</label>
            <input type="text" id="fName" name="firstName" placeholder="Enter your first name" required>
            <input type="text" id="lName" name="lastName" placeholder="Enter your last name" required>

            <label for="phoneNumber">Phone Number</label>
            <input type="tel" id="phoneNumber" name="phoneNumber" placeholder="Enter your phone number" required>

            <label for="email">Email (Gmail)</label>
            <input type="email" id="email" name="email" placeholder="Enter your Gmail" pattern=".+@gmail\.com" required>

            <label for="roomNumber">Room Number</label>
            <input type="text" id="roomNumber" name="roomNumber" value="<?php echo $roomId; ?>" readonly>

            <label for="checkIn">Check-in Date</label>
            <input type="date" id="checkIn" name="checkIn" required>

            <label for="checkOut">Check-out Date</label>
            <input type="date" id="checkOut" name="checkOut" required>

            <div class="form-buttons">
                <button type="submit"><a href="payment.php">Submit</a></button>
                <button type="reset">Reset</button>
            </div>
        </form>
    </div>

</body>
</html>
