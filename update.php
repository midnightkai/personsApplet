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

$id = $_GET['id'];


$sql = "UPDATE persons SET fname='$fn', lname='$ln', email='$email', phone='$phone', password_salt='$pass_salt' pasword_hash='$pass_hash', address='$address', address2='$address2', city='$city', state='$state', zip_code='$zip_code' WHERE id=$id";


$pdo->query($sql);
echo "<p>Your info has been added</p><br>";
echo "<a href='list.php'>Back to list</a>";