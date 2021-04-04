<?php

require '../database/database.php';
$pdo = Database::connect();

$role = $_POST['role'];
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$password = $_POST['password'];
$password_hash = $_POST['password_hash'];
$password_salt = $_POST['password_salt'];
$address = $_POST['address'];
$address2 = $_POST['address2'];
$city = $_POST['city'];
$state = $_POST['state'];
$zip_code = $_POST['zip_code'];

$fname = htmlspecialchars($role);
$fname = htmlspecialchars($fname);
$lname = htmlspecialchars($lname);
$email = htmlspecialchars($email);
$phone = htmlspecialchars($phone);
$password = htmlspecialchars($password);
$address = htmlspecialchars($address);
$address2 = htmlspecialchars($address2);
$city = htmlspecialchars($city);
$state = htmlspecialchars($state);
$zip_code = htmlspecialchars($zip_code);

$password_salt = MD5(microtime()); 
$password_hash = MD5($password + $password_salt);


$sql = "SELECT id FROM person WHERE email=?";
$query=$pdo->prepare($sql);
$query->execute(Array($email));
$result = $query->fetch(PDO::FETCH_ASSOC);

if($result) { 
	echo "<p>This email ($email) is already registered.</p><br>";
    echo "<a href='register.php'>Back to REGISTER</a>";
}
else {
	if ($role != "User" || $role != "Admin"){
	    echo "<p>This email ($email) is already registered.</p><br>";
        echo "<a href='register.php'>Back to REGISTER</a>";
	}
	
	$sql = "INSERT INTO person (role, fname, lname, email, phone, password_hash, password_salt, address, address2, city, state, zip_code) VALUES (?, ?, ?)";

	$query=$pdo->prepare($sql);
	$query->execute(Array($role, $fname, $lname, $email, $phone, $password_hash, $password_salt, $address, $address2, $city, $state, $zip_code));

	$pdo->query($sql);
	echo "<p>Your info has been added. You can now log in.</p><br>";
	echo "<a href='login.php'>Back to LOGIN</a>"; 
	
}

