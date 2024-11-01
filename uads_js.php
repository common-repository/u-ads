<?php
error_reporting(0);
header("Content-type: text/javascript");
if (file_exists("./wp-config.php")){include("./wp-config.php");}
elseif (file_exists("../wp-config.php")){include("../wp-config.php");}
elseif (file_exists("../../wp-config.php")){include("../../wp-config.php");}
elseif (file_exists("../../../wp-config.php")){include("../../../wp-config.php");}
elseif (file_exists("../../../../wp-config.php")){include("../../../../wp-config.php");}
elseif (file_exists("../../../../../wp-config.php")){include("../../../../../wp-config.php");}
elseif (file_exists("../../../../../../wp-config.php")){include("../../../../../../wp-config.php");}
elseif (file_exists("../../../../../../../wp-config.php")){include("../../../../../../../wp-config.php");}
elseif (file_exists("../../../../../../../../wp-config.php")){include("../../../../../../../../wp-config.php");}

$options = get_option("uads-settings-group");
$offset = floatval($options['uads_offset'] == "" ? 100 : $options['uads_offset']);
$offset_element = $options['uads_offset_element'];
$element_selector = $options['uads_element_selector'];
$animation = $options['uads_animation'] == "fade" ? "fade" : "flyout";
$position = $options['uads_position'] != 'left' ? "right" : "left";

print 'function getScrollY() {
    scrOfY = 0;
    if( typeof( window.pageYOffset ) == "number" ) {
        scrOfY = window.pageYOffset;
    } else if( document.body && ( document.body.scrollLeft || document.body.scrollTop ) ) {
        scrOfY = document.body.scrollTop;
    } else if( document.documentElement && ( document.documentElement.scrollLeft || document.documentElement.scrollTop ) ) {
        scrOfY = document.documentElement.scrollTop;
    }
    return scrOfY;
}

jQuery(function($){
    var uads_closed = false;
    var uads_hidden = true;
    $(window).scroll(function() {
        ';

if ($offset_element) {
    print 'var lastScreen;
        if ($("'. $element_selector .'").length > 0)
            lastScreen = getScrollY() + $(window).height() < $("'. $element_selector .'").offset().top * '. $offset / 100 .' ? false : true;
        else
            lastScreen = getScrollY() + $(window).height() < $(document).height() * '. $offset / 100 .' ? false : true;';
} else {
    print 'var lastScreen = getScrollY() + $(window).height() < $(document).height() * '. $offset / 100 .' ? false : true;';
}
    print '
        if (lastScreen && !uads_closed) {
            ';
if ($animation == "fade")
    print '$("#uads_box").fadeIn("slow");';
else
    print '$("#uads_box").stop().animate({'.$position.':"0px"});';
print '
            uads_hidden = false;
        }
        else if (uads_closed && getScrollY() == 0) {
            uads_closed = false;
        }
        else if (!uads_hidden) {
            uads_hidden = true;
            ';
if ($animation == "fade")
    print '$("#uads_box").fadeOut("slow");';
else
    print '$("#uads_box").stop().animate({'.$position.':"-400px"});';
print '
        }
    });
    $("#uads_close").click(function() {
        ';
if ($animation == "fade")
    print'$("#uads_box").fadeOut("slow");';
else
    print'$("#uads_box").stop().animate({'.$position.':"-400px"});';
print '
        uads_closed = true;
        uads_hidden = true;
    });
});';

?>
