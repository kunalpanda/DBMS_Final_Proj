<?php

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    // Retrieve POST data
    $username = $_POST["Username"];
    $pwd = $_POST["Password"]; 
    $email = $_POST["Email"];
    $fName = $_POST["FirstName"];
    $lName = $_POST["LastName"];
    $address = $_POST["Address"];
    $dob = $_POST["DOB"];
    $userRoleID = $_POST["UserRoleID"];

    // Include database connection
    require_once "./dbh.inc.php";

    // Prepare the SQL statement
    $query = "INSERT INTO users (Username, Password, Email, FirstName, LastName, Address, DOB, UserRoleID) VALUES (?, ?, ?, ?, ?, ?, ?, ?);";

    // Prepare and bind
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sssssssi", $username, $pwd, $email, $fName, $lName, $address, $dob, $userRoleID);

    // Execute the statement
    if($stmt->execute()){
        header("Location: ../pages/login.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
} else {
    header("Location: ../pages/index.php");
    exit();
}
