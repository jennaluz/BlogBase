<?php
include "../include/connect.inc.php";
include "../include/auth_ad.inc.php";
?>
<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Other/html.html to edit this template
-->


<html lang="eng">
    <head>
        <meta charset="utf-8"><!-- comment -->
        <meta name="viewport" content="width=device-width, intitial-scale=1.0">
        <title>Blog Base e-newspaper</title>
        <link rel="stylesheet" href="css/styles.css">

    </head>

    <body>

      <nav class="flex-div">
        <?php include "./views/header.php" ?>
      </nav>

      <div class="sidebar">
        <?php include "./views/sidebar.php" ?>
      </div>
        <br><br><!-- comment -->
        <?php
        //this is the place that sets up the authentification for the page in tandom with auth_session.php
          $current_user = $_SESSION['username'];
          $test_auth = "SELECT username FROM users where username='$current_user' and advr=1";
          $help = $con->query($test_auth);
          if($help->num_rows > 0){
            //the rest of the statement is at the bottom and applies if the user doesn't have the proper
            //access to the page. If they dont they are not able to see any of the information
            ?>
    <center>
        <p><h1>Upload your ad to the database</h1></p><!-- comment -->
    <br><p><h3>By uploading your ad's you allow us to show them to our viewers</h3></p>
    </center>
        <br><br>
    <center>
        <form method="post" action="../include/ad_logic.inc.php" enctype="multipart/form-data">
            <input type="file" name="file" /><!-- comment -->
            <input type="submit" name="submit" value='Upload'/>
        </form>
        <br><br><!-- comment -->
        <p><h3>Here are some previous ads that have been uploaded:</h3></p><br>
    </center>
<?php
// Include the database configuration file


// Get images from the database
$query = $con->query("SELECT * FROM ad_displays");

if($query->num_rows > 0){
    while($row = $query->fetch_assoc()){
        $imageURL = 'uploads/'.$row["file_name"];
?>
    <center>

        <img class="ad_images" src="<?php echo $imageURL; ?>" alt="" />
    </center>
<?php }
}else{ ?>
    <p>No image(s) found...</p>
<?php }

}else{
?>
<center>
  <p><h3>You do not have access to the advritiser page.</h3></p>
  <br>
  <p><h3>Return to <a href="./index.php">Home?</a></h3></p>
</center>
  <?php
}

?>
<script src="./js/script.js"></script>
    </body>
</html>
