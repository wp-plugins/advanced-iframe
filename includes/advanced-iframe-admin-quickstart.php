<?php
/**
 *  Print the donation details depending on the version type
 */
function printDonation($devOptions, $evanto) {
if ($evanto) {
  if ($devOptions['accordeon_menu'] == 'false') { 
      echo '<div class="ai-anchor" id="qu"></div>
      ';
  }

  echo '<h1>';
       _e('Quickstart guide, display options, vote for the plugin on codecanyon', 'advanced-iframe');
      echo '</h1>
      <div>
      <div id="icon-options-general" class="icon_ai">
      <br>
      </div><h2>';
      _e('Advanced iFrame Pro - Quickstart guide, widget, plugin options, vote for the plugin on codecanyon', 'advanced-iframe');
  echo '</h2>';
  if (true) {
  _e('
   <h3>Warning: Illegal copies of Advanced iFrame Pro</h3>
   <p>
   Unfortuatelly for most good plugins on codecanyon also illegal versions can be found in the internet. Please make sure you got your version from codecanyon. Very often, this scripts will have modified code inserted into them which allows hackers to access your server. These are very dangerous to use! I already found hacked versions that do include backdoors!<br />
   </p><p>
   The only offical version of Advanced iFrame Pro can be found here: <a href="http://codecanyon.net/item/advanced-iframe-pro/5344999?ref=mdempfle" target="_blank">http://codecanyon.net/item/advanced-iframe-pro/5344999</a>  
   </p>
   <p>
   Thank you.
   </p>', 'advanced-iframe');
  }
_e('<h3>Quick start guide</h3>
 <p>
      <a href="http://www.tinywebgallery.com/blog/advanced-iframe/advanced-iframe-video-tutorials" target="_blank" id="vid" class="button-primary">Show me the quickstart video</a>    
</p>

<p>To include a web page to your page please check the following things first:</p>
<ul>
<li>- Check if your page you want to include is allowed to be included:<br />&nbsp;&nbsp;&nbsp;&nbsp;<a target="_blank" href="http://www.tinywebgallery.com/blog/advanced-iframe/free-iframe-checker">http://www.tinywebgallery.com/blog/advanced-iframe/free-iframe-checker</a>!</li>
<li>- Check if the iframe page and the parent page are one the same domain. www.example.com and text.example.com are different domains!</li>
<li>- Can you modify the page that should be included?</li>
</ul>
<p>Most likely you have one of the following setups:</p>
<ol>
<li>iframe cannot be included:  You cannot include the content because the owner does not allow this. </li>
<li>iframe can be included and you are on a different domain: See the <a href="http://www.tinywebgallery.com/blog/advanced-iframe/advanced-iframe-comparison-chart" target="_blank">feature comparison chart</a>. To resize the content to the height/width or modify css you <strong>need to modify the remote iframe page</strong> by adding one line of Javascript to enable the provided workaround.</li>
<li>Iframe can be included and you are on the same domain: All features of the plugin can be used.</li>
</ol>', 'advanced-iframe');

_e('<p>Advanced users that have their own server might also setup a reverse proxy if the iframe page is on a different domain and cannot use the external workaround. See <a href="http://www.tinywebgallery.com/blog/using-a-reverse-proxy-to-enable-all-features-of-advanced-iframe-pro" target="_blank">this blog</a> for details.<br />', 'advanced-iframe');
_e('If you mix http and https read <a href="http://www.tinywebgallery.com/blog/iframe-do-not-mix-http-and-https" target="_blank">this blog</a>. Parent https and iframe http does not work on all browsers!</p>', 'advanced-iframe');


    _e('<h3 class="hide-print">Advanced iFrame Pro Widget</h3><p class="hide-print">The pro version also does offer a widget where you can include the iframe. The usage is really simple. Go to Appearance -> Widgets and insert the shortcode you would normally put into a page into the text field of the "Advanced iFrame Pro Widget" .</p>', 'advanced-iframe' );
   
    _e('<h3>Vote for the plugin</h3><p>Thank you for getting Advanced iFrame Pro at Codecanyon.<br/>', 'advanced-iframe' );
    _e('Please feel free to leave an item rating from your items download page if you haven\'t already done so.</p>', 'advanced-iframe' );
    _e('<p>Please get in contact with me if you have problems because most of the issues are easy to solve. But at least tell me what you did not like so I can improve this. Also make sure that you took a look at the quick start guide to make sure the feature you like can be used!</p>', 'advanced-iframe' );
  
      _e('<h3 class="hide-print">Plugin options</h3>', 'advanced-iframe' );
  echo '<table class="form-table hide-print">';
      printTrueFalse($devOptions, __('Show this section as last tab/at the bottom', 'advanced-iframe'), 'donation_bottom', __('<strong class="move-bottom">Please move this section as last tab/to the bottom after you have read it.</strong>', 'advanced-iframe'));
      printTrueFalse($devOptions, __('Enable expert mode', 'advanced-iframe'), 'expert_mode', __('If you enable the expert mode the description is only shown if you click on the label of the setting. You see more settings at once but only one description at once. Also the padding between the table rows are reduced a lot. So you see a lot of more settings on one screen. Use this if you are common with the settings.', 'advanced-iframe'), 'false');
      printTrueFalse($devOptions, __('Use footer save button', 'advanced-iframe'), 'single_save_button', __('The new default is that the save button is in a sticky footer. I was testing this for all major browsers but not for all worpress versions. So if this does not work for your version set this to false to get one save button for each section.', 'advanced-iframe'), 'false');
      printAccordeon($devOptions, __('Use accordeon menu', 'advanced-iframe'), 'accordeon_menu', __('The accordeon menu does not show the different sections in one big page but does only show the sections you open. You can define the default section which is open by default here also. Sections do not close if you open another one because sometimes is is useful to open several sections at once. Also the quick jump links at the top are removed because they do not make sense then anymore. The menu is used after you saved this setting. Only important sections are offered in the dropdown.', 'advanced-iframe'), 'false');
      printTextInput($devOptions, __('Alternative shortcode', 'advanced-iframe'), 'alternative_shortcode', __('You can define an alternative shortcode the plugin should evaluate. This is e.g. useful if you chance/upgrade from iframe to advanced iframe (pro). Simply insert "iframe" in the text field. Most if the parameters do already match! Make sure to deactivate the other plugin that used the shortcode. With using iframe also the BBCode [iframe]url[/iframe] is supported. IMPORTANT: If you use this, security codes are NOT checked anymore. So anyone who can e.g. write a post can also insert an iframe!', 'advanced-iframe'));
      printTrueFalse($devOptions, __('Show plugin in main menu', 'advanced-iframe'), 'show_menu_link', __('Show the "Advanced iFrame Pro" Menu link also in the main menu. If set to "False" it is only shown in the settings menu.', 'advanced-iframe'), 'true');
 
      printTrueFalse($devOptions, __('Allow shortcode attributes', 'advanced-iframe'), 'shortcode_attributes', __('Allow to set attributes in the shortcode. All of the attributes can be overwritten in the shortcode if you set \'Yes\'. Otherwise the settings you specify here are used.', 'advanced-iframe'));
      printTrueFalse($devOptions, __('Use shortcode attributes only', 'advanced-iframe'), 'use_shortcode_attributes_only', __('All iframes you use in your pages use the settings below. With shortcode attributes you can overwrite these settings. When you use several iframes with different settings this can lead to strange behavior because you do not see the whole configuration in the shortcode. By setting this option to true only the parameters defined as attributes are used. So the minimum you need to define is: securitykey and src of the iframe. You can set this for a single iframe as well with the shortcode attribute use_shortcode_attributes_only="true". A minimal shortcode would then look like this: [advanced_iframe securitykey="', 'advanced-iframe') . $devOptions['securitykey'] . __('" use_shortcode_attributes_only="true" src="http://www.tinywebgallery.com"].  Shortcode attribute: use_shortcode_attributes_only="true" or use_shortcode_attributes_only="false"', 'advanced-iframe'));
      printTrueFalse($devOptions, __('Include ai.js in the footer', 'advanced-iframe'), 'include_scripts_in_footer', __('By default now the needed Javascripts are included at the footer. So you can include jQuery also at the footer if you like. If you like/need it in the header set this value to false. Before Wordpress 3.3 jQuery is needed in the header if you want to use lazy-loading! The ai.js has also to be in the footer if it should only be loaded when the shortcode is on the page. This setting cannot be set as shortcode!', 'advanced-iframe'));
      printTrueFalse($devOptions, __('Load jQuery as dependency', 'advanced-iframe'), 'load_jquery', __('By default jQuery is loaded as dependeny. If you have a theme or another plugin that does not stick to the Wordpress way to load the scripts you might have to disable the dependeny. This avoids that jQuery is loaded again and other plugins do maybe not work anymore.', 'advanced-iframe'), true);
      printTextInput($devOptions, __('Editor button', 'advanced-iframe'), 'editorbutton', __('With this setting you can add a "advanced iframe" button to the text editor of Wordpress. The button does add the shortcode with the current security code. So the default settings are used then. Currently only "securitykey" enables the button. All other settings don\'t  show the button right now. For further versions it is planned that you can define the attributes of the button here.', 'advanced-iframe'));     
        
  echo '</table><p>';
  echo '<p class="button-submit">
        <input class="button-primary" type="submit" name="update_iframe-loader" value="';
      _e('Update Settings', 'advanced-iframe');
  echo '"/></p>';

} else {

if ($devOptions['accordeon_menu'] == 'false') { 
    echo '<div class="ai-anchor" id="qu"></div>';
}

echo '<h1>';
    _e('Upgrading to Advanced iFrame Pro', 'advanced-iframe');
echo '</h1>
<div>
    <div id="icon-options-general" class="icon_ai">
    <br>
  </div><h2>';
  _e('Advanced iFrame - Upgrading to Advanced iFrame Pro', 'advanced-iframe');
  echo '</h2>
  <p>';
  _e('<p>Advanced iframe is <strong>free for personal use</strong> and the Pro version a bargain for your business. The personal version does already contain many of the cool features of the Pro version. It has a limit of 10.000 views a month which should normaly not been hit by a personal website.</p>', 'advanced-iframe' );

echo '<div id="first" class="signup_account_container signup_account_container_active" style="cursor: default;" title="';
_e('Free - For personal, non-commercial sites and blogs', 'advanced-iframe');
echo '">
			<div class="signup_inner">
				<div class="signup_inner_plan">';
        _e(' ', 'advanced-iframe');
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
        _e(' ', 'advanced-iframe');
        echo '</div>
				<div class="signup_inner_price">
					<strong>PRO</strong>
				</div>
				<div class="signup_inner_header">';
        _e('For commercial, business, and professional sites', 'advanced-iframe');
        echo '</div>
				<div class="signup_inner_desc">';
        _e('+ <a href="http://www.tinywebgallery.com/blog/advanced-iframe/advanced-iframe-comparison-chart" target="_blank">Many additional features!</a>', 'advanced-iframe');
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
           _e('<a href="http://www.tinywebgallery.com/blog/advanced-iframe/advanced-iframe-pro-demo/show-only-a-part-of-the-iframe" target="_blank">Show/Hide specific areas of the iframe</a> if the iframe is on a different domain<br /><a target="_blank" href="http://examples.tinywebgallery.com/configurator/advanced-iframe-area-selector.html">Show the graphical selector</a></li><li><a href="http://www.tinywebgallery.com/blog/advanced-iframe/advanced-iframe-pro-demo/widgets" target="_blank">Widget support</a>, <a href="http://www.tinywebgallery.com/blog/advanced-iframe/advanced-iframe-pro-demo/change-links-targets" target="_blank">change link targets</a></li><li>External workaround supports <a href="http://www.tinywebgallery.com/blog/advanced-iframe/advanced-iframe-pro-demo/external-workaround-auto-height-and-css-modifications" target="_blank">iframe modifications</a> and <a href="http://www.tinywebgallery.com/blog/advanced-iframe/advanced-iframe-pro-demo/responsive-iframes" target="_blank">responsive iframes</a></li><li><a href="http://www.tinywebgallery.com/blog/advanced-iframe/advanced-iframe-pro-demo/browser-detection" target="_blank">Browser dependant settings</a>, <a href="http://www.tinywebgallery.com/blog/advanced-iframe/advanced-iframe-pro-demo/lazy-loading" target="_blank">lazy load</a></li><li>No view limit, <a href="http://www.tinywebgallery.com/blog/advanced-iframe/advanced-iframe-pro-demo/zoom-iframe-content" target="_blank">zoom</a>, <a target="_blank" href="http://www.tinywebgallery.com/blog/advanced-iframe/advanced-iframe-pro-standalone">standalone version!</a></li><li><a target="_blank" href="http://www.tinywebgallery.com/blog/advanced-iframe/advanced-iframe-pro-demo">See the pro demo</a><li><a target="_blank" href="http://www.tinywebgallery.com/blog/advanced-iframe/advanced-iframe-comparison-chart">Compare versions for all features</a>', 'advanced-iframe');
           echo '</li></ul>
        </div>
			</div>
		</div>

<div class="clear"></div><br />
';

_e('<p>So if you use the Advanced iFrame on a non personal website please first test the plugin carefully before buying. After that it is quick and painless to get Advanced iFrame Pro. Simply get <strong><a target="_blank" href="http://codecanyon.net/item/advanced-iframe-pro/5344999?ref=mdempfle">Advanced iFrame Pro on CodeCanyon</a></strong> and be pro in a few minutes!</p>', 'advanced-iframe');

_e('<p><strong>Current status</strong>: ', 'advanced-iframe');
echo get_option('default_a_options') / 100 . ' % of views for this month used.';
_e('</p>', 'advanced-iframe');
echo '</p>';
echo '<table class="form-table">';
      printTrueFalse($devOptions, __('Show this section as last tab/at the bottom', 'advanced-iframe'), 'donation_bottom', __('Please move this section as last tab/to the bottom if it bothers you or if you have already supported the development. Feel also free to contact me if you are missing a feature. Sorry for moving this section to the top but at the bottom it seems to be ignored completely.', 'advanced-iframe'));
      printTrueFalse($devOptions, __('Use footer save button', 'advanced-iframe'), 'single_save_button', __('The new default is that the save button is in a sticky footer. I was testing this for all major browsers but not for all worpress versions. So if this does not work for your version set this to false to get one save button for each section.', 'advanced-iframe'), 'false');
 
      printTrueFalse($devOptions, __('Allow shortcode attributes', 'advanced-iframe'), 'shortcode_attributes', __('Allow to set attributes in the shortcode. All of the attributes can be overwritten in the shortcode if you set \'Yes\'. Otherwise the settings you specify here are used.', 'advanced-iframe'));
      printTrueFalse($devOptions, __('Use shortcode attributes only', 'advanced-iframe'), 'use_shortcode_attributes_only', __('All iframes you use in your pages use the settings below. With shortcode attributes you can overwrite these settings. When you use several iframes with different settings this can lead to strange behavior because you do not see the whole configuration in the shortcode. By setting this option to true only the parameters defined as attributes are used. So the minimum you need to define is: securitykey and src of the iframe. You can set this for a single iframe as well with the shortcode attribute use_shortcode_attributes_only="true". A minimal shortcode would then look like this: [advanced_iframe securitykey="', 'advanced-iframe') . $devOptions['securitykey'] . __('" use_shortcode_attributes_only="true" src="http://www.tinywebgallery.com"].  Shortcode attribute: use_shortcode_attributes_only="true" or use_shortcode_attributes_only="false"', 'advanced-iframe'));
      printTrueFalse($devOptions, __('Include ai.js in the footer', 'advanced-iframe'), 'include_scripts_in_footer', __('By default now the needed Javascripts are included at the footer. So you can include jQuery also at the footer if you like. If you like/need it in the header set this value to false. Before Wordpress 3.3 jQuery is needed in the header if you want to use lazy-loading! The ai.js has also to be in the footer if it should only be loaded when the shortcode is on the page. This setting cannot be set as shortcode!', 'advanced-iframe'));
      printTrueFalse($devOptions, __('Load jQuery as dependency', 'advanced-iframe'), 'load_jquery', __('By default jQuery is loaded as dependeny. If you have a theme or another plugin that does not stick to the Wordpress way to load the scripts you might have to disable the dependeny. This avoids that jQuery is loaded again and other plugins do maybe not work anymore.', 'advanced-iframe'), true);
      printTextInput($devOptions, __('Editor button', 'advanced-iframe'), 'editorbutton', __('With this setting you can add a "advanced iframe" button to the text editor of Wordpress. The button does add the shortcode with the current security code. So the default settings are used then. Currently only "securitykey" enables the button. All other settings don\'t  show the button right now. For further versions it is planned that you can define the attributes of the button here.', 'advanced-iframe'));     
            
echo '
     </table>
    <p class="button-submit">
      <input class="button-primary" type="submit" name="update_iframe-loader" value="';
      _e('Update Settings', 'advanced-iframe');
echo '"/>
    </p>

';
}
}
?>