<?php
require_once "../include/connect.inc.php";
ob_start();

// check if user has "editor" role using an included logic page
$is_editor = false;

// get information about this article
$requested_id = $_GET['id'];
$article_query = "SELECT article_id, title, content, submit_date, approved
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
        <link rel="stylesheet" href="./css/comments.css">

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

        <div class="row text-center mt-4">
            <h1><?php echo $article_info['title']; ?></h1>
<?php /* ?>
            <h2><!-- author --></h2>
            <h2><!-- date --></h2>
            <h2><!-- jump to comment section --></h2>
            <h2><!-- jump to newsletter --></h2>
            <h2><!-- save or unsave --></h2>
            <h2><!-- (if editor) revoke or approve --></h2>
            <h2><!--  --></h2>
<?php */ ?>
        </div>

        <div class="row">
            <div class="col"></div>
            <div class="col-6">
                <p><?php echo $article_info['content']; ?></p>
            </div>
            <div class="col"></div>
        </div>
    </body>
</html>
