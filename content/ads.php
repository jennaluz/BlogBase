<?php
require_once "../include/connect.inc.php";
include_once "../include/user_info.inc.php";

if ($user_info['advertiser'] == false) {
    echo "You don't have access to this page";
}

$user_id = $user_info['user_id'];

$ad_query = "SELECT *
             FROM Ads
             WHERE advertiser_id = $user_id";

$result = mysqli_query($con, $ad_query);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
        <link rel="stylesheet" href="css/styles.css">

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
        <script src="./js/ads.js"></script>

        <title>BlogBase Advertiser</title>
    </head>

    <body>
        <div class="header">
            <?php include "./views/header.php" ?>
        </div>

        <div class="sidebar">
            <?php include "./views/sidebar.php" ?>
        </div>

        <div class="col-10 col-lg-7 mt-5 mx-auto">
            <div class="text-center">
                <p class="display-3 mt-3">Spread the Word!</p>
                <p>Upload your ads to BlogBase to show to our viewers!</p>
            </div>

            <div class="col-10 col-lg-7 my-5 mx-auto text-center">
                <form method="post" action="../include/upload_img.inc.php?img=ad" enctype="multipart/form-data">
                    <div class="input-group">
                        <input class="form-control" type="file" name="file" onchange="preview_ad(event)">
                        <button class="btn btn-outline-dark" type="submit" name="submit">Upload</button>
                    </div>
                </form>

                <div class="preview mt-3">
                    <img id="ad-preview" class="ad-img img-fluid" src="#" hidden>
                </div>
            </div>

            <?php if ($result->num_rows > 0) { ?>
                <hr>
                <div>
                    <p class="display-6 text-center m-3">Previously Uploaded Ads</p>
                </div>

                <?php while ($row = $result->fetch_assoc()) {
                    $ad_file = "./uploads/ads/" . $row['ad_file'];
                ?>

                    <img class="ad-img img-fluid" src="<?php echo $ad_file; ?>" alt="">
                <?php }
            } ?>
        </div>

    </body>
</html>
