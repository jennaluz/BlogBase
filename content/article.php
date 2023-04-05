<?php
require_once "../include/connect.inc.php";
include_once "../include/user_info.inc.php";

ob_start();

// get information about this article
$requested_id = $_GET['id'];
$article_query = "SELECT Articles.article_id, Articles.title, Articles.description,
                         Articles.content, UNIX_TIMESTAMP(Articles.submit_date) as submit_date,
                         Articles.approved, Articles.author_id, Users.first_name, Users.last_name
                  FROM Articles INNER JOIN Users ON Articles.author_id = Users.user_id
                  WHERE Articles.article_id = $requested_id";
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

if ($user_info['user_id'] == $article_info['author_id']) {
    $writer = true;
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

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
        <script src="./js/article.js" type="text/javascript"></script>

        <title><?php echo $article_info['title']; ?></title>
    </head>

    <body>
        <div class="header">
            <?php include "./views/header.php" ?>
        </div>
        <div class="sidebar">
            <?php include "./views/sidebar.php" ?>
        </div>
        <div class="comment-bar">
            <?php include "./views/comment-bar.php" ?>
        </div>

        <div class="col-10 col-lg-7 mx-auto mt-3">
            <div class="px-3" id="article-head">
                <ul class="list-inline">
                    <li class="list-inline-item dropdown">
                        <button onclick="role_options('<?php echo $article_info['author_id']; ?>', '<?php echo $user_info['user_id']; ?>', '<?php echo $user_info['writer']; ?>', '<?php echo $user_info['designer']; ?>')" class="btn btn-light dropdown-toggle" id="role-btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Reader
                        </button>
                        <ul class="dropdown-menu" id="role-options">
                            <li><a class="dropdown-item active" href="javascript:change_role('Reader ')" id="reader-option">Reader</a></li>
                            <li><a class="dropdown-item" href="javascript:change_role('Writer ')" id="writer-option">Writer</a></li>
                            <li><a class="dropdown-item" href="javascript:change_role('Designer ')" id="designer-option">Designer</a></li>
                        </ul>
                    </li>

                    <?php if ($writer && $article_info['submitted'] == false) { ?>
                        <li class="list-inline-item align-middle writer-btn" hidden>
                            <a class="btn btn-outline-primary px-2 py-1" type="button" href="./create.php?id=<?php echo $article_info['article_id']; ?>">Edit</a>
                        </li>
                    <?php } ?>
                    <?php if ($article_info['approved'] == false) { ?>
                        <li class="list-inline-item align-middle designer-btn" hidden>
                            <a class="btn btn-outline-primary px-2 py-1" type="button" href="../include/article_approval.inc.php?approve_id=<?php echo $article_info['article_id']; ?>">Approve</a>
                        </li>
                        <li class="list-inline-item align-middle designer-btn" hidden>
                            <a class="btn btn-outline-danger px-2 py-1" type="button" href="../include/article_approval.inc.php?deny_id=<?php echo $article_info['article_id']; ?>">Deny</a>
                        </li>
                    <?php } else { ?>
                        <li class="list-inline-item align-middle designer-btn" hidden>
                            <a class="btn btn-outline-danger px-2 py-1" type="button" href="../include/article_approval.inc.php?revoke_id=<?php echo $article_info['article_id']; ?>">Revoke</a>
                        </li>
                    <?php } ?>
                </ul>

                <ul class="list-inline">
                    <li class="list-inline-item align-middle">
                    <!-- article author will go here -->
                        <?php echo $article_info['first_name'] . " " . $article_info['last_name'] ?>
                    </li>
                    <li class="list-inline-item align-middle">
                        <?php echo date("M. d, Y", $article_info['submit_date']) ?>
                    </li>
                    <?php if ($article_info['approved'] == true) { ?>
                        <?php /* ?>
                        <li class="list-inline-item align-middle">
                            <i class="fa-solid fa-comment"></i>
                        </li>
                        <?php */ ?>
                        <li class="list-inline-item align-middle">
                            <a class="fa-regular fa-comment text-reset text-decoration-none" data-bs-toggle="offcanvas" href="#offcanvas-comments" aria-controls="offcanvas-sidebar"> </a>
                        </li>
                        <li class="list-inline-item align-middle">
                            <?php if (isset($_SESSION['user_info'])) {
                                $saved_query = "SELECT article_id, user_id
                                                FROM SavedArticles
                                                WHERE user_id = '" . $user_info['user_id'] . "' AND article_id = '" . $article_info['article_id'] . "';";
                                $saved_result = mysqli_query($con, $saved_query);
                                if ($saved_result->num_rows == 1) { ?>
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

                <h1 class="m-0"><?php echo $article_info['title']; ?></h1>
                <p><?php echo $article_info['description']; ?></p>
            </div>

            <hr>
            <div id="article-body">
                <?php echo $article_info['content']; ?>
            </div>
        </div>
    </body>
</html>
