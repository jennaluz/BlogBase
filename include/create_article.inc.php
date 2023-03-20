<?php
if (isset($_REQUEST["new_post"])) {
    $title = $_REQUEST["title"];
    $content = $_REQUEST["editor1"];
    $description = substr($content, 0, 253);

    $sql = "INSERT INTO `Articles` (title, description, content)
            VALUES ('$title','$description','$content')";
    mysqli_query($con, $sql);
}
?>
