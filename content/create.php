<?php
require_once "../include/connect.inc.php";
include_once "../include/auth_create.inc.php";
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, intitial-scale=1">

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
        <link rel="stylesheet" href="./css/styles.css">

        <title>BlogBase</title>

        <script src="../external/ckeditor/ckeditor.js">
            CKEDITOR.editorConfig = function(config) {
                config.toolbarGroups = [{
                        name: 'document',
                        groups: ['mode', 'document', 'doctools']
                    },
                    {
                        name: 'clipboard',
                        groups: ['clipboard', 'undo']
                    },
                    {
                        name: 'editing',
                        groups: ['find', 'selection', 'spellchecker', 'editing']
                    },
                    {
                        name: 'forms',
                        groups: ['forms']
                    },
                    {
                        name: 'basicstyles',
                        groups: ['basicstyles', 'cleanup']
                    },
                    {
                        name: 'paragraph',
                        groups: ['list', 'indent', 'blocks', 'align', 'bidi', 'paragraph']
                    },
                    {
                        name: 'links',
                        groups: ['links']
                    },
                    {
                        name: 'insert',
                        groups: ['insert']
                    },
                    {
                        name: 'styles',
                        groups: ['styles']
                    },
                    {
                        name: 'colors',
                        groups: ['colors']
                    },
                    {
                        name: 'tools',
                        groups: ['tools']
                    },
                    {
                        name: 'others',
                        groups: ['others']
                    },
                    {
                        name: 'about',
                        groups: ['about']
                    }
                ];

                config.removeButtons = 'Cut,Copy,Paste,Undo,Redo,Anchor,Underline,Strike,Subscript,Superscript';
            };
        </script>
    </head>

    <body>
        <div class="header">
            <?php include "./views/header.php" ?>
        </div>
        <div class="sidebar">
            <?php include "./views/sidebar.php" ?>
        </div>

        <?php
        // this is the place that sets up the authentification for the page in tandom with auth_session.php
        $current_user = $_SESSION['username'];

        $test_auth = "SELECT username
                      FROM `Users`
                      WHERE username ='$current_user' AND writer = 1";
        $help = $con->query($test_auth);

        if($help->num_rows > 0){
            //the rest of the statement is at the bottom and applies if the user doesn't have the proper
            //access to the page. If they dont they are not able to see any of the information
        ?>
            <h1 style='font-size: 24px; text-align: center; padding-top: 15px;'><strong>Blog Submission's </strong></h1>
            <div style='align-items: center; text-align:center;'class="makePost">
                <form method="Get">
                    <br>
                    <br>
                    <input style='color:black; background-color: white; height: 30px; text-align:center;' type="text" name="title" placeholder="POST TITLE" class="title-box">
                    <br>
                    <br>
                    <textarea name="editor1"></textarea>
                    <script>CKEDITOR.replace('editor1');</script>
                    <br>
                    <button name="new_post" class="btn">Save Post</button>
                </form>
            </div>
        <?php
        } else {
        ?>
            <center>
                <p><h3>You do not have access to the writer page.</h3></p>
                <br>
                <p><h3>Return to <a href="./index.php">Home?</a></h3></p>
            </center>
        <?php
        }
        ?>

        <script src="./js/script.js"></script>
    </body>
</html>
