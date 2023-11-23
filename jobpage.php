<?php
include 'header.php';
require_once './db/dbh.inc.php';


// Define variables for search and filters
$search = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : null;
$skill = isset($_GET['skill']) ? mysqli_real_escape_string($conn, $_GET['skill']) : null;
$tag = isset($_GET['tag']) ? mysqli_real_escape_string($conn, $_GET['tag']) : null;

// SQL query to include search terms and filters
$sql = "SELECT 
    j.JobID, 
    j.UserID, 
    j.JobTitle, 
    j.JobDescription, 
    j.JobPrice,
    j.JobDuration,
    j.DatePosted,
    GROUP_CONCAT(DISTINCT sm.SkillName SEPARATOR ', ') AS SkillNames,
    u.FirstName,
    u.LastName,
    u.Email,
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
    final.users u ON j.UserID = u.UserID";

$conditions = [];
$params = [];

// Append conditions based on search and filters
if ($search) {
    $conditions[] = "j.JobTitle LIKE ?";
    $params[] = "%$search%";
}
if ($skill) {
    $conditions[] = "sm.SkillName = ?";
    $params[] = $skill;
}
if ($tag) {
    $conditions[] = "t.TagName = ?";
    $params[] = $tag;
}

if (count($conditions) > 0) {
    $sql .= " WHERE " . implode(' AND ', $conditions);
}

$sql .= " GROUP BY 
    j.JobID, 
    j.UserID, 
    j.JobTitle, 
    j.JobDescription, 
    j.JobPrice,
    j.JobDuration,
    j.DatePosted";

$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../jobpage.php?error=stmtFailed");
    exit();
}


if (!empty($params)) {
    $types = str_repeat('s', count($params)); // Types string, e.g., 'sss' for three parameters
    mysqli_stmt_bind_param($stmt, $types, ...$params);
}

mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Job Page</title>
    <link rel="stylesheet" type="text/css" href="./css/jobstyle.css">
</head>
<body>

<div class="d-flex flex-column min-vh-100" style="align-items:center; margin-top:100px;">
<div class='job-container' style='width: 80%;'>

<?php
if ($result->num_rows > 0) {
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
                <li>".$row["SkillNames"]."</li>
            </ul>
            <p><strong>Posted By:</strong> ".$row["FirstName"]." ".$row["LastName"]."</p>
            <a href='mailto:".$row["Email"]."?subject=Regarding Project: ".$row["JobTitle"]."'><button>Email</button></a>
        </div>";
    }
    echo "</div>";
} else {
    echo "<p>0 results found</p>";
}

$conn->close();
?>

</div>

</body>
</html>
