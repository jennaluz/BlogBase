<?php
ob_start();
require_once "./connect.inc.php";
include_once "./user_info.inc.php";

if (isset($_POST['update_account'])) {
    $user_id = $_POST['user-id'];

    if ($user_id != $user_info['user_id']) {
        echo "cannot update";
    }

    $first_name = stripslashes($_POST['first_name']);
    $first_name = mysqli_real_escape_string($con, $first_name);

    $last_name = stripslashes($_POST['last_name']);
    $last_name = mysqli_real_escape_string($con, $last_name);

    $email = stripslashes($_POST['email']);
    $email = mysqli_real_escape_string($con, $email);

    $biography = $_POST['biography'];

    $update_query = "UPDATE Users
                     SET first_name = '$first_name', last_name = '$last_name', email = '$email', biography = '$biography'
                     WHERE user_id = $user_id";

    $result = mysqli_query($con, $update_query);

    $dest_dir = "../content/uploads/profile_pictures/";
    $accepted_types = array('jpg','png','jpeg');

    if (!empty($_FILES['file']['name'])) {
        $filename = basename($_FILES['file']['name']);
        $tmp_filename = $_FILES['file']['tmp_name'];
        $dest_filepath = $dest_dir . $filename;
        $file_type = pathinfo($dest_filepath, PATHINFO_EXTENSION);

        if (in_array($file_type, $accepted_types)) {
            if (move_uploaded_file($tmp_filename, $dest_filepath)) {
                $prof_pic_query = "UPDATE Users
                                   SET profile_picture = '$filename'
                                   WHERE user_id = $user_id";

                $result = mysqli_query($con, $prof_pic_query);
            }
        }
    } else if ($_POST['profile-picture'] == 0) {
        $prof_pic_query = "UPDATE Users
                           SET profile_picture = 'anonymous.jpg'
                           WHERE user_id = $user_id";

        $result = mysqli_query($con, $prof_pic_query);
    }
}

header("Location: ../content/settings.php");
ob_end_flush();
?>
