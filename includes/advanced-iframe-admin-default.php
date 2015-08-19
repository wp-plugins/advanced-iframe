<?php if ($devOptions['accordeon_menu'] == 'false') { ?>
    <div class="ai-anchor" id="ds"></div>
<?php } ?>
    <h1 id="h1-ds">
    <?php _e('Basic settings', 'advanced-iframe'); ?>
    </h1> 
    <div>
    <div id="icon-options-general" class="icon_ai">
      <br>
    </div>
    <h2>
<?php _e('Basic settings', 'advanced-iframe'); ?></h2>
    <p class="hide-print">
      <?php _e('This plugin will include any content an advanced iframe. Please enter the url and the size you want to include your page. You have a couple of additional default options which help to integrate your site better into your template. You can overwrite all of these settings by specifying the parameter in the shortcode. Please read the documentation after each field about the parameter you have to use.', 'advanced-iframe'); ?>
    </p>
    <p class="shortcode hide-print">
      <?php _e('Please use the following shortcode to add an iframe to your page: ', 'advanced-iframe'); ?><br />
      <span> [advanced_iframe securitykey="<?php echo $devOptions['securitykey']; ?>"]
      </span>
      <?php if ($evanto) { ?> 
      <p class="hide-print">
      <?php _e('You can also generate a shortcode which does include all settings as shortcode attributes. This shortcode does not use any of the defaults.', 'advanced-iframe'); ?>
      <br /><input id="gen" class="button-primary" type="button" name="generate" value="Generate a shortcode for the current settings" onclick="aiGenerateShortcode(); jQuery('#jquery-gen').show(); return false;"  /></p>
      <div id="jquery-gen" class="hide-print">
      <p  class="hide-print">
      <?php _e('Copy the following shortcode to your page:', 'advanced-iframe'); ?>  
      </p>
      <p id="gen-shortcode"  class="hide-print">
          [advanced_iframe securitykey="<?php echo $devOptions['securitykey']; ?>"]
      </p>
      
      </div>
      <?php } ?>
      <p class="hide-print">
      <?php _e('Examples if you want to use several iframes with different settings. Also read the'); ?> <a target="_blank" href="http://www.tinywebgallery.com/blog/advanced-iframe/advanced-iframe-faq">FAQ</a>:
      </p>
      <ul class="hide-print">
      <li>[advanced_iframe securitykey="<?php echo $devOptions['securitykey']; ?>" src="http://www.tinywebgallery.com"] </li>
      <li>[advanced_iframe securitykey="<?php echo $devOptions['securitykey']; ?>" src="http://www.tinywebgallery.com" width="100%" height="600"]</li>
      <li>[advanced_iframe securitykey="<?php echo $devOptions['securitykey']; ?>" src="http://www.tinywebgallery.com" id="iframe1" name="iframe1" width="100%" height="600" ]</li>
      </ul>
      
    </p>
    <table class="form-table">
<?php
        printTextInput($devOptions, __('Security key', 'advanced-iframe'), 'securitykey', __('This is the security key which has to be used in the shorttag. This is mandatory because otherwise anyone who can create an article can insert an iframe.  The default security key was randomly generated during installation. Please change the key if you like. You should use this in combination with e.g. Page security to make sure that only the users you define can modify pages.', 'advanced-iframe'));
