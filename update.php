<?php
include 'connect.php';

$id = $_GET['updateid'];
$sql = "SELECT * FROM `donertable1` WHERE id=?";
$stmt = $con->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

$hname = $row['hname'];
$bgroup = $row['bgroup'];
$bags = $row['bags'];

if (isset($_POST['update'])) {
    $hname = $_POST['hname'];
    $bgroup = $_POST['blood'];
    $bags = $_POST['bags'];

    $sql = "UPDATE `donertable1` SET hname=?, bgroup=?, bags=? WHERE id=?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("ssii", $hname, $bgroup, $bags, $id);

    if ($stmt->execute()) {
        header('location:read.php');
    } else {
        die("Error: " . $stmt->error);
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update</title>
    
</head>
<body>
    <div class="container">
        <form method="post">
            <h2>Update Record</h2>
            <label>Name:</label>
            <input type="text" name="hname" value="<?php echo htmlspecialchars($hname); ?>" required>

            <label for="bloodGroup">Blood Group:</label>
            <select name="blood" required>
                <option value="A+" <?php echo ($bgroup == 'A+') ? 'selected' : ''; ?>>A+</option>
                <option value="A-" <?php echo ($bgroup == 'A-') ? 'selected' : ''; ?>>A-</option>
                <option value="B+" <?php echo ($bgroup == 'B+') ? 'selected' : ''; ?>>B+</option>
                <option value="B-" <?php echo ($bgroup == 'B-') ? 'selected' : ''; ?>>B-</option>
                <option value="AB+" <?php echo ($bgroup == 'AB+') ? 'selected' : ''; ?>>AB+</option>
                <option value="AB-" <?php echo ($bgroup == 'AB-') ? 'selected' : ''; ?>>AB-</option>
                <option value="O+" <?php echo ($bgroup == 'O+') ? 'selected' : ''; ?>>O+</option>
                <option value="O-" <?php echo ($bgroup == 'O-') ? 'selected' : ''; ?>>O-</option>
            </select>

            <label>Number of Bags:</label>
            <input type="number" name="bags" value="<?php echo htmlspecialchars($bags); ?>" required>

            <button type="submit" name="update">Update</button>
        </form>
    </div>
</body>
</html>
