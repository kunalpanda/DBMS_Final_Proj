<?php 
include "header.php"
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Jobs</title>
    <link rel="stylesheet" type="text/css" href="./css/jobstyle.css">
</head>
<body>
 
<div class="search-box-container">
<form action="jobpage.php" method="get">
    <input type="text" name="search" placeholder="Search for jobs...">

    <div class="dropdown">
        <button class="dropbtn">Filters</button>
        <div class="dropdown-content">
            <div class="mega-menu">
                <div class="menu-section">
                    <h4>Skills</h4>
                    <!-- Replace with dynamic server-side code to fetch skills -->
                    <label><input type="checkbox" name="skills[]" value=""></label>
                    <label><input type="checkbox" name="skills[]" value=""></label>
                    <label><input type="checkbox" name="skills[]" value=""></label>
                    <label><input type="checkbox" name="skills[]" value=""></label>
                    <label><input type="checkbox" name="skills[]" value=""></label>
                    <label><input type="checkbox" name="skills[]" value=""></label>
                    <label><input type="checkbox" name="skills[]" value=""></label>
                    <label><input type="checkbox" name="skills[]" value=""></label>
                    <label><input type="checkbox" name="skills[]" value=""></label>
                    <label><input type="checkbox" name="skills[]" value=""></label>
                    <label><input type="checkbox" name="skills[]" value=""></label>
                    <label><input type="checkbox" name="skills[]" value=""></label>
                    <label><input type="checkbox" name="skills[]" value=""></label>
                    <label><input type="checkbox" name="skills[]" value=""></label>
                    <label><input type="checkbox" name="skills[]" value=""></label>
                </div>
                <div class="menu-section">
                    <h4>Tags</h4>
                    <label><input type="checkbox" name="tags[]" value=""></label>
                    <label><input type="checkbox" name="tags[]" value=""></label>
                    <label><input type="checkbox" name="tags[]" value=""></label>
                    <label><input type="checkbox" name="tags[]" value=""></label>
                    <label><input type="checkbox" name="tags[]" value=""></label>
                    <label><input type="checkbox" name="tags[]" value=""></label>
                    <label><input type="checkbox" name="tags[]" value=""></label>
                    <label><input type="checkbox" name="tags[]" value=""></label>
                    <label><input type="checkbox" name="tags[]" value=""></label>
                    <label><input type="checkbox" name="tags[]" value=""></label>
                    <label><input type="checkbox" name="tags[]" value=""></label>
                    <label><input type="checkbox" name="tags[]" value=""></label>
                    <label><input type="checkbox" name="tags[]" value=""></label>
                    <label><input type="checkbox" name="tags[]" value=""></label>
                    <label><input type="checkbox" name="tags[]" value=""></label>
                    <label><input type="checkbox" name="tags[]" value=""></label>
                    <label><input type="checkbox" name="tags[]" value=""></label>
                    <label><input type="checkbox" name="tags[]" value=""></label>
                    <label><input type="checkbox" name="tags[]" value=""></label>
                    <label><input type="checkbox" name="tags[]" value=""></label>
                    <label><input type="checkbox" name="tags[]" value=""></label>
                    <label><input type="checkbox" name="tags[]" value=""></label>
                </div>
                <div class="menu-section">
                    <h4>Duration</h4>
                    <label><input type="radio" name="duration" value="short"> Short-term</label>
                    <label><input type="radio" name="duration" value="medium"> Medium-term</label>
                    <label><input type="radio" name="duration" value="long"> Long-term</label>
                </div>
                <div class="menu-section">
                <h4>Price Range</h4>
                    <label><input type="radio" name="priceRange" value="0-100">$0 - $100</label>
                    <label><input type="radio" name="priceRange" value="100-500">$100 - $500</label>
                    <label><input type="radio" name="priceRange" value="500-1000">$500 - $1000</label>
                </div>
            </div>
        </div>
    
    <button type="submit">Search</button>
</form>
</div>
<?php
// Check connection

require_once './db/dbh.inc.php';

$sql = "SELECT j.JobID, j.UserID, j.JobTitle, j.JobDescription, j.JobPrice, j.JobDuration, j.DatePosted, sm.SkillName, u.FirstName, u.LastName,
        GROUP_CONCAT(DISTINCT t.TagName SEPARATOR ', ') AS TagNames
        FROM final.jobs j
        LEFT JOIN final.skillmap sm ON j.JobID = sm.jobID
        LEFT JOIN final.tagmap tm ON j.JobID = tm.JobID
        LEFT JOIN final.tags t ON tm.TagID = t.TagID
        LEFT JOIN final.users u ON j.UserID = u.UserID
        WHERE j.JobID IS NOT NULL
        GROUP BY j.JobID, j.UserID, j.JobTitle, j.JobDescription, j.JobPrice, j.JobDuration, j.DatePosted, sm.SkillName, u.FirstName, u.LastName;";

$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../jobpage.php?error=stmtFailed");
    exit();
}
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if ($result->num_rows > 0) {
    echo "<div class='job-container'>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<div class='job-card'>
            <h3>".$row["JobTitle"]."</h3>
            <div class='job-meta'>
                <span>".$row["JobDuration"]."</span>
                <span>".$row["JobPrice"]."</span>
                <span>Posted ".date("F j, Y", strtotime($row["DatePosted"]))."</span>
            </div>
            <p>".$row["JobDescription"]."</p>
            <ul class='job-tags'>
                <li>".$row["SkillName"]."</li>
                <!-- Add other tags here -->
            </ul>
            <p><strong>Posted By:</strong> ".$row["FirstName"]." ".$row["LastName"]."</p>
            <button>See more</button>
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
<script>
    function updatePriceOutput(val) {
        document.getElementById('priceOutputId').value = val;
    }
</script>
