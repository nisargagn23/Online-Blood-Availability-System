<?php
include 'connect.php';
$id = $_GET['deleteid'];

$sql = "DELETE FROM `donertable1` WHERE id=?";
$stmt = $con->prepare($sql);

$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    // Redirect to the read page if the deletion was successful
    header('Location: read.php');
    exit();
} else {
    // Display an error if the deletion failed
    die("Error: " . $stmt->error);
}

$stmt->close();
$con->close();
?>
