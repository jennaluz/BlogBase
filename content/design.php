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

        <div class="mt-3 text-center">
            <h1>Article Approval</h1>
        </div>

        <div class="col-10 col-lg-7 mt-3 mx-auto">
            <ul class="nav nav-tabs" id="article-approval-tabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="unapproved-tab" data-bs-toggle="tab" data-bs-target="#unapproved-tab-pane" type="button" role="tab" aria-controls="unapproved-tab-pane" aria-selected="true">Unapproved</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="approved-tab" data-bs-toggle="tab" data-bs-target="#approved-tab-pane" type="button" role="tab" aria-controls="approved-tab-pane" aria-selected="true">Approved</button>
                </li>
            </ul>

            <div class="tab-content" id="article-approval-content">
                <div class="tab-pane fade show active" id="unapproved-tab-pane" role="tabpanel" aria-labelledby="unapproved-tab" tabindex="0">
                    <?php
                    $unapproved_query = "SELECT first_name, last_name, article_id, title, description, UNIX_TIMESTAMP(submit_date) as submit_date
                                         FROM Articles, Users
                                         WHERE Articles.approved = 0 AND Articles.submitted = 1 AND Articles.author_id = Users.user_id";
                    $unapproved_result = mysqli_query($con, $unapproved_query);
                    $unapproved_articles = $unapproved_result->fetch_all(MYSQLI_BOTH);
                    ?>

                    <table class="table text-start">
                        <thead>
                            <th scope="col">Date</th>
                            <th scope="col">Author</th>
                            <th scope="col">Article</th>
                            <th scope="col">Action</th>
                        </thead>
                        <tbody>
                            <?php for ($i = 0; $i < $unapproved_result->num_rows; $i++) { ?>
                                <tr>
                                    <td class="text-nowrap">
                                        <?php echo date("M. d, Y", $unapproved_articles[$i]['submit_date']) ?>
                                    </td>
                                    <td>
                                        <?php echo $unapproved_articles[$i]['first_name'] . " " . $unapproved_articles[$i]['last_name'] ?>
                                    </td>
                                    <td>
                                        <h4>
                                            <a class="text-reset text-decoration-none" href="./article.php?id=<?php echo $unapproved_articles[$i]['article_id'] ?>">
                                                <?php echo $unapproved_articles[$i]['title'] ?>
                                            </a>
                                        </h4>
                                        <?php echo $unapproved_articles[$i]['description'] ?>
                                    </td>
                                    <td>
                                        <ul class="list-inline">
                                            <li class="list-inline-item align-middle">
                                                <a class="btn btn-outline-primary px-2 py-1" type="button" href="../include/article_approval.inc.php?approve_id=<?php echo $unapproved_articles[$i]['article_id']; ?>&return_page=design.php">Approve</a>
                                            </li>
                                            <li class="list-inline-item align-middle">
                                                <a class="btn btn-outline-danger px-2 py-1" type="button" href="../include/article_approval.inc.php?deny_id=<?php echo $unapproved_articles[$i]['article_id']; ?>&return_page=design.php">Deny</a>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody> 
                    </table>
                </div>

                <div class="tab-pane fade" id="approved-tab-pane" role="tabpanel" aria-labelledby="approved-tab" tabindex="1">
                    <?php
                    $approved_query = "SELECT first_name, last_name, article_id, title, description, UNIX_TIMESTAMP(submit_date) as submit_date
                                         FROM Articles, Users
                                         WHERE Articles.approved = 1 AND Articles.author_id = Users.user_id";
                    $approved_result = mysqli_query($con, $approved_query);
                    $approved_articles = $approved_result->fetch_all(MYSQLI_BOTH);
                    ?>

                    <table class="table text-start">
                        <thead>
                            <th scope="col">Date</th>
                            <th scope="col">Author</th>
                            <th scope="col">Article</th>
                            <th scope="col">Action</th>
                        </thead>
                        <tbody>
                            <?php for ($i = 0; $i < $approved_result->num_rows; $i++) { ?>
                                <tr>
                                    <td class="text-nowrap">
                                        <?php echo date("M. d, Y", $approved_articles[$i]['submit_date']) ?>
                                    </td>
                                    <td>
                                        <?php echo $approved_articles[$i]['first_name'] . " " . $approved_articles[$i]['last_name'] ?>
                                    </td>
                                    <td>
                                        <h4>
                                            <a class="text-reset text-decoration-none" href="./article.php?id=<?php echo $approved_articles[$i]['article_id'] ?>">
                                                <?php echo $approved_articles[$i]['title'] ?>
                                            </a>
                                        </h4>
                                        <?php echo $approved_articles[$i]['description'] ?>
                                    </td>
                                    <td>
                                        <a class="btn btn-outline-danger px-2 py-1" type="button" href="../include/article_approval.inc.php?revoke_id=<?php echo $approved_articles[$i]['article_id']; ?>&return_page=design.php">Revoke</a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody> 
                    </table>
                </div>
            </div>
        </div>
    </body>
</html>
