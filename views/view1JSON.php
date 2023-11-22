<?php
header('Content-Type: application/json');

require_once '../db/dbh.inc.php';

$sql = "SELECT p.ProjectTitle, p.ProjectDescription, sm.SkillName, p.ProjectManagerID, u.FirstName, u.LastName, u.Username
        FROM final.projects p
        LEFT JOIN final.users u ON u.UserID = p.ProjectManagerID
        LEFT JOIN final.skillmap sm ON p.ProjectID = sm.ProjID
        WHERE u.userID = p.ProjectManagerID;";

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
