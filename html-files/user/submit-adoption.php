<?php include("../../php-files/connect.php"); ?>

<!DOCTYPE html>
<html lang="el">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Αίτηση Υιοθεσίας</title>
    <link rel="stylesheet" type="text/css" href="../../css-files/submit-adoption.css" />
    <!-- fontawesome icon link (for the navbar mobile icon) -->
    <script src="https://kit.fontawesome.com/f8b8205a0e.js" crossorigin="anonymous"></script>
    <!-- Enabling the navbar -->
    <script src="../../javascript-files/navbar.js"></script>
</head>

<body>
    <div id="navbarContainer"></div>
    <div id="content">

        <?php

        // Start a transaction
        mysqli_begin_transaction($con);

        try {
            // Retrieve form data
            $wantedAnimal = $_POST['wantedAnimal'];
            $name = $_POST['name'];
            $surname = $_POST['surname'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $address = $_POST['address'];
            $familyStatus = $_POST['familyStatus'];

            // Check if the user already exists
            $checkUserQuery = "SELECT ADOPTER_ID FROM ADOPTER WHERE EMAIL_ADDRESS = '$email'";
            $checkUserResult = mysqli_query($con, $checkUserQuery);

            if ($checkUserResult && mysqli_num_rows($checkUserResult) > 0) {
                // User already exists, retrieve ADOPTER_ID
                $row = mysqli_fetch_assoc($checkUserResult);
                $adopter_id = $row['ADOPTER_ID'];

                // Check if this user has already made an adoption request for this animal
                $checkAdoptionRequestQuery = "SELECT * FROM ADOPTION_REQUEST 
                                WHERE APPLICANT = '$adopter_id' 
                                AND WANTED_ANIMAL = '$wantedAnimal'";
                $checkAdoptionRequestResult = mysqli_query($con, $checkAdoptionRequestQuery);

                if ($checkAdoptionRequestResult && mysqli_num_rows($checkAdoptionRequestResult) > 0) {
                    // User has already made an adoption request for this animal
                    // Display error message with x image
                    echo "<img id='statusImage' src='../../images/x.png' alt='X Image'>";
                    echo "<p>Λυπόμαστε πολύ! Έχει γίνει ήδη αίτηση για αυτό το ζώο με τη συγκεκριμένη διεύθυνση email.</p>";
                } else {
                    // User has not made an adoption request for this animal
                    // Update data in 'ADOPTER' table
                    $updateQuery = "UPDATE ADOPTER SET PHONE_NUMBER = '$phone', ADDRESS = '$address', FAMILY_STATUS = '$familyStatus'
            WHERE ADOPTER_ID = '$adopter_id'";

                    if (mysqli_query($con, $updateQuery)) {
                        // Finding the next ADOPTION_ID
                        $fetchMaxAdoptionIdQuery = "SELECT MAX(ADOPTION_ID) AS max_id FROM ADOPTION_REQUEST";
                        $fetchMaxAdoptionIdResult = mysqli_query($con, $fetchMaxAdoptionIdQuery);

                        if ($fetchMaxAdoptionIdResult && mysqli_num_rows($fetchMaxAdoptionIdResult) > 0) {
                            $maxAdoptionIdRow = mysqli_fetch_assoc($fetchMaxAdoptionIdResult);
                            $nextAdoptionId = $maxAdoptionIdRow['max_id'] + 1;
                        } else {
                            // No existing records, start with ADOPTION_ID 50001
                            $nextAdoptionId = 50001;
                        }

                        // Insert data into 'ADOPTION_REQUEST' table
                        $insertQuery = "INSERT INTO ADOPTION_REQUEST (ADOPTION_ID, ADOPTION_STATUS, DATE_OF_REQUEST, DATE_OF_ADOPTION, IS_ONLINE, WANTED_ANIMAL, APPLICANT) 
                VALUES ('$nextAdoptionId', 'Επεξεργάζεται', NOW(), NULL, 1, '$wantedAnimal', '$adopter_id')";

                        if (!mysqli_query($con, $insertQuery)) {
                            throw new Exception(mysqli_error($con));
                        }

                        // Commit the transaction if everything is successful
                        mysqli_commit($con);

                        // Display success message with check image
                        echo "<img id='statusImage' src='../../images/check.png' alt='Check Image'>";
                        echo "<p>Η αίτηση υιοθεσίας ολοκληρώθηκε με επιτυχία! Θα επικοινωνήσουμε μαζί σας το συντομότερο δυνατό.</p>";
                    } else {
                        throw new Exception(mysqli_error($con));
                    }
                }
            } else {
                // User does not exist, give him the next available ADOPTER_ID
                $fetchMaxIdQuery = "SELECT MAX(ADOPTER_ID) AS max_id FROM ADOPTER";
                $fetchMaxIdResult = mysqli_query($con, $fetchMaxIdQuery);

                if ($fetchMaxIdResult && mysqli_num_rows($fetchMaxIdResult) > 0) {
                    $maxIdRow = mysqli_fetch_assoc($fetchMaxIdResult);
                    $nextAdopterId = $maxIdRow['max_id'] + 1;
                } else {
                    // No existing records, start with ADOPTER_ID 40001
                    $nextAdopterId = 40001;
                }

                // Insert data into 'ADOPTER' table
                $insertQuery = "INSERT INTO ADOPTER (ADOPTER_ID, FIRST_NAME, LAST_NAME, PHONE_NUMBER, ADDRESS, EMAIL_ADDRESS, FAMILY_STATUS) 
                        VALUES ('$nextAdopterId', '$name', '$surname', '$phone', '$address', '$email', '$familyStatus')";

                if (mysqli_query($con, $insertQuery)) {
                    // Finding the next ADOPTION_ID
                    $fetchMaxAdoptionIdQuery = "SELECT MAX(ADOPTION_ID) AS max_id FROM ADOPTION_REQUEST";
                    $fetchMaxAdoptionIdResult = mysqli_query($con, $fetchMaxAdoptionIdQuery);

                    if ($fetchMaxAdoptionIdResult && mysqli_num_rows($fetchMaxAdoptionIdResult) > 0) {
                        $maxAdoptionIdRow = mysqli_fetch_assoc($fetchMaxAdoptionIdResult);
                        $nextAdoptionId = $maxAdoptionIdRow['max_id'] + 1;
                    } else {
                        // No existing records, start with ADOPTION_ID 50001
                        $nextAdoptionId = 50001;
                    }

                    // Insert data into 'ADOPTION_REQUEST' table
                    $insertQuery = "INSERT INTO ADOPTION_REQUEST (ADOPTION_ID, ADOPTION_STATUS, DATE_OF_REQUEST, DATE_OF_ADOPTION, IS_ONLINE, WANTED_ANIMAL, APPLICANT) 
                            VALUES ('$nextAdoptionId', 'Επεξεργάζεται', NOW(), NULL, 1, '$wantedAnimal', '$nextAdopterId')";

                    if (!mysqli_query($con, $insertQuery)) {
                        throw new Exception(mysqli_error($con));
                    }

                    // Commit the transaction if everything is successful
                    mysqli_commit($con);

                    // Display success message with check image
                    echo "<img id='statusImage' src='../../images/check.png' alt='Check Image'>";
                    echo "<p>Η αίτηση υιοθεσίας ολοκληρώθηκε με επιτυχία! Θα επικοινωνήσουμε μαζί σας το συντομότερο δυνατό.</p>";
                } else {
                    throw new Exception(mysqli_error($con));
                }
            }
        } catch (Exception $e) {
            // An error occurred, rollback the transaction
            mysqli_rollback($con);

            // Handle the exception or log the error
            // Display error message with x image
            echo "<img id='statusImage' src='../../images/x.png' alt='X Image'>";
            echo "<p>Λυπόμαστε πολύ! Κάτι πήγε στραβά με το σύστημά μας: " . $e->getMessage() . "</p>";
        }

        // Close the database connection
        mysqli_close($con);
        ?>

    </div>

</body>

</html>