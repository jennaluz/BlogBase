<script src="./js/comment.js"></script>

<?php
$comments_query = "SELECT u.username, c.comment_id, c.article_id, c.parent_id, c.submitter_id, c.content, UNIX_TIMESTAMP(c.submit_date) as submit_date, n.num_likes
                   FROM Comments AS c LEFT JOIN (
                       SELECT l.comment_id, count(l.comment_id) AS num_likes
                       FROM LikedComments AS l
                       GROUP BY l.comment_id) AS n ON c.comment_id = n.comment_id
                       LEFT JOIN Users as u on c.submitter_id = u.user_id
                   WHERE c.article_id = ?
                   ORDER BY num_likes DESC, submit_date DESC;";
$comments_result = mysqli_execute_query($con, $comments_query, [$article_info['article_id']]);
$num_comments = $comments_result->num_rows;


?>

<div class="offcanvas offcanvas-end bg-light" data-bs-scroll="true" tabindex="-1" id="offcanvas-comments" aria-labelledby="offcanvas-comments-label">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvas-comments-label">Comments (<?php echo $num_comments + 10 ?>)</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div>
            <div id="new-comment" class="card mb-2">
                <div class="d-flex m-3">
                    <img src="uploads/profile_pictures/anonymous.jpg" class="me-3 rounded-circle" style="width:45px; height:45px;">
                    <div class="body">
                        <h5 id="username" class="fw-bold"><?php echo isset($user_info['username']) ? $user_info['username'] : "anonymous"; ?></h5>
                        <textarea class="form-control border-0 p-0" id="user-comment-box" placeholder="Add a comment..." style="resize: none; box-shadow: none"></textarea>
                    </div>
                </div>
                <button onclick="root_comment(<?php echo $article_info['article_id']; ?>)" class="m-3 ms-auto btn btn-outline-dark rounded-pill">Submit</button>
            </div>

            <?php while ($row = $comments_result->fetch_assoc()) { ?>
                <hr>
                <div class="d-flex my-3">
                    <img src="uploads/profile_pictures/anonymous.jpg" class="me-3 rounded-circle" style="width:45px; height:45px;">
                    <div class="body">
                        <h5 class="fw-bold">
                            <?php
                            if (isset($row['username'])) {
                                echo $row['username'];
                            } else {
                                echo "anonymous";
                            }
                            ?>
                            <small class="text-muted">
                                <?php echo date("M. d, Y", $row['submit_date']); ?>
                            </small>
                        </h5>
                        <p class="mb-0">
                            <?php echo $row['content'] ?>
                        </p>
                        <div class="mb-1">
                            <?php
                            if (isset($_SESSION['user_info'])) {
                                $liked_query = "SELECT comment_id, user_id
                                                FROM LikedComments
                                                WHERE user_id = " . $user_info['user_id'] . " AND comment_id = " . $row['comment_id'] . "";
                                $liked_result = mysqli_query($con, $liked_query);
                            ?>
                            <button onclick="change_like_icon(<?php echo $row['comment_id'] ?>)" class="btn p-1">
                                <?php if ($liked_result->num_rows == 1) { ?>
                                    <span id="like-icon-<?php echo $row['comment_id']?>" class="fa-solid fa-heart">
                                <?php } else { ?>
                                    <span id="like-icon-<?php echo $row['comment_id']?>" class="fa-regular fa-heart">
                                <?php } ?>
                                <?php echo "<span id='num-likes-" . $row['comment_id'] . "' class=''>" . $row['num_likes'] . "</span>"; ?>
                                    </span>
                            </button>
                            <?php } else { ?>
                                <a href="./login.php" class="btn p-1">
                                    <span id="like-icon" class="fa-regular fa-heart">
                                    <?php echo "<span class=''>" . $row['num_likes'] . "</span>"; ?>
                                </a>
                            <?php } ?>
                            <?php
                                if ($row['num_likes'] > 0) {
                                }
                            ?>
                            <button class="btn p-1">Reply</button>
                        </div>
                    </div>
                </div>
            <?php } ?>

            <hr>

            <div class="d-flex my-3">
                <img src="uploads/profile_pictures/anonymous.jpg" class="me-3 rounded-circle" style="width:45px; height:45px;">
                <div class="body">
                    <h5 class="fw-bold">
                        anonymous
                        <small class="text-muted">April 14, 2023</small>
                    </h5>
                    <p class="mb-0">
                        Wow, this is an awesome article!
                    </p>
                    <div class="mb-1">
                        <button class="btn p-1">
                            <span id="like-icon-<?php echo $row['comment_id']?>" class="fa-regular fa-heart">
                        </button>
                        <button class="btn p-1">Reply</button>
                    </div>
                </div>
            </div>
            <div class="d-flex my-3">
                <div class="mx-3 ps-1 vr"></div>
                <img src="uploads/profile_pictures/anonymous.jpg" class="me-3 rounded-circle" style="width:45px; height:45px;">
                <div class="body">
                    <h5 class="fw-bold">
                        anonymous
                        <small class="text-muted">April 14, 2023</small>
                    </h5>
                    <p class="mb-0">
                        You're right about that!
                    </p>
                    <div class="mb-1">
                        <button class="btn p-1">
                            <span class="fa-regular fa-heart">
                        </button>
                        <button class="btn p-1">Reply</button>
                    </div>
                </div>
            </div>

            <hr>

            <div class="d-flex my-3">
                <img src="uploads/profile_pictures/anonymous.jpg" class="me-3 rounded-circle" style="width:45px; height:45px;">
                <div class="body">
                    <h5 class="fw-bold">
                        anonymous
                        <small class="text-muted">April 14, 2023</small>
                    </h5>
                    <p class="mb-0">
                        This has changed my life!
                    </p>
                    <div class="mb-1">
                        <button class="btn p-1">
                            <span class="fa-regular fa-heart">
                        </button>
                        <button class="btn p-1">Reply</button>
                    </div>
                </div>
            </div>
            <div class="d-flex my-3 flex-wrap">
                <div class="mx-3 ps-1 vr"></div>
                <div>
                    <div class="d-flex mb-3">
                        <img src="uploads/profile_pictures/anonymous.jpg" class="me-3 rounded-circle" style="width:45px; height:45px;">
                        <div class="body">
                            <h5 class="fw-bold">
                                anonymous
                                <small class="text-muted">April 14, 2023</small>
                            </h5>
                            <p class="mb-0">
                                Mine too!
                            </p>
                            <div class="mb-1">
                                <button class="btn p-1">
                                    <span class="fa-regular fa-heart">
                                </button>
                                <button class="btn p-1">Reply</button>
                            </div>
                        </div>
                    </div>

                    <hr class="w-100">

                    <div class="d-flex">
                        <img src="uploads/profile_pictures/anonymous.jpg" class="me-3 rounded-circle" style="width:45px; height:45px;">
                        <div class="body">
                            <h5 class="fw-bold">
                                anonymous
                                <small class="text-muted">April 14, 2023</small>
                            </h5>
                            <p class="mb-0">
                                You thought so too?
                            </p>
                            <div class="mb-1">
                                <button class="btn p-1">
                                    <span class="fa-regular fa-heart">
                                </button>
                                <button class="btn p-1">Reply</button>
                            </div>
                        </div>
                    </div>

                    <hr class="w-100">

                    <div class="d-flex mb-3">
                        <img src="uploads/profile_pictures/anonymous.jpg" class="me-3 rounded-circle" style="width:45px; height:45px;">
                        <div class="body">
                            <h5 class="fw-bold">
                                anonymous
                                <small class="text-muted">April 14, 2023</small>
                            </h5>
                            <p class="mb-0">
                                It was alright.
                            </p>
                            <div class="mb-1">
                                <button class="btn p-1">
                                    <span class="fa-regular fa-heart">
                                </button>
                                <button class="btn p-1">Reply</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <hr>

            <div class="d-flex my-3">
                <img src="uploads/profile_pictures/anonymous.jpg" class="me-3 rounded-circle" style="width:45px; height:45px;">
                <div class="body">
                    <h5 class="fw-bold">
                        anonymous
                        <small class="text-muted">April 14, 2023</small>
                    </h5>
                    <p class="mb-0">
                        You have no idea what you're talking about.
                    </p>
                    <div class="mb-1">
                        <button class="btn p-1">
                            <span class="fa-regular fa-heart">
                        </button>
                        <button class="btn p-1">Reply</button>
                    </div>
                </div>
            </div>
            <div class="d-flex my-3 flex-wrap">
                <div class="mx-3 ps-1 vr"></div>
                <div style="width: 89%">
                    <div class="d-flex mb-3">
                        <img src="uploads/profile_pictures/anonymous.jpg" class="me-3 rounded-circle" style="width:45px; height:45px;">
                        <div class="body">
                            <h5 class="fw-bold">
                                anonymous
                                <small class="text-muted">April 14, 2023</small>
                            </h5>
                            <p class="mb-0">
                                Hey, be kind.
                            </p>
                            <div class="mb-1">
                                <button class="btn p-1">
                                    <span class="fa-regular fa-heart">
                                </button>
                                <button class="btn p-1">Reply</button>
                            </div>
                        </div>
                    </div>

                    <hr class="w-100">

                        <div class="card mb-2">
                            <div class="d-flex m-3">
                                <img src="uploads/profile_pictures/anonymous.jpg" class="me-3 rounded-circle" style="width:45px; height:45px;">
                                <div class="body">
                                    <h5 class="fw-bold">anonymous</h5>
                                    <textarea class="form-control border-0 p-0" id="user-comment-box" placeholder="Add a comment..." style="resize: none; box-shadow: none"></textarea>
                                </div>
                            </div>
                            <button onclick="root_comment(<?php echo $article_info['article_id']; ?>)" class="m-3 ms-auto btn btn-outline-dark rounded-pill">Submit</button>
                        </div>

                    <hr class="w-100">

                    <div class="d-flex">
                        <img src="uploads/profile_pictures/anonymous.jpg" class="me-3 rounded-circle" style="width:45px; height:45px;">
                        <div class="body">
                            <h5 class="fw-bold">
                                anonymous
                                <small class="text-muted">April 14, 2023</small>
                            </h5>
                            <p class="mb-0">
                                Why don't you try to do better?
                            </p>
                            <div class="mb-1">
                                <button class="btn p-1">
                                    <span class="fa-regular fa-heart">
                                </button>
                                <button class="btn p-1">Reply</button>
                            </div>
                        </div>
                    </div>

                    <hr class="w-100">

                    <div class="d-flex mb-3">
                        <img src="uploads/profile_pictures/anonymous.jpg" class="me-3 rounded-circle" style="width:45px; height:45px;">
                        <div class="body">
                            <h5 class="fw-bold">
                                anonymous
                                <small class="text-muted">April 14, 2023</small>
                            </h5>
                            <p class="mb-0">
                                There's no room on BlogBase for naysayers!
                            </p>
                            <div class="mb-1">
                                <button class="btn p-1">
                                    <span class="fa-regular fa-heart">
                                </button>
                                <button class="btn p-1">Reply</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
