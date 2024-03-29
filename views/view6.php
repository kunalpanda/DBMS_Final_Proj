<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View 6</title>
    <link rel="stylesheet" type="text/css" href="./css/table.css">
</head>
<body>

<?php
// Check connection

require_once './db/dbh.inc.php';

$sql = "SELECT s.SkillName, t.TagName
        FROM final.skills s
        LEFT JOIN final.tags t
        ON s.SkillName = t.SkillName;";

$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../view6.php?error=stmtFailed");
    exit();
}
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if ($result->num_rows > 0) {
    echo "<h2>Skill and Their Tag</h2>";
    echo "<table table class='table table-striped'>
    <thead>
    <tr>
    <th>Skill Name</th>
    <th>Tag Name</th>
    </tr>
    </thead>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr>
        <td>".$row["SkillName"]."</td>";

        if($row["TagName"] == NULL){
            echo "<td>-</td>";
        }else{
        echo "<td>".$row["TagName"]."</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "0 results found";
}

$conn->close();
?>

</body>
</html>
