<?php
    $connect = mysqli_connect('localhost','root','','blog') or die('Can not connect database.');
    mysqli_set_charset($connect,"utf8");
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link type="text/css" href="Sign%20in%20style.css" rel="stylesheet">
  <title>Sign in</title>
</head>

<body>
    <?php

        if(isset($_POST["signup"])){
            $user_name2 = $_POST["username2"];
            $pass_word2 = $_POST["password2"];

            if (!$user_name2|| !$pass_word2)
            {
                echo '<script> if (confirm("Vui lòng nhập đầy đủ thông tin.")) {history.go(-1);} else {location.replace("index.php")}</script>';
                exit;
            }

            if (mysqli_num_rows(mysqli_query($connect,"select username from users where username = '$user_name2'")) > 0)
            {
                echo '<script> if (confirm("Tên đăng nhập này đã có người dùng. Vui lòng chọn tên đăng nhập khác")) {history.go(-1);} else {location.replace("index.php")}</script>';
                exit;
            }
            /*if (!preg_match("/^[a-zA-Z ]+$/",$user_name2))
            {
                echo '<script> if (confirm("Tên đăng nhập chứa kí tự đặc biệt. Vui lòng chọn tên hợp lệ")) {history.go(-1);} else {location.replace("index.php")}</script>';
               exit;
            }*/
            $addmember = mysqli_query($connect,"insert into users(username, password) values('$user_name2','$pass_word2')");
            if ($addmember)
                echo '<script> alert("Quá trình đăng ký thành công."); location.replace("index.php");</script>';
            else
                echo '<script> if (confirm("Có lỗi xảy ra trong quá trình đăng ký.")) {history.go(-1);} else {location.replace("index.php")}</script>';
        }

        if (isset($_POST['signin']))
        {
            $user_name1 = $_POST['username1'];
            $pass_word1 = $_POST['password1'];

            if (!$user_name1 || !$pass_word1) {
                echo '<script> if (confirm("Vui lòng nhập đầy đủ tên và mật khẩu.")) {history.go(-1);} else {location.replace("home.php")}</script>';
                exit;
            }

            /*if (!preg_match("/^[a-zA-Z ]+$/",$user_name1))
            {
                echo '<script> if (confirm("Tên đăng nhập chứa kí tự đặc biệt. Vui lòng chọn tên hợp lệ")) {history.go(-1);} else {location.replace("home.php")}</script>';
                exit;
            }*/

            if (mysqli_num_rows(mysqli_query($connect, "select username from users where username = '$user_name1'")) == 0) {
                echo '<script> if (confirm("Tên đăng nhập không tồn tại. Vui lòng kiểm tra lại.")) {history.go(-1);} else {location.replace("home.php")}</script>';
                exit;
            }

            if (mysqli_num_rows(mysqli_query($connect, "select username,password from users where password = '$pass_word1' and username = '$user_name1'")) == 0) {
                echo '<script> if (confirm("Mật khẩu không đúng. Vui lòng nhập lại.")) {history.go(-1);} else {location.replace("home.php")}</script>';
                exit;
            }
            $_SESSION['username1'] = $user_name1;
            header("Location: home.php");
        }
    ?>
  <p></p>
  <form method="post" autocomplete="off" action="#">
    <div class="cont">
      <div class="form sign-in">
        <h2>Welcome back,</h2>
        <label>
          <span>Username</span>
          <input type="text" name="username1">
        </label>
        <label>
          <span>Password</span>
          <input type="password" name="password1">
        </label>
        <button type="submit" class="submit" name="signin" value="Sign In">Sign In</button>
      </div>

      <div class="sub-cont">
        <div class="img">
          <div class="img__text m--up">
            <h2>New here?</h2>
            <p>Sign up and discover great amount of new opportunities!</p>
          </div>
          <div class="img__text m--in">
            <h2>One of us?</h2>
            <p>If you already have an account, just sign in. We've missed you!</p>
          </div>
          <div class="img__btn">
            <span class="m--up">Sign Up</span>
            <span class="m--in">Sign In</span>
          </div>
        </div>
        <form method="post" autocomplete="off" action="#">
          <div class="form sign-up">
            <h2>Time to feel like home,</h2>
            <label>
              <span>Username</span>
              <input type="text" name="username2">
            </label>
            <label>
              <span>Password</span>
              <input type="password" name="password2">
            </label>
            <button type="submit" class="submit" name="signup" value="Sign Up">Sign Up</button>
          </div>
        </form>
      </div>
    </div>
  </form>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

<script src="Sign%20in.js"></script>
</html>