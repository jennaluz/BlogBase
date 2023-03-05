<?php
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

      <div class="sidebar">
        <?php include "./views/sidebar.php" ?>
      </div>


        <?php
       try {
           $stmt = $con->query("SELECT postID, postTitle, postDesc, postDate FROM blog_posts WHERE is_approved=1 and postDate>='2022/08/26' ORDER BY clickNumber DESC");
           ?><table class="main-space"><?php
           $i =0;
           $stmt->fetch_assoc();
           foreach($stmt as $row) {

               echo "<center><td>";
               echo '<div class="card">';
               echo '<div class="container">';
               echo '<h1><a href="post1.php?id=' . $row['postID'] . '">' . $row['postTitle'] . '</a></h1>';
               echo '</div>';
               echo '<p>Posted on ' . $row['postDate'] . '</p><br>';
               echo '<p>' . $row['postDesc'] . '</p>';
               echo '<p><a href="post1.php?id=' . $row['postID'] . '">Read More</a></p>';
               echo '</div>';
               echo "</td></center>";
               $i = $i+1;
               if($i % 3 == 0 )
               {
                   echo "<tr></tr>";
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
