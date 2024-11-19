<?php
// Include the database connection
include("conectio.php");

// Get PayPal transaction details
$transactionId = $_GET['tx']; // PayPal transaction ID
$paymentStatus = $_GET['st']; // PayPal payment status
$amountPaid = $_GET['amt']; // Amount paid
$bookingId = $_GET['cm']; // Custom field containing the booking ID

// Insert payment details into the database
$sql = "INSERT INTO payments (booking_id, transaction_id, payment_status, payment_amount)
        VALUES ('$bookingId', '$transactionId', '$paymentStatus', '$amountPaid')";

if (mysqli_query($cn, $sql)) {
    echo "<h2>Payment Successful!</h2>";
    echo "<p>Thank you for your payment. Your booking ID is: $bookingId</p>";
} else {
    echo "Error: " . mysqli_error($cn);
}

// Close connection
mysqli_close($cn);
?>
