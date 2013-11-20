<?php  
/* 
Advanced iFrame
http://www.tinywebgallery.com/blog/advanced-iframe
Michael Dempfle 
Administration include
*/
?>    
<script type="text/javascript">
    function aiCheckInputNumber(intputField) {
        intputField.value = intputField.value.split(' ').join('');
        var f = intputField.value;
        if (intputField.value == '') return;
        var match = f.match(/^(\-){0,1}(\d+)(px|%|em|pt)?$/);
        if (!match) {
            alert("<?php _e("Please check the value you have entered. Only numbers with an optional px, %, em or pt are allowed", "advanced-iframe");?>");
        }
    }  
</script>   
<?php
/**
 *  Print the donation details depending on the version type
 */ 
function printDonation($devOptions) {
if (file_exists(dirname(__FILE__) . "/includes/class-cw-envato-api.php")) {
  if (false) { // validation example does not exist. Will be added when I have a valid purcase code.
  echo '
      <div id="icon-options-general" class="icon_ai">          
      <br>           
      </div><h2>';
      _e('Advanced iFrame Pro - Enter your CodeCanyon data below to verify your payment', 'advanced-iframe'); 
  echo '</h2>';  
  echo '<div class="updated">               
    <p><strong>';
     _e('The license data below is valid.', 'advanced-iframe' );
     echo '</strong>               
    </p>          
     </div>';
  echo '<div class="error">               
    <p><strong>'; 
    _e('The license data below is not valid.', 'advanced-iframe' );
    echo  '</strong>               
    </p>          
    </div>';    
  echo '<p>';
    _e('<p>Thank you for getting Advanced iFrame Pro at Codecanyon. Please enter your payment infos below. After pressing "Verify data" the account data is validated at Codecanyon.</p>', 'advanced-iframe' );
    
  echo '<table class="form-table">';         
      printTextInput($devOptions, __('Evanto user name', 'advanced-iframe'), 'evanto_user_name', __('Please enter your evanto user name.','advanced-iframe'));
      printTextInput($devOptions, __('API key', 'advanced-iframe'), 'api_key', __('Please enter an api key. The key can be generated in your evanto account.','advanced-iframe'));
      printTextInput($devOptions, __('Purcase code', 'advanced-iframe'), 'purcase_code', __('Please enter the purcase code you got after the payment.', 'advanced-iframe'));
      printTrueFalse($devOptions, __('Show this section at the bottom', 'advanced-iframe'), 'donation_bottom', __('Please move this section to the bottom after you have entered your data sucessfully.', 'advanced-iframe'));
  echo '</table><p>'; 
  echo '<p>                   
        <input class="button-primary" type="submit" name="update_iframe-loader" value="'; 
        _e('Verify data', 'advanced-iframe');
  echo '"/></p>';             
 } else {
  echo '
      <div id="icon-options-general" class="icon_ai">          
      <br>           
      </div><h2>';
      _e('Advanced iFrame Pro - Quickstart guide, vote for the plugin on codecanyon', 'advanced-iframe'); 
  echo '</h2>';
  _e('
  <h3>Quick start guide</h3>
<p>To include a webpage to your page please check the following things first:</p>
<ul>
<li>- Check if your page you want to include is allowed to be included:<br />&nbsp;&nbsp;&nbsp;&nbsp;<a target="_blank" href="http://www.tinywebgallery.com/blog/advanced-iframe/free-iframe-checker">http://www.tinywebgallery.com/blog/advanced-iframe/free-iframe-checker</a>!</li>
<li>- Check if the iframe page and the parent page are one the same domain. www.example.com and text.example.com are different domains!</li>
<li>- Can you modify the page that should be included?</li>
</ul>
<p>Most likely you have one of the following setups:</p>
<ol>
<li>iframe cannot be included:  You cannot include the content because the owner does not allow this. </li>
<li>iframe can be included and you are on a different domain: You are not allowed to modify the content of the iframe but you can show it or a part of it. To resize the content to the height/width you need to modify the remote iframe page to enable the provided workaround.</li>
<li>Iframe can be included and you are on the same domain: All features of the plugin can be used.</li>
</ol>', 'advanced-iframe');

  echo '<p>';
    _e('  <h3>Vote for the plugin</h3><p>Thank you for getting Advanced iFrame Pro at Codecanyon. </p>', 'advanced-iframe' );
    _e('<p>Please feel free to leave an item rating from your items download page if you haven\'t already done so.</p>', 'advanced-iframe' );    
    _e('<p>Please get in contact with me if you have problems because most of the issues are easy to solve. But at least tell me what you did not like so I can improve this. Also make sure that you took a look at the quick start guide to make sure the feature you like can be used!</p>', 'advanced-iframe' );
  
  echo '<table class="form-table">';         
      printTrueFalse($devOptions, __('Show this section at the bottom', 'advanced-iframe'), 'donation_bottom', __('Please move this section to the bottom after you have read it.', 'advanced-iframe'));
  echo '</table><p>'; 
  echo '<p>                   
        <input class="button-primary" type="submit" name="update_iframe-loader" value="'; 
      _e('Update Settings', 'advanced-iframe');
  echo '"/></p>'; 
 }
 
} else {
echo '
    <div id="icon-options-general" class="icon_ai">          
    <br>           
  </div><h2>';
  _e('Advanced iFrame - Upgrading to Advanced iFrame Pro', 'advanced-iframe'); 
  echo '</h2>  
  <p>';
  _e('<p>Advanced iframe is <strong>free for personal use</strong> and the Pro version a bargain for your business. The personal version does already contain most of the cool features of the Pro version. It has a limit of 10.000 views a month which should normaly not been hit by a personal website.</p>', 'advanced-iframe' );
   
echo '<div id="first" class="signup_account_container signup_account_container_active" style="cursor: default;" title="';
_e('Free - For personal, non-commercial sites and blogs', 'advanced-iframe'); 
echo '">
			<div class="signup_inner">
				<div class="signup_inner_plan">';
        _e('Personal', 'advanced-iframe'); 
        echo '</div>					
				<div class="signup_inner_price">
					<strong>';
          _e('FREE', 'advanced-iframe');  
          echo '</strong>
				</div>
				<div class="signup_inner_header">';
        _e('For personal, non-commercial sites and blogs', 'advanced-iframe');  
        echo '</div>
				<div class="signup_inner_desc">';
        _e('10.000 views/month limit', 'advanced-iframe');
        echo '</div>
				<a href="https://www.paypal.com/cgi-bin/webscr?cmd=_xclick&business=paypal%40mdempfle%2ede&item_name=advanced%20iframe&item_number=Support%20Open%20Source&no_shipping=0&no_note=1&tax=0&currency_code=EUR&lc=EN&bn=PP%2dDonationsBF&charset=UTF%2d8" target="_blank" id="plan_button_pro" class="signup_inner_button">';
         _e('Donate with Paypal', 'advanced-iframe');
        echo '</a>
			</div>
    </div>  
      ';
echo '   
   <div  class="signup_account_container signup_account_container_active" style="cursor: default;" title="';
   _e('Pro - For commercial, business, and professional sites', 'advanced-iframe');
   echo '">
			<div class="signup_inner">
				<div class="signup_inner_plan">';
        _e('Pro', 'advanced-iframe');
        echo '</div>					
				<div class="signup_inner_price">
					<strong>$14</strong>
				</div>
				<div class="signup_inner_header">';
        _e('For commercial, business, and professional sites', 'advanced-iframe');
        echo '</div>
				<div class="signup_inner_desc">';
        _e('+ Additional features!', 'advanced-iframe');
        echo '</div>
				<a href="http://codecanyon.net/item/advanced-iframe-pro/5344999?ref=mdempfle" target="_blank" id="plan_button_pro" class="signup_inner_button">';
        _e('Get pro at Codecanyon', 'advanced-iframe');
        echo '</a>
			</div>
		</div>
';      
echo '      
       <div id="last" class="signup_account_container signup_account_container_active" style="cursor: default;">
			<div class="signup_inner">
				<div class="signup_inner_plan">';
        _e('Pro Version Benefits', 'advanced-iframe');
        echo '</div>					
			
				<div class="signup_inner_desc">
           <ul class="pro"><li>';
           _e('Show specific areas of the iframe even when the iframe is on a different domain<br /><a target="_blank" href="http://examples.tinywebgallery.com/configurator/advanced-iframe-area-selector.html">Show the new graphical selector</a></li><li>Widget support</li><li>External workaround supports iframe modifications</li><li>No view limit</li><li><a target="_blank" href="http://www.tinywebgallery.com/blog/advanced-iframe/advanced-iframe-support">Support</a></li><li><a target="_blank" href="http://www.tinywebgallery.com/blog/advanced-iframe/advanced-iframe-pro-demo">See pro demo</a>', 'advanced-iframe');
           echo '</li></ul>
        </div>
			</div>
		</div>
    
<div class="clear" /><br />
';    
      
_e('<p>So if you use the Advanced iFrame on a non personal website please first test the plugin carefully before buying. After that it is quick and painless to get Advanced iFrame Pro. Simply get <strong>Advanced iFrame Pro on CodeCanyon</strong> and be pro in a few minutes!</p>', 'advanced-iframe');  

_e('<p><strong>Current status</strong>: ', 'advanced-iframe'); 
echo get_option('default_a_options') / 100 . ' % of views for this month used.';
_e('</p>', 'advanced-iframe'); 
echo '</p>';  
echo '<table class="form-table">'; 
printTrueFalse($devOptions, __('Show this section at the bottom', 'advanced-iframe'), 'donation_bottom', __('Please move this section to the bottom if it bothers you or if you have already supported the development. Feel also free to contact me if you are missing a feature. Sorry for moving this section to the top but at the bottom it seems to be ignored completely.', 'advanced-iframe'));
echo '     
     </table>
         <p>                   
      <input class="button-primary" type="submit" name="update_iframe-loader" value="'; 
      _e('Update Settings', 'advanced-iframe');
echo '"/>             
    </p>              
  </p> 
';
}
}
$evanto = (file_exists(dirname(__FILE__) . "/includes/class-cw-envato-api.php")); 
if (is_user_logged_in() && is_admin()) {
    $devOptions = $this->getAdminOptions();

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
            'keep_overflow_hidden','hide_page_until_loaded_external'                         
            );                     
        if (!wp_verify_nonce($_POST['twg-options'], 'twg-options')) die('Sorry, your nonce did not verify.');
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
                     || $item= 'show_part_of_iframe_next_viewports_hide') {
                         $text = 'false';  
                     } else {
                         $text = '';
                     }
                 }
             }  
              $text = str_replace("'", '"' ,$text);
             // replace ' with "  
            
             if ($item == 'include_url' || $item == 'src') {
                $devOptions[$item] = stripslashes(esc_url($text));
              } else if (function_exists('sanitize_text_field')) {
                $devOptions[$item] = stripslashes(sanitize_text_field($text));
             } else {
                 $devOptions[$item] = stripslashes($text);
             }
              
             if ($item == 'id') {
                $devOptions[$item] =  preg_replace("/\W/", "_", $text);
             }   
        }
        update_option($this->adminOptionsName, $devOptions);
        
        // create the external js file with the url of the wordpress installation
        $template_name = dirname(__FILE__) . '/js/ai_external.template.js';
        $script_name = dirname(__FILE__) . '/js/ai_external.js';        
        $jquery_path =  site_url() . '/wp-includes/js/jquery/jquery.js'; 
        $content = file_get_contents($template_name);
        $new_content = str_replace('WORDPRESS_SITE_URL', get_site_url(), $content);        
        $new_content = str_replace('PARAM_ID', $devOptions['id'], $new_content);     
        $new_content = str_replace('PARAM_IFRAME_HIDE_ELEMENTS', $devOptions['iframe_hide_elements'], $new_content);
        $new_content = str_replace('PARAM_ONLOAD_SHOW_ELEMENT_ONLY', $devOptions['onload_show_element_only'], $new_content);
        $new_content = str_replace('PARAM_IFRAME_CONTENT_ID',  $devOptions['iframe_content_id'], $new_content);
        $new_content = str_replace('PARAM_IFRAME_CONTENT_STYLES',  $devOptions['iframe_content_styles'], $new_content);
        $new_content = str_replace('PARAM_ENABLE_EXTERNAL_HEIGHT_WORKAROUND', $devOptions['enable_external_height_workaround'], $new_content);
        $new_content = str_replace('PARAM_KEEP_OVERFLOW_HIDDEN', $devOptions['keep_overflow_hidden'], $new_content); 
        $new_content = str_replace('PARAM_HIDE_PAGE_UNTIL_LOADED_EXTERNAL', $devOptions['hide_page_until_loaded_external'], $new_content); 
        $new_content = str_replace('PARAM_JQUERY_PATH', $jquery_path , $new_content); 

        $fh = fopen($script_name, 'w');
        if ($fh) { 
            fwrite($fh, $new_content);
            fclose($fh);
        }
        ?>            
