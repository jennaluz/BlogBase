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

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse order-1 order-md-0" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto">
        <li class="nav-item">
            <a class="btn" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">
                <span class="fa-solid fa-bars"></span>
            </a>
        </li>
        <li class="nav-item">
<!--
            <button class="btn" type="submit">
                <span class="fa-solid fa-magnifying-glass"></span>
            </button>
-->
            <a class="btn" href="./search.php" role="button">
                <span class="fa-solid fa-magnifying-glass"></span>
            </a>
<!--
            <form action="./search.php" method="POST" id="searchForm">
                <input class="form-control" type="search" placeholder="Search" aria-label="Search">
                <button class="btn" type="submit">
                    <span class="fa-solid fa-magnifying-glass"></span>
                </button>
            </form>
-->
        </li>
        <li class="nav-item">
            <input class="form-control" type="search" placeholder="Search" aria-label="Search">
        </li>
      </ul>
    </div>

    <a class="navbar-brand mx-auto text-center order-0 order-md-1" href="./index.php">BlogBase</a>

    <div class="collapse navbar-collapse order-2" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
            <a class="nav-link" href="./admin.php">admin
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="./ads.php">ads
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="./create.php">create
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="./design.php">design
            </a>
        </li>
        <li class="nav-item">
        <?php
        session_start();
        if (isset($_SESSION["username"])) { ?>
            <a class="nav-link" href="../include/logout.inc.php">logout</a>
        <?php } else { ?>
            <a class="nav-link" href="./login.php">login</a>
        <?php } ?>
        </li>
      </ul>
    </div>

  </div>
</nav>
