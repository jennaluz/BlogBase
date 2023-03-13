<?php
ob_start();
require_once "../include/connect.inc.php";
include_once "../include/auth_profile.inc.php"
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, intitial-scale=1">

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
        <link rel="stylesheet" href="./css/styles.css">

        <title>BlogBase</title>
        <style>
            form {
                align-content: center;
                align-items: center;
                align-self: center;
            }

            label{
                font-size: 30px;
            }

            h6{
              font-size: 22px;
            }

            .form-input {

                border-radius: 25px;
                text-decoration: none;
                padding: 16px 32px;
                margin:4px 2px;
                cursor: pointer;
                width: 50%;
            }

            input[type=button], input[type=submit], input[type=reset]{
                background-color: black;
                color: white;
                border: none;
                border-radius: 25px;
                text-decoration: none;
                padding: 16px 32px;
                margin:4px 2px;
                cursor: pointer;
                width: 50%;
            }
        </style>
    </head>

    <body>
        <div class="header">
            <?php include "./views/header.php" ?>
        </div>
        <div class="sidebar">
            <?php include "./views/sidebar.php" ?>
        </div>

        <center>
            <p><h1><?php echo $_SESSION['username'] ?>'s profile:<br></h1>
            <h3>Here you can make edits to your profile.</h3></p>
            <br>

            <?php
            $theUser = $_SESSION['username'];
            $mainSql = "SELECT username, first_name, last_name, email
                        FROM `Users`
                        WHERE username = '$theUser'";
            $mainResult = $con->query($mainSql);

            if ($mainResult->num_rows > 0) {
                while($row = $mainResult->fetch_assoc()){ ?>
                    <center>
                        <form class=" align-items-center justify-content-center" action="" method="post">
                            <div class="form-group">
                                <label for="username">Username:</label><br>
                                <h6>Current Username: <?php echo "" . $row['username'] . ""; ?></h6><br>
                            </div>
                        </form>

                        <br>
                        <?php
                        if (isset($_REQUEST['fname'])) {
                            $fname = stripslashes($_REQUEST['fname']);
                            $fname = mysqli_real_escape_string($con, $fname);
                            $firstname = "UPDATE `Users`
                                          SET first_name = '$fname'
                                          WHERE username = '" . $_SESSION["username"] . "'";
                            $result   = mysqli_query($con, $firstname);

                            if ($result) {
                                header("Location: ./profile.php");
                                exit();
                            } else {
                                echo "Error: There was a problem executing the statement...";
                            }
                        } else { ?>
                            <form class=" align-items-center justify-content-center" action="" method="post">
                                <div class="form-group">
                                    <label for="fname">First name:</label><br>
                                    <h6>Current first name: <?php echo "" . $row['fname'] . ""; ?></h6><br>
                                    <h6>What would you like to change your first name to?</h6><br>
                                    <input class="form-control form-input" type="text" id="fname" name="fname" placeholder="First Name" required /><!-- comment -->
                                </div>
                                <div class="form-group">
                                    <input type="submit" value="Submit" name="submit" class="form-control"/>
                                </div>
                            </form>
                        <?php
                        } ?>

                        <br>
                        <?php
                        if (isset($_REQUEST['lname'])) {
                            $lname = stripslashes($_REQUEST['lname']);
                            $lname = mysqli_real_escape_string($con, $lname);
                            $lastname   = "UPDATE `Users`
                                           SET last_name = '$lname'
                                           WHERE username = '" . $_SESSION["username"] . "'";
                            $result1   = mysqli_query($con, $lastname);

                            if ($result1) {
                                header("Location: ./profile.php");
                                exit();
                            } else {
                                echo "Error: There was a problem executing the statement...";
                            }
                        } else { ?>
                            <form class=" align-items-center justify-content-center" action="" method="post">
                                <div class="form-group">
                                    <label for="lname">Last name:</label><br>
                                    <h6>Current last name: <?php echo "" . $row['last_name'] . ""; ?></h6><br>
                                    <h6>What would you like to change your last name to?</h6><br>
                                    <input class="form-control form-input" type="text" id="lname" name="lname" placeholder="Last Name" required /><!-- comment -->
                                </div>
                                <div class="form-group">
                                    <input type="submit" value="Submit" name="submit" class="form-control"/>
                                </div>
                            </form>
                        <?php
                        } ?>

                        <br>
                        <?php
                        if (isset($_REQUEST['email'])) {
                            $email = stripslashes($_REQUEST['email']);
                            $email = mysqli_real_escape_string($con, $email);
                            $newemail = "UPDATE `Users`
                                         SET email = '$email'
                                         WHERE username = '" . $_SESSION["username"] . "'";
                            $result2 = mysqli_query($con, $newemail);

                            if ($result2) {
                                header("Location: ./profile.php");
                                exit();
                            } else {
                                echo "Error: There was a problem executing the statement...";
                            }
                        } else { ?>
                            <form class=" align-items-center justify-content-center" action="" method="post">
                                <div class="form-group">
                                    <label for="email">Email:</label><br>
                                    <h6>Current email address: <?php echo "" . $row['email'] . ""; ?></h6><br>
                                    <h6>What would you like to change your email address to?</h6><br>
                                    <input class="form-control form-input" type="email" id="email" name="email" placeholder="Email" required />
                                </div>
                                <div class="form-group">
                                    <input type="submit" value="Submit" name="submit" class="form-control"/>
                                </div>
                            </form>
                        <?php
                        } ?>

                        <br>
                        <?php
                        if (isset($_REQUEST['password'])) {
                            $password = stripslashes($_REQUEST['password']);
                            $password = mysqli_real_escape_string($con, $password);
                            $newpassword = "UPDATE `Users`
                                            SET password = '" . md5($password) . "'
                                            WHERE username = '" . $_SESSION["username"] . "'";
                            $result3   = mysqli_query($con, $newpassword);

                            if ($result3) {
                                header("Location: ./profile.php");
                                exit();
                            } else {
                                echo "Error: There was a problem executing the statement...";
                            }
                        } else { ?>
                            <form class=" align-items-center justify-content-center" action="" method="post">
                                <div class="form-group">
                                    <label for="password">Password:</label><br>
                                    <h6>What would you like to change your current password to?</h6><br>
                                    <input class="form-control form-input" type="password" id="password" name="password" placeholder="Password" required />
                                </div>
                                <div class="form-group">
                                    <input type="submit" value="Submit" name="submit" class="form-control"/>
                                </div>
                            </form>
                        <?php
                        } ?>
                    </center>
                <?php
                }
            }

            ob_end_flush();
            ?>
        </center>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
        <script src="./js/script.js"></script>
    </body>
</html>
