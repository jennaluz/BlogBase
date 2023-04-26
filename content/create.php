<?php
//$requested_id = 100;
require_once "../include/connect.inc.php";
include_once "../include/user_info.inc.php";
//include "../include/create_article.inc.php";

// check if user is a writer
if ($user_info['writer'] == false) {
    // redirect to "You don't have access" page
    echo "You don't have access to this page";
}

$requested_id = -1;
$title = "";
$description = "";
$content = "";

if (isset($_GET['id'])) {
    $requested_id = $_GET['id'];
    $user_id = $user_info['user_id'];

    $article_query = "SELECT article_id, author_id, title, description, lead_image, content
                      FROM Articles
                      WHERE article_id = $requested_id AND author_id = $user_id";
    $article_result = mysqli_query($con, $article_query);
    $article_info = $article_result->fetch_assoc();

    if ($article_info == null) {
        echo "does not exist";
    } else {
        $title = $article_info['title'];
        $description = $article_info['description'];
        $content = $article_info['content'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
        <link rel="stylesheet" href="./css/styles.css">

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
        <script src="./js/create.js" type="text/javascript"></script>

        <title>BlogBase Writer</title>

        <script src="../external/ckeditor/ckeditor.js"></script>
    </head>

    <body onload="lead_image('<?php echo $article_info['lead_image']?>')">
        <div class="header">
            <?php include_once "./views/header.php" ?>
        </div>
        <div class="sidebar">
            <?php include_once "./views/sidebar.php" ?>
        </div>

        <!--<h1 style='font-size: 24px; text-align: center; padding-top: 15px;'><strong>Blog Submission's </strong></h1>-->

        <div class="col-10 col-lg-7 mt-5 mx-auto">
            <ul class="list-inline mb-0">
                <li class="list-inline-item">
                    <?php echo $user_info['first_name'] . " " . $user_info['last_name'] ?>
                </li>
                <li class="list-inline-item">
                    <?php echo date("M. d, Y", time()) ?>
                </li>
            </ul>

            <form method="post" enctype="multipart/form-data" action="../include/create_article.inc.php?id=<?php echo $requested_id; ?>&return_page=writer.php">
                <div class="mb-3" id="article-head">
                    <input class="form-control form-control-lg border-0 ounded-0 px-0 title-box mb-1" name="title" type="text" placeholder="Title" value="<?php echo $title; ?>">

                    <textarea class="form-control border-0 rounded-0 px-0" name="description" type="text" placeholder="Description" maxlength="250"><?php echo $description; ?></textarea>
                    <span class="text-end pull-right badge bg-secondary" id="char-count"></span>

                    <div class="input-group mt-3">
                        <label class="input-group-text" for="lead-image" id="lead-image-label">Add Lead</label>
                        <input type="file" class="form-control" id="lead-image" name="file" aria-describedby="upload-lead-image" aria-label="Upload" onchange="preview_lead(event, '<?php echo $article_info['lead_image']; ?>')">
                        <button type="button" id="remove-lead-btn" class="btn btn-outline-danger" onclick="remove_lead()">Remove Lead</button>
                    </div>

                    <div class="preview mt-3">
                        <img id="lead-image-preview" class="lead-img" src="./uploads/leads/<?php echo $article_info['lead_image'];?>">
                        <input type="hidden" id="lead" name="lead" value="1">
                    </div>
                </div>

                <hr>
                <div class="mb-5 article-body">
                    <textarea name="article_draft"><?php echo $content; ?></textarea>
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

                    <button name="save_article" class="btn btn-outline-dark px-2 py-1 mt-3 me-2" type="submit">Save for Later</button>
                    <button name="submit_article" class="btn btn-outline-dark px-2 py-1 mt-3" type="submit">Submit for Approval</button>
                </div>
            </form>
        </div>
    </body>
</html>
