<?php
//include 'logic.php';
include "../include/connect.inc.php";
?>
<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Other/html.html to edit this template
-->


<html lang="eng">
    <head>
        <meta charset="utf-8"><!-- comment -->
        <meta name="viewport" content="width=device-width, intitial-scale=1.0">
        <title>Blog Base e-newspaper</title>
        <link rel="stylesheet" href="./css/styles.css">
    </head>

    <body>
      <nav class="flex-div">
        <?php include "./views/header.php" ?>
      </nav>

      <!--------------------- side bar --------------------->
      <div class="sidebar">
        <?php include "./views/sidebar.php" ?>
      </div>
      <!--------------------- side bar --------------------->

        <br><br>

        <!-- This is where the info telling the user they logged out will take place -->
        <center>
          <h3><p>You have logged out successfully.</p></h3>
          <br>
          <h3><p>Would you like to return to the <a href="./index.php">home</a> page?</p></h3>
        </center>

    </body>
    <script src="./js/script.js"></script>

</html>
