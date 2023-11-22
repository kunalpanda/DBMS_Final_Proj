<?php 
include "header.php"; // Make sure this includes your navigation and any session management
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./css/main.css">
    <title>Service Search</title>
</head>
<body>
    <div class="main-content">
        <div class="search-area">
            <?php include "search.php"; // Include the search bar from search.php ?>
        </div>
    </div>

    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
        }
        .main-content {
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            background-size: cover;
            background-image: url("background.jpg");
        }
        .search-area {
            color: White;
            padding: 20px;
            border-radius: 5px;
            background: rgba(101, 101, 101, 0.2);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            width: 50%;
            max-width: 600px;
        }
        .searchbar {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .searchbar input[type="text"],
        .searchbar select {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border-radius: 5px;
            border: 1px solid #ddd;
        }
        .searchbar input[type="submit"] {
            padding: 10px 20px;
            background-color: #34a853;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
        }
        .searchbar input[type="submit"]:hover {
            background-color: #2c7c4b;
        }
    </style>
</body>
</html>

<?php 
include "footer.php"; // Include the footer
?>
 