<?php
  $conn = new mysqli('localhost', 'root', '', 'expensys');

  if ($conn->connect_error) {
      die("Connection failed!");
  }
?>