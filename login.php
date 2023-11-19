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
        <form action="login.php" method="post">
            <h2>Login (NOT READY)</h2>
            <input type="text" name="usernameoremail" placeholder="Username or Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="submit" value="Login">
        </form>
    </div>
    
    <?php
    include "footer.php"
    ?>

