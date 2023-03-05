<?php
require "../include/connect.inc.php";
include "../include/auth_session.inc.php";
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
        <link rel="stylesheet" href="./css/styles.css">
        <script src="./js/script.js"></script>
    </head>

    <body>

      <nav class="flex-div">
        <?php include "./views/header.php" ?>
      </nav>

      <div class="sidebar">
        <?php include "./views/sidebar.php" ?>
      </div>

          <br><br><br>
            <center>

                <p><h1>Hello <?php echo $_SESSION['username'] ?>,<br><br> </h1>
                <?php
                //this is the place that sets up the authentification for the page in tandom with auth_session.php
                  $current_user = $_SESSION['username'];
                  $test_auth = "SELECT username FROM users where username='$current_user' and Admin=1";
                  $help = $con->query($test_auth);
                  if($help->num_rows > 0){
                    //the rest of the statement is at the bottom and applies if the user doesn't have the proper
                    //access to the page. If they dont they are not able to see any of the information
                    ?>
                <h3>View users who are in the database:</h3>
                <table style="border-spacing: 15px">
                <?php
                    $sql = "SELECT userid, username, fname, lname, email, is_approved, Admin, graphic_Des, writer, reader, advr FROM users WHERE is_approved=1";
                    $result = $con->query($sql);
                    if($result->num_rows > 0) {

                    echo "<tr>";
                    echo    "<td>ID:</td>";
                    echo    "<td>Username:</td>";
                    echo    "<td>Name:</td>";
                    echo    "<td>Email:</td>";
                    echo    "<td>Approved:</td>";
                    echo    "<td>Admin:</td>";
                    echo    "<td>Graphic Designer:</td>";
                    echo    "<td>Writer:</td>";
                    echo    "<td>Reader:</td>";
                    echo    "<td>Advritiser:</td>";
                    echo    "<td>Delete:</td>";
                    echo "</tr>";


                            while($row = $result->fetch_assoc()){
                                echo "<tr><td> " . $row["userid"] . "</td><td>" . $row["username"] . " </td><td> " . $row["fname"] . " " . $row["lname"] . " </td><td> " . $row["email"] . "</td><td> " .$row["is_approved"] . "</td><td>" . $row["Admin"] . " </td><td> " . $row["graphic_Des"] . " </td><td> " . $row["writer"] . " </td><td> " . $row["reader"] . " </td><td> " . $row["advr"] . " </td>";
                                ?>
                    <td><a href="../include/delete_post.inc.php?userid=<?php echo $row["userid"]; ?>">Delete</a></td><!-- comment -->
                    <?php
                    echo "</tr><br>";
                            }
                        }else{
                            echo "<tr><td>0 results</td></tr>";
                        }
                    ?>
                </table>
                <br>
                <h3>View users who are attempting to register:</h3><br>
                <table style="border-spacing: 15px">
                    <?php
                    $sql1 = "SELECT userid, username, fname, lname, email, is_approved, Admin, graphic_Des, writer, reader, advr FROM users WHERE is_approved!=1";
                    $result1 = $con->query($sql1);
                    if($result1->num_rows > 0) {
                echo "<tr>";
                    echo    "<td>ID:</td>";
                    echo    "<td>Username:</td>";
                    echo    "<td>Name:</td>";
                    echo    "<td>Email:</td>";
                    echo    "<td>Approved:</td>";
                    echo    "<td>Admin:</td>";
                    echo    "<td>Graphic Designer:</td>";
                    echo    "<td>Writer:</td>";
                    echo    "<td>Reader:</td>";
                    echo    "<td>Advritiser:</td>";
                    echo    "<td>Delete:</td>";
                    echo    "<td>Approve:</td>";
                    echo "</tr>";

                            while($row = $result1->fetch_assoc()){
                                echo "<tr><td> " . $row["userid"] . "</td><td>" . $row["username"] . " </td><td> " . $row["fname"] . " " . $row["lname"] . " </td><td> " . $row["email"] . "</td>";
                                echo "<td> " .$row["is_approved"] . "</td><td>" . $row["Admin"] . " </td><td> " . $row["graphic_Des"] . " </td><td> " . $row["writer"] . " </td><td> " . $row["reader"] . " </td><td> " . $row["advr"] . " </td>";
                                ?>
                    <td><a href="../include/delete_post.inc.php?userid=<?php echo $row["userid"]; ?>">Delete</a></td><!-- comment -->
                    <td><a href="../include/approve_user.inc.php?userid=<?php echo $row["userid"]; ?>">Approve</a></td>
                    <?php
                    echo "</tr><br>";
                            }
                        }else{
                          echo "<tr><td>0 results</td></tr>";
                        }
                    ?>

                </table>
            </p>
            <br><!-- comment -->

</center><!-- comment -->
<?php
}else{
  ?>
  <center>
    <p><h3>You do not have access to the admin page.</h3></p>
    <br>
    <p><h3>Return to <a href="./index.php">Home?</a></h3></p>
  </center>
  <?php
}

?>
<script src="./js/script.js"></script>

</body>
</html>
