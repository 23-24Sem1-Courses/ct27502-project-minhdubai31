// Add new type form
function addNewType(element) {
    const form = `
        <div class="col-span-1 rounded-lg bg-gray-50 box-border border-2 p-3 px-6 text-center">
            <form action="/types/store" method="post">
                <input required class="text-xl w-full border-2 mb-6 rounded-lg p-2 text-center font-bold uppercase placeholder:text-sm placeholder:text-gray-300" type="text" placeholder="Tên dòng xe" name="type_name">
                <div class="flex items-center gap-2 justify-center">
                    <button type="submit" class="h-10 px-3 inline-block rounded-lg border-2 border-blue-600 text-blue-600 duration-200 hover:bg-blue-600 hover:text-white" title="Thêm"><i class="fa-solid fa-plus"></i></button>
                    <button onclick="cancelNewTypeForm(this);" class="h-10 px-3 inline-block rounded-lg border-2 border-red-600 text-red-600 duration-200 hover:bg-red-600 hover:text-white" title="Hủy">Hủy</button>
                </div>
            </form>
        </div>
    `;

    $(element).before(form);
}


// Cancel Add new type form
function cancelNewTypeForm(btn) {
    $(btn).parent().parent().parent().remove();
}


// Show the type edit form
function editType(btn) {
    $(btn).closest(".type-show").next(".type-edit").show();
    $(btn).closest(".type-show").hide();
}


// Hide the type edit form
function hideEditTypeForm(btn) {
    $(btn).closest(".type-edit").prev(".type-show").show();
    $(btn).closest(".type-edit").hide();
}