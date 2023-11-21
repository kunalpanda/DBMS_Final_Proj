<?php
include "header.php";
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/forms.css">
</head>
<body>
    <div class="form-container">
        <form action="./db/loginHandler.inc.php" method="post">
            <h2>Login (NOT READY)</h2>
            <input type="text" name="Username" placeholder="Username" required>
            <input type="password" name="Password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
    </div>
    
    <?php
    include "footer.php"
    ?>

