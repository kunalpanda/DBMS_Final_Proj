<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Job Page</title>
    <link rel="stylesheet" type="text/css" href="./css/jobstyle.css">
</head>
<body>

<?php

require_once './db/dbh.inc.php';

$sql = "SELECT 
    j.JobID, 
    j.UserID, 
    j.JobTitle, 
    j.JobDescription, 
    j.JobPrice,
    j.JobDuration,
    j.DatePosted,
    sm.SkillName,
    u.FirstName,
    u.LastName,
    GROUP_CONCAT(DISTINCT t.TagName SEPARATOR ', ') AS TagNames
FROM 
    final.jobs j
LEFT JOIN 
    final.skillmap sm ON j.JobID = sm.jobID
LEFT JOIN 
    final.tagmap tm ON j.JobID = tm.JobID
LEFT JOIN 
    final.tags t ON tm.TagID = t.TagID
LEFT JOIN 
    final.users u ON j.UserID = u.UserID
WHERE 
    j.JobID IS NOT NULL
GROUP BY 
    j.JobID, 
    j.UserID, 
    j.JobTitle, 
    j.JobDescription, 
    j.JobPrice,
    j.JobDuration,
    j.DatePosted,
    sm.SkillName,
    u.FirstName,
    u.LastName;
";

$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../view4.php?error=stmtFailed");
    exit();
}
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if ($result->num_rows > 0) {
    echo "<div class='job-container'>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<div class='job-card'>
            <h3>".$row["JobTitle"]."</h3>
            <div class='job-meta'>
                <span>".$row["JobDuration"]."</span>
                <p>$</p<span>".$row["JobPrice"]."</span></br>
                <span>Posted ".date("F j, Y", strtotime($row["DatePosted"]))."</span>
            </div>
            <p>".$row["JobDescription"]."</p>
            <ul class='job-tags'>
                <li>".$row["SkillName"]."</li>
                <!-- Add other tags here -->
            </ul>
            <p><strong>Posted By:</strong> ".$row["FirstName"]." ".$row["LastName"]."</p>
            <button>See more</button>
        </div>";
    }
    echo "</div>";
} else {
    echo "<p>0 results found</p>";
}

$conn->close();
?>

</body>
</html>
