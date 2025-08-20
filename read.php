<?php
include 'connect.php'; 
if (isset($_GET['reset_ids']) && $_GET['reset_ids'] == 'true') {
    $resetAutoIncrement = "ALTER TABLE donertable1 AUTO_INCREMENT = 1";
    if (mysqli_query($con, $resetAutoIncrement)) {
        echo "AUTO_INCREMENT has been reset successfully.<br>";
    } else {
        echo "Error resetting AUTO_INCREMENT: " . mysqli_error($con) . "<br>";
    }
    $reorderIDs = "SET @counter = 0; UPDATE donertable1 SET id = @counter := (@counter + 1)";
    if (mysqli_query($con, $reorderIDs)) {
        echo "IDs have been reordered successfully.<br>";
    } else {
        echo "Error reordering IDs: " . mysqli_error($con) . "<br>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Blood Supplier Management</title>
  <link rel="stylesheet" href="rs.css"> 
</head>
<body>
  <div id="main">
    <table>
      <thead>
        <tr>
          <th>S.No</th>
          <th>Name</th>
          <th>Blood Group</th>
          <th>Quantity</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $sql = "SELECT * FROM `donertable1`";
        $result = mysqli_query($con, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $id = $row['id'];
            $hname = $row['hname'];
            $bgroup = $row['bgroup'];
            $bags = $row['bags'];
            echo '
              <tr>
                <td>' . $id . '</td>
                <td>' . htmlspecialchars($hname) . '</td>
                <td>' . htmlspecialchars($bgroup) . '</td>
                <td>' . htmlspecialchars($bags) . '</td>
                <td>
                  <a href="update.php?updateid=' . $id . '" class="update-btn">Update</a>
                  <a href="delete.php?deleteid=' . $id . '" class="delete-btn" onclick="return confirm(\'Are you sure you want to delete this record?\')">Delete</a>
                </td>
              </tr>';
        }
        ?>
      </tbody>
    </table>
  </div>
</body>
</html>
