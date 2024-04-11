$(document).ready(function() {
    $('#submit_btn').click(function() {
      var form = $('#kt_create_reservation_form')[0];
      var formData = new FormData(form);
      $.ajax({
        url: '/src/modules/mail.php',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
          console.log(response);
        },
        error: function(xhr, status, error) {
          console.error('Request failed. Status: ' + status);
        }
      });
    });
  });