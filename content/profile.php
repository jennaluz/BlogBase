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

if (isset($_GET['username'])) {
    // user wants to look up a specific profile
    $username = $_GET['username'];

    $user_query = "SELECT *
                   FROM Users
                   WHERE username = '$username'";

    $user_result = mysqli_query($con, $user_query);
    $user_prof = $user_result->fetch_assoc();
} else {
    if ($user_info) {
        // user is logged in
        $username = $user_info['username'];
        $user_query = "SELECT *
                       FROM Users
                       WHERE username = '$username'";

        $user_result = mysqli_query($con, $user_query);
        $user_prof = $user_result->fetch_assoc();
    } else {
        // user is not logged in
        http_response_code(404);
        include("./404.php");
        die();
    }
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

        <script src="./js/save_article.js"></script>
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

                    <?php
                    $published_query = "SELECT Articles.article_id, Articles.title, Articles.description, Articles.lead_image,
                                        Articles.content, UNIX_TIMESTAMP(Articles.submit_date) as submit_date,
                                        Articles.approved, Articles.submitted, Articles.author_id
                                        FROM Users join Articles on Users.user_id = Articles.author_id
                                        WHERE Users.user_id = " . $user_prof['user_id'] . " AND Articles.approved = 1";
                    $published_result = mysqli_query($con, $published_query);

                    ?>

                    <ul class="nav nav-tabs" id="users-tab" role="tablist">
                        <?php if ($published_result->num_rows > 0) {?>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="published-tab" data-bs-toggle="tab" data-bs-target="#published-tab-pane" type="button" role="tab" aria-controls="published-tab-pane" aria-selected="true">Published Articles</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="saved-tab" data-bs-toggle="tab" data-bs-target="#saved-tab-pane" type="button" role="tab" aria-controls="saved-tab-pane" aria-selected="false">Saved Articles</button>
                            </li>
                        <?php } else { ?>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="saved-tab" data-bs-toggle="tab" data-bs-target="#saved-tab-pane" type="button" role="tab" aria-controls="saved-tab-pane" aria-selected="false">Saved Articles</button>
                            </li>
                        <?php } ?>
                    </ul>

                    <div class="tab-content" id="users-tab-content">

                        <?php if ($published_result->num_rows > 0) {?>
                            <div class="tab-pane fade show active" id="published-tab-pane" role="tabpanel" aria-labelledby="published-tab" tabindex="0">
                        <?php } else { ?>
                            <div class="tab-pane fade" id="published-tab-pane" role="tabpanel" aria-labelledby="published-tab" tabindex="0">
                        <?php } ?>
                                <table class="table text-start">
                                    <tbody>
                                        <?php while ($current_row = $published_result->fetch_assoc()) { ?>
                                            <tr>
                                                <td class="text-nowrap">
                                                    <?php echo date("M. d, Y", $current_row['submit_date']) ?>
                                                </td>
                                                <td>
                                                    <h4>
                                                        <a class="text-reset text-decoration-none" href="./article.php?id=<?php echo $current_row['article_id'] ?>">
                                                            <?php echo $current_row['title'] ?>
                                                        </a>
                                                    </h4>
                                                    <?php echo $current_row['description'] ?>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>

                        <?php
                        $saved_articles_query = "SELECT UNIX_TIMESTAMP(saved_date) as saved_date, title, article_id, description
                                                 FROM Articles NATURAL JOIN SavedArticles
                                                 WHERE user_id = '" . $user_prof['user_id'] . "' AND approved = true";
                        $saved_articles_result = mysqli_query($con, $saved_articles_query);
                        ?>

                        <?php if ($published_result->num_rows > 0) {?>
                            <div class="tab-pane fade" id="saved-tab-pane" role="tabpanel" aria-labelledby="saved-tab" tabindex="0">
                        <?php } else { ?>
                            <div class="tab-pane fade show active" id="saved-tab-pane" role="tabpanel" aria-labelledby="saved-tab" tabindex="0">
                        <?php } ?>
                                <table class="table text-start">
                                    <thead>
                                    </thead
                                    <tbody>
                                        <?php if ($saved_articles_result->num_rows == 0) { ?>
                                            <tr>
                                                <h4 class="m-2">No saved articles...</h4>
                                            </tr>
                                        <?php } else {?>
                                            <?php while ($current_row = $saved_articles_result->fetch_assoc()) { ?>
                                                <tr id="article-<?php echo $current_row['article_id'] ?>">
                                                    <td class="text-nowrap">
                                                        <?php echo date("M. d, Y", $current_row['saved_date']) ?>
                                                    </td>
                                                    <td>
                                                        <h4>
                                                            <a class="text-reset text-decoration-none" href="./article.php?id=<?php echo $current_row['article_id'] ?>">
                                                                <?php echo $current_row['title'] ?>
                                                            </a>
                                                        </h4>
                                                        <?php echo $current_row['description'] ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        if (isset($_SESSION['user_info'])) {
                                                            $saved_query = "SELECT article_id, user_id
                                                                            FROM SavedArticles
                                                                            WHERE user_id = '" . $user_info['user_id'] . "' AND article_id = '" . $current_row['article_id'] . "';";
                                                            $saved_result = mysqli_query($con, $saved_query); ?>
                                                            <button onclick="change_bookmark_icon(<?php echo $current_row['article_id'] ?>)" id="bookmark-<?php echo $current_row['article_id'] ?>" class="btn p-1">
                                                            <?php if ($saved_result->num_rows == 1) { ?>
                                                                <span id="bookmark-icon-<?php echo $current_row['article_id'] ?>" class="fa-solid fa-bookmark">
                                                            <?php } else { ?>
                                                                <span id="bookmark-icon-<?php echo $current_row['article_id'] ?>" class="fa-regular fa-bookmark">
                                                            <?php } ?>
                                                            </button>
                                                        <?php } else { ?>
                                                            <a href="./login.php" id="bookmark" class="btn p-1">
                                                                <span id="bookmark-icon" class="fa-regular fa-bookmark">
                                                            </a>
                                                        <?php } ?>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
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
</html/>
