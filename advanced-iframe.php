<?php
/*
Plugin Name: Advanced iFrame 
Plugin URI: http://www.tinywebgallery.com/blog/advanced-iframe
Version: 6.5.5
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
        var $scriptsNeeded = false;
        /*
        * class constructor
        */
        function advancediFrame() {
        }

        /**
         *  wp init
         */
        function init() {
            $this->getAiAdminOptions();
        }

        /**
         *  wp activate
         */
        function activate() {
            $this->getAiAdminOptions();
        }

        /**
         * Set the iframe default
         */
        function iframe_defaults() {
            $iframeAdminOptions = array(
                'securitykey' => sha1(AUTH_KEY . time() ),
                'src' => '//www.tinywebgallery.com', 'width' => '100%',
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
                'hide_part_of_iframe' => '', 'change_parent_links_target' => '',
                'change_iframe_links' => '','change_iframe_links_target' => '',
                'browser' => '', 'show_part_of_iframe_style' => '',
                'map_parameter_to_url' => '', 'iframe_zoom' => '',
                'accordeon_menu' => 'false',
                'show_iframe_loader' => 'false',
                'tab_visible' => '', 'tab_hidden' => '',
                'enable_responsive_iframe' => 'false',
                'allowfullscreen' => 'false', 'iframe_height_ratio' => '',
                'enable_lazy_load' => 'false', 'enable_lazy_load_threshold' => '3000',
                'enable_lazy_load_fadetime' => '0', 'enable_lazy_load_manual' => 'false',
                'pass_id_by_url' => '', 'include_scripts_in_footer' => 'false',
                'write_css_directly' => 'false', 'resize_on_element_resize' => '',
                'resize_on_element_resize_delay' => '250', 'add_css_class_parent' => 'false',
                'auto_zoom'  => 'false', 'auto_zoom_by_ratio' => '',
                'single_save_button' => 'true', 'enable_lazy_load_manual_element' => '',
                'alternative_shortcode' => '', 'show_menu_link' => 'true',
                'iframe_redirect_url' => '', 'install_date' => 0,
                'show_part_of_iframe_last_viewport_remove' => 'false',
                'load_jquery' => 'true', 'show_iframe_as_layer' => 'false',
                'add_iframe_url_as_param' => 'false', 'add_iframe_url_as_param_prefix' => '',
                'reload_interval' => '', 'iframe_content_css' => '',
                'additional_js_file_iframe' => '', 'additional_css_file_iframe' => '', 
                'add_css_class_iframe' => 'false', 'editorbutton' => 'securitykey',
                'iframe_zoom_ie8' => 'false', 'enable_lazy_load_reserve_space' => 'true',
                'hide_content_until_iframe_color' => '', 'use_zoom_absolute_fix' => 'false',
                'include_html' => ''                  
                );
            return $iframeAdminOptions;
        }

        /**
         * Get the admin options
         */
        function getAiAdminOptions() {
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
            load_plugin_textdomain('advanced-iframe', false, dirname(plugin_basename(__FILE__)) . '/languages');
            $options = $this->getAiAdminOptions();
            if ($options['load_jquery'] === 'true') {
              wp_enqueue_script('jquery');
            }    
        }

        /* CSS and js for the admin area - only loaded when needed */
        function addAdminHeaderCode($hook) {
            if( $hook != 'settings_page_advanced-iframe' && $hook != 'toplevel_page_advanced-iframe') 
         		    return;
            $options = get_option('advancediFrameAdminOptions');
            // defaults
            extract(array('version_counter' => $options['version_counter']));       
            wp_enqueue_style('ai-css', plugins_url( 'css/ai.css' , __FILE__ ), false, $version_counter);
            // wp_enqueue_style('ai-css-print', plugins_url( 'css/ai-print.css' , __FILE__ ), false, $version_counter);
            wp_enqueue_script('ai-js',plugins_url( 'js/ai.js' , __FILE__ ), false, $version_counter);
            wp_enqueue_script('ai-search',plugins_url( 'js/findAndReplaceDOMText.js' , __FILE__ ), false, $version_counter); 
        }
        
        /* Add the Javascript for the iframe button above the editor. */
        function addAiButtonJs() {
            $options = get_option('advancediFrameAdminOptions');
            if  ($options['editorbutton'] == 'securitykey') {
              echo '<script type="text/javascript">
              jQuery(document).ready(function(){
                 jQuery("#insert-iframe-button").click(function() {
                    send_to_editor("[advanced_iframe securitykey=\"'.$options['securitykey']. '\"]");
                    return false;
                 });
              });
              </script>';
            }
        }

        /* Add iframe button above the editor. */
        function addAiButton(){
            $options = get_option('advancediFrameAdminOptions');
            if  ($options['editorbutton'] == 'securitykey') {
                echo '<a title="Insert Advanced iFrame" class="button insert-media add_media" id="insert-iframe-button" href="#">Add Advanced iFrame</a>';
            }
        }
        
        /* Adds a quicktags button - currently not used as the media button solution is used. */
        function advanced_iframe_add_quicktags() {
        if (wp_script_is('quicktags')){
            $options = get_option('advancediFrameAdminOptions');
            $editorbutton = $options['editorbutton'];
            if ($editorbutton == 'securitykey') {
              ?>
              <script type="text/javascript">
               QTags.addButton( 'ai_iframe', 'advanced iframe', '[advanced_iframe securitykey="<?php echo $options['securitykey']; ?>"]', '', '', 'Advanced iframe');
              </script>
          <?php
              }
            }
        }
        
         /* additional CSS for wp area */
        function addWpHeaderCode($atts) { 
              $options = get_option('advancediFrameAdminOptions');
              // defaults
              extract(array('additional_css' => $options['additional_css'],
                            'additional_js' => $options['additional_js'],
                            'version_counter' => $options['version_counter'],
                            'enable_lazy_load' => $options['enable_lazy_load'],
                            'include_scripts_in_footer' => $options['include_scripts_in_footer'], 
                            'add_css_class_parent' => $options['add_css_class_parent'],                       
                $atts));
               
              $to_footer = ($include_scripts_in_footer === 'true' && $add_css_class_parent === 'false');
  
              $older_version = version_compare(get_bloginfo('version'), '3.3') < 0; // wp < 3.3 - older version need to be included here
              if ($additional_css != '' && $older_version) { // wp < 3.3 
                  wp_enqueue_style( 'additional-advanced-iframe-css', $additional_css, false, $version_counter);
              }
              if ($additional_js != '' && $older_version ) {  
                  wp_enqueue_script( 'additional-advanced-iframe-js', $additional_js, false, $version_counter, $to_footer);
              }
              $dep = ($options['load_jquery'] === 'true') ? array( 'jquery') : array();
              wp_enqueue_script('ai-js',plugins_url( 'js/ai.js' , __FILE__ ), $dep, $version_counter, $to_footer); 
        }

        /**
         * Checks the parameter and returns the value. If only chars on the whitelist are in the request nothing is done
         * Otherwise it is returned encoded.
         */
        function param($param, $content = null) {
		    // get and post parameters are checked. if both are set the get parameter is used.
            $value = isset($_GET[$param]) ? $_GET[$param] : (isset($_POST[$param]) ? $_POST[$param] : '');

            $value_check = $value;
            // first we decode the param to be sure the it is not already encoded or doubleencoded as part of an attack
            while ($value_check != urldecode($value_check)) {
               $value_check = urldecode($value_check);
            }
            if( get_magic_quotes_gpc() ) {
	              $value_check = stripcslashes($value_check); 
	          }  
            // If all chars are in the whitelist no additional encoding is done!
            if (preg_match('/^[\.@a-zA-Z0-9À-ÖØ-öø-ÿ\/\:\&\?\-\|\)\(]*$/', $value_check)) {
                return $value;
            } else {
                return urlencode($value);
            }
        }
        
        function scale_value($value, $iframe_zoom) {
            if (strpos($value, '%') === false) {       
                return (intval($value) * floatval($iframe_zoom)) . 'px';      
            } else {
                $value = substr($value, 0, -1);  
                return (intval($value) * floatval($iframe_zoom)) . '%';    
            }
        }
        
        function addPx($value) {
             $value = trim($value);
             if (strpos($value, '%') === false) { 
                $value = $value . 'px';
             }
             return $value;
        }

        /**
         *  renders the iframe script
         */
        function do_iframe_script($atts, $content = null) {
            global $aip_standalone, $iframeStandaloneDefaultOptions, $iframeStandaloneOptions ;
            
            // check if $atts does only include valid shortcode attributes and print a message otherwise.
            // Needed to find out configuration errors !
            // print_r($atts);
            
            include dirname(__FILE__) . '/includes/advanced-iframe-main-read-config.php';
           
            // start to build the html
            $html = ''; // the output
            
            if ($browser != '' || (!empty($iframe_zoom))) {           
              if (file_exists(dirname(__FILE__) . "/includes/advanced-iframe-browser-detection.php")) {
                  if ( !defined( 'AIP' ) ) {
                      define("AIP", "Advanced iFrame Pro");
                  }
                  include_once dirname(__FILE__) . "/includes/advanced-iframe-browser-detection.php";
                  if (!is_selected_browser($browser,$id)) {
                    return;
                  }
              }
            }

            // inline css to prevent loading of the whole ai.css
             $error_css = '<style type="text/css">
                 .errordiv { padding:10px; margin:10px; border: 1px solid #555555;color: #000000;background-color: #f8f8f8; text-align:center; width:500px; }
                 #ai-div-hide-content-'.$id.' { width:100%;height:100%;position:fixed;z-index:999;top:0px;left:0px;background-color:'.esc_html($hide_content_until_iframe_color).'; }
                 </style>';
                 
             $html .= $error_css;    
             // generate css for partly shown iframe
             $html .= '<style type="text/css">';
             if ($show_part_of_iframe == 'true') {
                 $html .= '
                  #ai-div-'.$id.'
                  {
                      width    : '.esc_html($show_part_of_iframe_width).'px;
                      height   : '.esc_html($show_part_of_iframe_height).'px;
                      overflow : hidden;
                      position : relative;';
                  if ($show_part_of_iframe_allow_scrollbar_horizontal == 'true') {
                     $html .= 'overflow-x : auto;';
                  }
                  if ($show_part_of_iframe_allow_scrollbar_vertical == 'true') {
                     $html .= 'overflow-y : auto;';
                  }
                  if (!empty($show_part_of_iframe_style)) {
                      $html .= esc_html($show_part_of_iframe_style);
                  }
                  $html .= '
                  }
                  #'.$id.'
                  {
                      position : absolute;
                      top      : -'.esc_html($show_part_of_iframe_y).'px;
                      left     : -'.esc_html($show_part_of_iframe_x).'px;
                      width    : '.esc_html($width).';
                      height   : '.esc_html($height).';
                  }';
             }
             
            $scale_width = $width; 
            $scale_height = $height; 
            
            $enable_ie_8_support = false; 
            if (!empty($iframe_zoom)) {
                 if ($width != 'not set' && $width != '') {
                     $scale_width = $this->scale_value($width, $iframe_zoom); 
                 } else {
                    return $error_css . '<div class="errordiv">' . __('Configration error: Zoom does need a specified width.', 'advanced-iframe') . '</div>';         
                 }
                 if ($height != 'not set' && $height != '') {
                      $scale_height = $this->scale_value($height, $iframe_zoom); 
                 } else {
                     return $error_css . '<div class="errordiv">' . __('Configration error: Zoom does need a specified height.', 'advanced-iframe') . '</div>'; 
                 }
                  
                 $html .= '#ai-zoom-div-'.$id.'
                  {
                    width: '.$scale_width.';
                    height: '.$scale_height.'; 
                    padding: 0;
                    overflow: hidden;
                  }
                  #'.$id.'
                  {';
                     if(version_compare(PHP_VERSION, '5.3.0') >= 0) {
                       $enable_ie_8_support = ($iframe_zoom_ie8 == 'true') && $this->checkIE8();
                       if ($enable_ie_8_support) {
                         $html .= '-ms-zoom:'.$iframe_zoom.';'; 
                       }
                     }
                     $html .= '-ms-transform: scale('.$iframe_zoom.');
                        -ms-transform-origin: 0 0;
                        -moz-transform: scale('.$iframe_zoom.');
                        -moz-transform-origin: 0 0;
                        -o-transform: scale('.$iframe_zoom.');
                        -o-transform-origin: 0 0;
                        -webkit-transform: scale('.$iframe_zoom.');
                        -webkit-transform-origin: 0 0;
                        transform: scale('.$iframe_zoom.');
                        transform-origin: 0 0;
                        ';   
                        if ($use_zoom_absolute_fix == 'true') {
                           $html .=  ' position:absolute;  ';
                        }
                    $html .= '
                        }';         
            } 
            
            if ($show_iframe_loader == 'true') {
                    // div for the loader 
                    if ($show_part_of_iframe == 'true') {  // size is show part of the iframe  
                        $loader_width = $show_part_of_iframe_width;
                        $loader_height = $show_part_of_iframe_height; 
                    } else  if (!empty($iframe_zoom)) { // or zoom size
                        $loader_width = $scale_width;
                        $loader_height = $scale_height; 
                    } else { // the iframe size.
                        $loader_width = $width;
                        $loader_height = $height;
                    }   
                 $html .= '#ai-div-container-'.$id.'
                 { 
                     position: relative;
                     width: ' . $this->addPx($loader_width);
                     if ($enable_responsive_iframe == 'true') {
                      $html .= '; max-width: 100%';
                     }
                 $html .= ';}
                 #ai-div-loader-'.$id.'
                 {
                    position: absolute;
                    z-index:1000;
                    margin-left:-33px;
                    left: 50%;';
                 if ($show_part_of_iframe == 'true') {
                   $itop = ($show_part_of_iframe_height / 2) - 33;
                   if ($itop > 150) {
                       $itop = 150;
                   }
                   $html .= '   top: ' . floor($itop) . 'px;';
                 } else {
                   $html .= '   top: 150px;
                   }';
                 }
                  $html .= '#ai-div-loader-'.$id.' img
                 {
                    border: none;
                 }';
            }
            
            if ($enable_lazy_load == 'true') {
              $html .= '.ai-lazy-load-'.$id.' {';  
              if ($enable_lazy_load_reserve_space) {
                $html .= '
                  width: '.$scale_width.';
                  height: '.$scale_height.';';
              } 
              $html .= '
                padding: 0;
                margin: 0;
              }';
            }
            
            if ($hide_page_until_loaded  == 'true' || $hide_page_until_loaded_external == 'true') {
              $html .= '#'.$id.' { visibility:hidden; } ';
              if (!empty($hide_part_of_iframe)) { 
                 $html .= '.wrapper-div-'.$id.' { visibility:hidden; } ';
              }   
            }
            
            $html .= '</style>';
           
            $html .= '<script type="text/javascript">';
            $html .= '   var ai_iframe_width_'.$id.' = 0;';
            $html .= '   var ai_iframe_height_'.$id.' = 0;';
            
  
            if (version_compare(PHP_VERSION, '5.3.0') >= 0 && !empty($iframe_zoom)) { 
               $html .= ($enable_ie_8_support) ? 'var aiIsIe8=true;' : 'var aiIsIe8=false;';
            }
            if ($store_height_in_cookie == 'true') {
                $html .=  'var aiEnableCookie=true; aiId="' . $id . '";';
            }
            if ($additional_height != 0) {
                $html .=  'var aiExtraSpace=' . esc_html($additional_height) . ';';
            }
            if (!empty($iframe_zoom)) {
                $html .= ' var zoom_' . $id.' = ' .esc_html($iframe_zoom). ';'; 
            }
            // $html .= 'var aiReadyCallbacks = ( typeof aiReadyCallbacks !== \'undefined\' && aiReadyCallbacks instanceof Array ) ? aiReadyCallbacks : [];'; 
			// is written like this to avoid && which is encoded to &#038;&#038; depending on the wordpress settings!
			
			$html .= '
			if (typeof aiReadyCallbacks === \'undefined\') {
			    var aiReadyCallbacks = [];  
			} else if (!(aiReadyCallbacks instanceof Array)) {
			    var aiReadyCallbacks = [];			
			}';
			
            $html .= 'var onloadFired'.$id.' = false; ';       
            $html .= '    function aiShowIframe() { jQuery("#'.$id.'").css("visibility", "visible");';
            if (!empty($hide_part_of_iframe)) {                  
                $html .= '        jQuery(".wrapper-div-'.$id.'").css("visibility", "visible");';
            }
            $html .= '    }';
            $html .= '    function aiShowIframeId(id_iframe) { jQuery("#"+id_iframe).css("visibility", "visible");';
            if (!empty($hide_part_of_iframe)) {
                $html .= '        jQuery(".wrapper-div-"+id_iframe).css("visibility", "visible");';
            }
            $html .= '    }';
           
            $html .= '    function aiResizeIframeHeight(height) { aiResizeIframeHeight(height,'.$id.'); }'; 
              // the external height is rendered always for easier configuration
              $html .= '    function aiResizeIframeHeightId(height,width,id) {'; 
              if ($auto_zoom == 'remote') { 
                  $html .= '   aiAutoZoomExternal(id, width,"' . $enable_responsive_iframe . '");';
                  $html .= '   ai_iframe_width_'.$id.' = width;';
                  $html .= '   ai_iframe_height_'.$id.' = height;';
              }
              if (!empty($iframe_zoom)) { 
                $html .= ' var zoom_height = parseInt(height * parseFloat(window["zoom_" + id]))+1;';
                $html .= ' jQuery(\'#ai-zoom-div-\' + id).css("height",zoom_height);';
              }            
              if ($show_part_of_iframe === 'true') {
                $html .= ' resetShowPartOfAnIframe(id);';
              }
              $html .= 'aiResizeIframeHeightById(id,height);';
              $html .= '}';
              // end aiResizeIframeHeightId
            $html .= '</script>';
            if ($options['securitykey'] != $securitykey && empty($alternative_shortcode)) {
                return $error_css . '<div class="errordiv">' . __('No valid security key found. Please use at least the following shortcode:<br>&#91;advanced_iframe securitykey="&lt;your security key - see settings&gt;"&#93;<br /> Please also check in the html mode that your shortcode does only contain normal spaces and not a &amp;nbsp; instead.  It is also possible that you use wrong quotes like &#8220; or &#8221;. Only &#34; is valid!', 'advanced-iframe') . '</div>';
            } else if ( $src == "not set" && empty($include_url) &&  empty($include_html)) {
                return $error_css . '<div class="errordiv">' . __('You have set "Use shortcode attributes only" (use_shortcode_attributes_only) to "true" which means that you have to specify all parameters as shortcode attributes. Please specify at least "securitykey" and "src". Examples are available in the administration.', 'advanced-iframe') . '</div>';
            } else {
                // add parameters
                if ($url_forward_parameter != '') {
                    $sep = (strpos($src, '?') === false)? '?': "&amp;";
                    if ($url_forward_parameter == 'ALL') {
                        $parameters = array();
                        foreach ($_GET as $key => $value) {
                            $parameters[] = $key;
                        }  
						foreach ($_POST as $key => $value) {
                            $parameters[] = $key;
                        }  
                    } else {
                        $parameters = explode(",", $url_forward_parameter);
                    }
                    foreach ($parameters as $parameter) {
                        // check for mapping urlname|iframe name
                        $parameter_mapping = explode("|", $parameter);
                        if (count($parameter_mapping) == 1) {
                            $parameter_mapping[1] = $parameter_mapping[0];
                        }
                        $read_param_url = $this->param($parameter_mapping[0]);
                        if ($read_param_url != '') {
                            $src .= $sep . $parameter_mapping[1] . "=" . ($read_param_url);
                            $sep = "&amp;";
                        }
                    }
                }
                
                
                if (!empty($pass_id_by_url)) {
                    $sep = (strpos($src, '?') === false)? '?': "&amp;";
                    $src .= $sep . $pass_id_by_url . "=" . $id;  
                }  
                  
                // Evaluate shortcodes and replace placeholders for the src - they are not encoded! 
                // This has to be done by the shortcode that is used
                $src = $this->ai_replace_placeholders($src , $enable_replace);

                $src_orig = $src;
                if (!empty($map_parameter_to_url)) {
                    $parameters = explode(",", $map_parameter_to_url); 
                    foreach ($parameters as $parameter) {
                        // check for mapping parameter|value|url
                        $parameter_url_mapping = explode("|", $parameter);
                         if (count($parameter_url_mapping) == 3) {
                            $read_param_url = $this->param($parameter_url_mapping[0]);
                            if ($read_param_url == $parameter_url_mapping[1]) {
                                $src = $parameter_url_mapping[2]; 
                            }  
                         } else if (count($parameter_url_mapping) == 1) {
                            $src_url = $this->param($parameter_url_mapping[0]);
                            if (!empty($src_url)) { 
                                $src = urldecode($src_url);   
                                $prefix = urldecode($add_iframe_url_as_param_prefix);
                                if (!$this->ai_startsWith($src,"http")) {
                                   if ($this->ai_startsWith($src,"s|")) { 
                                     $src = "https://" . $prefix . substr($src,2);
                                   } else {
                                     $src = "http://" . $prefix . $src;
                                   }  
                                }  
                            }
                         } else {
                            return $error_css . '<div class="errordiv">' . __('ERROR: map_parameter_to_url does not have the required 1 or 3 parameters', 'advanced-iframe') . '</div>';
                         }
                    }        
                }
				
				// pdf
				if ($this->ai_endsWith($src, '.pdf')) {
				    if ($this->ai_startsWith($src, 'NATIVE:')) {
               $src = substr($src, 7);
            } else {
               $src = '//docs.google.com/gview?url=' . $src . '&embedded=true';
            }     
				}

                if (empty($include_url) && empty($include_html)) {
                  if ((!empty($content_id) && !empty($content_styles)) ||
                       !empty($hide_elements) || !empty($change_parent_links_target)
                       || $enable_lazy_load == 'true' || $add_css_class_parent == 'true'
                       || $show_iframe_as_layer == 'external') {

                    // hide elements is called directy in the page to hide elements as fast as quickly
                    $hidehtml = '';
                     // Add class to all parent elements for easier styling
                    if ($add_css_class_parent == 'true') {
                        $hidehtml .= " if (window.aiAddCssClassAllParents) { aiAddCssClassAllParents('#".$id."'); }";
                    }
                                        
                    if (!empty($hide_elements)) {
                        $hidehtml .= "jQuery('" . esc_html($hide_elements) . "').css('display', 'none');";
                    }
                    if (!empty($content_id)) {
                        $elements = esc_html($content_id); // this field should not have a problem if they are encoded.
                        $values = esc_html($content_styles); // this field style should not have a problem if they are encoded.
                        $elementArray = explode("|", $elements);
                        $valuesArray = explode("|", $values);
                        if (count($elementArray) != count($valuesArray)) {
                            return $error_css . '<div class="errordiv">' . __('Configuration error: The attributes content_id and content_styles have to have the amount of value sets separated by |.', 'advanced-iframe') . '</div>';
                        } else {
                            for ($x = 0; $x < count($elementArray); ++$x) {
                                $valuesArrayPairs = explode(";", trim($valuesArray[$x], " ;:"));
                                for ($y = 0; $y < count($valuesArrayPairs); ++$y) {
                                    $elements = explode(":", $valuesArrayPairs[$y]);
                                    $sel = trim($elementArray[$x]);
                                    $sel = str_replace('##', '>', $sel ); 
                                    $hidehtml .= "jQuery('" . $sel . "').css('" . trim(strtolower($elements[0])) . "', '" . trim(strtolower($elements[1])) . "');";
                                }
                            }
                        }
                    }

                    $html .= '<script type="text/javascript">';
                    $html .= 'function loadElem_'.$id.'(elem)
                     {'; 
                     if ($enable_lazy_load_fadetime != '0') {
                     $html .= ' 
                        elem.fadeOut(0, function() {
                          elem.fadeIn('.$enable_lazy_load_fadetime.');
                        });';
                     }
                     $html .= '}';
 
                    $html .= 'function aiModifyParent_' . $id . '() { ';
                    $html .=  $hidehtml;
                    $html .= '}';
                    
                    $aiReady = '';
                    //  Change parent links target
                    if (!empty($change_parent_links_target) && $show_iframe_as_layer !== 'external') {
                      $elementArray = explode("|", $change_parent_links_target);
                      for ($x = 0; $x < count($elementArray); ++$x) {
                          $aiReady .= 'jQuery("'. trim($elementArray[$x]) .'").attr("target", "'.$id.'");';
                      }
                       
                      if ($show_iframe_as_layer == 'true') {
                        $aiReady .=  'jQuery("'.$change_parent_links_target.'").on( "click", function() { ai_showLayerIframe("' . $id . '","'.site_url() . $aiPath.'/img/"); });'; 
                      }      
                    }
                    if ($show_iframe_as_layer == 'external') {   
                         $aiReady .=  'jQuery("a").each(function () {
                          if (this.host !== location.host) {
                            jQuery(this).attr("target", "'.$id.'");
                            jQuery(this).on("click", function() { ai_showLayerIframe("' . $id . '","'.site_url() . $aiPath.'/img/"); });
                          }
                      });';
                    }

                    $aiReady .= 'aiModifyParent_' . $id . '();';
                    
                    if ($enable_lazy_load == 'true') { 
                       // the 50 ms timeout is used because tabs need a little bit to initialize and hide the content.
                       $initLazyIframe = 'setTimeout(function() { jQuery("#ai-lazy-load-'.$id.'").lazyload({threshold: '.$enable_lazy_load_threshold.', load: loadElem_'.$id.'}); },50);';   
                       if ($enable_lazy_load_manual != 'auto') {
                           $initLazyIframe .= "jQuery.lazyload.setInterval(0);"; 
                       }
                       if ($enable_lazy_load_manual == 'true') {
                           $html .= 'function aiLoadIframe_' . $id . '() { ';
                           $html .=  $initLazyIframe;
                           $html .= '};'; 
                           
                            if (!empty($enable_lazy_load_manual_element)) {
                               $html .= ' function trigger_manual_' . $id . '() { '; 
                               $html .= 'jQuery( "' . esc_html($enable_lazy_load_manual_element) . '" ).click(function() { ';
                               $html .= 'window.setTimeout(function(){'; 
                               $html .= '  aiLoadIframe_' . $id . '(); ';  
                               $html .= '}, 10);';
                               $html .= 'return false;';
                               $html .= '});'; 
                               $html .= '}';  
                               $aiReady .= 'trigger_manual_' . $id . '();';
                            }    
                       } else {
                           $aiReady .= $initLazyIframe; 
                       } 
                    }
                    $html .= 'var aiReadyAiFunct_' . $id . ' = function aiReadyAi_' . $id . '() { ';
                    $html .=  $aiReady;
                    $html .= '};';
                    $html .= 'aiReadyCallbacks.push(aiReadyAiFunct_' . $id . ');';
                    //$html .= 'jQuery(document).ready(function() { ';
                    //$html .= 'aiReadyAiFunct_' . $id . '();';
                    //$html .= ' });';
                    
                    // Modify parent is called right away to do the modifications even when the dom is not ready yet.
                    // It is called again on dom ready 
                    $html .= 'if (window.jQuery) { aiModifyParent_' . $id . '(); }';
                    $html .= '</script>';
                }

                    
                    // jQuery("#advanced_iframe").contents().find("#iframe-div").css("border","4px solid blue");
                    $hideiframehtml = '';
    
                    if ((!empty($iframe_content_id) && !empty($iframe_content_styles))|| !empty($iframe_hide_elements) 
                       || (!empty($change_iframe_links) && !empty($change_iframe_links_target)) || !empty($iframe_content_css)
                       || !empty($additional_js_file_iframe) || !empty($additional_css_file_iframe)
                       ) {
                    if ($add_css_class_iframe) {
                       // get the url from the iframe - create a hash and add this as class to the body. 
                       // this enables us to distinguish between sites with the same structure but where 
                       // different thing e.g. should be hidden.
                       $hideiframehtml .= "var iframeHref".$id." = jQuery('#".$id."').contents().get(0).location.href; 
                       if (iframeHref".$id.".substr(-1) == '/') {
                           iframeHref".$id." = iframeHref".$id.".substr(0, iframeHref".$id.".length - 1);
                       }
                       var lastIndex".$id." = iframeHref".$id.".lastIndexOf('/');
                       var result".$id." = iframeHref".$id.".substring(lastIndex".$id." + 1);
                       var newClass".$id." = result".$id.".replace(/[^A-Za-z0-9]/g, '-');
                       var iframeBody".$id." = jQuery('#".$id."').contents().find('body');
                       iframeBody".$id.".addClass('ai-' + newClass".$id.");
                       iframeBody".$id.".children().each(function (i) {
                             jQuery(this).addClass('ai-' + newClass".$id." + '-child-' + (i+1)); 
                        });
                       "; 
                    }
                    
                    
                    if (!empty($iframe_hide_elements)) {
                        $hideiframehtml .= "jQuery('#".$id."').contents().find('" .
                            esc_html($iframe_hide_elements) . "').css('display', 'none').css('width', '0').css('height','0');";
                    }
                    if (!empty($iframe_content_id)) {
                        $elements = esc_html($iframe_content_id); // this field should not have a problem if they are encoded.
                        $values = esc_html($iframe_content_styles); // this field style should not have a problem if they are encoded.
                        $elementArray = explode("|", $elements);
                        $valuesArray = explode("|", $values);
                        if (count($elementArray) != count($valuesArray)) {
                            return $error_css . '<div class="errordiv">' . __('Configuration error: The attributes iframe_content_id and iframe_content_styles have to have the amount of value sets separated by |.', 'advanced-iframe') . '</div>';
                        } else {
                            for ($x = 0; $x < count($elementArray); ++$x) {
                                $valuesArrayPairs = explode(";", trim($valuesArray[$x], " ;:"));
                                for ($y = 0; $y < count($valuesArrayPairs); ++$y) {
                                    $elements = explode(":", $valuesArrayPairs[$y]);
                                    $hideiframehtml .= "jQuery('#".$id."').contents().find('" . trim($elementArray[$x])
                                      . "').css('" . trim(strtolower($elements[0])) . "', '" . trim(strtolower($elements[1])) . "');";
                                }
                            }
                        }
                    }

                    // change_iframe_links
                    if (!empty($change_iframe_links)) {
                        $links = esc_html($change_iframe_links); // this field should not have a problem if they are encoded.
                        $targets = esc_html($change_iframe_links_target); // this field style should not have a problem if they are encoded.
                        $linksArray = explode("|", $links);
                        $targetArray = explode("|", $targets);
                        if (count($linksArray) != count($targetArray)) {
                            return $error_css . '<div class="errordiv">' . __('Configuration error: The attributes change_iframe_links and change_iframe_links_target have to have the amount of value sets separated by |.', 'advanced-iframe') . '</div>';
                        } else {
                            for ($x = 0; $x < count($linksArray); ++$x) {
                                $hideiframehtml .= "jQuery('#".$id."').contents().find('" . trim($linksArray[$x])
                                      . "').attr('target', '".trim($targetArray[$x])."');";
                            }
                        }
                    }
                    if (!empty($iframe_content_css)) {
                        $hideiframehtml .= 'aiAddCss("#'.$id.'","'.urlencode($iframe_content_css).'");';
                    }
                    if (!empty($additional_css_file_iframe)) {
                        $hideiframehtml .= 'aiAddCssFile("#'.$id.'","'.$additional_css_file_iframe.'");';
                    }
                    if (!empty($additional_js_file_iframe)) {
                        $hideiframehtml .= 'aiAddJsFile("#'.$id.'","'.$additional_js_file_iframe.'");';
                    }
                    
                    if ($hideiframehtml != '') {
                    $html .= '<script type="text/javascript">';
                    $html .= 'function aiModifyIframe_' . $id . '() { ';
                    $html .= 'try {';
                    $html .=  $hideiframehtml;
                    $html .=  '}  catch(e) {';
                    $html .=  '  if (console) {';
                    $html .=  '    if (console.log) {';
                    $html .=  '      console.log("Advanced iframe configuration error: You have enabled the modification of the iframe for pages on the same domain. But you use an iframe page on a different domain. You need to use the pro version of external workaround like described in the settings. Also check the next log. There the browser message for this error is displayed."); ';
                    $html .=  '      console.log(e);';
					$html .=  '    }';
                    $html .=  '  }';
                    $html .=  '}';
                    $html .= '}';
                    $html .= '</script>';
                    }
                }
                
               
                if (!empty($hide_content_until_iframe_color)) {
                    $html .= '<div id="ai-div-hide-content-'.$id.'"><!-- hides the content --></div>';
                }
                
                if ($show_iframe_loader == 'true') {
                   // div around 
                   $html .= '<div id="ai-div-container-'.$id.'">';
                   // div for the loader 
                   $html .= '<div id="ai-div-loader-'.$id.'"><img src="' . site_url() . $aiPath . '/img/loader.gif" width="66" height="66" title="Loading" alt="Loading"></div>';
                 }
                
                 if (!empty($hide_part_of_iframe)) {
                      $rectangles = explode('|' , $hide_part_of_iframe);
                      for($hi=0;$hi<count($rectangles);++$hi){
                         $values = explode(',' , $rectangles[$hi]);
                         $html .= '<div class="wrapper-div-'.$id.'" style="position:relative">';
                         $num_values = count($values);
                         if ($num_values == 6 || $num_values == 7 || $num_values == 8) {
                            // add px or %
                            $r_width = $this->addPx($values[2]);
                            $r_height = $this->addPx($values[3]);
                            $display_type = 'div';
                            $hide_href = '';
                            if ($num_values == 7 || $num_values == 8 ) {
                               $display_type = 'a';
                               $hide_href = ' href="'.esc_html(trim($values[6])).'"';
                            }
                            if ($num_values == 8) {
                               $hide_href .= ' target="'.esc_html(trim($values[7])).'"';
                            }
                            
                            $html .= '<'.$display_type.$hide_href.' style="position:absolute;z-index:'.esc_html(trim($values[5])).';left:'.esc_html(trim($values[0])).'px;top:'.esc_html(trim($values[1])).'px;width:'.$r_width.';height:'.$r_height.';background-color:'.esc_html(trim($values[4])).'"><!-- --></'.$display_type.'>';
                         } else {
                            return $error_css . '<div class="errordiv">' . __('ERROR: hide part of iframe does not have the required 6 parameters', 'advanced-iframe') . '</div>';
                         }
                     }
                  }

                if ($show_part_of_iframe == 'true') {
                    $html .= '<div id="ai-div-'.$id.'">';
                }
                if (!empty($iframe_zoom)) {
                     $html .= '<div id="ai-zoom-div-'.$id.'">';
                }
                if ($enable_lazy_load == 'true') {
                     $html .= '<div id="ai-lazy-load-'.$id.'" class="ai-lazy-load-'.$id.'"><!--';
                }
                
                // show a warning if https pages are shown in http pages.
                
                $parent_http = site_url();
                if ($this->ai_startsWith(strtolower($src), "http:") && 
                    $this->ai_startsWith(strtolower($parent_http), "https:")) {
                  $html .= 'Http iframes are not shown in https pages in many major browsers. Please read <a href="http://www.tinywebgallery.com/blog/iframe-do-not-mix-http-and-https" target="_blank">this post</a> for details.';
                } 
                
                // calculates dynamic width and height for + and -   
                if ($pro) {
                  if (strpos($width, '-') !== false || strpos($width, '+') !== false ) {       
                     // + and - needs a space before and after the + and -. Otherwise is does not work in Firefox
                     $width = str_replace("-", " - ", $width);
                     $width = str_replace("+", " + ", $width);
                     $style .= ';width: calc('.esc_html(trim($width)).');';
                     $width = '';   
                  }
                  if (strpos($height, '-') !== false || strpos($height, '+') !== false ) {       
                     $height = str_replace("-", " - ", $height);
                     $height = str_replace("+", " + ", $height);
                     $style .= ';height: calc('.esc_html(trim($height)).');'; 
                     $height = '';   
                  } 
                } 
                
  
                $html .= "<iframe id='" . $id . "' ";
                if (!empty ($name)) {
                    $html .= " name='" . $name . "' ";
                }
                $html .= " src='" . trim($src) . "' ";
                if ($width != 'not set' && $width != '') {
                     $html .= " width='" . esc_html(trim($width)) . "' ";
                }
                 if ($height != 'not set' && $height != '') {
                     $html .= " height='" . esc_html(trim($height)) . "' ";
                }

                // default is auto - enables to add scrolling with css!
                if ($scrolling != 'none') {
                     $html .= " scrolling='" . esc_html(trim($scrolling)) . "' ";
                }

                if (!empty ($marginwidth)) {
                    $html .= " marginwidth='" . esc_html(trim($marginwidth)) . "' ";
                }
                if (!empty ($marginheight)) {
                    $html .= " marginheight='" . esc_html(trim($marginheight)) . "' ";
                }
                if ($frameborder != '') {
                    $html .= " frameborder='" . esc_html(trim($frameborder)) . "' ";
                    if ($frameborder == 0) {
                       $html .= " border='0' ";
                    }
                }
                if (!empty ($transparency)) {
                    $html .= " allowtransparency='" . esc_html(trim($transparency)) . "' ";
                }
                if (!empty ($class)) {
                    $html .= " class='" . esc_html(trim($class)) . "' ";
                }
                
                if (!empty ($style) || $show_part_of_iframe == 'true' || $enable_responsive_iframe == 'true') {
                    if (strpos($style, 'max-width') === false) {
                      if ($show_part_of_iframe == 'true') {
                          $style .= 'max-width:none;';
                      } else if ($enable_responsive_iframe == 'true') {
                          $style .= 'max-width:100%;';
                      }
                    }
                    $html .= " style='" . esc_html(trim($style)) . "' ";
                }
                
                if ($allowfullscreen != 'false') {
                     $html .= " allowfullscreen ";
                }
                
                
                // create onload string
                $onload_str = '';
                 if (!empty ($onload)) {
                    $onload_str .= esc_html($onload);
                }
                
               
                if (!empty ($tab_hidden)) {
                  $split_hidden_array = explode(',', $tab_hidden);   
                  $hidden_counter = 0;
                  foreach ($split_hidden_array as $split_hidden) {  
                     if ($hidden_counter++ == 0) {
                          // measure the width of the sorounding element
                         if (!empty ($tab_visible)) {
                             $onload_str .= ';jQuery("'. $split_hidden .'").css("width",jQuery("'. $tab_visible .'").width());';
                         }
                         $onload_str .= ';jQuery("'. $split_hidden .'").css("position", "absolute").css("top", "-20000px").css("visibility", "hidden").show();';
                     } else {
                         $onload_str .= ';jQuery("'. $split_hidden .'").show();';
                     }
                  }
                }
               
               
                if ($show_iframe_loader == 'true') {
                    $onload_str .= ';jQuery("#ai-div-loader-'.$id.'").hide();';
                }
                
                if (!empty($hide_content_until_iframe_color)) {
                    $onload_str .= ';jQuery("#ai-div-hide-content-'.$id.'").hide();'; 
                }
                
                if ($show_part_of_iframe == 'true' && (!empty ($show_part_of_iframe_new_window) ||
                    !empty ($show_part_of_iframe_new_url) || !empty ($show_part_of_iframe_next_viewports) ||
                    ($show_part_of_iframe_next_viewports_hide == 'true') )) {
                   $onload_str .= ';modifyOnLoad'.$id.'();';
                }
                if ($auto_zoom == 'same') {
                   if (!empty($onload_resize_delay)) {
                        $onload_str .= ';setTimeout(function() { zoomOnLoad'.$id.'(); },'.$onload_resize_delay.');';
                    } else {
                        $onload_str .= ';zoomOnLoad'.$id.'();';
                    } 
                }
                
                if ($hideiframehtml != '') {
                    $onload_str .= ';aiModifyIframe_' . $id . '();';
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
                
                if (!empty($iframe_height_ratio)) {
                    $onload_str .= ';aiResizeIframeRatio(this, "'.$iframe_height_ratio.'");';
                }
                
                if ($onload_scroll_top == 'true') {
                    $onload_str .= ';aiScrollToTop();';
                }
                // hide_page_until_loaded
                if ($hide_page_until_loaded  == 'true') {
                    $onload_str .= 'jQuery("#'.$id.'").css("visibility", "visible");';
                    if (!empty($hide_part_of_iframe)) {
                        $onload_str .= 'jQuery(".wrapper-div-'.$id.'").css("visibility", "visible");';
                    } 
                }   
                 
                if (!empty($resize_on_element_resize)) {
                    $onload_str .= 'onloadFired'.$id.' = true;';
                }
                
                if ($add_iframe_url_as_param == 'same') {
                    $onload_str .= 'aiChangeUrlParam(aigetIframeLocation("'.$id.'"), "'.$map_parameter_to_url.'","'.$src_orig.'","'.$add_iframe_url_as_param_prefix.'");';
                }
  
                if ($onload_str != '') {
                   $html .= " onload='" . esc_js($onload_str) . "' ";
                }

                $html .= '></iframe>';
                if ($enable_lazy_load == 'true') {
                    $html .= '--></div>';
                } 
                if (!empty($iframe_zoom)) {
                    $html .= '</div>';
                }
                if ($show_part_of_iframe == 'true') {
                    $html .= '</div>';
                }
                if (!empty($hide_part_of_iframe)) {
                    $html .= '</div>';
                }
                if ($show_iframe_loader == 'true') {
                   $html .= '</div>';
                }
                $html .= '<script type="text/javascript">var ifrm_'.$id.' = document.getElementById("'.$id.'");</script>';

                $html .= '<script type="text/javascript">
                var hiddenTabsDone'.$id.' = false;
                function resizeCallback'.$id.'() {';
                if (!empty ($tab_hidden)) {
                  $split_hidden_array = explode(',', $tab_hidden);   
                  $hidden_counter = 0;
                  $html .= 'if (!hiddenTabsDone'.$id.') { '; 
                  foreach ($split_hidden_array as $split_hidden) { 
                      if ($hidden_counter++ == 0) {
                          $html .= 'jQuery("' . $split_hidden . '").css("position", "static").hide().css("visibility", "visible");';
                          // for one level resize works mu
                          $html .= 'hiddenTabsDone'.$id.' = false;';
                      } else {
                          $html .= ';jQuery("'. $split_hidden .'").hide();';
                          $html .= 'hiddenTabsDone'.$id.' = true;';
                      }
                  }
                  $html .= '}';
                }
                $html .= '}';
                
                 $html .= 'function aiChangeUrl(loc) {';
                    if ($add_iframe_url_as_param == 'remote') {
                        $html .= '  aiChangeUrlParam(loc,"'.$map_parameter_to_url.'","'.$src_orig.'","'.$add_iframe_url_as_param_prefix.'");';
                    }
                 $html .= '}';
                
                $html .= '</script>';
                                  
               
                if ($store_height_in_cookie == 'true') {
                   $html .= '<script type="text/javascript">if (window.aiUseCookie) { aiUseCookie(); }</script>';
                }
                if ($show_part_of_iframe == 'true' && (!empty ($show_part_of_iframe_new_window) ||
                    !empty ($show_part_of_iframe_new_url) || !empty ($show_part_of_iframe_next_viewports) ||
                    ($show_part_of_iframe_next_viewports_hide == 'true'))) {
                   $html .= '<script type="text/javascript">
                      var countAlert'.$id.' = 0;
                      var maxStep'.$id.' = getViewPortCount'.$id.'();
                      function modifyOnLoad'.$id.'() {
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
                     $html .= '} else if (countAlert'.$id.' > 0)  { // viewport change!
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
                 
                 if ($auto_zoom == 'same' ) {
                       $html .= '<script type="text/javascript">
                           function zoomOnLoad'.$id.'() {
                                   aiAutoZoom("'.$id.'","' . $enable_responsive_iframe . '","'.$auto_zoom_by_ratio.'");
                           }
                           </script>';     
                 }
                 
                 if ($enable_responsive_iframe == 'true') {
                     $html .= '<script type="text/javascript">
                        function initResponsiveIframe'.$id.'() {  
                          jQuery(window).resize(function() {'; 
                     if ($enable_lazy_load == 'true') {
                         $html .= 'ifrm_'.$id.' = document.getElementById("'.$id.'");';
                     }
                      if (!empty($iframe_height_ratio)) {           
                          $html .= '  aiResizeIframeRatio(ifrm_'.$id.', "'.$iframe_height_ratio.'");';
                      } else  if ($auto_zoom == 'same') {
                         $html .= 'aiAutoZoom("'.$id.'","' . $enable_responsive_iframe . '","'.$auto_zoom_by_ratio.'");';
                      } else  if ($auto_zoom == 'remote') {
                         $html .= 'aiAutoZoomExternalHeight("'.$id.'",ai_iframe_width_'.$id.',ai_iframe_height_'.$id.',"' . $enable_responsive_iframe . '" );';
                      } else if ($onload_resize) {            
                          $html .= '  aiResizeIframe(ifrm_'.$id.', "'.$onload_resize_width.'");';
                      }   
                    $html .= '
                        });
                        }
                        aiReadyCallbacks.push(initResponsiveIframe' . $id . ');
                        </script>';
                }  
                
                if ($reload_interval != '') {
                  $html .= '<script type="text/javascript">';
                  $html .= 'setInterval(
                    function() {  
                      jQuery( "#'.$id.'" ).attr( "src", function ( i, val ) { return val; })
                    }, '.$reload_interval.');';
                  $html .= '</script>';
                }
                     
            } else {
                  if (empty($include_html)) {
                    $ai_height = (empty ($include_height)) ? '' : (' style="height:'.$include_height.';" ');
  
                    $html = '<div '.$ai_height.' id="ai-temp-'.$id.'"><!-- --></div>';
                    $html .= '<script type="text/javascript">';
                    if  ($include_hide_page_until_loaded === 'true') {
                      $html .= 'jQuery("body").css("display", "none");';
                    }
                    $html .= 'jQuery("#ai-temp-'.$id.'").load("' . $include_url;
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
                  } else {
                    echo $include_html;
                  }  
            }
            
            $newer_version = !isset($aip_standalone) && version_compare(get_bloginfo('version'), '3.3') >= 0 ; 
      
            if ($enable_lazy_load == 'true') {
              if ($newer_version) {
                  $dep = ($options['load_jquery'] === 'true') ? array( 'jquery') : array();
                  wp_enqueue_script('ai-lazy-js',plugins_url( 'includes/scripts/jquery.lazyload-any.min.js' , __FILE__ ), $dep , $version_counter, true);
              } else {
                  $html .= '<script type="text/javascript" src="' . site_url() . $aiPath . '/includes/scripts/jquery.lazyload-any.min.js" ></script>';
              }
            }

            if (!empty($resize_on_element_resize)) {
              if ($newer_version) {
                  $dep_resize = ($options['load_jquery'] === 'true') ? array( 'jquery', 'ai-js') : array('ai-js');
                  wp_enqueue_script('ai-change-js',plugins_url( 'includes/scripts/jquery.ba-resize.min.js' , __FILE__ ), $dep_resize, $version_counter, true);
              } else {
                  $html .= '<script type="text/javascript" src="' . site_url() . $aiPath .'/includes/scripts/jquery.ba-resize.min.js" ></script>';
              }
              $html .= '<script type="text/javascript">';
              $html .= 'function initResizeIframe'.$id.'() {
                        if (onloadFired'.$id.' === false) {
                          // onload is not fired yet. we wait 100 ms and retry
                          window.setTimeout("initResizeIframe'.$id.'()",100);
                          return;
                        }
                        onloadFired'.$id.' = true; 
              ';
              
              // minimum delay is 50 ms !
              if (!empty($resize_on_element_resize_delay) &&
                 ((int)$resize_on_element_resize_delay) >= 50 ) {
                  $html .= 'jQuery.resize.delay='.esc_html($resize_on_element_resize_delay).';';
              }
              $html .= 'jQuery("#'.$id.'").contents().find("'.esc_html($resize_on_element_resize).'").resize(function(){ 
                               aiResizeIframe(ifrm_'.$id.', "'.$onload_resize_width.'");
                           });
                        }';
              $html .= 'aiReadyCallbacks.push(initResizeIframe' . $id . ');';
              $html .= '</script>';
            }
            
            
            if ($additional_css != '' && $newer_version) {  // wp >= 3.3
               wp_enqueue_style( 'additional-advanced-iframe-css', $additional_css, false, $version_counter);   
            }
            
            if ($additional_js != '' && $newer_version) {  // wp >= 3.3 
                wp_enqueue_script( 'additional-advanced-iframe-js', $additional_js, false, $version_counter, true);
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
             if (!$this->scriptsNeeded) {
               wp_dequeue_script('ai-js');
               wp_dequeue_script('additional-advanced-iframe-js');
               wp_dequeue_script('ai-change-js');
               wp_dequeue_script('ai-lazy-js');
             } else {   
               echo '<script type="text/javascript">if(window.aiModifyParent) {aiModifyParent();}</script>';
             }
        }

        function printAdminPage() {
            require_once('advanced-iframe-admin-page.php');
        }
        
        function ai_startsWith($haystack, $needle) {
		  return $needle === "" || strrpos($haystack, $needle, -strlen($haystack)) !== FALSE;
		}
			   
		function ai_endsWith($haystack, $needle) {
		  return $needle === "" || (($temp = strlen($haystack) - strlen($needle)) >= 0 && strpos($haystack, $needle, $temp) !== FALSE);
		}
    
    function checkIE8() {
       $filenamedir  = dirname(__FILE__) . '/../advanced-iframe-custom/browser-check-failed.txt'; 
       if (file_exists($filenamedir)) {
           return false;
       } else {
          $filenamedir  = dirname(__FILE__) . '/../advanced-iframe-custom';
          if (!@file_exists($filenamedir)) {
             if (!@mkdir($filenamedir)) {
                echo 'The directory "advanced-iframe-custom" could not be created in the plugin folder. Custom files are stored in this directory because Wordpress does delete the normal plugin folder during an update. Please create the folder manually.'; 
                return false; 
             }
          } 
          $fh = @fopen($filenamedir, 'w');
          if ($fh) {
              @fwrite($fh, "Browser detection crashed. Please increase your php memory, delete this file and retry.");
              @fclose($fh);
          }
          @unlink($filenamedir);
          return ai_is_ie(8);
       }    
    }
    
     
        
        function maybe_dequeue_script () {  
        }
        
        function ai_plugin_action_links($links, $file) {
            $plugin_file = basename(__FILE__);
            $file = basename($file);
            if ($file == $plugin_file) {
                $settings_link = '<a href="options-general.php?page='.$plugin_file.'">'.__('Settings', 'advanced-iframe').'</a>';
                array_unshift($links, $settings_link);
            }
            return $links;
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
                }';
                $val .= '  ifrm_'.$iframe_id.'.contentWindow.XMLHttpRequest.prototype.send = sendReplacement_'.$iframe_id.';';
                $val .= '</script>';
                }
            }
            return $val;
          }
          
          function ai_replace_placeholders($str_input, $enable_replace) {
            global $aip_standalone;
            if ($enable_replace) {
                $str_input = str_replace('{host}', $_SERVER['HTTP_HOST'], $str_input);
                $str_input = str_replace('{port}', $_SERVER['SERVER_PORT'], $str_input);
                
                if (!isset($aip_standalone)) {
                  $str_input = str_replace('{site}', site_url(), $str_input);
                  
                  global $current_user;
                  get_currentuserinfo();
                  
                  $str_input = str_replace('{userid}', urlencode($current_user->ID), $str_input);
                  if ( 0 == $current_user->ID ) {
                    $str_input = str_replace('{username}', '', $str_input);
                    $str_input = str_replace('{useremail}', '', $str_input);
                  } else {
                    $str_input = str_replace('{username}', urlencode($current_user->user_login), $str_input);
                    $str_input = str_replace('{useremail}', urlencode($current_user->user_email), $str_input); 
                  
                    // dynamic $propertyName = 'id'; print($phpObject->{$propertyName});
                    if (strpos($str_input,'{userinfo') !== false) {
                       
                       $regex = '/{(userinfo.*?)}/';
                       $result = preg_match_all( $regex, $str_input, $match);  
                       if ($result) {
                         foreach ($match[1] as $hits) {
                           $key = substr($hits, 9);
                           $str_input = str_replace('{'.$hits.'}', urlencode($current_user->$key), $str_input); 
                         } 
                       }   
                    }
                    if (strpos($str_input,'{usermeta') !== false) {
                       $regex = '/{(usermeta.*?)}/';
                       $result = preg_match_all( $regex, $str_input, $match);  
                       if ($result) {
                         foreach ($match[1] as $hits) {
                           $key = substr($hits, 9);
                           $user_last = get_user_meta( $current_user->ID, $key, true );  
                           $str_input = str_replace('{'.$hits.'}', urlencode($current_user->$key), $str_input); 
                         } 
                       }   
                    }
                  }
                   
                  $admin_email = get_option( 'admin_email' );
                  $str_input = str_replace('{adminemail}', urlencode($admin_email), $str_input); 
                  
                  // part of the url are extracted {urlpath1} = first path element
                  $uri = $_SERVER['REQUEST_URI'];
                  $path_elements = explode("/", trim($uri, "/")); 
                  $count = 1;
                  foreach($path_elements as $path_element){ 
                      $str_input = str_replace('{urlpath'.$count.'}', urlencode($path_element), $str_input); 
                      $count++;   
                  }
                  // part of the url counting from the end {urlpath-1} = last path element 
                  reset($path_elements);
                  $rpath_elements = array_reverse($path_elements);
                  $count = 1;
                  foreach($rpath_elements as $path_element){ 
                      $str_input = str_replace('{urlpath-'.$count.'}', urlencode($path_element), $str_input); 
                      $count++;   
                  }
        
          				if (strpos($str_input,'{query') !== false) {
          				   $regex = '/{(query.*?)}/';
          				   $result = preg_match_all( $regex, $str_input, $match);  
          				   if ($result) {
          					 foreach ($match[1] as $hits) {
          					   $key = substr($hits, 6);
          					   $value = $this->param($key);
          					   $str_input = str_replace('{'.$hits.'}', $value , $str_input); 
          					 } 
          				   }   
          				}
         
                  // evaluate shortcodes for the parameter 
                  $str_input = str_replace('{{', "[", $str_input);
                  $str_input = str_replace('}}', "]", $str_input);
                  $str_input = do_shortcode($str_input);
                }
            }
            return $str_input;
        }
          
    }
}

