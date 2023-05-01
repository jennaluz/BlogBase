function load_profile(prof_pic_file, roles) {
    const input_file = document.getElementById("profile-image-input");
    const remove_btn = document.getElementById("remove-profile-picture-btn");
    const role_badges = document.getElementsByClassName("role-badge");

    if (prof_pic_file != "anonymous.jpg") {
        input_file.classList.remove("rounded");
        remove_btn.hidden = false;
    }

    for (var i = 0; i < role_badges.length; i++) {
        var role = role_badges[i].innerHTML;

        if (roles[role] == 0) {
            role_badges[i].disabled = true;
        }
    }
}


function update() {
    const update_btns = document.getElementById("update-btns");
    update_btns.hidden = false;
}


function preview_profile(event, img) {
    var src = "./uploads/profile_pictures/" + img;
    const prof_pic = document.getElementById("profile-picture");
    const prof_pic_input = document.getElementById("profile-picture-input");
    const input_file = document.getElementById("profile-image-input");
    const remove_btn = document.getElementById("remove-profile-picture-btn");

    if (event.target.files.length > 0) {
        src = URL.createObjectURL(event.target.files[0]);
        remove_btn.innerHTML = "Remove";
        prof_pic_input.value="1";

        input_file.classList.remove("rounded");
        remove_btn.hidden = false;
    }

    prof_pic.src = src;

    update();
}


function remove_profile_picture() {
    const prof_pic = document.getElementById("profile-picture");
    const prof_pic_input = document.getElementById("profile-picture-input");
    const input_file = document.getElementById("profile-image-input");
    const remove_btn = document.getElementById("remove-profile-picture-btn");

    prof_pic.src = "./uploads/profile_pictures/anonymous.jpg";
    prof_pic_input.value = "0";
    input_file.value = "";
    input_file.classList.add("rounded");
    remove_btn.hidden = true;

    update();
}
