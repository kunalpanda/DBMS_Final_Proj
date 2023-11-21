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

    // Validate and sanitize form data
    $projectTitle = sanitizeInput($_POST["project_title"]);
    $projectDescription = sanitizeInput($_POST["project_description"]);
    $projectManagerID = 1; // Replace with the actual project manager ID (requires session functionallity)
    $timeline = sanitizeInput($_POST["timeline"]);
    // Add other form fields as needed

    // SQL query to insert new project into the database
    $sql = "INSERT INTO final.projects (ProjectTitle, ProjectDescription, ProjectManagerID, Timeline) VALUES (?, ?, ?, ?)";

    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo "SQL error: " . mysqli_stmt_error($stmt);
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ssis", $projectTitle, $projectDescription, $projectManagerID, $timeline);
    
    if (mysqli_stmt_execute($stmt)) {
        echo "Project created successfully!";
    } else {
        echo "Error creating project: " . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Job Page</title>
    <link rel="stylesheet" type="text/css" href="./css/create.css">
</head>

<body>

<h2>Create New Project</h2>

<!-- Form for creating a new project -->
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <label for="project_title">Project Title:</label>
    <input type="text" name="project_title" required>

    <label for="project_description">Project Description:</label>
    <textarea name="project_description" rows="4" required></textarea>

    <!-- Add other form fields as needed -->

    <label for="timeline">Timeline:</label>
    <input type="text" name="timeline" required>

    <button type="submit">Create Project</button>
</form>

</body>
</html>

<?php
include "footer.php";
?>