if (!isset($aip_standalone)) {
  //  setup new instance of plugin if not standalone
  if (class_exists("advancediFrame")) {
      $cons_advancediFrame = new advancediFrame();
  }
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
            $aiOptions = $cons_advancediFrame->getAiAdminOptions();
            
            $pro = (file_exists(dirname(__FILE__) . "/includes/class-cw-envato-api.php")) ? " Pro" : "";
                
            if (function_exists('add_options_page')) {
                add_options_page('Advanced iFrame' . $pro, 'Advanced iFrame'. $pro, 'manage_options',
                    basename(__FILE__), array($cons_advancediFrame, 'printAdminPage'));
            }  
            if  ($aiOptions['show_menu_link'] == "true") {
                add_menu_page('Advanced iFrame' . $pro, 'Advanced iFrame'. $pro, 'manage_options',  
                    basename(__FILE__), array($cons_advancediFrame, 'printAdminPage'));
            }
            if (!empty($aiOptions['alternative_shortcode'])) {    
                // setup shortcode alternative style  
                add_shortcode($aiOptions['alternative_shortcode'], array($cons_advancediFrame, 'do_iframe_script'), 1); 
            }  
           
            add_action('admin_print_footer_scripts', array($cons_advancediFrame, 'addAiButtonJs'), 199);
            add_action('media_buttons', array($cons_advancediFrame, 'addAiButton'), 11);
           
        }
    }
    add_action('admin_menu', 'advancediFrame_ap', 1); //admin page
    add_action('init', array($cons_advancediFrame, 'loadLanguage'), 1); // add languages
    add_action('admin_enqueue_scripts', array($cons_advancediFrame, 'addAdminHeaderCode'), 99); // load css
    add_action('wp_enqueue_scripts',  array($cons_advancediFrame, 'addWpHeaderCode'), 98); // load js
    add_action('wp_footer',  array($cons_advancediFrame, 'add_script_footer'), 2);
    add_shortcode('advanced_iframe', array($cons_advancediFrame, 'do_iframe_script'), 1); // setup shortcode
    add_shortcode('advanced-iframe', array($cons_advancediFrame, 'do_iframe_script'), 1); // setup shortcode alternative style   
    register_activation_hook(__FILE__, array($cons_advancediFrame, 'activate'));
    
    add_filter( 'widget_text', 'shortcode_unautop');
    add_filter( 'widget_text', 'do_shortcode');     
    add_filter('plugin_action_links', array($cons_advancediFrame, 'ai_plugin_action_links'),10,2);       
}


