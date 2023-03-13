<?php include "../include/connect.inc.php"; ?>

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
            $stmt = $con->query("SELECT article_id, title, description, submit_date
                                 FROM `Articles`
                                 WHERE approved = 1 AND submit_date >= '2022/08/26'
                                 ORDER BY click_number DESC");
            ?>

            <table class="main-space">
                <?php
                $i =0;
                $stmt->fetch_assoc();

                foreach ($stmt as $row) {
                    echo "<center><td>";
                    echo '<div class="card">';
                    echo '<div class="container">';
                    echo '<h1><a href="post1.php?id=' . $row['article_id'] . '">' . $row['title'] . '</a></h1>';
                    echo '</div>';
                    echo '<p>Posted on ' . $row['submit_date'] . '</p><br>';
                    echo '<p>' . $row['description'] . '</p>';
                    echo '<p><a href="post1.php?id=' . $row['article_id'] . '">Read More</a></p>';
                    echo '</div>';
                    echo "</td></center>";

                    $i = $i+1;

                    if ($i % 3 == 0 ) {
                        echo "<tr></tr>";
                    }
                }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

        echo "</table>";
        ?>

        </div>
        </div>
        </center>

        <script src="./js/script.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    </body>
</html>
