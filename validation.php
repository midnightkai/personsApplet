<?php 
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
}

require '../database/database.php';
$pdo = Database::connect();

if ($_SESSION['username'] == 'admin@admin.com') {
				    $role = $_POST['role'];
				}
$fn = $_POST['fname'];
$ln = $_POST['lname'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$password = $_POST['password'];
$address = $_POST['address'];
$address2 = $_POST['address2'];
$city = $_POST['city'];
$state = $_POST['state'];
$zip_code = $_POST['zip_code'];
    
    function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
    
    if (empty($_POST["fname"])){
	    $fnameErr="First name is required";
  } else {
    $fname = test_input($_POST["fname"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z-' ]*$/",$fname)) {
      $fnameErr = "Only letters and white space allowed";
    }
  }
    if (empty($_POST["lname"])) {
    $lnameErr = "Last name is required";
  } else {
    $lname = test_input($_POST["lname"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z-' ]*$/",$lname)) {
      $lnameErr = "Only letters and white space allowed";
    }
  }
    if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } else {
    $email = test_input($_POST["email"]);
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format";
    }
  }
    if (empty($_POST["phone"])) {
    $phoneErr = "Phone number  is required";
  } else {
    if (!preg_match('/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/', $phone)) {
        $phoneErr = "Invalid format";
  }
  }
    if(!empty($_POST["password"]) && ($_POST["password"] == $_POST["password_confirm"])) {
    $password = test_input($_POST["password"]);
    $password_confirm = test_input($_POST["password_confirm"]);
    if (strlen($_POST["password"]) <= 16) {
        $passwordErr = "Password must be at least 16 characters";
    }
    elseif(!preg_match("#[0-9]+#",$password)) {
        $passwordErr = "Password must have at least 1 number";
    }
    elseif(!preg_match("#[A-Z]+#",$password)) {
        $passwordErr = "Password must have at least 1 uppercase letter";
    }
    elseif(!preg_match("#[a-z]+#",$password)) {
        $passwordErr = "Password must have at least 1 lowercase letter";
    }
    elseif(!preg_match('[@_!#$%^&*()<>?/|}{~:]',$password)) {
        $passwordErr = "Password must have at least 1 special character";
    }
    elseif(!empty($_POST["password"])) {
    $confirmErr = "Passwords do not match";
    } else {
      $passwordErr = "Password is required";
    }
    }
    if (empty($_POST["address"])) 
        $addressErr="Required";
    if (empty($_POST["city"])) 
        $cityErr="Required";
    if (empty($_POST["state"])) 
        $stateErr="Required";
    if (empty($_POST["zip_code"])){ 
        $zipErr="Required";
    } else {
    if (!preg_match('[0-9]', $zip_code)) {
        $zipErr = "Only numbers allowed";
  }
  }
    
        if ($fnameErr || $lnameErr || $emailErr || $phoneErr || $passwordErr || $cofnirmErr || $addressErr || $cityErr || $stateErr || $zipErr){
	header("Location: register.php?"
	. "fname=$fname"
	. "&" . "lname=$lname"
	. "&" . "email=$email"
	. "&" . "phone=$phone"
	. "&" . "password=$password"
	. "&" . "password_confirm=$password_confrim"
	. "&" . "address=$address"
	. "&" . "city=$city"
	. "&" . "state=$state"
	. "&" . "zip_code=$zip_code"
    . "&" . "fnameErr=$fnameErr"
	. "&" . "lnameErr=$lnameErr"
	. "&" . "emailErr=$emailErr"
	. "&" . "phoneErr=$phoneErr"
	. "&" . "passwordErr=$passwordErr"
	. "&" .	"confirmErr=$confirmErr"
	. "&" . "addressErr=$addressErr"
	. "&" . "cityErr=$cityErr"
	. "&" . "stateErr=$stateErr"
	. "&" . "zipErr=$zipErr"
	
	);}
	else {
	    header("Location: create.php?");
	}