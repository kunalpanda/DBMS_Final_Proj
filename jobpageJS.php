<?php
include "header.php";
?>
<head>
    <meta charset="UTF-8">
    <title>Job Page</title>
    <link rel="stylesheet" type="text/css" href="./css/jobstyle.css">
</head>
<body>
<div class="d-flex justify-content-center" style="padding-top:100px">
<h1>Explore All Jobs</h1>
</div>
<div class="d-flex flex-column min-vh-100" style="align-items:center;">
<!-- Notice the ID added here -->
<div id='jobContainer' class='job-container'>

</div>
<script>
function loadJobData() {
    const queryParams = new URLSearchParams(window.location.search);
    const searchURL = `jobpageJSON.php?${queryParams}`;
    fetch('jobpageJSON.php') // Replace with the actual path to your JSON
    .then(response => response.json())
    .then(data => {
        // Now using the correct ID to reference the container
        const container = document.getElementById('jobContainer');
        if (data.length > 0) {
            // Clear the container before appending new content
            container.innerHTML = '';
            data.forEach(row => {
                container.innerHTML += `
                    <div class='job-card'>
                        <h3>${row.JobTitle}</h3>
                        <div class='job-meta'>
                            <span>${row.JobDuration}</span></br>
                            <span>$${row.JobPrice}</span></br>
                            <span>Posted ${new Date(row.DatePosted).toLocaleDateString('en-US', { year: 'numeric', month: 'long', day: 'numeric' })}</span>
                        </div>
                        <p>${row.JobDescription}</p>
                        <ul class='job-tags'>
                            <li>${row.SkillNames}</li>
                        </ul>
                        <p><strong>Posted By:</strong> ${row.FirstName} ${row.LastName}</p>
                        <a href='mailto:${row.Email}?subject=Regarding Project: ${row.JobTitle}'><button>Email</button></a>
                    </div>
                `;
            });
        } else {
            container.innerHTML = '<p>0 results found</p>';
        }
    })
    .catch(error => {
        console.error('Error:', error);
        // Make sure to define the container here as well to avoid reference errors
        const container = document.getElementById('jobContainer');
        container.innerHTML = '<p>Error loading data</p>';
    });
}

// Load data when the page loads
document.addEventListener('DOMContentLoaded', loadJobData);
</script>
</body>
</html>

<?php
include "footer.php";
?>