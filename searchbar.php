<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Job Search</title>
    <link rel="stylesheet" type="text/css" href="../css/search.css">
</head>
<body>

<form action="jobpage.php" method="get">
    <input type="text" name="search" placeholder="Search for jobs...">

    <div class="dropdown">
        <button class="dropbtn">Filters</button>
        <div class="dropdown-content">
            <div class="mega-menu">
                <div class="menu-section">
                    <h4>Skills</h4>
                    <!-- Replace with dynamic server-side code to fetch skills -->
                    <label><input type="checkbox" name="skills[]" value="Illustration"> Illustration</label>
                    <label><input type="checkbox" name="skills[]" value="Storytelling"> Storytelling</label>
                    <!-- More skills -->
                </div>
                <div class="menu-section">
                    <h4>Tags</h4>
                    <!-- Replace with dynamic server-side code to fetch tags -->
                    <label><input type="checkbox" name="tags[]" value="Comic Art"> Comic Art</label>
                    <label><input type="checkbox" name="tags[]" value="Character Design"> Character Design</label>
                    <!-- More tags -->
                </div>
                <div class="menu-section">
                    <h4>Duration</h4>
                    <label><input type="radio" name="duration" value="short"> Short-term</label>
                    <label><input type="radio" name="duration" value="medium"> Medium-term</label>
                    <label><input type="radio" name="duration" value="long"> Long-term</label>
                </div>
                <div class="menu-section">
                    <h4>Price Range</h4>
                    <input type="range" name="priceRange" min="0" max="1000" step="50" oninput="priceOutputId.value = priceRange.value">
                    <output name="priceOutput" id="priceOutputId">500</output>
                </div>
            </div>
        </div>
    </div>
    
    <button type="submit">Search</button>
</form>

<script>
    function updatePriceOutput(val) {
        document.getElementById('priceOutputId').value = val;
    }
</script>

<?php
require_once "db/dbh.inc.php";
// Process the form submission
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Assume $conn is your database connection
    $searchTerm = $duration = $minPrice = $maxPrice = "";
    $skillsFilter = $tagsFilter = [];

    if (!empty($_GET['search'])) {
        $searchTerm = mysqli_real_escape_string($conn, $_GET['search']);
    }
    if (!empty($_GET['duration'])) {
        $duration = mysqli_real_escape_string($conn, $_GET['duration']);
    }
    if (!empty($_GET['priceRange'])) {
        $priceRange = intval($_GET['priceRange']);
        $minPrice = 0;
        $maxPrice = $priceRange;
    }
    if (!empty($_GET['skills'])) {
        $skillsFilter = $_GET['skills']; // This needs to be sanitized
    }
    if (!empty($_GET['tags'])) {
        $tagsFilter = $_GET['tags']; // This needs to be sanitized
    }

    // Construct the SQL query based on the filters
    $query = "SELECT * FROM jobs WHERE 1"; // 1 is always true, just a placeholder
    
    if ($searchTerm) {
        $query .= " AND (JobTitle LIKE '%$searchTerm%' OR JobDescription LIKE '%$searchTerm%')";
    }
    if ($duration) {
        $query .= " AND JobDuration = '$duration'";
    }
    if ($minPrice !== "" && $maxPrice !== "") {
        $query .= " AND JobPrice BETWEEN $minPrice AND $maxPrice";
    }
    // Additional filters for skills and tags need to be implemented here

    // Perform the database query
    $result = mysqli_query($conn, $query);
    if ($result) {
        // Output the jobs
        while ($row = mysqli_fetch_assoc($result)) {
            // Display each job in HTML
            // ...
        }
    } else {
        echo "0 results found";
    }
}

mysqli_close($conn);
?>

</body>
</html>