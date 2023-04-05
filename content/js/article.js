function role_options(author_id, user_id, writer, designer)
{
    var show_writer = 0;
    var show_designer = 0;

    if (writer != "" && designer != "") {
        if (writer == 1 && author_id == user_id) {
            show_writer = 1;
        }

        if (designer == 1) {
            show_designer = 1;
        }
    }

    if (show_writer == 0) {
        document.getElementById("writer-option").style.display = "none";
    }

    if (show_designer == 0) {
        document.getElementById("designer-option").style.display = "none";
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
            writer_btn[i].style.display = "none";
        }

        for (var i = 0; i < designer_btn.length; i++) {
            designer_btn[i].style.display = "none";
        }
    }

    if (role == "Writer ") {
        for (var i = 0; i < writer_btn.length; i++) {
            writer_btn[i].style.display = "inline";
        }

        for (var i = 0; i < designer_btn.length; i++) {
            designer_btn[i].style.display = "none";
        }
    }

    if (role == "Designer ") {
        for (var i = 0; i < designer_btn.length; i++) {
            designer_btn[i].style.display = "inline";
        }

        for (var i = 0; i < writer_btn.length; i++) {
            writer_btn[i].style.display = "none";
        }
    }
}
