<?php
/* 
Plugin Name: Advanced iframe
Plugin URI: http://www.tinywebgallery.com/blog/advanced-iframe
Version: 2.0
Author: Michael Dempfle
Author URI: http://www.tinywebgallery.com
Description: This plugin includes any webpage as shortcode in an advanced iframe.
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

        //
        // class constructor
        //
        function advancediFrame() {
        }

        function init() {
            $this->getAdminOptions();
        }

        function activate() {
            $this->getAdminOptions();
        }

        function iframe_defaults() {
            $iframeAdminOptions = array(
                'securitykey' => sha1(session_id()),
                'src' => 'http://www.tinywebgallery.com', 'width' => '100%',
                'height' => '600', 'scrolling' => 'no', 'marginwidth' => '0', 'marginheight' => '0',
                'frameborder' => '0', 'transparency' => 'true', 'content_id' => '', 'content_styles' => '', 
                'hide_elements' => '', 'class' => '', 'shortcode_attributes' => 'true', 'url_forward_parameter' => '',
                'id' => 'advanced_iframe', 'name' => '', 
                'onload' => '', 'onload_resize' => 'false', 'onload_scroll_top' => 'false',
                'additional_js' => '', 'additional_css' => '', 'store_height_in_cookie' => 'false',
                'additional_height' => '0', 'iframe_content_id' => '', 'iframe_content_styles' => '', 
                'iframe_hide_elements' => '', 'version_counter' => '1'     
                );
            return $iframeAdminOptions;
        }

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

        function loadLanguage() {
            load_plugin_textdomain('advanced-iframe', false, dirname(plugin_basename(__FILE__)) . '/languages/');
            wp_enqueue_script('jquery');
        }

        /* CSS for the admin area */
        function addAdminHeaderCode() {
            echo '<link type="text/css" rel="stylesheet" href="' . get_bloginfo('wpurl') . '/wp-content/plugins/advanced-iframe/css/ai.css" />' . "\n";
            echo '<script type="text/javascript" src="' . get_bloginfo('wpurl') . '/wp-content/plugins/advanced-iframe/js/ai.js" ></script>' . "\n";
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

        function param($param, $content = null) {
            $value = isset($_GET[$param]) ? $_GET[$param] : '';
            return esc_html($value);
        }

        function do_iframe_script($atts) {
            $options = get_option('advancediFrameAdminOptions');
            // defaults for new settings  in 2.0
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
                 'version_counter' =>  $options['version_counter'] 
                , $atts));
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
                    'iframe_hide_elements' =>  $options['iframe_hide_elements'] )
                    , $atts));
            } else {          
                // only the secrity key is read.
                extract(shortcode_atts(array('securitykey' => 'not set'), $atts));
            }
            
            if (empty ($id)) {
                $id = 'advanced_iframe';
            }
             if (empty ($name)) {
                $name = 'advanced_iframe';
            }
 
            echo '<link type="text/css" rel="stylesheet" href="' . get_bloginfo('wpurl') . '/wp-content/plugins/advanced-iframe/css/ai.css" />' . "\n";
            echo '<script type="text/javascript" src="' . get_bloginfo('wpurl') . '/wp-content/plugins/advanced-iframe/js/ai.js" ></script>' . "\n";
                        
            if ($store_height_in_cookie == 'true') {
                echo  '<script type="text/javascript">aiEnableCookie=true; aiId="' . $id . '";</script>';
            }
            if ($additional_height != 0) {
                echo  '<script type="text/javascript">aiExtraSpace=' . $additional_height . ';</script>';
            }
            echo '<script type="text/javascript">function aiResizeIframeHeight(height) { aiResizeIframeHeightById("'.$id.'",height); }</script>' . "\n";
            
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
                        $read_param_esc = $this->param($parameter);
                        if ($read_param_esc != '') {
                            $src .= $sep . $parameter . "=" . $read_param_esc;
                            $sep = "&amp;";
                        }
                    }
                }
      
                $html = '';   
                 
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
                    $html .= 'function aiModifyParent() { ';
                    $html .=  $hidehtml;
                    $html .= '}';
                    $html .= 'jQuery(document).ready(function() { ';
                    $html .= 'aiModifyParent();';
                    $html .= ' });';
                    $html .= 'aiModifyParent();';
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
                    $html .= 'function aiModifyIframe() { ';
                    $html .=  $hideiframehtml;
                    $html .= '}';
                    $html .= '</script>';
                    }
                }

                
                
                
                $html .= "<iframe id='" . esc_html($id) . "' ";
                if (!empty ($name)) {
                    $html .= " name='" . esc_html($name) . "' ";
                }
                $html .= " src='" . $src . "' width='" . esc_html($width) . "' height='" . esc_html($height) .
                         "' scrolling='" . esc_html($scrolling) . "' ";
 
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
                // create onload string
                $onload_str = '';
                if ($hideiframehtml) {
                    $onload_str .= ';aiModifyIframe();';
                }
                
                if (!empty ($onload)) {
                    $onload_str .= esc_html($onload);
                }
                if ($onload_resize == 'true') {
                     $onload_str .= ';aiResizeIframe(this);';
                }
                if ($onload_scroll_top == 'true') {
                     $onload_str .= ';aiScrollToTop();';
                }
                if ($onload_str != '') {
                   $html .= " onload='" . esc_js($onload_str) . "' "; 
                } 
                $html .= "></iframe>\n ";
                if ($store_height_in_cookie == 'true') {
                   $html .= '<script type="text/javascript">aiUseCookie();</script>';
                }
                if ($additional_js != '' && version_compare(get_bloginfo('version'), '3.3') >= 0 ) {  // wp >= 3.3 
                   wp_register_script( 'additional-advanced-iframe', $additional_js, false, $version_counter);
                   wp_enqueue_script( 'additional-advanced-iframe');
                }   
                          
            }
            return $html;
        }
        
        function add_script_footer() {
             echo '<script type="text/javascript">if(window.aiModifyParent) {aiModifyParent();}</script>';
        }
        
       
        function printAdminPage() {
            require_once('advanced-iframe-admin-page.php');
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
                add_options_page('Advanced iFrame', 'Advanced iFrame', 'manage_options', basename(__FILE__), array(&$cons_advancediFrame, 'printAdminPage'));
            }
        }
    }
    add_action('admin_menu', 'advancediFrame_ap', 1); //admin page
    add_action('init', array(&$cons_advancediFrame, 'loadLanguage'), 1); // add languages
    add_action('admin_head', array(&$cons_advancediFrame, 'addAdminHeaderCode'), 99); // load css
    add_action('wp_enqueue_scripts',  array(&$cons_advancediFrame, 'addWpHeaderCode'), 98); // load css
    add_action('wp_footer',  array(&$cons_advancediFrame, 'add_script_footer'), 2);
    
    add_shortcode('advanced_iframe', array(&$cons_advancediFrame, 'do_iframe_script'), 1); // setup shortcode [twg]
    register_activation_hook(__FILE__, array(&$cons_advancediFrame, 'activate'));
}
?>