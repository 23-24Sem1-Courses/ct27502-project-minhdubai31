const deleteConfirmModal = `
    <div id="modal" hidden>
        <!-- Delete modal -->
        <div id="deleteModal" class="fixed inset-0 flex items-center justify-center backdrop-brightness-50">
            <div class="relative p-4 w-full max-w-md h-full md:h-auto">
                <!-- Modal content -->
                <div class="relative p-4 text-center bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                    <button onclick="closeModal();" type="button" class="text-gray-400 absolute top-2.5 right-2.5 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                    <i class="fa-solid text-3xl my-2 text-gray-500 fa-trash"></i>
                    <p id="deleteModalText" class="mb-4 text-gray-500 dark:text-gray-300">Bạn có chắc muốn xóa?</p>
                    <div class="flex justify-center items-center space-x-4">
                        <button onclick="closeModal();" type="button" class="py-2 px-3 text-sm duration-200 text-gray-500 bg-white rounded-lg border-2 border-gray-300 hover:bg-gray-100 focus:ring-primary-300 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                            Hủy
                        </button>
                        <button id="delete-submit" type="submit" class="py-2 px-3 text-sm duration-200 text-center border-2 border-red-600 text-white bg-red-600 rounded-lg hover:bg-red-700 focus:ring-red-300 dark:bg-red-500 dark:hover:bg-red-600 dark:focus:ring-red-900">
                            Xóa
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
`;


// Add delete confirm modal
$("body").append(deleteConfirmModal);


// Hide modal
function closeModal() {
    $("#modal").hide();
}


// Delete confirm function
function deleteConfirm(form, e, delName) {
    e.preventDefault();

    // Modal main text
    $("#deleteModalText").text(`Bạn có chắc muốn xóa ${delName}?`)

    // Show the modal
    $("#modal").show();

    // Listen for delete confirm
    $("#delete-submit").click(() => {
        form.submit();
    }) 
}