<?php
header('Content-Type: application/json');

require_once './db/dbh.inc.php';

$sql = "SELECT 
    p.ProjectID,
    p.ProjectTitle,
    p.ProjectDescription,
    p.ProjectManagerID,
    u.FirstName AS ManagerFirstName,
    u.LastName AS ManagerLastName,
    u.Username AS ManagerUsername,
    u.Email AS ManagerEmail,
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
    ManagerUsername,
    ManagerEmail";

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
?>
