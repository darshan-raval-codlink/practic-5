<?php
session_start();

class Connection{
  public $host = "localhost";
  public $user = "root";
  public $password = "";
  public $db_name = "oop_reglog";
  public $conn;

  public function __construct(){
    $this->conn = mysqli_connect($this->host, $this->user, $this->password, $this->db_name);
  }
}

class Register extends Connection{
  public function registration($name, $username, $email, $password, $confirmpassword){
    $duplicate = mysqli_query($this->conn, "SELECT * FROM tb_user WHERE username = '$username' OR email = '$email'");
    if(mysqli_num_rows($duplicate) > 0){
      return 10;
      // Username or email has already taken
    }
    else{
      if($password == $confirmpassword){
        $query = "INSERT INTO tb_user VALUES('', '$name', '$username', '$email', '$password')";
        mysqli_query($this->conn, $query);
        return 1;
        // Registration successful
      }
      else{
        return 100;
        // Password does not match
      }
    }
  }
}

class Login extends Connection{
  public $id;
  public function login($usernameemail, $password){
    $result = mysqli_query($this->conn, "SELECT * FROM tb_user WHERE username = '$usernameemail' OR email = '$usernameemail'");
    $row = mysqli_fetch_assoc($result);

    if(mysqli_num_rows($result) > 0){
      if($password == $row["password"]){
        $this->id = $row["id"];
        return 1;
        // Login successful
      }
      else{
        return 10;
        // Wrong password
      }
    }
    else{
      return 100;
      // User not registered
    }
  }

  public function idUser(){
    return $this->id;
  }
}

class Select extends Connection{
  public function selectUserById($id){
    $result = mysqli_query($this->conn, "SELECT * FROM tb_user WHERE id = $id");
    return mysqli_fetch_assoc($result);
  }
  public function selectUser(){
    // $result1 = mysqli_query($this->conn, "SELECT * FROM tb_user");
    return mysqli_query($this->conn, "SELECT * FROM tb_user");
  }
  function userCount (){
    $sql = "SELECT COUNT(id) FROM tb_user";
    $result = mysqli_query($this->conn,$sql);
    $rows = mysqli_fetch_row($result);
    return $rows[0];
  }
}
class crud extends Connection{
  public function insert_data($data, $tbl)
	{
		$field = array_keys($data);
		$fields = implode(", ", $field);
		$value = array_values($data);
		$values = "'" . implode("', '", $value) . "'";
		$ins = "INSERT INTO $tbl ($fields) Values ($values)";
    $query = mysqli_query($this->conn, $ins);
		// $query = $this->db->query($ins) or die("query failed");
		if ($query) {
			echo 1;
		}else {
      echo 0;
    }
	}
  public function delete_data($tbl, $condition)
	{

		$field = array_keys($condition);
		$fields = implode($field);
		$value = array_values($condition);
		$values = implode($value);
		$del = "DELETE FROM $tbl WHERE $fields='$values'";
    $query = mysqli_query($this->conn, $del);

		// $query = $this->db->query($del) or die("query failed");
		if ($query) {
			echo "1";
		}else{
      echo "0";
    }
	}
  public function update_data($tbl, $set, $condition)
	{
		$field = array_keys($condition);
		$fields = implode($field);
		$value = array_values($condition);
		$values = implode($value);
		$string = implode(', ', array_map(function ($v, $k) {
			return sprintf("%s='%s'", $k, $v);
		}, $set, array_keys($set)));
		$upd = "UPDATE $tbl SET $string WHERE $fields='$values' ";
		$this->db->query($upd) or die("query not run");
	}
}

?>