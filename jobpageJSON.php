<?php
header('Content-Type: application/json');

require_once './db/dbh.inc.php';

// Define variables for search and filters
$search = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : null;
$skill = isset($_GET['skill']) ? mysqli_real_escape_string($conn, $_GET['skill']) : null;
$tag = isset($_GET['tag']) ? mysqli_real_escape_string($conn, $_GET['tag']) : null;

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
    echo json_encode(["error" => "Statement preparation failed"]);
    exit;
}
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$data = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    echo json_encode($data);
} else {
    echo json_encode(["message" => "No results found"]);
}
$conn->close();
