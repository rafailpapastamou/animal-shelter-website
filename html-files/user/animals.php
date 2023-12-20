<?php include("../../php-files/connect.php"); ?>

<!DOCTYPE html>
<html lang="el">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Ζώα</title>
  <link rel="stylesheet" type="text/css" href="../../css-files/animals.css" />
  <!-- fontawesome icon link (for the navbar mobile icon) -->
  <script src="https://kit.fontawesome.com/f8b8205a0e.js" crossorigin="anonymous"></script>
  <!-- Enabling the navbar -->
  <script src="../../javascript-files/navbar.js"></script>
</head>

<body>
  <div id="navbarContainer"></div>
  <div id="content">
    <h1>Ζώα</h1>
    <h3>
      Παρακάτω φαίνονται τα διαθέσιμα ζώα για υιοθεσία. Διάλεξε αυτό που σε
      ενδιαφέρει και κάνε μια αίτηση για την υιοθεσία του.
    </h3>

    <!-- Animal Adoption Table -->
    <table border="1">
      <thead>
        <tr>
          <th>Κωδικός Ζώου</th>
          <th>Όνομα</th>
          <th>Είδος</th>
          <th>Ράτσα</th>
          <th>Φύλο</th>
          <th>Χρώμα</th>
          <th>Ηλικία</th>
        </tr>
      </thead>
      <tbody>
        <?php
        // Fetch data from the database
        $query = "SELECT * FROM ANIMAL WHERE IS_ADOPTABLE = 1";
        $result = mysqli_query($con, $query);

        // Display data in the table
        while ($row = $result->fetch_assoc()) {
          echo "<tr>";
          echo "<td>" . $row['ANIMAL_ID'] . "</td>";

          echo "<td>";
          echo empty($row['NAME']) ? "-" : $row['NAME'];
          echo "</td>";

          echo "<td>" . $row['SPECIES'] . "</td>";

          echo "<td>";
          echo empty($row['BREED']) ? "-" : $row['BREED'];
          echo "</td>";

          echo "<td>";
          if ($row['SEX'] == 'M') {
            echo "Αρσενικό";
          } elseif ($row['SEX'] == 'F') {
            echo "Θυληκό";
          }
          echo "</td>";

          echo "<td>";
          echo empty($row['COLOR']) ? "-" : $row['COLOR'];
          echo "</td>";

          echo "<td>";
          if (empty($row['DATE_OF_BIRTH'])) {
            echo "-";
          } else {
            // Calculate age from date of birth
            $dob = new DateTime($row['DATE_OF_BIRTH']);
            $today = new DateTime();
            $age_year = $today->diff($dob)->y;
            $age_month = $today->diff($dob)->m;

            if ($age_year == 0) {
              echo $age_month . " μηνών";
            } else {
              echo $age_year . " χρονών και " . $age_month . " μηνών";
            }
          }
          echo "</td>";

          echo "</tr>";
        }

        // Close connection
        $conn->close();
        ?>
      </tbody>
    </table>
  </div>
</body>

</html>