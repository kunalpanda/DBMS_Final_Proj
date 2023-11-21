<head>
    <meta charset="UTF-8">
    <title>View 1</title>
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

<h2>Project Details</h2>

<?php
// Check connection

require_once '../db/dbh.inc.php';

$sql = "SELECT p.ProjectTitle, p.ProjectDescription, sm.SkillName, p.ProjectManagerID, u.FirstName, u.LastName, u.Username
        FROM final.projects p
        LEFT JOIN final.users u ON u.UserID = p.ProjectManagerID
        LEFT JOIN final.skillmap sm ON p.ProjectID = sm.ProjID
        WHERE u.userID = p.ProjectManagerID;";

$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../view1.php?error=stmtFailed");
}
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if ($result->num_rows > 0) {
    echo "<table class='table table-striped'>
    <thead>
    <tr>
    <th scope='col'>Project Title</th>
    <th scope='col'>Description</th>
    <th scope='col'>Skill</th><th>Manager ID</th>
    <th scope='col'>First Name</th>
    <th scope='col'>Last Name</th>
    <th scope='col'>Username</th>
    </tr>
    </thead>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "
        <tr>
        <td>".$row["ProjectTitle"]."</td>
        <td>".$row["ProjectDescription"]."</td>
        <td>".$row["SkillName"]."</td>
        <td>".$row["ProjectManagerID"]."</td>
        <td>".$row["FirstName"]."</td>
        <td>".$row["LastName"]."</td>
        <td>".$row["Username"]."</td>
        </tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}
$conn->close();
?>

</body>
</html>
