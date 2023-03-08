<?php require "../include/connect.inc.php"; ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, inital-scale=1">

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">
        <link rel="stylesheet" href="./css/styles.css">
        <link rel="stylesheet" href="./css/enter.css">

        <title>BlogBase Register</title>
    </head>

    <body>
        <nav class="flex-div">
            <?php include "./views/header.php" ?>
        </nav>
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
            $Admin = $_REQUEST['Admin'];
            $graphic_Des = $_REQUEST['graphic_Des'];
            $writer = $_REQUEST['writer'];
            $reader = $_REQUEST['reader'];
            $advr = $_REQUEST['advr'];

            $check = "SELECT * FROM `users` WHERE username='$username'";
            $check_select = mysqli_query($con, $check);
            $random_name = mysqli_num_rows($check_select);

            if($random_name > 0){
            header("Location: ./username_wrong.php");
            } else {
                $query = "INSERT into `users` (username, fname, lname, email, password, Admin, graphic_des, writer, reader, advr)
                          VALUES ('$username', '$fname', '$lname', '$email', '" . md5($password) . "', '$Admin', '$graphic_Des', '$writer', '$reader', '$advr')";
                $result = mysqli_query($con, $query);

                if ($result) {
                    echo "<div><h3>Successfully Registered</h3></div>";
                    header("Location: ./login.php");
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
                            <input class="form-control" type="text" id="fname" name="fname" required /><!-- comment -->
                        </div>
                        <div class="col">
                            <label for="lname">Last name</label>
                            <input class="form-control" type="text" id="lname" name="lname" required /><!-- comment -->
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
                    <div class="form-check">
                        <div class="mb-2">
                            <input class="form-check-input" type="checkbox" id="Admin" name="Admin">
                            <label class="form-check-label" for="Admin">Admin</label>
                        </div>
                        <div class="mb-2">
                            <input class="form-check-input" type="checkbox" id="graphic_Des" name="graphic_Des">
                            <label class="form-check-label" for="graphic_Des">Graphic Designer</label>
                        </div>
                        <div class="mb-2">
                            <input class="form-check-input" type="checkbox" id="write" name="writer">
                            <label class="form-check-label" for="writer">Writer</label>
                        </div>
                        <div class="mb-2">
                            <input class="form-check-input" type="checkbox" id="advr" name="advr">
                            <label class="form-check-label" for="advr">Advertiser</label>
                        </div>
<!--
                        <div class="mb-2">
                            <label for="reader">Reader</label>
                            <input type="checkbox" id="reader" name="reader" value="1" class="#" required />
                        </div>
-->
                    </div>
                    <br>
                    <div class="row">
                        <div class="col">
                            <button type="submit" name="submit" class="btn btn-outline-dark">Register</button>
                        </div>
                        <div class="col-7">
                            <p>Already have an account?&emsp;<a href="./login.php">Login to Account</a></p>
                        </div>
                    </div>
                </form>
            </div>

            <div class="col"></div>
        </div>
        <?php
        }
        ?>

        <script src="./js/script.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    </body>
</html>
