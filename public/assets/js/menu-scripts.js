jQuery=$;
jQuery(document).ready(function () {
    jQuery('#fixed-menu-container').html(jQuery('.fixed-menu-data').html());
    jQuery('.fixed-menu-data').html('');

    jQuery(document).on('click','.web-logo',function (event) {
    console.log('=============================aaaa loaded');
        window.location.href=base_uri;
    });
    jQuery(document).on('click','.search-icon',function (event) {
        jQuery('#header-bar-container').attr('style','position:relative');
        if(!jQuery(this).hasClass('activated')){
            testAnim('#header-search-box','fadeInRight',false);
           jQuery('#header-search-box').show();
            setTimeout(function () {
                jQuery('#header-search-box').removeClass('fadeInRight');
                jQuery('#header-search-box').removeClass('animated');
            },1000);
            jQuery(this).attr('style','color: teal');
            jQuery(this).addClass('activated');
            jQuery('.cross-icon').show();
        }
    });
    jQuery('body ,.cross-icon').click(function(event) {
        var $target = jQuery(event.target);
        if ($target.parents('.search-bar').length == 0 || $target.hasClass('cross-icon')) {
            if(jQuery('#header-search-box').is(":hidden") == false) {
                testAnim('#header-search-box', 'fadeOutRight', true);
            }
            // jQuery('#header-search-box').hide(2000);
            jQuery('.cross-icon').hide();
            jQuery('.search-icon').removeClass('activated');

            jQuery('.search-icon').attr('style','color: #fff');
            console.log('====================hidden',jQuery('.header-search-box').is(":hidden"));
            if(jQuery('#header-search-box').is(":hidden")){
                jQuery('#header-navbar-nav li.current').addClass('active');
            }
        }
    });

    jQuery( document ).on('mouseover',"#header-navbar-nav li",function() {
            jQuery('#header-navbar-nav li.current').removeClass('active');
            jQuery('.nav-sub-container').hide();
        });
    jQuery( document ).on('mouseout',"#header-navbar-nav li",function() {
            if(jQuery('#header-search-box').is(":hidden")){
                jQuery('#header-navbar-nav li.current').addClass('active');
                jQuery('.nav-sub-container').show();
            }
        });
    jQuery( document ).on('mouseover',"#fixed-menu-container li",function() {
        jQuery('#fixed-menu-container li.current').removeClass('active');
    });
    jQuery( document ).on('mouseout',"#fixed-menu-container li",function() {
        jQuery('#fixed-menu-container li.current').addClass('active');
    });
});
function sticky_relocate() {
    var window_top = jQuery(window).scrollTop();
    var div_top = jQuery('#sticky-anchor').offset().top;
    if (window_top > div_top) {
        jQuery('#sticky').addClass('stick');
    } else {
        jQuery('#sticky').removeClass('stick');
    }
}

jQuery(function() {
    jQuery(window).scroll(sticky_relocate);
    sticky_relocate();
});
function testAnim($selector,x,is_hide) {
    jQuery($selector).removeClass().addClass(x + ' animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
        jQuery(this).removeClass();
        if(is_hide){
           jQuery($selector).hide();
            if(jQuery('#header-search-box').is(":hidden")){
                jQuery('#header-navbar-nav li.current').addClass('active');
                jQuery('.nav-sub-container').show();
                jQuery('#header-bar-container').attr('style','');
            }
        }
    });
};
