<?php
//include_once('logic.php');
include_once "./connect.inc.php";

//require "./connect.inc.php";

if(isset($_REQUEST['replyCont'])){
  $loggedInUser = $_SESSION["username"];
  //the above is for redirection purposes
  $COMMENTID = $realCommentId;
  //get the comment id for the comment that we are replying to
  $replyCont = $_REQUEST['replyCont'];
  $content5 = $realContent;
  $newreply = "INSERT INTO `replys` (username, commentid, replyCont, content)
                VALUES ('$loggedInUser', '$COMMENTID', '$replyCont', '$content5')";
  $resultReply = mysqli_query($con, $newreply);
  if($resultReply){
    header("Location: ../content/post.php?id=$realPostID");
  }else{
    echo "<h4>There was an error submitting the query...</h4>";
  }
?>