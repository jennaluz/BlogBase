<?php require "../include/connect.inc.php"; ?>

<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, intitial-scale=1">

     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
     <link rel="stylesheet" href="./css/styles.css">

     <title>BlogBase - Search</title>
</head>
<body>
        <div class="header">
            <?php include "./views/header.php" ?>
        </div>
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
