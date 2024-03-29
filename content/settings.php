<?php
ob_start();
require_once "../include/connect.inc.php";
include_once "../include/user_info.inc.php";
//include_once "../include/auth_profile.inc.php"

$username = $_GET['username'];

if (($user_info == null) || ($user_info['username'] != $username)) {
    http_response_code(404);
    include("./404.php");
    die();
}

$roles_arr = array(
    'admin' => $user_info['admin'],
    'advertiser' => $user_info['advertiser'],
    'designer' => $user_info['designer'],
    'writer' => $user_info['writer'],
    );

// convert array into a json string
$roles_str = json_encode($roles_arr);
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

        <script src="./js/profile.js"></script>

        <title>BlogBase Settings</title>
    </head>

    <?php
    // create a js object using the json string
    echo "<script>var roles_str = JSON.parse('" . $roles_str . "');</script>"
    ?>

    <body onload="load_profile('<?php echo $user_info['profile_picture']; ?>', roles_str)">
        <div class="header">
            <?php include "./views/header.php" ?>
        </div>
        <div class="sidebar">
            <?php include "./views/sidebar.php" ?>
        </div>

        <div class="container">
            <div class="row mt-3 gx-xl-5">
                <div class="col-10 col-lg mx-auto text-center">
                    <img class="profile-img rounded-circle" id="profile-picture" src="./uploads/profile_pictures/<?php echo $user_info['profile_picture']; ?>">
                </div>

                <div class="col-9 mx-auto">
                    <ul class="list-inline text-xxl-start text-center">
                        <li class="list-inline-item m-0 me-2">
                            <div class="display-6"><?php echo $user_info['username']; ?></div>
                        </li>
                        <li class="list-inline-item align-text-bottom mt-2" id="role-list">
                            <ul class="list-inline">
                                <li class="list-inline-item me-0">
                                    <button class="btn badge bg-primary rounded-pill role-badge">reader</button>
                                </li>
                                <li class="list-inline-item me-0">
                                    <button class="btn badge bg-success rounded-pill role-badge">admin</button>
                                </li>
                                <li class="list-inline-item me-0">
                                    <button class="btn badge bg-danger rounded-pill role-badge">advertiser</button>
                                </li>
                                <li class="list-inline-item me-0">
                                    <button class="btn badge bg-warning rounded-pill role-badge">designer</button>
                                </li>
                                <li class="list-inline-item">
                                    <button class="btn badge bg-info rounded-pill role-badge">writer</button>
                                </li>
                            </ul>
                        </li>
                    </ul>

                    <form method="post" enctype="multipart/form-data" class="mt-3 profile-form" action="../include/update_account.inc.php">
                        <input name="username" value="<?php echo $username; ?>" type="hidden">
                        <input name="profile-picture" id="profile-picture-input" type="hidden" value="1">

                        <hr>
                        <div>
                            <label class="form-label profile-label" for="bio-input">Change Biography</label>
                            <textarea class="form-control profile-input" type="text" id="bio-input" name="biography" maxlength="256" oninput="update()"><?php echo $user_info['biography']; ?></textarea>
                        </div>

                        <hr>
                        <label class="form-label profile-label" for="profile-image-input">Change Profile Picture</label>
                        <div class="input-group profile-input">
                            <input class="form-control rounded" type="file" name="file" id="profile-image-input" onchange="preview_profile(event, '<?php echo $user_info['profile_picture']; ?>')">
                            <button class="btn btn-outline-danger" type="button" id="remove-profile-picture-btn" onclick="remove_profile_picture()" hidden>Remove</button>
                        </div>

                        <hr>
                        <div class="container p-0">
                            <div class="row m-0 profile-input">
                                <label class="form-label profile-label p-0">Change Personal Information</label>

                                <div class="col p-0">
                                    <label class="form-label" for="first-name-input">First Name</label>
                                    <input class="form-control" type="text" id="first-name-input" name="first_name" value="<?php echo $user_info['first_name']; ?>" oninput="update()">
                                </div>

                                <div class="col pe-0">
                                    <label class="form-label" for="last-name-input">Last Name</label>
                                    <input class="form-control" type="text" id="last-name-input" name="last_name" value="<?php echo $user_info['last_name']; ?>" oninput="update()">
                                </div>
                            </div>

                            <div class="row m-0 mt-3 profile-input">
                                <div class="col p-0">
                                    <label class="form-label" for="email-input">Email</label>
                                    <input class="form-control" type="email" id="email-input" name="email" value="<?php echo $user_info['email']; ?>" oninput="update()">
                                </div>
                            </div>
                        </div>

                        <hr>
                        <div class="row m-0 profile-input">
                            <label class="form-label profile-label p-0">Change Password</label>

                            <div class="col p-0">
                                <label class="form-label" for="old-password-input">Old Password</label>
                                <input class="form-control" type="password" id="old-password-input" name="old_password" oninput="update();">
                            </div>

                            <div class="col pe-0">
                                <label class="form-label" for="new-password-input">New Password</label>
                                <input class="form-control" type="password" id="new-password-input" name="new_password" oninput="update();">
                            </div>
                        </div>

                        <hr>
                        <div class="row m-0 profile-input">

                            <div class="col p-0 mb-2">
                                <label class="form-label" for="delete-account">Delete Account</label><br>
                                <button class="btn btn-danger" name="delete_account" id="delete-account" type="submit">Delete</button>
                            </div>

                            <div class="col pe-0">
                                <div class="float-end" id="update-btns" hidden>
                                    <label class="form-label">Update Account</label><br>

                                    <ul class="list-inline">
                                        <li class="list-inline-item">
                                            <button class="btn btn-outline-dark" name="update_account" type="submit">Update</button>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="./settings.php?username=<?php echo $user_info['username']; ?>" class="text-decoration-none">
                                                <button class="btn btn-outline-primary" type="button">Cancel</button>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