if ($evanto) {

 // create the help for userinfo
 global $current_user;
 get_currentuserinfo();
 $userinfo_html = __('Click <a href="#" id="user-help-link">here</a> for all values of the current user <span id="user-help">', 'advanced-iframe');
 $ovars = get_object_vars ($current_user->data);
 foreach ($ovars as $key => $value) {
    $userinfo_html .= $key . " => " . $value . "<br />";
 } 
 $userinfo_html .= '</span>';
 
 $all_meta_for_user = array_map( "aiFirstElement", get_user_meta( $current_user->ID  ) );
 
 $usermeta_html = __('Click <a href="#" id="user-meta-link">here</a> for all values of the current user.', 'advanced-iframe');
 $usermeta_html .= '<span id="meta-help">';
 foreach ($all_meta_for_user as $key => $value) {
    $usermeta_html .= $key . " => " . $value . "<br />";
 } 
 $usermeta_html .= '</span>';

        $src_text =  __('Enter the full URL to your page. e.g. http://www.tinywebgallery.com. <strong>Please do not use a different protocol for the iframe: Do not mix http and https if possible! Http pages are NOT shown in https pages.</strong> Please read <a href="http://www.tinywebgallery.com/blog/iframe-do-not-mix-http-and-https" target="_blank">this post</a> for details. If you cannot save the full url because of mod_security don\'t specify the protocoll (e.g. //www.tinywebgallery.com) or leave this field empty and define the src in the shortcode. Also use the free url checker below to make sure that you can include the page. You can also add parameters to this url like http://www.tinywebgallery.com/test.php?iframe=true. Then you can check this variable and use it to e.g. hide some elements in the iframe.<br />The pro version also has some placeholders (the standalone version has only host and port available) which are replaced on the fly: <br/>&nbsp;&nbsp;&nbsp;- {site}: the url to the wordpress root<br/>&nbsp;&nbsp;&nbsp;- {host}: the current host from the request<br/>&nbsp;&nbsp;&nbsp;- {port}: the current port from the request<br/>&nbsp;&nbsp;&nbsp;- {userid}: the id of the current user<br/>&nbsp;&nbsp;&nbsp;- {username}: the username of the current user<br/>&nbsp;&nbsp;&nbsp;- {useremail}: the e-mail of the current user<br/>&nbsp;&nbsp;&nbsp;- {adminmail}: the e-mail of the wordpress admin<br/>&nbsp;&nbsp;&nbsp;- {userinfo-X}: extract attribute X from get_currentuserinfo. E.g. {userinfo-display_name}. See <a href=" https://codex.wordpress.org/Function_Reference/get_currentuserinfo" target="_blank">here</a> for details. '. $userinfo_html.'<br/>&nbsp;&nbsp;&nbsp;- {usermeta-X}: extract key X from get_user_meta. E.g. {usermeta-last_name}. See <a href=" https://codex.wordpress.org/Function_Reference/get_user_meta" target="_blank">here</a> for details. '. $usermeta_html.'<br/>&nbsp;&nbsp;&nbsp;- {urlpathX}: the Xth path element from the front. The first path element would be {urlpath1}<br/>&nbsp;&nbsp;&nbsp;- {urlpath-X}: the Xth path element from behind. The last path element would be {urlpath-1}<br/>&nbsp;&nbsp;&nbsp;- {query-X}: the value of the query parameter sent by GET or POST. ?example=myvalue would be {query-example} -> myvalue<br/> <br />An example would be src="http://demo.{host}/url?id={userid}". Especially for multidomain installations this is maybe helpful. If no user is logged in the values are empty or 0 for the id.<br />urlpath does extract path elements from the url in the address bar. So {urlpath-1} for the url www.xx.com/a/bb/cc would be cc.<br /><strong>Also shortcodes are supported.</strong> You have to replace the bracket [ with {{ and ] with }}. So if the shortcode is [link] you have to use {{link}} because shortcode attributes which include shortcodes are not supported directly by Wordpress. Also be aware of single and double quotations: src="http://demo.{{url domain=\'home\'}}/url". So only use \' for attributes of the nested shortcode.<br /><strong>PDF support: </strong>If you include a pdf google doc is used to render the pdf. This solution looks the same on all browsers. If you want to use the native pdf renderer of the browser/your system add NATIVE: before the url. Like NATIVE:http://www.example.com/pdf.pdf.<br />Shortcode attribute: src=""', 'advanced-iframe');
} else {
        $src_text =  __('Enter the full URL to your page. e.g. http://www.tinywebgallery.com. <strong>Please do not use a different protocol for the iframe: Do not mix http and https if possible! Http pages are NOT shown in https pages.</strong> Please read <a href="http://www.tinywebgallery.com/blog/iframe-do-not-mix-http-and-https" target="_blank">this post</a> for details. If you cannot save the full url because of mod_security don\'t specify the protocoll (e.g. //www.tinywebgallery.com) or leave this field empty and define the src in the shortcode. Also use the free url checker below to make sure that you can include the page. You can also add parameters to this url like http://www.tinywebgallery.com/test.php?iframe=true. Then you can check this variable and use it to e.g. hide some elements in the iframe.', 'advanced-iframe');
}        

        printTextInput($devOptions, __('<b>Url</b>', 'advanced-iframe'), 'src', $src_text );
?>
      <tr>
        <th scope="row"><strong><?php _e('Free url checker', 'advanced-iframe'); ?></strong>
        </th>      <td>
          <?php _e('<strong>Not all pages</strong> can be included in an iframe because they have a header flag this does not allow this. Please use the free iframe checker to find out if the page you want to include does work on all browsers: <a target="_blank" href="http://www.tinywebgallery.com/blog/advanced-iframe/free-iframe-checker/">Free iframe checker</a>.', 'advanced-iframe'); ?></td>
      </tr>
