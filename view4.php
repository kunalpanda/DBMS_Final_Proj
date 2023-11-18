<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View 4</title>
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

require_once 'dbh.inc.php';

$sql = "SELECT j.JobID, j.UserID, j.JobTitle, j.JobDescription, sm.SkillName
        FROM final.jobs j
        RIGHT JOIN final.skillmap sm ON j.JobID = sm.jobID
        WHERE j.JobID IS NOT NULL;";

$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../view4.php?error=stmtFailed");
    exit();
}
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if ($result->num_rows > 0) {
    echo "<h2>Job and Skill Details</h2>";
    echo "<table>
    <tr>
    <th>Job ID</th>
    <th>User ID</th>
    <th>Job Title</th>
    <th>Job Description</th>
    <th>Skill Name</th>
    </tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr>
        <td>".$row["JobID"]."</td>
        <td>".$row["UserID"]."</td>
        <td>".$row["JobTitle"]."</td>
        <td>".$row["JobDescription"]."</td>
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
