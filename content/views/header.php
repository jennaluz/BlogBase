<?php /* ?>
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
    <a href="../include/logout.inc.php" style="padding: 10px">Logout</a>
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
<?php */ ?>

<nav class="navbar navbar-expand-md bg-light shadow-sm">
     <div class="container-fluid">

        <div class="collapse navbar-collapse order-1 order-md-0 col-4" id="navbar-collapsed-menu">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="btn d-md-block d-none " data-bs-toggle="offcanvas" href="#offcanvas-sidebar" role="button" aria-controls="offcanvas-sidebar">
                        <span class="fa-solid fa-bars"></span>
                    </a>
                </li>
                <li class="nav-item">
                    <div class="input-group rounded">
                        <a class="btn input-group-text rounded" href="./search.php" type="button">
                            <i class="fa-solid fa-search"></i>
                        </a>
                        <input class="form-control rounded" type="search" placeholder="Search" aria-label="Search">
                    </div>
                </li>
<!--
-->
<!--
            <button class="btn" type="submit">
                <span class="fa-solid fa-magnifying-glass"></span>
            </button>
-->
<!--
            <form class="input-group rounded" action="./search.php" method="POST" id="searchForm">
                <button class="btn input-group-text border-0" type="submit">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
                <input class="form-control rounded" type="search" placeholder="Search" aria-label="Search">
            </form>
                </li>
                <li class="nav-item">
                    <input class="form-control" type="search" placeholder="Search" aria-label="Search">
                </li>
-->
            </ul>
        </div>

        <div class="col-4 p-0 d-md-none d-block ">
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-collapsed-menu" aria-controls="navbar-collapsed-menu" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>

            <a class="navbar-brand col-4 mx-auto text-center order-0 order-md-1" href="./index.php">BlogBase</a>

        <!-- necessary for center-spacing the logo on smaller screens -->
        <div class="col-4 p-0 d-md-none d-block">
        </div>

        <div class="collapse navbar-collapse order-2 col-4" id="navbar-collapsed-menu">
            <ul class="navbar-nav ms-auto">
                <?php session_start() ?>
                <?php if ($user_info['admin'] == true) { ?>
                <li class="nav-item">
                    <a class="nav-link" href="./admin.php">admin</a>
                </li>
                <?php } ?>
                <?php if ($user_info['advertiser'] == true) { ?>
                <li class="nav-item">
                    <a class="nav-link" href="./ads.php">ads</a>
                </li>
                <?php } ?>
                <?php if ($user_info['writer'] == true) { ?>
                <li class="nav-item">
                    <a class="nav-link" href="./create.php">create</a>
                </li>
                <?php } ?>
                <?php if ($user_info['designer'] == true) { ?>
                <li class="nav-item">
                    <a class="nav-link" href="./design.php">design</a>
                </li>
                <?php } ?>
                <?php if ($user_info['reader'] == true) { ?>
                <li class="nav-item">
                    <a class="nav-link" href="./saved.php">saved</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../include/logout.inc.php">logout</a>
                </li>
                <?php } else {?>
                <li class="nav-item">
                    <a class="nav-link" href="./login.php">login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./register.php">register</a>
                </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</nav>
