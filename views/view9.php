<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View 9</title>
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

$sql = "SELECT AVG(r.rating) AS 'Overall Rating'
        FROM final.reviews r, final.users u
        WHERE u.UserID = r.TargetUserID AND u.UserID = ?;";

$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../view9.php?error=stmtFailed");
    exit();
}

// Bind parameter
$userID = 11; //userID to get the avg rating of

mysqli_stmt_bind_param($stmt, "i", $userID);

mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if ($row = $result->fetch_assoc()) {
    echo "<h2>Overall Rating for User ID ", $userID ,"</h2>";
    echo "<p>Overall Rating: " . htmlspecialchars($row['Overall Rating']) . "</p>";
} else {
    echo "No rating data found for User ID", $userID;
}

$conn->close();
?>

</body>
</html>
