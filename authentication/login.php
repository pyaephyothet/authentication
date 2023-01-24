<?php
session_start();
if ($_SESSION['authentication']) {
    header('location: home.php');
    die();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <div class="container">
    <?php
$_SESSION['authentication'] = false;

if (isset($_POST['login'])) {
    $userEmail = $_POST['email'];
    $userPassword = $_POST['u-pw'];

    if ($userEmail != "" && $userPassword != "") {
        if ($userEmail == $_SESSION['email'] && password_verify($userPassword, $_SESSION['password'])) {
            $_SESSION['authentication'] = true;
            $success = "Login Success!";
            echo "<script>location.href = 'home.php'</script>";
        } else {
            $fail = "Login Fails!";
            echo "<script>location.href = 'register.php'</script>";
        }
    } else {
        $nullError = "Need to fill!";
    }
}
?>
    <?php if (isset($success)) {?><div class="alert alert-success"><?php echo $success; ?></div><?php }?>
    <?php if (isset($fail)) {?><div class="alert alert-fail"><?php echo $fail; ?></div><?php }?>
    <form method="post">
      <div class="user-input">
        <label for="">Email</label>
        <input type="email" name="email">
        <span class="err"><?php if (isset($nullError)) {echo $nullError;}?></span>
      </div>
      <div class="user-input">
        <label for="">Password</label>
        <input type="password" name="u-pw">
        <span class="err"><?php if (isset($nullError)) {echo $nullError;}?></span>
      </div>
      <button class="u-btn rigister-btn" type="submit" name="login">Login</button>
    </form>
  </div>

</body>

</html>