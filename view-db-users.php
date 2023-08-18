<!DOCTYPE html>
<html>
<head>
  <title>Bootstrap Navbar</title>
  <link rel="stylesheet" href="view-database-final.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
</head>

<body>
  <!-- NavBar -->
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
        <li class="nav-item active">
          <a class="nav-link" href="navbar-practice.html">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="about.html">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="reservations.php">Reserve a Venue</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="reservation_form_final.php">Reserve Equipment</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="view-equipment-guest.php">View Equipment Reservations</a>
        </li>
      </ul>
    </div>
  </nav>

  <!-- Main Function -->
  <h2>Reserved Venues</h2>

  <div class="main">
    <h2 class="header-2">Search Reservations by Date</h2>
    <form action="" class="header-2" method="post">
      <input type="date" name="search_date" required>
      <input type="submit" name="search_by_date" value="Search">
    </form>

    <?php
    $host = 'localhost';
    $db = 'databasendgm';
    $user = 'root';
    $password = '';

    try {
        $conn = new PDO("mysql:host=$host;dbname=$db", $user, $password);

        // Check if a reservation cancellation request was made
        if (isset($_POST['cancel_reservation'])) {
            $reservationId = $_POST['cancel_reservation'];

            // Delete the reservation from the database
            $stmt = $conn->prepare("DELETE FROM reservations WHERE id = ?");
            $stmt->execute([$reservationId]);

            echo "<script>alert('Reservation canceled successfully.');</script>";
        }

        // Check if a search by date request was made
        if (isset($_POST['search_by_date'])) {
            $searchDate = $_POST['search_date'];

            // Retrieve reservations for the specified date
            $stmt = $conn->prepare("SELECT * FROM reservations WHERE reservation_date = ?");
            $stmt->execute([$searchDate]);
            $reservations = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        // Check if a search by venue request was made
        if (isset($_POST['search_by_venue'])) {
            $searchVenue = $_POST['search_venue'];

            // Retrieve reservations for the specified venue
            $stmt = $conn->prepare("SELECT * FROM reservations WHERE venue_name = ?");
            $stmt->execute([$searchVenue]);
            $reservations = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        // If no specific search request, retrieve all reservations by default
        if (!isset($reservations)) {
            $stmt = $conn->query("SELECT * FROM reservations");
            $reservations = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        if (!empty($reservations)) {
            echo '<h3 style="color: #ffffff;">Reservations</h3>';
            echo '<table style="border-radius: 10px;">';
            echo '<tr><th>ID</th><th>Venue</th><th>Purpose</th><th>Reservation Date</th><th>Start Time</th><th>End Time</th><th>Grace Period</th><th>Contact Person</th><th>Email</th><th>Sector</th><th>Date Reserved</th></tr>';

            foreach ($reservations as $reservation) {
                // Display reservation details in rows
                echo '<tr>';
                echo '<td>' . $reservation['id'] . '</td>';
                echo '<td>' . $reservation['venue_name'] . '</td>';
                echo '<td>' . $reservation['purpose'] . '</td>';
                echo '<td>' . $reservation['reservation_date'] . '</td>';
                echo '<td>' . date('g:i A', strtotime($reservation['start_time'])) . '</td>'; // Display start time in 12-hour format
                echo '<td>' . date('g:i A', strtotime($reservation['end_time'])) . '</td>';   // Display end time in 12-hour format
                echo '<td>' . $reservation['grace_period'] . '</td>';
                echo '<td>' . $reservation['contact_person'] . '</td>';
                echo '<td>' . $reservation['email'] . '</td>';
                echo '<td>' . $reservation['sector'] . '</td>';
                echo '<td>' . $reservation['date_reserved'] . '</td>';
                echo '</tr>';
            }

            echo '</table>';
        } else {
            echo '<p>No reservations found.</p>';
        }
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
    ?>

  </div>

</body>

</html>
