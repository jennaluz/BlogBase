function upload_comment(a_id, p_id, text, callback) {
    if (p_id == undefined) {
        p_id = "null";
    }
    $.post(
        "../include/upload_comment.inc.php",
        {
            article_id: a_id,
            parent_id: p_id,
            content: text,
        },
        function(result) {
            callback(result);
        }
    );
}

function root_comment(a_id, pic_path) {
    username = $('#username');
    console.log(pic_path);
    text = $('#user-comment-box').val();
    if (pic_path == "") {
        pic_path = "anonymous.jpg";
    }
    upload_comment(a_id, null, text, function(result) {
        if (result == true) {
            $('#user-comment-box').val('');
            $('#new-comment').after(
                `<hr>
                <div class="d-flex my-3">
                    <img src="uploads/profile_pictures/` + pic_path + `" class="me-3 rounded-circle" style="width:45px; height:45px;">
                    <div class="body">
                        <h5 class="fw-bold">
                            ` + username.text() + `
                            <small class="text-muted">Just now</small>
                        </h5>
                        <p class="mb-0">
                            ` + text + `
                        </p>
                        <div class="mb-1">
                            <button class="btn p-1">
                                <span id="like-icon-<?php echo $row['comment_id']?>" class="fa-regular fa-heart">
                            </button>
                        </div>
                    </div>
                </div>`
            );
            return true;
        }
        return false;
    });
}

function reply_comment(a_id, p_id) {
    text = $('#user-comment-box').val();
    upload_comment(a_id, p_id, text, function(result) {
        if (result == true) {
            $('#user-comment-box').val('');
            return true;
        }
        return false;
    });
}

function update_like(c_id, like, callback) {
    if (like == true) {
        var desired_action = "like";
    } else if (like == false) {
        var desired_action = "unlike";
    } else {
        callback(false);
    }

    $.post(
        "../include/like_comment.inc.php",
        {
            action: desired_action,
            comment_id: c_id,
        },
        function(result) {
            callback(result);
        }
    );
}

function change_like_icon(c_id) {
    var like_icon = $('#like-icon-' + c_id);
    var num_likes = $('#num-likes-' + c_id);
    var current_likes = Number(num_likes.text());

    if (like_icon.hasClass("fa-solid")) {
        like = false;
        remove_class = "fa-solid";
        add_class = "fa-regular";
        if (current_likes < 2) {
            new_text = "";
        } else {
            new_text = current_likes - 1;
        }
    } else if (like_icon.hasClass("fa-regular")) {
        like = true;
        remove_class = "fa-regular";
        add_class = "fa-solid";
        new_text = current_likes + 1;
    } else {
        return false;
    }

    update_like(c_id, like, function(result) {
        if (result == true) {
            like_icon.removeClass(remove_class).addClass(add_class);
            num_likes.text(new_text);
            return true;
        }
        return false;
    });
}

function open_reply_textarea(p_id) {
}

function close_reply_textarea(p_id) {
}
