<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login result</title>
    <link rel="stylesheet" type="text/css" href="style/sitestyle.css" />
    <link rel="icon" href="images/pine-tree.png" type= "image/png" />
</head>

<body>

<?php
session_start();
//VARIABILI INPUT
  $email = $_POST['email'];
  $password = $_POST['pass'];

//MANCANO DEI DATI
  if(empty($email))
    die("<h1>Please insert your email!</h1>");
  if(empty($password))
    die("<h1>Please insert your password!</h1>");

//CONNESSIONE DATABASE
  include "shared/database.php";
  //Pulizia Input
  $email =  mysqli_real_escape_string($conn, $email);
  //Preparazione query
  $query = "SELECT firstname,lastname,pwd,newsletter,admin FROM users WHERE email='$email'";
  //Esecuzione e controllo risultato
  $result = mysqli_query($conn, $query);
  if(mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_array($result);
    if(password_verify($password, $row["pwd"])){
      $_SESSION["login"] = true;
      $_SESSION["email"] = $email;
      $_SESSION["firstname"] = $row['firstname'];
      $_SESSION["lastname"] = $row['lastname'];
      $_SESSION["newsletter"] = $row["newsletter"];
      $_SESSION["admin"] = $row["admin"];
      include 'shared/header.php';
      echo "<div id='main'>\n";
      echo "<div id='site_content'>\n";
      echo "<h1>Welcome back, " . $row["firstname"] . "</h1>\n";
      echo "</div>\n";
      echo "</div>\n";
    }
    else{
      include 'shared/header.php';
      echo "<div id='main'>\n";
      echo "<div id='site_content'>\n";
      echo "<h1>Wrong credentials, are you even registered?</h1>\n";
      echo "</div>\n";
      echo "</div>\n";
      mysqli_close($conn);
      echo "</body>\n";
      echo "</html>\n";
      header("Refresh:2; url=signin.php");
      exit();
    }
  }
  else{
    include 'shared/header.php';
    echo "<div id='main'>\n";
    echo "<div id='site_content'>\n";
    echo "<h1>Wrong credentials, are you even registered?</h1>\n";
    echo "</div>\n";
    echo "</div>\n";
    mysqli_close($conn);
    echo "</body>\n";
    echo "</html>\n";
    header("Refresh:2; url=signin.php");
    exit();
  }

//CHIUSURA CONNESSIONE DATABASE
  mysqli_close($conn);

  header("Refresh:2; url=index.php");
?>

</body>
</html>
