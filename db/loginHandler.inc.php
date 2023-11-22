<?php
session_start(); // Start or resume existing session

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once "./dbh.inc.php"; // Database connection

    $username = $_POST["Username"];
    $pwd = $_POST["Password"]; // Password from the login form

    // Prepare the SQL statement with a parameterized query
    $query = "SELECT UserID, Username, Password, UserRoleId FROM users WHERE Username=?";
    $stmt = mysqli_prepare($conn, $query);

    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($result)) {
        if ($row['Password'] === $pwd) { // Verify password
            // Regenerate session ID
            session_regenerate_id();

            // Set session variables
            $_SESSION['userid'] = $row['UserID'];
            $_SESSION['username'] = $row['Username'];
            $_SESSION['UserRoleID'] = $row['UserRoleId'];

            // Redirect to a landing page after successful login
            header("Location: ../index.php");
            exit();
        } else {
            echo "Wrong password";
            header("Location: ../login.php?error=wrongpassword");
            exit();
        }
    } else {
        echo "User not found";
        header("Location: ../login.php?error=nouser");
        exit();
    }
} else {
    // Redirect if accessed without POST request
    header("Location: ../login.php");
    exit();
}
?>
