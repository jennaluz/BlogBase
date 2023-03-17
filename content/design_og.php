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
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
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
        // this is the place that sets up the authentification for the page in tandom with auth_session.php
        $current_user = $_SESSION['username'];

        $test_auth = "SELECT username
                      FROM `Users`
                      WHERE username = '$current_user' AND (admin = 1 OR designer = 1)";
        $help = $con->query($test_auth);

        if($help->num_rows > 0){
            // the rest of the statement is at the bottom and applies if the user doesn't have the proper
            // access to the page. If they dont they are not able to see any of the information
        ?>
            <center><h1><u>Content Approval or Denial:</u></h1></center>
            <br><br>

            <center><h3>Posts waiting to be approved:</h3></center>
            <br>

            <?php
            require_once "../include/connect.inc.php";
            try {
                $stmt = $con->query('SELECT article_id, title, description, submit_date
                                     FROM `Articles`
                                     WHERE approved = 0
                                     ORDER BY article_id DESC');
            ?>
                <table class="main-space">

                <?php
                $i =0;

                if ($stmt->num_rows > 0) {
                    $stmt->fetch_assoc();

                    foreach($stmt as $row) {
                        echo "<center><td>";
                        echo '<div class="card">';
                        echo '<div class="container">';
                        echo '<h1><a href="./article.php?id=' . $row['article_id'] . '">' . $row['title'] . '</a></h1>';
                        echo '</div>';
                        echo '<p>Submitted on ' . $row['submit_date'] . '</p><br>';
                        echo '<p>' . $row['description'] . '</p>';
                        echo '<p><a href="./article.php?id=' . $row['article_id'] . '">Read More</a></p>';
                        echo '</div>';
                        echo "</td></center>";

                        $i = $i+1;

                        if ($i % 3 == 0) {
                            echo "<tr></tr>";
                            echo "<tr></tr>";
                        }
                    }
                } else { ?>
                    <br><center><h5>There are no posts waiting to be approved</h5></center><br>
            <?php
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
           <br>
           <center><h3>Currently approved posts:</h3></center>
           <br>

            <?php
            try {
                $stmt = $con->query('SELECT article_id, title, description, submit_date
                                     FROM `Articles`
                                     WHERE approved = 1
                                     ORDER BY article_id DESC');
            ?>
                <table class="main-space">

                <?php
                $i =0;

                if ($stmt->num_rows > 0) {
                    $stmt->fetch_assoc();

                    foreach ($stmt as $row) {
                        echo "<center><td>";
                        echo '<div class="card">';
                        echo '<div class="container">';
                        echo '<h1><a href="./article.php?id=' . $row['article_id'] . '">' . $row['title'] . '</a></h1>';
                        echo '</div>';
                        echo '<p>sSubmitted on ' . $row['submit_date'] . '</p><br>';
                        echo '<p>' . $row['description'] . '</p>';
                        echo '<p><a href="./article.php?id=' . $row['article_id'] . '">Read More</a></p>';
                        echo '</div>';
                        echo "</td></center>";

                        $i = $i+1;

                        if ($i % 3 == 0 ) {
                            echo "<tr></tr>";
                            echo "<tr></tr>";
                        }
                    }
                } else { ?>
                    <br><center><h5>There are no posts that are currently approved</h5></center><br>
            <?php
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
        <?php
        } else { ?>
            <center>
                <p><h3>You do not have access to the editor page.</h3></p>
                <br>
                <p><h3>Return to <a href="./index.php">Home?</a></h3></p>
            </center>
        <?php
        }
        ?>

        <script src="./js/script.js"></script>
    </body>
</html>
