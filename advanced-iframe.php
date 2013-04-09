<?php  
/* 
Plugin Name: Advanced iframe
Plugin URI: http://www.tinywebgallery.com/blog/advanced-iframe
Version: 3.4.1 
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
                'iframe_hide_elements' => '', 'version_counter' => '1', 'onload_show_element_only' => '' , 
                'include_url'=> '','include_content'=> '','include_height'=> '','include_fade'=> '',
                'include_hide_page_until_loaded' => 'false', 'donation_bottom' => 'false',
                'onload_resize_width' => 'false', 'resize_on_ajax' => '', 'resize_on_ajax_jquery' => 'true',
                'resize_on_click' => '', 'resize_on_click_elements' => 'a', 'hide_page_until_loaded' => 'false'                 
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
            return urlencode($value);
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
                    'hide_page_until_loaded' =>  $options['hide_page_until_loaded']         
                     )
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
                    $onload_str .= ';aiModifyIframe_' . esc_html($id) . '();';
                }
                
                if (!empty ($onload)) {
                    $onload_str .= esc_html($onload);
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
                if ($hide_page_until_loaded  === 'true') {
                   $html .= '<script type="text/javascript">jQuery("#'.$id.'").css("visibility", "hidden");</script>';   
                }
                if ($store_height_in_cookie == 'true') {
                   $html .= '<script type="text/javascript">aiUseCookie();</script>';
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
            
            // $html .= '<div style="clear:none" />';
            
            $html .= $this->interceptAjaxResize($id, $onload_resize_width, $resize_on_ajax, $resize_on_ajax_jquery, $resize_on_click,  $resize_on_click_elements);
            return $html;
          }
        }
        
        function add_script_footer() {
             echo '<script type="text/javascript">if(window.aiModifyParent) {aiModifyParent();}</script>';
        }
        
       
        function printAdminPage() {
            require_once('advanced-iframe-admin-page.php');
        }
        
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