<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View 7</title>
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

$sql = "SELECT *
        FROM final.projects p
        WHERE p.ApplicationStatus = 1;";

$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../view7.php?error=stmtFailed");
    exit();
}
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if ($result->num_rows > 0) {
    echo "<h2>Projects that are accepting collaborators</h2>";
    echo "<table table class='table table-striped'><thead><tr>";
    
    // Fetching the first row to get column names
    $firstRow = $result->fetch_assoc();
    if ($firstRow) {
        // Output column names as table headers
        foreach ($firstRow as $columnName => $value) {
            echo "<th>".htmlspecialchars($columnName)."</th>";
        }
        echo "</tr><tr>";
        
        // Output first row data
        foreach ($firstRow as $value) {
            echo "<td>".htmlspecialchars($value)."</td>";
        }
        echo "</tr></thead>";

        // Output rest of the row data
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            foreach ($row as $value) {
                echo "<td>".htmlspecialchars($value)."</td>";
            }
            echo "</tr>";
        }
    }
    echo "</table>";
} else {
    echo "0 results found";
}
$conn->close();
?>

</body>
</html>
