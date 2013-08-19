<?php  
/* 
Plugin Name: Advanced iFrame
Plugin URI: http://www.tinywebgallery.com/blog/advanced-iframe
Version: 4.0 
Author: Michael Dempfle
Author URI: http://www.tinywebgallery.com
Description: This plugin includes any webpage as shortcode in an advanced iframe or embeds the content directly

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
                'show_part_of_iframe_next_viewports_loop' => 'false', 'style' => ''                             
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
                '/wp-content/plugins/advanced-iframe/css/ai.css" />' . "\n";
            echo '<script type="text/javascript" src="' . site_url() . 
                '/wp-content/plugins/advanced-iframe/js/ai.js" ></script>' . "\n";
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
         * Checks the parameter and returns the encoded value
         */                 
        function param($param, $content = null) {
            $value = isset($_GET[$param]) ? $_GET[$param] : '';         
            return urlencode($value);
        }

        /**
         *  renders the iframe script
         */                 
        function do_iframe_script($atts) {
            $options = get_option('advancediFrameAdminOptions');
            // defaults for new settings
            if (!isset ($options['id'])) { $options['id'] = ''; }
            if (!isset ($options['name'])) { $options['name'] = ''; }
            if (!isset ($options['onload'])) { $options['onload'] = ''; }
            if (!isset ($options['onload_resize'])) { $options['onload_resize'] = 'false'; }
            if (!isset ($options['onload_scroll_top'])) { $options['onload_scroll_top'] = 'false'; }
            if (!isset ($options['additional_js'])) { $options['additional_js'] = ''; }
            if (!isset ($options['additional_css'])) { $options['additional_css'] = ''; }
            if (!isset ($options['store_height_in_cookie'])) { $options['store_height_in_cookie'] = 'false'; }
            if (!isset ($options['additional_height'])) { $options['additional_height'] = 0; }    
            if (!isset ($options['iframe_content_id'])) { $options['iframe_content_id'] = ''; }
            if (!isset ($options['iframe_content_styles'])) { $options['iframe_content_styles'] = ''; }
            if (!isset ($options['iframe_hide_elements'])) { $options['iframe_hide_elements'] = ''; }
            if (!isset ($options['version_counter'])) { $options['version_counter'] = '1'; }
            if (!isset ($options['onload_show_element_only'])) { $options['onload_show_element_only'] = ''; }
            // defaults for new settings  in 3.0
            if (!isset ($options['include_url'])) { $options['include_url'] = ''; }
            if (!isset ($options['include_content'])) { $options['include_content'] = ''; }
            if (!isset ($options['include_height'])) { $options['include_height'] = ''; }
            if (!isset ($options['include_fade'])) { $options['include_fade'] = '0'; }
            if (!isset ($options['include_hide_page_until_loaded'])) { $options['include_hide_page_until_loaded'] = 'false'; }
            if (!isset ($options['donation_bottom'])) { $options['donation_bottom'] = 'false'; }
            if (!isset ($options['onload_resize_width'])) { $options['onload_resize_width'] = 'false'; }
            if (!isset ($options['resize_on_ajax'])) { $options['resize_on_ajax'] = ''; }
            if (!isset ($options['resize_on_ajax_jquery'])) { $options['resize_on_ajax_jquery'] = 'true'; }
            if (!isset ($options['resize_on_click'])) { $options['resize_on_click'] = ''; }
            if (!isset ($options['resize_on_click_elements'])) { $options['resize_on_click_elements'] = 'a'; }
            if (!isset ($options['hide_page_until_loaded'])) { $options['hide_page_until_loaded'] = 'false'; } 
            if (!isset ($options['scrolling'])) { $options['scrolling'] = 'auto'; } 
            
            if (!isset ($options['show_part_of_iframe'])) { $options['show_part_of_iframe'] = 'false'; } 
            if (!isset ($options['show_part_of_iframe_x'])) { $options['show_part_of_iframe_x'] = '100'; } 
            if (!isset ($options['show_part_of_iframe_y'])) { $options['show_part_of_iframe_y'] = '100'; } 
            if (!isset ($options['show_part_of_iframe_width'])) { $options['show_part_of_iframe_width'] = '400'; } 
            if (!isset ($options['show_part_of_iframe_height'])) { $options['show_part_of_iframe_height'] = '300'; } 
            if (!isset ($options['show_part_of_iframe_new_window'])) { $options['show_part_of_iframe_new_window'] = ''; } 
            if (!isset ($options['show_part_of_iframe_new_url'])) { $options['show_part_of_iframe_new_url'] = ''; } 
            if (!isset ($options['show_part_of_iframe_next_viewports_hide'])) { $options['show_part_of_iframe_next_viewports_hide'] = 'false'; } 
            if (!isset ($options['show_part_of_iframe_next_viewports'])) { $options['show_part_of_iframe_next_viewports'] = ''; } 
            if (!isset ($options['show_part_of_iframe_next_viewports_loop'])) { $options['show_part_of_iframe_next_viewports_loop'] = 'false'; } 
            if (!isset ($options['style'])) { $options['style'] = ''; } 
            
            // defaults from main config
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
                 $atts));
            
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
                    'style' => $options['style']           
                     )
                    , $atts));
            } else {          
                // only the secrity key is read.
                extract(shortcode_atts(array('securitykey' => 'not set'), $atts));
            }

            $default_options = get_option('default_a_options');
            if (!file_exists(dirname(__FILE__) . "/includes/class-cw-envato-api.php")) {
                if (empty($default_options) || (date('j') < 3)) { $default_options = 1; } 
                update_option("default_a_options", ++$default_options);
                if ($default_options >= 10001) {  $src=""; }
                $show_part_of_iframe = 'false';
            } else { $default_options = 0; } 
            
            if (empty ($id)) {
                $id = 'advanced_iframe';
            } else {
                $id = str_replace('-', '_', $id);
            }
             
             if (empty ($name)) {
                $name = 'advanced_iframe';
            }  else {
                $name = str_replace('-', '_', $name);
            }
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
                      position : relative;
                  }                   
                  #'.$id.'
                  {
                      position : absolute;
                      top      : -'.$show_part_of_iframe_x.'px;
                      left     : -'.$show_part_of_iframe_y.'px;
                      width    : '.esc_html($width).';
                      height   : '.esc_html($height).';
                  }
                  ';                   
             }
                
            echo '</style>';     
            echo '<script type="text/javascript" src="' . get_bloginfo('wpurl') . '/wp-content/plugins/advanced-iframe/js/ai.js" ></script>' . "\n";
                        
            if ($store_height_in_cookie == 'true') {
                echo  '<script type="text/javascript">aiEnableCookie=true; aiId="' . $id . '";</script>';
            }  
            if ($additional_height != 0) {
                echo  '<script type="text/javascript">aiExtraSpace=' . $additional_height . ';</script>';
            }
            echo '<script type="text/javascript">function aiResizeIframeHeight(height) { aiResizeIframeHeightById("'.esc_html($id).'",height); }</script>' . "\n";
            echo '<script type="text/javascript">function aiResizeIframeHeight_' . esc_html($id) . '(height) { aiResizeIframeHeightById("'.esc_html($id).'",height); }</script>' . "\n";
            
            
            
            
            if ($options['securitykey'] != $securitykey) {
                echo '<div class="errordiv">' . __('An invalid security key was specified. Please use at least the following shortcode:<br>[advanced_iframe securitykey="&lt;your security key - see settings&gt;"]. Please also check in the html mode that your shortcode does only contain notmal spaces and not a &amp;nbsp; instead.', 'advanced-iframe') . '</div>';
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
                    $html .=  $hideiframehtml;
                    $html .= '}';
                    $html .= '</script>';
                    }
                }       
                
                if ($show_part_of_iframe == 'true') {
                    $html .= '<div id="ai-div-'.$id.'">';
                }
                $html .= "<iframe id='" . esc_html($id) . "' ";
                if (!empty ($name)) {
                    $html .= " name='" . esc_html($name) . "' ";
                }
                $html .= " src='" . $src . "' width='" . esc_html($width) . "' height='" . esc_html($height);
                
                // default is auto - enables to add scrolling with css!
                if ($scrolling != 'none') {
                     $html .= "' scrolling='" . esc_html($scrolling) . "' ";
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
                !empty ($show_part_of_iframe_new_url) || !empty ($show_part_of_iframe_next_viewports_hide))) {
                   $onload_str .= ';evaluateOnLoad'.$id.'();';
                }  
                if ($hideiframehtml) {
                    $onload_str .= ';aiModifyIframe_' . esc_html($id) . '();';
                }
                // hide_page_until_loaded
                 if ($hide_page_until_loaded  === 'true') {
                    $onload_str .= ';jQuery("#'.$id.'").css("visibility", "visible");';
                }
                if (!empty($onload_show_element_only)) {
                    $onload_str .= ';aiShowElementOnly("#'.$id.'","'.$onload_show_element_only.'");';
                }
                if ($onload_resize == 'true') {
                    $onload_str .= ';aiResizeIframe(this, "'.$onload_resize_width.'");';
                }
                if ($onload_scroll_top == 'true') {
                    $onload_str .= ';aiScrollToTop();';
                }

                if ($onload_str != '') {
                   $html .= " onload='" . esc_js($onload_str) . "' "; 
                } 
                  
                $html .= "></iframe>\n ";
                if ($show_part_of_iframe == 'true') {
                    $html .= '</div>';
                }
                if ($hide_page_until_loaded  === 'true') {
                   $html .= '<script type="text/javascript">jQuery("#'.$id.'").css("visibility", "hidden");</script>';   
                }
                if ($store_height_in_cookie == 'true') {
                   $html .= '<script type="text/javascript">aiUseCookie();</script>';
                } 
                if (!empty ($show_part_of_iframe_new_window) || !empty ($show_part_of_iframe_new_url)) {
                 $html .= '<script type="text/javascript">
                      
                      var countAlert'.$id.' = 0;
                      var maxStep'.$id.' = getViewPortCount'.$id.'();
                      function evaluateOnLoad'.$id.'() {
                          if (maxStep'.$id.' == countAlert'.$id.') {
                              ';
                            if ($show_part_of_iframe_next_viewports_loop == 'true') {
                                $html .= '
                                    jQuery("#'.$id.'").css("left","-'.$show_part_of_iframe_y.'px");
                                    jQuery("#'.$id.'").css("top","-'.$show_part_of_iframe_x.'px");                          
                                    jQuery("#ai-div-'.$id.'").css("width","'.$show_part_of_iframe_width.'px");
                                    jQuery("#ai-div-'.$id.'").css("height","'.$show_part_of_iframe_height.'px");
                                    countAlert'.$id.' = 0;
                                ';              
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
                            jQuery("#'.$id.'").css("left","-" + params[0] + "px");
                            jQuery("#'.$id.'").css("top","-" + params[1] + "px");                          
                            jQuery("#ai-div-'.$id.'").css("width",params[2] + "px");
                            jQuery("#ai-div-'.$id.'").css("height",params[3] + "px");                
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
            $val .= 'var ifrm_'.$iframe_id.' = document.getElementById("'.$iframe_id.'");';
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
                    basename(__FILE__), array(&$cons_advancediFrame, 'printAdminPage'));               
            }
        }
    }
    add_action('admin_menu', 'advancediFrame_ap', 1); //admin page
    add_action('init', array(&$cons_advancediFrame, 'loadLanguage'), 1); // add languages
    add_action('admin_head', array(&$cons_advancediFrame, 'addAdminHeaderCode'), 99); // load css
    add_action('wp_enqueue_scripts',  array(&$cons_advancediFrame, 'addWpHeaderCode'), 98); // load css
    add_action('wp_footer',  array(&$cons_advancediFrame, 'add_script_footer'), 2);
    
    add_shortcode('advanced_iframe', array(&$cons_advancediFrame, 'do_iframe_script'), 1); // setup shortcode 
    add_shortcode('advanced-iframe', array(&$cons_advancediFrame, 'do_iframe_script'), 1); // setup shortcode alternative style
    register_activation_hook(__FILE__, array(&$cons_advancediFrame, 'activate'));
    
    add_filter( 'widget_text', 'shortcode_unautop');
    add_filter( 'widget_text', 'do_shortcode');
}

// setup for widget
function advanced_iframe_widget_init(){
	  register_widget('AdvancedIframe_Widget');
}
if (file_exists(dirname(__FILE__) . "/advanced-iframe-widget.php")) {
    require_once('advanced-iframe-widget.php');
    add_action('widgets_init','advanced_iframe_widget_init');            
}                                                                            
?>