<?php
require_once "../include/connect.inc.php"; 
ob_start();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, inital-scale=1">

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">
        <link rel="stylesheet" href="./css/styles.css">
        <link rel="stylesheet" href="./css/enter.css">

        <title>BlogBase Register</title>
    </head>

    <body>
        <div class="header">
            <?php include "./views/header.php" ?>
        </div>
        <div class="sidebar">
            <?php include "./views/sidebar.php" ?>
        </div>

        <div class="container mt-5 mb-3 text-center">
            <h1 class="display-3">BlogBase</h1>
        </div>

        <?php
        if (isset($_REQUEST['username'])) {
            $username = stripslashes($_REQUEST['username']);
            $username = mysqli_real_escape_string($con, $username);

            $fname = stripslashes($_REQUEST['fname']);
            $fname = mysqli_real_escape_string($con, $fname);

            $lname = stripslashes($_REQUEST['lname']);
            $lname = mysqli_real_escape_string($con, $lname);

            $email = stripslashes($_REQUEST['email']);
            $email = mysqli_real_escape_string($con, $email);

            $password = stripslashes($_REQUEST['password']);
            $password = mysqli_escape_string($con, $password);

            $designer = 0;
            $writer = 0;
            $advertiser = 0;
            $admin = 0;

            if (isset($_REQUEST['graphic_Des'])) {
                $designer = 1;
            }

            if (isset($_REQUEST['writer'])) {
                $writer = 1;
            }

            if (isset($_REQUEST['advr'])) {
                $advertiser = 1;
            }

            if (isset($_REQUEST['Admin'])) {
                $admin = 1;
            }

            $check = "SELECT *
                      FROM `Users`
                      WHERE username = '$username'";
            $check_select = mysqli_query($con, $check);
            $random_name = mysqli_num_rows($check_select);

            if ($random_name > 0) {
                //echo "test";
                header("Location: ./username_wrong.php");
            } else {
                $query = "INSERT INTO `Users` (username, first_name, last_name, email, password, admin, designer, writer, advertiser)
                          VALUES ('$username', '$fname', '$lname', '$email', '" . md5($password) . "', '$admin', '$designer', '$writer', '$advertiser')";
                $result = mysqli_query($con, $query);

                if ($result) {
                    //echo "<div><h3>Successfully Registered</h3></div>";
                    header("Location: ./login.php");
                    ob_end_flush();
                } else {
                    echo "<div><h3>Missing Required Fields</h3></div>";
                }
            }
        } else {
        ?>

        <div class="row">
            <div class="col"></div>
            <div class="col-5">
                <form class="container" method="post">
                    <div class="row mt-2 mb-3 align-items-center">
                        <div class="col">
                            <label for="fname">First name</label>
                            <input class="form-control" type="text" id="fname" name="fname" required />
                        </div>
                        <div class="col">
                            <label for="lname">Last name</label>
                            <input class="form-control" type="text" id="lname" name="lname" required />
                        </div>
                    </div>
                    <div class="mt-2 mb-3">
                        <label for="email">Email</label>
                        <input class="form-control" type="email" id="email" name="email" required />
                    </div>
                    <div class="mt-2 mb-3">
                        <label for="username">Username</label>
                        <input class="form-control" type="text" id="username" name="username" required />
                    </div>
                    <div class="mt-2 mb-4">
                        <label for="password">Password</label>
                        <input class="form-control" type="password" id="password" name="password" required />
                    </div>
                    <div class="col mb-4">
                        <span class="mb-2" style="font-size: 18px">Check all that apply</span>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="write" name="writer" value="1">
                            <label class="form-check-label" for="writer">Writer</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="graphic_Des" name="graphic_Des" value="1">
                            <label class="form-check-label" for="graphic_Des">Designer</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="advr" name="advr" value="1">
                            <label class="form-check-label" for="advr">Advertiser</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="Admin" name="Admin" value="1">
                            <label class="form-check-label" for="Admin">Admin</label>
                        </div>
                    </div>

                    <button class="btn btn-outline-dark mb-2" type="submit" name="submit">Register</button>
                    <p>Already have an account?&emsp;<a href="./login.php">Login to Account</a></p>
                </form>
            </div>
            <div class="col"></div>
        </div>
        <?php
        }
        ?>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
        <script src="./js/script.js"></script>
    </body>
</html>
