<?php
include_once "../include/user_info.inc.php";
?>
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
                    <form method="get" action="./search.php" class="input-group rounded">
                        <button class="btn input-group-text rounded" type="submit">
                            <i class="fa-solid fa-search"></i>
                        </button>
                        <input class="form-control rounded" name="query" type="search" placeholder="Search" aria-label="Search">
                    </form >
                </li>
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
                <?php if ($user_info == null) {?>
                <li class="nav-item">
                    <a class="btn btn-outline-dark mx-1" href="./login.php">login</a>
                </li>
                <li class="nav-item">
                    <a class="btn btn-outline-primary mx-1" href="./register.php">register</a>
                </li>
                <?php } ?>
                <?php if (isset($user_info['username'])) { ?>
                <li class="nav-item">
                    <div class="dropdown">
                        <button class="btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="./uploads/profile_pictures/anonymous.jpg" class="rounded-circle" style="width:35px; height:35px;">
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item" href="./profile.php">
                                    <?php echo $user_info['first_name'] . " " . $user_info['last_name'] ?><br>
                                    <?php echo "@" . $user_info['username'] ?>
                                </a>
                            </li>
                            <hr>
                            <li>
                                <a class="dropdown-item" href="./saved.php">Saved Articles</a>
                            </li>
                            <?php if ($user_info['admin'] == true) { ?>
                            <li>
                                <a class="dropdown-item" href="./admin.php">Admin Dashboard</a>
                            </li>
                            <?php } ?>
                            <?php if ($user_info['advertiser'] == true) { ?>
                            <li>
                                <a class="dropdown-item" href="./ads.php">Advertiser Dashboard</a>
                            </li>
                            <?php } ?>
                            <?php if ($user_info['writer'] == true) { ?>
                            <li>
                                <a class="dropdown-item" href="./writer.php">Writer Dashboard</a>
                            </li>
                            <?php } ?>
                            <?php if ($user_info['designer'] == true) { ?>
                            <li>
                                <a class="dropdown-item" href="./design.php">Designer Dashboard</a>
                            </li>
                            <?php } ?>
                            <hr>
                            <li>
                                <a class="dropdown-item" href="../include/logout.inc.php">Logout</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</nav>
