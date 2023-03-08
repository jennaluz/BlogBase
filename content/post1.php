<?php
require "../include/connect.inc.php";

$stmt = $con->query("SELECT postID, postTitle, postCont, postDate FROM blog_posts WHERE postID ='" . $_GET["id"] . "'");
$row = $stmt->fetch_assoc();
$realPostID = $_GET["id"];

// update the click number of the article to sort it in the "hot" page
$incHot = $con->query("UPDATE blog_posts SET clickNumber=clickNumber + 1 WHERE postID='" . $_GET["id"] . "'");

//if post does not exists redirect user.
if ($row['postID'] == '') {
    // display a message saying "That article doesn't exist, would you like to return?"
    header('Location: ./');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, intitial-scale=1">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" href="./css/styles.css">
    <link rel="stylesheet" href="./css/comments.css">

    <title><?php echo $row['postTitle']; ?></title>
</head>
<body>
        <div class="header">
            <?php include "./views/header.php" ?>
        </div>

    <div class="sidebar">
        <?php include "./views/sidebar.php" ?>
    </div>
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
                                    echo '</div>';
                                } else {
                                ?>
                                    <p>
                                    <h1><?php echo $row10['postTitle']; ?><a href="../include/unsave.inc.php?saveID=<?php echo $saveCheck['saveID']; ?>"><img style="width: 20px; height: 20px;" src="./images/checkmark.png"></a></h1>
                                    </p>
                <?php
                                    echo '<p>Posted on ' . $row10['postDate'] . '</p><br>';
                                    echo '<p>' . $row10['postCont'] . '</p>';
                                    echo '</div>';
                                }
                            }
                        }
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
    </center>

    <?php


    ?>
    <div class="comments"></div>
    <?php
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
