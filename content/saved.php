<?php
require_once "../include/connect.inc.php";
include_once "../include/user_info.inc.php";

ob_start();

// user is not logged in
if ($user_info['reader'] != true) {
    header("Location: ./login.php");
    ob_end_flush();
}

$saved_articles_query = "SELECT UNIX_TIMESTAMP(saved_date) as saved_date, title, article_id, description
                         FROM Articles NATURAL JOIN SavedArticles
                         WHERE user_id = '" . $user_info['user_id'] . "' AND approved = true";
$saved_articles_result = mysqli_query($con, $saved_articles_query);
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

        <title>BlogBase</title>
    </head>

    <body>
        <div class="header">
            <?php include_once "./views/header.php" ?>
        </div>
        <div class="sidebar">
            <?php include_once "./views/sidebar.php" ?>
        </div>

        <div class="mt-3 text-center">
            <h1>Your Saved Articles</h1>
        </div>

        <div class="col-10 col-lg-7 mx-auto mt-3">
            <table class="table text-start">
                <thead>
                </thead
                <tbody>
                    <?php while ($current_row = $saved_articles_result->fetch_assoc()) { ?>
                        <tr>
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
                                <a class="fa-solid fa-bookmark text-reset" href="../include/save_article.inc.php?unsave_id=<?php echo $current_row['article_id']; ?>&return_page=saved.php"></a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </body>
</html>
