<?php
// process_payment.php
$postData = json_decode(file_get_contents("php://input"), true);

// Simulate a successful payment response
$paymentResponse = [
    'success' => true,
    'message' => 'Payment successful. Thank you for your purchase!'
];

echo json_encode($paymentResponse);
?>
