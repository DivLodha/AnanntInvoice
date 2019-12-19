function stringGen(len) {
    var text = "";
    var charset = "abcdefghijklmnopqrstuvwxyz0123456789";
    for (var i = 0; i < len; i++)
        text += charset.charAt(Math.floor(Math.random() * charset.length));
    return text;
}


/***************************Start  group items show hide **********************************************/
$(document).ready(function() {
    jQuery(document).on('change', '.show_hide_fields', function() {
        var $value = '';
        if ($(this).data('fieldtype') == "checkbox" && this.checked) {
            $value = $(this).data('groupvalue');
        }
        if ($(this).data('fieldtype') == "radio" && this.checked) {
            $value = $(this).data('groupvalue');
        }
        if (jQuery(this).val() == $value) {
            jQuery(jQuery(this).data('hidegroup')).show();
        } else {
            jQuery(jQuery(this).data('hidegroup')).hide();
        }
    });
    /***************************end   group items show hide **********************************************/


    /***************************Start  Add remove new file upload browser button **********************************************/
    //add delete file input
    jQuery(document).on('click', '.add-remove-file', function() {
        if ($(this).data('addremove') == 'add') {
            var count = $($(this).data('fileuploadcontainer')+' .file-input-container').length;
            var fieldid = $(this).data('fieldid');
            var required = $(this).data('required');
            var error_enabled = $(this).data('errorenabled');
            var name ="";
            fieldname = $(this).data('fieldname');
            if($(this).data('uniquefieldname')){
                fieldname = $(this).data('fieldname');
                name=fieldname+"["+count+"]";
                console.log('==================data',name);
            }else{
                 name = $(this).data('fieldname');
            }
            var d = new Date().getTime();
            var random = stringGen(8);
            var browse_id = 'browse-' + random + d + '';
            var container_id = 'file-container-' + random + d + '';
            var error_label ="";
            if(error_enabled){
                 error_label = '<label id="'+fieldname+count+'-error" class="error" for="'+fieldname+count+'" style="display: none;">This field is required.</label>';
            }
            var file_html = '<div class="file-input-container" id="' + container_id + '"><label for="' + browse_id + '" class="browse-btn">Browse</label> <input type="file" name="' + name + '" class="file-input" id="' + fieldid + count + '" '+required+'/> <a  class="add-remove-file" data-remove="#' + container_id + '" href="javascript:void(0)"><i class="fas fa-minus-circle add-remove-icon"></i></a><span class="file-name-show"></span>'+error_label+'</div>';
            // <div><label id="previous_evaluations_attachment' + count + '-error" class="error" for="previous_evaluations_attachment' + count + '" style="display: none;">This field is required.</label></div>
            $($(this).data('fileuploadcontainer')).append(file_html);
        } else {
            var removeid = $(this).data('remove');
            $(removeid).remove();
        }
    });
    $(document).on('change', '.file-input', function() {
        $(this).parent('.file-input-container').children('.file-name-show').html(this.value);
        // console.log('===========',$(this).parent().children('.file-name-show').html('test data'));
    });
    /***************************Start  Add remove new file upload browser button **********************************************/

    /***************************************Show hide menu***********************************************************/
    $(document).on('click','#left-top-menu-ico',function(){
            console.log('click happend show');
            if($(".mobile-dropdown-menu").is(":visible")){
                $(".mobile-dropdown-menu").hide();
            }else{
                $(".mobile-dropdown-menu").show();
            }
        });
    $(window).scroll(function () {
        $(".mobile-dropdown-menu").hide();
    });
});

function sticky_relocate() {
    if($('#sticky-heading').length){
        var window_top = $(window).scrollTop();
        var div_top = $('#sticky-heading').offset().top;
        if (window_top >= div_top-20) {
            $('#page-heading').addClass('stick');
        } else {
            $('#page-heading').removeClass('stick');
        }
    }
}

$(function() {
    $(window).scroll(sticky_relocate);
    sticky_relocate();
});