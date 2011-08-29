<?php
/* 
Plugin Name: Advanced iframe
Plugin URI: http://www.tinywebgallery.com/blog/advanced-iframe
Version: 1.2
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
if (!class_exists("advancediFrame")) {
    class advancediFrame {
        var $adminOptionsName = "advancediFrameAdminOptions";

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
                'hide_elements' => '', 'class' => '', 'shortcode_attributes' => 'true', 'url_forward_parameter' => '');
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
            echo '<link type="text/css" rel="stylesheet" href="' . get_bloginfo('wpurl') . '/wp-content/plugins/advanced-iframe/css/twg.css" />' . "\n";

        }

        function param($param, $content = null) {
            $value = isset($_GET[$param]) ? $_GET[$param] : '';
            return esc_html($value);
        }

        function do_iframe_script($atts) {
            $options = get_option("advancediFrameAdminOptions");
            // defaults
            extract(array('securitykey' => 'not set',
                'src' => $options['src'], 'height' => $options['height'], 'width' => $options['width'], 'frameborder' => $options['frameborder'],
                'scrolling' => $options['scrolling'], 'marginheight' => $options['marginheight'], 'marginwidth' => $options['marginwidth'],
                'transparency' => $options['transparency'], 'content_id' => $options['content_id'],
                'content_styles' => $options['content_styles'], 'hide_elements' => $options['hide_elements'],
                'class' => $options['class'], 'url_forward_parameter' => $options['url_forward_parameter'], $atts));
            // read the shortcode attributes
            if ($options['shortcode_attributes'] == 'true') {
                extract(shortcode_atts(array('securitykey' => 'not set',
                    'src' => $options['src'], 'height' => $options['height'], 'width' => $options['width'], 'frameborder' => $options['frameborder'],
                    'scrolling' => $options['scrolling'], 'marginheight' => $options['marginheight'], 'marginwidth' => $options['marginwidth'],
                    'transparency' => $options['transparency'], 'content_id' => $options['content_id'],
                    'content_styles' => $options['content_styles'], 'hide_elements' => $options['hide_elements'],
                    'class' => $options['class'], 'url_forward_parameter' => $options['url_forward_parameter']), $atts));
            } else {
                // only the secrity key is read.
                extract(shortcode_atts(array('securitykey' => 'not set'), $atts));
            }

            echo '<link type="text/css" rel="stylesheet" href="' . get_bloginfo('wpurl') . '/wp-content/plugins/advanced-iframe/css/ai.css" />' . "\n";
            if ($options['securitykey'] != $securitykey) {
                echo '<div class="errordiv">' . __('An invalid security key was specified. Please use at least the following shortcode:<br>[advanced_iframe securitykey="&lt;your security key - see settings&gt;"]', 'advanced-iframe') . '</div>';
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

                if ((!empty($options['content_id']) && !empty($options['content_styles']))
                        || !empty($options['hide_elements'])) {
                    $html .= "<script>
                   jQuery(document).ready(function() {";
                    if (!empty($options['hide_elements'])) {
                        $html .= "jQuery('" . esc_html($options['hide_elements']) . "').css('display', 'none');";
                    }
                    if (!empty($options['content_id'])) {
                        $elements = esc_html($options['content_id']); // this field should not have a problem if they are encoded.
                        $values = esc_html($options['content_styles']); // this field style should not have a problem if they are encoded.
                        $elementArray = explode("|", $elements);
                        $valuesArray = explode("|", $values);
                        if (count($elementArray) != count($valuesArray)) {
                            echo '<div class="errordiv">' . __('Configuration error: The attributes content_id and content_styles have to have the amount of value sets separated by |.', 'advanced-iframe') . '</div>';
                            return;
                        } else {
                            for ($x = 0; $x < count($elementArray); ++$x) {
                                $valuesArrayPairs = explode(";", trim($valuesArray[$x], " ;:"));
                                for ($y = 0; $y < count($valuesArrayPairs); ++$y) {
                                    $elements = explode(":", $valuesArrayPairs[$y]);
                                    $html .= "jQuery('" . $elementArray[$x] . "').css('" . $elements[0] . "', '" . $elements[1] . "');";
                                }
                            }
                        }
                    }
                    $html .= " });
                 </script>";
                }
                $html .= "<iframe id='advanced_iframe' src='" . $src . "' width='" . esc_html($width) . "' height='" . esc_html($height) . "' scrolling='" . esc_html($scrolling) . "' ";
                if (!empty ($marginwidth)) {
                    $html .= " marginwidth='" . esc_html($marginwidth) . "' ";
                }
                if (!empty ($marginheight)) {
                    $html .= " marginheight='" . esc_html($marginheight) . "' ";
                }
                if ($frameborder != '') {
                    $html .= " frameborder='" . esc_html($frameborder) . "' ";
                }
                if (!empty ($transparency)) {
                    $html .= " allowtransparency='" . esc_html($transparency) . "' ";
                }
                if (!empty ($class)) {
                    $html .= " class='" . esc_html($class) . "' ";
                }

                $html .= "></iframe>\n ";
            }
            return $html;
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
    if (!function_exists("advancediFrame_ap")) {
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
    add_shortcode('advanced_iframe', array(&$cons_advancediFrame, 'do_iframe_script'), 1); // setup shortcode [advanced_iframe]
    register_activation_hook(__FILE__, array(&$cons_advancediFrame, 'activate'));
}
?>