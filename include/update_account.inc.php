<?php
ob_start();
require_once "./connect.inc.php";
include_once "./user_info.inc.php";

if (isset($_POST['update_account'])) {
    $username = $_POST['username'];

    if ($user_info['username'] != $username) {
        echo "cannot update";
        header("Location: ./index.php");
        ob_end_flush();
    }

    $user_info_array = array();
    $first_name = stripslashes($_POST['first_name']);
    $first_name = mysqli_real_escape_string($con, $first_name);
    array_push($user_info_array, $first_name);

    $last_name = stripslashes($_POST['last_name']);
    $last_name = mysqli_real_escape_string($con, $last_name);
    array_push($user_info_array, $last_name);

    $email = stripslashes($_POST['email']);
    $email = mysqli_real_escape_string($con, $email);
    array_push($user_info_array, $email);

    $biography = $_POST['biography'];
    array_push($user_info_array, $biography);

    $update_query = "UPDATE Users
                     SET first_name = ?, last_name = ?, email = ?, biography = ?
                     WHERE username = '$username'";

    $update_result = mysqli_execute_query($con, $update_query, $user_info_array);

    if (isset($_POST['old_password'])) {
        $old_password = stripslashes($_POST['old_password']);
        $old_password = mysqli_escape_string($con, $old_password);

        if (password_verify($old_password, $user_info['password'])) {
            $new_password = stripslashes($_POST['new_password']);
            $new_password = mysqli_escape_string($con, $new_password);
            $new_password = password_hash($new_password, PASSWORD_DEFAULT);

            $password_query = "UPDATE Users
                               SET password = ?
                               WHERE username = '$username'";

            $password_result = mysqli_execute_query($con, $password_query, [$new_password]);
        }
    }

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
                                   SET profile_picture = ?
                                   WHERE username = '$username'";

                $result = mysqli_execute_query($con, $prof_pic_query, [$filename]);
            }
        }
    } else if ($_POST['profile-picture'] == 0) {
        $prof_pic_query = "UPDATE Users
                           SET profile_picture = 'anonymous.jpg'
                           WHERE username = '$username'";

        $result = mysqli_query($con, $prof_pic_query);
    }
}

header("Location: ../content/settings.php?username=$username");
ob_end_flush();
?>
