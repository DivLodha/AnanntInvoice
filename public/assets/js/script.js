// Reponsive Menu Script
jQuery(document).ready(function($) {
        $('.w-menu ul li:has(ul)').prepend('<span class="arrow-plus" />');
        $(".arrow-plus").click(function() {

            $(this).parent('li').find('ul:first').toggleClass('w-submenu');
            $(this).toggleClass('arrow-minimize');
        });

        $('.mobile-menu-icon').click(function(e) {
            e.preventDefault();
            $(".mobile-menu-icon").toggleClass('icon-open');
            $(".mobile-menu").toggleClass('menu-open');
            $('.w-menu ul').removeClass('w-submenu');
            $('.arrow-plus').removeClass('arrow-minimize');
        });
    })
    //FAQ tabing 
jQuery('body').on('click', '#faq_ttl_list li a', function() {
    var li_lenth = jQuery(this).parent().index();
    jQuery("#faq_ttl_list li").removeClass('active');
    jQuery(this).parent().addClass("active");

    jQuery("#faq_data_list .tab-pane").removeClass('fade active in');
    jQuery("#faq_data_list .tab-pane").eq(li_lenth).addClass('fade active in');
});

//event detail page tabing
jQuery('body').on('click', '#event_detail li a', function() {
    var li_lenth = jQuery(this).parent().index();
    jQuery("#event_detail li").removeClass('active');
    jQuery(this).parent().addClass("active");

    jQuery("#event_detail_list .tab-pane").removeClass('fade active in');
    jQuery("#event_detail_list .tab-pane").eq(li_lenth).addClass('fade active in');
});

$(document).ready(function() {
    $(document).on('change', '.btn-file :file', function() {
        var input = $(this),
            label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
        input.trigger('fileselect', [label]);
    });

    $('.btn-file :file').on('fileselect', function(event, label) {

        var input = $(this).parents('.input-group').find(':text'),
            log = label;

        if (input.length) {
            input.val(log);
        } else {
            if (log) alert(log);
        }

    });

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#img-upload').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#imgInp").change(function() {
        readURL(this);
    });

    // FAQs accordion
    var allPanels = $('.faq-list-que .faqs-que-section .accord-content').hide();
    var heads = $('.faq-list-que .faqs-que-section .que-title');
    $(heads).on('click', function() {
        $this = $(this);
        $target = $this.parent().find('div.accord-content');
        if (!$target.hasClass('active')) {
            heads.removeClass('selected');
            $this.addClass('selected');
            allPanels.removeClass('active').slideUp();
            $target.addClass('active').slideDown();
        }
    });


    //fellowship application form validation
    $("#fellowship_application_form").validate();
    // $("#app_form_step2").validate();
    form_submit = 0;

    $(document).on('click', "#btn_submit1", function() {
        form_submit = 1;
        return validate_step_form_files();
    });
    $(document).on('change', "input[type*='file']", function() {
        if (form_submit == 1) {
            validate_step_form_files();
        }
    });
});
/**
 *
 * validate step form input files
 * */
function validate_step_form_files() {
    form_error = true;
    $('.error').each(function() {
        $(this).remove();
    });
    //loop each inpout file and validate, show error message
    var i = 1;
    $("input[type*='file']").each(function() {
        if ($(this)[0].value == "") {
            $(this).parents('.input-group').append('<label id="imgInp-error" class="error">This field is required.</label>');
            form_error = false;
        }
    });
    return form_error;
}