// remove update functionality
function ai_remove_update($value) {
    if(isset( $value ) && is_object( $value ) && isset($value->response[ plugin_basename(__FILE__) ])) {
       unset($value->response[ plugin_basename(__FILE__) ]);
    }
    return $value;
}

// setup for widget
function advanced_iframe_widget_init(){
	  register_widget('AdvancedIframe_Widget');
}

if (!isset($aip_standalone) && file_exists(dirname(__FILE__) . "/includes/advanced-iframe-widget.php")) {
    require_once('includes/advanced-iframe-widget.php');
    add_action('widgets_init','advanced_iframe_widget_init');
    add_filter('site_transient_update_plugins', 'ai_remove_update');
}

// ==============================================
//	Add Links in Plugins Table
// ==============================================
function advanced_iframe_plugin_meta_free( $links, $file ) {
	if ( strpos( $file, '/advanced-iframe.php' ) !== false ) {
		$iconstyle = 'style="-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale;"';
    $reviewlink = 'https://wordpress.org/support/view/plugin-reviews/advanced-iframe?rate=5#postform';
    $links = array_merge( $links, array( '<a href="http://codecanyon.net/item/advanced-iframe-pro/5344999?ref=mdempfle">Advanced iFrame Pro</a>',
     '<a href="'.$reviewlink.'"><span class="dashicons dashicons-star-filled"' . $iconstyle . 'title="Give a 5 Star Review"></span></a>'
     ) );
  }
  return $links;
}
  add_filter( 'plugin_row_meta', 'advanced_iframe_plugin_meta_free', 10, 2 );
?>