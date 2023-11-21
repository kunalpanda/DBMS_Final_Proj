<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View 8</title>
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
// Check connection

require_once './db/dbh.inc.php';

$sql = "SELECT cp.UserID, u.Username, u.Email, u.Address, sm.SkillName
        FROM final.contractorprofile cp
        LEFT JOIN final.users u ON cp.UserID = u.UserID
        LEFT JOIN final.skillmap sm ON sm.UserID = u.UserID;";

$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../view8.php?error=stmtFailed");
    exit();
}
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if ($result->num_rows > 0) {
    echo "<h2>Contractor Profiles</h2>";
    echo "<table table class='table table-striped'>
    <thead>
    <tr>
    <th>User ID</th>
    <th>Username</th>
    <th>Email</th>
    <th>Address</th>
    <th>Skill Name</th>
    </tr>
    </thead>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr>
        <td>".$row["UserID"]."</td>
        <td>".$row["Username"]."</td>
        <td>".$row["Email"]."</td>
        <td>".$row["Address"]."</td>
        <td>".$row["SkillName"]."</td>
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
