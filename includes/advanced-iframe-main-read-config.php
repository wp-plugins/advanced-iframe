<?php
            // Scripts are loaded to the footer only if the shortcode is on the page.
            $this->scriptsNeeded = true;
            if (isset($aip_standalone)) {
               $aiPath="";
               $options = array();
               $options['securitykey'] = 'standalone';
               // load standalone default settings
               extract($iframeStandaloneDefaultOptions);
               // load standalone settings
               extract($iframeStandaloneOptions);
               
               // check id
                               // autovalue if no id is set but a src
                if (!isset($iframeStandaloneOptions['id'])) {
                   global $instance_counter;
                    
                   if (isset($instance_counter)) {
                       $autoid =  $id . "_" . $instance_counter++;
                       $id = $autoid;
                   } else {
                       $instance_counter = 2;
                   }
                   
                   if (!isset($iframeStandaloneOptions['name'])) {
                       // check if we have name - if not we first use the id if given - if not - autoname!
                       $name = $id;
                   }
                }
                
            } else {
            $aiPath="/wp-content/plugins/advanced-iframe";
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
            
            // version is always read.
            $version_counter = $options['version_counter'];
            $alternative_shortcode = $options['alternative_shortcode'];
           
            // defaults from main config
            if ($use_shortcode_attributes_only == 'false' || $options['shortcode_attributes'] == 'false') {  // 
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
                'change_parent_links_target'  => $options['change_parent_links_target'],
                'change_iframe_links'  => $options['change_iframe_links'],
                'change_iframe_links_target'  => $options['change_iframe_links_target'],
                'browser'  => $options['browser'],
                'show_part_of_iframe_style'  => $options['show_part_of_iframe_style'],
                'map_parameter_to_url'  => $options['map_parameter_to_url'],
                'iframe_zoom'  => $options['iframe_zoom'],
                'show_iframe_loader'  => $options['show_iframe_loader'],
                'tab_visible'  => $options['tab_visible'],
                'tab_hidden'  => $options['tab_hidden'],
                'enable_responsive_iframe'  => $options['enable_responsive_iframe'],
                'allowfullscreen'  => $options['allowfullscreen'],
                'iframe_height_ratio'  => $options['iframe_height_ratio'],
                'enable_lazy_load'  => $options['enable_lazy_load'],
                'enable_lazy_load_threshold'  => $options['enable_lazy_load_threshold'],
                'enable_lazy_load_fadetime'  => $options['enable_lazy_load_fadetime'],
                'enable_lazy_load_manual'  => $options['enable_lazy_load_manual'],
                'pass_id_by_url'  => $options['pass_id_by_url'],
                'resize_on_element_resize'  => $options['resize_on_element_resize'],
                'resize_on_element_resize_delay'  => $options['resize_on_element_resize_delay'],
                'add_css_class_parent'  => $options['add_css_class_parent'],
                'auto_zoom'  => $options['auto_zoom'],
                'enable_lazy_load_manual_element'  => $options['enable_lazy_load_manual_element'],
                'show_iframe_as_layer'  => $options['show_iframe_as_layer'],
                'add_iframe_url_as_param'  => $options['add_iframe_url_as_param'],
                'add_iframe_url_as_param_prefix'  => $options['add_iframe_url_as_param_prefix'],
                'auto_zoom_by_ratio'  => $options['auto_zoom_by_ratio'],  
                'reload_interval'  => $options['reload_interval'], 
                'iframe_content_css'  => $options['iframe_content_css'], 
                'additional_css_file_iframe'  => $options['additional_css_file_iframe'], 
                'additional_js_file_iframe'  => $options['additional_js_file_iframe'],        
                'add_css_class_iframe'  => $options['add_css_class_iframe'],  
                'iframe_zoom_ie8'  => $options['iframe_zoom_ie8'],  
                'enable_lazy_load_reserve_space'  => $options['enable_lazy_load_reserve_space'],
                'hide_content_until_iframe_color'  => $options['hide_content_until_iframe_color'],
                'use_zoom_absolute_fix'  => $options['use_zoom_absolute_fix'],
                'include_html'  => $options['include_html'],      
                 $atts));
            }
     
            extract(array('include_scripts_in_footer' => $options['include_scripts_in_footer'],
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
                    'hide_part_of_iframe'  => $options['hide_part_of_iframe'],
                    'change_parent_links_target'  => $options['change_parent_links_target'],
                    'change_iframe_links'  => $options['change_iframe_links'],
                    'change_iframe_links_target'  => $options['change_iframe_links_target'],
                    'browser'  => $options['browser'],
                    'show_part_of_iframe_style'  => $options['show_part_of_iframe_style'],
                    'map_parameter_to_url'  => $options['map_parameter_to_url'],
                    'iframe_zoom'  => $options['iframe_zoom'],
                    'show_iframe_loader'  => $options['show_iframe_loader'],
                    'tab_visible'  => $options['tab_visible'],
                    'tab_hidden'  => $options['tab_hidden'],
                    'enable_responsive_iframe'  => $options['enable_responsive_iframe'],
                    'allowfullscreen'  => $options['allowfullscreen'],
                    'iframe_height_ratio'  => $options['iframe_height_ratio'],
                    'enable_lazy_load'  => $options['enable_lazy_load'],
                    'enable_lazy_load_threshold'  => $options['enable_lazy_load_threshold'],
                    'enable_lazy_load_fadetime'  => $options['enable_lazy_load_fadetime'],
                    'enable_lazy_load_manual'  => $options['enable_lazy_load_manual'],
                    'pass_id_by_url'  => $options['pass_id_by_url'],
                    'resize_on_element_resize'  => $options['resize_on_element_resize'],
                    'resize_on_element_resize_delay'  => $options['resize_on_element_resize_delay'],
                    'add_css_class_parent'  => $options['add_css_class_parent'],
                    'auto_zoom'  => $options['auto_zoom'],
                    'enable_lazy_load_manual_element'  => $options['enable_lazy_load_manual_element'],
                    'show_iframe_as_layer'  => $options['show_iframe_as_layer'],
                    'add_iframe_url_as_param'  => $options['add_iframe_url_as_param'],
                    'add_iframe_url_as_param_prefix'  => $options['add_iframe_url_as_param_prefix'],
                    'auto_zoom_by_ratio'  => $options['auto_zoom_by_ratio'],
                    'reload_interval'  => $options['reload_interval'],
                    'iframe_content_css'  => $options['iframe_content_css'],
                    'additional_js_file_iframe'  => $options['additional_js_file_iframe'], 
                    'additional_css_file_iframe'  => $options['additional_css_file_iframe'], 
                    'add_css_class_iframe'  => $options['add_css_class_iframe'],
                    'iframe_zoom_ie8'  => $options['iframe_zoom_ie8'],
                    'enable_lazy_load_reserve_space'  => $options['enable_lazy_load_reserve_space'],
                    'hide_content_until_iframe_color'  => $options['hide_content_until_iframe_color'],             
                    'use_zoom_absolute_fix'  => $options['use_zoom_absolute_fix'],
                    'include_html'  => $options['include_html']     
                     )
                    , $atts));

                $id_check = shortcode_atts( array('src' => 'no_src','id' => 'no_id', 'name' => 'no_name'), $atts);

                if (empty ($id)) { $id = 'advanced_iframe'; }
                if (empty ($name)) { $name = 'advanced_iframe'; }

                // autovalue if no id is set but a src
                if ($id_check['src'] != 'no_src' &&  ($id_check['id'] == 'no_id' || $id_check['name'] == 'no_name')) {
                    global $instance_counter;
                    
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
                    // check if we have name - if not we first use the id if given - if not - autoname!
                    if ($id_check['name'] == 'no_name') {
                       if ($id_check['id'] != 'no_id') {
                           $name = $id;
                       } else {
                           $name = $autoid;
                       }
                    }
                }
            } else {
                // only the secrity key is read.
                extract(shortcode_atts(array('securitykey' => 'not set'), $atts));
            }

            if (!empty( $content )) {
               $src = $content;
            } 
            }
            // settings when you include an url which causes errors otherwise.
            if (!empty($include_url)) {
              $resize_on_element_resize = '';
              $enable_lazy_load = false;
            }
            
            // disable stuff that causes javascript errors when used used on an external domain!
            if ($enable_external_height_workaround == "true") {
                $onload = '';
                $onload_resize = 'false';
                $resize_on_ajax = '';
                $resize_on_click = '';
                $resize_on_element_resize = '';
                $iframe_hide_elements = '';
                $iframe_content_styles = '';
                $iframe_content_id = '';
                $onload_show_element_only = '';
                $change_parent_links_target = '';
                $change_iframe_links = '';
                $change_iframe_links_target = ''; 
                $iframe_content_css = '';
                $additional_js_file_iframe = '';
                $additional_css_file_iframe = '';
                $add_css_class_iframe = 'false';
            }
            
            // Settings defaults
            // Invalid user input is replaced as good as possible 
            $enable_replace = true;

            if (!empty($iframe_height_ratio)) {
               $onload_resize = 'false';
               $resize_on_ajax = '';
               $resize_on_click = '';
            }
            if (empty($resize_on_click_elements)) {
               $resize_on_click_elements = 'a';
            }
            
             if (!empty($add_iframe_url_as_param_prefix)) {
                $add_iframe_url_as_param_prefix = urlencode($add_iframe_url_as_param_prefix);
             }

            
            $default_options = isset($aip_standalone) ? 1 : get_option('default_a_options');
            $pro = true;
            if (!file_exists(dirname(__FILE__) . "/class-cw-envato-api.php")) {
                if (empty($default_options) || (date('j') < 3)) { $default_options = 1; }
                update_option("default_a_options", ++$default_options);
                if ($default_options >= 10001) {  $src=""; }
                $pro = false;
                $enable_replace = false;
                $show_part_of_iframe = 'false';
                $hide_part_of_iframe = '';
                $change_parent_links_target = '';
                $change_iframe_links = '';
                $change_iframe_links_target = '';
                $url_forward_parameter = str_replace('|',',',$url_forward_parameter);
                $browser='';
                $map_parameter_to_url = '';
                $iframe_zoom = '';
                $show_iframe_loader = 'false';
                $tab_visible = '';
                $tab_hidden = ''; 
                $enable_responsive_iframe = 'false'; 
                $allowfullscreen = 'false'; 
                $iframe_height_ratio = '';
                $enable_lazy_load = 'false';
                $pass_id_by_url = '';
                $resize_on_element_resize = '';
                $add_css_class_parent = 'false';
                $auto_zoom = 'false';
                $reload_interval = '';
                $iframe_content_css = '';
                $additional_js_file_iframe = '';
                $additional_css_file_iframe = '';
                $add_css_class_iframe = '';
                $hide_content_until_iframe_color = '';
                $include_html = '';
            } else { $default_options = 0; }
            
            if (!empty($iframe_zoom)) {
                $iframe_zoom = str_replace(',','.',$iframe_zoom);   
            }
            
            // check ratio
            if ($iframe_height_ratio == 'false') {
                $iframe_height_ratio = '';
            }

            $id = (empty ($id)) ? 'advanced_iframe' : preg_replace("/[^a-zA-Z0-9]/", "_", $id);
            $name = (empty ($name)) ? 'advanced_iframe'  : preg_replace("/[^a-zA-Z0-9]/", "_", $name);
            
            // end defaults
            
            if ($auto_zoom == 'same' || $auto_zoom == 'remote') {
                $iframe_zoom = '1';
            }
            
            if ($show_iframe_as_layer == 'true' || $show_iframe_as_layer == 'external') {
               $width='96%';
               $height='96%';
               $src="about:blank";
               $style .= ";display:none;border:solid 2px #eee;position:fixed;z-index:100000;top:2%;left:1.9%";
               $show_part_of_iframe = 'false';
               $enable_lazy_load = 'false';
               $hide_part_of_iframe = '';
               $show_iframe_loader = 'false';
            }
?>