<!DOCTYPE html>
<html lang="en">
<?php require "../include/connect.inc.php"; ?>

<head>
    <meta charset="utf-8">
    <title>Blog - <?php echo $row['postTitle']; ?></title>
    <link rel="stylesheet" href="./css/styles.css">
</head>
<body>
      <nav class="flex-div">
        <?php include "./views/header.php" ?>
      </nav>
      <div class="sidebar">
        <?php include "./views/sidebar.php" ?>
      </div>
    <script src="./js/script.js"></script>
</body>
</html>
<?php
    $search = $_POST['search'];

    $hostName = "localhost";
    $userName = "root";
    $password = "";
    $databaseName = "blog_base";

    $con = mysqli_connect($hostName,$userName , $password, $databaseName);

    if (!$con) {
        echo"<h3 class='container bg-dark text-center p-3 text-warning rounded-lg mt-5'>not able to establish database connection</h3>";
    }
            if (isset($_REQUEST["search"])) {

           try{
                $sql = "SELECT * FROM blog_posts WHERE postTitle like '%$search%' or postCont like '%$search%' or postDate like '%$search%'";
                $stmt = $con->query($sql);

                if($stmt->num_rows > 0){
                    echo "<table>";
                    $i =0;
                    while($row = $stmt->fetch_assoc()) {

                        echo "<td>";
                        echo '<div class="card">';
                        echo '<div class="container">';
                        echo '<h1><a href="./post1.php?id=' . $row['postID'] . '">' . $row['postTitle'] . '</a></h1>';
                        echo '</div>';
                        echo '<p>Posted on ' . $row['postDate'] . '</p><br>';
                        echo '<p>' . $row['postDesc'] . '</p>';
                        echo '<p><a href="./post1.php?id=' . $row['postID'] . '">Read More</a></p>';
                        echo '</div>';
                        echo "</td>";
                        $i = $i+1;
                        if($i % 3 == 0 )
                        {
                            echo "<tr></tr>";
                        }
                    }

                    echo "</table>";
                }
                else
                {
                    echo '<div class="noRres"> No Results Found </div>';
                }
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
            }
?>
