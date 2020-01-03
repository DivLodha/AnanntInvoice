function btn_click(formId, submitButton) {
    

    $form_obj = $(formId);
    
    $form_obj.validate({

       
        errorPlacement: function(error, element) {

            // Get inputs with this name
            var obj = $('[name="' + element.attr('name') + '"]');

            // Are there multiple?
            if (obj.length > 1) {
                // Add error after whatever the parent element is of the last one
                error.insertAfter(obj.last().parent());
            } else {
                // Default, add error after the input
                error.insertAfter(obj);
            }


        }

    });


    if ($form_obj.valid() == true) {
        
        $(submitButton).addClass('disabled').removeAttr("href"); 
        $(submitButton).html('<i class="fa fa-refresh fa-spin"></i>&nbsp; Submit');
        $form_obj.submit();
                       
        }
        else {
            var $scrollTo = $($(document).find('input.error:not([style*="display: none"])')[0]);
            $(formId).animate({ scrollTop: $scrollTo.offset().top - 200 }, 300);
            return false;
        }

}

