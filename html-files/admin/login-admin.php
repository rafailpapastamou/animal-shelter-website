<?php
include("../../php-files/connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Retrieve user input from the form
  $email = $_POST["email"];
  $password = $_POST["password"];

  // Query to check if the user exists with the given email and password
  $query = "SELECT * FROM EMPLOYEE WHERE EMAIL = '$email' AND PASSWORD = '$password'";
  $result = mysqli_query($conn, $query);

  if ($result && mysqli_num_rows($result) > 0) {
    // User exists with correct credentials
    // Redirect to a success page or perform further actions
    die("Correct");
  } else {
    // Invalid credentials
    // You may want to display an error message or redirect to a failure page
    die("Invalid email or password");
  }
}
?>

<!DOCTYPE html>
<html lang="el">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Σύνδεση Υπαλλήλου</title>
  <link rel="stylesheet" type="text/css" href="../../css-files/login-admin.css" />
  <!-- fontawesome icon link (for the navbar mobile icon) -->
  <script src="https://kit.fontawesome.com/f8b8205a0e.js" crossorigin="anonymous"></script>
  <!-- Enabling the navbar -->
  <script src="../../javascript-files/navbar-login-admin.js"></script>
</head>

<body>
  <div id="navbar-login-adminContainer"></div>

  <div id="content">
    <div class="login-page">
      <div class="form">
        <form class="login-form" method="post" action="">
          <label for="email">Διεύθυνση email</label>
          <input type="email" id="email" name="email" placeholder="username@email.com" required />
          <label for="password">Κωδικός πρόσβασης</label>
          <input type="password" id="password" name="password" placeholder="********" required />
          <button type="submit">Σύνδεση</button>
        </form>
      </div>
    </div>
  </div>
</body>

</html>