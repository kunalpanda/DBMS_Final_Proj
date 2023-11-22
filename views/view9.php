<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View 9</title>
    <link rel="stylesheet" type="text/css" href="./css/table.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        

    </style>
</head>
<body>

<?php
// Check connection

require_once './db/dbh.inc.php';

function displayRating($rating) {
    $starHTML = '';
    
    for ($i = 1; $i <= 5; $i++) {
        if ($i <= $rating) {
            // Full star
            $starHTML .= '<span class="fa fa-star fa-2x"></span>';
        } elseif ($i - 0.5 <= $rating) {
            // Half star
            $starHTML .= '<span class="fa fa-star-half-full fa-2x"></span>';
        } else {
            // Empty star
            $starHTML .= '<span class="fa fa-star-o fa-2x"></span>';
        }
    }
    
    return $starHTML;
}

// Example usage (Replace with actual rating value from your database)



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
    echo "<p>Overall Rating: " . displayRating($row['Overall Rating']) . "</p>";
} else {
    echo "No rating data found for User ID", $userID;
}

$conn->close();
?>

</body>
</html>
