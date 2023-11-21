<?php
include "header.php";
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Project Page</title>
    <link rel="stylesheet" type="text/css" href="./css/jobstyle.css">
    <style>
        /* temp styling - move to jobstyle.css */
        .job-card {
            position: relative;
        }

        .email-button {
            position: absolute;
            bottom: 0;
            left: 0;
            margin: 10px; /* Optional: Add some margin for better spacing */
        }
    </style>
</head>
<body onload="loadProjectData()">
    <div class="container min-vh-100">
        <div id="projectContainer" class='job-container'>
            <!-- Project data will be loaded here -->
        </div>
    </div>
</body>


<script>
    function loadProjectData() {
        fetch('projectpage.obj.php')
        .then(response => response.json())
        .then(data => {
            const container = document.getElementById('projectContainer');
            if (data.length > 0) {
                data.forEach(row => {
                    container.innerHTML += `
                        <div class='job-card'>
                            <h3>${row.ProjectTitle}</h3>
                            <div class='job-meta'>
                                <span>Project Manager: ${row.ManagerFirstName} ${row.ManagerLastName} (@${row.ManagerUsername})</span>
                            </div>
                            <p>${row.ProjectDescription}</p>
                            <ul class='job-tags'>
                                <li>${row.SkillNames}</li>
                            </ul>
                            <!-- Additional information -->
                            <a href='mailto:${row.ManagerEmail}?subject=Regarding Project: ${row.ProjectTitle}'>
                                <button class='email-button'>Email</button>
                            </a>
                        </div>
                    `;
                });
            } else {
                container.innerHTML = '<p>0 results found</p>';
            }
        })
        .catch(error => {
            console.error('Error:', error);
            document.getElementById('projectContainer').innerHTML = '<p>Error loading data</p>';
        });
    }
    </script>
    
</body>
</html>

<?php
include "footer.php";
?>

