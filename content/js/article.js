
/*
 * Hide appropriate dropdown menu options based on user roles.
 */
function role_options(roles_json)
{
    // parse json
    var author_id = roles_json.author_id;
    var submitted = roles_json.submitted;
    var user_id = roles_json.user_id;
    var writer = roles_json.writer;
    var designer = roles_json.designer;

    console.log(submitted);
    var show_writer = 0;
    var show_designer = 0;

    if (writer != null && designer != null) {
        if (writer == 1 && author_id == user_id) {
            show_writer = 1;
        }

        if (designer == 1 && submitted == 1) {
            show_designer = 1;
        }
    }

    if (show_writer == 0) {
        document.getElementById("writer-option").hidden = true;
    }

    if (show_designer == 0) {
        document.getElementById("designer-option").hidden = true;
    }
}


/*
 * Change the text value of the dropdown menu and hides role buttons based on role.
 */
function change_role(role) {
    const role_btn = document.getElementById("role-btn");
    const writer_btn = document.getElementsByClassName("writer-btn");
    const designer_btn = document.getElementsByClassName("designer-btn");

    // change dropdown button text
    role_btn.innerHTML = role;

    // hide and show buttons based on role.
    if (role == "Reader ") {
        for (var i = 0; i < writer_btn.length; i++) {
            writer_btn[i].hidden = true;
        }

        for (var i = 0; i < designer_btn.length; i++) {
            designer_btn[i].hidden = true;
        }
    }

    if (role == "Writer ") {
        for (var i = 0; i < writer_btn.length; i++) {
            writer_btn[i].hidden = false;
        }

        for (var i = 0; i < designer_btn.length; i++) {
            designer_btn[i].hidden = true;
        }
    }

    if (role == "Designer ") {
        for (var i = 0; i < designer_btn.length; i++) {
            designer_btn[i].hidden = false;
        }

        for (var i = 0; i < writer_btn.length; i++) {
            writer_btn[i].hidden = true;
        }
    }
}