<div class="updated">                  
  <p><strong>             
      <?php _e("Settings Updated.", "advanced-iframe");?></strong>                  
  </p>           
</div>
<?php
    }
    ?>      
<style type="text/css">        table th {             text-align: left;         }       
</style>
<div id="ai" class="wrap">     
  <!-- options-general.php?page=advanced-iframe.php -->          
  <form name="ai_form" method="post" action="">                  
    <?php wp_nonce_field('twg-options', 'twg-options'); ?>  
    
      <div id="icon-options-general" class="icon_ai"><br /></div>
<h2><?php 
        _e('Advanced iFrame ', 'advanced-iframe'); 
        if ($evanto) {
        _e('Pro', 'advanced-iframe'); 
        } ?></h2>
<br />
<div class="nounderline">
<div style="float:left; margin-right:30px;height:60px;">
<a href="#ds">Default settings</a><br />
<a href="#gs">Get support </a><br />
<a href="#mp">Modify the parent page</a><br /> 
</div>
<div style="float:left; margin-right:30px;;height:60px;">
<a href="#so">Show only a part of the iframe</a><br />
<a href="#rt">Resize the iframe to the content height/width</a><br />
<a href="#xss">Howto enable cross domain resize and modification</a><br />
</div>
<div style="float:left;height:60px;">
<a href="#ad">Add additional files</a><br />
<a href="#ic">Include content directly</a><br />
</div>
</div>
<div style="clear:both;">
    
    
                  
<?php
if ($devOptions['donation_bottom'] === 'false') {
  printDonation($devOptions);
}
    ?>
    <div id="ds"></div> 
     <br />               
    <div id="icon-options-general" class="icon_ai">                          
      <br>                  
    </div>        <h2>                      
<?php 
        _e('Advanced iFrame ', 'advanced-iframe'); 
        if ($evanto) {
        _e('Pro', 'advanced-iframe'); 
        }
              _e(' - Default settings', 'advanced-iframe'); ?></h2>                  
    <p>                      
      <?php _e('This plugin will include any content an advanced iframe. Please enter the url and the size you want to include your page. You have a couple of additional default options which help to integrate your site better into your template. You can overwrite all of these settings by specifying the parameter in the shortcode. Please read the documentation after each field about the parameter you have to use.', 'advanced-iframe'); ?>                    
    </p>                  
    <p class="shortcode">                      
      <?php _e('Please use the following shortcode to include a page to your page: ', 'advanced-iframe'); ?>  
      <span> [advanced_iframe securitykey="<?php echo $devOptions['securitykey']; ?>"] 
      </span> 
      <p>
      Examples if you want to use several iframes with different settings. Also read the <a target="_blank" href="http://www.tinywebgallery.com/blog/advanced-iframe/advanced-iframe-faq">FAQ</a>:
      <ul>
      <li>[advanced_iframe securitykey="<?php echo $devOptions['securitykey']; ?>" src="http://www.tinywebgallery.com"] </li> 
      <li>[advanced_iframe securitykey="<?php echo $devOptions['securitykey']; ?>" src="http://www.tinywebgallery.com" width="100%" height="600"]</li> 
      <li>[advanced_iframe securitykey="<?php echo $devOptions['securitykey']; ?>" src="http://www.tinywebgallery.com" id="iframe1" name="iframe1" width="100%" height="600" ]</li>
      </ul>
      </p>                 
    </p>                  
    <table class="form-table">          
