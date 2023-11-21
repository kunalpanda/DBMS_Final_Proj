<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View 2</title>
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

<h2>Contractor Details</h2>

<?php
// Check connection

require_once '../db/dbh.inc.php';


// Assuming the connection is already established above.

$sql2 = "SELECT u.UserID, u.Username, u.Password, u.FirstName, u.LastName, sm.SkillName
         FROM final.users u
         LEFT JOIN final.skillmap sm ON u.UserID = sm.UserID
         WHERE u.UserRoleID=ALL
         (SELECT cp.RoleID FROM final.contractorprofile cp)
         GROUP BY u.UserID, sm.SkillName;";

$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sql2)) {
    header("location: ../view2.php?error=stmtFailed");
}
mysqli_stmt_execute($stmt);
$result2 = mysqli_stmt_get_result($stmt);


if ($result2->num_rows > 0) {

    echo "<table table class='table table-striped'>
    <thead>
    <tr>
    <th>User ID</th>
    <th>Username</th>
    <th>Password</th>
    <th>First Name</th>
    <th>Last Name</th>
    <th>Skill Name</th>
    </tr>
    </thead>";
    // output data of each row
    while($row = $result2->fetch_assoc()) {
        echo "<tr>
        <td>".$row["UserID"]."</td>
        <td>".$row["Username"]."</td>
        <td>".$row["Password"]."</td>
        <td>".$row["FirstName"]."</td>
        <td>".$row["LastName"]."</td>
        <td>".$row["SkillName"]."</td>
        </tr>";
    }
    echo "</table>";
} else {
    echo "0 results for User Details";
}

$conn->close();
?>

</body>
</html>
