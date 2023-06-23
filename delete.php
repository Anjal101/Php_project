<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "note";

$conn = mysqli_connect($host, $user, $pass, $dbname);
if (!$conn) {
  die("COULD NOT CONNECT! " . mysqli_connect_error());
}

if (isset($_GET['delete_id'])) {
  $deleteId = $_GET['delete_id'];
  $sql = "DELETE FROM notes WHERE id='$deleteId'";
  mysqli_query($conn, $sql);
  header("Location: index.php");
  exit();
}

mysqli_close($conn);
?>
