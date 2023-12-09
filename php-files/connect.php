<?php
// connect.php

$con = mysqli_connect('localhost', 'lab2324omada2', 'KatiEykolo123', 'lab2324omada2_ANIMAL_SHELTER');

// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
?>