<?php
        printTextInput($devOptions, __('Security key', 'advanced-iframe'), 'securitykey', __('This is the security key which has to be used in the shorttag. This is mandatory because otherwise anyone who can create an article can insert an iframe.  The default security key was randomly generated during installation. Please change the key if you like. You should use this in combination with e.g. Page security to make sure that only the users you define can modify pages.', 'advanced-iframe'));
       
        printTextInput($devOptions, __('<b>Url</b>', 'advanced-iframe'), 'src', __('Enter the full URL to your page. e.g. http://www.tinywebgallery.com. Make sure not to mix http and https! Many browsers do e.g. block Javascript or show unexpected behavior. Also use the free url checker below to make sure that you can include the page. You can also add parameters to this url like http://www.tinywebgallery.com/test.php?iframe=true. then you can check this variable and use it to e.g. hide some elements in the iframe. Shortcode attribute: src=""', 'advanced-iframe'));
              ?>         
      <tr valign="top">      
        <th scope="row"><strong><?php _e('Free url checker', 'advanced-iframe'); ?></strong>
        </th>      <td>
          <?php _e('<strong>Not all pages</strong> can be included in an iframe because they have a header flag this does not allow this. Please use the free iframe checker to find out if the page you want to include does work on all browsers: <a target="_blank" href="http://www.tinywebgallery.com/blog/advanced-iframe/free-iframe-checker/">Free iframe checker</a>.', 'advanced-iframe'); ?></td>      
      </tr>               
<?php      
        printNumberInput($devOptions, __('Width', 'advanced-iframe'), 'width', __('The width of the iframe. You can specify the value in px or in %. If you don\'t specify anything px is assumed.  Shortcode attribute: width=""', 'advanced-iframe'));
        printNumberInput($devOptions, __('Height', 'advanced-iframe'), 'height', __('The height of the iframe. You can specify the value in px or in %. If you don\'t specify anything px is assumed. Please note that % does most of the time does NOT give the expected result (e.g. 100% is only 150px) because the % are not from the iframe page but from the parent element. If you like something like that the iframe is resized to the content please read the \'<a href="#onload">Javascript iframe onload options</a>\' section below! Shortcode attribute: height=""', 'advanced-iframe'));
        printAutoNo($devOptions, __('Scrolling', 'advanced-iframe'), 'scrolling', __('Defines if scrollbars are shown if the page is too big for your iframe. Please note: If you select \'Yes\' IE does always show scrollbars on many pages! So only use this if needed. Scrolling "none" means that the attribute is not rendered at all and can be set by css to enable the scrollbars responsive.  Shortcode attribute: scrolling="auto" or scrolling="no" or scrolling="none"', 'advanced-iframe'));
        printNumberInput($devOptions, __('Margin width', 'advanced-iframe'), 'marginwidth', __('The margin width of the iframe. You can specify the value in px. If you don\'t specify anything px is assumed.  Shortcode attribute: marginwidth=""', 'advanced-iframe'));
        printNumberInput($devOptions, __('Margin height', 'advanced-iframe'), 'marginheight', __('The margin height of the iframe. You can specify the value in px. If you don\'t specify anything px is assumed.  Shortcode attribute: marginheight=""', 'advanced-iframe'));
        printNumberInput($devOptions, __('Frame border', 'advanced-iframe'), 'frameborder', __('The frame border of the iframe. You can specify the value in px. If you don\'t specify anything px is assumed.  Shortcode attribute: frameborder=""', 'advanced-iframe'));
        printTrueFalse($devOptions, __('Transparency', 'advanced-iframe'), 'transparency', __('If you like that the iframe is transparent and your background is shown you should set this to \'Yes\'. If this value is not set then the iframe is transparent in IE but transparent in e.g. Firefox. So by default you should leave this to \'Yes\'. Shortcode attribute: transparency="true" or transparency="false" ', 'advanced-iframe'));
        printTextInput($devOptions, __('Class', 'advanced-iframe'), 'class', __('You can define a class for the iframe if you like. Shortcode attribute: class=""', 'advanced-iframe'));
        printTextInput($devOptions, __('Style', 'advanced-iframe'), 'style', __('You can define styles for the iframe if you like. The recommended way is to put the styles in a css file and use the class option. Shortcode attribute: style=""', 'advanced-iframe'));       

        
        printTextInput($devOptions, __('Id', 'advanced-iframe'), 'id', __('Enter the \'id\' attribute of the iframe. Allowed values are only a-zA-Z0-9_. Do NOT use any other characters because the id is also used to generate unique javascript functions! Other characters will be removed when you save! Shortcode attribute: id=""', 'advanced-iframe'));
        printTextInput($devOptions, __('Name', 'advanced-iframe'), 'name', __('Enter the \'name\' attribute of the iframe. Shortcode attribute: name=""', 'advanced-iframe'));
        printTextInput($devOptions, __('URL forward parameters', 'advanced-iframe'), 'url_forward_parameter', __('Define the parameters that should be passed from the browser url to the iframe url. Please separate the parameters by \',\'. In e.g. TinyWebGallery this enables you to jump directly to an album or image although TinyWebGallery is included in an iframe. Shortcode attribute: url_forward_parameter=""', 'advanced-iframe'));         
        printTrueFalse($devOptions, __('Scrolls the parent window to the top', 'advanced-iframe'), 'onload_scroll_top', __('If you like that if you click on a link in the iframe the parent page should scroll to the top you should set this to \'Yes\'. Please note that this is done by Javascript! So if a user has Javascript deactivated no scrolling is done.   This setting generates the code onload="aiScrollToTop();" to the iframe. If you select the resize iframe as well then onload="aiResizeIframe(this);aiScrollToTop();" is generated. If you like a different order please enter the javascript functions directly in the onload parameter in the order you like. Shortcode attribute: onload_scroll_top="true" or onload_scroll_top="false" ', 'advanced-iframe'));
       
        printTrueFalse($devOptions, __('Hide the iframe until it is loaded', 'advanced-iframe'), 'hide_page_until_loaded', __('This setting hides the iframe until it is loaded. This prevents the iframe white flash issue while loading. When you use the external workaround please check the setting in the section <a href="#hide_page_until_loaded_external">below</a>. The setting there overwrites this setting because otherwise the iframe is maybe shown too early! Shortcode attribute: hide_page_until_loaded="true" or hide_page_until_loaded="false" ', 'advanced-iframe')); 
         printTrueFalse($devOptions, __('Allow shortcode attributes', 'advanced-iframe'), 'shortcode_attributes', __('Allow to set attributes in the shortcode. All of the attributes can be overwritten in the shortcode if you set \'Yes\'. Otherwise the settings you specify here are used.', 'advanced-iframe'));
        printTrueFalse($devOptions, __('Use shortcode attributes only', 'advanced-iframe'), 'use_shortcode_attributes_only', __('All iframes you use in your pages use the settings below. With shortcode attributes you can overwrite these settings. When you use several iframes with different settings this can lead to strange behavior because you do not see the whole configuration in the shortcode. By setting this option to true only the parameters defined as attributes are used. So the minimum you need to define is: securitykey and src of the iframe. You can set this for a single iframe as well with the shortcode attribute use_shortcode_attributes_only="true". A minimal shortcode would then look like this: [advanced_iframe securitykey="', 'advanced-iframe') . $devOptions['securitykey'] . __('" use_shortcode_attributes_only="yes" src="http://www.tinywebgallery.com"].  Shortcode attribute: use_shortcode_attributes_only="true" or use_shortcode_attributes_only="false"', 'advanced-iframe'));           
        
                          ?>                    
    </table>                  
    <p>                          
      <input id="gs" class="button-primary" type="submit" name="update_iframe-loader" value="<?php _e('Update Settings', 'advanced-iframe') ?>"/>                  
    </p>
    <div id="icon-options-general" class="icon_ai">               
      <br />              
    </div> <h2>               
<?php 
        _e('Advanced iFrame ', 'advanced-iframe'); 
        if ($evanto) {
           _e('Pro', 'advanced-iframe'); 
        }
              _e(' - Get support', 'advanced-iframe'); ?>       </h2>                  
    <p>                      
      <?php _e('The settings above are the settings a normal iframe solution does offer. They don\'t require any specific html, css or programming knowhow.' , 'advanced-iframe'); ?>                    
    </p>      
    <p>           
      <?php _e('The advanced options below do modify the styles of the parent page, the iframe, do some Javascript magic when the iframe is loaded or include content directly to your page. Understanding this is not basic Wordpress knowhow and therefore you can get help here if you want. I do offer paid support for this plugin now.' , 'advanced-iframe'); ?>               
    </p>      
    <p>      
      <?php _e('What do you get? <ul><li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- Free check if you can include the content the way YOU like.</li><li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- Fast and reliable setup of what you want.</li><li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- You only pay if it works!</li></ul>' , 'advanced-iframe'); ?>      
    </p>       
    <p>      
      <?php _e('This offer is only available for Advanced iFrame Pro users.<br/>If you are interested please visit <a id="mp" target="_blank" href="http://www.tinywebgallery.com/blog/advanced-iframe-support/">http://www.tinywebgallery.com/blog/advanced-iframe-support/</a> for more information.' , 'advanced-iframe'); ?>      
    </p>      
    <div id="icon-options-general" class="icon_ai">               
      <br>              
    </div>
       
     <h2 >               
