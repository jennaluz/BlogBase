<?php /* ?>
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
<?php */ ?>

<?php include_once "../include/user_info.inc.php"; ?>

<div class="offcanvas offcanvas-start bg-light" data-bs-scroll="true" tabindex="-1" id="offcanvas-sidebar" aria-labelledby="offcanvas-sidebar-label">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvas-sidebar-label">Navigate</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div>
            <ul class="nav nav-pills flex-column mb-auto">
                <li class="nav-item d-md-none mb-2">
                    <form method="get" action="./search.php" class="input-group rounded">
                        <button class="btn input-group-text rounded" type="submit">
                            <i class="fa-solid fa-search"></i>
                        </button>
                        <input class="form-control rounded" name="query" type="search" placeholder="Search" aria-label="Search">
                    </form>
                    <hr>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="./index.php" aria-current="page">
                        <i class="fa-solid fa-house"></i>
                         Home
                    </a>
                </li
                <li class="nav-item">
                    <a class="nav-link link-dark" href="#">
                        <i class="fa-solid fa-tag"></i>
                        Tags
                    </a>
                </li
            </ul>
        </div>
    </div>
</div>
