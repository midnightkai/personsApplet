<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
}

require '../database/database.php';
$pdo = Database::connect();

$fname = $_POST['fname'];
$lname = $_POST['lname'];

$choice = "";

function delete() {
  $id = $_GET['id'];

$sql = "DELETE FROM persons WHERE id=$id";

$pdo->query($sql);
$choice = "<p>Your info has been removed</p><br>";
$choice += "<a href='list.php'>Back to list</a>";
}

function cancel(){
    $choice = "<p>Deletion canceled</p><br>";
    $choice += "<a href='list.php'>Back to LIST</a>";
}

?>

<html>
    <h2> Do you want to delete <?php echo $_GET["fname"]?> <?php echo $_GET["lname"]?></h2>
    <button onclick="delete()">Yes</button>
    <button onclick="cancel()">No</button></br>
    <span><?php echo $_GET["choice"];?></span>
</hmtl>

<script>

</script>
