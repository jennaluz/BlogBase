<?php
require_once "../include/connect.inc.php";
include_once "../include/user_info.inc.php";

if ($user_info['advertiser'] == false) {
    echo "You don't have access to this page";
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, intitial-scale=1">

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
        <link rel="stylesheet" href="css/styles.css">

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

        <title>BlogBase Advertiser</title>
    </head>

    <body>
        <div class="header">
            <?php include "./views/header.php" ?>
        </div>

        <div class="sidebar">
            <?php include "./views/sidebar.php" ?>
        </div>

        <div class="col-10 col-lg-7 mt-3 mx-auto">
            <div class="text-center">
                <p class="display-3 mt-3">Spread the Word!</p>
                <p>Upload your ads to BlogBase to show to our viewers!</p>
            </div>

            <div class="my-5 text-center">
                <form method="post" action="../include/upload_ad.inc.php" enctype="multipart/form-data">
                    <input type="file" name="ad">
                    <input type="submit" name="submit" value="Upload">
                </form>
            </div>

            <hr>
            <div>
                <p class="display-6 text-center">Previously Uploaded Ads</p>
            </div>

            <?php
            $user_id = $user_info['user_id'];

            $query = "SELECT *
                      FROM Ads
                      WHERE advertiser_id = $user_id";
            $result = mysqli_query($con, $query);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $image_file = "./uploads/" . $row['ad_file'];
            ?>
                <!--<img class="ad_images" src="<?php echo $image_file; ?>" alt="">-->
            <?php }
            } else { ?>
                <p>No images found...</p>
            <?php } ?>
        </div>

        <script src="./js/script.js"></script>
    </body>
</html>
