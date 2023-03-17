<?php
require_once "../include/connect.inc.php";
include_once "../include/user_info.inc.php";

ob_start();

// get information about this article
$requested_id = $_GET['id'];
$article_query = "SELECT article_id, title, content, UNIX_TIMESTAMP(submit_date) as submit_date, approved
                  FROM Articles
                  WHERE article_id = '" . $requested_id . "'";
$article_result = mysqli_query($con, $article_query);
$article_info = $article_result->fetch_assoc();

if ($article_info == null) {
    // send to 404 error page
    //header('Location: ./error_404.php');
    //ob_end_flush();
    echo "doesn't exist 404";
}

// check if user is accessing unapproved article w/o designer role
if ($article_info['approved'] != true && $user_info['designer'] != true) {
    // send to "you don't have access" page
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

        <title><?php echo $article_info['title']; ?></title>
    </head>

    <body>
        <div class="header">
            <?php include "./views/header.php" ?>
        </div>
        <div class="sidebar">
            <?php include "./views/sidebar.php" ?>
        </div>

        <div class="col-10 col-lg-7 mx-auto mt-3">
            <div id="article-head">
                <?php if ($user_info['designer'] == true) { ?>
                    <ul class="list-inline">
                    <?php if ($article_info['approved'] == false) { ?>
                        <li class="list-inline-item align-middle">
                            <a class="btn btn-outline-primary px-2 py-1" type="button" href="../include/article_approval.inc.php?approve_id=<?php echo $article_info['article_id']; ?>">Approve</a>
                        </li>
                        <li class="list-inline-item align-middle">
                            <a class="btn btn-outline-danger px-2 py-1" type="button" href="../include/article_approval.inc.php?deny_id=<?php echo $article_info['article_id']; ?>">Deny</a>
                        </li>
                    <?php } else { ?>
                        <li class="list-inline-item align-middle">
                            <a class="btn btn-outline-danger px-2 py-1" type="button" href="../include/article_approval.inc.php?revoke_id=<?php echo $article_info['article_id']; ?>">Revoke</a>
                        </li>
                    <?php } ?>
                    </ul>
                <?php } ?>

                <ul class="list-inline">
                    <li class="list-inline-item align-middle">
                    <!-- article author will go here -->
                        <?php //echo date("M. d, Y", $article_info['author']) ?>
                        Chad Flemmington
                    </li>
                    <li class="list-inline-item align-middle">
                        <?php echo date("M. d, Y", $article_info['submit_date']) ?>
                    </li>
                    <?php if ($article_info['approved'] == true) { ?>
                        <li class="list-inline-item align-middle">
                            <i class="fa-solid fa-comment"></i>
                        </li>
                        <li class="list-inline-item align-middle">
                            <i class="fa-regular fa-comment"></i>
                        </li>
                        <li class="list-inline-item align-middle">
                            <?php
                            if (isset($_SESSION['user_info'])) {
                                $saved_query = "SELECT article_id, user_id
                                                FROM SavedArticles
                                                WHERE user_id = '" . $user_info['user_id'] . "' AND article_id = '" . $article_info['article_id'] . "';";
                                $saved_result = mysqli_query($con, $saved_query);
                                if ($saved_result->num_rows == 1) {
                            ?>
                                    <a class="fa-solid fa-bookmark text-reset" href="../include/save_article.inc.php?unsave_id=<?php echo $article_info['article_id']; ?>"></a>
                                <?php } else { ?>
                                    <a class="fa-regular fa-bookmark text-reset" href="../include/save_article.inc.php?save_id=<?php echo $article_info['article_id']; ?>"></a>
                                <?php } ?>
                            <?php } else { ?>
                                <a class="fa-regular fa-bookmark text-reset" href="./login.php"></a>
                            <?php } ?>
                        </li>
                        <li class="list-inline-item align-middle">
                            <i class="fa-solid fa-newspaper"></i>
                        </li>
                    <?php } ?>
                </ul>

                <ul class="list-inline">
                    <li class="list-inline-item align-middle">
                        <h1 class="m-0"><?php echo $article_info['title']; ?></h1>
                    </li>
                </ul>
            </div>

            <hr>

            <div id="article-body">
                <?php echo $article_info['content']; ?>
            </div>
        </div>
    </body>
</html>
