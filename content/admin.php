<?php
require_once "../include/connect.inc.php";
include_once "../include/user_info.inc.php";

ob_start();

// check if the current user has admin authorization
if ($user_info['admin'] != true) {
    http_response_code(404);
    include("./404.php");
    die();
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

        <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
        <script src="./js/admin.js" type="text/javascript"></script>

        <title>BlogBase</title>
    </head>

    <body>
        <div class="header">
            <?php include "./views/header.php" ?>
        </div>
        <div class="sidebar">
            <?php include "./views/sidebar.php" ?>
        </div>

        <div class="container mt-3 mb-3 text-center">
            <h1>Admin Dashboard</h1>
        </div>

        <div class="col-10 col-lg-7 mx-auto mt-3">
            <hr>
            <ul class="nav nav-tabs" id="users-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="registered-tab" data-bs-toggle="tab" data-bs-target="#registered-tab-pane" type="button" role="tab" aria-controls="registered-tab-pane" aria-selected="true">Registered Users</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="unregistered-tab" data-bs-toggle="tab" data-bs-target="#unregistered-tab-pane" type="button" role="tab" aria-controls="unregistered-tab-pane" aria-selected="false">Unregistered Users</button>
                </li>
            </ul>

            <div class="tab-content" id="users-tab-content">
                <div class="tab-pane fade show active" id="registered-tab-pane" role="tabpanel" aria-labelledby="registered-tab" tabindex="0">
                    <?php
                    $reg_users_query = "SELECT *
                                        FROM Users
                                        WHERE approved = 1";
                    $reg_users_result = mysqli_query($con, $reg_users_query);
                    ?>
                    <table class="table text-start">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Username</th>
                                <th scope="col">First</th>
                                <th scope="col">Last</th>
                                <th scope="col">Email</th>
                                <th scope="col">Roles</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($reg_users_result->num_rows == 0) { ?>
                                <tr>
                                    <td>
                                        No registered users...
                                    </td>

                                    <td>
                                    </td>

                                    <td>
                                    </td>

                                    <td>
                                    </td>

                                    <td>
                                    </td>

                                    <td>
                                    </td>

                                    <td>
                                    </td>
                                </tr>
                            <?php } else { ?>
                                <?php while ($current_row = $reg_users_result->fetch_assoc()) { ?>
                                    <form method="post">
                                        <tr>
                                            <td>
                                                <span class="user-info"><?php echo $current_row['user_id'] ?></span>
                                            </td>
                                            <td>
                                                <span class="user-info"><?php echo $current_row['username'] ?></span>
                                                <input class="form-control user-info-form" type="text" id="username" name="username" value="<?php echo $current_row['username']; ?>" required hidden>
                                            </td>
                                            <td>
                                                <span class="user-info"><?php echo $current_row['first_name'] ?></span>
                                                <input class="form-control user-info-form" type="text" id="first_name" name="first_name" value="<?php echo $current_row['first_name']; ?>" required hidden>
                                            </td>
                                            <td>
                                                <span class="user-info"><?php echo $current_row['last_name'] ?></span>
                                                <input class="form-control user-info-form" type="text" id="last_name" name="last_name" value="<?php echo $current_row['last_name']; ?>" required hidden>
                                            </td>
                                            <td>
                                                <span class="user-info"><?php echo $current_row['email'] ?></span>
                                                <input class="form-control user-info-form" type="text" id="email" name="email" value="<?php echo $current_row['email']; ?>" required hidden>
                                            </td>
                                            <td>
                                                <?php
                                                if ($current_row['admin'] == 1) {
                                                    echo "<a class='btn badge bg-success rounded-pill text-decoration-none' href='#'>admin</a>";
                                                }
                                                if ($current_row['designer'] == 1) {
                                                    echo "<a class='btn badge bg-warning rounded-pill text-decoration-none' href='#'>designer</a>";
                                                }
                                                if ($current_row['reader'] == 1) {
                                                    echo "<a class='btn badge bg-primary rounded-pill text-decoration-none' href='#'>reader</a>";
                                                }
                                                if ($current_row['writer'] == 1) {
                                                    echo "<a class='btn badge bg-info rounded-pill text-decoration-none' href='#'>writer</a>";
                                                }
                                                if ($current_row['advertiser'] == 1) {
                                                    echo "<a class='btn badge bg-danger rounded-pill text-decoration-none' href='#'>advertiser</a>";
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <a class="btn btn-outline-primary" id="edit-btn" href="#" onclick="edit_user()">Edit</a>
                                                <a class="btn btn-outline-danger" href="../include/delete_user.inc.php?id=<?php echo $current_row['user_id']; ?>">Delete</a>
                                            </td>
                                        </tr>
                                    </form>
                                <?php } ?>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>

                <div class="tab-pane fade" id="unregistered-tab-pane" role="tabpanel" aria-labelledby="unregistered-tab" tabindex="0">
                    <?php
                    $unreg_users_query = "SELECT *
                                          FROM Users
                                          WHERE approved != 1";
                    $unreg_users_result = mysqli_query($con, $unreg_users_query);
                    ?>
                    <table class="table text-start">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Username</th>
                                <th scope="col">First</th>
                                <th scope="col">Last</th>
                                <th scope="col">Email</th>
                                <th scope="col">Roles</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($unreg_users_result->num_rows == 0) { ?>
                                <tr>
                                    <td>
                                        No unregistered users...
                                    </td>

                                    <td>
                                    </td>

                                    <td>
                                    </td>

                                    <td>
                                    </td>

                                    <td>
                                    </td>

                                    <td>
                                    </td>

                                    <td>
                                    </td>
                                </tr>
                            <?php } else { ?>
                                <?php while ($current_row = $unreg_users_result->fetch_assoc()) { ?>
                                    <tr>
                                        <td>
                                            <?php echo $current_row['user_id'] ?>
                                        </td>
                                        <td>
                                            <?php echo $current_row['username'] ?>
                                        </td>
                                        <td>
                                            <?php echo $current_row['first_name'] ?>
                                        </td>
                                        <td>
                                            <?php echo $current_row['last_name'] ?>
                                        </td>
                                        <td>
                                            <?php echo $current_row['email'] ?>
                                        </td>
                                        <td>
                                            <?php
                                            if ($current_row['admin'] == 1) {
                                                echo "<a class='btn badge bg-success rounded-pill text-decoration-none' href='#'>admin</a>";
                                            }
                                            if ($current_row['designer'] == 1) {
                                                echo "<a class='btn badge bg-warning rounded-pill text-decoration-none' href='#'>designer</a>";
                                            }
                                            if ($current_row['reader'] == 1) {
                                                echo "<a class='btn badge bg-primary rounded-pill text-decoration-none' href='#'>reader</a>";
                                            }
                                            if ($current_row['writer'] == 1) {
                                                echo "<a class='btn badge bg-info rounded-pill text-decoration-none' href='#'>writer</a>";
                                            }
                                            if ($current_row['advertiser'] == 1) {
                                                echo "<a class='btn badge bg-danger rounded-pill text-decoration-none' href='#'>advertiser</a>";
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <a class="btn btn-outline-primary" href="../include/approve_user.inc.php?id=<?php echo $current_row['user_id']; ?>">Approve</a>
                                            <a class="btn btn-outline-danger" href="../include/delete_user.inc.php?id=<?php echo $current_row['user_id']; ?>">Deny</a>
                                            <a class="btn btn-outline-danger" href="../include/delete_user.inc.php?id=<?php echo $current_row['user_id']; ?>">Delete</a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <script>
        $(document).ready(function() {
            $('button[data-bs-toggle="tab"]').on('click', function(e) {
                localStorage.setItem('activeTab', e.target.dataset.bsTarget);
            });
            var activeTab = localStorage.getItem('activeTab');
            if (activeTab) {
                const triggerEl = document.querySelector(`button[data-bs-target="${activeTab}"]`);
                if (triggerEl) {
                    bootstrap.Tab.getOrCreateInstance(triggerEl).show()
                }
            }
        });
        </script>
    </body>
</html>
