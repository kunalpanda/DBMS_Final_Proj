<?php 
include "header.php"
?>
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
    p.ProjectTitle,
    p.ProjectDescription,
    sm.SkillName,
    p.ProjectManagerID,
    u.FirstName,
    u.LastName,
    u.Username,

    GROUP_CONCAT(DISTINCT t.TagName SEPARATOR ', ') AS TagNames
FROM 
    final.projects p
LEFT JOIN 
    final.users u ON u.UserID = p.ProjectManagerID
LEFT JOIN 
    final.skillmap sm ON p.ProjectID = sm.ProjID
LEFT JOIN 
    final.tagmap tm ON p.ProjectID = tm.ProjectID
LEFT JOIN 
    final.tags t ON tm.TagID = t.TagID
WHERE 
    p.ProjectID IS NOT NULL AND
    u.UserID = p.ProjectManagerID
GROUP BY 
    p.ProjectID, 
    p.ProjectTitle, 
    p.ProjectDescription, 
    p.ProjectManagerID,
    u.FirstName,
    u.LastName,
    u.Username";

$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sql)) {
    echo "SQL error: " . mysqli_stmt_error($stmt);
    exit();
}
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);


if ($result->num_rows > 0) {
    echo "<div class='job-container'>";
    // output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "<div class='job-card'>
            <h3>".$row["ProjectTitle"]."</h3>
            <div class='job-meta'>
                <!-- Adjust meta data based on your needs -->
                <span>Project Manager: ".$row["FirstName"]." ".$row["LastName"]." (@".$row["Username"].")</span>
            </div>
            <p>".$row["ProjectDescription"]."</p>
            <ul class='job-tags'>
                <li>".$row["SkillName"]."</li>
                <!-- Add other tags here -->
            </ul>
            <!-- Additional information and button -->
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

<?php
include "footer.php";
?>
