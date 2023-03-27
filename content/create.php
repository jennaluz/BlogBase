<?php
require_once "../include/connect.inc.php";
include_once "../include/user_info.inc.php";
include "../include/create_article.inc.php";

// check if user is a writer
if ($user_info['writer'] == false) {
    // redirect to "You don't have access" page
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
        <link rel="stylesheet" href="./css/styles.css">

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

        <title>BlogBase Writer</title>

        <script src="../external/ckeditor/ckeditor.js"></script>
    </head>

    <body>
        <div class="header">
            <?php include_once "./views/header.php" ?>
        </div>
        <div class="sidebar">
            <?php include_once "./views/sidebar.php" ?>
        </div>

        <!--<h1 style='font-size: 24px; text-align: center; padding-top: 15px;'><strong>Blog Submission's </strong></h1>-->

        <div class="col-10 col-lg-7 mt-3 mx-auto">
            <ul class="list-inline mb-0">
                <li class="list-inline-item">
                    <?php echo $user_info['first_name'] . " " . $user_info['last_name'] ?>
                </li>
                <li class="list-inline-item">
                    <?php echo date("M. d, Y", time()) ?>
                </li>
            </ul>
            <form method="post">
                <div class="col-10 col-lg-8 mb-3">
                    <input class="form-control form-control-lg border border-0 border-bottom border-2 rounded-0 px-0 title-box" name="title" type="text" placeholder="Title">
                </div>
                <textarea name="article_draft"></textarea>
                <script>
                    CKEDITOR.replace('article_draft', {
                        toolbarGroups: [
                            { name: 'tools', groups: ['tools'] },
                            { name: 'document', groups: ['mode', 'document'] },
                            { name: 'links', groups: ['links'] },
                            { name: 'forms', groups: ['forms'] },
                            { name: 'insert', groups: ['insert'] },
                            '/',
                            { name: 'clipboard', groups: ['undo', 'clipboard'] },
                            { name: 'paragraph', groups: ['list', 'indent', 'blocks', 'align', 'bidi', 'paragraph'] },
                            { name: 'editing', groups: ['find', 'spellchecker', 'editing'] },
                            '/',
                            { name: 'colors', groups: ['colors'] },
                            { name: 'basicstyles', groups: ['basicstyles', 'cleanup'] },
                            { name: 'styles', groups: ['styles'] },
                        ],
                        toolbarCanCollapse: true,
                    });
                </script>
                <button name ="create_article" class="btn btn-outline-dark px-2 py-1 mt-3" type="submit">Submit</button>
            </form>
        </div>
    </body>
</html>
