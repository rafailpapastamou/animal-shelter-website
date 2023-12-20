<?php include("../../php-files/connect.php"); ?>
<!DOCTYPE html>
<html lang="el">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Καταφύγιο Ζώων</title>
  <!-- fontawesome icon link (for the navbar mobile icon) -->
  <link rel="stylesheet" type="text/css" href="../../css-files/index.css" />
  <script src="https://kit.fontawesome.com/f8b8205a0e.js" crossorigin="anonymous"></script>
  <!-- Enabling the navbar -->
  <script src="../../javascript-files/navbar.js"></script>
</head>

<body>
  <div id="navbarContainer"></div>

  <div id="content">
    <h1>Το καταφύγιό μας</h1>
    <h3 class="animalShelterInfoText">
      Στο καταφύγιο υπάρχουν δεκάδες ζωάκια που ψάχνουν σπίτι. Πιστεύεις πως
      είσαι ο κατάλληλος άνθρωπος για να τους προσφέρεις μία καινούρια ζωή;

      <h3 class="animalShelterInfoText"></h3>

      <h3 class="animalShelterInfoText"><a href="../../html-files/user/animals.php" class="link">Δες τη λίστα</a>
        με τα ζωάκια που χρειάζονται τη βοήθειά σου και μόλις αποφασίσεις για
        ποιον τετράποδο φίλο ενδιαφέρεσαι, συμπλήρωσε μία αίτηση για υιοθεσία. </h3>

      <h3 class="animalShelterInfoText"></h3>

      <h3 class="animalShelterInfoText">Μη διστάσεις να
        <a href="../../html-files/user/contact.html" class="link">επικοινωνήσεις</a>
        μαζί μας για οποιαδήποτε απορία μπορεί να έχεις. Πάντα υπάρχει και η
        επιλογή να έρθεις από κοντά, για να δεις το ζωάκι που σε ενδιαφέρει και
        να μιλήσεις με το εξειδικευμένο μας προσωπικό.
      </h3>


      <div style="display: flex; justify-content: space-between; margin-top: 20px">
        <img class="animal-image" src="../../images/index-cat.jpg" alt="Cartoon Cat Picture" />

        <?php
        $query = "SELECT COUNT(*) as count FROM ANIMAL WHERE GOT_ADOPTED = 1";
        $result = mysqli_query($con, $query);
        if (mysqli_num_rows($result) > 0) {
          $row = mysqli_fetch_assoc($result);
          $gotAdoptedCount = $row['count'];
        } else {
          echo "0 results !!";
        }
        ?>

        <h2 class="gotAdoptedCountText">
          Από το καταφύγιό μας έχουν υιοθετηθεί επιτυχώς
          <?php echo $gotAdoptedCount; ?>
          ζώα!
        </h2>

        <img class="animal-image" src="../../images/index-dog.jpg" alt="Cartoon Dog Picture" />
      </div>

      <?php
      $query = "SELECT COUNT(*) as employeeCount FROM EMPLOYEE";
      $result = mysqli_query($con, $query);
      if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $employeeCount = $row['employeeCount'];
      } else {
        echo "0 results !!";
      }
      ?>

      <div class="info" style="margin-bottom: 20px">
        <h2 style="color: white">Ποιοι είμαστε;</h2>
        <p>
          Το καταφύγιό μας ιδρύθηκε το 2023 και βρίσκεται στην πόλη της Ξάνθης.
          Στο καταφύγιο αυτή τη στιγμή εργάζονται
          <?php echo $employeeCount; ?>
          υπάλληλοι και δεχόμαστε τη βοήθεια πολλών εθελοντών.
        </p>
      </div>

      <div class="info" style="margin-bottom: 20px">
        <h2 style="color: white">Ο στόχος μας</h2>
        <p>
          Στόχος του καταφυγίου μας είναι να μη βλέπουμε αδέσποτα στους δρόμους
          της πόλης μας, προσφέροντας σε κάθε ζώο ένα σπίτι για να μένει.
        </p>
      </div>

      <div class="info">
        <h2 style="color: white">Πώς μπορείς να μας βοηθήσεις;</h2>
        <p>
          Το καταφύγιο έχει ανάγκη για εθελοντές.
          <a href="../../html-files/user/contact.html" class="link" style="color: white">Επικοινώνησε</a>
          μαζί μας για περισσότερες λεπτομέρειες.
        </p>
      </div>
      <h2></h2>
  </div>
</body>

</html>