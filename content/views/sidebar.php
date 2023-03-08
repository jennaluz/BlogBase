<div class="shortcut-links">
    <a href="./index.php"><img src="./images/home.png"> Home </a></p>
    <a href="./hot.php"><p><img src="./images/hot.png"> Hot! </a></p>
    <a href="./saved.php"><p><img src="./images/saved.png"> Saved </a></p>
    <a href="./archived.php"><p><img src="./images/history.png"> Archived </a></p>
    <hr>
</div>
<div class="Authors">
    <center>
        <p><a href="./social.php">Social</a></p>
    </center>
<?php
session_start();
if(isset($_SESSION["username"])){
    $loggedInUser = $_SESSION["username"];
    $getUserID = "SELECT userid FROM users WHERE username='$loggedInUser'";
    $loggedOn = $con->query($getUserID);
    if($loggedOn->num_rows > 0) {
        while($row = $loggedOn->fetch_assoc()) {
            $realUserID = $row["userid"];
            $followList = "SELECT username FROM users, social_follow WHERE username!='$loggedInUser' and follower_id='$realUserID' and follow_id=1 and followed_user_id=userid";
            $getFollowList = $con->query($followList);
            if($getFollowList->num_rows > 0) {
                while($row1 = $getFollowList->fetch_assoc()) {

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


<a class="btn btn-primary" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">Link with href</a>
<button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
  Button with data-bs-target
</button>

<div class="offcanvas offcanvas-start" data-bs-backdrop="false" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="offcanvasExampleLabel">Offcanvas</h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
    <div>
        Page links will appear here
    </div>
  </div>
</div>
