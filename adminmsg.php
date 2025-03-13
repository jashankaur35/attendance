<?php
session_start();
include("config.php");

if (!isset($_SESSION['id'])) {
    header("Location: {$hostname}/login.php");
}

if (!isset($_GET['msg']) || empty($_GET['msg'])) {
    die("Message is empty");
}

$msg = mysqli_real_escape_string($con, $_GET['msg']);
$id = $_SESSION['id'];

$q = "INSERT INTO message (id, msg, date) VALUES ($id, '$msg', NOW())";
if (mysqli_query($con, $q)) {
    echo "Message saved";
} else {
    echo "Error: " . mysqli_error($con);
}
?>
