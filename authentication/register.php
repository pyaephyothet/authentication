<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <div class="container">
    <?php
if (isset($_POST['register'])) {
    $name = $_POST['u-name'];
    $email = $_POST['email'];
    $password = $_POST['u-pw'];
    $confirm_password = $_POST['c-pw'];

    function checkStrongPassword($password)
    {
        $lowercase = $uppercase = $number = $special = false;
        if (preg_match('/[a-z]/', $password) && preg_match('/[A-Z]/', $password) && preg_match('/[1-9]/', $password) && preg_match('/[!@#$%*^]/', $password)) {
            $lowercase = $uppercase = $number = $special = true;
        }
        if ($lowercase && $uppercase && $number && $special) {
            return true;
        } else {
            return false;
        }
    }

    if ($name != "" && $email != "" && $password != "" && $confirm_password != "") {
        if (strlen($password) >= 6 && strlen($confirm_password) >= 6) {
            if ($password == $confirm_password) {
                $status = checkStrongPassword($password);
                if ($status) {
                    $_SESSION['email'] = $email;
                    $_SESSION['password'] = password_hash($password, PASSWORD_BCRYPT);
                    $success = "Register Success!";
                    echo "<script>location.href = 'login.php'</script>";
                } else {
                    $pwError = "Password is weak!";
                }
            } else {
                $pwError = "Passwords must be the same.";
            }
        } else {
            $pwError = "Your password must be greater than or equal 6 characters.";
        }
    } else {
        $nullError = "Need to fill!";
    }
}
?>
    <?php if (isset($success)) {?><div class="alert alert-success"><?php echo $success; ?></div><?php }?>
    <form method="post">
      <div class="user-input">
        <label for="">Name</label>
        <input type="text" name="u-name">
        <span class="err"><?php if (isset($nullError)) {echo $nullError;}?></span>
      </div>
      <div class="user-input">
        <label for="">Email</label>
        <input type="email" name="email">
        <span class="err"><?php if (isset($nullError)) {echo $nullError;}?></span>
      </div>
      <div class="user-input">
        <label for="">Password</label>
        <input type="password" name="u-pw">
        <span class="err"><?php if (isset($nullError)) {echo $nullError;}?></span>
        <span class="err"><?php if (isset($pwError)) {echo $pwError;}?></span>
      </div>
      <div class="user-input">
        <label for="">Confirm Password</label>
        <input type="password" name="c-pw">
        <span class="err"><?php if (isset($nullError)) {echo $nullError;}?></span>
        <span class="err"><?php if (isset($pwError)) {echo $pwError;}?></span>
      </div>
      <button class="u-btn rigister-btn" type="submit" name="register">Register</button>
    </form>
  </div>
</body>

</html>