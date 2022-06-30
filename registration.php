<?php
require 'function.php';

if(!empty($_SESSION["id"])){
  header("Location: index.php");
}

$register = new Register();

if(isset($_POST["submit"])){
  $result = $register->registration($_POST["name"], $_POST["username"], $_POST["email"], $_POST["password"], $_POST["confirmpassword"]);

  if($result == 1){
    echo
    "<script> alert('Registration Successful'); </script>";
  }
  elseif($result == 10){
    echo
    "<script> alert('Username or Email Has Already Taken'); </script>";
  }
  elseif($result == 100){
    echo
    "<script> alert('Password Does Not Match'); </script>";
  }
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
</head>

<body>
    <div class="container ">
        <div class="row">
            <div class="col-md-5 mx-auto" style="margin-top: 100px;  ">
                <h2 style="text-align:center;">Registration</h2>
                <form class="" action="" method="post" autocomplete="off" class="row g-3">
                    <div class="form-group">
                        <label for="" class="form-label">Name : </label>
                        <input type="text" name="name" required value="" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="" class="form-label">Username : </label>
                        <input type="text" name="username" required value="" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="" class="form-label">Email : </label>
                        <input type="email" name="email" required value="" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="" class="form-label">Password : </label>
                        <input type="password" name="password" required value="" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="" class="form-label">Confirm Password : </label>
                        <input type="password" name="confirmpassword" required value="" class="form-control">
                    </div>

                    <button type="submit" name="submit" class="btn btn-success" style="margin: 10px 0;">Register</button>

                </form>
                <a href="login.php" class="btn btn-primary" >Login</a>
            </div>
        </div>
    </div>
</body>

</html>