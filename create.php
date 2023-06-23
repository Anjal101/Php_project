<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "note";

$conn = mysqli_connect($host, $user, $pass, $dbname);
if (!$conn) {
  die("COULD NOT CONNECT! " . mysqli_connect_error());
}

if (isset($_POST['content'])) {
  $content = $_POST['content'];
  $sql = "INSERT INTO notes (content) VALUES ('$content')";
  mysqli_query($conn, $sql);
  header("Location: index.php");
  exit();
}

mysqli_close($conn);
?>



<!-- mysqli_connect() -->