<?php 
        _e('Advanced iFrame ', 'advanced-iframe'); 
        if ($evanto) {
        _e('Pro', 'advanced-iframe'); 
        }
              _e(' - Modify the parent page', 'advanced-iframe'); ?></h2>                        
    <p>                      
      <?php _e('With the following 3 options you can modify your template on the fly to give the iframe more space! At most templates you would have to create a page template with a special css and this is quite complicated. By using the options below your template is modified on the fly by jQuery. Please look at the screenshots to make these options more clear. The options are very useful for templates that have a top navigation because otherwise your menu is gone! If you still want to do this you should add a back link to the page. The examples below are for Twenty Ten, iNove and the default Wordpress theme.', 'advanced-iframe'); ?>                    
    </p>                  
    <table class="form-table">          
<?php
        printTextInput($devOptions, __('Hide elements', 'advanced-iframe'), 'hide_elements', __('This setting allows you to hide elements when the iframe is shown. This can be used to hide the sidebar or the heading. Usage: If you want to hide a div you have to enter a hash (#) followed by the id e.g. #sidebar. If you want to hide a heading which is a &lt;h2&gt; you have to enter h2. You can define several elements separated by , e.g. #sidebar,h2. This gives you a lot more space to show the content of the iframe. To get the id of the sidebar go to Appearance -> Editor -> Click on \'Sidebar\' on the right side. Then look for the first \'div\' you find. The id of this div is the one you need. For some common templates the id is e.g. #menu, #sidebar, or #primary. For Twenty Ten and iNove you can remove the sidebar directly: Page attributes -> Template -> no sidebar. Wordpress default: \'#sidebar\'. I recommend using firebug (see below) to find the elements and the ids. You can use any valid jQuery selector pattern here! Shortcode attribute: hide_elements=""', 'advanced-iframe'));
echo '</table><p>';               
       _e('With the following 2 options you can modify the css of your parent page. The first option defines the id/class/element you want to modify and at the 2nd option you define the styles you want to change.', 'advanced-iframe');            
echo '</p><table class="form-table">';       
        
        printTextInput($devOptions, __('Content id', 'advanced-iframe'), 'content_id', __('Some templates do not use the full width for their content and even most \'One column, no sidebar Page Template\' templates only remove the sidebar but do not change the content width. Set the e.g. id of the div starting with a hash (#) that defines the content.  You can use any valid jQuery selector pattern here! In the field below you then define the style you want to overwrite. For Twenty Ten and WordPress Default the id is #content, for iNove it is #main. You can also define more than one element. Please separate them by | and provide the styles below. Please read the note below how to find this id for other templates. #content|h2 means that you want to set a new style for the div content and the heading h2 below. Shortcode attribute: content_id=""', 'advanced-iframe'));
        printTextInput($devOptions, __('Content styles', 'advanced-iframe'), 'content_styles', __('Define the styles that have to be overwritten to enable the full width. Most of the time you have to modify some of the following attributes: width, margin-left, margin-right, padding-left. Please use ; as separator between styles. If you have defined more than one element above (Content id) please separate the different style sets with |. The default values are: Wordpress default: \'width:450px;padding-left:45px;\'. Twenty Ten: \'margin-left:20px;margin-right:240px\'. iNove: \'width:605px\'. Read the note below how to find these styles for other templates. If you have defined #content|h2 at the Content id you can e.g. set \'width:650px;padding-left:25px;|padding-left:15px;\'. Shortcode attribute: content_styles=""', 'advanced-iframe'));
      ?>                    
    </table>      <br id="howtoid" />                 
    <p>                      
      <?php _e('<strong>How to find the id and the attributes:</strong><ol><li>Manually: Go to Appearance -> Editor and select the page template. Then you have to look which div elements are defined. e.g. container, content, main. Also classes can be defined here. Then you have to select the style sheet below and search for this ids and classes and look which one does define the width of you content.</li><li>Firebug: For Firefox you can use the plugin firebug to select the content element directly in the page. On the right side the styles are always shown. Look for the styles that set the width or any bigger margins. These are the values you can then overwrite by the settings above.</li><li><strong>Small jquery help</strong><br>Above you have to use the jQuery syntax:<p><ul><li>- tags - if you want to hide/modify a tag directly (e.g. h1, h2) simply use it directly e.g. h1,h2</li><li>- id - if you want to hide/modify an element where you have the id use #id</li><li>- class - if you want to hide/modify an element where you have the class use .class</li></ul></p>For more complex selectors please read the jQuery documentation.</li></ol>', 'advanced-iframe'); ?>                    
    </p>                  
    <p>                          
      <input id="so" class="button-primary" type="submit" name="update_iframe-loader" value="<?php _e('Update Settings', 'advanced-iframe') ?>"/>                  
    </p>             
    <div id="icon-options-general" class="icon_ai">                      
      <br>              
    </div><h2>              
      <?php _e('Show only a part of the iframe', 'advanced-iframe'); ?></h2>  
       <h3><?php _e('Options if the iframe is on a different OR the same domain', 'advanced-iframe') ?></h3>         
