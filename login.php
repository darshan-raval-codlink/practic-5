<?php
require 'function.php';

if(!empty($_SESSION["id"])){
  header("Location: index.php");
}

$login = new Login();

if(isset($_POST["submit"])){
  $result = $login->login($_POST["usernameemail"], $_POST["password"]);

  if($result == 1){
    $_SESSION["login"] = true;
    $_SESSION["id"] = $login->idUser();
    header("Location: index.php");
  }
  elseif($result == 10){
    echo
    "<script> alert('Wrong Password'); </script>";
  }
  elseif($result == 100){
    echo
    "<script> alert('User Not Registered'); </script>";
  }
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

</head>

<body>
    <div class="container " >
        <div class="row">
            <div class="col-md-5 mx-auto" style="margin-top: 100px;  ">
                <form class="" action="" method="post" autocomplete="off" class="row g-3">
                <h1 style="text-align:center;">Login</h1>
                <div class="form-group">
                    <label for="" class="form-label">Username or Email : </label>
                    <input type="text" name="usernameemail" required value="" class="form-control"> <br>
                  </div>
                  <div class="form-group">
                    <label for="" class="form-label">Password</label>
                    <input type="password" name="password" required value="" class="form-control"> <br>
                    </div>
                    <button type="submit" class="btn btn-success" name="submit">Login</button>
                </form>
                <br>
                <a href="registration.php" class="btn btn-primary">Registration</a>
            </div>
        </div>
    </div>
</body>

</html>