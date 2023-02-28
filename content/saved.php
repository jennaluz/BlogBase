<?php
//include 'logic.php';
//include('auth_saved.php');

include "../include/connect.inc.php";
include "../include/auth_saved.inc.php";
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
          <div class="nav-left flex-div">
              <img class="menu-icon" src="./images/menu_icon.png">
              <a href="./index.php"><img src="./images/logo1.png" class="logo" ></a>
          </div>
          <div class="nav-mid flex-div">
              <div class="search-box flex-div">
                <form action="./search.php" method="POST" id="searchForm">
            <input type="text/submiit" name="search" placeholder="search"/> <img src="./images/search.png">
        </form>
              </div>
          </div><!-- comment -->
          <?php
          if(isset($_SESSION["username"])){
            $loggedInUser = $_SESSION["username"];
            ?>
            <div class="nav-right flex-div">
                <a href="./admin.php"><img src="./images/admin_img.png"></a>
                <a href="./design.php"><img src="./images/gd.png"></a>
                <a href="./create.php"><img src="./images/editor_img.png"></a>
                <a href="./ads.php"><img src="./images/ad.png"></a>
                <a href="./profile.php" style="padding: 10px"><img src="./images/follow.png"></a>
                <u><?php echo $_SESSION['username'] ?></u>
                <a href="./logout.php" style="padding: 10px">Logout</a>
            <?php
          }else{
            ?>
      <div class="nav-right flex-div">
          <a href="./admin.php"><img src="./images/admin_img.png"></a>
          <a href="./design.php"><img src="./images/gd.png"></a>
          <a href="./create.php"><img src="./images/editor_img.png"></a>
          <a href="./ads.php"><img src="./images/ad.png"></a>
          <a href="./profile.php"><img src="./images/follow.png"></a>
          <a href="./login.php" >Login</a><!-- comment -->
          <a href="./register.php" style="padding: 10px">Sign Up</a>
      </div>
      <?php
    }
    ?>
      </nav>

      <!--------------------- side bar --------------------->
      <div class="sidebar">
          <div class="shortcut-links">
              <a href="./index.php"><img src="./images/home.png"> Home </a></p>
              <a href="./hot.php"><p><img src="./images/hot.png"> Hot! </a></p>
              <a style="color: orange" href="./saved.php"><p><img src="./iamges/saved.png"> Saved </a></p>
              <a href="./archived.php"><p><img src="./images/history.png"> Archived </a></p>
              <hr>
          </div>
          <div class="Authors">
            <center>
              <p><a href="./social.php">Social</a></p>
            </center>
              <?php

              if(isset($_SESSION["username"])){
                $loggedInUser = $_SESSION["username"];
                $getUserID = "SELECT userid FROM users WHERE username='$loggedInUser'";
                $loggedOn = $con->query($getUserID);
                if($loggedOn->num_rows > 0){
                  while($row = $loggedOn->fetch_assoc()){
                    $realUserID = $row["userid"];
                $followList = "SELECT username FROM users, social_follow WHERE username!='$loggedInUser' and follower_id='$realUserID' and follow_id=1 and followed_user_id=userid";
                $getFollowList = $con->query($followList);
                if($getFollowList->num_rows > 0){
                  while($row1 = $getFollowList->fetch_assoc()){

               ?>
                  <a href=""><p><img src="./images/follow.png"><?php echo $row1["username"]; ?></a></p>
                <?php
              }
              }
              }
              }
            }else{
              ?>
              <center>
                <p>Not following anyone</p><br>
                <p>or</p><br>
                <p>Need to login</p>
              </center>
              <?php
            }
               ?>
          </div>
      </div>


        <?php
       try {
         if(isset($_SESSION["username"])){
           $loggedInUser = $_SESSION["username"];
           $getUserID = "SELECT userid FROM users WHERE username='$loggedInUser'";
           $loggedOn = $con->query($getUserID);
           if($loggedOn->num_rows > 0){
             while($row1 = $loggedOn->fetch_assoc()){
               $realUserID = $row1["userid"];
           $stmt = $con->query("SELECT blog_posts.postID, blog_posts.postTitle, blog_posts.postDesc, blog_posts.postDate FROM blog_posts, save WHERE is_approved=1 and is_saved=1 and save.userID='$realUserID' and blog_posts.postID=save.postID");
           ?><table class="main-space"><?php
           $i =0;
           $stmt->fetch_assoc();
           foreach($stmt as $row) {

               echo "<center><td>";
               echo '<div class="card">';
               echo '<div class="container">';
               echo '<h1><a href="./post.php?id=' . $row['postID'] . '">' . $row['postTitle'] . '</a></h1>';
               echo '</div>';
               echo '<p>Posted on ' . $row['postDate'] . '</p><br>';
               echo '<p>' . $row['postDesc'] . '</p>';
               echo '<p><a href="./post.php?id=' . $row['postID'] . '">Read More</a></p>';
               echo '</div>';
               echo "</td></center>";
               $i = $i+1;
               if($i % 3 == 0 )
               {
                   echo "<tr></tr>";
               }
           }
         }
       }
     }
       } catch (PDOException $e) {
           echo $e->getMessage();
       }echo "</table>";
       ?>

   </div>
   </div>
   </center>
   <script src="./js/script.js"></script>


    </body>
</html>
