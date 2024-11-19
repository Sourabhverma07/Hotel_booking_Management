<?php
// Include the database connection file
include("conectio.php");

// Get the booking ID from GET or POST (adjust this depending on your setup)
$bookingId = isset($_GET['bookingId']) ? $_GET['bookingId'] : 0;

// Fetch booking details from the database
$query = "SELECT * FROM bookings WHERE id = $bookingId";
$result = mysqli_query($cn, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $booking = mysqli_fetch_assoc($result);
} else {
    echo "<p>Booking details not found. Please try again.</p>";
    exit;
}

// PayPal payment details
$paypal_email = 'vishalsourabh07@gmail.com';
$paypal_return_url = 'https://yourwebsite.com/payment-success.php';
$paypal_cancel_url = 'https://yourwebsite.com/payment-cancel.php';

// Example payment amount
$payment_amount = 100.00; // You can calculate this dynamically based on the booking.

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Page</title>
    <link rel="stylesheet" href="booking.css">
</head>
<body>

    <div class="payment-container">
        <h2>Payment for Booking ID: <?php echo $bookingId; ?></h2>
        <p><strong>Customer Name:</strong> <?php echo isset($booking['first_name']) ? $booking['first_name'] . ' ' . $booking['last_name'] : "N/A"; ?></p>
        <p><strong>Room Number:</strong> <?php echo isset($booking['room_id']) ? $booking['room_id'] : "N/A"; ?></p>
        <p><strong>Check-in Date:</strong> <?php echo isset($booking['check_in_date']) ? $booking['check_in_date'] : "N/A"; ?></p>
        <p><strong>Check-out Date:</strong> <?php echo isset($booking['check_out_date']) ? $booking['check_out_date'] : "N/A"; ?></p>
        <p><strong>Amount to Pay:</strong> $<?php echo $payment_amount; ?></p>

        <form action="https://www.paypal.com/cgi-bin/webscr" method="post">
            <input type="hidden" name="cmd" value="_xclick">
            <input type="hidden" name="business" value="<?php echo htmlspecialchars($paypal_email); ?>">
            <input type="hidden" name="item_name" value="Hotel Booking (ID: <?php echo $bookingId; ?>)">
            <input type="hidden" name="amount" value="<?php echo htmlspecialchars($payment_amount); ?>">
            <input type="hidden" name="currency_code" value="USD">
            <input type="hidden" name="return" value="<?php echo htmlspecialchars($paypal_return_url); ?>">
            <input type="hidden" name="cancel_return" value="<?php echo htmlspecialchars($paypal_cancel_url); ?>">
            <input type="hidden" name="custom" value="<?php echo $bookingId; ?>"> <!-- Pass the booking ID -->

            <input type="submit" value="Pay with PayPal">
        </form>
    </div>

</body>
</html>
