<?php
require_once "../include/connect.inc.php";
include_once "../include/auth_saved.inc.php";
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, intitial-scale=1">

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
        <link rel="stylesheet" href="./css/styles.css">

        <title>BlogBase</title>
    </head>

    <body>
        <div class="header">
            <?php include "./views/header.php" ?>
        </div>
        <div class="sidebar">
            <?php include "./views/sidebar.php" ?>
        </div>

        <?php
        try {
            if (isset($_SESSION["username"])) {
                $loggedInUser = $_SESSION["username"];
                $getUserID = "SELECT user_id
                              FROM `Users`
                              WHERE username = '$loggedInUser'";
                $loggedOn = $con->query($getUserID);

                if ($loggedOn->num_rows > 0) {
                    while ($row1 = $loggedOn->fetch_assoc()) {
                        $realUserID = $row1["user_id"];
                        $stmt = $con->query("SELECT Articles.article_id, Articles.title, Articles.description, Articles.submit_date
                                             FROM `Articles`, `SavedArticles`
                                             WHERE approved = 1 AND saved = 1 AND SavedArticles.user_id = '$realUserID' AND Articles.article_id = SavedArticles.article_id");

                        ?><table class="main-space"><?php
                        $i =0;
                        $stmt->fetch_assoc();

                        foreach($stmt as $row) {
                            echo "<center><td>";
                            echo '<div class="card">';
                            echo '<div class="container">';
                            echo '<h1><a href="./post1.php?id=' . $row['article_id'] . '">' . $row['title'] . '</a></h1>';
                            echo '</div>';
                            echo '<p>Submitted on ' . $row['submit_date'] . '</p><br>';
                            echo '<p>' . $row['description'] . '</p>';
                            echo '<p><a href="./post1.php?id=' . $row['article_id'] . '">Read More</a></p>';
                            echo '</div>';
                            echo "</td></center>";

                            $i = $i+1;

                            if ($i % 3 == 0 ) {
                                echo "<tr></tr>";
                            }
                        }
                    }
                }
            }
        }

        catch (PDOException $e) {
            echo $e->getMessage();
        }
        
        echo "</table>";
        ?>

        </div>
        </div>
        </center>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
        <script src="./js/script.js"></script>
    </body>
</html>
