<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Note App</title>
  <style>
    body {
      margin: 0;
        background: url(./bgi.jpg) no-repeat fixed;
        background-position: center;
        background-size: cover;
        height: 100vh;
        font-family: "Courier New", Courier, monospace;
    }

    .heading {
      color: black;
      text-align: center;
      padding-top: 10px;
      font-size: 35px;
    }

    .info-text {
      text-align: center;
      color: rgb(255, 221, 1);
      font-size: 18px;
    }

    .app {
      display: grid;
      grid-template-columns: repeat(auto-fill, 300px);
      gap: 40px;
      justify-content: center;
      padding: 50px;
    }

    .note {
      padding: 17px;
      border-radius: 15px;
      resize: none;
      box-shadow: 0 0 3px rgb(0, 252, 0);
      font-size: 18px;
      height: 200px;
      color: rgb(9, 255, 0);
      border: none;
      outline: none;
      background: rgb(0, 0, 0);
      box-sizing: border-box;
    }

    .note::placeholder {
      color: rgb(72, 255, 0);
      opacity: 30%;
    }

    .note:hover,
    .note:focus {
      box-shadow: 0 0 10px rgb(0, 0, 0);
      transition: all 300ms ease;
    }

    .btn-create {
        background-color: green;
        margin: 10px;
        margin-left: 200px;
        width: 100px;
        margin-top: -10px;
        height: 50px;
    }
    .btn-save {
        background-color: green;
    }
    .btn {
        margin: 10px;
        width: 100px;
        height: 50px;
    }

    .btn-delete {
        background-color: red;
        position: relative;
        top: 206px;
        left: -220px;
    }
  </style>
</head>
<body>
  <h1 class="heading">Note App</h1>
   
  <form action="create.php" method="POST">
  <div class="app">
    <textarea class="note" name="content" placeholder="Enter your note" rows="4" cols="50"></textarea>
</div><button class="btn-create" type="submit">Create Note</button>
  </form>

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

    if (isset($_POST['edit_content']) && isset($_POST['note_id'])) {
      $editContent = $_POST['edit_content'];
      $noteId = $_POST['note_id'];
      $sql = "UPDATE notes SET content='$editContent' WHERE id='$noteId'";
      mysqli_query($conn, $sql);
      header("Location: index.php");
      exit();
    }

    if (isset($_GET['delete_id'])) {
      $deleteId = $_GET['delete_id'];
      $sql = "DELETE FROM notes WHERE id='$deleteId'";
      mysqli_query($conn, $sql);
      header("Location: index.php");
      exit();
    }

    $sql = "SELECT * FROM notes";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
      while ($row = mysqli_fetch_assoc($result)) {
        $noteId = $row['id'];
        $content = $row['content'];

        echo '<div class="app">';
        echo '<form action="index.php" method="POST">';
        echo '<textarea class="note" name="edit_content" rows="4" cols="50">' . $content . '</textarea>';
        echo '<input type="hidden" name="note_id" value="' . $noteId . '">';
        echo '<button class="btn btn-save" type="submit">Save</button>';
        echo '</form>';
        echo '<form action="index.php" method="GET">';
        echo '<input type="hidden" name="delete_id" value="' . $noteId . '">';
        echo '<button type="submit" class="btn btn-delete">Delete</button>';
        echo '</form>';
        echo '</div>';
      }
    } else {
      echo '<p class="info-text">No notes found.</p>';
    }

    mysqli_close($conn);
  ?>

</body>
</html>
