<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve POST data
    $username = $_POST["Username"];
    $pwd = $_POST["Password"];

    // Include database connection
    require_once "./dbh.inc.php";

    // Prepare the SQL statement with a parameterized query
    $query = "SELECT * FROM users WHERE Username=? AND Password=?";
    $stmt = mysqli_prepare($conn, $query);

    // Bind parameters to the query
    mysqli_stmt_bind_param($stmt, "ss", $username, $pwd);

    // Execute the query
    mysqli_stmt_execute($stmt);

    // Get the result
    $result = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($result)) {
        if ($row["UserRoleID"] == "1") {
            header("Location:../onetest.php");
        } elseif ($row["UserRoleID"] == "2") {
            header("Location:../twotest.php");
        } elseif ($row["UserRoleID"] == "3") {
            header("Location:../threetest.php");
        } else {
            echo "Username or Password do not match.";
        }
    } else {
        echo "Username or Password do not match.";
    }

    // Close the statement and the connection
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
} else {
    header("Location: ../index.php");
    exit();
}
