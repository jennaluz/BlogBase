<?php
require_once "../include/connect.inc.php";
include_once "../include/user_info.inc.php";

ob_start();

$approved_articles_query = "SELECT UNIX_TIMESTAMP(submit_date) as submit_date, title, article_id, description
                            FROM Articles
                            WHERE approved = true
                            ORDER BY submit_date DESC";
$approved_articles_result = mysqli_query($con, $approved_articles_query);
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
        <script src="./js/save_article.js"></script>

        <title>BlogBase</title>
    </head>

    <body>
        <div class="header">
            <?php include "./views/header.php" ?>
        </div>
        <div class="sidebar">
            <?php include "./views/sidebar.php" ?>
        </div>

        <div class="mt-3 text-center">
            <h1>All Articles</h1>
        </div>

        <div class="col-10 col-lg-7 mx-auto mt-3">
            <hr>
            <table class="table text-start">
                <thead>
                </thead>
                <tbody>
                    <?php while ($current_row = $approved_articles_result->fetch_assoc()) { ?>
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
                </tbody>
            </table>
        </div>
    </body>
</html>
