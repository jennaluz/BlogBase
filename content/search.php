<?php
require_once "../include/connect.inc.php";
include "../include/user_info.inc.php";

// when no search term is given, return all articles organized by most recent
if ($_GET['query'] == "") {
    $article_query = "SELECT title, article_id, description, UNIX_TIMESTAMP(submit_date) as submit_date
                      FROM Articles
                      WHERE approved = 1
                      ORDER BY submit_date DESC";
    $article_result = mysqli_query($con, $article_query);
    $article_matches = $article_result->fetch_all(MYSQLI_BOTH);

    $user_query = "SELECT *
                   FROM Users
                   WHERE approved = 1
                   ORDER BY user_id ASC";
    $user_result = mysqli_query($con, $user_query);
    $user_matches = $user_result->fetch_all(MYSQLI_BOTH);

} else {
    $search_term = $_GET['query'];
    $tokens = explode(" ", $search_term);

    $article_query = "SELECT title, article_id, description, UNIX_TIMESTAMP(submit_date) as submit_date
                     FROM Articles
                     WHERE approved = 1";
    $article_result = mysqli_query($con, $article_query);
    $article_arr = $article_result->fetch_all(MYSQLI_BOTH);

    $article_matches = array();
    // Fuzzy searching using levenshtein and metaphone algorithms.
    // The difference between this and the other way is the way that
    // percent similarity is calculated.
    foreach($article_arr as $key) {
        $lev = levenshtein(metaphone($key['title']), metaphone($search_term));
        $similarity = 1 - ($lev / max(strlen(metaphone($key['title'])), strlen(metaphone($search_term))));
        if ($similarity > 0.4) {
            array_push($article_matches, $key);
        }
    }

    $user_query = "SELECT *
                   FROM Users
                   WHERE approved = 1";
    $user_result = mysqli_query($con, $user_query);
    $user_arr = $user_result->fetch_all(MYSQLI_BOTH);

    $user_matches = array();
    foreach($user_arr as $key) {
        $lev = levenshtein(metaphone($key['username']), metaphone($search_term));
        $similarity = 1 - ($lev / max(strlen(metaphone($key['username'])), strlen(metaphone($search_term))));
        if ($similarity > 0.4) {
            array_push($user_matches, $key);
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
            </form>

            <ul class="nav nav-tabs mt-3" id="search-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="articles-tab" data-bs-toggle="tab" data-bs-target="#articles-tab-pane" type="button" role="tab" aria-controls="articles-tab-pane" aria-selected="true">Articles</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="users-tab" data-bs-toggle="tab" data-bs-target="#users-tab-pane" type="button" role="tab" aria-controls="users-tab-pane" aria-selected="false">Users</button>
                </li>
            </ul>

            <div class="tab-content" id="search-tab-content">
                <div class="tab-pane fade show active" id="articles-tab-pane" role="tabpanel" aria-labelledby="articles-tab" tabindex="0">
                    <table class="table text-start">
                        <tbody>
                            <?php if (count($article_matches) == 0) { ?>
                                <tr>
                                    <h4 class="m-2">No results...</h4>
                                </tr>
                            <?php } else {?>
                                <?php foreach ($article_matches as $current_row) { ?>
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
                            <?php } ?>
                        </tbody>
                    </table>
                </div>

                <div class="tab-pane fade" id="users-tab-pane" role="tabpanel" aria-labelledby="users-tab" tabindex="0">
                    <table class="table text-start">
                        <tbody>
                            <?php if (count($user_matches) == 0) { ?>
                                <tr>
                                    <h4 class="m-2">No results...</h4>
                                </tr>
                            <?php } else {?>
                                <?php foreach ($user_matches as $current_row) { ?>
                                    <tr>
                                        <td class="col-1 text-nowrap">
                                            <img class="mx-auto rounded-circle" style="width:70px; height:70px;" src="./uploads/profile_pictures/<?php echo $current_row['profile_picture']; ?>">
                                        </td>
                                        <td>
                                            <h4>
                                                <a class="text-reset text-decoration-none" href="./profile.php?username=<?php echo $current_row['username'] ?>">
                                                    <?php echo $current_row['first_name'] . " " . $current_row['last_name'] ?>
                                                </a>
                                            </h4>
                                            <?php echo "@" . $current_row['username'] ?>
                                        </td>
                                    </tr>
                                <?php } ?>
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
