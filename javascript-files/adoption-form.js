document.addEventListener("DOMContentLoaded", function () {
    var adoptionForm = document.getElementById("adoptionForm");
    var formSubmitted = false; // Adding this flag so the browser alert is not shown when the user presses the submit button
    
    // Add event listener to the form
    adoptionForm.addEventListener("submit", function (event) {
      if (!validateForm(event)) {
        // If form validation fails, prevent form submission
        event.preventDefault();
      }
      else {
        formSubmitted = true;
      }
    });
  
    // Add event listener to page unload
    window.addEventListener("unload", function () {

        // Clear the form fields
        adoptionForm.elements["wantedAnimal"].value = "";
        adoptionForm.elements["name"].value = "";
        adoptionForm.elements["surname"].value = "";
        adoptionForm.elements["email"].value = "";
        adoptionForm.elements["phone"].value = "";
        adoptionForm.elements["address"].value = "";
        adoptionForm.elements["familyStatus"].value = "";
    });

  
    // Add event listener to page refresh
    window.addEventListener("beforeunload", function (event) {
    // Check if the form has any input values
    if (!formSubmitted &&
        (adoptionForm.elements["wantedAnimal"].value ||
         adoptionForm.elements["name"].value ||
         adoptionForm.elements["surname"].value ||
         adoptionForm.elements["email"].value ||
         adoptionForm.elements["phone"].value ||
         adoptionForm.elements["address"].value ||
         adoptionForm.elements["familyStatus"].value)
    ) {
        // Prompt the user before leaving the page
        var confirmation = window.confirm(
            "Refreshing the page will delete the form data. Are you sure you want to proceed?"
        );

        if (!confirmation) {
            // Cancel the page refresh if the user clicks "Cancel" in the confirmation dialog
            event.preventDefault();
        }
    }
    });
  });

    // Function to validate the adoption form
    function validateForm(event) {
    //event.preventDefault(); // Prevent the form from submitting by default

    var wantedAnimal = document.forms["adoptionForm"]["wantedAnimal"].value
    var name = document.forms["adoptionForm"]["name"].value;
    var surname = document.forms["adoptionForm"]["surname"].value;
    var email = document.forms["adoptionForm"]["email"].value;
    var phone = document.forms["adoptionForm"]["phone"].value;
    var address = document.forms["adoptionForm"]["address"].value;

    // Reset styles to default
    resetStyles(document.forms["adoptionForm"]["wantedAnimal"], "wantedAnimalError");
    resetStyles(document.forms["adoptionForm"]["name"], "nameError");
    resetStyles(document.forms["adoptionForm"]["surname"], "surnameError");
    resetStyles(document.forms["adoptionForm"]["email"], "emailError");
    resetStyles(document.forms["adoptionForm"]["phone"], "phoneError");
    resetStyles(document.forms["adoptionForm"]["address"], "addressError");

    if (wantedAnimal == "") {
        showError(document.forms["adoptionForm"]["wantedAnimal"], "Επιλέξτε ζώο.", "wantedAnimalError");
        return false;
    }
    

    // Check if name is empty or contains numbers
    if (name == "") {
        showError(document.forms["adoptionForm"]["name"], "Εισάγετε όνομα.", "nameError");
        return false;
    } else if (!/^[a-zA-Zα-ωΑ-ΩάέήίύϋΐόώΆΈΉΊΎΪΌΏ\s]+$/.test(name)) {
        showError(document.forms["adoptionForm"]["name"], "Εισάγετε έγκυρο όνομα.", "nameError");
        return false;    
    } else if (name.length < 2) {
        showError(document.forms["adoptionForm"]["name"], "Το όνομα πρέπει να έχει τουλάχιστον 2 χαρακτήρες.", "nameError");
        return false;
    } else if (name.includes(" ")) {
        showError(document.forms["adoptionForm"]["name"], "Το όνομα δεν πρέπει να περιέχει κενά.", "nameError");
        return false;
    }

    if (surname == "") {
        showError(document.forms["adoptionForm"]["surname"], "Εισάγετε επίθετο.", "surnameError");
        return false;
    } else if (!/^[a-zA-Zα-ωΑ-ΩάέήίύϋΐόώΆΈΉΊΎΪΌΏ\s]+$/.test(surname)) {
        showError(document.forms["adoptionForm"]["surname"], "Εισάγετε έγκυρο επίθετο.", "surnameError");
        return false;    
    } else if (surname.length < 2) {
        showError(document.forms["adoptionForm"]["surname"], "Το επίθετο πρέπει να έχει τουλάχιστον 2 χαρακτήρες.", "surnameError");
        return false;
    } else if (surname.includes(" ")) {
        showError(document.forms["adoptionForm"]["surname"], "Το  επίθετο δεν πρέπει να περιέχει κενά.", "surnameError");
        return false;
    }

    // Check if email is a valid email address
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (email == "") {
        showError(document.forms["adoptionForm"]["email"], "Εισάγετε μια διεύθυνση email.", "emailError");
        return false;
    } else if(!emailRegex.test(email)){
        showError(document.forms["adoptionForm"]["email"], "Εισάγετε μια έγκυρη διεύθυνση email.", "emailError");
        return false;
    }

    var phoneRegex = /^\d{10}$/;
    if (phone == "") {
        showError(document.forms["adoptionForm"]["phone"], "Εισάγετε έναν αριθμό τηλεφώνου.", "phoneError");
        return false;
    } else if (!phoneRegex.test(phone)) {
        showError(document.forms["adoptionForm"]["phone"], "Εισάγετε έναν έγκυρο αριθμό τηλεφώνου (10 ψηφία).", "phoneError");
        return false;
    }

    if (address == "") {
        showError(document.forms["adoptionForm"]["address"], "Εισάγετε μία διεύθυνση κατοικίας.", "addressError");
        return false;
    } else if (!/^[\w\s,Α-Ωα-ωάέήίύϋΐόώΆΈΉΊΎΪΌΏ]+$/.test(address)) {
        showError(document.forms["adoptionForm"]["address"], "Εισάγετε έγκυρη διεύθυνση κατοικίας.", "addressError");
        return false;    
    } else if (address.length < 5) {
        showError(document.forms["adoptionForm"]["address"], "Η διεύθυνση κατοικίας πρέπει να έχει τουλάχιστον 5 χαρακτήρες.", "addressError");
        return false;
    }
      
    
    // // Clear the form fields
    // document.forms["adoptionForm"]["wantedAnimal"].value = "";
    // document.forms["adoptionForm"]["name"].value = "";
    // document.forms["adoptionForm"]["surname"].value = "";
    // document.forms["adoptionForm"]["email"].value = "";
    // document.forms["adoptionForm"]["phone"].value = "";
    // document.forms["adoptionForm"]["address"].value = "";
    // document.forms["adoptionForm"]["familyStatus"].value = "";

    return true;
}

// Function to reset styles to default
function resetStyles(element, errorId) {
    element.style.borderColor = "#94c970";
    document.getElementById(errorId).innerHTML = '';
}

// Function to show error message and update styles
function showError(element, errorMessage, errorId) {
    element.style.borderColor = "red";
    document.getElementById(errorId).innerHTML = errorMessage;
}
