<?php

// Admin Panel
function uads_add_pages() {
    add_options_page(__('uads','uads'), __('U Ads','uads'), 'manage_options', 'uads', 'uads_settings_page');
}
add_action('admin_menu', 'uads_add_pages');


function uads_settings_page() {
    if (isset($_POST['info_update'])) {
	$options = array(
		"uads_animation" => $_POST["uads_animation"],
                "uads_offset" => $_POST["uads_offset"],
                "uads_offset_element" => $_POST["uads_offset_element"],
                "uads_element_selector" => $_POST["uads_element_selector"],
                "uads_position" => $_POST["uads_position"],
		);
	update_option("uads-settings-group", $options);
	echo '<div id="message" class="updated fade"><p>uads options saved.</p></div>';
    } else {
        $options = get_option("uads-settings-group");
    }
	// Configuration Page
?>

<div class="wrap">
    <style type="text/css">
        #uads-tabs-nav {
            overflow: hidden;
            border-bottom: 2px solid #aaa;
        }
        #uads-tabs-nav li {
            float:left;
            display:inline;
            padding: 5px 10px;
            margin: 0 5px 0 0;
            cursor: pointer;
            font-weight: bold;
        }
        #uads-tabs-nav li.current {
            background: #aaa;
            color:#fff;
        }
    </style>
    <script type="text/javascript">
        jQuery(function($){
            $("#uads-tabs li:not(.current)").hide();
            $("#uads-tabs-nav li").each(function(index,element) {
                $(element).click(function(){
                    $("#uads-tabs li.current").removeClass("current").hide();
                    $("#uads-tabs-nav li.current").removeClass("current");
                    $("#uads-tabs li:eq("+index+")").addClass("current").show();
                    $("#uads-tabs-nav li:eq("+index+")").addClass("current").show();
                })
            })
        })
    </script>
    <h2>UAds</h2>
    <form method="post" action="">
        <?php settings_fields( 'uads-settings-group' ); ?>
        <ul id="uads-tabs-nav">
            <li class="current">Settings</li>
            <li>FAQs</li>
        </ul>
        <ul id="uads-tabs">
        <li class="current">
        <table class="form-table">
            <tr>
                <th colspan="2"><h3 style="margin:0">Appearance</h3></th>
            </tr>
            <tr valign="top">
                <th scope="row">Animation Style:</th>
                <td>
                    <input type="radio" id="flyout" name="uads_animation" value="flyout" <?php if($options['uads_animation'] != "fade") { echo 'checked="checked"';} ?>/>
                    <label for="flyout">Flyout</label><br/>
                    <input type="radio" id="fade" name="uads_animation" value="fade" <?php if($options['uads_animation'] == "fade") { echo 'checked="checked"';} ?>/>
                    <label for="fade">Fade In/Out</label>
                </td>                
            </tr>
            <tr>
                <th scope="row">
                    <label for="offset">Offset:</label>
                </th>
                <td>
                    <div style="margin-bottom:5px;">
                        <input type="text" id="offset" name="uads_offset" value="<?php echo $options['uads_offset'] == "" ? '100' : $options['uads_offset']; ?>" maxlength="3" size="3" />%
                        <span class="description" style="margin-left:15px;">Percentage of the page required to be scrolled to display a box.</span>
                    </div>
                    <div>
                        <input type="checkbox" id="offset_element" name="uads_offset_element" <?php echo $options['uads_offset_element'] != true ? "" : 'checked="checked"'; ?> />
                        <label for="offset_element">Before HTML element.</label>
                        <label for="element_selector" >Element selector: </label><input type="text" id="element_selector" name="uads_element_selector" value="<?php echo $options['uads_element_selector'] == "" ? '#comments' : $options['uads_element_selector']; ?>" /><br/>
                        <span class="description" >If not selected, all page length is taken for calculation. If selected, make sure to use the ID or class of an existing element. Put # "hash" before the ID, or . "dot" before a class name.</span>
                    </div>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row">Position:</th>
                <td>
                    <input type="radio" id="uads_position_right" name="uads_position" value="right" <?php if($options['uads_position'] != "left") { echo 'checked="checked"';} ?>/>
                    <label for="uads_position_right">Right</label><br/>
                    <input type="radio" id="uads_position_left" name="uads_position" value="left" <?php if($options['uads_position'] == "left") { echo 'checked="checked"';} ?>/>
                    <label for="uads_position_left">Left</label>
                </td>
            </tr>
        </table>

        <p class="submit">
            <input type="submit" name="info_update" class="button-primary" value="<?php _e('Save Changes') ?>" />
        </p>
        </li>
        <li>
            <h4>Where can I customize fonts, colors, etc.?</h4>
            You can modify all css properties by edditing <a href="plugin-editor.php?file=<?php echo str_replace(basename( __FILE__),"",plugin_basename(__FILE__))."uads.css" ?>">uads.css</a>
            <h4>How to add some space after uads?</h4>
            You can edit <a href="plugin-editor.php?file=<?php echo str_replace(basename( __FILE__),"",plugin_basename(__FILE__))."uads.css" ?>">uads.css</a> and change bottom:0px; to different value, e.g. bottom:30px;
            <h4>How to add uads for pages?</h4>
            You can display a custom text by adding a shortcode to your page: <em>[uads]Sample HTML Text[/uads]</em>. When added to post it will replace a default content.
        </li>
        </ul>

    </form>
</div>
<?php } ?>