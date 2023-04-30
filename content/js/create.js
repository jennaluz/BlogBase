function lead_image(img) {
    const img_label = document.getElementById("lead-image-label");
    const img_preview = document.getElementById("lead-image-preview");

    if (img == "") {
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
function preview_lead(event, img) {
    var src = "./uploads/leads/" + img;
    var preview = document.getElementById("lead-image-preview");

    if (event.target.files.length > 0) {
        src = URL.createObjectURL(event.target.files[0]);
        preview.src = src;
        preview.hidden = false;
    } else if (img != "") {
        preview.src = src;
        preview.hidden = false;
    } else {
        preview.hidden = true;
    }
}

function remove_lead() {
    var preview = document.getElementById("lead-image-preview");
    var remove_btn = document.getElementById("remove-lead-btn");
    var lead = document.getElementById("lead");

    preview.src = "#";
    preview.style.display = "none";
    lead.value = "0";
    remove_btn.innerHTML = "Removed";
}
