<?php
include "../include/connect.inc.php";
include "../include/auth_editor.inc.php";
 ?>
<!DOCTYPE html>
<head>
        <meta charset="utf-8"><!-- comment -->
        <meta name="viewport" content="width=device-width, intitial-scale=1.0">
        <title>Blog Base e-newspaper</title>
        <link rel="stylesheet" href="./css/styles.css">
        <script src="./js/script.js"></script>
</head>
<body>
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
          //this is the place that sets up the authentification for the page in tandom with auth_session.php
            $current_user = $_SESSION['username'];
            $test_auth = "SELECT username FROM users where username='$current_user' and (Admin=1 or graphic_Des=1)";
            $help = $con->query($test_auth);
            if($help->num_rows > 0){
              //the rest of the statement is at the bottom and applies if the user doesn't have the proper
              //access to the page. If they dont they are not able to see any of the information
              ?>
              <center><h1><u>Content Approval or Denial:</u></h1></center>
              <br><br>
              <center><h3>Posts waiting to be approved:</h3></center>
              <br>
                <?php
                require "../include/connect.inc.php";
               try {
                 $stmt = $con->query('SELECT postID, postTitle, postDesc, postDate FROM blog_posts WHERE is_approved=0 ORDER BY postID DESC');
                 ?><table class="main-space"><?php
                 $i =0;
                 if($stmt->num_rows > 0){
                   $stmt->fetch_assoc();
                 foreach($stmt as $row) {

                     echo "<center><td>";
                     echo '<div class="card">';
                     echo '<div class="container">';
                     echo '<h1><a href="./post2.php?id=' . $row['postID'] . '">' . $row['postTitle'] . '</a></h1>';
                     echo '</div>';
                     echo '<p>Posted on ' . $row['postDate'] . '</p><br>';
                     echo '<p>' . $row['postDesc'] . '</p>';
                     echo '<p><a href="./post2.php?id=' . $row['postID'] . '">Read More</a></p>';
                     echo '</div>';
                     echo "</td></center>";
                     $i = $i+1;
                     if($i % 3 == 0 )
                     {
                         echo "<tr></tr>";
                         echo "<tr></tr>";
                     }
                   }
               }else{
                 ?>
                 <br><center><h5>There are no posts waiting to be approved</h5></center><br>
                 <?php
               }
             }catch (PDOException $e) {
                   echo $e->getMessage();
               }
               echo "</table>";
               ?>

           </div>
           </div>
           </center>
           <br>
           <center><h3>Currently approved posts:</h3></center>
           <br>
                <?php
                try {
                  $stmt = $con->query('SELECT postID, postTitle, postDesc, postDate FROM blog_posts WHERE is_approved=1 ORDER BY postID DESC');
                  ?><table class="main-space"><?php
                  $i =0;
                  if($stmt->num_rows > 0){
                  $stmt->fetch_assoc();
                  foreach($stmt as $row) {

                      echo "<center><td>";
                      echo '<div class="card">';
                      echo '<div class="container">';
                      echo '<h1><a href="./post2.php?id=' . $row['postID'] . '">' . $row['postTitle'] . '</a></h1>';
                      echo '</div>';
                      echo '<p>Posted on ' . $row['postDate'] . '</p><br>';
                      echo '<p>' . $row['postDesc'] . '</p>';
                      echo '<p><a href="./post2.php?id=' . $row['postID'] . '">Read More</a></p>';
                      echo '</div>';
                      echo "</td></center>";
                      $i = $i+1;
                      if($i % 3 == 0 )
                      {
                          echo "<tr></tr>";
                          echo "<tr></tr>";
                      }
                    }
                } else{
                  ?>
                  <br><center><h5>There are no posts that are currently approved</h5></center><br>
                  <?php
                }
              }catch (PDOException $e) {
                    echo $e->getMessage();
                }

                echo "</table>";
                ?>

            </div>
            </div>
            </center>
            <?php
                }else{
                  ?>
                  <center>
                    <p><h3>You do not have access to the editor page.</h3></p>
                    <br>
                    <p><h3>Return to <a href="./index.php">Home?</a></h3></p>
                  </center>
                  <?php
                }

                ?>
                <script src="./js/script.js"></script>

</body>
</html>
