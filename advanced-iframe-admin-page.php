<?php
/*
Advanced iFrame
http://www.tinywebgallery.com/blog/advanced-iframe
Michael Dempfle
Administration include
*/
?>
<?php

include_once dirname(__FILE__) . '/includes/advanced-iframe-admin-functions.php';
include_once dirname(__FILE__) . '/includes/advanced-iframe-admin-quickstart.php';

$version = '6.5.5';
$updated = false;
$evanto = (file_exists(dirname(__FILE__) . "/includes/class-cw-envato-api.php"));
if (is_user_logged_in() && is_admin()) {
    $scrollposition = 0;
    $current_tab=0;
    $devOptions = $this->getAiAdminOptions();
        
    if (!$evanto) {
      $devOptions['accordeon_menu'] = 'false';
      $devOptions['alternative_shortcode'] = '';
    }
    if ( $devOptions['accordeon_menu'] == 'false') {
        if (isset($_POST['scrollposition'])) {
          $scrollposition = urlencode($_POST['scrollposition']); 
        }
    }
    
    if (isset($_POST['current_tab'])) {
      $current_tab = urlencode($_POST['current_tab']); 
    }
  
    $is_latest = true;
    if ($evanto) {
      $latest_version = ai_getlatestVersion(); 
      if ($latest_version != -1) {
        if (version_compare ($latest_version,$version) == 1) { 
           printMessage(__('Version ', 'advanced-iframe')  .$latest_version. __(' of Advanced iFrame Pro is available. See the <a href="http://www.tinywebgallery.com/blog/advanced-iframe/advanced-iframe-history" target="_blank">history</a> for details.<br /><br />Please download the latest version from your download page of codecanyon. The easiest way to update is to overwrite all files with FTP.', 'advanced-iframe'));
           $is_latest = false;   
        }  
      } else {
        $is_latest = true;
      }
    } else {
      $is_latest = false;
    }
    
    $script_name = dirname(__FILE__) . '/js/ai_external.js'; 
    
    processConfigActions();
    
    if (isset($_POST['update_iframe-loader'])) { //save option changes
        $adminSettings = array('securitykey', 'src', 'width', 'height', 'scrolling',
            'marginwidth', 'marginheight', 'frameborder', 'transparency',
            'content_id', 'content_styles', 'hide_elements', 'class',
            'shortcode_attributes', 'url_forward_parameter', 'id', 'name',
            'onload', 'onload_resize', 'onload_scroll_top',
            'additional_js', 'additional_css', 'store_height_in_cookie', 'additional_height',
            'iframe_content_id', 'iframe_content_styles', 'iframe_hide_elements', 'version_counter',
            'onload_show_element_only', 'donation_bottom',
            'include_url','include_content','include_height','include_fade','include_hide_page_until_loaded',
            'onload_resize_width', 'resize_on_ajax', 'resize_on_ajax_jquery','resize_on_click',
            'resize_on_click_elements','hide_page_until_loaded',
            'show_part_of_iframe', 'show_part_of_iframe_x', 'show_part_of_iframe_y',
            'show_part_of_iframe_width', 'show_part_of_iframe_height',
            'show_part_of_iframe_new_window','show_part_of_iframe_new_url',
            'show_part_of_iframe_next_viewports_hide', 'show_part_of_iframe_next_viewports',
            'show_part_of_iframe_next_viewports_loop','style',
            'use_shortcode_attributes_only','enable_external_height_workaround',
            'keep_overflow_hidden','hide_page_until_loaded_external',
            'onload_resize_delay', 'expert_mode', 'accordeon_menu',
            'show_part_of_iframe_allow_scrollbar_vertical', 'show_part_of_iframe_allow_scrollbar_horizontal',
            'hide_part_of_iframe','change_parent_links_target',
            'change_iframe_links','change_iframe_links_target',
            'iframe_redirect_url', 'show_part_of_iframe_style',
            'map_parameter_to_url', 'iframe_zoom',
            'tab_visible', 'tab_hidden','enable_responsive_iframe',
            'allowfullscreen','iframe_height_ratio',
            'show_iframe_loader', 'enable_lazy_load',
            'enable_lazy_load_threshold','enable_lazy_load_fadetime',
            'pass_id_by_url','include_scripts_in_footer',
            'enable_lazy_load_manual', 'write_css_directly',
            'resize_on_element_resize', 'resize_on_element_resize_delay',
            'add_css_class_parent',
            'auto_zoom','single_save_button','enable_lazy_load_manual_element',
            'alternative_shortcode', 'show_menu_link', 'load_jquery',
            'show_iframe_as_layer', 'auto_zoom_by_ratio',
            'add_iframe_url_as_param', 'add_iframe_url_as_param_prefix',
            'reload_interval', 'iframe_content_css',
            'additional_js_file_iframe', 'additional_css_file_iframe',
            'add_css_class_iframe','iframe_zoom_ie8',
            'enable_lazy_load_reserve_space','editorbutton',
            'hide_content_until_iframe_color', 'include_html'  
            );  
        if (!wp_verify_nonce($_POST['twg-options'], 'twg-options')) die('Sorry, your nonce did not verify.');
        
        if (!isset($_POST['action']) || $_POST['action'] !== 'reset') {
          foreach ($adminSettings as $item) {
             if ($item == 'version_counter') {
                $text = rand(100000, 999999);
             } else if ($item == 'additional_height') {
                 $text = trim(trim($_POST[$item]),'px%emt'); // remove px...
             } else {
                 if (isset($_POST[$item])) {
                     $text = trim($_POST[$item]);
                 } else {  
                     if ($item == 'show_part_of_iframe' || $item == 'show_part_of_iframe_next_viewports_loop'
                       || $item == 'show_part_of_iframe_next_viewports_hide' || $item == 'write_css_directly' 
                       || $item == 'enable_responsive_iframe' || $item == 'enable_lazy_load' 
                       || $item == 'show_iframe_loader' || $item == 'enable_lazy_load_manual' 
                       || $item == 'accordeon_menu' || $item == 'single_save_button'
                       || $item == 'show_iframe_as_layer' || $item == 'add_iframe_url_as_param'
                       || $item == 'auto_zoom') {
                          $text = 'false';
                     } else if ($item == 'show_menu_link') {
                         $text = 'true';
                     } else if ($item == 'resize_on_element_resize_delay') {
                         $text = '250';
                     } else {
                         $text = '';
                     }
                 }
             }
             
             // Mixed signle and double quotes are only allowed for the parameters below because they do support 
             // shortcodes as input where both quotes are used.
             if ($item != 'src')  {
                $text = str_replace("'", '"' ,$text);
             }
             // replace ' with " 
             if ($item == 'include_url' || $item == 'src') {
                $text = str_replace('{', '__BRACKETS_OPEN__' ,$text);
                $text = str_replace('}', '__BRACKETS_CLOSE__' ,$text);
                $text = esc_url($text);
                $text = str_replace('__BRACKETS_OPEN__', '{' ,$text);
                $text = str_replace('__BRACKETS_CLOSE__' , '}' ,$text);
                $devOptions[$item] = stripslashes($text);
             } else if ($item == 'include_html') {
                $text = wp_kses( $text, array(
                    'strong' => array(),
                    'br' => array(),
                    'em' => array(),
                    'p' => array(),
                    'div' => array('id' => array(), 'class' => array(), 'style' => array()),
                    'a' => array('href' => array(),'target' => array(), 'class' => array(), 'style' => array()),
                    'img' => array('src' => array(), 'class' => array(), 'style' => array(), 'width' => array(), 'height')
                ) );
                $text =  balanceTags($text,true);
                $devOptions[$item] = stripslashes($text);
             } else if (function_exists('sanitize_text_field')) { 
                $devOptions[$item] = stripslashes(sanitize_text_field($text));
             } else {
                $devOptions[$item] = stripslashes($text);
             }
             if ($item == 'id') {
                $devOptions[$item] =  preg_replace("/\W/", "_", $text);
             }
             
             // we check if we have an invalid configuration!
             if ($devOptions['shortcode_attributes'] === 'false' && $devOptions['use_shortcode_attributes_only'] === 'true') {
                $devOptions['shortcode_attributes'] = 'true';
                printError(__('You have set "Allow shortcode attributes" to "No" and "Use shortcode attributes only" to "Yes". This combination is not valid. "Allow shortcode attributes" was set to "Yes". Please check if this is what you  want. "Allow shortcode attributes" overrules "Use shortcode attributes only" if you set "Use shortcode attributes only" directly in the shortcode with use_shortcode_attributes_only="true".', "advanced-iframe"));
                $scrollposition = 0;
             }
             
          }
        } else {
          $securityKey = $devOptions['securitykey'];
          $it = $devOptions['install_date'];
          $devOptions = advancediFrame::iframe_defaults();
          $devOptions['securitykey'] = $securityKey;
          $devOptions['install_date'] = $it;  
        }
                                                                                                                                                                                                                                                                   if ($evanto && empty($devOptions['install_date'])) {$devOptions['install_date'] = time();}
        update_option($this->adminOptionsName, $devOptions);

        // create the external js file with the url of the wordpress installation
        $template_name = dirname(__FILE__) . '/js/ai_external.template.js';
        
        $jquery_path =  site_url() . '/wp-includes/js/jquery/jquery.js';
        $resize_path =  site_url() . '/wp-content/plugins/advanced-iframe/includes/scripts/jquery.ba-resize.min.js';
        
        $content = file_get_contents($template_name);
        $new_content = str_replace('WORDPRESS_SITE_URL', get_site_url(), $content);
        $new_content = str_replace('PARAM_ID', $devOptions['id'], $new_content);
        $new_content = str_replace('PARAM_IFRAME_HIDE_ELEMENTS', $devOptions['iframe_hide_elements'], $new_content);
        $new_content = str_replace('PARAM_ONLOAD_SHOW_ELEMENT_ONLY', $devOptions['onload_show_element_only'], $new_content);
        $new_content = str_replace('PARAM_IFRAME_CONTENT_ID',  $devOptions['iframe_content_id'], $new_content);
        $new_content = str_replace('PARAM_IFRAME_CONTENT_STYLES',  $devOptions['iframe_content_styles'], $new_content);
        $new_content = str_replace('PARAM_CHANGE_IFRAME_LINKS_TARGET',  $devOptions['change_iframe_links_target'], $new_content);
        $new_content = str_replace('PARAM_CHANGE_IFRAME_LINKS',  $devOptions['change_iframe_links'], $new_content);
        $new_content = str_replace('PARAM_ENABLE_EXTERNAL_HEIGHT_WORKAROUND', $devOptions['enable_external_height_workaround'], $new_content);
        $new_content = str_replace('PARAM_KEEP_OVERFLOW_HIDDEN', $devOptions['keep_overflow_hidden'], $new_content);
        $new_content = str_replace('PARAM_HIDE_PAGE_UNTIL_LOADED_EXTERNAL', $devOptions['hide_page_until_loaded_external'], $new_content);
        $new_content = str_replace('PARAM_IFRAME_REDIRECT_URL', $devOptions['iframe_redirect_url'] , $new_content);
        $new_content = str_replace('PARAM_ENABLE_RESPONSIVE_IFRAME', $devOptions['enable_responsive_iframe'] , $new_content);
        $new_content = str_replace('PARAM_WRITE_CSS_DIRECTLY', $devOptions['write_css_directly'] , $new_content);
        $new_content = str_replace('PARAM_RESIZE_ON_ELEMENT_RESIZE_DELAY', $devOptions['resize_on_element_resize_delay'] , $new_content);
        $new_content = str_replace('PARAM_RESIZE_ON_ELEMENT_RESIZE', $devOptions['resize_on_element_resize'] , $new_content);
        $new_content = str_replace('PARAM_URL_ID', $devOptions['pass_id_by_url'] , $new_content);
        
        $new_content = str_replace('PARAM_JQUERY_PATH', $jquery_path , $new_content);
        $new_content = str_replace('PARAM_RESIZE_PATH', $resize_path , $new_content);
        $new_content = str_replace('PARAM_ADD_IFRAME_URL_AS_PARAM', $devOptions['add_iframe_url_as_param'], $new_content);
        $new_content = str_replace('PARAM_ADDITIONAL_CSS_FILE_IFRAME', $devOptions['additional_css_file_iframe'], $new_content);
        $new_content = str_replace('PARAM_ADDITIONAL_JS_FILE_IFRAME', $devOptions['additional_js_file_iframe'], $new_content);
        $new_content = str_replace('PARAM_ADD_CSS_CLASS_IFRAME', $devOptions['add_css_class_iframe'], $new_content);
        $new_content = str_replace('PARAM_TIMESTAMP', date("Y-m-d H:i:s"), $new_content);

        if (file_exists($script_name)) {
            @unlink($script_name);
        }
        $fh = fopen($script_name, 'w');
        if ($fh) {
            fwrite($fh, $new_content);
            fclose($fh);
        } else {
        printError(__('The file "advanced-iframe/js/ai_external.js" can not be saved. Please check the permissions of the js folder and save the settings again. This file is needed for the external workaround!', "advanced-iframe"));
        }
        ?>
<?php if ($devOptions['single_save_button'] == 'false') { ?> 
<div class="updated">
  <p>
     <strong>
      <?php 
      if (!isset($_POST['action']) || $_POST['action'] !== 'reset') {
        _e('Settings updated.', 'advanced-iframe');
      } else {
        _e('Settings resetted.', 'advanced-iframe');   
      }
       ?>
     </strong>
  </p>
</div>
<?php
  } else {
  $updated = true;
  }
}

    if ($evanto && clearstatscache($devOptions)) {
      printError(__('Yo'+'ur ver'+'sion of Adv'+'anced iFr'+'ame Pro s'+'eems to be an ill'+'egal co'+'py and is now wo'+'rking in the fr'+ 'eeware m'+'ode ag'+'ain.<br />Ple'+'ase get the of'+'fical v'+'ersion from co'+'decanyon or co'+'ntact the au'+'thor thr'+'ough code'+'canyon if you th'+'ink this is a fa'+'lse al'+'arm.', 'advanced-iframe'));
    }                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              if (clearstatscache($devOptions)) {$evanto = false; }
    ?>
<style type="text/css">table th {text-align: left;}
</style>
<div id="ai" class="wrap">
  <!-- options-general.php?page=advanced-iframe.php -->
  <form name="ai_form" method="post" action="">
    <input type="hidden" id="current_tab" name="current_tab" value="<?php echo $current_tab; ?>">
    <?php wp_nonce_field('twg-options', 'twg-options'); ?>

      <div id="icon-options-general" class="icon_ai show-always">
      <br />
      </div>
<h2 class="show-always"><?php
        _e('Advanced iFrame ', 'advanced-iframe');
        if ($evanto) {
        _e('Pro', 'advanced-iframe');
        } 
        echo ' <small>v' . $version. '</small>';  
        if ($is_latest) {
          echo ' <small class="hide-print"><small><small>' . __('(Your installation is up to date - <a href="http://www.tinywebgallery.com/blog/advanced-iframe/advanced-iframe-history" target="_blank">view history</a>)', 'advanced-iframe') . '</small></small></small>';  
        }
        ?><span id="help-header">&nbsp;attribute help</span></h2>
<br />
<?php if ($devOptions['accordeon_menu'] == 'false') { 


_e('<input type="search" class="ai-input-search" placeholder="Type filter text" />
<div id="ai-input-search-result">
No settings found for this search term.
</div><div id="ai-input-search-result-show">&nbsp;</div>
<div style="clear:left;"></div>
<div id="ai-input-search-help">
The filter text does look for the search term in the label and the description of each setting on all tabs. It does not search in the additional documentation that does exist in each section. Please use the browser search for a full text of this page.
</div>', 'advanced-iframe');

_e('<h2 class="nav-tab-wrapper show-always">', 'advanced-iframe');
if ($devOptions['donation_bottom'] === 'false') {
  _e('<a id="tab_0" class="nav-tab nav-tab-active" href="#introduction">Introduction</a>
      <a id="tab_1" class="nav-tab" href="#basic">Basic Settings</a>
      <a id="tab_2" class="nav-tab advanced-settings-tab" href="#advanced">Advanced Settings</a>
      <a id="tab_3" class="nav-tab external-workaround" href="#external-workaround">External workaround</a>
      <a id="tab_4" class="nav-tab" href="#add-files">Add/Include files</a>
      <a id="tab_5" class="nav-tab help-tab" href="#help">Help</a>
      ', 'advanced-iframe');
} else {
  _e('<a id="tab_0" class="nav-tab nav-tab-active" href="#basic">Basic Settings</a>
    <a id="tab_1" class="nav-tab advanced-settings-tab" href="#advanced">Advanced Settings</a>
    <a id="tab_2" class="nav-tab external-workaround" href="#external-workaround">External workaround</a>
    <a id="tab_3" class="nav-tab" href="#add-files">Add/Include files</a>
    <a id="tab_4" class="nav-tab help-tab" href="#help">Help</a>
    <a id="tab_5" class="nav-tab" href="#introduction">Introduction</a>', 'advanced-iframe');
}
_e('
</h2>
', 'advanced-iframe');
} else { 
_e('Please open the section where you want to change a default setting. Please start at the default section for the basic settings. You can open several sections at once for easier navigation.', 'advanced-iframe');
} 




?>

<div style="clear:both;"></div>



<?php if ($devOptions['accordeon_menu'] == 'false') { ?>
<div id="acc">
<?php } else { ?>
<div id="accordion">
<?php }


if ($devOptions['donation_bottom'] === 'false') {
  if ($devOptions['accordeon_menu'] == 'false') {
    echo '<section id="section-quickstart">';
  }
  printDonation($devOptions, $evanto);
  echo "</div>";
  if ($devOptions['accordeon_menu'] == 'false') {
    echo '</section>';
  }
}
if ($devOptions['accordeon_menu'] == 'false') {
  echo '<section id="section-default">';
}
include_once dirname(__FILE__) . '/includes/advanced-iframe-admin-default.php';
if ($devOptions['accordeon_menu'] == 'false') {
  echo '</section><section id="section-advanced">';
}
include_once dirname(__FILE__) . '/includes/advanced-iframe-admin-advanced.php';
include_once dirname(__FILE__) . '/includes/advanced-iframe-admin-resize.php';
include_once dirname(__FILE__) . '/includes/advanced-iframe-admin-lazy-load.php';
include_once dirname(__FILE__) . '/includes/advanced-iframe-admin-zoom.php';
include_once dirname(__FILE__) . '/includes/advanced-iframe-admin-parameters.php';
include_once dirname(__FILE__) . '/includes/advanced-iframe-admin-modify-parent.php';
include_once dirname(__FILE__) . '/includes/advanced-iframe-admin-modify-iframe.php';
if ($devOptions['accordeon_menu'] == 'false') {
echo '</section><section id="section-external-workaround">';
}
include_once dirname(__FILE__) . '/includes/advanced-iframe-admin-external-workaround.php';
if ($devOptions['accordeon_menu'] == 'false') {
echo '</section><section id="section-add-files">';
}
include_once dirname(__FILE__) . '/includes/advanced-iframe-admin-add-files.php';
include_once dirname(__FILE__) . '/includes/advanced-iframe-admin-include-directly.php';
if ($devOptions['accordeon_menu'] == 'false') {
echo '</section><section  id="section-help">';
}
include_once dirname(__FILE__) . '/includes/advanced-iframe-admin-video.php';
include_once dirname(__FILE__) . '/includes/advanced-iframe-admin-support.php';
include_once dirname(__FILE__) . '/includes/advanced-iframe-admin-jquery.php';
include_once dirname(__FILE__) . '/includes/advanced-iframe-admin-browser.php';
include_once dirname(__FILE__) . '/includes/advanced-iframe-admin-twg.php';
if ($devOptions['accordeon_menu'] == 'false') {
echo '</section>';
}
if ($devOptions['donation_bottom'] === 'true') {
  if ($devOptions['accordeon_menu'] == 'false') {
  echo '<section>';
  }
  printDonation($devOptions, $evanto);
  echo "</div>";
  if ($devOptions['accordeon_menu'] == 'false') {
  echo '</section>';
  }
}

?>
</div>
<?php if ($devOptions['single_save_button'] == 'true') { ?>    
<div id="wpadminbar" class="wp-core-ui ai-save-bar">
        <div>
        <?php 
        if ($updated) { 
          $updated_display_text = "visible";
          echo '<script>setTimeout(function() { jQuery("#updated_text").css("visibility","hidden")}, 4000);</script>'; 
        } else {
          $updated_display_text = "hidden";
        }
        ?>
           <div id="updated_text" style="visibility:<?php echo $updated_display_text; ?>;"><?php
           if (!isset($_POST['action']) ||  $_POST['action'] !== 'reset') {
               _e("Settings updated.", "advanced-iframe");
           } else {
              _e("Settings resetted.", "advanced-iframe");   
           }
           ?></div> 
        <input type="hidden" name="action" id="action" value="update">
        <input id="wpbarbutton" class="button-primary" type="submit" name="update_iframe-loader" onclick="setAiScrollposition();" value="<?php _e('Update Settings', 'advanced-iframe') ?>"/>  <input id="wpresetbutton" class="button-secondary confirmation" name="update_iframe-loader" onclick="resetAiSettings();" type="submit" value="<?php _e('Reset Settings', 'advanced-iframe') ?>" />
        </div>
        
      
</div> 
<input type="hidden" id="scrollposition" name="scrollposition" value="0">   
<?php } ?>
</form>
</div>
<script>
jQuery(function() {
  initAdminConfiguration(<?php echo ($evanto) ? "true" : "false"; ?>,<?php echo '"' .$devOptions['accordeon_menu'] . '"'; ?>);  
  <?php if ($current_tab != 0) {  ?>
  document.getElementById('tab_<?php echo $current_tab; ?>').click();
  <?php } ?>
  jQuery(document).scrollTop(<?php echo $scrollposition; ?>);
});
</script>
<?php } ?>