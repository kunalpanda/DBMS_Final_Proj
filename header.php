<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<html>
    <head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
        <style>
            /*Styles for the entire navigation bar*/
            .navbar{ 
                overflow: hidden;
                background-color: #232020;
            }
            /*Styles for all the links in the nav*/
            .nav-link{
                display: block;
                color: #95969D;
                text-align: center;
                text-decoration: none;
            }
            /*Styles for all the links in the nav while hover*/
            .navbar-nav > li > a:hover, .navbar-nav > li > a:focus {
                background-color: #BEE7B8;
                color: #7A8450;
            }
        </style>
    </head>
    <body class="d-flex flex-column min-vh-100">
        <nav class="navbar navbar-expand fixed-top">
            <!-- Container wrapper -->
            <div class="container-fluid">
              <!-- Toggle button -->
              <button
                class="navbar-toggler"
                type="button"
                data-toggle="collapse"
                data-target="#content"
                aria-controls="content"
                aria-expanded="false"
                aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
              </button>
          
              <!-- Collapsible wrapper -->
              <div class="collapse navbar-collapse" id="content">
                <!-- Left links -->
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                  <li class="nav-item">
                    <a class="nav-link" href="index.php" id="home"><b>Home</b></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="index.php" id="orders"><b>Projects</b></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="index.php" id="about"><b>Jobs</b></a>
                  </li>
                </ul>
                <!-- Left links -->
              </div>
              <!-- Collapsible wrapper -->
              <!-- Right elements -->
              <div class="d-flex align-items-center">
              <?php 
                if(isset($_SESSION["useruid"])){
                  echo '<span class="navbar-text w-100">Welcome ' . $_SESSION["name"] . '</span>';
                  echo '<ul class="navbar-nav me-auto mb-2 mb-lg-0">';
                  echo '<li class="nav-item">';
                  echo '<a class="nav-link" href="includes/signout.inc.php">Sign out</a>';
                  echo '</li>';
                }
                else{
                  echo '<ul class="navbar-nav me-auto mb-2 mb-lg-0">';
                    echo '<li class="nav-item">';
                      echo '<a class="nav-link" id="signup" href="signup.php">Register</a>';
                    echo '</li>';
                    echo '<li class="nav-item">';
                        echo '<a class="nav-link" id="login" href="login.php">Login</a>';
                      echo '</li>';
                }
              ?>
                </ul>
              </div>
              </div>
              <!-- Right elements -->
            </div>
            <!-- Container wrapper -->
          </nav>