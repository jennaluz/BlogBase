function preview_profile(event, img) {
    var src = "./uploads/profile_pictures/" + img;
    var prof_pic = document.getElementById("profile-picture");

    console.log("image " + img);

    if (event.target.files.length > 0) {
        src = URL.createObjectURL(event.target.files[0]);
    }

    prof_pic.src = src;
}
