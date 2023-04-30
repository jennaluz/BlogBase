function preview_ad(event) {
    var src = "#";
    var preview = document.getElementById("ad-preview");

    if (event.target.files.length > 0) {
        src = URL.createObjectURL(event.target.files[0]);
        preview.src = src;
        preview.hidden = false;
    } else {
        preview.src = src;
        preview.hidden = true;
    }
}
