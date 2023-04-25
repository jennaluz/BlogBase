function lead_image(img) {
    const img_label = document.getElementById("lead-image-label");
    const img_preview = document.getElementById("lead-image-preview");

    if (img == null) {
        img_label.innerHTML = "Add Lead";
        img_preview.hidden = true;
    } else {
        img_label.innerHTML = "Change Lead";
        img_preview.hidden = false;
    }
}

//var maxlength = 250;
//$('#char-count').html('0/' + maxlength)
/*
 * Display a preview of an image when file is selected.
 */
function preview_lead(event) {
    var src = "#";
    var preview = document.getElementById("lead-image-preview");

    if (event.target.files.length > 0) {
        var src = URL.createObjectURL(event.target.files[0]);

        preview.src = src;
        preview.style.display = "block";
    } else if (event.target.files.length == 0) {
        preview.src = src;
        preview.style.display = "none";
    }
}
