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
