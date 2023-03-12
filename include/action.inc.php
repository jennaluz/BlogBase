<?php
require_once "./connect.inc.php";

if(isset($_REQUEST['replyCont'])){
    // redirection purposes
    $loggedInUser = $_SESSION["username"];

    // get the comment id for the comment that we are replying to
    $COMMENTID = $realCommentId;
    $replyCont = $_REQUEST['replyCont'];
    $content5 = $realContent;
    $newreply = "INSERT INTO `Comments` (username, comment_id, parent_id, content)
                 VALUES ('$loggedInUser', '$COMMENTID', '$replyCont', '$content5')";
    $resultReply = mysqli_query($con, $newreply);

    if ($resultReply) {
        header("Location: ../content/post1.php?id=$realPostID");
    } else {
        echo "<h4>There was an error submitting the query...</h4>";
    }
?>
