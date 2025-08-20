<?php
include 'connect.php';

if (isset($_POST['submit'])) {
    $hname = htmlspecialchars(trim($_POST['hname']));
    $bgroup = $_POST['blood'];
    $npack = intval($_POST['bag']);

    if (!empty($hname) && !empty($bgroup) && $npack > 0) {
        $checkExistenceQuery = "SELECT * FROM `donertable1` WHERE hname = ? AND bgroup = ?";
        $stmt = $con->prepare($checkExistenceQuery);
        $stmt->bind_param("ss", $hname, $bgroup);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $newQuantity = $row['bags'] + $npack;

            $updateQuery = "UPDATE `donertable1` SET bags = ? WHERE hname = ? AND bgroup = ?";
            $updateStmt = $con->prepare($updateQuery);
            $updateStmt->bind_param("iss", $newQuantity, $hname, $bgroup);

            if ($updateStmt->execute()) {
                header('Location: read.php');
                exit();
            } else {
                die("Error: " . $updateStmt->error);
            }
            $updateStmt->close();
        } else {
            $sql = "INSERT INTO `donertable1` (hname, bgroup, bags) VALUES (?, ?, ?)";
            $stmt = $con->prepare($sql);
            $stmt->bind_param("ssi", $hname, $bgroup, $npack);

            if ($stmt->execute()) {
                header('Location: read.php');
                exit();
            } else {
                die("Error: " . $stmt->error);
            }
            $stmt->close();
        }
        $stmt->close();
    } else {
        echo "Please fill all fields correctly.";
    }
    $con->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blood Supplier Management</title>
    <link rel="stylesheet" href="ds.css">
</head>
<body>
    <header>
        <h1>Blood Bank Management</h1>
    </header>
    <div class="container">
        <form method="post">
            <h2>Hospital Updates</h2>
            <label>Name:</label>
            <input type="text" name="hname" required><br/>
            <label for="bloodGroup">Blood Group:</label>
            <select name="blood" required>
                <option value="" disabled selected>--Select Blood Group--</option>
                <option value="A+">A+</option>
                <option value="A-">A-</option>
                <option value="B+">B+</option>
                <option value="B-">B-</option>
                <option value="AB+">AB+</option>
                <option value="AB-">AB-</option>
                <option value="O+">O+</option>
                <option value="O-">O-</option>
            </select><br/>
            <label>Number of bags:</label>
            <input type="number" name="bag" min="1" required><br/>
            <button type="submit" name="submit">Submit</button>
        </form>
    </div>
</body>
</html>
