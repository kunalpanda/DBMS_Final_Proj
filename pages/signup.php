<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" type="text/css" href="../css/forms.css">
</head>
<body>
    <div class="form-container">
        <form action="../db/signUpHandler.inc.php" method="post"> 
            <h2>Register</h2>
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
            <button type="submit">Signup</button>
        </form>
    </div>
</body>
</html>
