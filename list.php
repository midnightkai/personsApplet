<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
}
echo"<h1>Persons List</h1>";
require '../database/database.php';
$pdo = Database::connect();

if ($_SESSION['username'] == 'admin@admin.com') {
				    echo "<a href='register.php'>Create</a>";
				}

echo " <a style='color: green;' href='logout.php'>Logout</a><br><br>";

$sql = 'SELECT * FROM persons';
foreach ($pdo->query($sql) as $row) {
    if ($_SESSION['username'] == 'admin@admin.com') {
	$str = "";
	$str .= "<a href='read.php?id=" . $row['id'] . "'>Read</a> ";
	$str .= "<a href='update.php?id=" . $row['id'] . "'>Update</a> ";
	$str .= "<a href='delete.php?id=" . $row['id'] . "'>Delete</a> ";
    }
    else{
        $userID = $_SESSION['id'];
    $str .= "<a href='update.php?id=" . $row[$userID] . "'>Update</a> ";
    }
	$str .= ' (' . $row['id'] . ') ' . "Role: " . $row['role'] . " | First Name: " . $row['fname'] . " | Last Name: " . $row['lname'];
    $str .=  '<br>';
	echo $str;
}
echo '<br />';
