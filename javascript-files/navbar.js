// navbar.js
fetch('../navbars/navbar.html')
  .then(response => response.text())
  .then(data => {
    document.getElementById('navbarContainer').innerHTML = data;
  });
