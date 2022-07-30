<!DOCTYPE HTML>
<html lang="en">
<head>
    <title>Searching...</title>
    <link rel="stylesheet" type="text/css" href="style/sitestyle.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" href="images/pine-tree.png" type= "image/png" />
</head>

<body>

<div id="main">
<?php
  session_start();
  include 'shared/header.php';
  include 'shared/database.php';
  echo "<div id='site_content'>\n";

  //Preparazione input utente
  $content = trim($_POST['search']);
  if(empty($content)){
    echo "<h1>Error searching, please insert something to search</h1>\n";
    echo "<h2>Try again!</h2>\n";
    echo "<form id='searchbar' action='search.php' method='POST'>\n
            <input id='search' name='search' type='text' placeholder='Search now!'>\n
            <input id='searchbutton' type='submit' value='search'>\n
          </form>\n";
    echo "</div>\n";
    mysqli_close($conn);
    include 'shared/footer.php';
    exit();
  }
  $content =  mysqli_real_escape_string($conn, $content);

  //SEZIONE SQL
  $query = "SELECT * FROM post WHERE title LIKE '%" . $content . "%'";
  //Esecuzioneo
  $res = mysqli_query($conn,$query);
  //Controllo risultato
  if (mysqli_num_rows($res) > 0){
    echo "<h1>" . mysqli_num_rows($res) ." results about '". $_POST['search'] . "':</h1>\n";
    while($row = mysqli_fetch_assoc($res))
    echo
    "<div class = 'blogbox'>\n
    <h1><a href='details.php?id={$row['idpost']}'>" . $row['title']. "</a> <br> by " . $row['author'] . "</h1>
    </div>";
    echo "</div>\n";
    }
  else {
    echo "<h1>We found nothing about '". $_POST['search'] . "'</h1>\n";
    echo "<h2>Try to search again!</h2>\n";
    echo "<form id='searchbar' action='search.php' method='POST'>\n
            <input id='search' name='search' type='text' placeholder='Search now!'>\n
            <input id='searchbutton' type='submit' value='search'>\n
          </form>\n";
    echo "</div>\n";
    }
  echo "</div>\n";
  //Chiusura connessione
  mysqli_close($conn);

  include 'shared/footer.php';
  ?>
