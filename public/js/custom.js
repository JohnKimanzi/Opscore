// Update Projects
$(document).on("click", "#edit-proj-btn", function () {
    var lesson_id = $(this).data('id');
    $("#course_token #lesson_id").val( lesson_id );
    document.getElementById("course_name").innerText= $(this).data('name');          
});