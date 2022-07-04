<?php
include 'function.php';

    $crud = new crud();
    $id = $_POST['id'];
      $name = $_POST['name'];
      $username = $_POST['username'];
      $email = $_POST['email'];
      $password = $_POST['password'];

      $condition = array( 'id' => $id);
    $data = array( 'name' => $name,
                    'id' => $id,
                    'username' => $username,
                    'email' => $email,
                    'password' => $password );
    
      $crud->update_data('tb_user', $data, $condition);
    
 
?>