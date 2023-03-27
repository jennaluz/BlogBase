<?php
require_once "../include/connect.inc.php";
include "../include/user_info.inc.php";

if (isset($_GET['query'])) {
    // check for sql injection
    // query the database and save it in search_result
    // redirect to search page
    $search_term = $_GET['query'];
    $search_query = "select title, article_id, description, UNIX_TIMESTAMP(submit_date) as submit_date
                     from Articles
                     where soundex(title) like soundex(?)";
    $result = mysqli_execute_query($con, $search_query, [$search_term]);
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

         <title>BlogBase - Search</title>
    </head>

    <body>
        <div class="header">
            <?php include "./views/header.php" ?>
        </div>
        <div class="sidebar">
            <?php include "./views/sidebar.php" ?>
        </div>

        <div class="mt-3 text-center">
            <h1>Search</h1>
        </div>

        <div class="col-10 col-lg-7 mx-auto mt-3">
            <form method="get" action="./search.php" class="input-group rounded">
                <input class="form-control" name="query" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-dark input-group-text" type="submit">
                    <i class="fa-solid fa-search"></i>
                </button>
            </form >

            <table class="table text-start">
                <thead>
                </thead
                <tbody>
                    <?php while ($current_row = $result->fetch_assoc()) { ?>
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
    </body>
</html>
