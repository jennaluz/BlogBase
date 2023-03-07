<?php
require "../include/connect.inc.php";

$stmt = $con->query("SELECT postID, postTitle, postCont, postDate FROM blog_posts WHERE postID ='" . $_GET["id"] . "'");
$row = $stmt->fetch_assoc();
$realPostID = $_GET["id"];

//this is where we will add a view for the "hot" page where it is sorted by most viewed articles
//$incHot = $con->query("UPDATE blog_posts SET clickNumber=clickNumber + 1 WHERE postID='" . $_GET["id"] . "'");

//if post does not exists redirect user.
if ($row['postID'] == '') {
  header('Location: ./'); //add page so that if a article is trying to be found that does not exit it willl rout to a paage saying this deos not exit, would like to got to the home page
  exit;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Blog - <?php echo $row['postTitle']; ?></title>
  <link rel="stylesheet" href="./css/styles.css">
  <link href="./css/comments.css" rel="stylesheet" type="text/css">
</head>

<body>
  <nav class="flex-div">
    <?php include "./views/header.php" ?>
  </nav>
  <div class="sidebar">
    <?php include "./views/sidebar.php" ?>
  </div>

  <!-- the above is all for the sidebar and the other things that follow the sidebar -->
  <center>
    <div id="wrapper">

      <?php

      echo '<div class="cont">';
      //below will show the save icon on the page
      if (isset($_SESSION["username"])) {
        $loggedInUser = $_SESSION["username"];
        $getUserID = "SELECT userid FROM users WHERE username='$loggedInUser'";
        $loggedOn = $con->query($getUserID);
        if ($loggedOn->num_rows > 0) {
          while ($row2 = $loggedOn->fetch_assoc()) {
            $realUserID = $row2["userid"];

            //this will update and maintain the posts from the various trader_cdlupsidegap2crows
            $savedPart = "SELECT t1.postID AS post1, t2.userID AS user2
                        FROM blog_posts AS t1 CROSS JOIN users AS t2";
            $getSavedPart = $con->query($savedPart);
            if ($getSavedPart->num_rows > 0) {
              while ($row7 = $getSavedPart->fetch_assoc()) {
                $PostID = $row7["post1"];
                $UserID = $row7["user2"];

                $sql7 = "INSERT INTO `save`
                          SET postID = '$PostID',
                          userID = '$UserID'
                          ON DUPLICATE KEY UPDATE
                          postID = VALUES(postID),
                          userID = VALUES(userID)";
                $resultToEnd = mysqli_query($con, $sql7);
                //above loads all the entries into the db
              }
            }
            $approvedPost = "SELECT * FROM blog_posts WHERE is_approved=1 and postID='" . $_GET["id"] . "'";
            $getApprovedPost = $con->query($approvedPost);
            if ($getApprovedPost->num_rows > 0) {
              while ($thisHasToWork = $getApprovedPost->fetch_assoc()) {
                $checkIfSaved = "SELECT is_saved, saveID FROM save WHERE userID='$realUserID' and postID='$realPostID'";
                $getCheckIfSaved = $con->query($checkIfSaved);
                $stmt1 = $con->query("SELECT postID, postTitle, postCont, postDate FROM blog_posts WHERE postID ='" . $_GET["id"] . "'");
                //$stmt->$query(array('postID' => $_GET['id']));
                $row10 = $stmt1->fetch_assoc();
                if ($getCheckIfSaved->num_rows > 0) {
                  while ($saveCheck = $getCheckIfSaved->fetch_assoc()) {
                    if ($saveCheck['is_saved'] == 0) {
      ?>
                      <p>
                      <h1><?php echo $row10['postTitle']; ?>
                        <a href="../include/save.inc.php?saveID=<?php echo $saveCheck['saveID']; ?>"><img style="width: 20px; height: 20px;" src="./images/saveIcon.png"></a>
                      </h1>
                      </p>
                      <p>Posted on <?php echo $row10['postDate']; ?></p>
                      <br>
                      <p>
                        <center><a href="../include/revoke_post.inc.php?postID=<?php echo $row10["postID"]; ?>">
                            <h3>Revoke Post?
                          </a></h3>
                        </center>
                      </p>
                      <br>
                      <?php echo '<p>' . $row10['postCont'] . '</p>'; ?>
                      <br>
                      <br>
                    <?php
                      echo '</div>';
                    } else {
                    ?>
                      <p>
                      <h1><?php echo $row10['postTitle']; ?><a href="../include/unsave.inc.php?saveID=<?php echo $saveCheck['saveID']; ?>"><img style="width: 20px; height: 20px;" src="./images/checkmark.png"></a></h1>
                      </p>
                      <?php
                      echo '<p>Posted on ' . $row10['postDate'] . '</p><br>';
                      echo '<p>' . $row10['postCont'] . '</p>';
                      ?>
                      <br>
                      <p>
                        <center><a href="../include/revoke_post.inc.php?postID=<?php echo $row10["postID"]; ?>">
                            <h3>Un-approve Post?
                          </a></h3>
                        </center>
                      </p>
                      <br>
                  <?php
                      echo '</div>';
                    }
                  }
                } else {
                  ?>
                  <p>
                  <h1><?php echo $row['postTitle']; ?></h1>
                  </p>
                <?php

                  echo '<p>Posted on ' . $row['postDate'] . '</p><br>';
                  echo '<p>' . $row['postCont'] . '</p>';
                  echo '</div>';
                }
                ?>
    </div>
    <!--this will be where the part for the comment section will be -->
    <!-- this will be set up for the user based on username and then wil be stored in the comment table in the database -->
    <br><br>
    <?php


    ?>
  </center>
  <div class="comments"></div>
  <?php
              }
            }
            $notApprovedPost = "SELECT * FROM blog_posts WHERE is_approved=0 and postID='" . $_GET["id"] . "'";
            $getNotApprovedPost = $con->query($notApprovedPost);
            if ($getNotApprovedPost->num_rows > 0) {
              while ($thisHasToWork = $getNotApprovedPost->fetch_assoc()) {
                $checkIfSaved = "SELECT is_saved, saveID FROM save WHERE userID='$realUserID' and postID='$realPostID'";
                $getCheckIfSaved = $con->query($checkIfSaved);
                $stmt1 = $con->query("SELECT postID, postTitle, postCont, postDate FROM blog_posts WHERE postID ='" . $_GET["id"] . "'");
                //$stmt->$query(array('postID' => $_GET['id']));
                $row10 = $stmt1->fetch_assoc();
                if ($getCheckIfSaved->num_rows > 0) {
                  while ($saveCheck = $getCheckIfSaved->fetch_assoc()) {
                    if ($saveCheck['is_saved'] == 0) {
  ?>
        <p>
        <h1><?php echo $row10['postTitle']; ?>
          <a href="../include/save.inc.php?saveID=<?php echo $saveCheck['saveID']; ?>"><img style="width: 20px; height: 20px;" src="./images/saveIcon.png"></a>
        </h1>
        </p>
        <?php
                      echo '<p>Posted on ' . $row10['postDate'] . '</p><br>';
                      echo '<p>' . $row10['postCont'] . '</p>';
        ?>
        <br>
        <p>
          <center><a href="approve_post.inc.php?postID=<?php echo $row10["postID"]; ?>">
              <h3>Approve Post?
            </a> or <a href="../include/delete_post.inc.php?postID=<?php echo $row10["postID"]; ?>">Delete Post?</a></h3>
          </center>
        </p>
        <br>
      <?php
                      echo '</div>';
                    } else {
      ?>
        <p>
        <h1><?php echo $row10['postTitle']; ?><a href="../include/unsave.inc.php?saveID=<?php echo $saveCheck['saveID']; ?>"><img style="width: 20px; height: 20px;" src="./images/checkmark.png"></a></h1>
        </p>
        <?php
                      echo '<p>Posted on ' . $row10['postDate'] . '</p><br>';
                      echo '<p>' . $row10['postCont'] . '</p>';
        ?>
        <br>
        <p>
          <center><a href="../include/approve_post.inc.php?postID=<?php echo $row10["postID"]; ?>">
              <h3>Approve Post?
            </a> or <a href="../include/delete_post.inc.php?postID=<?php echo $row10["postID"]; ?>">Delete Post?</a></h3>
          </center>
        </p>
        <br>
    <?php
                      echo '</div>';
                    }
                  }
                } else {
    ?>
    <p>
    <h1><?php echo $row['postTitle']; ?></h1>
    </p>
  <?php

                  echo '<p>Posted on ' . $row['postDate'] . '</p><br>';
                  echo '<p>' . $row['postCont'] . '</p>';
                  echo '</div>';
                }
  ?>
  </div>
  <!--this will be where the part for the comment section will be -->
  <!-- this will be set up for the user based on username and then wil be stored in the comment table in the database -->
  <br><br>
  <?php


  ?>
  </center>
<?php
              }
            }
          }
        }
      }
?>
<script>
  const comments_page_id = '<?php echo $realPostID; ?>'; // This number should be unique on every page
  fetch("../include/comments.inc.php?page_id=" + comments_page_id).then(response => response.text()).then(data => {
    document.querySelector(".comments").innerHTML = data;
    document.querySelectorAll(".comments .write_comment_btn, .comments .reply_comment_btn").forEach(element => {
      element.onclick = event => {
        event.preventDefault();
        document.querySelectorAll(".comments .write_comment").forEach(element => element.style.display = 'none');
        document.querySelector("div[data-comment-id='" + element.getAttribute("data-comment-id") + "']").style.display = 'block';
        document.querySelector("div[data-comment-id='" + element.getAttribute("data-comment-id") + "'] input[name='name']").focus();
      };
    });
    document.querySelectorAll(".comments .write_comment form").forEach(element => {
      element.onsubmit = event => {
        event.preventDefault();
        fetch("../include/comments.inc.php?page_id=" + comments_page_id, {
          method: 'POST',
          body: new FormData(element)
        }).then(response => response.text()).then(data => {
          element.parentElement.innerHTML = data;
        });
      };
    });
  });
</script>


<script src="./js/script.js"></script>

</body>

</html>
