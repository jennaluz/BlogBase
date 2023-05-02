<?php
require_once "../include/connect.inc.php";
include_once "../include/user_info.inc.php";

if ($user_info['writer'] == false) {
    http_response_code(404);
    include("./404.php");
    die();
} else {
    $user_id = $user_info['user_id'];
    $user_first_name = $user_info['first_name'];
    $user_last_name = $user_info['last_name'];
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, intitial-scale=1">

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
        <link rel="stylesheet" href="./css/styles.css">

        <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

        <title>BlogBase Writer</title>
    </head>

    <body>
        <div class="header">
            <?php include "./views/header.php" ?>
        </div>
        <div class="sidebar">
            <?php include "./views/sidebar.php" ?>
        </div>

        <div class="container mt-3 mb-3 text-center">
            <h1>Writer Dashboard</h1>
        </div>

        <div class="col-10 col-lg-7 mt-3 mx-auto">
            <hr>
            <h4>
                <ul class="list-inline">
                    <li class="list-inline-item align-middle">
                        <a class="fa-regular fa-square-plus text-reset text-decoration-none" href="./create.php"></a>
                    </li>
                    <li class="list-inline-item align-middle">
                        <span>Create a new article</span>
                    </li>
                </ul>
            </h4>

            <ul class="nav nav-tabs" id="writer-article-tabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="in-progress-tab" data-bs-toggle="tab" data-bs-target="#in-progress-tab-pane" type="button" role="tab" aria-controls="in-progress-tab-pane" aria-selected="true">In Progress</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="submitted-tab" data-bs-toggle="tab" data-bs-target="#submitted-tab-pane" type="button" role="tab" aria-controls="submitted-tab-pane" aria-selected="true">Submitted</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="approved-tab" data-bs-toggle="tab" data-bs-target="#approved-tab-pane" type="button" role="tab" aria-controls="approved-tab-pane" aria-selected="true">Approved</button>
                </li>
            </ul>

            <div class="tab-content" id="writer-article-content">
                <div class="tab-pane fade show active" id="in-progress-tab-pane" role="tabpanel" aria-labelledby="in-progress-tab" tabindex="0">
                    <?php
                    $in_progress_query = "SELECT article_id, title, description
                                          FROM Articles
                                          WHERE approved = 0 AND submitted = 0 AND author_id = $user_id";
                    $in_progress_results = mysqli_query($con, $in_progress_query);
                    $in_progress_articles = $in_progress_results->fetch_all(MYSQLI_BOTH);
                    ?>

                    <table class="table text-start">
                        <thead>
                            <th scope="col">Article</th>
                            <th scope="col">Action</th>
                        </thead>
                        <tbody>
                            <?php for ($i = 0; $i < $in_progress_results->num_rows; $i++) { ?>
                                <tr>
                                    <td>
                                        <h4>
                                            <a class="text-reset text-decoration-none" href="./article.php?id=<?php echo $in_progress_articles[$i]['article_id']; ?>">
                                                <?php echo $in_progress_articles[$i]['title'] ?>
                                            </a>
                                        </h4>
                                        <?php echo $in_progress_articles[$i]['description'] ?>
                                    </td>
                                    <td>
                                        <ul class="list-inline">
                                            <li class="list-inline-item align-middle">
                                                <a class="btn btn-outline-primary px-2 py-1" type="button" href="./create.php?id=<?php echo $in_progress_articles[$i]['article_id']; ?>">Edit</a>
                                            </li>
                                            <li class="list-inline-item align-middle">
                                                <a class="btn btn-outline-success px-2 py-1" type="button" href="../include/create_article.inc.php?submit_article=<?php echo $in_progress_articles[$i]['article_id']; ?>">Submit</a>
                                            </li>
                                            <li class="list-inline-item align-middle">
                                                <a class="btn btn-outline-danger px-2 py-1" type="button" href="../include/delete_article.inc.php?id=<?php echo $in_progress_articles[$i]['article_id']; ?>&return_page=writer.php">Delete</a>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody> 
                    </table>
                </div>

                <div class="tab-pane fade" id="submitted-tab-pane" role="tabpanel" aria-labelledby="submitted-tab" tabindex="0">
                    <?php
                    $submitted_query = "SELECT article_id, title, description
                                        FROM Articles
                                        WHERE approved = 0 AND submitted = 1 AND author_id = $user_id";
                    $submitted_result = mysqli_query($con, $submitted_query);
                    $submitted_articles = $submitted_result->fetch_all(MYSQLI_BOTH);
                    ?>

                    <table class="table text-start">
                        <thead>
                            <th scope="col">Submit Date</th>
                            <th scope="col">Article</th>
                            <th scope="col">Action</th>
                        </thead>
                        <tbody>
                            <?php for ($i = 0; $i < $submitted_result->num_rows; $i++) { ?>
                                <tr>
                                    <td class="text-nowrap">
                                        <?php echo date("M. d, Y", $submitted_articles[$i]['submit_date']) ?>
                                    </td>
                                    <td>
                                        <h4>
                                            <a class="text-reset text-decoration-none" href="./article.php?id=<?php echo $submitted_articles[$i]['article_id'] ?>">
                                                <?php echo $submitted_articles[$i]['title'] ?>
                                            </a>
                                        </h4>
                                        <?php echo $submitted_articles[$i]['description'] ?>
                                    </td>
                                    <td>
                                        <a class="btn btn-outline-danger px-2 py-1" type="button" href="../include/create_article.inc.php?withdraw_article=<?php echo $submitted_articles[$i]['article_id']; ?>">Withdraw</a>
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
                            <th scope="col">Article</th>
                            <!--<th scope="col">Action</th>-->
                        </thead>
                        <tbody>
                            <?php for ($i = 0; $i < $approved_result->num_rows; $i++) { ?>
                                <tr>
                                    <td class="text-nowrap">
                                        <?php echo date("M. d, Y", $approved_articles[$i]['submit_date']) ?>
                                    </td>
                                    <td>
                                        <h4>
                                            <a class="text-reset text-decoration-none" href="./article.php?id=<?php echo $approved_articles[$i]['article_id'] ?>">
                                                <?php echo $approved_articles[$i]['title'] ?>
                                            </a>
                                        </h4>
                                        <?php echo $approved_articles[$i]['description'] ?>
                                    </td>
                                    <!--
                                    <td>
                                        <a class="btn btn-outline-danger px-2 py-1" type="button" href="../include/article_approval.inc.php?revoke_id=<?php //echo $approved_articles[$i]['article_id']; ?>&return_page=design.php">Revoke</a>
                                    </td>
                                    -->
                                </tr>
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
