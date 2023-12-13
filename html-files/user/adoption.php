<?php include("../../php-files/connect.php"); ?>

<!DOCTYPE html>
<html lang="el">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Υιοθεσία</title>
  <link rel="stylesheet" type="text/css" href="../../css-files/adoption.css" />
  <!-- fontawesome icon link (for the navbar mobile icon) -->
  <script src="https://kit.fontawesome.com/f8b8205a0e.js" crossorigin="anonymous"></script>
  <!-- Enabling the navbar -->
  <script src="../../javascript-files/navbar.js"></script>
  <script src="../../javascript-files/adoption-form.js"></script>
</head>

<body>
  <div id="navbarContainer"></div>
  <div id="content">
    <h1>Υιοθεσία</h1>

    <h3>
      Μπορείτε να υποβάλετε αίτηση για ένα συγκεκριμένο ζώο μόνο ΜΙΑ φορά.
      Μπορείτε όμως, να δηλώσετε ενδιαφέρον για περισσότερο από ένα ζώα.
    </h3>

    <h3>
      Θα επικοινωνήσουμε μαζί σας το συντομότερο δυνατό και κατόπιν
      συνεννόησης θα κλείσουμε ραντεβού για να έρθετε στον χώρο του
      καταφυγίου.
    </h3>

    <form id="adoptionForm" method="post" action="" onsubmit="return validateForm(event)">
      <h2>Φόρμα Αίτησης Υιοθεσίας</h2>

      <div class="form-group">
        <label for="wantedAnimal">Ζώο*</label>
        <div id="wantedAnimalError" class="error-message"></div>
        <select name="wantedAnimal" class="feedback-input">
          <option value="" disabled selected>
            Επιλέξτε το ζώο που σας ενδιαφέρει
          </option>
          <?php
          $query = "SELECT * FROM ANIMAL WHERE IS_ADOPTABLE = 1";
          $result = mysqli_query($con, $query);
          if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
              echo "<option value=\"" . $row['ANIMAL_ID'] . "\">" . $row['ANIMAL_ID'] . ". " . $row['NAME'] . ": " . $row['SPECIES'] . ", " . $row['SEX'] . "</option>";
            }
          } else {
            echo "0 results !!";
          }
          ?>
        </select>
      </div>

      <div class="form-group">
        <label for="name">Όνομα*</label>
        <div id="nameError" class="error-message"></div>
        <input name="name" type="text" class="feedback-input" placeholder="Όνομα" />
      </div>

      <div class="form-group">
        <label for="surname">Επίθετο*</label>
        <div id="surnameError" class="error-message"></div>
        <input name="surname" type="text" class="feedback-input" placeholder="Επίθετο" />
      </div>

      <div class="form-group">
        <label for="email">Διεύθυνση email*</label>
        <div id="emailError" class="error-message"></div>
        <input name="email" type="email" class="feedback-input" placeholder="Διεύθυνση email" />
      </div>

      <div class="form-group">
        <label for="phone">Αριθμός Τηλεφώνου*</label>
        <div id="phoneError" class="error-message"></div>
        <input name="phone" type="tel" class="feedback-input" placeholder="Αριθμός Τηλεφώνου" />
      </div>

      <div class="form-group">
        <label for="address">Διεύθυνση Κατοικίας*</label>
        <div id="addressError" class="error-message"></div>
        <input name="address" type="text" class="feedback-input" placeholder="Οδός, Αριθμός, Πόλη, Τ.Κ." />
      </div>

      <div class="form-group">
        <label for="familyStatus">Οικογενειακή Κατάσταση (παιδιά ή άλλα κατοικίδια)</label>
        <input name="familyStatus" type="text" class="feedback-input" placeholder="Οικογενειακή Κατάσταση" />
      </div>

      <input type="submit" value="ΥΠΟΒΟΛΗ" />
    </form>
    <h2></h2>
  </div>

  <?php


  $insertQuery = "INSERT INTO ADOPTER (ADOPTER_ID, FIRST_NAME, LAST_NAME, PHONE_NUMBER, ADDRESS, EMAIL_ADDRESS, FAMILY_STATUS) 
    VALUES ('40005', 'Λάμπης', 'Βλαμενάκης', '6977746389', 'Καραμανλή 10, Ιωάννινα 64792', 'bauygfr0lol@yahoo.gr', '');";

  if (mysqli_query($con, $insertQuery)) {
    echo "Record added successfully";
  } else {
    echo "Error adding record: " . mysqli_error($con);
  }

  // // Retrieve form data
  // $wantedAnimal = $_POST["wantedAnimal"];
  // $name = $_POST["name"];
  // $surname = $_POST["surname"];
  // $email = $_POST["email"];
  // $phone = $_POST["phone"];
  // $address = $_POST["address"];
  // $familyStatus = $_POST["familyStatus"];
  
  // // Check if the user already exists
  // $checkUserQuery = "SELECT ADOPTER_ID FROM ADOPTER WHERE NAME = '$name' AND SURNAME = '$surname' AND EMAIL = '$email'";
  // $checkUserResult = mysqli_query($con, $checkUserQuery);
  
  // if ($checkUserResult && mysqli_num_rows($checkUserResult) > 0) {
  //   // User already exists, retrieve ADOPTER_ID
  //   $row = mysqli_fetch_assoc($checkUserResult);
  //   $adopter_id = $row['adopter_id'];
  
  //   // Check if this user already made an adoption request for this animal
  //   $checkAdoptionRequestQuery = "SELECT * FROM ADOPTION_REQUEST 
  //                               WHERE APPLICANT = '$adopter_id' 
  //                               AND WANTED_ANIMAL = '$wantedAnimal'";
  //   $checkAdoptionRequestResult = mysqli_query($con, $checkAdoptionRequestQuery);
  
  //   if ($checkAdoptionRequestResult && mysqli_num_rows($checkAdoptionRequestResult) > 0) {
  //     // User has already made an adoption request for this animal
  //     echo "User has already made an adoption request for this animal.";
  //   } else {
  //     // User has not made an adoption request for this animal
  //     // Insert data into 'ADOPTER' table
  //     $insertQuery = "UPDATE ADOPTER SET PHONE_NUMBER = '$phone', ADDRESS = '$address', EMAIL_ADDRESS = '$email', FAMILY_STATUS = '$familyStatus'
  //     WHERE ADOPTER_ID = '$adopter_id'";
  
  //     if (mysqli_query($con, $insertQuery)) {
  //       echo "Record added successfully";
  //     } else {
  //       echo "Error adding record: " . mysqli_error($con);
  //     }
  
  //     // Finding the next ADOPTION_ID
  //     $fetchMaxAdoptionIdQuery = "SELECT MAX(ADOPTION_ID) AS max_id FROM ADOPTION_REQUEST";
  //     $fetchMaxAdoptionIdResult = mysqli_query($con, $fetchMaxAdoptionIdQuery);
  //     if ($fetchMaxAdoptionIdResult && mysqli_num_rows($fetchMaxAdoptionIdResult) > 0) {
  //       $maxAdoptionIdRow = mysqli_fetch_assoc($fetchMaxAdoptionIdResult);
  //       $nextAdoptionId = $maxAdoptionIdRow['max_id'] + 1;
  //     } else {
  //       // No existing records, start with ADOPTION_ID 50001
  //       $nextAdoptionId = 50001;
  //     }
  
  //     // Insert data into 'ADOPTION_REQUEST' table
  //     $insertQuery = "INSERT INTO ADOPTION_REQUEST (ADOPTION_ID, ADOPTION_STATUS, DATE_OF_REQUEST, DATE_OF_ADOPTION, IS_ONLINE, WANTED_ANIMAL, APPLICANT) 
  //   VALUES ('$nextAdoptionId', 'Επεξεργάζεται', NOW(), NULL, 1, '$wantedAnimal', '$nextAdopterId')";
  
  //     if (mysqli_query($con, $insertQuery)) {
  //       echo "Record added successfully";
  //     } else {
  //       echo "Error adding record: " . mysqli_error($con);
  //     }
  //   }
  
  // } else {
  //   // User does not exist, give him the next available ADOPTER_ID
  //   $fetchMaxIdQuery = "SELECT MAX(ADOPTER_ID) AS max_id FROM ADOPTER";
  //   $fetchMaxIdResult = mysqli_query($con, $fetchMaxIdQuery);
  //   if ($fetchMaxIdResult && mysqli_num_rows($fetchMaxIdResult) > 0) {
  //     $maxIdRow = mysqli_fetch_assoc($fetchMaxIdResult);
  //     $nextAdopterId = $maxIdRow['max_id'] + 1;
  //   } else {
  //     // No existing records, start with ADOPTER_ID 40001
  //     $nextAdopterId = 40001;
  //   }
  
  //   // Insert data into 'ADOPTER' table
  //   $insertQuery = "INSERT INTO ADOPTER (ADOPTER_ID, FIRST_NAME, LAST_NAME, PHONE_NUMBER, ADDRESS, EMAIL_ADDRESS, FAMILY_STATUS) 
  //                 VALUES ('$nextAdopterId', '$name', '$surname', '$phone', '$address', '$email', '$familyStatus')";
  
  //   if (mysqli_query($con, $insertQuery)) {
  //     echo "Record added successfully";
  //   } else {
  //     echo "Error adding record: " . mysqli_error($con);
  //   }
  
  //   // Finding the next ADOPTION_ID
  //   $fetchMaxAdoptionIdQuery = "SELECT MAX(ADOPTION_ID) AS max_id FROM ADOPTION_REQUEST";
  //   $fetchMaxAdoptionIdResult = mysqli_query($con, $fetchMaxAdoptionIdQuery);
  //   if ($fetchMaxAdoptionIdResult && mysqli_num_rows($fetchMaxAdoptionIdResult) > 0) {
  //     $maxAdoptionIdRow = mysqli_fetch_assoc($fetchMaxAdoptionIdResult);
  //     $nextAdoptionId = $maxAdoptionIdRow['max_id'] + 1;
  //   } else {
  //     // No existing records, start with ADOPTION_ID 50001
  //     $nextAdoptionId = 50001;
  //   }
  
  //   // Insert data into 'ADOPTION_REQUEST' table
  //   $insertQuery = "INSERT INTO ADOPTION_REQUEST (ADOPTION_ID, ADOPTION_STATUS, DATE_OF_REQUEST, DATE_OF_ADOPTION, IS_ONLINE, WANTED_ANIMAL, APPLICANT) 
  //                 VALUES ('$nextAdoptionId', 'Επεξεργάζεται', NOW(), NULL, 1, '$wantedAnimal', '$nextAdopterId')";
  
  //   if (mysqli_query($con, $insertQuery)) {
  //     echo "Record added successfully";
  //   } else {
  //     echo "Error adding record: " . mysqli_error($con);
  //   }
  
  // }
  
  ?>

</body>

</html>