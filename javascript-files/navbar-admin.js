// navbar-admin.js
fetch('../navbars/navbar-admin.html')
  .then(response => response.text())
  .then(data => {
    document.getElementById('navbar-adminContainer').innerHTML = data;
  });
