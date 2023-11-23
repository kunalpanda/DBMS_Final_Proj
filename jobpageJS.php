<?php
include "header.php";
include "extapi.php";

?>
<head>
    <meta charset="UTF-8">
    <title>Job Page</title>
    <link rel="stylesheet" type="text/css" href="./css/jobstyle.css">
</head>
<body>
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-12 text-center">
            <h1 style="padding-top: 30px; padding-bottom: 15px">Explore All Jobs</h1>
            <?php
                if (isset($_SESSION["UserRoleID"]) && ($_SESSION["UserRoleID"] == 2 || $_SESSION["UserRoleID"] == 3)) {
                    echo '<a href="jobcreate.php" class="btn btn-lg btn-dark">Create Job</a>';
                }
            ?>
        </div>
    </div>
    <div class="row justify-content-center mt-4">
        <div class="col-md-6 col-lg-4">
            <div class="input-group mb-3">
                <label class="input-group-text" for="currency">Choose a currency:</label>
                <select class="form-select" id="currency">
                    <option value="EUR">Euro (EUR)</option>
                    <option value="USD">US Dollar (USD)</option>
                    <option value="CAD">Canadian Dollar (CAD)</option>
                    <option value="JPY">Japanese Yen (JPY)</option>
                    <option value="AED">United Arab Emirates Dirham (AED)</option>
                    <option value="PHP">Philippine Peso (PHP)</option>
                </select>
            </div>
        </div>
    </div>
</div>

<div class="d-flex flex-column min-vh-100" style="align-items:center;">

<!-- Notice the ID added here -->
<div id='jobContainer' class='job-container'>

</div>
<script>
let conversionRates = {};

function loadConversionRates() {
    fetch('extapi.php?currencies=EUR,CAD,USD,JPY,AED,PHP')
    .then(response => response.json())
    .then(data => {
        conversionRates = data;
        updatePrices(document.getElementById('currency').value); // Update prices on initial load
    })
    .catch(error => {
        console.error('Error fetching conversion rates:', error);
    });
}
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
                    <div class='job-card' data-original-price='${row.JobPrice}'>
                        <h3>${row.JobTitle}</h3>
                        <div class='job-meta'>
                            <span>${row.JobDuration}</span></br>
                            <span class='job-price'>EUR ${row.JobPrice}</span></br>
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
function updatePrices(currency) {
    const rate = conversionRates[currency] || 1;
    document.querySelectorAll('.job-card').forEach(card => {
        const originalPrice = card.getAttribute('data-original-price');
        const convertedPrice = (originalPrice * rate).toFixed(2);
        card.querySelector('.job-price').innerText = `${currency} ${convertedPrice}`;
    });
}
document.getElementById('currency').addEventListener('change', (e) => {
    updatePrices(e.target.value);
});

document.addEventListener('DOMContentLoaded', () => {
    loadJobData();
    loadConversionRates();
});
</script>
</body>
</html>

<?php
include "footer.php";
?>