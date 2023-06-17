(function (window, document, $) {
    'use strict';

    var humanFriendlyPickr = $('.flatpickr-human-friendly'),
        jqForm = $('#changepass'),
        accountUploadImg = $('#account-upload-img'),
        accountUploadBtn = $('#account-upload');
    var isRtl = $('html').attr('data-textdirection') === 'rtl';

    // Update user photo on click of button
    if (accountUploadBtn) {
        accountUploadBtn.on('change', function (e) {
            var reader = new FileReader(),
                files = e.target.files;
            reader.onload = function () {
                if (accountUploadImg) {
                    accountUploadImg.attr('src', reader.result);
                   // $('#account-upload-test').val(reader.result);
                }
            };
            reader.readAsDataURL(files[0]);

            saveProfile();

            
        });
    }

    // Human Friendly
    if (humanFriendlyPickr.length) {
        humanFriendlyPickr.flatpickr({
            altInput: true,
            altFormat: 'F j, Y',
            dateFormat: 'Y-m-d'
        });
    }

   

   $('form').submit(function (event) {
       // Prevent the default form submission behavior
       event.preventDefault();
   
       // Collect the form data
       var formData = $(this).serialize();

       // For change password
       if ($(this).find('input[name="tab"]').val() == 'changepass') {
           if ($(this).find('input[name="new_password"]').val() != $(this).find('input[name="confirm_new_password"]').val()) {
               $(this).find('input[name="new_password"]').addClass("is-invalid");
               $(this).find('input[name="confirm_new_password"]').addClass("is-invalid");
           } else {
               $(this).find('input[name="new_password"]').removeClass("is-invalid");
               $(this).find('input[name="confirm_new_password"]').removeClass("is-invalid");

               save(formData);
           }
       } else {
           // Send an AJAX request to the server
           save(formData);
       }

   });

    function saveProfile() {
        var formData = new FormData();
        formData.append('tab', 'avatar');
        formData.append('avatar', $('#account-upload')[0].files[0]);

        $.ajax({
            url: '../../api/account/user.php?op=update_user',
            method: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                // Handle the server response
                console.log(response);
                toastr[response.type](
                    response.desc,
                    response.title,
                    {
                        timeOut: 1500,
                        closeButton: true,
                        tapToDismiss: false,
                        progressBar: true,
                        rtl: isRtl
                    }
                )

                if (response.type == 'success') {
                    setTimeout(function () {
                        location.reload();
                    }, 2000);
                }
            },
            error: function (xhr, status, error) {
                console.error('Upload failed: ' + error);
            }
        });
    }

    function save(formData) {
        $.ajax({
            url: '../../api/account/user.php?op=update_user',
            type: 'POST',
            data: formData,
            beforeSend: function () {
                console.log()
            },
            success: function (response) {
                // Handle the server response
                console.log(response);
                toastr[response.type](
                    response.desc,
                    response.title,
                    {
                        timeOut: 1500,
                        closeButton: true,
                        tapToDismiss: false,
                        progressBar: true,
                        rtl: isRtl
                    }
                )

                if (response.type == 'success') {
                    setTimeout(function () {
                        location.reload();
                    }, 2000);
                }
            },
            error: function () {
                alert('Form submission failed.');
            }
        });
    }
   
})(window, document, jQuery);