<?php
include 'connect.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blood Supplier Management</title>
    <link rel="stylesheet" href="searchstyle.css">
  
</head>
<body> 
    <header>
        <h1>Online Blood Availability System</h1>
    </header>
    <div class="container">
        <div class="form">
            <form method="post">
                <h2>search for Blood</h2>           
                <label for="bloodGroup">Blood Group:</label>
                <select name="search">
                    <option value="A+">A+</option>
                    <option value="A-">A-</option>
                    <option value="B+">B+</option>
                    <option value="B-">B-</option>
                    <option value="AB+">AB+</option>
                    <option value="AB-">AB-</option>
                    <option value="O+">O+</option>
                    <option value="O-">O-</option>
                </select>
                <label>Quantity</label>
                <input type="number" name="bag">
                <button type="submit" name="submit" >Submit</button>
            </form>
        </div>
        <div class="list">
            <table class="table">
            <?php
                    if (isset($_POST['submit'])) {
                        $search = $_POST['search'];
                        $bags = filter_var($_POST['bag'], FILTER_VALIDATE_INT);
                        if (!$bags || $bags <= 0) {
                            echo '<h2>Please enter a valid quantity.</h2>';
                        } else {
                            $stmt = $con->prepare("SELECT * FROM `donertable1` WHERE bgroup = ?");
                            $stmt->bind_param("s", $search);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            if ($result && $result->num_rows > 0) {
                                echo '<thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Blood Group</th>
                                            <th>Quantity</th>
                                        </tr>
                                    </thead>';
                                while ($row = $result->fetch_assoc()) {
                                    echo '<tbody>
                                            <tr>
                                                <td><a href="searchhname.php">' . htmlspecialchars($row['hname']) . '</a></td>
                                                <td>' . htmlspecialchars($row['bgroup']) . '</td>
                                                <td>' . htmlspecialchars($row['bags']) . '</td>
                                            </tr>
                                        </tbody>';
                                }
                            } else {
                                echo '<h2>Data not found</h2>';
                            }
                        }
                    }
                    ?>
                </table>
        </div>
    </div> 
</body>
</html>
