<?php
require_once "./connect.inc.php";
include_once "./user_info.inc.php";

ob_start();

$dest_dir = "../content/uploads/";
$accepted_types = array('jpg','png','jpeg','gif');

// extract file information
$filename = basename($_FILES['ad']['name']);
$tmp_filename = $_FILES['ad']['tmp_name'];
$dest_filepath = $dest_dir . $filename;
$file_type = pathinfo($dest_filepath, PATHINFO_EXTENSION);

if (isset($_POST['submit']) && !empty($_FILES['ad']['name'])) {
    // check file formatting
    if (in_array($file_type, $accepted_types)) {
        // upload file to server
        if (move_uploaded_file($tmp_filename, $dest_filepath)) {
            $advertiser_id = $user_info['user_id'];

            $query = "INSERT INTO Ads (ad_file, advertiser_id, submit_date)
                      VALUES ('".$filename."', '$advertiser_id', NOW())";
            $result = mysqli_query($con, $query);

            if ($result) {
                echo "The file ".$fileName. " has been successfully uploaded.";
                header("Location: ../content/ads.php");
            } else {
                echo "File upload failed, please try again.";
                header("Location: ../content/ads.php");
            }
        } else {
            echo "There was an error uploading your file.";
            header("Location: ../content/ads.php");
        }
    } else {
        echo "JPG, JPEG, PNG, & GIF are the only accepted file formats.";
        header("Location: ../content/ads.php");
    }

    ob_end_flush();
} else {
    echo "Please select a file to upload.";
    header("Location: ../content/ads.php");
    ob_end_flush();
}
?>
