<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View 5</title>
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

$userIDReq=11;

$sql = "SELECT DISTINCT j.JobID AS 'Task ID', j.UserID AS 'Creator ID', j.JobTitle AS 'Task Title', j.JobDescription AS 'Task Description', j.JobDuration AS 'Task Timeline', sm.SkillName AS 'Skill Required'
        FROM final.jobs j, final.skillmap sm
        WHERE j.JobID = sm.JobID AND sm.SkillName = (SELECT sm.SkillName FROM final.skillmap sm, final.users u WHERE sm.UserID = u.UserID AND u.UserID='11')
        UNION
        SELECT DISTINCT p.ProjectID, p.ProjectManagerID, p.ProjectTitle, p.ProjectDescription, p.Timeline, sm.SkillName
        FROM final.projects p, final.skillMap sm
        WHERE p.ProjectID = sm.ProjID AND sm.SkillName = (SELECT sm.SkillName FROM final.skillmap sm, final.users u WHERE sm.UserID = u.UserID AND u.UserID=?);";

$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../view5.php?error=stmtFailed");
    exit();
}
mysqli_stmt_bind_param($stmt,"i",$userIDReq);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if ($result->num_rows > 0) {
    echo "<h2>Tasks and Projects Related to User ID ",$userIDReq,"</h2>";
    echo "<table>
    <tr>
    <th>Task ID</th>
    <th>Creator ID</th>
    <th>Task Title</th>
    <th>Task Description</th>
    <th>Task Timeline</th>
    <th>Skill Required</th>
    </tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr>
        <td>".$row["Task ID"]."</td>
        <td>".$row["Creator ID"]."</td>
        <td>".$row["Task Title"]."</td>
        <td>".$row["Task Description"]."</td>
        <td>".$row["Task Timeline"]."</td>
        <td>".$row["Skill Required"]."</td>
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
