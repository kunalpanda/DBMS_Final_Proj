<?php
include "header.php";
?>
<head>
    <title>PHP File Selector</title>
    <link rel="stylesheet" type="text/css" href="css/forms.css">
</head>
<body style="min-height: 100vh;">
    <div class="container-lg min-vh-100" style="padding-top:240px;">
        <form action="" method="get" class="form-select align-items-center">
            <label for="fileSelect">Select a File:</label>
            <select name="file" id="fileSelect" class="form-control">
                <option value="">--Select a File--</option>
                <option value="views/view1.php">View 1</option>
                <option value="views/view2.php">View 2</option>
                <option value="views/view3.php">View 3</option>
                <option value="views/view4.php">View 4</option>
                <option value="views/view5.php">View 5</option>
                <option value="views/view6.php">View 6</option>
                <option value="views/view7.php">View 7</option>
                <option value="views/view8.php">View 8</option>
                <option value="views/view9.php">View 9</option>
                <option value="views/view10.php">View 10</option>
            </select>
            <button type="submit" class="btn btn-primary">View Table</button>
        </form>
        <div class="container mt-5 mb-5 overflow-auto" style="max-height: 400px;">
            <?php
            if (isset($_GET['file']) && $_GET['file'] != '') {
                include($_GET['file']);
            }
            ?>
        </div>
    </div>
</body>
</html>

<?php
include "footer.php"
?> 
