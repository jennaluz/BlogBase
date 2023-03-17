<?php
require_once "../include/connect.inc.php";
include_once "../include/auth_session.inc.php";
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, intitial-scale=1">

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
        <link rel="stylesheet" href="./css/styles.css">

        <title>BlogBase</title>
    </head>

    <body>
        <div class="header">
            <?php include "./views/header.php" ?>
        </div>
        <div class="sidebar">
            <?php include "./views/sidebar.php" ?>
        </div>

        <div class="container">
            <?php
            // check if the current user has admin authorization
            $current_user = $_SESSION['username'];
            $test_auth_query = "SELECT username
                                FROM `Users`
                                WHERE username = '$current_user' AND admin = 1";
            $test_auth_result = mysqli_query($con, $test_auth_query);

            // if the user does have admin authorization
            if ($test_auth_result->num_rows > 0) {
            ?>

                <div class="container mt-5 mb-3 text-center">
                    <h1>Hello <?php echo $_SESSION['username'] ?>,</h1>
                </div>
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="registered-tab" data-bs-toggle="tab" data-bs-target="#registered-tab-pane" type="button" role="tab" aria-controls="registered-tab-pane" aria-selected="true">Registered Users</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="unregistered-tab" data-bs-toggle="tab" data-bs-target="#unregistered-tab-pane" type="button" role="tab" aria-controls="unregistered-tab-pane" aria-selected="false">Unregistered Users</button>
                    </li>
                </ul>

                <div class="tab-content" id="myTabContent">

                    <div class="tab-pane fade show active" id="registered-tab-pane" role="tabpanel" aria-labelledby="registered-tab" tabindex="0">
                        <?php
                        $reg_users_query = "SELECT user_id, username, first_name, last_name, email , admin, designer, writer, reader, advertiser
                                            FROM `Users`
                                            WHERE approved = 1";
                        $reg_users_result = mysqli_query($con, $reg_users_query);
                        $reg_users_array = $reg_users_result->fetch_all(MYSQLI_BOTH);
                        ?>
                        <table class="table text-center">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Username</th>
                                    <th scope="col">First Name</th>
                                    <th scope="col">Last Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Roles</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php for ($i = 0; $i < $reg_users_result->num_rows; $i++) { ?>
                                    <tr>
                                        <?php for ($j = 0; $j < 6; $j++) {  ?>
                                            <td>
                                                <?php
                                                if ($j > 4) {
                                                    //echo $reg_users_array[$i][$j];
                                                    //        <span class="badge badge-success rounded-pill d-inline">Active</span>
                                                    if ($reg_users_array[$i]["admin"] == 1) {
                                                        echo "<span class='badge bg-success rounded-pill d-inline'>admin</span>";
                                                    }
                                                    if ($reg_users_array[$i]["designer"] == 1) {
                                                        echo "<span class='badge bg-warning rounded-pill d-inline'>designer</span>";
                                                    }
                                                    if ($reg_users_array[$i]["reader"] == 1) {
                                                        echo "<span class='badge bg-primary rounded-pill d-inline'>reader</span>";
                                                    }
                                                    if ($reg_users_array[$i]["writer"] == 1) {
                                                        echo "<span class='badge bg-info rounded-pill d-inline'>writer</span>";
                                                    }
                                                    if ($reg_users_array[$i]["advertiser"] == 1) {
                                                        echo "<span class='badge bg-danger rounded-pill d-inline'>advertiser</span>";
                                                    }
                                                } else {
                                                    echo $reg_users_array[$i][$j];
                                                }
                                                ?>
                                            </td>
                                        <?php } ?>
                                            <td>
                                                <a href="../include/delete_user.inc.php?userid=<?php echo $reg_users_array[$i]["userid"]; ?>" class="btn btn-outline-danger">Delete</a>
                                            </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="tab-pane fade" id="unregistered-tab-pane" role="tabpanel" aria-labelledby="unregistered-tab" tabindex="0">
                        <?php
                        $unreg_users_query = "SELECT user_id, username, first_name, last_name, email, admin, designer, writer, reader, advertiser
                                              FROM `Users`
                                              WHERE approved != 1";
                        $unreg_users_result = mysqli_query($con, $unreg_users_query);
                        $unreg_users_array = $unreg_users_result->fetch_all(MYSQLI_BOTH);
                        ?>
                        <table class="table text-center">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Username</th>
                                    <th scope="col">First Name</th>
                                    <th scope="col">Last Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Admin</th>
                                    <th scope="col">Designer</th>
                                    <th scope="col">Writer</th>
                                    <th scope="col">Reader</th>
                                    <th scope="col">Advertiser</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php for ($i = 0; $i < $unreg_users_result->num_rows; $i++) { ?>
                                    <tr>
                                        <?php for ($j = 0; $j < $unreg_users_result->field_count; $j++) {  ?>
                                            <td>
                                                <?php echo $unreg_users_array[$i][$j] ?>
                                            </td>
                                        <?php } ?>
                                            <td>
                                                <a href="../include/approve_user.inc.php?userid=<?php echo $unreg_users_array[$i]["user_id"]; ?>" class="btn btn-outline-primary">Approve</a>
                                                <a href="../include/delete_user.inc.php?userid=<?php echo $unreg_users_array[$i]["user_id"]; ?>" class="btn btn-outline-danger">Deny</a>
                                            </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>

                </div>

            <?php
            }
            else {
            ?>
                <div class="container mt-5 mb-3 text-center">
                    <h3 class="display-7">You do not have access to the admin page.</h3>
                    <h3 class="display-7">Return <a href="./index.php">Home?</a></h3>
                </div>
    <?php } ?>
</div>
    <script src="./js/script.js"></script>
    </body>
</html>
