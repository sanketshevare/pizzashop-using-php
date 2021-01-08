<?php

$conn = mysqli_connect('localhost', 'sanket', 'sanket123', 'pizza');

if(!$conn)
{
  echo 'error' . mysqli_connect_error();
}
?>
