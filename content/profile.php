<?php
ob_start();
require_once "../include/connect.inc.php";
include_once "../include/user_info.inc.php";
//include_once "../include/auth_profile.inc.php"

if ($user_info == null) {
    echo "You can't be here";
    // redirect to login page?
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
        <link rel="stylesheet" href="./css/styles.css">

        <script src="./js/profile.js"></script>

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
            <div class="row mt-5">
                <div class="col">
                    <img class="profile-img rounded" id="profile-picture" src="./uploads/profile_pictures/<?php echo $user_info['profile_picture']; ?>">
                </div>

                <div class="col-9 pe-5">
                    <ul class="list-inline">
                        <li class="list-inline-item align-bottom">
                            <div class="display-6"><?php echo $user_info['username']; ?></div>
                        </li>
                        <li class="list-inline-item align-top">
                            <button class="btn btn-outline-dark mt-2">Follow</button>
                        </li>
                    </ul>

                    <form method="post" enctype="multipart/form-data" class="mt-3 mx-2">
                        <div>
                            <label class="form-label profile-label" for="profile-image-input">Change Profile Picture</label>
                            <input class="form-control" type="file" name="file" id="profile-image-input" onchange="preview_profile(event, '<?php echo $user_info['profile_picture']; ?>')">
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
        <script src="./js/script.js"></script>
    </body>
</html>
