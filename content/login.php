<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */
//require('logic.php');
require "../include/connect.inc.php";
?>

<html>
    <head>
        <title>Blogbase - Login</title>
        <meta charset="utf-8"><!-- <meta -->
        <meta name="viewport" content="width=device-width, inital-scale=1"><!-- comment -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">
         <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
          <link rel="stylesheet" href="./css/styles.css">
        <link rel="stylesheet" href="./css/enter.css">
    </head><!-- comment -->
    <body>
      <nav class="flex-div">
        <?php include "./views/header.php" ?>
      </nav>

      <div class="sidebar">
        <?php include "./views/sidebar.php" ?>
      </div>
        <?php
            //require('./logic.php');
          require "../include/connect.inc.php";
            if(isset($_POST['username'])){
                $username = stripslashes($_REQUEST['username']);
                $username = mysqli_real_escape_string($con, $username);
                $password = stripslashes($_REQUEST['password']);
                $password = mysqli_real_escape_string($con, $password);

                $query = "SELECT * FROM `users` WHERE username='$username' AND password='" .md5($password) . "' AND is_approved!=0";
                $result = mysqli_query($con, $query) or die(mysql_error());
                $rows = mysqli_num_rows($result);
                if($rows == 1) {
                    $_SESSION['username'] = $username;
            header("Location: ./index.php");
                }
                else{
                  header("Location: ./login_error.php");
                }
            }
            else{
                ?>
    <center>
        <form method="post" name="login">
            <h1>Login to BlogBase - </h1><!-- comment -->
            <br><br>
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="Username"/>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Password"/>
            </div>
            <br>
            <div class="form-group">
                <input type="submit" value="Login" name="submit" class="form-control"/>
            </div>
        </form>
    </center>
    <br>
    <center>
        <h3>Don't have an account? <br> Click <a href="./register.php">here </a>to register.</h3>
        <br>
        <h3>Not what you wanted? <br> Click <a href="./index.php">here</a> to return to home.</h3>
    </center>
        <?php
            }
            ?>
            <script src="./js/script.js"></script>

    </body>
</html>
