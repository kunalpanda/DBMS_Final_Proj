<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View 3</title>
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

<h2>Skill Based Search</h2>

<?php
// Check connection

require_once '../db/dbh.inc.php';


$sql3 = "SELECT *
         FROM final.reviews r
         WHERE r.TargetUserID = (SELECT u.UserID 
                                 FROM final.users u, final.skillmap sm 
                                 WHERE sm.SkillName LIKE ? 
                                 AND sm.UserID = u.UserID);";

$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sql3)) {
    header("location: ../view3.php?error=stmtFailed");
}

$skillNeeded = "Wood Work"; //Edit this variable based on a given Tag

mysqli_stmt_bind_param($stmt,"s",$skillNeeded);
mysqli_stmt_execute($stmt);
$result3 = mysqli_stmt_get_result($stmt);

if ($result3->num_rows > 0) {
    echo "<h2>Reviews for", $skillNeeded ,"</h2>";
    echo "<table table class='table table-striped'>
    <thead>
    <tr>
    <th>Review ID</th>
    <th>Creator User ID</th>
    <th>Target User ID</th>
    <th>Rating</th>
    <th>Comment</th>
    <th>Role ID</th>
    <th>Date Posted</th>
    </tr>
    </thead>"; // Add other column headers as needed
    // output data of each row
    while($row = $result3->fetch_assoc()) {
        echo "<tr>
        <td>".$row["ReviewID"]."</td>
        <td>".$row["CreatorUserID"]."</td>
        <td>".$row["TargetUserID"]."</td>
        <td>".$row["Rating"]."</td>
        <td>".$row["Comment"]."</td>
        <td>".$row["RoleID"]."</td>
        <td>".$row["DatePosted"]."</td>
        </tr>";
    }
    echo "</table>";
} else {
    echo "0 results for" , $skillNeeded , "Reviews";
}



$conn->close();
?>

</body>
</html>
