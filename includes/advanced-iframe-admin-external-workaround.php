<?php if ($devOptions['accordeon_menu'] == 'false') { ?>
<div class="ai-anchor" id="xss"></div>
<?php } ?>
<h1 id="h1-xss"><?php _e('External workaround: Howto enable cross domain resize and modification', 'advanced-iframe') ?></h1>
<div>
        <div id="icon-options-general" class="icon_ai">
      <br>
    </div><h2>
      <?php _e('External workaround: Howto enable cross domain resize and modification', 'advanced-iframe') ?></h2>  
      <h3><?php _e('Use this solution if the iframe is NOT on the same domain and you want features like auto height and css modifications.', 'advanced-iframe') ?></h3>
    <p><?php _e('The external workaround does enable many features which are not possible directly because of cross domain security restrictions. It is done by including a Javascript file (ai_exernal.js) to the iframe page which is generated dynamically with your settings. Please follow the instructions below. In the advanced tab are already many settings marked with ', 'advanced-iframe');
    echo renderExternalWorkaroundIcon(true);
    _e('. This means that this setting is saved to the ai_exernal.js', 'advanced-iframe') ?>
    </p>
    
        
<?php _e('<p><b>You need to be able to modify the external web page you want to have in the iframe to use the workaround!</b></p>

      <p><a href="#" onclick="jQuery(\'#details-workaround\').show(); return false;" >Show me more infos how this works.</a></p>

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
      
       if (!file_exists($script_name)) {
        echo '<p class="shortcode hide-print">';
        _e('The file ai_external.js is not generated yet. Please save the configuration once to create this file.', 'advanced-iframe');
        echo '</p>';
      }
      

      _e('
      <p>Everything is already prepared that you need on the parent domain. For the remote page the Javascript file ai_external.js is generated when you save the settings which you have to include into your external iframe page:
      </p>
      <ol>
        <li>Add the following Javascript to the <b>external web page</b> you want to have in the iframe (The optimal place is before the &lt;/body&gt; if possible. Otherwise put it in the head section. NEVER place it just after the &lt;body&gt; as than the height of the script element would be measured!):', 'advanced-iframe') ?>
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
     <p>
     <?php 
      _e('<strong>Please note:</strong> All settings here and also in the other sections which are marked with a ', 'advanced-iframe');
      echo renderExternalWorkaroundIcon(true);
      _e(' are saved to the external ai_external.js workaround file! ', 'advanced-iframe');
      ?>
     </p>
      <table class="form-table">
<?php
        printTrueFalse($devOptions, __('Resize remote iframe to content height', 'advanced-iframe'), 'enable_external_height_workaround', __('Enable the height workaround in the generated Javascript file. If you want to use several iframes please use the description below for configuration. This settings only works if you have included the Javascript to the remote page.<br>IMPORTANT: If you set this setting to true the settings from "Options if the iframe is on the same domain" and "Modify the content of the iframe if the iframe page is on the same domain" are disabled. The settings of ""Modify the content of the iframe if the iframe page is on the same domain" are used in the pro version in the external workaround. These settings would generated Javascipt security errors if set for an external domain! Shortcode attribute: enable_external_height_workaround="false". The shortcode can only be used to enable the disabled functionality describe before!', 'advanced-iframe'), "false",'http://www.tinywebgallery.com/blog/advanced-iframe/advanced-iframe-pro-demo/external-workaround-auto-height-and-css-modifications',true);
        printTrueFalse($devOptions, __('Keep overflow:hidden after resize', 'advanced-iframe'), 'keep_overflow_hidden', __('By default overflow:hidden (removes any scrollbars inside the iframe) is set during the resize to avoid scrollbars and is removed afterwards to allow scrollbars if e.g. the content changes because of dynamic elements. If you set this setting to true the overflow:hidden is not removed and any scrollbars are not shown. This is e.g. helpful if the page is still to wide! If you want to use several iframes please use the description below for configuration. These settings only works if you have included the Javascript to the remote page. This setting cannot be set by a shortcode. Please see below.', 'advanced-iframe'), "false",'http://www.tinywebgallery.com/blog/advanced-iframe/advanced-iframe-pro-demo/external-workaround-auto-height-and-css-modifications',true);
        printTrueFalse($devOptions, __('Hide the iframe until it is completely modified.', 'advanced-iframe'), 'hide_page_until_loaded_external', __('This setting hides the iframe until the external workaround is completely done. This prevents that you see the original site before any modifications. The normal "Hide the iframe until it is loaded" shows the iframe after all modifications are done which are all done by a local script. This way cannot be used for the external workaround because the exact time when the external modifications are done is unknown. Therefore the external workaround does call iaShowIframe after all modifications are done. Shortcode attribute: hide_page_until_loaded_external="true" or hide_page_until_loaded_external="false"', 'advanced-iframe'), "false",'http://www.tinywebgallery.com/blog/advanced-iframe/advanced-iframe-pro-demo/external-workaround-auto-height-and-css-modifications',true);
    if ($evanto) {
        printTrueFalse($devOptions, __('Write css directly', 'advanced-iframe'), 'write_css_directly', __('By default changes off the iframe are made by jQuery after the page is loaded. This is the only way this is possible if you do this directly. But with the external workaround it is now also possible that the style is written directly to the page. It is written where the ai_external.js is included. So if you use this option you need to include the ai_external.js as last element in the header. This setting has the advantage that the changes are not done after the page is loaded but when the browser renders the page initially. Also the page is not hidden until the page is fully modified. The settings "Hide elements in iframe" and "Modify content in iframe" are supported! This setting cannot be set by a shortcode. Please see below.', 'advanced-iframe'), "false", 'http://www.tinywebgallery.com/blog/advanced-iframe/advanced-iframe-pro-demo/resize-on-element-resize#e27',true);
        printTextInput($devOptions, __('Iframe redirect url', 'advanced-iframe'), 'iframe_redirect_url', __('If you like that the page you want to include can only be viewed in your iframe you can define the parent url here. If someone tries to open the url directly he will be redirected to this url. Existing parameters from the original url are added to the new url. You need to add the possible parameters to the "URL forward parameters" that they will be passed to the iframe again. This setting does use Javascript for the redirect. If Javascript is turned off the user can still access the site. If you also want to avoid this add "html {visibility:hidden;}" to the style sheet of your iframe page. Than the page is simply white. The Javascript does set the page visible after it is loaded!', 'advanced-iframe'), 'text', '',true);
        printTextInput($devOptions, __('Add the id to the url of the iframe', 'advanced-iframe'), 'pass_id_by_url', __('This feature adds the id of the iframe to the iframe url. The id is than extracted on the iframe and used as value for the callback to find the right iframe on the parent side. The static way is to set iframe_id (Please see below). The dynamic solution has to be used if you want to include the same page several times to the parent page (e.g. the page you include is called with different parameters and shows different content). You specify the parameter that is added to the url. So e.g. ai_id can be used. Allowed values are only a-zA-Z0-9_. Do NOT use any other characters. You need to set the parameter here or by setting iframe_url_id before you include ai_external.js. Please note the if you specify it here ALL shortcodes with use_shortcode_parameters_only="true" need pass_id_by_url to be set. See example 27 for a working setup. Shortcode: pass_id_by_url=""', 'advanced-iframe'), 'text', 'http://www.tinywebgallery.com/blog/advanced-iframe/advanced-iframe-pro-demo/resize-on-element-resize#e27',true);
     } 
    ?></table>
    <p>
    <?php _e('<strong>Please note:</strong> If you change the settings above I recommend to reload the iframe page in a different tab because otherwise the page is cached by many browsers!', 'advanced-iframe') ?>
    </p>
   
<?php if ($devOptions['single_save_button'] == 'false') { ?>
     <p class="button-submit">
      <input id="external-button" class="button-primary" type="submit" name="update_iframe-loader" value="<?php _e('Update Settings', 'advanced-iframe') ?>"/>
    </p>
<?php } ?>
    <p>
      <?php _e('Please test with <strong>all</strong> browsers! If the wrapper div is needed (It has a transparent border of 1px!) and it causes layout problems you have to remove the wrapper div in the Javascript file and you have to measure the body. The alternative solution is stored as comment in the Javascript file. The Javascript file is regenerated each time you save the settings on this page.', 'advanced-iframe') ?>
    </p>
    <?php
    if ($evanto) {
     _e('
    <h3 id="mirp">How to configure the "Modifies the remote iframe page" options</h3>
    <p>
    The configuration which is rendered by default to the Javascript is the one you enter in the settings of <a id="modify-content-link" href="#modifycontent">"Modify the content of the iframe if the iframe page is on the same domain"</a>.
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
    ', 'advanced-iframe');
    ?>  
    </p><p>
      <a href="#" onclick="jQuery('#all-parameters').show(); return false;" > <?php _e('Show me the parameters.', 'advanced-iframe') ?></a>
    </p>
      <?php
        _e('<div id="all-parameters">
       <ul class="ulli">
         <li>iframe_id - By default the id from the settings are used. If you want to use several iframes on the same page with the external workaround you need to specify the id from the shortcode.</li>
         <li>updateIframeHeight - Enable/disable the resize height workaround. Valid values are "true", "false".</li>
         <li>keepOverflowHidden - Enable/disable if the overflow:hidden is kept. Valid values are "true", "false".</li>
          <li>hide_page_until_loaded_external - Enable/disable that the page is hidden until fully modified. Valid values are "true". Needs only to be set on the remote site if you do not use auto height because otherwise no request is sent back!, "false".</li>
      ', 'advanced-iframe');
    if ($evanto) {
      _e('
          <li>iframe_hide_elements - See <a href="#modifycontent">Hide elements in iframe</a>.</li>
          <li>onload_show_element_only - See <a href="#modifycontent">Show only one element</a></li>
          <li>iframe_content_id - See <a href="#modifycontent">Content id in iframe</a></li>
          <li>iframe_content_styles - See <a href="#modifycontent">Content styles in iframe</a></li>
          <li>change_iframe_links - See <a href="#modifycontent">Change iframe links</a></li>
          <li>change_iframe_links_target - See <a href="#modifycontent">Change iframe links target</a></li>
          <li>onload_resize_delay - See <a href="#rt">Resize delay</a>. This setting is not stored in ai_external.js as default because if you enable the external workaround this setting is disabled above because of configuration inconsistencies! So this setting has to be done in the external page. e.g. var onload_resize_delay=100; means 100 ms resize delay. You also need this setting when you use the hidden tabs feature.</li>
          <li>iframe_redirect_url - Defines an url which is loaded if the page is not included in an iframe. See "Iframe redirect url" above.</li>
          <li>write_css_directly - See "Write css directly" above. Valid settings are write_css_directly="true" or write_css_directly="false". </li>
          <li>additional_js_iframe - The ai_external.js can also write additional Javscript. This is loaded at the end of ai_external.js. The advantage using this is that the Javascript is only loaded if the page is inside the iframe and is not loaded when accessed directly.</li>
          <li>additional_js_file_iframe - The ai_external.js can also load an additional Javascript file. This is loaded at the end of ai_external.js. The advantage using this is that the file is only loaded if the page is inside the iframe and is not loaded when accessed directly. Please note that the file is loaded asynchronously.</li>
          <li>resize_on_element_resize - See "Resize on element resize"</li> 
          <li>resize_on_element_resize_delay - See "Poll interval for the resize detection"</li> 
          <li>iframe_url_id - See "Add the id to the url of the iframe"</li> 
          <li>element_to_measure - You can define the element you want to measure + a offset for fix content. This is sometimes needed for some themes where e.g. chrome returns 0 as height. You need to specify a id. So no # is allowed here.</li> 
          <li>element_to_measure_offset - The offset for a fix content </li> 
          <li>add_iframe_url_as_param - See "Add iframe url as param"</li>
          <li>additional_styles_wrapper_div - Adds additional styles to the wrapper div. Depending on the html/css this is sometimes needed that the element can be measured correctly.</li>
          
          ', 'advanced-iframe');
          
    }
      _e('
      </ul>
      </div>
     <p>An example would look like this:
     </p>
     <p>
        &lt;script&gt;<br />
        &nbsp;&nbsp;&nbsp;var updateIframeHeight = "true";<br />
        &nbsp;&nbsp;&nbsp;var keepOverflowHidden = "false";<br />
        &lt;/script&gt;<br />
      ', 'advanced-iframe') ?>
        &lt;script src="<?php echo site_url(); ?>/wp-content/plugins/advanced-iframe/js/ai_external.js"&gt;&lt;/script&gt;  
    </p>
    <p><?php _e('Important: If you want to include one external page into more than one iframe only one configuration for the external page is possible. You need to include the script from every parent page that the resize callback is done properly. If you have different configurations they overwrite each other and you will get an unexpected result. If you need more complex configurations like this I recommend to get the professional support offered for this plugin because then an indivitual solution has to be designed and a custom version of the plugin would be needed.', 'advanced-iframe') ?></p>
    <?php if ($evanto) { ?>  
    <h3>
    <?php _e('New 6.3 - Config files for the external workaround', 'advanced-iframe') ?>
    </h3>
    <p>
    <?php _e('Defining the variables before the script has the disadvantage that you need to modify the html of the remote domain for every change and also the code there can get really big. Therefore it is now possible to use config files which are located on the parent server and loaded dynamically from the external_ai.js. Config files have to be placed in the folder "advanced-iframe-custom" in the plugin directory (This directory does not exist by default and is created if you use the create input filed below) and need to follow this naming convention: ai_external_config_&lt;config_id&gt;.js. This file does contain exactly the variables described before. Then you need to add the config_id as parameter to the external_ai.js like this:  ..../ai_external.js?config_id=&lt;config_id&gt;. The config_id can only contain alphanumeric characters, - and _.', 'advanced-iframe') ?>
    </p>
     <p>
    <?php _e('<strong>Please note</strong>: The folder "advanced-iframe-custom" is used because Wordpress does delete the whole plugin folder at an update and all your settings would be lost! If you delete the plugin completely you need to remove the folder "advanced-iframe-custom" manually if you don\'t want to keep this settings!', 'advanced-iframe') ?>
    </p>
     <p>
    <?php _e('You can also include the config file directly before the ai_external.js script. This gives you the same flexibility but you have to include 2 scripts. The performance including this directly is a little bit better because no internal loading has to be done!', 'advanced-iframe') ?>
    </p>
    
         <p>
     <a href="#" onclick="jQuery('#details-config').show(); return false;" ><?php _e('Show me the example above with a config file', 'advanced-iframe') ?></a>
     <div id="details-config" >
     <p>
<?php _e('In this example the config_id "example" is used.', 'advanced-iframe'); ?>
    </p>
    <ol>
    <li><?php _e('First create a file called "ai_external_config_example.js" in the folder "advanced-iframe-custom" of the plugin directoy (or create the file below) and save the following lines there:<br />
        &nbsp;&nbsp;&nbsp;var updateIframeHeight = "true";<br />
        &nbsp;&nbsp;&nbsp;var keepOverflowHidden = "false";', 'advanced-iframe') ?><br />
    </li>
    <li>
      <?php _e('a. Add the parameter ?config_id=example to the external_ai.js', 'advanced-iframe') ?><br />
        &nbsp;&nbsp;&nbsp;&nbsp;&lt;script src="<?php echo site_url(); ?>/wp-content/plugins/advanced-iframe/js/ai_external.js?config_id=example"&gt;&lt;/script&gt;
        <br />
        or
        <br />
        b. &lt;script src="<?php echo site_url(); ?>/wp-content/plugins/advanced-iframe-custom/ai_external_config_example.js"&gt;&lt;/script&gt;<br />
        &nbsp;&nbsp;&nbsp;&nbsp;&lt;script src="<?php echo site_url(); ?>/wp-content/plugins/advanced-iframe/js/ai_external.js"&gt;&lt;/script&gt;
          
    </li>
    <li>  
    <?php _e('Done. Make sure that you refresh the browser cache if you make changes to your config file. <a href="http://www.tinywebgallery.com/blog/advanced-iframe/advanced-iframe-pro-demo/external-workaround-auto-height-and-css-modifications#e7" target="_blank">Example 7</a> shows a working setup.', 'advanced-iframe') ?>
    </li>
    </ol>
    </div>
    </p>
    <?php } ?>   
    <div class="hide-print">
    <h4><?php _e('Existing config files', 'advanced-iframe') ?></h4>
    <p><?php _e('The following configuration files do currently exist. Please note that you can view/edit this files with the plugin editor of Wordpress by clicking on the "Edit/View" link. Hover over the script you want to include and click 3 times fast to select it. Than add the line before your ai_external.js if you use the 2nd way to include the configuration.', 'advanced-iframe') ?> 
    </p>
<?php
  $config_files = array();
  foreach (glob(dirname(__FILE__) .'/../../advanced-iframe-custom/ai_external_config_*.js') as $filename) {
    $base = basename($filename);
    $base_url1 = site_url() . '/wp-admin/plugin-editor.php?file=advanced-iframe-custom%2F';
    $base_url2 = '&plugin=advanced-iframe%2Fadvanced-iframe.php';
    $config_files[] = $base ; 
  }
echo "<hr height=1>";
if (count($config_files) == 0) {
    echo "<ul><li>";
    _e('No custom configuration files found.', 'advanced-iframe');
    echo "</li></ul>";
} else {
  foreach ($config_files as $file) {
    echo '<div class="ai-external-config-label"><span class="config-list">' .$file .  '</span> &nbsp; <a href="'.$base_url1 . $file . $base_url2 .'">';
    _e('Edit/View', 'advanced-iframe');
    echo '</a>';
    $rid =  substr(basename($file, ".js"),19);
    echo ' &nbsp; <a class="confirmation post" href="options-general.php?page=advanced-iframe.php&remove-id='.$rid.'">';
    _e('Remove', 'advanced-iframe');
    echo '</a></div>';
    echo '<div class="ai-external-config">&lt;script src="' . site_url() . '/wp-content/plugins/advanced-iframe-custom/'.$file.'"&gt;&lt;/script&gt;</div>';
    echo '<br />';
  }
}
echo "<hr height=1>";
?>  
    <p><?php _e('Create a config file with the following id:', 'advanced-iframe') ?><br /><input name="ai_config_id" id="ai_config_id" type="text" size="20" maxlength="20" /> 
      <input id="ccf" class="button-primary" type="submit" name="create-id" value="<?php _e('Create config file', 'advanced-iframe') ?>"/>
    </p>
    </div>
</div>