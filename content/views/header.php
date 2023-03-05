<div class="nav-left flex-div">
    <img class="menu-icon" src="./images/menu_icon.png">
    <a href="./index.php"><img src="./images/logo1.png" class="logo" ></a>
</div>
<div class="nav-mid flex-div">
    <div class="search-box flex-div">
            <form action="./search.php" method="POST" id="searchForm">
            <input type="text/submit" name="search" placeholder="search"/> <img src="./images/search.png">
            </form>
    </div>
</div>

<?php
session_start();
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
} else {
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
