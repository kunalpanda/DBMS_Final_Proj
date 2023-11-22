<?php
// You may need to adjust the path to the location of your JSON file
$jsonData = json_decode(file_get_contents('jobpageJSON.php'), true);

// Function to display the search form
function displaySearchForm() {
    // Display the form. Removed the dynamic dropdowns since they are not needed for JSON search
    echo '<form action="jobpageJS.php" class="searchbar" method="GET">
        Search: <input type="text" name="search" />
        Skill: <input type="text" name="skill" />
        Tag: <input type="text" name="tag" />
        <input type="submit" value="Filter" />
    </form>';
}

// Function to process the search and filter
function processSearchAndFilter($jsonData) {
    $results = [];
    
    // Sanitize input
    $search = isset($_GET['search']) ? $_GET['search'] : '';
    $skill = isset($_GET['skill']) ? $_GET['skill'] : '';
    $tag = isset($_GET['tag']) ? $_GET['tag'] : '';

    // Filter the data
    foreach ($jsonData as $entry) {
        if ($search && strpos($entry['JobTitle'], $search) === false) {
            continue;
        }
        if ($skill && !in_array($skill, explode(',', $entry['SkillNames']))) {
            continue;
        }
        if ($tag && !in_array($tag, explode(',', $entry['TagNames']))) {
            continue;
        }
        $results[] = $entry;
    }

    return $results;
}

// Call the display function
displaySearchForm();

// If the form has been submitted, process the search and filters
if ($_SERVER['REQUEST_METHOD'] == 'GET' && (!empty($_GET['search']) || !empty($_GET['skill']) || !empty($_GET['tag']))) {
    $results = processSearchAndFilter($jsonData);
    // The $results are now safe to display in jobpage.php
    // You can now loop through $results and display each job
    foreach ($results as $job) {
        // Display your job card here
    }
}
?>
