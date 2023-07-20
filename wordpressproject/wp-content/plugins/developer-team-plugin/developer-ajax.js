var developer_ajax_object = {
  ajax_url: '<?php echo admin_url('admin-ajax.php'); ?>'
};


// developer-ajax.js
jQuery(document).ready(function($) {
  $('#developer-form').submit(function(event) {
    event.preventDefault();

    const form = $(this);
    const formData = new FormData(form[0]);

    $.ajax({
      type: 'POST',
      url: developer_ajax_object.ajax_url,
      data: formData + '&action=create_developer_member',
      contentType: false,
      processData: false,
      cache: false,
      beforeSend: function() {
        $('#message-container').html('');
      },
      success: function(response) {
        if (response.success) {
          $('#message-container').html('<div class="success">' + response.data.message + '</div>');
          form[0].reset();

          // Display the new Developer post link
          $('#message-container').append('<div><a href="' + response.data.post_id + '">View Developer</a></div>');
        } else {
          $('#message-container').html('<div class="error">' + response.data + '</div>');
        }
      },
      error: function() {
        $('#message-container').html('<div class="error">An error occurred. Please try again later.</div>');
      }
    });
  });
});
