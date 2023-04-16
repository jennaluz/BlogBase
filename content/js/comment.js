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

function root_comment(a_id) {
    text = $('#user-comment-box').val();
    upload_comment(a_id, null, text, function(result) {
        if (result == true) {
            $('#user-comment-box').val('');
            return true;
        }
        alert(result);
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

    if (like_icon.hasClass("fa-solid")) {
        like = false;
        remove_class = "fa-solid";
        add_class = "fa-regular";
    } else if (like_icon.hasClass("fa-regular")) {
        like = true;
        remove_class = "fa-regular";
        add_class = "fa-solid";
    } else {
        return false;
    }

    update_like(c_id, like, function(result) {
        if (result == true) {
            like_icon.removeClass(remove_class).addClass(add_class);
            return true;
        }
        return false;
    });
}

function open_reply_textarea(p_id) {
}

function close_reply_textarea(p_id) {
}
