// Save all selected image to a DataTransfer
var transfer = new DataTransfer();


// Show image when user selected an image
$("#selected-image").change((e) => {
    let imageURL = URL.createObjectURL(e.target.files[0]);
    $("#main-image").attr("src", imageURL);
})


// Show all images in gallery
$("#selected-gallery").change((e) => {
    imageUpdateHandler(transfer);
    galleryUpdate(e.target);
});


// Remove image from fileList
function imageRemoveHandler(index) {
    var fileInput = $('#selected-gallery')[0];
    var fileList = Array.from(fileInput.files);
    var newTransfer = new DataTransfer();
    
    // Remove the selected file from the list
    fileList.splice(index, 1);

    // Add all remaining images to the new DataTransfer
    fileList.forEach(function (file) {
        newTransfer.items.add(file);
    });


    // Change current files list by new files list which removed the selected image
    // to show to user's browser
    fileInput.files = newTransfer.files; 
    galleryUpdate($("#selected-gallery")[0]);

    // Update new files list
    transfer = newTransfer;
}


// Update gallery images
function imageUpdateHandler(DataTransfer) {
    var fileInput = $('#selected-gallery')[0];
    var fileList = Array.from(fileInput.files);

    // Update new images to main DataTransfer
    fileList.forEach(function (file) {
        DataTransfer.items.add(file);
    });

    // Change current files list by updated files list
    fileInput.files = DataTransfer.files; 
}


// Update gallery
function galleryUpdate(inputEl) {
    // Get the old image of motor elements (for motor edit page)
    let galleryOldHtml = ``;
    $(".old-image").each((index, el) => {
        galleryOldHtml += $(el)[0].outerHTML;
    })

    // Refresh gallery, keep the old images only
    $("#gallery-images").html(galleryOldHtml);

    // Add selected images element to gallery
    $(inputEl.files).each((index, element) => {
        let imageURL = URL.createObjectURL(inputEl.files[index]);
        $("#gallery-images").append(`
            <div class="col-span-3 relative">
                <img
                    src="${imageURL}"
                    alt=""
                    class="w-full h-44 object-cover border-2 border-gray-300 rounded-lg"
                />
                <button onclick="imageRemoveHandler(${index});" class="absolute top-2 right-2 bg-white w-10 h-10 rounded-lg border-2 border-red-600 text-red-600 duration-200 hover:bg-red-600 hover:text-white" title="Xóa"><i class="fa-solid fa-trash"></i></button>
            </div>
        `);
    });
}


// Remove old images (for motor edit page)
function oldImageRemover(el, img_id) {
    $(el).parent().remove();

    // Mark the deleted images
    $("#gallery-images").after(`
        <input type="hidden" value="${img_id}" name="deleted_img[]"/>
    `);
}