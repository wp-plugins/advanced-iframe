<?php
/* 
Advanced iframe
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
if (is_user_logged_in() && is_admin()) {
    $devOptions = $this->getAdminOptions();
// print_r($devOptions);
    if (isset($_POST['update_iframe-loader'])) { //save option changes
        $adminSettings = array('securitykey', 'src', 'width', 'height', 'scrolling',
            'marginwidth', 'marginheight', 'frameborder', 'transparency',
            'content_id', 'content_styles', 'hide_elements', 'class',
            'shortcode_attributes', 'url_forward_parameter', 'id', 'name', 
            'onload', 'onload_resize', 'onload_scroll_top', 
            'additional_js', 'additional_css', 'store_height_in_cookie', 'additional_height',
            'iframe_content_id', 'iframe_content_styles', 'iframe_hide_elements', 'version_counter',
            'onload_show_element_only'
            );
        if (!wp_verify_nonce($_POST['twg-options'], 'twg-options')) die('Sorry, your nonce did not verify.');
        foreach ($adminSettings as $item) {
             if ($item == 'version_counter') {
                $text = rand(100000, 999999); 
             } else {
                $text = trim($_POST[$item]);
             }
             // replace ' with "
             $text = str_replace("'", '"' ,$text);
             if (function_exists('sanitize_text_field')) {
                $devOptions[$item] = stripslashes(sanitize_text_field($text));
             } else {
                 $devOptions[$item] = stripslashes($text);
             }
        }
        update_option($this->adminOptionsName, $devOptions);
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
<div class="wrap">        
  <form method="post" action="options-general.php?page=advanced-iframe.php">             
    <?php wp_nonce_field('twg-options', 'twg-options'); ?>              
    <div id="icon-options-general" class="icon_ai">                   
      <br>             
    </div>        <h2>               
      <?php _e('Advanced iframe default settings', 'advanced-iframe'); ?></h2>             
    <p>               
      <?php _e('This plugin will include any content an advanced iframe. Please enter the url and the size you want to include your page. You have a couple of additional default options which help to integrate your site better into your template. You can overwrite all of these settings by specifying the parameter in the shortcode. Please read the documentation after each field about the parameter you have to use.', 'advanced-iframe'); ?>              
    </p>             
    <p>               
      <?php _e('Please use the following shortcode to include a page to your page: ', 'advanced-iframe'); ?> <strong>[advanced_iframe securitykey="<?php echo $devOptions['securitykey']; ?>"]</strong>             
    </p>             
    <table class="form-table">         
<?php
        printTextInput($devOptions, __('Security key', 'advanced-iframe'), 'securitykey', __('This is the security key which has to be used in the shorttag. This is mandatory because otherwise anyone who can create an article can insert a gallery as well.  The default security key was randomly generated during installation. Please change the key if you like. You should use this in combination with e.g. Page security to make sure that only the users you define can modify pages.', 'advanced-iframe'));
        printTrueFalse($devOptions, __('Allow shortcode attributes', 'advanced-iframe'), 'shortcode_attributes', __('Allow to set attributes in the shortcode. All of the attributes can be overwritten in the shortcode if you set \'Yes\'. Otherwise the settings you specify here are used.', 'advanced-iframe'));
        printTextInput($devOptions, __('Url', 'advanced-iframe'), 'src', __('Enter the full URL to your page. e.g. http://www.tinywebgallery.com. Shortcode attribute: src=""', 'advanced-iframe'));
        printNumberInput($devOptions, __('Width', 'advanced-iframe'), 'width', __('The width of the iframe. You can specify the value in px or in %. If you don\'t specify anything px is assumed.  Shortcode attribute: width=""', 'advanced-iframe'));
        printNumberInput($devOptions, __('Height', 'advanced-iframe'), 'height', __('The height of the iframe. You can specify the value in px or in %. If you don\'t specify anything px is assumed. Please note that % does most of the time does NOT give the expected result (e.g. 100% is only 150px) because the % are not from the iframe page but from the parent element. If you like something like that the iframe is resized to the content please read the \'<a href="#onload">Javascript iframe onload options</a>\' section below! Shortcode attribute: height=""', 'advanced-iframe'));
        printAutoNo($devOptions, __('Scrolling', 'advanced-iframe'), 'scrolling', __('Defines if scrollbars are shown if the page is too big for your iframe. Please note: If you select \'Yes\' IE does always show scrollbars on many pages! So only use this if needed. Shortcode attribute: scrolling="auto" or scrolling="no"', 'advanced-iframe'));
        printNumberInput($devOptions, __('Margin width', 'advanced-iframe'), 'marginwidth', __('The margin width of the iframe. You can specify the value in px. If you don\'t specify anything px is assumed.  Shortcode attribute: marginwidth=""', 'advanced-iframe'));
        printNumberInput($devOptions, __('Margin height', 'advanced-iframe'), 'marginheight', __('The margin height of the iframe. You can specify the value in px. If you don\'t specify anything px is assumed.  Shortcode attribute: marginheight=""', 'advanced-iframe'));
        printNumberInput($devOptions, __('Frame border', 'advanced-iframe'), 'frameborder', __('The frame border of the iframe. You can specify the value in px. If you don\'t specify anything px is assumed.  Shortcode attribute: frameborder=""', 'advanced-iframe'));
        printTrueFalse($devOptions, __('Transparency', 'advanced-iframe'), 'transparency', __('If you like that the iframe is transparent and your background is shown you should set this to \'Yes\'. If this value is not set then the iframe is transparent in IE but transparent in e.g. Firefox. So by default you should leave this to \'Yes\'. Shortcode attribute: transparency="true" or transparency="false" ', 'advanced-iframe'));
        printTextInput($devOptions, __('Class', 'advanced-iframe'), 'class', __('You can define a class for the iframe if you like. Shortcode attribute: class=""', 'advanced-iframe'));
        printTextInput($devOptions, __('URL forward parameters', 'advanced-iframe'), 'url_forward_parameter', __('Define the parameters that should be passed from the browser url to the iframe url. Please separate the parameters by \',\'. In e.g. TinyWebGallery this enables you to jump directly to an album or image although TinyWebGallery is included in an iframe. Shortcode attribute: url_forward_parameter=""', 'advanced-iframe'));
        // new 1.4
        printTextInput($devOptions, __('Id', 'advanced-iframe'), 'id', __('Enter the \'id\' attribute of the iframe. Shortcode attribute: id=""', 'advanced-iframe'));
        printTextInput($devOptions, __('Name', 'advanced-iframe'), 'name', __('Enter the \'name\' attribute of the iframe. Shortcode attribute: name=""', 'advanced-iframe'));
                    ?>              
    </table>             
    <p>                   
      <input class="button-primary" type="submit" name="update_iframe-loader" value="<?php _e('Update Settings', 'advanced-iframe') ?>"/>             
    </p>             <br />        <h3>      
      <?php _e('Advanced options', 'advanced-iframe') ?></h3>             
    <p>               
      <?php _e('With the following 3 options you can modify your template on the fly to give the iframe more space! At most templates you would have to create a page template with a special css and this is quite complicated. By using the options below your template is modified on the fly by jQuery. Please look at the screenshots to make these options more clear. The options are very useful for templates that have a top navigation because otherwise your menu is gone! If you still want to do this you should add a back link to the page. The examples below are for Twenty Ten, iNove and the default Wordpress theme.', 'advanced-iframe'); ?>              
    </p>             
    <table class="form-table">         
<?php
        printTextInput($devOptions, __('Hide elements', 'advanced-iframe'), 'hide_elements', __('This setting allows to hide elements when the iframe is shown. This can be used to hide the sidebar or the heading. Usage: If you want to hide a div you have to enter a hash (#) followed by the id e.g. #sidebar. If you want to hide a heading which is a &lt;h2&gt; you have to enter h2. You can define several elements separated by , e.g. #sidebar,h2. This gives you a lot more space to show the content of the iframe. To get the id of the sidebar go to Appearance -> Editor -> Click on \'Sidebar\' on the right side. Then look for the first \'div\' you find. The id of this div is the one you need. For some common templates the id is e.g. #menu, #sidebar, or #primary. For Twenty Ten and iNove you can remove the sidebar directly: Page attributes -> Template -> no sidebar. Wordpress default: \'#sidebar\'. I recommend to use firebug (see below) to find the elements and ids. You can use any valid jQuery selector pattern here! Shortcode attribute: hide_elements=""', 'advanced-iframe'));

echo '</table><p>';               
       _e('With the following 2 options you can modify the css of your parent page. The first option defines the id/class/element you want to modify and at the 2nd option you define the styles you want to change.', 'advanced-iframe');            
echo '</p><table class="form-table">';       
        
        printTextInput($devOptions, __('Content id', 'advanced-iframe'), 'content_id', __('Some templates do not use the full width for their content and even most \'One column, no sidebar Page Template\' templates only remove the sidebar but do not change the content width. Set the e.g. id of the div starting with a hash (#) that defines the content.  You can use any valid jQuery selector pattern here! In the field below you then define the style you want to overwrite. For Twenty Ten and WordPress Default the id is #content, for iNove it is #main. You can also define more than one element. Please separate them by | and provide the styles below. Please read the note below how to find this id for other templates. #content|h2 means that you want to set a new style for the div content and the heading h2 below. Shortcode attribute: content_styles=""', 'advanced-iframe'));
        printTextInput($devOptions, __('Content styles', 'advanced-iframe'), 'content_styles', __('Define the styles that have to be overwritten to enable the full width. Most of the time have to modify some of the following attributes: width, margin-left, margin-right, padding-left. Please use ; as separator between styles. If you have defined more than one element above (Content id) please separate the different style sets with |. The default values are: Wordpress default: \'width:450px;padding-left:45px;\'. Twenty Ten: \'margin-left:20px;margin-right:240px\'. iNove: \'width:605px\'. Read the note below how to find these styles for other templates. If you have defined #content|h2 at the Content id you can e.g. set \'width:650px;padding-left:25px;|padding-left:15px;\'. Shortcode attribute: content_styles=""', 'advanced-iframe'));
?>              
    </table> 
    <br id="howtoid" />            
    <p>               
      <?php _e('<strong>How to find the id and the attributes:</strong><ol><li>Manually: Go to Appearance -> Editor and select the page template. The you have to look with div elements are defined. e.g. container, content, main. Also classes can be defined here. Then you have to select the style sheet below and search for this ids and classes and look which one does define the width of you content.</li><li>Firebug: For Firefox you can use the plugin firebug to select the content element directly in the page. On the right side the styles are always shown. Look for the styles that set the width or any bigger margins. These are the values you can then overwrite by the settings above.</li><li><strong>Small jquery help</strong><br>Above you have to use the jQuery syntax:<p><ul><li>- tags - if you want to hide/modify a tag directly (e.g. h1, h2) simply use it directly e.g. h1,h2</li><li>- id - if you want to hide/modify an element where you have the id use #id</li><li>- class - if you want to hide/modify an element where you have the class use .class</li></ul></p>For more complex selectors please read the jQuery documentation.</li></ol>', 'advanced-iframe'); ?>              
    </p>             
    <p>                   
      <input id="onload" class="button-primary" type="submit" name="update_iframe-loader" value="<?php _e('Update Settings', 'advanced-iframe') ?>"/>             
    </p>        <br />                 <h3>      
      <?php _e('Javascript iframe onload options', 'advanced-iframe') ?></h3>             
    <p>         PLEASE READ THIS FIRST:              
    </p>             
    <p>Only if the content from the iframe comes from the <strong>same domain</strong> it is possible that the onload attribute can execute Javascript directly which does e.g. resize the iframe to the height of the content or scroll the parent window to the top. <br /> If this is the case you can use the settings below. If you want to include an iframe from a different domain please read the how-to "Enabling cross-site scripting XSS via an iframe" below where I explain how this can be done if you can modify the web site that should be included. So if you are on a different domain and cannot edit the iframe page no interaction between parent and iframe is possible!                 
    </p>             
    <table class="form-table">         
<?php
        printTextInput($devOptions, __('Onload', 'advanced-iframe'), 'onload', __('Enter the \'onload\' script of the iframe you want to execute. You can enter Javascript that is executed when the iframe is loaded. Please check the next 2 settings first! There you find a solution for iframe resize and one for scrolling the parent to the top. Please note that the output is escaped for security reasons with the Wordpress function esc_js. So please define your Javascript functions in your parent page, read all needed parameters inside the functions and call this function here. I recommend only to use the following characters: a-zA-Z_0-9();. Also note that the 2 settings below also use the onload event. So if you set them to true the code is appended to your onload function. If you like a different order of the predefined functions (aiShowElementOnly(id,element); aiResizeIframe(this); and aiScrollToTop();) please set the settings below to \'No\' and enter them here directly. Shortcode attribute: onload=""', 'advanced-iframe'));
        printTextInput($devOptions, __('Show only one element', 'advanced-iframe'), 'onload_show_element_only', __('You can define which part of the page should be shown in the iframe. You can define the id (e.g. #id) or the class (.class) which should be shown. Be aware that all other elements below the body are removed! So if your css relies on a certain structure you have to add additional css by "Content id in iframe" below. Very often also a background is defined for the header which you should remove below. e.g. by setting background-image: none; in the body. This can be done at "Content id in iframe" and "Content styles in iframe" below. Shortcode attribute: onload_show_element_only=""', 'advanced-iframe'));
   
        printTrueFalse($devOptions, __('Resize iframe to content height', 'advanced-iframe'), 'onload_resize', __('If you like that the iframe is resized to the height of the content you should set this to \'Yes\'. Please note that this is done by Javascript! So if a user has Javascript deactivated or a not supported browser the iframe does not get resized. Please set the height of the iframe to the minimum pixels the iframe should have! Some web pages use 100% of the height. Specifying a too big value as height does not gives you the expected result. This setting generates the code onload="aiResizeIframe(this);" to the iframe. Shortcode attribute: onload_resize="true" or onload_resize="false" ', 'advanced-iframe'));
        printHeightTrueFalse($devOptions, __('Store height in cookie', 'advanced-iframe'), 'store_height_in_cookie', __('If you enable the dynamic resize the value is calculated each time when the page is loaded. So each time it took a little time until the resize of the iframe is done. And this is visible sometimes if the content page loads very slow or is on a different domain or depends on the browser. By enabling this option the last calculated height is stored in a cookie and available right away. The iframe is then first resized to this height and later on when the new height comes it is updated. By default this is disabled because when you have dynamic content in the iframe it is possible that the iframe does not shrink. So please try this setting with your destination page. If you use several iframes please specify a different id for each iframe because the name of the cookie is ai-last-height-<id>. Shortcode attribute: store_height_in_cookie="true" or store_height_in_cookie="false" ', 'advanced-iframe'));
        printHeightNumberInput($devOptions, __('Additional height', 'advanced-iframe'), 'additional_height', __('If you like that the iframe is higher than the calculated value you can add some extra height here. This number is then added to the calculated one. This is e.g. needed if one of your tested browsers displays a scrollbar because of 1 or 2 pixel. Or you have an invisible area that is shown by the click on a button that can increases the size of the page. This option is NOT possible when "Store height in cookie" is enabled because this would cause that the height will increase at each reload of the parent page. Shortcode attribute: additional_height=""', 'advanced-iframe'));
        
        printTrueFalse($devOptions, __('Scrolls the parent window to the top', 'advanced-iframe'), 'onload_scroll_top', __('If you like that if you click on a link in the iframe and the parent page should scroll to the top you should set this to \'Yes\'. Please note that this is done by Javascript! So if a user has Javascript deactivated no scrolling is done.   This setting generates the code onload="aiScrollToTop();" to the iframe. If you select the resize iframe as well then onload="aiResizeIframe(this);aiScrollToTop();" is generated. If you like a different order please enter the javascript functions directly in the onload parameter in the order you like. Shortcode attribute: onload_scroll_top="true" or onload_scroll_top="false" ', 'advanced-iframe'));
                    ?>              
    </table> 
     <p>               
      <?php _e('With the following 3 options you can modify the content of the iframe. <strong>IMPORTANT</strong>: This is only possible if the iframe comes from the <strong>same domain</strong> because of the <a href="http://en.wikipedia.org/wiki/Same_origin_policy" target="_blank">same origin policy</a> of Javascript. Please read the section "<a href="#howtoid">How to find the id and the attributes</a>" above how to find the right styles. If the content comes from a different domain you have to modify the iframe page by e.g. adding a Javascript function that is then called by the onload function you can set above.', 'advanced-iframe'); ?>              
    </p>             
    <table class="form-table">         
<?php
        printTextInput($devOptions, __('Hide elements in iframe', 'advanced-iframe'), 'iframe_hide_elements', __('This setting allows to hide elements inside the iframe. This can be used to hide a border or a heading. Usage: If you want to hide a div you have to enter a hash (#) followed by the id e.g. #header. If you want to hide a heading which is a &lt;h2&gt; you have to enter h2. You can define several elements separated by , e.g. #header,h2. I recommend to use firebug to find the elements and ids. You can use any valid jQuery selector pattern here! Shortcode attribute: iframe_hide_elements=""', 'advanced-iframe'));
        
echo '</table><p>';               
       _e('With the following 2 options you can modify the css of your iframe if <strong>it is on the same domain</strong>. The first option defines the id/class/element you want to modify and at the 2nd option you define the styles you want to change.', 'advanced-iframe');            
echo '</p><table class="form-table">';
        
        printTextInput($devOptions, __('Content id in iframe', 'advanced-iframe'), 'iframe_content_id', __('Set the id of the element starting with a hash (#) that defines element you want to modify the css.  You can use any valid jQuery selector pattern here! In the field below you then define the style you want to overwrite. You can also define more than one element. Please separate them by | and provide the styles below. Please read the note below how to find this id for other templates. #content|h2 means that you want to set a new style for the div content and the heading h2 below. Shortcode attribute: iframe_content_styles=""', 'advanced-iframe'));
        printTextInput($devOptions, __('Content styles in iframe', 'advanced-iframe'), 'iframe_content_styles', __('Define the styles that have to be overwritten to enable the full width. Most of the time have to modify some of the following attributes: width, margin-left, margin-right, padding-left. Please use ; as separator between styles. If you have defined more than one element above (Content id in iframe) please separate the different style sets with |. The default values are: Wordpress default: \'width:450px;padding-left:45px;\'. Twenty Ten: \'margin-left:20px;margin-right:240px\'. iNove: \'width:605px\'. Please read the note below how to find these styles for other templates. If you have defined #content|h2 at the Content id you can e.g. set \'width:650px;padding-left:25px;|padding-left:15px;\'. Shortcode attribute: iframe_content_styles=""', 'iframe_advanced-iframe'));
?>              
    </table>               
    <p>                   
      <input class="button-primary" type="submit" name="update_iframe-loader" value="<?php _e('Update Settings', 'advanced-iframe') ?>"/>             
    </p>             
    <p>        <h4>        
        <?php _e('Enabling cross-site scripting XSS via an iframe', 'advanced-iframe') ?></h4> If the parent site and the iframe site are NOT on the same domain it is only possible to do the above stuff by including an additional iframe to the iframe page which runs again on the parent domain and can then access the functions there. A detailed documentation how this can be done is described here:                
      <p>                 
        <a target="_blank" href="http://www.codecouch.com/2008/10/cross-site-scripting-xss-using-iframes/">http://www.codecouch.com/2008/10/cross-site-scripting-xss-using-iframes</a>                  
      </p>The following steps are needed:                
      <ol>                 
        <li>Don't use the onload options above (cookie and additional height does work).         
        </li>                 
        <li>The parent page has a Javascript function that resized the iframe         
        </li>                 
        <li>The iframe page has an additional hidden iframe, an onload attribute at the body and a javascript function         
        </li>                 
        <li>A page on the parent domain does exist that is included by the hidden iframe that calls the function on the parent page         
        </li>               
      </ol>For that features 'resize' and 'scroll to top' I have already prepared everything that you need on the parent domain. Therefore 2. and 4. are already done :). For 3. you have to do the following changes in your page that is included in the iframe:       
      <br>                 
      <ol>                       
        <li> Add the following Javascript function to the header and <strong>check if the domain and wordpress root is correct</strong>!:                         
        <p>                   &lt;script type="text/javascript"&gt;<br />            	&nbsp;&nbsp;&nbsp;&nbsp;function updateIframeHeight() {<br />            	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;var iframe = document.getElementById('hiddenIframe');<br />            	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;var newHeight = parseInt(document.body.scrollHeight,10);<br />            	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;iframe.src = '           
          <?php echo site_url(); ?> /wp-content/plugins/advanced-iframe/js/iframe_height.html?height=' + newHeight;<br />            	&nbsp;&nbsp;&nbsp;&nbsp;}<br />            	&lt;/script&gt;                          
        </p>                         
        </li>                       
        <li>              Change &lt;body&gt; to &lt;body onload="updateIframeHeight()"&gt;:                        
        </li>                       
        <li>              Add the hidden iframe at the bottom of your body:                        
        <p>              &lt;iframe id="hiddenIframe" style="visibility:hidden;" width="0" height="0" src="           
          <?php echo site_url(); ?> /wp-content/plugins/advanced-iframe/js/iframe_height.html"&gt;Iframes not supported.&lt;/iframe&gt;                        
        </p>                       
        </li>                 
      </ol>                                      
    </p>             
    <p>        For the 'scroll to top' functionality please replace <strong>iframe_height.html</strong> with <strong>iframe_scroll.html</strong> and remove the height variable. In the plugin folder is an example.html where both examples are shown. For "Show only one element" you also have to rewrite the Javscript because it would remove the hidden iframe as well. The example should point you to the right direction if you like to do something simelar. 
    </p>          <h3>      
      <?php _e('Additional files', 'advanced-iframe') ?></h3>             
    <p>               
      <?php _e('For some features in iframes additional css or js files are needed in the parent page. E.g. for the newest version of lytebox this is needed. Each of the files do get a version number which is randomly changed each time you save the settings. So if you cange the ccs or the js file you should save the settings once to make sure your users to get the new version right away and not a chached one.', 'advanced-iframe'); ?>              
    </p>             
    <table class="form-table">         
<?php
        printTextInput($devOptions, __('Additional css', 'advanced-iframe'), 'additional_css', __('If you want to include an additional css into the parent page please specify the path to this file here. The css file will be added into the header of the page. You can specify a full or relative url. If you specify a relative one /style.css means that the style.css is located in the main directory of Wordpress. Start relative urls with /. Shortcode attribute: additional_css=""', 'advanced-iframe'));
        printTextInput($devOptions, __('Additional js', 'advanced-iframe'), 'additional_js', __('If you want to include an additional Javascript into the parent page please specify the path to this file here. The Javascript will be added after the iframe or if you use Wordpress >= 3.3 in the footer section. You can specify a full or relative url. If you specify a relative one /javascript.js means that the javascript.js is located in the main directory of Wordpress. Start relative urls with /. Shortcode attribute: additional_js=""', 'advanced-iframe'));
                    ?>              
    </table>             
    <p>                   
      <input id="onload" class="button-primary" type="submit" name="update_iframe-loader"                    value="<?php _e('Update Settings', 'advanced-iframe') ?>"/>             
    </p>        <br />       
  </form>         
  <div id="icon-options-general" class="icon_ai">                 
    <br>           
  </div>    <h2>         
    <?php _e('Wordpress Flash Uploader, TinyWebGallery, Joomla Flash Uploader', 'advanced-iframe'); ?></h2>       
  <p>         
    <?php _e('This plugin is the extract for the iframe wrapper which was written for the TinyWebGallery. I needed an iframe wrapper that could do more than simply include a page. It needed to pass parameters to the iframe and modify the template on the fly to get more space for TWG. If you want to integrate TWG please use the "TinyWebGallery wrapper". It offers specific features only needed for the gallery. I hope this standalone wrapper is useful for other Wordpress users as well.', 'advanced-iframe'); ?>        
  </p>       
  <p>         
    <?php _e('Please take a look at my other projects: Wordpress Flash Uploader, TinyWebGallery, Joomla Flash Uploader or TWG Flash Uploader. If you like TWG or one of my other projects like JFU, WFU or TFU you should consider to register because you can use all products with one single license and get all features of the gallery and a complete upload solution as well.', 'advanced-iframe'); ?>        
  </p>       
  <p>         
    <?php _e('Please go <a href="http://www.tinywebgallery.com" target="_blank">www.tinywebgallery.com</a> for details.', 'advanced-iframe'); ?>        
  </p>       
  <br>        
  <div id="icon-options-general" class="icon_ai">          
    <br>           
  </div>      <h2>Donate</h2>  
  <p>You like this plugin? Support the development with a small donation.   
  </p>  
  <p>    
    <A HREF="https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=paypal%40mdempfle%2ede&item_name=advanced%20iframe&item_number=Support%20Open%20Source&no_shipping=0&no_note=1&tax=0&currency_code=EUR&lc=EN&bn=PP%2dDonationsBF&charset=UTF%2d8">      
      <img src="../wp-content/plugins/wordpress-flash-uploader/img/btn_donate_LG.gif"></A>  
  </p>  
  </p>       
</div>           
<?php 
}
function printTrueFalse($options, $label, $id, $description) {
    echo '
      <tr valign="top">
      <th scope="row">' . $label . '</th>
      <td>
      ';
    echo '<input type="radio" id="' . $id . '" name="' . $id . '" value="true" ';
    if ($options[$id] == "true") {
        echo 'checked="checked"';
    }
    echo ' /> ' . __('Yes', 'advanced-iframe') . '&nbsp;&nbsp;<input type="radio" id="' . $id . '" name="' . $id . '" value="false" ';
    if ($options[$id] == "false") {
        echo 'checked="checked"';
    }
    echo '/> ' . __('No', 'advanced-iframe') . '<br>
    <em>' . $description . '</em></td>
    </tr>
    ';
}
function printAutoNo($options, $label, $id, $description) {
    echo '
      <tr valign="top">
      <th scope="row">' . $label . '</th>
      <td>
      ';
    echo '<input type="radio" id="' . $id . '" name="' . $id . '" value="auto" ';
    if ($options[$id] == "auto") {
        echo 'checked="checked"';
    }
    echo ' /> ' . __('Yes', 'advanced-iframe') . '&nbsp;&nbsp;<input type="radio" id="' . $id . '" name="' . $id . '" value="no" ';
    if ($options[$id] == "no") {
        echo 'checked="checked"';
    }
    echo '/> ' . __('No', 'advanced-iframe') . '<br>
    <em>' . $description . '</em></td>
    </tr>
    ';
}
function printTextInput($options, $label, $id, $description, $type = 'text') {
    echo '
      <tr valign="top">
      <th scope="row">' . $label . '</th>
      <td>
      <input name="' . $id . '" type="' . $type . '" size="90" id="' . $id . '" value="' . esc_attr($options[$id]) . '"  /><br>
      <em>' . $description . '</em></td>
      </tr>
      ';
}
function printNumberInput($options, $label, $id, $description, $type = 'text') {
    if (!isset($options[$id])) {
      $options[$id] = 'false';
    }
    echo '
      <tr valign="top">
      <th scope="row">' . $label . '</th>
      <td>
      <input name="' . $id . '" type="' . $type . '" size="90" id="' . $id . '" onblur="aiCheckInputNumber(this)" value="' . esc_attr($options[$id]) . '"  /><br>
      <em>' . $description . '</em></td>
      </tr>
      ';
}

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
    echo ' /> ' . __('Yes', 'advanced-iframe') . '&nbsp;&nbsp;<input onclick="aiEnableHeight();"  type="radio" id="' . $id . '" name="' . $id . '" value="false" ';
    if ($options[$id] == "false") {
        echo 'checked="checked"';
    }
    echo '/> ' . __('No', 'advanced-iframe') . '<br>
    <em>' . $description . '</em></td>
    </tr>
    ';
}

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
      <em>' . $description . '</em></td>
      </tr>
      ';
}

?>