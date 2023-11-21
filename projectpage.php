<?php 
include "header.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Project Page</title>
    <link rel="stylesheet" type="text/css" href="./css/jobstyle.css">
</head>
<body>

<?php

require_once './db/dbh.inc.php';


//query looks good
//look into including collaborator information
$sql = "SELECT 
    p.ProjectID,
    p.ProjectTitle,
    p.ProjectDescription,
    p.ProjectManagerID,
    u.FirstName AS ManagerFirstName,
    u.LastName AS ManagerLastName,
    u.Username AS ManagerUsername,
    GROUP_CONCAT(DISTINCT t.TagName SEPARATOR ', ') AS TagNames,
    GROUP_CONCAT(DISTINCT sm.SkillName SEPARATOR ', ') AS SkillNames
FROM 
    final.projects p
LEFT JOIN 
    final.users u ON u.UserID = p.ProjectManagerID
LEFT JOIN 
    final.tagmap tm ON p.ProjectID = tm.ProjID
LEFT JOIN 
    final.tags t ON tm.TagID = t.TagID
LEFT JOIN 
    final.skillmap sm ON p.ProjectID = sm.ProjID
WHERE 
    p.ProjectID IS NOT NULL
GROUP BY 
    p.ProjectID, 
    p.ProjectTitle, 
    p.ProjectDescription, 
    p.ProjectManagerID,
    ManagerFirstName,
    ManagerLastName,
    ManagerUsername";
    
$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sql)) {
    echo "SQL error: " . mysqli_stmt_error($stmt);
    exit();
}
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if ($result->num_rows > 0) {
    echo "<div class='job-container'style='margin-top:100px;'>";
    // output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "<div class='job-card'>
            <h3>".$row["ProjectTitle"]."</h3>
            <div class='job-meta'>
                <span>Project Manager: ".$row["ManagerFirstName"]." ".$row["ManagerLastName"]." (@".$row["ManagerUsername"].")</span>
            </div>
            <p>".$row["ProjectDescription"]."</p>
            <ul class='job-tags'>
                <li>".$row["SkillNames"]."</li>
                <!-- Add other tags here -->
            </ul>
            <!-- Additional information -->
            <a href='mailto:".$row["ManagerEmail"]."'><button>Email</button></a>
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
