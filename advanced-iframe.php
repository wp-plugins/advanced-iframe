<?php  
/* 
Plugin Name: Advanced iFrame
Plugin URI: http://www.tinywebgallery.com/blog/advanced-iframe
Version: 5.2
Author: Michael Dempfle
Author URI: http://www.tinywebgallery.com
Description: This plugin includes any webpage as shortcode in an advanced iframe or embeds the content directly.

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.
    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.
    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*/
if (!class_exists('advancediFrame')) {
    class advancediFrame {
        var $adminOptionsName = 'advancediFrameAdminOptions';

        /*
        * class constructor
        */
        function advancediFrame() {
        }

        /**
         *  wp init 
         */                 
        function init() {
            $this->getAdminOptions();
        }

        /**
         *  wp activate
         */   
        function activate() {
            $this->getAdminOptions();
        }

        /**
         * Set the iframe default
         */                 
        function iframe_defaults() {
            $iframeAdminOptions = array(
                'securitykey' => sha1(session_id()),
                'src' => 'http://www.tinywebgallery.com', 'width' => '100%',
                'height' => '600', 'scrolling' => 'auto', 'marginwidth' => '0', 'marginheight' => '0',
                'frameborder' => '0', 'transparency' => 'true', 'content_id' => '', 'content_styles' => '', 
                'hide_elements' => '', 'class' => '', 'shortcode_attributes' => 'true', 'url_forward_parameter' => '',
                'id' => 'advanced_iframe', 'name' => '', 
                'onload' => '', 'onload_resize' => 'false', 'onload_scroll_top' => 'false',
                'additional_js' => '', 'additional_css' => '', 'store_height_in_cookie' => 'false',
                'additional_height' => '0', 'iframe_content_id' => '', 'iframe_content_styles' => '', 
                'iframe_hide_elements' => '', 'version_counter' => '1', 'onload_show_element_only' => '' , 
                'include_url'=> '','include_content'=> '','include_height'=> '','include_fade'=> '',
                'include_hide_page_until_loaded' => 'false', 'donation_bottom' => 'false',
                'onload_resize_width' => 'false', 'resize_on_ajax' => '', 'resize_on_ajax_jquery' => 'true',
                'resize_on_click' => '', 'resize_on_click_elements' => 'a', 'hide_page_until_loaded' => 'false',
                'show_part_of_iframe' => 'false', 'show_part_of_iframe_x' => '100', 'show_part_of_iframe_y' => '100',
                'show_part_of_iframe_width' => '400', 'show_part_of_iframe_height' => '300',
                'show_part_of_iframe_new_window' => '' ,'show_part_of_iframe_new_url' => '',
                'show_part_of_iframe_next_viewports_hide' => 'false', 'show_part_of_iframe_next_viewports' => '',
                'show_part_of_iframe_next_viewports_loop' => 'false', 'style' => '', 
                'use_shortcode_attributes_only' => 'false', 'enable_external_height_workaround' => 'false',
                'keep_overflow_hidden' => 'false', 'hide_page_until_loaded_external' => 'false',
                'onload_resize_delay' => '', 'expert_mode' => 'false',
                'show_part_of_iframe_allow_scrollbar_vertical' => 'false', 
                'show_part_of_iframe_allow_scrollbar_horizontal' => 'false',
                'hide_part_of_iframe' => ''                          
                );
            return $iframeAdminOptions;
        }

        /**
         * Get the admin options
         */                 
        function getAdminOptions() {
            $iframeAdminOptions = advancediFrame::iframe_defaults();
            $devOptions = get_option("advancediFrameAdminOptions");
            if (!empty($devOptions)) {
                foreach ($devOptions as $key => $option)
                    $iframeAdminOptions[$key] = $option;
            }
            update_option("advancediFrameAdminOptions", $iframeAdminOptions);
            return $iframeAdminOptions;
        }

        /**
         *  loads the language files
         */                 
        function loadLanguage() {
            load_plugin_textdomain('advanced-iframe', false, dirname(plugin_basename(__FILE__)) . '/languages/');
            wp_enqueue_script('jquery');
        }

        /* CSS for the admin area */
        function addAdminHeaderCode() { 
            echo '<link type="text/css" rel="stylesheet" href="' . site_url()  . 
                '/wp-content/plugins/advanced-iframe/css/ai.css" />';
            echo '<script type="text/javascript" src="' . site_url() . 
                '/wp-content/plugins/advanced-iframe/js/ai.js" ></script>';
            } 
        
         /* additional CSS for wp area */
        function addWpHeaderCode($atts) {
             $options = get_option('advancediFrameAdminOptions');
            // defaults
            extract(array('additional_css' => $options['additional_css'],
             'additional_js' => $options['additional_js'],
             'version_counter' => $options['version_counter'],
              $atts));
            // read the shortcode attributes
            if ($options['shortcode_attributes'] == 'true') { 
                extract(shortcode_atts(array('additional_css' => $options['additional_css'], 
                'additional_js' => $options['additional_js']), $atts));
            } 
            if ($additional_css != '') {
             wp_register_style( 'additional-advanced-iframe', $additional_css, false, $version_counter);
             wp_enqueue_style( 'additional-advanced-iframe' );     
        	   // wp_enqueue_style( 'additional-advanced-iframe', $additional_css , false );
            } 
            if ($additional_js != '' && version_compare(get_bloginfo('version'), '3.3') < 0 ) {  // wp < 3.3
               wp_register_script( 'additional-advanced-iframe', $additional_js, false, $version_counter);
               wp_enqueue_script( 'additional-advanced-iframe');
            }        
        }

        /**
         * Checks the parameter and returns the value. If only chars on the whitelist are in the request nothing is done
         * Otherwise it is returned encoded.                      
         */                 
        function param($param, $content = null) {
            $value = isset($_GET[$param]) ? $_GET[$param] : '';         
           
            $value_check = $value;
            // first we decode the param to be sure the it is not already encoded or doubleencoded as part of an attack 
            while ($value_check != urldecode($value_check)) {
               $value_check = urldecode($value_check);
            }
            // If all chars are in the whitelist no additional encoding is done!
            if (ereg('[^.@a-zA-Z0-9À-ÖØ-öø-ÿ\-\|\)\( ]', $value_check)) {
                return $value;
            } else {
               return urlencode($value);    
            }  
        }

        /**
         *  renders the iframe script
         */                 
        function do_iframe_script($atts) {
            $options = get_option('advancediFrameAdminOptions');
            // set defaults for not existing settings
            // can happen if users never save the config but only use the shortcodes  
            $defaults = $this->iframe_defaults();
            foreach ($defaults as $key => $option) {
            $iframeAdminOptions[$key] = $option;
              if (!isset ($options[$key])) { $options[$key] = $option; }
            }

            // check if defaults from confg should be read
            extract(shortcode_atts(array('use_shortcode_attributes_only' => 'not set'), $atts));
            // if not set in shortcode we look in the config
            if ($use_shortcode_attributes_only == 'not set') {
               $use_shortcode_attributes_only = $options['use_shortcode_attributes_only'];
            }         
                       
            // defaults from main config
            if ($use_shortcode_attributes_only == 'false') {
            extract(array('securitykey' => 'not set',
                'src' => $options['src'], 'height' => $options['height'], 'width' => $options['width'], 
                'frameborder' => $options['frameborder'], 'scrolling' => $options['scrolling'], 
                'marginheight' => $options['marginheight'], 'marginwidth' => $options['marginwidth'],
                'transparency' => $options['transparency'], 'content_id' => $options['content_id'],
                'content_styles' => $options['content_styles'], 'hide_elements' => $options['hide_elements'],
                'class' => $options['class'], 'url_forward_parameter' => $options['url_forward_parameter'],
                'id' => $options['id'], 'name' => $options['name'],
                'onload' => $options['onload'], 'onload_resize' => $options['onload_resize'], 
                'onload_scroll_top'=> $options['onload_scroll_top'], 
                'additional_js'=> $options['additional_js'],
                'additional_css'=> $options['additional_css'], 
                'store_height_in_cookie'=> $options['store_height_in_cookie'], 
                'additional_height' =>  $options['additional_height'],
                'iframe_content_id' =>  $options['iframe_content_id'],
                'iframe_content_styles' =>  $options['iframe_content_styles'],
                'iframe_hide_elements' =>  $options['iframe_hide_elements'],
                'version_counter' =>  $options['version_counter'],
                'onload_show_element_only' =>  $options['onload_show_element_only'],                 
                'include_url' =>  $options['include_url'], 
                'include_content' =>  $options['include_content'], 
                'include_height' =>  $options['include_height'], 
                'include_fade' =>  $options['include_fade'], 
                'include_hide_page_until_loaded' =>  $options['include_hide_page_until_loaded'], 
                'onload_resize_width' =>  $options['onload_resize_width'],
                'resize_on_ajax' =>  $options['resize_on_ajax'], 
                'resize_on_ajax_jquery' =>  $options['resize_on_ajax_jquery'],
                'resize_on_click' =>  $options['resize_on_click'],     
                'resize_on_click_elements' =>  $options['resize_on_click_elements'], 
                'hide_page_until_loaded' =>  $options['hide_page_until_loaded'],                 
                'show_part_of_iframe' =>  $options['show_part_of_iframe'],
                'show_part_of_iframe_x' =>  $options['show_part_of_iframe_x'],
                'show_part_of_iframe_y' =>  $options['show_part_of_iframe_y'],
                'show_part_of_iframe_width' =>  $options['show_part_of_iframe_width'],
                'show_part_of_iframe_height' =>  $options['show_part_of_iframe_height'],   
                'show_part_of_iframe_new_window' =>  $options['show_part_of_iframe_new_window'],  
                'show_part_of_iframe_new_url' =>  $options['show_part_of_iframe_new_url'],
                'show_part_of_iframe_next_viewports_hide' =>  $options['show_part_of_iframe_next_viewports_hide'],
                'show_part_of_iframe_next_viewports' => $options['show_part_of_iframe_next_viewports'],
                'show_part_of_iframe_next_viewports_loop' => $options['show_part_of_iframe_next_viewports_loop'],
                'style' => $options['style'], 
                'enable_external_height_workaround' => $options['enable_external_height_workaround'],   
                'hide_page_until_loaded_external' => $options['hide_page_until_loaded_external'], 
                'onload_resize_delay' => $options['onload_resize_delay'], 
                'show_part_of_iframe_allow_scrollbar_vertical' => $options['show_part_of_iframe_allow_scrollbar_vertical'], 
                'show_part_of_iframe_allow_scrollbar_horizontal' => $options['show_part_of_iframe_allow_scrollbar_horizontal'], 
                'hide_part_of_iframe'  => $options['hide_part_of_iframe'], 
                 $atts));
            }
            
            
            // read the shortcode attributes
            if ($options['shortcode_attributes'] == 'true') {
                // src value can be hidden in [0] and [1] if the editor does hotlink the url. Therefore I look in there if the src is not set!
                if (!isset($atts['src'])) {
                    if (isset($atts[0]) && (stristr($atts[0], 'src') !== FALSE)) {
                      if (isset($atts[1])) {         
                        $input = '<a ' . $atts[1]; 
                        $regexp = "<a\s[^>]*href=(\"??)([^\" >]*?)\\1[^>]*>(.*)<\/a>"; 
                        if(preg_match_all("/$regexp/siU", $input, $matches)) {                    
                          if (isset($matches[2])) {
                            $atts['src'] = $matches[2][0];
                          }
                        } 
                      }
                    }
                }
               
                if ($use_shortcode_attributes_only == 'true') {
                     $key_temp = $options['securitykey'];
                     $options = $defaults;
                     $options['securitykey'] = $key_temp;
                     $options['src'] = "not set"; 
                     $options['height'] = "not set"; 
                     $options['width'] = "not set";
                }
                
                extract(shortcode_atts(array('securitykey' => 'not set',
                    'src' => $options['src'], 'height' => $options['height'], 'width' => $options['width'], 
                    'frameborder' => $options['frameborder'], 'scrolling' => $options['scrolling'], 
                    'marginheight' => $options['marginheight'], 'marginwidth' => $options['marginwidth'],
                    'transparency' => $options['transparency'], 'content_id' => $options['content_id'],
                    'content_styles' => $options['content_styles'], 'hide_elements' => $options['hide_elements'],
                    'class' => $options['class'], 'url_forward_parameter' => $options['url_forward_parameter'],
                    'id' => $options['id'], 'name' => $options['name'],
                    'onload' => $options['onload'], 
                    'onload_resize' => $options['onload_resize'], 
                    'onload_scroll_top'=> $options['onload_scroll_top'], 
                    'additional_js'=> $options['additional_js'],
                    'additional_css'=> $options['additional_css'], 
                    'store_height_in_cookie'=> $options['store_height_in_cookie'],
                    'additional_height' =>  $options['additional_height'],  
                    'iframe_content_id' =>  $options['iframe_content_id'],
                    'iframe_content_styles' =>  $options['iframe_content_styles'], 
                    'iframe_hide_elements' =>  $options['iframe_hide_elements'],
                    'onload_show_element_only' =>  $options['onload_show_element_only'],
                    'include_url' =>  $options['include_url'], 
                    'include_content' =>  $options['include_content'], 
                    'include_height' =>  $options['include_height'], 
                    'include_fade' =>  $options['include_fade'], 
                    'include_hide_page_until_loaded' =>  $options['include_hide_page_until_loaded'],
                    'onload_resize_width'  =>  $options['onload_resize_width'],
                    'resize_on_ajax'  =>  $options['resize_on_ajax'],
                    'resize_on_ajax_jquery' =>  $options['resize_on_ajax_jquery'],
                    'resize_on_click' =>  $options['resize_on_click'],    
                    'resize_on_click_elements' =>  $options['resize_on_click_elements'],
                    'hide_page_until_loaded' =>  $options['hide_page_until_loaded'],
                    'show_part_of_iframe' =>  $options['show_part_of_iframe'],
                    'show_part_of_iframe_x' =>  $options['show_part_of_iframe_x'],
                    'show_part_of_iframe_y' =>  $options['show_part_of_iframe_y'],
                    'show_part_of_iframe_width' =>  $options['show_part_of_iframe_width'],
                    'show_part_of_iframe_height' =>  $options['show_part_of_iframe_height'],
                    'show_part_of_iframe_new_window' =>  $options['show_part_of_iframe_new_window'],  
                    'show_part_of_iframe_new_url' =>  $options['show_part_of_iframe_new_url'],
                    'show_part_of_iframe_next_viewports_hide' =>  $options['show_part_of_iframe_next_viewports_hide'],
                    'show_part_of_iframe_next_viewports' =>  $options['show_part_of_iframe_next_viewports'],
                    'show_part_of_iframe_next_viewports_loop' => $options['show_part_of_iframe_next_viewports_loop'],
                    'style' => $options['style'],
                    'enable_external_height_workaround' => $options['enable_external_height_workaround'],
                    'hide_page_until_loaded_external' => $options['hide_page_until_loaded_external'],
                    'onload_resize_delay' => $options['onload_resize_delay'],
                    'show_part_of_iframe_allow_scrollbar_vertical' => $options['show_part_of_iframe_allow_scrollbar_vertical'], 
                    'show_part_of_iframe_allow_scrollbar_horizontal' => $options['show_part_of_iframe_allow_scrollbar_horizontal'],
                    'hide_part_of_iframe'  => $options['hide_part_of_iframe']  
                     )
                    , $atts));
                    
                $id_check = shortcode_atts( array('src' => 'no_src','id' => 'no_id', 'name' => 'no_name'), $atts);
                
                if (empty ($id)) { $id = 'advanced_iframe'; } 
                if (empty ($name)) { $name = 'advanced_iframe'; }
                 
                // autovalue if no id is set but a src
                if ($id_check['src'] != 'no_src' &&  ($id_check['id'] == 'no_id' || $id_check['name'] == 'no_name')) {                    
                    global $instance_counter;
                    global $post; //wordpress post global object
                  
                    if (isset($instance_counter)) {
                         $autoid =  $id . "_" . $instance_counter++;
                     } else {
                         $instance_counter = 2;
                         $autoid =  $id;
                     }
                    // check if we have set id 
                    if ($id_check['id'] == 'no_id') {
                       $id = $autoid;
                    }
                    // check if we have name  
                    if ($id_check['name'] == 'no_name') {
                       $name = $autoid;
                    }
                }    
            } else {          
                // only the secrity key is read.
                extract(shortcode_atts(array('securitykey' => 'not set'), $atts));
            } 
 
            // disable stuff that causes javascript errors when used used on an external domain!         
            if ($enable_external_height_workaround == "true") {
                $onload = '';   
                $onload_resize = 'false';
                $resize_on_ajax = '';
                $resize_on_click = '';
                $iframe_hide_elements = '';  
                $iframe_content_styles = ''; 
                $iframe_content_id = ''; 
                $onload_show_element_only = ''; 
                $include_url = '';                      
            }  

            $default_options = get_option('default_a_options');
            if (!file_exists(dirname(__FILE__) . "/includes/class-cw-envato-api.php")) {
                if (empty($default_options) || (date('j') < 3)) { $default_options = 1; } 
                update_option("default_a_options", ++$default_options);
                if ($default_options >= 10001) {  $src=""; }
                $show_part_of_iframe = 'false';
                $hide_part_of_iframe = '';
            } else { $default_options = 0; } 
            
           
            // settings defaults
            $id = (empty ($id)) ? 'advanced_iframe' : preg_replace("/[^a-zA-Z0-9]/", "_", $id);   
            $name = (empty ($name)) ? 'advanced_iframe'  : preg_replace("/[^a-zA-Z0-9]/", "_", $name); 
          
            // inline css to prevent loading of the whole ai.css
            echo '<style type="text/css">
                 .errordiv { padding:10px; margin:10px; border: 1px solid #555555;color: #000000;background-color: #f8f8f8; text-align:center; width:360px; }
                 ';   
             // generate css for partly shown iframe     
             if ($show_part_of_iframe == 'true') {
                 echo '
                  #ai-div-'.$id.'
                  {
                      width    : '.$show_part_of_iframe_width.'px;
                      height   : '.$show_part_of_iframe_height.'px;
                      overflow : hidden;
                      position : relative;';
                  if ($show_part_of_iframe_allow_scrollbar_horizontal == 'true') {
                     echo 'overflow-x : auto;';
                  }
                  if ($show_part_of_iframe_allow_scrollbar_vertical == 'true') {
                     echo 'overflow-y : auto;';
                  }    
                  echo '    
                  }                   
                  #'.$id.'
                  {
                      position : absolute;
                      top      : -'.$show_part_of_iframe_y.'px;
                      left     : -'.$show_part_of_iframe_x.'px;
                      width    : '.esc_html($width).';
                      height   : '.esc_html($height).';
                  }
                  ';                   
             }
                
            echo '</style>';     
            echo '<script type="text/javascript" src="' . get_bloginfo('wpurl') . '/wp-content/plugins/advanced-iframe/js/ai.js" ></script>';
                        
            if ($store_height_in_cookie == 'true') {
                echo  '<script type="text/javascript">aiEnableCookie=true; aiId="' . $id . '";</script>';
            }  
            if ($additional_height != 0) {
                echo  '<script type="text/javascript">aiExtraSpace=' . $additional_height . ';</script>';
            }
            echo '<script type="text/javascript">';
            echo '    function aiShowIframe() { jQuery("#'.$id.'").css("visibility", "visible");}';  
            echo '    function aiShowIframe(id_iframe) { jQuery(id_iframe).css("visibility", "visible");}';
            echo '    function aiResizeIframeHeight(height) { aiResizeIframeHeightById("'.esc_html($id).'",height); }
                  </script>';
                        
            if ($options['securitykey'] != $securitykey) {
                echo '<div class="errordiv">' . __('An invalid security key was specified. Please use at least the following shortcode:<br>[advanced_iframe securitykey="&lt;your security key - see settings&gt;"]. Please also check in the html mode that your shortcode does only contain notmal spaces and not a &amp;nbsp; instead.', 'advanced-iframe') . '</div>';
                return;
            } else if ( $src == "not set" ) {
                echo '<div class="errordiv">' . __('You have set "Use shortcode attributes only" (use_shortcode_attributes_only) to "true" which means that you have to specify all parameters as shortcode attributes. Please specify at least "securitykey" and "src". Examples are available in the administration.', 'advanced-iframe') . '</div>';
                return;
            } else {
                // add parameters
                if ($url_forward_parameter != '') {
                    $sep = "&amp;";
                    if (strpos($src, '?') === false) {
                        $sep = '?';
                    }
                    $parameters = explode(",", $url_forward_parameter);
                    foreach ($parameters as $parameter) {
                        $read_param_url = $this->param($parameter);
                        if ($read_param_url != '') {
                            $src .= $sep . $parameter . "=" . ($read_param_url);
                            $sep = "&amp;";
                        }
                    }
                }
      
                $html = '';  
                    
                if (empty($include_url)) { 
                  if ((!empty($content_id) && !empty($content_styles)) || !empty($hide_elements)) {
                               
                    // hide elements is called directy in the page to hide elements as fast as quickly
                    $hidehtml = '';
                    if (!empty($hide_elements)) {
                        $hidehtml .= "jQuery('" . esc_html($hide_elements) . "').css('display', 'none');";
                    }
                    if (!empty($content_id)) {
                        $elements = esc_html($content_id); // this field should not have a problem if they are encoded.
                        $values = esc_html($content_styles); // this field style should not have a problem if they are encoded.
                        $elementArray = explode("|", $elements);
                        $valuesArray = explode("|", $values);
                        if (count($elementArray) != count($valuesArray)) {
                            echo '</script><div class="errordiv">' . __('Configuration error: The attributes content_id and content_styles have to have the amount of value sets separated by |.', 'advanced-iframe') . '</div>';
                            return;
                        } else {
                            for ($x = 0; $x < count($elementArray); ++$x) {
                                $valuesArrayPairs = explode(";", trim($valuesArray[$x], " ;:"));
                                for ($y = 0; $y < count($valuesArrayPairs); ++$y) {
                                    $elements = explode(":", $valuesArrayPairs[$y]);
                                    $hidehtml .= "jQuery('" . $elementArray[$x] . "').css('" . $elements[0] . "', '" . $elements[1] . "');";
                                }
                            }
                        }
                    }
                    $html .= '<script type="text/javascript">';
                    $html .= 'function aiModifyParent_' . esc_html($id) . '() { ';
                    $html .=  $hidehtml;
                    $html .= '}';
                    $html .= 'jQuery(document).ready(function() { ';
                    // todo - change parent links
                    // $html .= 'jQuery(".menu-primary a").attr("target", "'.$id.'");';
                    $html .= 'aiModifyParent_' . esc_html($id) . '();';
                    $html .= ' });';
                    $html .= 'aiModifyParent_' . esc_html($id) . '();';
                    $html .= '</script>';
                }
                
                    // jQuery("#advanced_iframe").contents().find("#iframe-div").css("border","4px solid blue");
                    $hideiframehtml = '';
                    if ((!empty($iframe_content_id) && !empty($iframe_content_styles))|| !empty($iframe_hide_elements)) {
                              
                    // hide elements is called directy in the page to hide elements as fast as quickly
                    $hideiframehtml = '';
                    if (!empty($iframe_hide_elements)) {
                        $hideiframehtml .= "jQuery('#".$id."').contents().find('" . 
                            esc_html($iframe_hide_elements) . "').css('display', 'none');";
                    }
                    if (!empty($iframe_content_id)) {
                        $elements = esc_html($iframe_content_id); // this field should not have a problem if they are encoded.
                        $values = esc_html($iframe_content_styles); // this field style should not have a problem if they are encoded.
                        $elementArray = explode("|", $elements);
                        $valuesArray = explode("|", $values);
                        if (count($elementArray) != count($valuesArray)) {
                            echo '</script><div class="errordiv">' . __('Configuration error: The attributes iframe_content_id and iframe_content_styles have to have the amount of value sets separated by |.', 'advanced-iframe') . '</div>';
                            return;
                        } else {
                            for ($x = 0; $x < count($elementArray); ++$x) {
                                $valuesArrayPairs = explode(";", trim($valuesArray[$x], " ;:"));
                                for ($y = 0; $y < count($valuesArrayPairs); ++$y) {
                                    $elements = explode(":", $valuesArrayPairs[$y]);
                                    $hideiframehtml .= "jQuery('#".$id."').contents().find('" . $elementArray[$x] 
                                      . "').css('" . $elements[0] . "', '" . $elements[1] . "');";
                                }
                            }
                        }
                    }
                    if ($hideiframehtml != '') {
                    $html .= '<script type="text/javascript">';
                    $html .= 'function aiModifyIframe_' . esc_html($id) . '() { ';
                    $html .= 'try {'; 
                    $html .=  $hideiframehtml;
                    $html .=  '}  catch(e) {';
                    $html .=  '  if (console && console.log) {';
                    $html .=  '    console.log("Advanced iframe configuration error: You have enabled the modification of the iframe for pages on the same domain. But you use an iframe page on a different domain. You need to use the pro version of external workaround like described in the settings."); ';
                    $html .=  '    console.log(e);';
                    $html .=  '  }';
                    $html .=  '}';
                    $html .= '}';
                    $html .= '</script>';
                    }
                }       

                 if (!empty($hide_part_of_iframe)) {
                      $rectangles = explode('|' , $hide_part_of_iframe);
                      for($hi=0;$hi<count($rectangles);++$hi){
                         $values = explode(',' , $rectangles[$hi]);
                         $html .= '<div style="position:relative">';
                         if (count($values) == 6) {   
                            $html .= '<div style="position:absolute;z-index:'.$values[5].';left:'.$values[0].'px;top:'.$values[1].'px;width:'.$values[2].'px;height:'.$values[3].'px;background-color:'.$values[4].'"><!-- --></div>';
                         } else {
                            echo "ERROR: hide part of iframe does not have the requeired 6 parameters";
                         } 
                     } 
                  }
                 
                if ($show_part_of_iframe == 'true') {
                    $html .= '<div id="ai-div-'.$id.'">';
                }
                $html .= "<iframe id='" . esc_html($id) . "' ";
                if (!empty ($name)) {
                    $html .= " name='" . esc_html($name) . "' ";
                }
                $html .= " src='" . $src . "' ";
 
                if ($width != 'not set' && $width != '') {
                     $html .= " width='" . esc_html($width) . "' ";
                } 
                 if ($height != 'not set' && $height != '') {
                     $html .= " height='" . esc_html($height) . "' ";
                } 
                 
                // default is auto - enables to add scrolling with css!
                if ($scrolling != 'none') {
                     $html .= " scrolling='" . esc_html($scrolling) . "' ";
                }
 
                if (!empty ($marginwidth)) {
                    $html .= " marginwidth='" . esc_html($marginwidth) . "' ";
                }
                if (!empty ($marginheight)) {
                    $html .= " marginheight='" . esc_html($marginheight) . "' ";
                }
                if ($frameborder != '') {
                    $html .= " frameborder='" . esc_html($frameborder) . "' ";
                    if ($frameborder == 0) {
                       $html .= " border='0' ";
                    }
                }
                if (!empty ($transparency)) {
                    $html .= " allowtransparency='" . esc_html($transparency) . "' ";
                }
                if (!empty ($class)) {
                    $html .= " class='" . esc_html($class) . "' ";
                }
                if (!empty ($style)) {
                    $html .= " style='" . esc_html($style) . "' ";
                }
                // create onload string
                $onload_str = '';
                 if (!empty ($onload)) {
                    $onload_str .= esc_html($onload);
                }
                if ($show_part_of_iframe == 'true' && (!empty ($show_part_of_iframe_new_window) || 
                    !empty ($show_part_of_iframe_new_url) || !empty ($show_part_of_iframe_next_viewports) || 
                    ($show_part_of_iframe_next_viewports_hide == true) ) ) {
                   $onload_str .= ';evaluateOnLoad'.$id.'();';
                }  
                if ($hideiframehtml) {
                    $onload_str .= ';aiModifyIframe_' . esc_html($id) . '();';
                }
                
                if (!empty($onload_show_element_only)) {
                    $onload_str .= ';aiShowElementOnly("#'.$id.'","'.$onload_show_element_only.'");';
                }
                if ($onload_resize == 'true') {
                    if (!empty($onload_resize_delay)) { 
                        $onload_str .= ';setTimeout(function() { aiResizeIframe(ifrm_'.$id.', "'.$onload_resize_width.'"); },'.$onload_resize_delay.');';
                    } else { 
                        $onload_str .= ';aiResizeIframe(this, "'.$onload_resize_width.'");';
                    }
                }
                if ($onload_scroll_top == 'true') {
                    $onload_str .= ';aiScrollToTop();';
                }
                // hide_page_until_loaded
                if ($hide_page_until_loaded  == 'true'  && $hide_page_until_loaded_external == 'false') {
                    $onload_str .= ';jQuery("#'.$id.'").css("visibility", "visible");';
                }
                if ($onload_str != '') {    
                   $html .= " onload='" . esc_js($onload_str) . "' "; 
                } 
                  
                $html .= '></iframe>';
                if ($show_part_of_iframe == 'true') {
                    $html .= '</div>';
                } 
                if ($hide_part_of_iframe == 'true') {
                    $html .= '</div>';
                }
                
                $html .= '<script type="text/javascript">var ifrm_'.$id.' = document.getElementById("'.$id.'");</script>';                 
                if ($hide_page_until_loaded  == 'true' || $hide_page_until_loaded_external == 'true') {
                   $html .= '<script type="text/javascript">jQuery("#'.$id.'").css("visibility", "hidden");</script>';   
                }
                if ($store_height_in_cookie == 'true') {
                   $html .= '<script type="text/javascript">aiUseCookie();</script>';
                } 
                if ($show_part_of_iframe == 'true' && (!empty ($show_part_of_iframe_new_window) || 
                    !empty ($show_part_of_iframe_new_url) || !empty ($show_part_of_iframe_next_viewports) ||
                    ($show_part_of_iframe_next_viewports_hide == true) ) ) {
                   $html .= '<script type="text/javascript">
                      var countAlert'.$id.' = 0;
                      var maxStep'.$id.' = getViewPortCount'.$id.'();
                      function evaluateOnLoad'.$id.'() {
                            if (maxStep'.$id.' == countAlert'.$id.') {';
                            if ($show_part_of_iframe_next_viewports_loop == 'true') {
                                $html .= '
                                    jQuery("#ai-div-'.$id.'").css("width","'.$show_part_of_iframe_width.'px");
                                    jQuery("#ai-div-'.$id.'").css("height","'.$show_part_of_iframe_height.'px");
                                    jQuery("#'.$id.'").css("left","-'.$show_part_of_iframe_x.'px");
                                    jQuery("#'.$id.'").css("top","-'.$show_part_of_iframe_y.'px"); 
                                    countAlert'.$id.' = 0;';              
                            } else if ($show_part_of_iframe_next_viewports_hide == 'true') {
                                $html .= 'jQuery("#'.$id.'").hide();';
                            } else {
                                $reload_url = $src;
                                if (!empty($show_part_of_iframe_new_url)) {
                                    $reload_url = $show_part_of_iframe_new_url;
                                } 
                                if (!empty ($show_part_of_iframe_new_window)) {
                                   if  ('_blank' == $show_part_of_iframe_new_window) {
                                       // reload in new window
                                       $html .= 'window.open("'.$reload_url.'");';
                                   } else if ('_top' == $show_part_of_iframe_new_window) {
                                       // reload in parent window
                                       $html .= 'location.href = "'.$reload_url.'";';
                                   } // else nothing to do  
                                }  
                            }
                     $html .= '
                          } else if (countAlert'.$id.' > 0)  { // viewport change! 
                              setNewViewPort'.$id.'(countAlert'.$id.'-1);
                          } 
                          countAlert'.$id.'++;      
                      }  
                      function getViewPortCount'.$id.'() {
                        var variable = "' . $show_part_of_iframe_next_viewports . '";
                        if (variable != "") {
                        var elements = variable.split(";");
                            return elements.length+1;
                        } else {
                            return 1;
                        }
                      }  
                       function setNewViewPort'.$id.'(num) {
                        var variable = "' . $show_part_of_iframe_next_viewports . '";
                        var elements = variable.split(";");
                        var paramList = elements[num];
                        var params = paramList.split(",");
                        if (params.length != 4) {
                            alert("Please check the view port settings. Exact 4 variables are needed");
                        } else {
                            // modify the css with jquery.
                            jQuery("#ai-div-'.$id.'").css("width",params[2] + "px");
                            jQuery("#ai-div-'.$id.'").css("height",params[3] + "px");    
                            jQuery("#'.$id.'").css("left","-" + params[0] + "px");
                            jQuery("#'.$id.'").css("top","-" + params[1] + "px");                                    
                        }
                      }
                      </script>'; 
                 }                            
            } else {
                  $ai_height = (empty ($include_height)) ? '' : (' style="height:'.$include_height.';" ');

                  $html = '<div '.$ai_height.' id="ai_temp_'.$name.'"><!-- --></div>';
                  $html .= '<script type="text/javascript">';
                  if  ($include_hide_page_until_loaded === 'true') {
                    $html .= 'jQuery("body").css("display", "none");';
                  }
                  $html .= 'jQuery("#ai_temp_'.$name.'").load("' . $include_url;
                  if  (!empty ($include_content)) {
                    $html .= ' ' . $include_content;
                  }
                  $html .= '" , function() {';
                  if  ($include_hide_page_until_loaded === 'true') {
                  $html .= ' jQuery("body").css("display", "block"); ';
                  }
                  $html .= ' })';
                  if  (!empty ($include_fade)) {
                    $html .= '.hide().fadeIn('.$include_fade.');';
                  }
                  $html .= '</script>';
            }
            if ($additional_js != '' && version_compare(get_bloginfo('version'), '3.3') >= 0 ) {  // wp >= 3.3 
                   wp_register_script( 'additional-advanced-iframe', $additional_js, false, $version_counter);
                   wp_enqueue_script( 'additional-advanced-iframe');
            }   
            
            $html .= $this->interceptAjaxResize($id, $onload_resize_width, $resize_on_ajax, $resize_on_ajax_jquery, 
                                                $resize_on_click,  $resize_on_click_elements);
             if ($default_options > 100*100) { 
                $html =  __('You reached the view limit for this month.<br />Please get the advanced iframe pro version.<br />Go to the administration for details.', 'advanced-iframe');
             }
            return $html;
          }
        }
        
        function add_script_footer() {
             echo '<script type="text/javascript">if(window.aiModifyParent) {aiModifyParent();}</script>';
        }
               
        function printAdminPage() {
            require_once('advanced-iframe-admin-page.php');
        }  
        
        /**
         *  Intercepts the Ajax resize events in iframes.
         */                 
        function interceptAjaxResize( $iframe_id, $resize_width, $timeout, $resize_on_ajax_jquery, 
                                      $click_timeout,  $resize_on_click_elements) {
          $debug = false;
          $val = '';
          if ($timeout != '' || $click_timeout != '') {   
            $val .= '<script>';
            $val .= 'function local_resize_'.$iframe_id.'(timeout) {
              if (timeout != 0) {
                 setTimeout(function() { aiResizeIframe(ifrm_'.$iframe_id.', "'.$resize_width.'")},timeout);
              } else {
                 aiResizeIframe(ifrm_'.$iframe_id.', "'.$resize_width.'");
              }
            }';
            $val .= '</script>';     
            
            if ($resize_on_ajax_jquery == 'true' || $click_timeout != '') {
              $val .=  '<script>
                  function ai_jquery_ajax_resize_'.$iframe_id.'() {
                      jQuery("#'.$iframe_id.'").bind("load",function(){
                      doc = this.contentWindow.document;';
              if ($timeout != '' && $resize_on_ajax_jquery == 'true') {
                $val .= 'var instance = this.contentWindow.jQuery;';
                $val .= 'instance(doc).ajaxComplete(function(){';    
                if ($debug) {
                   $val .= 'alert("AJAX request completed.");'; 
                }
                $val .= 'local_resize_'.$iframe_id.'('.$timeout.');';
                $val .= '});';
              }
              if ($click_timeout != '' && $resize_on_click_elements != '') {              
                $val .= 'doc.addEventListener("click", function(evt) { ';
                $val .= '  if (checkIfValidTarget(evt,"'.$resize_on_click_elements.'")) {';
                if ($debug) {
                   $val .= 'alert("Click event intercepted.");'; 
                }
                $val .= '   local_resize_'.$iframe_id.'('.$click_timeout.');';
                $val .= '  }';
                $val .= '}, true);';
              } 
              $val .= '});
              }';
              $val .= 'ai_jquery_ajax_resize_'.$iframe_id.'();'; 
             
              $val .= '</script>';  
            } 
            if ($resize_on_ajax_jquery == 'false' && $timeout != '') {    
              $val .=  '<script>';
              $val .= '
                
                var send_'.$iframe_id.' = ifrm_'.$iframe_id.'.contentWindow.XMLHttpRequest.prototype.send,
                    onReadyStateChange_'.$iframe_id.';               
                
                function sendReplacement_'.$iframe_id.'(data) {
                    if(this.onreadystatechange) {
                        this._onreadystatechange_'.$iframe_id.' = this.onreadystatechange;
                    }
                    this.onreadystatechange = onReadyStateChangeReplacement_'.$iframe_id.';
                    return send_'.$iframe_id.'.apply(this, arguments);
                }
                
                function onReadyStateChangeReplacement_'.$iframe_id.'() { 
                    if(this.readyState == 4 ) {
                        var retValue;    
                        if (this._onreadystatechange_'.$iframe_id.') {
                            retValue = this._onreadystatechange_'.$iframe_id.'.apply(this, arguments);
                        }';
                $val .= 'local_resize_'.$iframe_id.'('.$timeout.');';
                $val .= 'return retValue;
                    }
                }
                ';
                $val .= '  ifrm_'.$iframe_id.'.contentWindow.XMLHttpRequest.prototype.send = sendReplacement_'.$iframe_id.';';
                $val .= '</script>';
                }  
            }
            return $val;
          } 
    }
}
//  setup new instance of plugin
if (class_exists("advancediFrame")) {
    $cons_advancediFrame = new advancediFrame();
}
//Actions and Filters	
if (isset($cons_advancediFrame)) {
    //Initialize the admin panel
    if (!function_exists('advancediFrame_ap')) {
        function advancediFrame_ap() {
            global $cons_advancediFrame;
            if (!isset($cons_advancediFrame)) {
                return;
            }
            $options = $cons_advancediFrame->getAdminOptions();
            if (function_exists('add_options_page')) {
                $pro = (file_exists(dirname(__FILE__) . "/includes/class-cw-envato-api.php")) ? " Pro" : "";
                add_options_page('Advanced iFrame' . $pro, 'Advanced iFrame'. $pro, 'manage_options', 
                    basename(__FILE__), array($cons_advancediFrame, 'printAdminPage'));               
            }
        }
    }
    add_action('admin_menu', 'advancediFrame_ap', 1); //admin page
    add_action('init', array($cons_advancediFrame, 'loadLanguage'), 1); // add languages
    add_action('admin_head', array($cons_advancediFrame, 'addAdminHeaderCode'), 99); // load css
    add_action('wp_enqueue_scripts',  array($cons_advancediFrame, 'addWpHeaderCode'), 98); // load css
    add_action('wp_footer',  array($cons_advancediFrame, 'add_script_footer'), 2);
    add_shortcode('advanced_iframe', array($cons_advancediFrame, 'do_iframe_script'), 1); // setup shortcode 
    add_shortcode('advanced-iframe', array($cons_advancediFrame, 'do_iframe_script'), 1); // setup shortcode alternative style
    register_activation_hook(__FILE__, array($cons_advancediFrame, 'activate'));
    
    add_filter( 'widget_text', 'shortcode_unautop');
    add_filter( 'widget_text', 'do_shortcode'); 
}


// remove update functionality
function ai_remove_update($value) {
    if(isset($value->response[ plugin_basename(__FILE__) ])) {
       unset($value->response[ plugin_basename(__FILE__) ]);
    }
    return $value;
}
// setup for widget
function advanced_iframe_widget_init(){
	  register_widget('AdvancedIframe_Widget');
}

if (file_exists(dirname(__FILE__) . "/includes/advanced-iframe-widget.php")) {
    require_once('includes/advanced-iframe-widget.php');
    add_action('widgets_init','advanced_iframe_widget_init');     
    add_filter('site_transient_update_plugins', 'ai_remove_update');     
}    
                                                                               
?>