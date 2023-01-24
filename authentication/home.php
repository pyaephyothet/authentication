<?php
session_start();
if (!$_SESSION['authentication']) {
    header('location: login.php');
    die();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <div class="container">
    <h1>Home Page</h1>
    <form method="post">
      <button class="u-btn logout-btn" type="submit" name="logout">Logout</button>
      <?php
if (isset($_POST['logout'])) {
    session_unset();
    echo "<script>location.href = 'login.php'</script>";
}
?>
    </form>
  </div>
</body>

</html>