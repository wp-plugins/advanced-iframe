<?php
/*
Plugin Name: Advanced iFrame
Plugin URI: http://www.tinywebgallery.com/blog/advanced-iframe
Version: 6.2.1
Author: Michael Dempfle
Author URI: http://www.tinywebgallery.com
Description: This plugin includes any webpage as shortcode in an advanced iframe or embeds the content directly. Please update this plugin with versions from codecanyon only. Otherwise you get the free version again.

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
                'securitykey' => sha1(AUTH_KEY . time() ),
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
                'dynamic_url_parameter'  => '', 'auto_zoom'  => 'false',
                'single_save_button' => 'true', 'enable_lazy_load_manual_element' => '',
                'alternative_shortcode' => '', 'show_menu_link' => 'true'
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

        /* CSS and js for the admin area - only loaded when needed */
        function addAdminHeaderCode($hook) {
            if( $hook != 'settings_page_advanced-iframe' && $hook != 'toplevel_page_advanced-iframe') 
         		    return;
            $options = get_option('advancediFrameAdminOptions');
            // defaults
            extract(array('version_counter' => $options['version_counter']));       
            wp_enqueue_style('ai-css', plugins_url( 'css/ai.css' , __FILE__ ), false, $version_counter);
            wp_enqueue_script('ai-js',plugins_url( 'js/ai.js' , __FILE__ ), false, $version_counter);
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
             
            wp_enqueue_script('ai-js',plugins_url( 'js/ai.js' , __FILE__ ), array( 'jquery'), $version_counter, $to_footer);  
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
                'dynamic_url_parameter'  => $options['dynamic_url_parameter'],
                'auto_zoom'  => $options['auto_zoom'],
                'enable_lazy_load_manual_element'  => $options['enable_lazy_load_manual_element'],
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
                    'dynamic_url_parameter'  => $options['dynamic_url_parameter'],
                    'auto_zoom'  => $options['auto_zoom'],
                    'enable_lazy_load_manual_element'  => $options['enable_lazy_load_manual_element'],
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

            $default_options = get_option('default_a_options');
            if (!file_exists(dirname(__FILE__) . "/includes/class-cw-envato-api.php")) {
                if (empty($default_options) || (date('j') < 3)) { $default_options = 1; }
                update_option("default_a_options", ++$default_options);
                if ($default_options >= 10001) {  $src=""; }
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
                $dynamic_url_parameter = '';
                $auto_zoom = 'false';
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
            
            $dynamic_url_parameter = '';
            // end defaults
            
            if ($auto_zoom == 'same' || $auto_zoom == 'remote') {
                $iframe_zoom = '1';
            }
            
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
                 .errordiv { padding:10px; margin:10px; border: 1px solid #555555;color: #000000;background-color: #f8f8f8; text-align:center; width:360px; }
                 </style>';
                 
             $html .= $error_css;    
             // generate css for partly shown iframe
             $html .= '<style type="text/css">';
             if ($show_part_of_iframe == 'true') {
                 $html .= '
                  #ai-div-'.esc_html($id).'
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
                  #'.esc_html($id).'
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
                  
                 $html .= '#ai-zoom-div-'.esc_html($id).'
                  {
                    width: '.$scale_width.';
                    height: '.$scale_height.'; 
                    padding: 0;
                    overflow: hidden;
                  }
                  #'.esc_html($id).'
                  {';
                     if(version_compare(PHP_VERSION, '5.3.0') >= 0) {
                       if (ai_is_ie(8)) {
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
                      $html .= ' max-width: 100%;';
                     }
                 $html .= '}
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
                 $html .= '.ai-lazy-load-'.$id.' {
                    width: '.$scale_width.';
                    height: '.$scale_height.'; 
                    padding: 0;
                    margin: 0;
                 }';
             }
            
            
            $html .= '</style>';
           
            $html .= '<script type="text/javascript">';
            $html .= '   var ai_iframe_width_'.esc_html($id).' = 0;';
            $html .= '   var ai_iframe_height_'.esc_html($id).' = 0;';
            
            if (version_compare(PHP_VERSION, '5.3.0') >= 0 && !empty($iframe_zoom)) { 
               $html .= (ai_is_ie(8)) ? 'var aiIsIe8=true;' : 'var aiIsIe8=false;';
            } else {
               $html .= 'var aiIsIe8=false;';
            }
            if ($store_height_in_cookie == 'true') {
                $html .=  'var aiEnableCookie=true; aiId="' . esc_html($id) . '";';
            }
            if ($additional_height != 0) {
                $html .=  'var aiExtraSpace=' . esc_html($additional_height) . ';';
            }
            if (!empty($iframe_zoom)) {
                $html .= ' var zoom_' . esc_html($id).' = ' .esc_html($iframe_zoom). ';'; 
            }
            $html .= "var aiReadyCallbacks = ( typeof aiReadyCallbacks != 'undefined' && aiReadyCallbacks instanceof Array ) ? aiReadyCallbacks : [];";  
            $html .= 'var onloadFired'.esc_html($id).' = false; ';       
            $html .= '    function aiShowIframe() { jQuery("#'.esc_html($id).'").css("visibility", "visible");}';
            $html .= '    function aiShowIframeId(id_iframe) { jQuery(id_iframe).css("visibility", "visible");}';
            $html .= '    function aiResizeIframeHeight(height) { aiResizeIframeHeight(height,'.esc_html($id).'); }'; 
            if ($enable_external_height_workaround != "no") {
              $html .= '    function aiResizeIframeHeightId(height,width,id) {'; 
              if ($auto_zoom == 'remote') { 
                  $html .= '   aiAutoZoomExternal(id, width,"' . $enable_responsive_iframe . '");';
                  $html .= '   ai_iframe_width_'.esc_html($id).' = width;';
                  $html .= '   ai_iframe_height_'.esc_html($id).' = height;';
              }
              if (!empty($iframe_zoom)) { 
                $html .= ' var zoom_height = parseInt(height * parseFloat(window["zoom_" + id]))+1;';
                $html .= ' jQuery(\'#ai-zoom-div-\' + id).css("height",zoom_height);';
              }
              $html .= 'aiResizeIframeHeightById(id,height); } ';
            }
            $html .= '</script>';
            if ($options['securitykey'] != $securitykey && empty($alternative_shortcode)) {
                return $error_css . '<div class="errordiv">' . __('An invalid security key was specified. Please use at least the following shortcode:<br>[advanced_iframe securitykey="&lt;your security key - see settings&gt;"]. Please also check in the html mode that your shortcode does only contain notmal spaces and not a &amp;nbsp; instead.', 'advanced-iframe') . '</div>';
            } else if ( $src == "not set" ) {
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
                                $src = $src_url; 
                            }
                         } else {
                            return $error_css . '<div class="errordiv">' . __('ERROR: map_parameter_to_url does not have the required 1 or 3 parameters', 'advanced-iframe') . '</div>';
                         }
                    }        
                }
                
                if (!empty($pass_id_by_url)) {
                    $sep = (strpos($src, '?') === false)? '?': "&amp;";
                    $src .= $sep . $pass_id_by_url . "=" . $id;  
                }  
                if (!empty($dynamic_url_parameter)) {
                    $dynamic_url_parameter = ai_replace_placeholders($dynamic_url_parameter, $enable_replace);
                    $dynamic_url_parameter = str_replace('=', '____', $dynamic_url_parameter);                
                    $dynamic_url_parameter = urlencode($dynamic_url_parameter);
                    $dynamic_url_parameter = str_replace('____', '=', $dynamic_url_parameter);

                    $sep = (strpos($src, '?') === false)? '?': "&amp;";
                    $src .= $sep . $dynamic_url_parameter;
                }
                
                // Evaluate shortcodes and replace placeholders for the src - they are not encoded! 
                // This has to be done by the shortcode that is used
                $src = ai_replace_placeholders($src , $enable_replace);

                if (empty($include_url)) {
                  if ((!empty($content_id) && !empty($content_styles)) ||
                       !empty($hide_elements) || !empty($change_parent_links_target)
                       || $enable_lazy_load == 'true' || $add_css_class_parent == 'true') {

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
                                    $hidehtml .= "jQuery('" . trim($elementArray[$x]) . "').css('" . trim($elements[0]) . "', '" . trim($elements[1]) . "');";
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
                    
                    
                    $html .= 'function aiModifyParent_' . esc_html($id) . '() { ';
                    $html .=  $hidehtml;
                    $html .= '}';
                    
                    $aiReady = '';
                    //  Change parent links target
                    if (!empty($change_parent_links_target)) {
                      $elementArray = explode("|", $change_parent_links_target);
                      for ($x = 0; $x < count($elementArray); ++$x) {
                          $aiReady .= 'jQuery("'. trim($elementArray[$x]) .'").attr("target", "'.$id.'");';
                      }
                    }
                    $aiReady .= 'aiModifyParent_' . esc_html($id) . '();';
                    
                    if ($enable_lazy_load == 'true') { 
                       // the 50 ms timeout is used because tabs need a little bit to initialize and hide the content.
                       $initLazyIframe = 'setTimeout(function() { jQuery("#ai-lazy-load-'.$id.'").lazyload({threshold: '.$enable_lazy_load_threshold.', load: loadElem_'.$id.'}); },50);';   
                       if ($enable_lazy_load_manual != 'auto') {
                           $initLazyIframe .= "jQuery.lazyload.setInterval(0);"; 
                       }
                       if ($enable_lazy_load_manual == 'true') {
                           $html .= 'function aiLoadIframe_' . esc_html($id) . '() { ';
                           $html .=  $initLazyIframe;
                           $html .= '};'; 
                           
                            if (!empty($enable_lazy_load_manual_element)) {
                               $html .= ' function trigger_manual_' . esc_html($id) . '() { '; 
                               $html .= 'jQuery( "' . esc_html($enable_lazy_load_manual_element) . '" ).click(function() { ';
                               $html .= 'window.setTimeout(function(){'; 
                               $html .= '  aiLoadIframe_' . esc_html($id) . '(); ';  
                               $html .= '}, 10);';
                               $html .= 'return false;';
                               $html .= '});'; 
                               $html .= '}';  
                               $aiReady .= 'trigger_manual_' . esc_html($id) . '();';
                            }    
                       } else {
                           $aiReady .= $initLazyIframe; 
                       } 
                    }
                    $html .= 'var aiReadyAiFunct_' . esc_html($id) . ' = function aiReadyAi_' . esc_html($id) . '() { ';
                    $html .=  $aiReady;
                    $html .= '};';
                    $html .= 'aiReadyCallbacks.push(aiReadyAiFunct_' . esc_html($id) . ');';
                    //$html .= 'jQuery(document).ready(function() { ';
                    //$html .= 'aiReadyAiFunct_' . esc_html($id) . '();';
                    //$html .= ' });';
                    
                    // Modify parent is called right away to do the modifications even when the dom is not ready yet.
                    // It is called again on dom ready 
                    $html .= 'if (window.jQuery) { aiModifyParent_' . esc_html($id) . '(); }';
                    $html .= '</script>';
                }

                    
                    // jQuery("#advanced_iframe").contents().find("#iframe-div").css("border","4px solid blue");
                    $hideiframehtml = '';
                    if ((!empty($iframe_content_id) && !empty($iframe_content_styles))|| !empty($iframe_hide_elements) ||
                       (!empty($change_iframe_links) && !empty($change_iframe_links_target))

                    ) {
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
                            return $error_css . '<div class="errordiv">' . __('Configuration error: The attributes iframe_content_id and iframe_content_styles have to have the amount of value sets separated by |.', 'advanced-iframe') . '</div>';
                        } else {
                            for ($x = 0; $x < count($elementArray); ++$x) {
                                $valuesArrayPairs = explode(";", trim($valuesArray[$x], " ;:"));
                                for ($y = 0; $y < count($valuesArrayPairs); ++$y) {
                                    $elements = explode(":", $valuesArrayPairs[$y]);
                                    $hideiframehtml .= "jQuery('#".$id."').contents().find('" . trim($elementArray[$x])
                                      . "').css('" . trim($elements[0]) . "', '" . trim($elements[1]) . "');";
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

                    if ($hideiframehtml != '') {
                    $html .= '<script type="text/javascript">';
                    $html .= 'function aiModifyIframe_' . esc_html($id) . '() { ';
                    $html .= 'try {';
                    $html .=  $hideiframehtml;
                    $html .=  '}  catch(e) {';
                    $html .=  '  if (console && console.log) {';
                    $html .=  '    console.log("Advanced iframe configuration error: You have enabled the modification of the iframe for pages on the same domain. But you use an iframe page on a different domain. You need to use the pro version of external workaround like described in the settings. Also check the next log. There the browser message for this error is displayed."); ';
                    $html .=  '    console.log(e);';
                    $html .=  '  }';
                    $html .=  '}';
                    $html .= '}';
                    $html .= '</script>';
                    }
                }
                if ($show_iframe_loader == 'true') {
                   // div around 
                   $html .= '<div id="ai-div-container-'.$id.'">';
                   // div for the loader 
                   $html .= '<div id="ai-div-loader-'.$id.'"><img src="' . site_url()  . '/wp-content/plugins/advanced-iframe/img/loader.gif" width="66" height="66" title="Loading" alt="Loading"></div>';
                 }
                
                 if (!empty($hide_part_of_iframe)) {
                      $rectangles = explode('|' , $hide_part_of_iframe);
                      for($hi=0;$hi<count($rectangles);++$hi){
                         $values = explode(',' , $rectangles[$hi]);
                         $html .= '<div id="wrapper-div-'.$id.'" style="position:relative">';
                         if (count($values) == 6) {
                            // add px or %
                            $r_width = $this->addPx($values[2]);
                            $r_height = $this->addPx($values[3]);
                            $html .= '<div style="position:absolute;z-index:'.trim($values[5]).';left:'.trim($values[0]).'px;top:'.trim($values[1]).'px;width:'.$r_width.';height:'.$r_height.';background-color:'.trim($values[4]).'"><!-- --></div>';
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
                
                if (!empty ($style) || $show_part_of_iframe == 'true' || $enable_responsive_iframe == 'true') {
                    if (strpos($style, 'max-width') === false) {
                      if ($show_part_of_iframe == 'true') {
                          $style .= 'max-width:none;';
                      } else if ($enable_responsive_iframe == 'true') {
                          $style .= 'max-width:100%;';
                      }
                    }
                    $html .= " style='" . esc_html($style) . "' ";
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
                
                if (!empty($iframe_height_ratio)) {
                    $onload_str .= ';aiResizeIframeRatio(this, "'.$iframe_height_ratio.'");';
                }
                
                if ($onload_scroll_top == 'true') {
                    $onload_str .= ';aiScrollToTop();';
                }
                // hide_page_until_loaded
                if ($hide_page_until_loaded  == 'true'  && $hide_page_until_loaded_external == 'false') {
                    $onload_str .= ';jQuery("#'.$id.'").css("visibility", "visible");';
                }
                 
                 if (!empty($resize_on_element_resize)) {
                    $onload_str .= 'onloadFired'.esc_html($id).' = true;';
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
                $html .= '}</script>';
                                  
                if ($hide_page_until_loaded  == 'true' || $hide_page_until_loaded_external == 'true') {
                  $html .= '<script type="text/javascript">jQuery("#'.$id.'").css("visibility", "hidden");</script>';
                }
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
                                   aiAutoZoom("'.$id.'","' . $enable_responsive_iframe . '" );
                               }
                           </script>';     
                 }
                 
                 if ($enable_responsive_iframe == 'true') {
                     $html .= '<script type="text/javascript">
                        function initResponsiveIframe'.esc_html($id).'() {  
                          jQuery(window).resize(function() {'; 
                     if ($enable_lazy_load == 'true') {
                         $html .= 'ifrm_'.esc_html($id).' = document.getElementById("'.esc_html($id).'");';
                     }
                      if (!empty($iframe_height_ratio)) {           
                          $html .= '  aiResizeIframeRatio(ifrm_'.esc_html($id).', "'.$iframe_height_ratio.'");';
                      } else  if ($auto_zoom == 'same') {
                         $html .= 'aiAutoZoom("'.$id.'","' . $enable_responsive_iframe . '" );';
                      } else  if ($auto_zoom == 'remote') {
                         $html .= 'aiAutoZoomExternalHeight("'.esc_html($id).'",ai_iframe_width_'.esc_html($id).',ai_iframe_height_'.esc_html($id).',"' . $enable_responsive_iframe . '" );';
                      } else if ($onload_resize) {            
                          $html .= '  aiResizeIframe(ifrm_'.esc_html($id).', "'.$onload_resize_width.'");';
                      }   
                    $html .= '
                        });
                        }
                        aiReadyCallbacks.push(initResponsiveIframe' . esc_html($id) . ');
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
            
            $newer_version = version_compare(get_bloginfo('version'), '3.3') >= 0; 
      
            if ($enable_lazy_load == 'true') {
              if ($newer_version) {
                  wp_enqueue_script('ai-lazy-js',plugins_url( 'includes/scripts/jquery.lazyload-any.min.js' , __FILE__ ), array( 'jquery'), $version_counter, true);
              } else {
                  $html .= '<script type="text/javascript" src="' . site_url() . '/wp-content/plugins/advanced-iframe/includes/scripts/jquery.lazyload-any.min.js" ></script>';
              }
            }

            if (!empty($resize_on_element_resize)) {
              if ($newer_version) {
                  wp_enqueue_script('ai-change-js',plugins_url( 'includes/scripts/jquery.ba-resize.min.js' , __FILE__ ), array( 'jquery','ai-js'), $version_counter, true);
              } else {
                  $html .= '<script type="text/javascript" src="' . site_url() . '/wp-content/plugins/advanced-iframe/includes/scripts/jquery.ba-resize.min.js" ></script>';
              }
              $html .= '<script type="text/javascript">';
              $html .= 'function initResizeIframe'.esc_html($id).'() {
                        if (onloadFired'.esc_html($id).' === false) {
                          // onload is not fired yet. we wait 100 ms and retry
                          window.setTimeout("initResizeIframe'.esc_html($id).'()",100);
                          return;
                        }
                        onloadFired'.esc_html($id).' = true; 
              ';
              
              // minimum delay is 50 ms !
              if (!empty($resize_on_element_resize_delay) &&
                 ((int)$resize_on_element_resize_delay) >= 50 ) {
                  $html .= 'jQuery.resize.delay='.esc_html($resize_on_element_resize_delay).';';
              }
              $html .= 'jQuery("#'.esc_html($id).'").contents().find("'.esc_html($resize_on_element_resize).'").resize(function(){ 
                               aiResizeIframe(ifrm_'.$id.', "'.$onload_resize_width.'");
                           });
                        }';
              $html .= 'aiReadyCallbacks.push(initResizeIframe' . esc_html($id) . ');';
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
                }';
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
            
            if  ($options['show_menu_link'] == "true") {
                $pro = (file_exists(dirname(__FILE__) . "/includes/class-cw-envato-api.php")) ? " Pro" : ""; 
                add_menu_page('Advanced iFrame' . $pro, 'Advanced iFrame'. $pro, 'manage_options',  basename(__FILE__), array($cons_advancediFrame, 'printAdminPage'));
            }
            
        }
    }
    add_action('admin_menu', 'advancediFrame_ap', 1); //admin page
    add_action('init', array($cons_advancediFrame, 'loadLanguage'), 1); // add languages
    add_action('admin_enqueue_scripts', array($cons_advancediFrame, 'addAdminHeaderCode'), 99); // load css
    add_action('wp_enqueue_scripts',  array($cons_advancediFrame, 'addWpHeaderCode'), 98); // load css
    add_action('wp_footer',  array($cons_advancediFrame, 'add_script_footer'), 2);
    add_shortcode('advanced_iframe', array($cons_advancediFrame, 'do_iframe_script'), 1); // setup shortcode
    add_shortcode('advanced-iframe', array($cons_advancediFrame, 'do_iframe_script'), 1); // setup shortcode alternative style
    $options = $cons_advancediFrame->getAdminOptions();
    if (!empty($options['alternative_shortcode'])) {    
        add_shortcode($options['alternative_shortcode'], array($cons_advancediFrame, 'do_iframe_script'), 1); // setup shortcode alternative style  
    }
    
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

function ai_replace_placeholders($str_input, $enable_replace) {
    if ($enable_replace) {
        $str_input = str_replace('{site}', site_url(), $str_input);
        $str_input = str_replace('{host}', $_SERVER['HTTP_HOST'], $str_input);
        $str_input = str_replace('{port}', $_SERVER['SERVER_PORT'], $str_input);
        
        global $current_user;
        get_currentuserinfo();
        
        $str_input = str_replace('{userid}', urlencode($current_user->ID), $str_input);
        if ( 0 == $current_user->ID ) {
          $str_input = str_replace('{username}', '', $str_input);
          $str_input = str_replace('{useremail}', '', $str_input);
        } else {
          $str_input = str_replace('{username}', urlencode($current_user->user_login), $str_input);
          $str_input = str_replace('{useremail}', urlencode($current_user->user_email), $str_input); 
        }
        
        $admin_email = get_option( 'admin_email' );
        $str_input = str_replace('{adminemail}', urlencode($admin_email), $str_input); 
        
        // evaluate shortcodes for the parameter 
        $str_input = str_replace('{{', "[", $str_input);
        $str_input = str_replace('}}', "]", $str_input);
        $str_input = do_shortcode($str_input);
    }
    return $str_input;
}

if (file_exists(dirname(__FILE__) . "/includes/advanced-iframe-widget.php")) {
    require_once('includes/advanced-iframe-widget.php');
    add_action('widgets_init','advanced_iframe_widget_init');
    add_filter('site_transient_update_plugins', 'ai_remove_update');
}

?>