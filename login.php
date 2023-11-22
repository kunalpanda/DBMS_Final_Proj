<?php
include "header.php";
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/forms.css">
    <style></style>
</head>
<body style="background: linear-gradient(to bottom right, rgb(153, 3, 90), rgb(2, 15, 63));">
    <div class="d-flex align-items-center min-vh-100" style="padding-bottom: 20px;">
        <div class="form-container-lg">
            <form action="./db/loginHandler.inc.php" method="post">
                <h2 style="color:Whitesmoke;">Login</h2>
                <input type="text" name="Username" placeholder="Username" required>
                <input type="password" name="Password" placeholder="Password" required>
                <button type="submit" class="btn btn-outline-light" style="width:100%;">Login</button>
            </form>
        </div>
    </div>
    
    <?php
    include "footer.php"
    ?>

