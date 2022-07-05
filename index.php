<?php
require 'function.php';

$select = new Select();

if(!empty($_SESSION["id"])){
  $user = $select->selectUserById($_SESSION["id"]);
  $data = $select->selectUser();
  $totaluser= $select->userCount();
  // print_r($totaluser);
}
else{
  header("Location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>Index Of User</title>

    <!-- jquary -->

    <script src="https://code.jquery.com/jquery-3.6.0.js"
        integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-1.11.1.js"
        integrity="sha256-MCmDSoIMecFUw3f1LicZ/D/yonYAoHrgiep/3pCH9rw=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- The DataTables CDN -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js">
    </script>
</head>

<body>
    <div class="colum">
        <div class="col-md-5 mx-auto" style="margin-top: 50px; position: relative;  ">
            <h1 style="text-align:center;">Welcome <?php echo $user["name"]; ?></h1>
            <a href="logout.php" class="btn btn-primary">Logout</a>
            <button type="submit" class="btn btn-success float-right"
                style="position: absolute; right: 0; margin-right: 10px;" data-toggle="modal" data-target="#mymodal"
                id="adduserbtn">ADD NEW USER</button>

        </div>
        <div class="col-md-5 mx-auto" style="margin-top: 30px;">

            <table class="table" id="tablerecode">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">NAME</th>
                        <th scope="col">USERNAME</th>
                        <th scope="col">EMAIL</th>
                        <th scope="col">VIEW</th>
                        <th scope="col">DELETE</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $count = 0;
                while($rows = mysqli_fetch_assoc($data)){
                        $count++;
                ?>
                    <tr>
                        <td scope="row"><?php echo $count;?></td>
                        <td><?php echo $rows['name'];?></td>
                        <td><?php echo $rows['username'];?></td>
                        <td><?php echo $rows['email'];?></td>
                        <td><button type="submit" class="btn btn-success edit-btn" data-toggle="modal"
                                data-target="#mymodal1" data-eid="<?php echo $rows['id'];?>">EDIT</button></td>
                        <td><button type="submit" class="btn btn-danger"
                                onclick="deleteuser(<?php echo $rows['id'];?>)">DELETE</button></td>
                    </tr>
                    <?php } ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="2"><?php echo "Total : " .$totaluser." registered user";?></td>
                        
                    </tr>
                </tfoot>
            </table>
        </div>
        <!-- popup form  Modal-->
        <!-- add usser  -->
        <div class="modal fade" id="mymodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">ADD NEW USER</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p class="statusMsg"></p>
                        <form autocomplete="off" id="addForm">
                            <div class="form-group">
                                <label for="" class="form-label">Name : </label>
                                <input type="text" name="name" required value="" class="form-control name">
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

                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success" style="margin: 10px 0;"
                            onclick="addUser()">Register</button>
                        <button type="button" class="btn btn-secondary submitBtn" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- update user form -->
        <div class="modal fade" id="mymodal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">EDIT USER RECODE</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p class="statusMsg"></p>
                        <form autocomplete="off" id="editForm">


                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success edit-submit" id="edit-submit"
                            style="margin: 10px 0;">UPDATE</button>
                        <button type="button" class="btn btn-secondary submitBtn" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
    </div>

    <script>
    $(document).ready(function() {
        $('#tablerecode').DataTable();
    });

    function addUser() {
        $reg = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
        $name = $("[name ='name']").val();
        $username = $("[name ='username']").val();
        $email = $("[name ='email']").val();
        $password = $("[name ='password']").val();
        $confirmpassword = $("[name ='confirmpassword']").val();
        // console.log($password);
        // console.log($confirmpassword);
        if ($name.trim() == '') {
            alert('Please enter your name.');
            $('.name').focus();
            return false;
        } else if ($username.trim() == '') {
            alert('Please enter your username.');
            // $('#inputEmail').focus();
            return false;
        } else if ($email.trim() == '') {
            alert('Please enter your email.');
            // $('#inputEmail').focus();
            return false;
        } else if ($email.trim() != '' && !$reg.test($email)) {
            alert('Please enter valid email.');
            $('#inputEmail').focus();
            return false;
        } else if ($password != $confirmpassword) {
            alert('password does not mech.');
            // $('#inputMessage').focus();
            return false;
        } else {

            $.ajax({
                url: 'crud.php',
                type: 'POST',
                data: {
                    name: $name,
                    username: $username,
                    email: $email,
                    password: $password
                },
                success: function(msg) {
                    // console.log(msg);
                    if (msg == "1") {

                        // $("#mymodal").hide();
                        $("#mymodal").modal('hide');
                        $("#addForm").trigger("reset");
                        $('.statusMsg').html(
                            '<span style="color:green;">USER RECODE ARE INSERTED.</p>'
                        );
                    } else {
                        $('.statusMsg').html(
                            '<span style="color:red;">USER RECODE ARE NOT INSERTED.</span>');
                    }
                    $('.statusMsg').html(" ");

                }
            });
        }
        return false;
    }

    function deleteuser($id) {
        $.ajax({
            url: 'crud.php',
            type: 'POST',
            data: {
                userid: $id
            },
            success: function(msg) {
                // console.log(msg);
                if (msg == "1") {
                    alert('user recode delated.');
                } else {

                }
            }
        });

    }
    $(document).on("click", ".edit-btn", function() {
        // alert("button cllieked");
        $('.statusMsg').html(" ");
        var id = $(this).data("eid");
        // alert(id);

        $.ajax({
            url: 'crud.php',
            type: 'POST',
            data: {
                id: id
            },
            success: function(data) {
                $('#editForm').html(data);
                // console.log(msg);
                // if (msg == "1") {
                //     $("#addForm").trigger("reset");
                //     $('.statusMsg').html(
                //         '<span style="color:green;">USER RECODE ARE INSERTED.</p>'
                //         );
                // } else {
                //     $('.statusMsg').html(
                //         '<span style="color:red;">USER RECODE ARE NOT INSERTED.</span>');
                // }
            }
        });

    });
    $(document).on("click", ".edit-submit", function() {

        $id = $('#edit-id').val();
        $name = $('#edit-name').val();
        $username = $("#edit-username").val();
        $email = $("#edit-email").val();
        $password = $("#edit-password").val();
        $confirmpassword = $("#edit-password").val();
        $.ajax({
            url: 'ajax_update.php',
            type: 'POST',
            data: {
                id: $id,
                name: $name,
                username: $username,
                email: $email,
                password: $password
            },
            success: function(msg) {
                $("#mymodal1").modal('hide');
                console.log(msg);
                if (msg == "1") {
                    $('.statusMsg').html(
                        '<span style="color:green;">USER RECODE ARE UPDATED.</p>'
                    );
                } else {
                    $('.statusMsg').html(
                        '<span style="color:red;">USER RECODE ARE NOT UPDATED.</span>');
                }
            }
        });
    });
    </script>
</body>

</html>