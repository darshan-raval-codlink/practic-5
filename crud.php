<?php
include 'function.php';
if(isset($_POST['name'])){
$crud = new crud();
  $name = $_POST['name'];
  $username = $_POST['username'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $name = $_POST['name'];

$data = array( 'name' => $name,
                'username' => $username,
                'email' => $email,
                'password' => $password );

  $crud->insert_data($data, 'tb_user');
}
if(isset($_POST['userid'])){
    $crud = new crud();
    $id = $_POST['userid'];
    $condition = array( 'id' => $id);
    $crud->delete_data('tb_user' ,$condition);


}
if(isset($_POST['id'])){
    $crud = new crud();
    $select = new Select();
    $id = $_POST['id'];
    $result = $select->selectUserById($id);
    // print_r($result);
    $output="";
    if(!$result == ""){
        // while($row = mysqli_fetch_assoc($result)){
        $output .= "<div class='form-group'>
        <label for='' class='form-label'>Name : </label>
        <input type='text' name='name' required  id='edit-name'class='form-control name' value='{$result['name']}'>
        <input type='text' name='id' hidden  id='edit-id' class='form-control ' value='{$result['id']}'>
    </div>
    <div class='form-group'>
        <label for='' class='form-label'>Username : </label>
        <input type='text' name='username' required  id='edit-username'class='form-control' value='{$result['username']}'>
    </div>
    <div class='form-group'>
        <label for='' class='form-label'>Email : </label>
        <input type='email' name='email' required  id='edit-email'class='form-control' value='{$result['email']}'>
    </div>
    <div class='form-group'>
        <label for='' class='form-label'>Password : </label>
        <input type='password' name='password' required  id='edit-password'class='form-control' value='{$result['password']}'>
    </div>
    <div class='form-group'>
        <label for='' class='form-label'>Confirm Password : </label>
        <input type='password' name='confirmpassword' required id='edit-password' class='form-control' value='{$result['password']}'>
    </div>";
        // }
        echo $output;  
    }
//    $data = $Select->selectUserById($id);
//    print_r($data);
    // return $data;

}
 ?>