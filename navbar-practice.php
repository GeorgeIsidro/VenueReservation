<?php
session_start();

// Check if the password is submitted
if (isset($_POST['sibbaluca8'])) {
    // Replace 'your_password' with the actual password you want to use
    $password = 'your_password';
    $input_password = $_POST['password'];

    if ($input_password === $password) {
        $_SESSION['authenticated'] = true;
    } else {
        echo '<script>alert("Incorrect password. Access denied.")</script>';
    }
}

// Check if the user is not authenticated and show the password form
if (!isset($_SESSION['authenticated'])) {
    ?>

<!DOCTYPE html>
<html>

<head>
  <title>Bootstrap Navbar</title>
  <link rel = "stylesheet" href="navbar-practice.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
</head>

<body>
  <!-- Div for Navbar-->
  
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
          <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="about.html">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="Act9-1Register.php">Register</a>
        </li>
        <li class = "nav-item">
          <a class = "nav-link" href="reservations.php">Reserve Venue</a>
        </li>
        <li class = "nav-item">
          <a class = "nav-link" href="reservation_form_final.php">Reserve Equipment</a>
        </li>
		  <?php if (isset($_SESSION['authenticated'])) : ?>
			<!-- Display the menu items that require authentication -->
			<li class="nav-item">
			  <a class="nav-link" href="view-database-final.php">View Venue Reservations</a>
			</li>
			<li class="nav-item">
			  <a class="nav-link" href="view-reservations-final.php">View Equipment Reservations</a>
			</li>
		  <?php endif; ?>

		  <nav class="navbar navbar-expand-lg navbar-#0F5401 bg-#0F5401">
		<li class = "nav-item">
          <a class = "nav-link" href="equipment_final.php">View Equipment List</a>
        </li>
		<li class = "nav-item">
          <a class = "nav-link" href="home.php">Logout</a>
        </li>
		
      </ul>
    </div>
  </nav>
  <!-- Div for Caroussel-->
  <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
      <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img class="d-block  w-100" src="ndcpa.jpg" alt="F irst slide">
        <div class="carousel-caption d-none d-md-block">
          <h5>The NDCPA </h5>
        </div>
      </div>
      <div class="carousel-item">
        <img class="d-block  w-100" src="gym-shs.jpg" alt="Second slide">
        <div class="carousel-caption d-none d-md-block">
          <h5>Senior High Gymnasium</h5>
        </div>
      </div>
      <div class="carousel-item">
        <img class="d-block  w-100" src="Chapel.jpg" alt="Third slide">
        <div class="carousel-caption d-none d-md-block">
          <h5>School Chapel</h5>
        </div>
      </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>  
  </div>
  <!--  CARD DECK-->
  <div class = "container-card">
    <div class="card">
                                          <!-- NDCPA-->
        <img  src="ndcpa-door.jpg" class = "img-front">
        <div class="card-body">
          <h5 class="card-title">NDCPA</h5>   
          <p class="card-text">Equipment Available: Fender, Microphone, Sound System, Projectors || See Equipment Reservation Form to reserve additional equipment. <br> <br> </p>
        </div>
		<div class="card-footer">
          <small class="text-muted">Capacity: 300 pax.</small>
        </div>
    </div>
      <div class="card">
                                          <!-- DE MAZENOD   -->
        <img class="card-img-top" src="de-mazenod-2.jpg" alt="Card image cap">
        <div class="card-body">
          <h5 class="card-title">De Mazenod Function Hall</h5>
          <p class="card-text">Equipment Available: Projector, Chairs, Sound System || See Equipment Reservation Form to reserve additional equipment. <br> <br> <br> </p>
        </div>
		<div class="card-footer">
          <small class="text-muted">Capacity: 50 pax.</small>
        </div>
      </div>
      <div class="card">
                                          <!-- CHAPEL -->
        <img class="card-img-top" src="chapel-2.jpg" alt="Card image cap">
        <div class="card-body">
          <h5 class="card-title">School Chapel</h5>
          <p class="card-text"> Equipment Available: TV Screens for Screen Projection, Keyboard, Sound System. || See Equipment Reservation Form to reserve additional equipment. <br> <br></p>
        </div>
		<div class="card-footer">
          <small class="text-muted">Capacity: 50 pax.</small>
        </div>
      </div>
      <div class="card">
                                          <!-- Dentist -->
        <img class="card-img-top" src="dentist.jpg" alt="Card image cap">
        <div class="card-body">
          <h5 class="card-title">Dining Hall</h5>
          <p class="card-text">Equipment Available: Monoblock Chairs, Round Tables, Square Tables || See Equipment Reservation Form to reserve additional equipment. <br><br></p>
        </div>
		<div class="card-footer">
          <small class="text-muted">Capacity: 80 pax.</small>
        </div>
      </div>
                                          <!-- GYM-SHS -->
      <div class="card">
        <img class="card-img-top" src="gym-shs.jpg" alt="Card image cap">
        <div class="card-body">
          <h5 class="card-title">SHS Gymnasium</h5>
          <p class="card-text">No Equipment Available. || See Equipment Reservation Form to reserve additional equipment. <br><br><br></p>
        </div>
		<div class="card-footer">
          <small class="text-muted">Capacity: 60 pax.</small>
        </div>
      </div>
                                          <!-- Main Gym    -->
      <div class="card">
        <img class="card-img-top" src="Main_Gym.jpg" alt="Card image cap">
        <div class="card-body">
          <h5 class="card-title">Main Gymnasium</h5>
          <p class="card-text">Equipment Available: Projector, Chairs, Sound System, Fender || See Equipment Reservation Form to reserve additional equipment.<br><br></p>
        </div>
		<div class="card-footer">
          <small class="text-muted">Capacity: 1000 pax.</small>
        </div>
      </div>
                                        <!-- Room -->
      <div class="card">
        <img class="card-img-top" src="dance-studio.jpg" alt="Card image cap">
        <div class="card-body">
          <h5 class="card-title">Dance Studio</h5>
          <p class="card-text">No Equipment Available. || See Equipment Reservation Form to reserve additional equipment.</p>
        </div>
		<div class="card-footer">
          <small class="text-muted">Capacity: 50 pax.</small>
        </div>
      </div>
      <div class="card">
        <img class="card-img-top" src="Badminton.jpg" alt="Card image cap">
        <div class="card-body">
          <h5 class="card-title">Badminton Court</h5>
          <p class="card-text">No Equipment Available. || See Equipment Reservation Form to reserve additional equipment. <br><br><br></p>
        </div>
        <div class="card-footer">
          <small class="text-muted">Capacity: 30 pax.</small>
        </div>
      </div>
	  
	<div class="card">
		<img class="card-img-top" src="room-2.jpg" alt="Card image cap">
			<div class="card-body">
				<h5 class="card-title">Conference Room (near Dining Hall)</h5>
					<p class="card-text">No Equipment Available. || See Equipment Reservation Form to reserve additional equipment.</p>
			</div>
		<div class="card-footer">
			<small class="text-muted">Capacity: 20 pax.</small>
		</div>
	</div>
	
	<div class="card">
		<img class="card-img-top" src="kitchen-2.jpg" alt="Card image cap">
			<div class="card-body">
				<h5 class="card-title">Kitchen (Cookery)</h5>
					<p class="card-text">No Equipment Available. || See Equipment Reservation Form to reserve additional equipment.</p>
			</div>
		<div class="card-footer">
			<small class="text-muted">Capacity: 40 pax.</small>
		</div>
	</div>
	
	<div class="card">
		<img class="card-img-top" src="Lounge.jpg" alt="Card image cap">
			<div class="card-body">
				<h5 class="card-title">Student's Lounge</h5>
					<p class="card-text">No Equipment Available. || See Equipment Reservation Form to reserve additional equipment.</p>
			</div>
		<div class="card-footer">
			<small class="text-muted">Capacity: 80-100 pax.</small>
		</div>
	</div>
  </div>
  
</body>

</html>
    <?php
    exit; // Stop rendering the rest of the page until the password is submitted
}
?>