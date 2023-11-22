<?php
include "header.php";
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" type="text/css" href="css/forms.css">
</head>
<body style="background: linear-gradient(to bottom right, rgb(153, 3, 90), rgb(2, 15, 63));background-size: cover;">
    <div class="d-flex align-items-center min-vh-100" style="padding:250px 30px 30px 20px;">
        <div class="form-container-lg" style="max-width: 600px; width: 100%;">
            <form action="./db/signUpHandler.inc.php" method="post"> 
                <h2 style="color: whitesmoke;">Register</h2>
                <input type="text" name="Username" placeholder="Username" required>
                <input type="password" name="Password" placeholder="Password" required>
                <input type="email" name="Email" placeholder="Email" required>
                <input type="text" name="FirstName" placeholder="First Name" required>
                <input type="text" name="LastName" placeholder="Last Name" required>
                <input type="text" name="Address" placeholder="Address" required>
                <input type="date" name="DOB" required>
                <select name="UserRoleID" required>
                    <option value="" disabled selected>Select Role</option>
                    <option value="1">Contractor</option>
                    <option value="2">Consumer</option>
                    <option value="3">Company</option>
                </select>
                <button type="submit" class="btn btn-outline-light" style="width:100%;">Signup</button>
            </form>
        </div>
    </div>
