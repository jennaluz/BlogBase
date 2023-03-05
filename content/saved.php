<?php
include "../include/connect.inc.php";
include "../include/auth_saved.inc.php";
?>
<!DOCTYPE html>
<html lang="eng">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, intitial-scale=1.0">
        <title>Blog Base e-newspaper</title>
        <link rel="stylesheet" href="./css/styles.css">
    </head>
    <body>
      <nav class="flex-div">
        <?php include "./views/header.php" ?>
      </nav>
      <div class="sidebar">
        <?php include "./views/sidebar.php" ?>
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
               echo '<h1><a href="./post1.php?id=' . $row['postID'] . '">' . $row['postTitle'] . '</a></h1>';
               echo '</div>';
               echo '<p>Posted on ' . $row['postDate'] . '</p><br>';
               echo '<p>' . $row['postDesc'] . '</p>';
               echo '<p><a href="./post1.php?id=' . $row['postID'] . '">Read More</a></p>';
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
