<?php
include "header.php";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once './db/dbh.inc.php';

    // Function to sanitize and validate input
    function sanitizeInput($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $sql = "SELECT j.jobID 
    FROM final.jobs j 
    ORDER BY j.jobID DESC LIMIT 1;";

    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../view1.php?error=stmtFailed");
    }
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);
    $lastJobID = $row['jobID'];

    // Validate and sanitize form data
    $jobID = $lastJobID+1;
    $jobTitle = sanitizeInput($_POST["job_title"]);
    $jobDescription = sanitizeInput($_POST["job_description"]);
    $jobPrice = sanitizeInput($_POST["job_price"]);
    $jobDuration = sanitizeInput($_POST["job_duration"]);
    $userID = $_SESSION["userid"]; // Replace with the actual user ID (requires session functionality)
    $postedDate = date("Y-m-d"); 

    $sql = "SELECT * 
    FROM final.skillmap 
    order by SkillMapID DESC limit 1;";

    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../view1.php?error=stmtFailed");
    }
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);
    $lastSkillID = $row['SkillMapID'];

    $skillID = $lastSkillID+1;
    $skill=sanitizeInput($_POST["skill"]);


    // Assume the posted_date is the current date
    

    // SQL query to insert new job into the database
    $sql = "INSERT INTO final.jobs (JobID, UserID, JobTitle, JobDescription, JobPrice, JobDuration, DatePosted) VALUES (?,?, ?, ?, ?, ?, ?);";

    $stmt = $conn->prepare($sql);
    

    $stmt->bind_param("iissdss",$jobID, $userID, $jobTitle, $jobDescription, $jobPrice, $jobDuration, $postedDate);
    
    if ($stmt->execute()) {
        echo "Job created successfully!";
        $sql= "INSERT INTO final.skillmap (SkillMapID, JobID, SkillName) VALUES (?, ?, ?);";

        $stmt = $conn->prepare($sql);
        
        $stmt->bind_param("iis",$skillID, $jobID, $skill);
        
        if ($stmt->execute()) {
            echo "Skill Added Sucessfully!";
        } else {
            echo "Error creating skill: " . $stmt->error;
        }
    } else {
        echo "Error creating job: " . $stmt->error;
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Job</title>
    <link rel="stylesheet" type="text/css" href="./css/create.css">
</head>

<body style="background: linear-gradient(to bottom right, rgb(153, 3, 90), rgb(2, 15, 63));">


<!-- Form for creating a new job -->
<div class="form-container-lg" style="padding-top:60px">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="job_title">Job Title:</label>
        <input type="text" name="job_title" required>

        <label for="job_description">Job Description:</label>
        <textarea name="job_description" rows="4" required></textarea>

        <label for="job_price">Job Price ($):</label>
        <input type="number" min="0"step="0.5" name="job_price" required>

        <label for="job_duration">Job Duration:</label>
        <input type="text" name="job_duration" required>
        <?php
        require_once './db/dbh.inc.php';
        function getDropdownOptions($conn, $query) {
            $result = $conn->query($query);
            while ($row = $result->fetch_assoc()) {
                $value = htmlspecialchars($row['value']);
                $label = htmlspecialchars($row['label']);
                echo "<option value=\"{$value}\">{$label}</option>";
            }
        }
            echo '<select name="skill">
            <option value="">Any Skill</option>';
            getDropdownOptions($conn, "SELECT SkillName as value, SkillName as label FROM Skills");
            echo '</select></br>';
        ?>

        <button type="submit" style="margin-top:5px;">Create Job</button>
    </form>
</div>

</body>
</html>

<?php
include "footer.php";
?>