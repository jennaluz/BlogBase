<?php
require_once "../include/connect.inc.php";
include "../include/user_info.inc.php";

// when no search term is given, return all articles organized by most recent
if ($_GET['query'] == "") {
    $search_query = "SELECT title, article_id, description, UNIX_TIMESTAMP(submit_date) as submit_date
                     FROM Articles
                     WHERE approved = 1
                     ORDER BY submit_date DESC";
    $search_result = mysqli_query($con, $search_query);
    $matches = $search_result->fetch_all(MYSQLI_BOTH);

} else {
    $search_term = $_GET['query'];
    $tokens = explode(" ", $search_term);

    $search_query = "SELECT title, article_id, description, UNIX_TIMESTAMP(submit_date) as submit_date
                     FROM Articles
                     WHERE approved = 1";
    $search_result = mysqli_query($con, $search_query);
    $sql_arr = $search_result->fetch_all(MYSQLI_BOTH);

    $matches = array();
    // Fuzzy searching using levenshtein and metaphone algorithms.
    // The difference between this and the other way is the way that
    // percent similarity is calculated.
    foreach($sql_arr as $key) {
        $lev = levenshtein(metaphone($key['title']), metaphone($search_term));
        $similarity = 1 - ($lev / max(strlen(metaphone($key['title'])), strlen(metaphone($search_term))));
        if ($similarity > 0.4) {
            array_push($matches, $key);
        }
    }
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
                <input class="form-control" name="query" type="search" placeholder="Search" value="<?php echo $search_term ?>" aria-label="Search">
                <button class="btn btn-outline-dark input-group-text" type="submit">
                    <i class="fa-solid fa-search"></i>
                </button>
            </form >

            <table class="table text-start">
                <thead>
                </thead
                <tbody>
                    <?php foreach ($matches as $current_row) { ?>
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
