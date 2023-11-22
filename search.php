<?php
include './db/dbh.inc.php';

// Function to populate dropdowns
function getDropdownOptions($conn, $query) {
    $result = $conn->query($query);
    while ($row = $result->fetch_assoc()) {
        $value = htmlspecialchars($row['value']);
        $label = htmlspecialchars($row['label']);
        echo "<option value=\"{$value}\">{$label}</option>";
    }
}

// Search form
function displaySearchForm($conn) {
    echo '<form action="jobpage.php" class="searchbar" method="GET">
        Search: <input type="text" name="search" />
        Skill: 
        <select name="skill">
            <option value="">Any Skill</option>';
    getDropdownOptions($conn, "SELECT SkillName as value, SkillName as label FROM Skills");
    echo '</select>
        Tag:
        <select name="tag">
            <option value="">Any Tag</option>';
    getDropdownOptions($conn, "SELECT TagName as value, TagName as label FROM Tags");
    echo '</select>
        <input type="submit" value="Search" />
    </form>';
}

// Function to process the search and filter
function processSearchAndFilter($conn) {
    // Initialize the base query
    $query = "SELECT j.*, GROUP_CONCAT(DISTINCT s.SkillName) as Skills, GROUP_CONCAT(DISTINCT t.TagName) as Tags 
              FROM Jobs j
              LEFT JOIN SkillMap sm ON j.JobID = sm.JobID
              LEFT JOIN Skills s ON sm.SkillName = s.SkillName
              LEFT JOIN TagMap tm ON j.JobID = tm.JobID
              LEFT JOIN Tags t ON tm.TagID = t.TagID";

    // Initialize the WHERE clause conditions
    $conditions = [];
    $params = [];

    // Sanitize input
    $search = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : null;
    $skill = isset($_GET['skill']) ? mysqli_real_escape_string($conn, $_GET['skill']) : null;
    $tag = isset($_GET['tag']) ? mysqli_real_escape_string($conn, $_GET['tag']) : null;

    // Add conditions based on sanitized input
    if ($search) {
        $conditions[] = "j.JobTitle LIKE ?";
        $params[] = "%$search%";
    }
    if ($skill) {
        $conditions[] = "s.SkillName = ?";
        $params[] = $skill;
    }
    if ($tag) {
        $conditions[] = "t.TagName = ?";
        $params[] = $tag;
    }

    if (count($conditions) > 0) {
        $query .= " WHERE " . implode(' AND ', $conditions);
    }

    $query .= " GROUP BY j.JobID";

    // Prepare the SQL statement
    $stmt = $conn->prepare($query);

    // Bind parameters to the prepared statement
    if ($params) {
        $stmt->bind_param(str_repeat('s', count($params)), ...$params);
    }

    // Execute the query
    $stmt->execute();
    $result = $stmt->get_result();

    // Fetch results
    $results = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();

    // Return the results
    return $results;
}

// Call the display function
displaySearchForm($conn);

// If the form has been submitted, process the search and filters
if ($_SERVER['REQUEST_METHOD'] == 'GET' && (isset($_GET['search']) || isset($_GET['skill']) || isset($_GET['tag']))) {
    $results = processSearchAndFilter($conn);
    // The $results are now safe to display in jobpage.php
}
?>
