// navbar-admin.js
fetch('../navbars/navbar-login-admin.html')
  .then(response => response.text())
  .then(data => {
    document.getElementById('navbar-login-adminContainer').innerHTML = data;
  });
