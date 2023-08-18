<?php
// Establish the database connection (same as in the main PHP file)
// ...

// Fetch reservations for the selected date from the reservations table
$date = $_POST['date'];

$stmt = $conn->prepare("SELECT * FROM equipment_reservation WHERE DATE(date_needed) = ?");
$stmt->execute([$date]);
$reservations = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Check if there are reservations for the selected date
if (empty($reservations)) {
  echo json_encode(['success' => false, 'message' => 'No reservations found for the selected date.']);
  exit;
}

// Generate the text content for the file
$fileContent = "Equipment Reservations for $date\n\n";
foreach ($reservations as $reservation) {
  $fileContent .= "Reservation ID: {$reservation['reservation_id']}\n";
  $fileContent .= "Equipment Name: {$reservation['equipment_name']}\n";
  $fileContent .= "Quantity: {$reservation['quantity']}\n";
  // Add other reservation details as needed
  $fileContent .= "\n";
}

// Save the text content to a temporary file
$tempFileName = tempnam(sys_get_temp_dir(), 'reservations');
if ($tempFileName === false) {
  echo json_encode(['success' => false, 'message' => 'Failed to create the temporary file.']);
  exit;
}

if (file_put_contents($tempFileName, $fileContent) === false) {
  echo json_encode(['success' => false, 'message' => 'Failed to write data to the temporary file.']);
  exit;
}

// Return the temporary file name to the JavaScript function
echo json_encode(['success' => true, 'tempFileName' => basename($tempFileName)]);
