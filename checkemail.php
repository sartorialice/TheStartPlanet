<?php
  include "shared/database.php";

  $email = trim($_POST['email']);
  $email =  mysqli_real_escape_string($conn, $email);

  $query = "SELECT * FROM users WHERE email='$email'";
  $result = mysqli_query($conn, $query);

  if(mysqli_num_rows($result) > 0) {
    mysqli_close($conn);
    echo "nogood";
  }
  else {
    mysqli_close($conn);
    echo "good";
  }
?>