<?php if ($evanto) { ?>
    <p>              

<?php _e('You can only show a part of the iframe. This solution DOES WORK across domains without any hacks! This is a solution that works only with css by placing a window over the iframe which does a clipping. All areas of the iframe that are not inside the window cannot be seen. Please specify the upper left corner coordinates x and y and the height and width that should be shown. Specify a fixed height and width in the iframe options at the top for optimal results! Simply select the area you want to show with the graphical area selector! Please go to the <a target="_blank" href="http://www.tinywebgallery.com/blog/advanced-iframe/advanced-iframe-pro-demo">demo</a> for some working examples. Please also check the 5 options below. These are the advanced features to handle changes in the iframe', 'advanced-iframe');

echo '<p><input id="s" class="button-primary" type="button" name="update_iframe-loader" onclick="openSelectorWindow(\''. site_url() .'/wp-content/plugins/advanced-iframe/includes/advanced-iframe-area-selector.html\');" value="';
 _e('Open the area selector', 'advanced-iframe');
echo '" /></p>';


echo '<table class="form-table">';
     printTrueFalse($devOptions, __('Show only part of the iframe', 'advanced-iframe'), 'show_part_of_iframe', __('Show only part of the iframe. You have to enable this to use all the options below. Please read the text above. Shortcode attribute: show_part_of_iframe="true" or show_part_of_iframe="false" ', 'advanced-iframe'));
     printNumberInput($devOptions, __('Upper left corner x', 'advanced-iframe'), 'show_part_of_iframe_x', __('Specifies the x coordinate of the upper left corner of the view window. Enter the x-offset from the left border of your external iframe page you want to show. Shortcode attribute: show_part_of_iframe_x=""', 'advanced-iframe'));
     printNumberInput($devOptions, __('Upper left corner y (top distance)', 'advanced-iframe'), 'show_part_of_iframe_y', __('Specifies the y coordinate of the upper left corner.  Enter the y-offset from the top border of your external iframe page you want to show. Shortcode attribute: show_part_of_iframe_y=""', 'advanced-iframe')); 
     printNumberInput($devOptions, __('Width of the visible content', 'advanced-iframe'), 'show_part_of_iframe_width', __('Specifies the width of the content in pixel that should be shown. Shortcode attribute: show_part_of_iframe_width=""', 'advanced-iframe'));
     printNumberInput($devOptions, __('Height of the visible content', 'advanced-iframe'), 'show_part_of_iframe_height', __('Specifies the height of the content in pixel that should be shown. Shortcode attribute: show_part_of_iframe_height=""', 'advanced-iframe')); 
     echo '</table>'; 
     
        
echo '<p>';               
       _e('With the following 5 options you can do something when the page in the iframe does change. The parent page does only know the url of the iframe that is loaded initially. This is a browser restriction when the pages are not on the same domain. The parent only can find out when the page inside does change. But it does not know to which url. So the options below rely on a counting of the onload event. But for certain solutions (e.g. show only the login part of a page and then open the result page as parent) this will work.', 'advanced-iframe');            
echo '</p><table class="form-table">';
 
    printTextInput($devOptions, __('Change the viewport when iframe changes to the next step', 'advanced-iframe'), 'show_part_of_iframe_next_viewports', __('You can define different viewports when the page inside the iframe does change and a onload event is fired. Each time this event is fired a different viewport is shown. A viewport is defined the following way: left,top,width,height e.g. 50,100,500,600. You can define several viewports (if you e.g. have a staright workflow) by seperating the viewports by ; e.g. 50,100,500,600;10,40,200,400. Shortcode attribute:  show_part_of_iframe_next_viewports=""', 'advanced-iframe'));    
    printTrueFalse($devOptions, __('Restart the viewports from the beginning after the last step.', 'advanced-iframe'), 'show_part_of_iframe_next_viewports_loop', __('If you define different viewports it could make sense always to use them in a loop. E.g. if you have an image gallery where you have an overview with viewport 1 and a detail page with viewport 2. And you can only can come from the overview to the detail page and back. Shortcode attribute: show_part_of_iframe_next_viewports_loop="true" or show_part_of_iframe_next_viewports_loop="false" ', 'advanced-iframe'));    
    printTextInput($devOptions, __('Open iFrame in new window after the last step', 'advanced-iframe'), 'show_part_of_iframe_new_window', __('You can define if the iframe is opened in a new tab/window or as full window. the options you can use are "_top" = as full window, "_blank" = new tab/window or you leave it blank to stay in the iframe. Because of the browser restriction not the current url of the iframe can be loaded. It is either the initial one or the one you specify in the next setting. Shortcode attribute: show_part_of_iframe_new_window="", show_part_of_iframe_new_window="_top" or show_part_of_iframe_new_window="_blank" ', 'advanced-iframe'));   
    printTextInput($devOptions, __('Url that is opened after the last step', 'advanced-iframe'), 'show_part_of_iframe_new_url', __('You can define the url that is loaded after the last step. This enables you to jump to a certain page after your workflow. This is useful with the above. Shortcode attribute: show_part_of_iframe_new_url="" ', 'advanced-iframe'));       
    printTrueFalse($devOptions, __('Hide the iframe after the last step', 'advanced-iframe'), 'show_part_of_iframe_next_viewports_hide', __('Hides the iframe after the last step completely. Shortcode attribute: show_part_of_iframe_next_viewports_hide="true" or show_part_of_iframe_next_viewports_hide="false" ', 'advanced-iframe'));
echo '</table>';       
           ?>      
      <p>                          
        <input id="onload" class="button-primary" type="submit" name="update_iframe-loader" value="<?php _e('Update Settings', 'advanced-iframe') ?>"/>                  
      </p>         
    </p>
    <?php } else { ?>
    <p>
     <?php _e('This feature is only available in the Pro version where you have the option to show only a part of the iframe even when the content you want to include is on a different domain. Please note that there is still no way to modify anything on the remote site.', 'advanced-iframe') ?>
    </p>
    <?php } ?>    
    <h3 id="modifycontent"><?php _e('Modify the content of the iframe if the iframe page is on the same domain', 'advanced-iframe') ?></h3>     
    <p>                      
      <?php _e('With the following options you can modify the content of the iframe. <strong>IMPORTANT</strong>: This is only possible if the iframe comes from the <strong>same domain</strong> because of the <a href="http://en.wikipedia.org/wiki/Same_origin_policy" target="_blank">same origin policy</a> of Javascript.<p>If you can use the <a href="#xss">workaround</a> like described below you can also use this setting if you upgrade to the pro version.</p>Please read the section "<a href="#howtoid">How to find the id and the attributes</a>" above how to find the right styles. If the content comes from a different domain you have to modify the iframe page by e.g. adding a Javascript function that is then called by the onload function you can set above or you add a parameter in the url that you can read in the iframe and display the page differently then.', 'advanced-iframe'); ?>                    
    </p>                  
    <table class="form-table">          
<?php
        printTextInput($devOptions, __('Hide elements in iframe', 'advanced-iframe'), 'iframe_hide_elements', __('This setting allows you to hide elements inside the iframe. This can be used to hide a border or a heading. Usage: If you want to hide a div you have to enter a hash (#) followed by the id e.g. #header. If you want to hide a heading which is a &lt;h2&gt; you have to enter h2. You can define several elements separated by , e.g. #header,h2. I recommend using firebug to find the elements and the ids. You can use any valid jQuery selector pattern here! Shortcode attribute: iframe_hide_elements=""', 'advanced-iframe'));
        printTextInput($devOptions, __('Show only one element', 'advanced-iframe'), 'onload_show_element_only', __('You can define which part of the page should be shown in the iframe. You can define the id (e.g. #id) or the class (.class) which should be shown. Be aware that all other elements below the body are removed! So if your css relies on a certain structure you have to add additional css by "Content id in iframe" below. Very often also a background is defined for the header which you should remove below. e.g. by setting background-image: none; in the body. This can be done at "Content id in iframe" and "Content styles in iframe" below. Shortcode attribute: onload_show_element_only=""', 'advanced-iframe'));        
echo '</table>';    
echo '<p>';               
       _e('With the following 2 options you can modify the css of your iframe if <strong>it is on the same domain</strong>. The first option defines the id/class/element you want to modify and at the 2nd option you define the styles you want to change.', 'advanced-iframe');            
echo '</p><table class="form-table">';
        
        printTextInput($devOptions, __('Content id in iframe', 'advanced-iframe'), 'iframe_content_id', __('Set the id of the element starting with a hash (#) that defines element you want to modify the css.  You can use any valid jQuery selector pattern here! In the field below you then define the style you want to overwrite. You can also define more than one element. Please separate them by | and provide the styles below. Please read the note below how to find this id for other templates. #content|h2 means that you want to set a new style for the div content and the heading h2 below. Shortcode attribute: iframe_content_id=""', 'advanced-iframe'));
        printTextInput($devOptions, __('Content styles in iframe', 'advanced-iframe'), 'iframe_content_styles', __('Define the styles that have to be overwritten to enable the full width. Most of the time you have to modify some of the following attributes: width, margin-left, margin-right, padding-left. Please use ; as separator between styles. If you have defined more than one element above (Content id in iframe) please separate the different style sets with |. The default values are: Wordpress default: \'width:450px;padding-left:45px;\'. Twenty Ten: \'margin-left:20px;margin-right:240px\'. iNove: \'width:605px\'. Please read the note below how to find these styles for other templates. If you have defined #content|h2 at the Content id you can e.g. set \'width:650px;padding-left:25px;|padding-left:15px;\'. Shortcode attribute: iframe_content_styles=""', 'iframe_advanced-iframe'));
      ?>                    
    </table>                    
    <p>                          
      <input id="rt" class="button-primary" type="submit" name="update_iframe-loader" value="<?php _e('Update Settings', 'advanced-iframe') ?>"/>                  
    </p>                                   
    <div id="icon-options-general" class="icon_ai">                      
      <br>              
    </div><h2>                
      <?php _e('Resize the iframe to the content height/width ', 'advanced-iframe') ?></h2>          <h3>
      <?php _e('Options if the iframe is on the same domain', 'advanced-iframe') ?></h3>                  
    <p><?php _e('PLEASE READ THIS FIRST:', 'advanced-iframe') ?>                   
    </p>                  
    <p><?php _e('Only if the content from the iframe comes from the <strong>same domain</strong> it is possible that the onload attribute can execute Javascript directly which does e.g. resize the iframe to the height of the content or scroll the parent window to the top. <br /> If this is the case you can use the settings below. If you want to include an iframe from a different domain please read the how-to "Enabling cross-site scripting XSS via an iframe" below where I explain how this can be done if you can modify the web site that should be included. So if you are on a different domain and cannot edit the external iframe page no interaction between parent and iframe is possible!', 'advanced-iframe') ?>                      
    </p>                  
    <table class="form-table">          
