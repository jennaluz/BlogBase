<!DOCTYPE html>
<html lang="en">
<?php require "../include/connect.inc.php"; ?>

<head>
    <meta charset="utf-8">
    <title>Blog - <?php echo $row['postTitle']; ?></title>
    <link rel="stylesheet" href="./css/styles.css">
    <!--<link rel="stylesheet" href="style/main.css">-->
</head>

<body>
  <nav class="flex-div">
      <div class="nav-left flex-div">
          <img class="menu-icon" src="./images/menu_icon.png">
          <a href="./index.php"><img src="./images/logo1.png" class="logo" ></a>
      </div>
      <div class="nav-mid flex-div">
          <div class="search-box flex-div">
            <form action="./search.php" method="POST" id="searchForm">
        <input type="text/submiit" name="search" placeholder="search"/> <img src="./images/search.png">
    </form>
          </div>
      </div><!-- comment -->
      <?php
      session_start();
      if(isset($_SESSION["username"])){
        $loggedInUser = $_SESSION["username"];
        ?>
        <div class="nav-right flex-div">
            <a href="./admin.php"><img src="./images/admin_img.png"></a>
            <a href="./design.php"><img src="./images/gd.png"></a>
            <a href="./create.php"><img src="./images/editor_img.png"></a>
            <a href="./ads.php"><img src="./images/ad.png"></a>
            <a href="./profile.php" style="padding: 10px"><img src="./images/follow.png"></a>
            <u><?php echo $_SESSION['username'] ?></u>
            <a href="./logout.php" style="padding: 10px">Logout</a>
        <?php
      }else{
        ?>
  <div class="nav-right flex-div">
      <a href="./admin.php"><img src="./images/admin_img.png"></a>
      <a href="./design.php"><img src="./images/gd.png"></a>
      <a href="./create.php"><img src="./images/editor_img.png"></a>
      <a href="./ads.php"><img src="./images/ad.png"></a>
      <a href="./profile.php"><img src="./images/follow.png"></a>
      <a href="./login.php" >Login</a><!-- comment -->
      <a href="./register.php" style="padding: 10px">Sign Up</a>
  </div>
  <?php
}
?>
  </nav>

  <!--------------------- side bar --------------------->
  <div class="sidebar">
      <div class="shortcut-links">
          <a href="./index.php"><img src="./images/home.png"> Home </a></p>
          <a href="./hot.php"><p><img src="./images/hot.png"> Hot! </a></p>
          <a href="./saved.php"><p><img src="./images/saved.png"> Saved </a></p>
          <a href="./archived.php"><p><img src="./images/history.png"> Archived </a></p>
          <hr>
      </div>
      <div class="Authors">
        <center>
          <p><a href="./social.php">Social</a></p>
        </center>
          <?php
          session_start();
          if(isset($_SESSION["username"])){
            $loggedInUser = $_SESSION["username"];
            $getUserID = "SELECT userid FROM users WHERE username='$loggedInUser'";
            $loggedOn = $con->query($getUserID);
            if($loggedOn->num_rows > 0){
              while($row = $loggedOn->fetch_assoc()){
                $realUserID = $row["userid"];
            $followList = "SELECT username FROM users, social_follow WHERE username!='$loggedInUser' and follower_id='$realUserID' and follow_id=1 and followed_user_id=userid";
            $getFollowList = $con->query($followList);
            if($getFollowList->num_rows > 0){
              while($row1 = $getFollowList->fetch_assoc()){

           ?>
              <a href=""><p><img src="./images/follow.png"><?php echo $row1["username"]; ?></a></p>
            <?php
          }
          }
          }
          }
        }else{
          ?>
          <center>
            <p>Not following anyone</p><br>
            <p>or</p><br>
            <p>Need to login</p>
          </center>
          <?php
        }
           ?>
      </div>
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
