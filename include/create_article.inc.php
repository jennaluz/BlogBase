<!--
Modified: Jenna-Luz Pura
Purpose: Insert or update article fields into/in the database
-->

<?php
require_once "./connect.inc.php";
include_once "./user_info.inc.php";

$return_page = "";

if ($user_info['writer'] == false) {
    echo "You can't do this!";
}


if (isset($_POST['submit_article']) || isset($_POST['save_article'])) {  // create.php
    $article_id = $_GET['id'];
    $user_id = $user_info['user_id'];

    $title = $_POST['title'];
    $content = $_POST['article_draft'];
    $description = $_POST['description'];
    $btn = $_POST['remove_lead'];

    if (isset($_POST['submit_article'])) {
        $submitted = 1;
    } else {  // save article
        $submitted = 0;
    }

    if ($article_id == -1) {  // article does not exist in the database
        $query = "INSERT INTO Articles (author_id, title, description, content, submitted)
                  VALUES ('$user_id', '$title', '$description', '$content', '$submitted')";

        mysqli_query($con, $query);
        $article_id = mysqli_insert_id($con);
        $return_page = "article.php?id=$article_id";
    } else {  // article already exists in the database
        $query = "UPDATE Articles
                  SET title = '$title', description = '$description', content = '$content', submitted = '$submitted'
                  WHERE author_id = $user_id AND article_id = $article_id";

        mysqli_query($con, $query);
        $return_page = "writer.php";
    }

    $dest_dir = "../content/uploads/leads/";
    $accepted_types = array('jpg','png','jpeg','gif');

    if (!empty($_FILES['file']['name'])) {
        $filename = basename($_FILES['file']['name']);
        $tmp_filename = $_FILES['file']['tmp_name'];
        $dest_filepath = $dest_dir . $filename;
        $file_type = pathinfo($dest_filepath, PATHINFO_EXTENSION);

        if (in_array($file_type, $accepted_types)) {
            echo "file " . $filename;
            if (move_uploaded_file($tmp_filename, $dest_filepath)) {
                $lead_query = "UPDATE Articles
                               SET lead_image = '$filename'
                               WHERE article_id = $article_id";

                $result = mysqli_query($con, $lead_query);
            }
        }
    } else if($_POST['lead'] == 0) {
        $remove_lead_query = "UPDATE Articles
                              SET lead_image = NULL
                              WHERE article_id = $article_id";

        $result = mysqli_query($con, $remove_lead_query);
    }

    $return_page = "article.php?id=$article_id";
} else if (isset($_GET['submit_article'])) {  // writer.php
    $article_id = $_GET['submit_article'];
    $user_id = $user_info['user_id'];

    $submit_query = "UPDATE Articles
                     SET submitted = 1
                     WHERE article_id = $article_id AND author_id = $user_id";

    mysqli_query($con, $submit_query);
    $return_page = "article.php?id=$article_id";
} else if (isset($_GET['withdraw_article'])) {  // writer.php
    $article_id = $_GET['withdraw_article'];
    $user_id = $user_info['user_id'];

    $withdraw_query = "UPDATE Articles
                       SET submitted = 0, approved = 0
                       WHERE article_id = $article_id AND author_id = $user_id";

    mysqli_query($con, $withdraw_query);
    $return_page = "writer.php";
} else {}

header("Location: ../content/$return_page");
?>
