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

    <form id="adoptionForm" method="POST" action="submit-adoption.php" onsubmit="return validateForm(event)">
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

</body>

</html>