<?php
        printNumberInput($devOptions, __('Width', 'advanced-iframe'), 'width', __('The width of the iframe. You can specify the value in px or in %. If you don\'t specify anything px is assumed. Pro user can also do basic calculations here if you have e.g. a fix left navigation on a page. e.g. 100%-200px. See <a target="_blank" href="http://caniuse.com/#feat=calc">http://caniuse.com/#feat=calc</a> for supported browsers! Shortcode attribute: width=""', 'advanced-iframe'));
        printNumberInput($devOptions, __('Height', 'advanced-iframe'), 'height', __('The height of the iframe. You can specify the value in px or in %. If you don\'t specify anything px is assumed. Please note that % does most of the time does NOT give the expected result (e.g. 100% is only 150px) because the % are not from the iframe page but from the parent element. If you like that the iframe is resized to the content please go to \'<a id="resize-same-link" href="#rt">Resize the iframe to the content height/width</a>\' if you are one hte same domain or the "<a id="external-workaround-link" href="#xss">External workaround</a>" if the iframe is on a diffent domain. Pro user can also do basic calculations here if you have e.g. a fix header or footer on a page. e.g. 100%-200px. See <a target="_blank" href="http://caniuse.com/#feat=calc">http://caniuse.com/#feat=calc</a> for supported browsers! Shortcode attribute: height=""', 'advanced-iframe'));
        printAutoNo($devOptions, __('Scrolling', 'advanced-iframe'), 'scrolling', __('Defines if scrollbars are shown if the page is too big for your iframe. Please note: If you select \'Yes\' IE does always show scrollbars on many pages! So only use this if needed. Scrolling "none" means that the attribute is not rendered at all and can be set by css to enable the scrollbars responsive.  Shortcode attribute: scrolling="auto" or scrolling="no" or scrolling="none"', 'advanced-iframe'));
        printNumberInput($devOptions, __('Margin width', 'advanced-iframe'), 'marginwidth', __('The margin width of the iframe. You can specify the value in px. If you don\'t specify anything px is assumed.  Shortcode attribute: marginwidth=""', 'advanced-iframe'));
        printNumberInput($devOptions, __('Margin height', 'advanced-iframe'), 'marginheight', __('The margin height of the iframe. You can specify the value in px. If you don\'t specify anything px is assumed.  Shortcode attribute: marginheight=""', 'advanced-iframe'));
        printNumberInput($devOptions, __('Frame border', 'advanced-iframe'), 'frameborder', __('The frame border of the iframe. You can specify the value in px. If you don\'t specify anything px is assumed.  Shortcode attribute: frameborder=""', 'advanced-iframe'));
        printTrueFalse($devOptions, __('Transparency', 'advanced-iframe'), 'transparency', __('If you like that the iframe is transparent and your background is shown you should set this to \'Yes\'. If this value is not set then the iframe is transparent in IE but transparent in e.g. Firefox. So by default you should leave this to \'Yes\'. Shortcode attribute: transparency="true" or transparency="false" ', 'advanced-iframe'));
        printTextInput($devOptions, __('Class', 'advanced-iframe'), 'class', __('You can define a class for the iframe if you like. Shortcode attribute: class=""', 'advanced-iframe'));
        
        if ($evanto) {
            $style_fs = '<br /><input type="button" onclick="aiPresetFullscreen(); return false;" value="Set settings for fullscreen iframe" name="presetFullscreen" class="button-primary" id="presetFullscreen" />';
        } else {
            $style_fs = '';  
        }
  
        printTextInput($devOptions, __('Style', 'advanced-iframe'), 'style', __('You can define styles for the iframe if you like. The recommended way is to put the styles in a css file and use the class option. With the button below the width, height, content_id, content_styles, hide_content_until_iframe_color and the needed styles above for a fullscreen iframe are set. Also check the settings at the height where you can do calculations to add fixed headers/footers. Shortcode attribute: style=""' . $style_fs , 'advanced-iframe'));

        printTextInput($devOptions, __('Id', 'advanced-iframe'), 'id', __('Enter the \'id\' attribute of the iframe. Allowed values are only a-zA-Z0-9_. Do NOT use any other characters because the id is also used to generate unique javascript functions! Other characters will be removed when you save! If a src directly in a shortcode is set and no id than an id is generated automatically if several iframes are on one page to avoid configuration problems. Shortcode attribute: id=""', 'advanced-iframe'));     
        printTextInput($devOptions, __('Name', 'advanced-iframe'), 'name', __('Enter the \'name\' attribute of the iframe. Shortcode attribute: name=""', 'advanced-iframe'));
        printTrueFalse($devOptions, __('Allow full screen', 'advanced-iframe'), 'allowfullscreen', __('allowfullscreen is an HTML attribute that enables videos to be displayed in fullscreen mode. Currently this is a new html attribute not supported by all browsers. So please check  all of the browsers you want to support. Shortcode attribute: allowfullscreen="true" or allowfullscreen="false"', 'advanced-iframe'));
                  
?>
    </table>
<?php if ($devOptions['single_save_button'] == 'false') { ?>
    <p class="button-submit">
      <input id="gs" class="button-primary" type="submit" name="update_iframe-loader" value="<?php _e('Update Settings', 'advanced-iframe') ?>"/>
    </p>
<?php } ?>    
</div>
