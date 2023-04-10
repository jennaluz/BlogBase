function edit_user() {
    var btn = document.getElementById('edit-btn');
    var btn_text = btn.innerHTML;
    var user_info = document.getElementsByClassName('user-info');
    var user_info_form = document.getElementsByClassName('user-info-form');

    if (btn_text == "Edit") {
        btn.innerHTML = "Save";

        /*
        for (var i = 0; i < user_info.length; i++) {
            user_info[i].hidden = true;
        }

        for (var i = 0; i < user_info_form.length; i++) {
            user_info_form[i].hidden = false;
        }
        */
    } else {
        btn.innerHTML = "Edit";

        /*
        for (var i = 0; i < user_info_form.length; i++) {
            user_info_form[i].hidden = true;
        }

        for (var i = 0; i < user_info.length; i++) {
            user_info[i].hidden = false;
        }
        */
    }
}
