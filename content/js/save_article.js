/*
    * Makes the ajax call to a php script that updates the database
    * Paramaters:
    *   article_id:
    *       type: int
    *       the id of the article that needs the save status to change
    *   save:
    *       type: bool
    *       true if the article should be saved, false if the article should be unsaved
    *   callback:
    *       type: function
    *       will be exectued once the ajax function exits
*/
function save_article(article_id, save, callback) {
    if (save == true) {
        var desired_action = "save";
    } else if (save == false) {
        var desired_action = "unsave";
    } else {
        callback(false);
    }

    $.post(
        "../include/save_article.inc.php",
        { action: desired_action, id: article_id, },
        function(result) {
            callback(result);
    });
}

/*
    * Toggles between fa-regular and fa-solid bookmarks
    * Paramaters:
    *   article_id:
    *       type: int
    *       the id of the article that needs the save status to change
*/
function change_bookmark_icon(article_id) {
    var bookmark_icon = $('#bookmark-icon-' + article_id);

    if (bookmark_icon.hasClass("fa-solid")) {
        save = false;
        remove_class = "fa-solid";
        add_class = "fa-regular";
    } else if (bookmark_icon.hasClass("fa-regular")) {
        save = true;
        remove_class = "fa-regular";
        add_class = "fa-solid";
    } else {
        return false;
    }

    save_article(article_id, save, function(result) {
        if (result == true) {
            bookmark_icon.removeClass(remove_class).addClass(add_class);
            return true;
        }
        return false;
    });
}

function remove_saved_row(article_id) {
    save_article(article_id, false, function(result) {
        if (result == true) {
            $('#article-' + article_id).remove();
            return true;
        }
        return false;
    });
}
