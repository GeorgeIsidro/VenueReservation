<?php
// Establish the database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "databasendgm";

try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
  exit;
}

// Fetch all reservations from the reservations table
$stmt = $conn->query("SELECT * FROM equipment_reservation");
$reservations = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
  <title>View Reservations</title>
  <link rel="stylesheet" href = "view-reservations-final.css">
  <link rel="stylesheet" href="transition.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
  <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

  <script>
  // Function to disable the buttons on page load
  function disableButtonsOnLoad() {
    const reservations = <?php echo json_encode($reservations); ?>;
    reservations.forEach(reservation => {
      const reservationId = reservation.reservation_id;
      const sendConfirmationBtn = document.getElementById(`sendConfirmationBtn${reservationId}`);
      const isDisabled = localStorage.getItem(`sendConfirmationBtnDisabled${reservationId}`);
      if (isDisabled) {
        sendConfirmationBtn.disabled = true;
        sendConfirmationBtn.style.backgroundColor = 'red';
      }
    });
  }

  // Call the function when the page is loaded
  window.onload = disableButtonsOnLoad;
</script>


</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-#0F5401 bg-#0F5401">
      <a class="navbar-brand" href="#">
        <img src="notre-dame.png" width="30" height="30" alt="">
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class = "nav-item">
            <a class = "nav-link" href="view-database-final.php"> View Venue Reservations</a>
          </li>
        </ul>
      </div>
  </nav>
  <div class="container">
    <h2>Equipment Reservations</h2>
    <table>
      <thead>
        <tr>
          <th>Reservation ID</th>
          <th>Equipment Name</th>
          <th>Quantity</th>
          <th>Place</th>
          <th>Date Needed</th>
          <th>Time Needed</th>
          <th>Contact Person</th>
          <th>Sector</th>
          <th>Action</th>
		  <th>Confirmation</th>
		  <th>Print</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($reservations as $reservation) : ?>
          <tr>
            <td><?php echo $reservation['reservation_id']; ?></td>
            <td><?php echo $reservation['equipment_name']; ?></td>
            <td><?php echo $reservation['quantity']; ?></td>
            <td><?php echo $reservation['place']; ?></td>
            <td><?php echo $reservation['date_needed']; ?></td>
            <td><?php echo date('h:i A', strtotime($reservation['time_needed'])); ?></td>
            <td><?php echo $reservation['contact_person']; ?></td>
            <td><?php echo $reservation['sector']; ?></td>
            <td>
            <form method="POST" action="delete_reservation.php">
				<input type="hidden" name="reservation_id" value="<?php echo $reservation['reservation_id']; ?>">
                <input type="submit" value="Delete">
              </form>
            </td>
			
			<!-- ... (previous code) ... -->

			<td>
			  <button id="sendConfirmationBtn<?php echo $reservation['reservation_id']; ?>" onclick="sendConfirmation(<?php echo $reservation['reservation_id']; ?>, '<?php echo $reservation['contact_person']; ?>')">
				Send Confirmation
			  </button>
			</td>


			<!-- ... (rest of the code) ... -->

			
			<td>
				<form method="GET" action="print-reservation-equipment.php" target="_blank">
				  <!-- Use a query parameter in the URL to pass the reservation_id -->
				  <input type="hidden" name="reservation_id" value="<?php echo $reservation['reservation_id']; ?>">
				  <input type="submit" value="Print"></button>
				</form>

				<!-- ... (rest of the code) ... -->

			</td>
			
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
	
	<script>
	function sendConfirmation(reservationId, contactPerson) {
	  // Check if the button is already disabled in local storage
	  const isDisabled = localStorage.getItem(`sendConfirmationBtnDisabled${reservationId}`);
	  if (isDisabled) {
		return; // If already disabled, do nothing
	  }

	  // Prevent default form submission
	  event.preventDefault();

	  // Disable the button and change background color to red
	  const sendConfirmationBtn = document.getElementById(`sendConfirmationBtn${reservationId}`);
	  sendConfirmationBtn.disabled = true;
	  sendConfirmationBtn.style.backgroundColor = 'red';

	  // AJAX request to send the confirmation email
	  const xhr = new XMLHttpRequest();
	  xhr.open('POST', 'send-confirmation-equipment.php', true);
	  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	  xhr.onreadystatechange = function() {
		if (xhr.readyState === 4 && xhr.status === 200) {
		  // Display a success message (pop-up notification)
		  alert(contactPerson + '\'s Email confirmation email sent!');

		  // Store the disabled status in local storage
		  localStorage.setItem(`sendConfirmationBtnDisabled${reservationId}`, true);
		} else if (xhr.readyState === 4 && xhr.status !== 200) {
		  // Handle the case where the confirmation request failed
		  alert('Failed to send confirmation email to ' + contactPerson + '.');

		  // Enable the button if there was an error, so the user can try again
		  sendConfirmationBtn.disabled = false;
		  sendConfirmationBtn.style.backgroundColor = ''; // Reset background color to default
		}
	  };
	  xhr.send('reservation_id=' + reservationId);
	}
</script>


	
    <form action="view-database-final.php" method="post">
      <input type="submit" value="View Venue Reservations">
    </form>
  </div>
</body>
</html>