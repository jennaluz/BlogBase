<?php
require_once "../include/connect.inc.php";
include_once "../include/user_info.inc.php";

ob_start();

// check if user is a designer
if ($user_info['designer'] == false) {
    // send to "you don't have access page"
    echo "You don't have access";
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, intitial-scale=1">

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
        <link rel="stylesheet" href="./css/styles.css">

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

        <title>BlogBase Designer</title>
    </head>

    <body>
        <div class="header">
            <?php include "./views/header.php" ?>
        </div>
        <div class="sidebar">
            <?php include "./views/sidebar.php" ?>
        </div>

        <ul class="nav nav-tabs" id="artical-approval-tabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="unapproved-articles-tab" data-bs-toggle="tab" data-bs-target="#unapproved-articles-tab-pane" type="button" role="tab" aria-controls="unapproved-articles-tab-pane" aria-selected="true">Unapproved Articles</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="approved-articles-tab" data-bs-toggle="tab" data-bs-target="#approved-articles-tab-pane" type="button" role="tab" aria-controls="approved-articles-tab-pane" aria-selected="true">Approved Articles</button>
            </li>
        </ul>

        <div class="tab-content" id="article-approval-content">
            <div class="tab-pane fade show active" id="unapproved-articles-tab-pane" role="tabpanel" aria-labelledby="unapproved-articles-tab" tabindex="0">
                <?php
                $unapproved_query = "SELECT title, submit_date
                                     FROM Articles
                                     WHERE approved = 0";
                $unapproved_result = mysqli_query($con, $unapproved_query);
                $unapproved_articles = $unapproved_result->fetch_all(MYSQLI_BOTH);
                ?>

                <table class="table">
                    <thead>
                        <th scope="col"></th>
                        <th scope="col"></th>
                    </thead>
                </table>
            </div>
        </div>
    </body>
</html>
