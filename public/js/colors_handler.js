$(function () {
    // Add new color input field
    $("#add-color").click((e) => {
        let addcolor = `
                <div class="w-full mb-2 flex items-center gap-1">
                    <input required class="motor-color rounded-lg leading-relaxed p-2 px-5 focus:outline-none" placeholder="Tên màu" type="text" name="color_name[]">
                    <div class="clr-field">
                        <button type="button" aria-labelledby="clr-open-label" class="rounded-r-lg"></button>
                        <input required class="rounded-lg w-36 leading-relaxed p-2 px-5 focus:outline-none" placeholder="Mã màu" type="text"  name="color_hex[]" data-coloris>
                    </div>
                    <button onclick="removeColor(this);" class="ms-1 bg-white w-10 h-10 rounded-lg border-2 border-red-600 text-red-600 duration-200 hover:bg-red-600 hover:text-white" title="Xóa"><i class="fa-solid fa-trash"></i></button>
                </div>
            `;

        $(e.target).parent().before(addcolor);
    });
});


// Remove a color input field
function removeColor(el) {
    $(el).parent().remove();
}