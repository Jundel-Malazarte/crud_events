$('#studentForm').on('submit', function(e) {
    e.preventDefault();
    
    $.ajax({
        url: 'add_student.php', // The URL to the PHP file handling the request
        type: 'POST',
        data: $(this).serialize(), // Serialize the form data
        dataType: 'json', // Expect a JSON response
        success: function(response) {
            $('#alertMessage').text(response.message).parent().fadeIn();
        },
        error: function() {
            $('#alertMessage').text('Error adding student. Please try again.').parent().fadeIn();
        }
    });
});
