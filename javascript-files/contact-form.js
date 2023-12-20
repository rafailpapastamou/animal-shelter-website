document.addEventListener("DOMContentLoaded", function () {
    var contactForm = document.getElementById("contactForm");
    
    // Add event listener to the form
    contactForm.addEventListener("submit", function (event) {
      if (!validateForm()) {
        // If form validation fails, prevent form submission
        event.preventDefault();
      }
    });
  
    // Add event listener to page unload
    window.addEventListener("unload", function () {

        // Clear the form fields
        contactForm.elements["name"].value = "";
        contactForm.elements["email"].value = "";
        contactForm.elements["text"].value = "";
    });

  
    // Add event listener to page refresh
    window.addEventListener("beforeunload", function (event) {
      // Check if the form has any input values
      if (
        contactForm.elements["name"].value ||
        contactForm.elements["email"].value ||
        contactForm.elements["text"].value
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

  // Function to validate the contact form
  function validateForm(event) {
    event.preventDefault(); // Prevent the form from submitting by default

    var name = document.forms["contactForm"]["name"].value;
    var email = document.forms["contactForm"]["email"].value;
    var message = document.forms["contactForm"]["text"].value;

    // Reset styles to default
    resetStyles(document.forms["contactForm"]["name"], "nameError");
    resetStyles(document.forms["contactForm"]["email"], "emailError");
    resetStyles(document.forms["contactForm"]["text"], "textError");

    // Check if name is empty or contains numbers
    if (name == "") {
      showError(document.forms["contactForm"]["name"], "Εισάγετε ονοματεπώνυμο.", "nameError");
      return false;
  } else if (!/^[a-zA-Zα-ωΑ-ΩάέήίύϋΐόώΆΈΉΊΎΪΌΏ\s]+$/.test(name)) {
      showError(document.forms["contactForm"]["name"], "Εισάγετε έγκυρο ονοματεπώνυμο.", "nameError");
      return false;    
  } else if (name.length < 5) {
      showError(document.forms["contactForm"]["name"], "Το ονοματεπώνυμο πρέπει να έχει τουλάχιστον 5 χαρακτήρες.", "nameError");
      return false;
  }
  

    // Check if email is a valid email address
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (email == "") {
        showError(document.forms["contactForm"]["email"], "Εισάγετε μια διεύθυνση email.", "emailError");
        return false;
    } else if(!emailRegex.test(email)){
        showError(document.forms["contactForm"]["email"], "Εισάγετε μια έγκυρη διεύθυνση email.", "emailError");
        return false;
    }

    // Check if message is empty
    if (message == "") {
        showError(document.forms["contactForm"]["text"], "Συμπληρώστε το πεδίο μηνύματος.", "textError");
        return false;
    }

    // Call the function to send the email
    sendEmail(name, email, message);

    // Clear the form fields
    document.forms["contactForm"]["name"].value = "";
    document.forms["contactForm"]["email"].value = "";
    document.forms["contactForm"]["text"].value = "";

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

// Function to send the email
function sendEmail(name, email, message){
  Email.send({
    SecureToken: "d1379b88-7c96-4fd2-8a58-60883cb9531f",
    To : 'animal.shelter.lab2324@gmail.com',
    From : 'animal.shelter.lab2324@gmail.com',
    Subject : "Νέο μήνυμα μέσω της φόρμας επικοινωνίας",
    Body: "Ονοματεπώνυμο: " + name + "<br>Διεύθυνση email: " + email + "<br>Μήνυμα: " + message
}).then(
message => alert("Το μήνυμά σας στάλθηκε επιτυχώς! Θα επικοινωνήσουμε μαζί σας το συντομότερο δυνατό.")
);
}