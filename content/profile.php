<?php
ob_start();
require_once "../include/connect.inc.php";
include_once "../include/user_info.inc.php";

/*
if (($user_info == null)) {
    echo "You can't be here";
    // redirect to login page?
}
 */

$username = $_GET['username'];

$user_query = "SELECT *
               FROM Users
               WHERE username = '$username'";

$user_result = mysqli_query($con, $user_query);
$user_prof = $user_result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
        <link rel="stylesheet" href="./css/styles.css">

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>

        <title>BlogBase Profile</title>
    </head>

    <body>
        <div class="header">
            <?php include "./views/header.php" ?>
        </div>
        <div class="sidebar">
            <?php include "./views/sidebar.php" ?>
        </div>

        <div class="container">
            <div class="row mt-3 gx-xl-5">
                <div class="col-10 col-lg mx-auto text-center">
                    <img class="profile-img rounded-circle" id="profile-picture" src="./uploads/profile_pictures/<?php echo $user_prof['profile_picture']; ?>">
                </div>

                <div class="col-9 mx-auto">
                    <ul class="list-inline text-xxl-start text-center">
                        <li class="list-inline-item m-0 me-3">
                            <div class="display-6"><?php echo $user_prof['username']; ?></div>
                        </li>
                        <?php if ($username != $user_info['username']) { ?>
                            <li class="list-inline-item align-text-bottom">
                                <button type="button" class="btn btn-outline-dark btn-sm">Follow</button>
                            </li>
                        <?php }?>
                        <li class="list-inline align-text-middle mt-2" id="role-list">
                            <ul class="list-inline">
                                <li class="list-inline-item me-0">
                                    <a class="btn badge bg-primary rounded-pill role-badge text-decoration-none" href="./index.php">reader</a>
                                </li>
                                <?php if ($user_prof['admin'] == 1) { ?>
                                    <li class="list-inline-item me-0">
                                        <a class="btn badge bg-success rounded-pill role-badge text-decoration-none" href="./admin.php">admin</a>
                                    </li>
                                <?php } ?>
                                <?php if ($user_prof['advertiser'] == 1) { ?>
                                    <li class="list-inline-item me-0">
                                        <a class="btn badge bg-danger rounded-pill role-badge text-decoration-none" href="./ads.php">advertiser</a>
                                    </li>
                                <?php } ?>
                                <?php if ($user_prof['designer'] == 1) { ?>
                                    <li class="list-inline-item me-0">
                                        <a class="btn badge bg-warning rounded-pill role-badge text-decoration-none" href="./design.php">designer</a>
                                    </li>
                                <?php } ?>
                                <?php if ($user_prof['writer'] == 1) { ?>
                                    <li class="list-inline-item">
                                        <a class="btn badge bg-info rounded-pill role-badge text-decoration-none" href="./writer.php">writer</a>
                                    </li>
                                <?php } ?>
                            </ul>
                        </li>
                    </ul>

                    <h5 class="px-2 text-xxl-start text-center">
                        <?php echo $user_prof['biography']; ?>
                    </h5>

                    <hr>
                </div>
            </div>
        </div>
    </body>
</html/>
