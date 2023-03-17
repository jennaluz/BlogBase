<?php
require_once "../include/connect.inc.php";
ob_start();

// check if user has "editor" role using an included logic page
$is_editor = true;

// get information about this article
$requested_id = $_GET['id'];
$article_query = "SELECT article_id, title, content, UNIX_TIMESTAMP(`submit_date`), approved
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

        <div class="col-10 col-lg-6 mx-auto mt-4">
            <?php if ($is_editor == true) { ?>
                <ul class="list-inline mb-1">
                <?php if ($article_info['approved'] == 0) { ?>
                    <li class="list-inline-item align-middle">
                        <button class="px-2 py-1 btn btn-outline-primary mb-3" type="button">Approve</button>
                    </li>
                    <li class="list-inline-item align-middle">
                        <button class="px-2 py-1 btn btn-outline-danger mb-3" type="button">Deny</button>
                    </li>
                <?php } else { ?>
                    <li class="list-inline-item align-middle">
                        <button class="px-2 py-1 btn btn-outline-danger mb-3" type="button">Revoke</button>
                    </li>
                </ul>
                <?php } ?>
            <?php } ?>

            <ul class="list-inline mb-1">
                <li class="list-inline-item align-middle">Chad Flemmington</li>
                <li class="list-inline-item align-middle"><?php echo date("M. d, Y", $article_info['submit_date']) ?></li>
                <li class="list-inline-item align-middle">
                    <i class="fa-solid fa-comment"></i>
                </li>
                <li class="list-inline-item align-middle">
                    <i class="fa-solid fa-newspaper"></i>
                </li>
            </ul>

            <ul class="list-inline">
                <li class="list-inline-item align-middle">
                    <h1 class="m-0"><?php echo $article_info['title']; ?></h1>
                </li>
                <li class="list-inline-item align-text-middle">
                    <i class="fa-lg fa-solid fa-bookmark"></i>
                </li>
                <li class="list-inline-item align-text-middle">
                    <i class="fa-lg fa-regular fa-bookmark"></i>
                </li>
            </ul>

            <hr>

            <?php echo $article_info['content']; ?>
        </div>
    </body>
</html>