<?php
        printTextInput($devOptions, __('Onload', 'advanced-iframe'), 'onload', __('Enter the \'onload\' script of the iframe you want to execute. You can enter Javascript that is executed when the iframe is loaded. Please check the following settings first! There you find a solution for iframe resize and one for scrolling the parent to the top. Please note that the output is escaped for security reasons with the Wordpress function esc_js. So please define your Javascript functions in your parent page, read all needed parameters inside the functions and call this function here. I recommend to use only the following characters: a-zA-Z_0-9();. Also note that the 2 settings below also use the onload event. So if you set them to true the code is appended to your onload function. If you like a different order of the predefined functions (aiShowElementOnly(id,element); aiResizeIframe(this); and aiScrollToTop();) please set the settings below to \'No\' and enter them here directly. Shortcode attribute: onload=""', 'advanced-iframe'));
  
        printTrueFalse($devOptions, __('Resize iframe to content height', 'advanced-iframe'), 'onload_resize', __('If you like that the iframe is resized to the height of the content you should set this to \'Yes\'. Please note that this is done by Javascript! So if a user has Javascript deactivated or a not supported browser the iframe does not get resized. Please set the height of the iframe to the minimum pixels the iframe should have! Some web pages use 100% of the height. Specifying a too big value as height does not gives you the expected result. This setting generates the code onload="aiResizeIframe(this);" to the iframe. Shortcode attribute: onload_resize="true" or onload_resize="false" ', 'advanced-iframe'));
        printHeightTrueFalse($devOptions, __('Store height in cookie', 'advanced-iframe'), 'store_height_in_cookie', __('If you enable the dynamic resize the value is calculated each time when the page is loaded. So each time it took a little time until the resize of the iframe is done. And this is visible sometimes if the content page loads very slow or is on a different domain or depends on the browser. By enabling this option the last calculated height is stored in a cookie and available right away. The iframe is then first resized to this height and later on when the new height comes it is updated. By default this is disabled because when you have dynamic content in the iframe it is possible that the iframe does not shrink. So please try this setting with your destination page. If you use several iframes please don\'t use this because currently only one cookie is supported. Shortcode attribute: store_height_in_cookie="true" or store_height_in_cookie="false" ', 'advanced-iframe'));
        printHeightNumberInput($devOptions, __('Additional height', 'advanced-iframe'), 'additional_height', __('If you like that the iframe is higher than the calculated value you can add some extra height here. This number is then added to the calculated one. This is e.g. needed if one of your tested browsers displays a scrollbar because of 1 or 2 pixel. Or you have an invisible area that is shown by the click on a button that can increase the size of the page. This option is NOT possible when "Store height in cookie" is enabled because this would cause that the height will increase at each reload of the parent page. If you use several iframes please use the same setting for all of them because there is only one global variable. Shortcode attribute: additional_height=""', 'advanced-iframe'));
        printTrueFalse($devOptions, __('Resize iframe to content width', 'advanced-iframe'), 'onload_resize_width', __('If you like that the iframe is resized to the width of the content you should set this to \'Yes\'. Please note that this is done by Javascript and only in combination with resizing the content height! So if a user has Javascript deactivated or a not supported browser the iframe does not get resized. This setting generates the code onload="aiResizeIframe(this, \'true\');" to the iframe. Shortcode attribute: onload_resize_width="true" or onload_resize_width="false" ', 'advanced-iframe'));
        
        printNumberInput($devOptions, __('Resize on AJAX events', 'advanced-iframe'), 'resize_on_ajax', __('If you like that the iframe is resized after each AJAX event in the iframe please enter a number here. Otherwise leave this field empty. The number is the timeout in milliseconds until the resize is called. This setting intercepts the AJAX call after the callback was executed. So for many pages 0 should work fine. But if you have e.g. a slide down effect you should add the time here to get the full height. Currently only jQuery and direct XMLHttpRequest are supported as AJAX calls on the included page! See the "AJAX events are jQuery" setting. This setting does only work on the SAME domain by default. If you like to get this working across different domains you have to extract the code from the plugin and add it to your remote page. Shortcode attribute: resize_on_ajax=""', 'advanced-iframe'));
        printTrueFalse($devOptions, __('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;AJAX events are jQuery', 'advanced-iframe'), 'resize_on_ajax_jquery', __('Currently only direct XMLHttpRequest and jQuery AJAX call can be intercepted. Please select true = jQuery, false = XMLHttpRequest. Shortcode attribute: resize_on_ajax_jquery="true" or resize_on_ajax_jquery="false" ', 'advanced-iframe'));
        printNumberInput($devOptions, __('Resize on click events', 'advanced-iframe'), 'resize_on_click', __('If you like that the iframe is resized after clicks  in the iframe please enter the timeout here. Otherwise leave this field empty. The number is the timeout in milliseconds untill the resize is called. This setting intercepts the clicks on the element specified below. Catching happens BEFORE the actuall action on e.g. the link. Therefore you need to enter a number > 0 because the original action is done later. 100 is a good value to start with! If you have e.g. a slide down effect you should add the time here it takes to get the full height. This setting does only work on the SAME domain by default. If you like to get this working across different domains you have to extract the code from the plugin and add it to your remote page. Shortcode attribute: resize_on_click=""', 'advanced-iframe'));
        printTextInput($devOptions, __('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Elements where the clicks<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;are intercepted', 'advanced-iframe'), 'resize_on_click_elements', __('You can define the tags and ids where the clicks should be intercepted. By default all links "a" are intercepted. To define a specific id you have to add the id with a :. So intercepting all links with the id "testid" you have to enter "a:testid". The id you specify is compared with "contains". So if you use "a:test" all links with an id containing test are intercepted. You can add several tags separated by ",". So "a:test,button:submitid" would work fine. Always try to specify the elements as exactly as possible to avoid any problems with other Javascript on the site. If you leave this field empty resize on click events is NOT enabled at all! Shortcode attribute: resize_on_click_elements=""', 'advanced-iframe'));

                          ?>                    
    </table>  
    <p>                          
      <input class="button-primary" type="submit" name="update_iframe-loader" value="<?php _e('Update Settings', 'advanced-iframe') ?>"/>                  
    </p> 
    <div id="xss"></div>
    <br />                     
    <p><h3>                 
        <?php _e('Solution if the iframe is NOT on the same domain: Enabling cross-site scripting XSS via an iframe', 'advanced-iframe') ?></h3>                 
