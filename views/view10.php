<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View 10</title>
    <style>
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
    </style>
</head>
<body>

<?php

require_once '../db/dbh.inc.php';

$sql = "SELECT u.UserID, u.Username, u.FirstName, u.LastName, u.Address, ur.RoleName 
        FROM final.users u
        INNER JOIN final.userroles ur ON ur.RoleID = u.UserRoleID;";

$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../view10.php?error=stmtFailed");
    exit();
}
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if ($result->num_rows > 0) {
    echo "<h2>User Information</h2>";
    echo "<table>
    <tr>
    <th>User ID</th>
    <th>Username</th>
    <th>First Name</th>
    <th>Last Name</th>
    <th>Address</th>
    <th>Role</th>
    </tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr>
        <td>".$row["UserID"]."</td>
        <td>".$row["Username"]."</td>
        <td>".$row["FirstName"]."</td>
        <td>".$row["LastName"]."</td>
        <td>".$row["Address"]."</td>
        <td>".$row["RoleName"]."</td>
        </tr>";
    }
    echo "</table>";
} else {
    echo "0 results found";
}

$conn->close();
?>

</body>
</html>
