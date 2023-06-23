<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "note";

$conn = mysqli_connect($host, $user, $pass, $dbname);
if (!$conn) {
  die("COULD NOT CONNECT! " . mysqli_connect_error());
}

if (isset($_POST['edit_content']) && isset($_POST['note_id'])) {
  $editContent = $_POST['edit_content'];
  $noteId = $_POST['note_id'];
  $sql = "UPDATE notes SET content='$editContent' WHERE id='$noteId'";
  mysqli_query($conn, $sql);
  header("Location: index.php");
  exit();
}

mysqli_close($conn);
?>