<?php _e('<p><b>You need to be able to modify the external web page you want to have in the iframe to use the workaround!</b></p>

      <a href="#" onclick="jQuery(\'#details-workaround\').show(); return false;" >Show me more infos how this works.</a>

      <div id="details-workaround" >If the parent site and the iframe site are NOT on the same domain it is only possible to do the above stuff by including an additional iframe to the remote page which than can call a script on the parent domain that can then access the functions there. A detailed documentation how this works is described here:                
      <p>                 
        <a target="_blank" href="http://www.codecouch.com/2008/10/cross-site-scripting-xss-using-iframes/">http://www.codecouch.com/2008/10/cross-site-scripting-xss-using-iframes</a> - This plugin does wrap everything that is described there. Simple follow the steps below.                   
      </p>The following steps are needed:                
      <ol>                 
                       
        <li>The parent page has a Javascript function that resizes the iframe         
        </li>                 
        <li>The external iframe page has an additional hidden iframe, an onload attribute at the body and a javascript function         
        </li>                 
        <li>A page on the parent domain does exist that is included by the hidden iframe that calls the function on the parent page         
        </li>               
      </ol></div>', 'advanced-iframe');
      
      _e('
      <p>Everything is already prepared that you need on the parent domain. For the remote page the Javascript file ai_external.js is generated when you save the settings which you have to include into your external iframe page:       
      </p>                         
      <ol>
        <li>Add the following Javascript to the <b>external web page</b> you want to have in the iframe (The optimal place is before the &lt;/body&gt; if possible):', 'advanced-iframe') ?>        
        <p>&lt;script src="<?php echo site_url(); ?>/wp-content/plugins/advanced-iframe/js/ai_external.js"&gt;&lt;/script&gt;</p>
            <p> 
     <a href="#" onclick="jQuery('#details-javascript').show(); return false;" ><?php _e('Show me what the Javascript does', 'advanced-iframe') ?></a>
     <div id="details-javascript" >   
<?php _e('
    The Javascript does the following:
         <ol>
           <li>Adds "aiUpdateIframeHeight()" to the onload event of the page</li>
           <li>Modifies the remote iframe page (pro version only)
       ', 'advanced-iframe');
    if ($evanto) {
        _e(' - <a href="#mirp">Please see below how to configure this</a>.', 'advanced-iframe');  
    } 
    _e('</li>
           <li>Adds the iframe dynamically</li>
           <li>Adds a wrapper div below the body if needed</li>
           <li>Removes any margin, padding from the body</li>
           <li>Adds a temporary overflow:hidden to the body to avoid scrollbars</li>  
         </ol>
          ', 'advanced-iframe');      
    ?> 
    </div>   
    </p>                                   
        </li>                                  
        <li>        
<?php 
_e('<strong>Check if the wordpress site url (var domain=) in this file points to your wordpress root.</strong>. Click ', 'advanced-iframe'); 
echo '<a href="'. site_url() .'/wp-content/plugins/advanced-iframe/js/ai_external.js" target="_blank">';
_e('here', 'advanced-iframe');
echo '</a> ';
_e('to open this file and check the variable <b>domain</b> at the top. If not please set the correct url in the file ai_external.template.js. If the file ai_external.js cannot be generated replace the place holders in ai_external.template.js manually and use this file.', 'advanced-iframe'); 
?>        
        </li>
        <li>
          <?php _e('Enable the workarounds you want to use below.', 'advanced-iframe'); ?>
        </li>                                            
      </ol>                                           
    </p>  
      <table class="form-table">          
<?php
        printTrueFalse($devOptions, __('Enable the height workaround', 'advanced-iframe'), 'enable_external_height_workaround', __('Enable the height workaround in the generated Javascript file. If you want to use several iframes please use the description below for configuration. This settings only works if you have included the Javascript to the remote page.<br>IMPORTANT: If you set this setting to true the settings from "Options if the iframe is on the same domain" and "Modify the content of the iframe if the iframe page is on the same domain" are disabled. The settings of ""Modify the content of the iframe if the iframe page is on the same domain" are used in the pro version in the external workaround. These settings would generated Javascipt security errors if set for an external domain! Shortcode attribute: enable_external_height_workaround="false". The shortcode can only be used to enable the disabled functionality describe before!', 'advanced-iframe'), "false");
        printTrueFalse($devOptions, __('Keep overflow:hidden after resize', 'advanced-iframe'), 'keep_overflow_hidden', __('By default overflow:hidden (removes any scrollbars inside the iframe) is set during the resize to avoid scrollbars and is removed afterwards to allow scrollbars if e.g. the content changes because of dynamic elements. If you set this setting to true the overflow:hidden is not removed and any scrollbars are not shown. This is e.g. helpful if the page is still to wide! If you want to use several iframes please use the description below for configuration. These settings only works if you have included the Javascript to the remote page. This setting cannot be set by a shortcode. Please see below.', 'advanced-iframe'), "false");
        printTrueFalse($devOptions, __('Hide the iframe until it is completely modified.', 'advanced-iframe'), 'hide_page_until_loaded_external', __('This setting hides the iframe until the external workaround is completely done. This prevents that you see the original site before any modifications. The normal "Hide the iframe until it is loaded" shows the iframe after all modifications are done which are all done by a local script. This way cannot be used for the external workaround because the exact time when the external modifications are done is unknown. Therefore the external workaround does call iaShowIframe after all modifications are done. This setting cannot be set by a shortcode. Please see below. Shortcode attribute: hide_page_until_loaded_external="true", hide_page_until_loaded_external="false". Make sure that if you use different settings on different iframes the value of the shortcode matches the setting you make below because otherwise the iframe is not hidden.', 'advanced-iframe'), "false");
        
    ?></table>
    <?php _e('<strong>Please note:</strong> If you change the settings above make sure to do a full reload the page in the iframe!', 'advanced-iframe') ?>
     <p>                          
      <input id="onload" class="button-primary" type="submit" name="update_iframe-loader" value="<?php _e('Update Settings', 'advanced-iframe') ?>"/>                  
    </p>             
    <p>
      <?php _e('Please test with <strong>all</strong> browsers! If the wrapper div is needed (It has a transparent border of 1px!) and it causes layout problems you have to remove the wrapper div in the Javascript file and you have to measure the body. The alternative solution is stored as comment in the Javascript file. The Javascript file is regenerated each time you save the settings on this page.<br />The workaround only supports one iframe on one page currently.', 'advanced-iframe') ?>
    </p> 
    <?php
    if ($evanto) {
     _e('
    <h3 id="mirp">How to configure the "Modifies the remote iframe page" options</h3>
    <p>
    The configuration which is rendered by default to the Javascript is the one you enter in the settings above at <a href="#modifycontent">"Modify the content of the iframe if the iframe page is on the same domain"</a>.
    </p>', 'advanced-iframe'); 
    }
    _e('
    <h3 id="mirp">How to configure the workaround to work with different settings for different iframes</h3>
    <p>
        The file ai_external.js is created when you save the settings. 
        If you want to have different settings for different pages you can define the parameters which are used 
        in the script before you include the file ai_external.js.
    <p>
    <p>The following parameters can be used:
       <ul>
          <li>&nbsp;&nbsp;&nbsp;- iframe_id - By default the id from the settings are used. If you want to use several iframes on the same page with the external workaround you need to specify the id from the shortcode.</li> 
         <li>&nbsp;&nbsp;&nbsp;- updateIframeHeight - Enable/disable the resize height workaround. Valid values are "true", "false".</li>    
         <li>&nbsp;&nbsp;&nbsp;- keepOverflowHidden - Enable/disable if the overflow:hidden is kept. Valid values are "true", "false".</li>
          <li>&nbsp;&nbsp;&nbsp;- hide_page_until_loaded_external - Enable/disable that the page is hidden until fully modified. Valid values are "true", "false".</li>    
      ', 'advanced-iframe'); 
    if ($evanto) {
      _e('
          <li>&nbsp;&nbsp;&nbsp;- iframe_hide_elements - See <a href="#modifycontent">Hide elements in iframe</a>.</li>
          <li>&nbsp;&nbsp;&nbsp;- onload_show_element_only - See <a href="#modifycontent">Show only one element</a></li>
          <li>&nbsp;&nbsp;&nbsp;- iframe_content_id - See <a href="#modifycontent">Content id in iframe</a></li>
          <li>&nbsp;&nbsp;&nbsp;- iframe_content_styles - See <a href="#modifycontent">Content styles in iframe</a></li>    
     ', 'advanced-iframe');
    }  
      _e('    
      </ul>
     <p>An example would look like this:
     </p>
     <p>
        &lt;script&gt;<br />
        &nbsp;&nbsp;&nbsp;var updateIframeHeight = "true";<br />
        &nbsp;&nbsp;&nbsp;var keepOverflowHidden = "false";<br />
        &nbsp;&nbsp;&nbsp;var hide_page_until_loaded_external = "true";<br />
        &lt;/script&gt;<br /> 
      ', 'advanced-iframe') ?>  
        &lt;script src="<?php echo site_url(); ?>/wp-content/plugins/advanced-iframe/js/ai_external.js"&gt;&lt;/script&gt;                              
        </p>  
    </p>
    <p><?php _e('Important: If you want to include one external page into more than one iframe only one configuration for the external page is possible. You need to include the script from every parent page that the rezize callback is done properly. If you have different configurations they overwrite each other and you will get an unexpected result. If you need more complex configurations like this I recommend to get the professional support offered for this plugin because then an indivitual solution has to be designed and a custom version of the plugin would be <span id="ad">needed</span>.', 'advanced-iframe') ?></p>
    <div id="icon-options-general" class="icon_ai">                      
      <br>              
    </div>    <h2>        
      <?php _e('Add additional files', 'advanced-iframe') ?></h2>                  
    <p>                      
      <?php _e('For some features in iframes additional css or js files are needed in the parent page. E.g. for the newest version of lytebox this is needed. Each of the files do get a version number which is randomly changed each time you save the settings. So if you change the ccs or the js file you should save the settings to make sure your users to get the new version right away and not a chached one.', 'advanced-iframe'); ?>                    
    </p>                  
    <table class="form-table">          
<?php
        printTextInput($devOptions, __('Additional css', 'advanced-iframe'), 'additional_css', __('If you want to include an additional css into the parent page please specify the path to this file here. The css file will be added into the header of the page. You can specify a full or relative url. If you specify a relative one /style.css means that the style.css is located in the main directory of Wordpress. Start relative urls with /. Shortcode attribute: additional_css=""', 'advanced-iframe'));
        printTextInput($devOptions, __('Additional js', 'advanced-iframe'), 'additional_js', __('If you want to include an additional Javascript into the parent page please specify the path to this file here. The Javascript will be added after the iframe or if you use Wordpress >= 3.3 in the footer section. You can specify a full or relative url. If you specify a relative one /javascript.js means that the javascript.js is located in the main directory of Wordpress. Start relative urls with /. Shortcode attribute: additional_js=""', 'advanced-iframe'));
                          ?>                    
    </table>                  
    <p>                          
      <input id="ic" class="button-primary" type="submit" name="update_iframe-loader"                    value="<?php _e('Update Settings', 'advanced-iframe') ?>"/>                  
    </p>         
    <div id="icon-options-general" class="icon_ai">                      
      <br>              
    </div>    <h2>              
      <?php _e('Include content directly', 'advanced-iframe'); ?></h2>          
    <p>              
<?php _e('You can also include content directly with jQuery. The page is loaded and the part you specify below is included by Javascript into the page. The cool thing is that you can specify an id or a class which specify the content area that should be included. This feature does only work if the page is loaded from the <strong>SAME</strong> domain. If you use the setting below no iframe is used anymore. So only include stuff that is for display only.<br/>Please note: Loading the external content is done after the page is fully loaded and takes some time. Therefore some extra settings below are possible to make the integration as invisible as possible. The included div has the id ai_temp_&gt;iframe_name&lt;. So if you need to overwrite some css you can put it in an extra file and add this in the section "Additional files" ', 'advanced-iframe');
echo '<table class="form-table">';
     printTextInput($devOptions, __('Include url', 'advanced-iframe'), 'include_url', __('Enter the full URL to your page you want to include. e.g. http://www.tinywebgallery.com. If you specify this then the page is included directly, the iframe settings above are not used and no iframe is included. Shortcode attribute: include_url=""', 'advanced-iframe'));
     printTextInput($devOptions, __('Include content', 'advanced-iframe'), 'include_content', __('You can specify an id or a class which specify the content area that should be included. For an id please use e.g. #id, for a class use .class. Shortcode attribute: include_content=""', 'advanced-iframe')); 
     printNumberInput($devOptions, __('Include height', 'advanced-iframe'), 'include_height', __('You can specify the height of the content that should be included. If you do this the space for the content is already reserved and this prevents that you maybe see when the page gets updated. You should specify the value in px. Shortcode attribute: include_height=""', 'advanced-iframe'));
     printNumberInput($devOptions, __('Include fade', 'advanced-iframe'), 'include_fade', __('You can specify a fade in time that is used when the content is done loading. If you leave this setting entry the content is shown right away. If you specify a time in milliseconds then this content is faded in in the given time. This does sometimes looks nicer than if the content suddenly appears. Shortcode attribute: include_fade=""', 'advanced-iframe'));
     printTrueFalse($devOptions, __('Hide page until include is loaded', 'advanced-iframe'), 'include_hide_page_until_loaded', __('If you like to hide the whole page until the extra content is loaded you should set this to \'Yes\'. You should test this setting and decide what looks best for you. Shortcode attribute: include_hide_page_until_loaded="true" or include_hide_page_until_loaded="false" ', 'advanced-iframe'));
 echo '</table>';    
    
           ?>      
      <p>                          
        <input id="onload" class="button-primary" type="submit" name="update_iframe-loader"                    value="<?php _e('Update Settings', 'advanced-iframe') ?>"/>                  
      </p>        <br />            
    </p>                  
    <div id="icon-options-general" class="icon_ai">                      
      <br>              
    </div>    <h2>              
      <?php _e('Wordpress Flash Uploader, TinyWebGallery, Joomla Flash Uploader', 'advanced-iframe'); ?></h2>          
    <p>              
      <?php _e('This plugin is the extract for the iframe wrapper which was written for the TinyWebGallery. I needed an iframe wrapper that could do more than simply include a page. It needed to pass parameters to the iframe and modify the template on the fly to get more space for TWG. If you want to integrate TWG please use the "TinyWebGallery wrapper". It offers specific features only needed for the gallery. I hope this standalone wrapper is useful for other Wordpress users as well.', 'advanced-iframe'); ?>            
    </p>          
    <p>              
      <?php _e('Please take a look at my other projects: Wordpress Flash Uploader, TinyWebGallery, Joomla Flash Uploader or TWG Flash Uploader. If you like TWG or one of my other projects like JFU, WFU or TFU you should consider registering,  because you can use all products with one single license, get all features of the gallery and a complete upload solution as well.', 'advanced-iframe'); ?>            
    </p>          
    <p>              
      <?php _e('Please go <a href="http://www.tinywebgallery.com" target="_blank">www.tinywebgallery.com</a> for details.', 'advanced-iframe'); ?>            
    </p>  
<?php
if ($devOptions['donation_bottom'] === 'true') {
  printDonation($devOptions);
}
    ?>         
  </form>    
</div>            
<?php 
}
/**
 *  Prints a simple true/false radio selection
 */ 
function printTrueFalse($options, $label, $id, $description, $default = 'false') {
     if (!isset($options[$id])) {
      $options[$id] = $default;
    }
    
    echo '
      <tr valign="top">
      <th scope="row">' . $label . '</th>
      <td>
      ';
    echo '<input type="radio" id="' . $id . '" name="' . $id . '" value="true" ';
    if ($options[$id] == "true") {
        echo 'checked="checked"';
    }
    echo ' /> ' . __('Yes', 'advanced-iframe') . '&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" id="' . $id . '" name="' . $id . '" value="false" ';
    if ($options[$id] == "false") {
        echo 'checked="checked"';
    }
    echo '/> ' . __('No', 'advanced-iframe') . '<br>
    <p class="description">' . $description . '</p></td>
    </tr>
    ';
}
/**
 *  Prints the input field for the scrolling settings 
 */ 
function printAutoNo($options, $label, $id, $description) {
    echo '
      <tr valign="top">
      <th scope="row">' . $label . '</th>
      <td>
      ';
    echo '<input type="radio" id="' . $id . '1" name="' . $id . '" value="auto" ';
    if ($options[$id] == "auto") {
        echo 'checked="checked"';
    }
    echo ' /> ' . __('Yes', 'advanced-iframe') . '&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" id="' . $id . '2" name="' . $id . '" value="no" ';
    if ($options[$id] == "no") {
        echo 'checked="checked"';
    }
    echo '/> ' . __('No', 'advanced-iframe') . '&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" id="' . $id . '3" name="' . $id . '" value="none" ';
    if ($options[$id] == "none") {
        echo 'checked="checked"';
    }
    echo '/> ' . __('Not rendered', 'advanced-iframe') . '<br>
    <p class="description">' . $description . '</p></td>
    </tr>
    ';
}
/**
 *  Prints a default input field that acepts only numbers and does a validation
 */ 
function printTextInput($options, $label, $id, $description, $type = 'text') {
    if (empty($options[$id])) {
        $options[$id] = '';
    }
    echo '
      <tr valign="top">
      <th scope="row">' . $label . '</th>
      <td>
      <input name="' . $id . '" type="' . $type . '" size="90" id="' . $id . '" value="' . esc_attr($options[$id]) . '"  /><br>
      <p class="description">' . $description . '</p></td>
      </tr>
      ';
}
/**
 *  Prints an input field that acepts only numbers and does a validation
 */ 
function printNumberInput($options, $label, $id, $description, $type = 'text') {
    if (!isset($options[$id])) {
      $options[$id] = 'false';
    }
    echo '
      <tr valign="top">
      <th scope="row">' . $label . '</th>
      <td>
      <input name="' . $id . '" type="' . $type . '" size="90" id="' . $id . '" onblur="aiCheckInputNumber(this)" value="' . esc_attr($options[$id]) . '"  /><br>
      <p class="description">' . $description . '</p></td>
      </tr>
      ';
}
/**
 *  Prints an true false radio field for the height
 */
function printHeightTrueFalse($options, $label, $id, $description) {
    echo '
      <tr valign="top">
      <th scope="row">' . $label . '</th>
      <td>
      ';
    echo '<input onclick="aiDisableHeight();" type="radio" id="' . $id . '" name="' . $id . '" value="true" ';
    if ($options[$id] == "true") {
        echo 'checked="checked"';
    }
    echo ' /> ' . __('Yes', 'advanced-iframe') . '&nbsp;&nbsp;&nbsp;&nbsp;<input onclick="aiEnableHeight();"  type="radio" id="' . $id . '" name="' . $id . '" value="false" ';
    if ($options[$id] == "false") {
        echo 'checked="checked"';
    }
    echo '/> ' . __('No', 'advanced-iframe') . '<br>
    <p class="description">' . $description . '</p></td>
    </tr>
    ';
}

/**
 *  Prints an input field for the height that acepts only numbers and does a validation
 */ 
function printHeightNumberInput($options, $label, $id, $description, $type = 'text') {
    if (!isset($options[$id])) {
      $options[$id] = 'false';
    }
    
    $disabled = '';
    if ($options['store_height_in_cookie'] == 'true') {
       $disabled = ' readonly="readonly" ';
       $options[$id] = '0'; 
    }
    
    echo '
      <tr valign="top">
      <th scope="row">' . $label . '</th>
      <td>
      <input ' . $disabled . ' name="' . $id . '" type="' . $type . '" size="90" id="' . $id . '" onblur="aiCheckInputNumber(this)" value="' . esc_attr($options[$id]) . '"  /><br>
      <p class="description">' . $description . '</p></td>
      </tr>
      ';
}
?>