=== Plugin Name ===
Contributors: mdempfle, Michael Dempfle
Donate link: http://www.tinywebgallery.com
Tags: iframe, embed, resize, content, advanced, shortcode, modify css, widget 
Requires at least: 2.8.6
Tested up to: 4.3
Stable tag: 6.5.5
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Include content the way YOU like in an iframe that can hide and modify elements and foreward parameters. You can also embed content directly.

== Description ==

> **[Advanced iFrame Pro](http://codecanyon.net/item/advanced-iframe-pro/5344999?ref=mdempfle)** | 
> **[Demo](http://www.tinywebgallery.com/blog/advanced-iframe/demo-advanced-iframe-2-0)**

Include content the way YOU like in an iframe that can hide and modify elements and foreward parameters. You can also embed content directly or show a part of an iframe.

= Shortcode for advanced iframe =
By entering the shortcode '[advanced_iframe securitykey=""]' you can include any webpage to any page or article. 
The following cool features compared to a normal iframe are implemented:

- Security code: You can only insert the shortcode with a valid security code from the administration.
- Hide areas of the layout to give the iframe more space (see screenshot) 
- Show only specific areas of the iframe when the iframe is on a same domain (The Pro version supports this on different domains) or include parts directly by jQuery
- Modify css styles in the parent and the iframe to e.g. change the width of the content area (see screenshot)
- Forward parameters to the iframe 
- Resize the iframe to the content height or width on loading, AJAX or click 
- Scroll the parent to the top when the iframe is loaded
- Hide the content until it is fully loaded 
- Add a css and js file to the parent page
- Many additional cool features are available the pro version - see http://www.tinywebgallery.com/blog/advanced-iframe/advanced-iframe-comparison-chart 

Please note: Modification inside the iframe are only possible if you are on the same domain or use a workaround like described in the settings.

So please check first if the iframe page and the parent page are one the same domain. www.example.com and text.example.com are different domains! Please check in the documentation if you can use the feature you like

A free iframe checker is available at 
http://www.tinywebgallery.com/blog/advanced-iframe/free-iframe-checker.
This tool does check if a page is allowed to be included! 

All settings can be set with shortcode attributes as well. If you only use one iframe please use the settings in the administration because there each parameter is explained in detail and also the defaults are set there.

**[Quick overview of all advanced iframe attributes](http://wordpress.org/extend/plugins/advanced-iframe/other_notes/)**

= Upgrading to Advanced IFrame Pro =
It's quick and painless to get Advanced iFrame Pro. Simply Get Advanced iFrame Pro on CodeCanyon.net (http://codecanyon.net/item/advanced-iframe-pro/5344999?ref=mdempfle) and install your new plugin! You can than use the plugin on commercial, business, and professional sites and blogs. You furthermore get:

* Show only specific areas of the iframe even when the iframe is on different domain
* Graphical content selector: http://examples.tinywebgallery.com/configurator/advanced-iframe-area-selector.html
* External workaround supports iframe modifications
* Widget support
* No view limit
* Hide areas of an iframe
* Responsive iframes
* Browser detection 
* Change link targets
* Url forward parameter mapping.
* Zoom iframe content
* Accordion menu
* jQuery help
* Lazy load 
* Standalone version - can be used in ANY php page!
* And much more...

You can find the comparison chart here: http://www.tinywebgallery.com/blog/advanced-iframe/advanced-iframe-comparison-chart
See the pro demo here: 
http://www.tinywebgallery.com/blog/advanced-iframe/advanced-iframe-pro-demo= Administration =  
* Go to Settings -> Advanced iFrame

=	Quick start guide =
The quickstart guide is also available as video: http://www.tinywebgallery.com/blog/advanced-iframe/advanced-iframe-video-tutorials 

To include a webpage to your page please check the following things first:

*	Check if your page page is allowed to be included http://www.tinywebgallery.com/blog/advanced-iframe/free-iframe-checker!
* Check if the iframe page and the parent page are one the same domain. www.example.com and text.example.com are different domains!
* Can you modify the page that should be included?

Most likely you have one of the following setups:

1.	iframe cannot be included:  You cannot include the content because the owner does not allow this. 
1.	iframe can be included and you are on a different domain: See the feature comparison chart: http://www.tinywebgallery.com/blog/advanced-iframe/advanced-iframe-comparison-chart. To resize the content to the height/width or modify css you need to modify the remote iframe page by adding one line of Javascript to enable the provided workaround.
1.  iframe can be included and you are on the same domain: All features of the plugin can be used. 

If you mix http and https read http://www.tinywebgallery.com/blog/iframe-do-not-mix-http-and-https. Parent https and iframe http does not work on all mayor browsers!

== Installation ==
There are 2 ways to install the Advanced iFrame

*Using the Wordpress Admin screen*

1. Click Plugins, Add New
1. Search for advanced iframe
1. Install and Activate it
1. Place '[advanced_iframe securitykey=""]' in your pages or posts. the security key can be found at Settings -> Advanced iframe

*Using FTP*

1. Upload 'advanced-iframe' to the '/wp-content/plugins/' directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Place '[advanced_iframe securitykey=""]' in your pages or posts. the security key can be found at Settings -> Advanced iframe

== Other Notes ==
= Advanced iframe attributes =

Below you find all possible shortcode attributes. If you only use one iframe please use the settings in the administration because there each parameter is explained in detail and also the defaults are set there.

Setting an attribute does overwrite the setting in the administration. 

[advanced_iframe securitykey=""   src="" 
  id=""   name="" 
  width=""   height="" 
  marginwidth=""   marginheight=""
  scrolling=""   frameborder="" 
  class=""   style="" 
  content_id=""   content_styles="" 
  hide_elements=""   url_forward_parameter="" 
  onload=""   onload_resize="" 
  onload_scroll_top=""   onload_show_element_only="" 
  store_height_in_cookie=""   additional_height="" 
  additional_js=""   additional_css="" 
  iframe_content_id=""   iframe_content_styles="" 
  iframe_hide_elements=""  hide_page_until_loaded=""
  include_hide_page_until_loaded="" 
  include_url="" include_content=""  
  include_height=""  include_fade="" 
  onload_resize_width=""   resize_on_ajax=""  
  resize_on_ajax_jquery=""   resize_on_click="" 
  resize_on_click_elements=""   use_shortcode_attributes_only=""
  onload_resize_delay=""
  ]


== Screenshots ==
1. Comparison between normal iframe and advanced iframe wrapper. The red areas are modified by the advanced iframe to display the content better.
2. This image shows the difference with an url forward parameter. In the advanced iframe a sub album is shown while the normal iframe still shows the entry screen.
3. The basic admin screen to enable standard settings
4. The advanced admin screen to enable advanced settings like html and css changes
5. The advanced admin screen to enable Javascript scroll to top and autoresize resize
 
== Frequently Asked Questions ==
Find the latest FAQ here:
http://www.tinywebgallery.com/blog/advanced-iframe/advanced-iframe-faq/

= Demo =
See the pro demo here:
http://www.tinywebgallery.com/blog/advanced-iframe/advanced-iframe-pro-demo

See the free demo here:
http://www.tinywebgallery.com/blog/advanced-iframe/demo-advanced-iframe-2-0

== Upgrade Notice ==
Simply overwrite all files from your previous installation.
If you have some radio elements empty after the update simply 
select the one you like and save again.


== Changelog ==
= 6.5.5 =
- Fix: Some spaces at the end of advanced-iframe-main-read-config.php gave a  "headers already sent by" warning on some setups.

= 6.5.4 =
- Fix: include_url was broken. Now it works fine again.

= 6.5.3 =
- Fix: https iframe on https did show an error message which is wrong. Now the message only is shown if http pages are included to https pages.

= 6.5.2 =
- Fix: Wordpress updates where not shown because of a missing return value. Now only the ones for advanced iframe are blocked as it should be.

= 6.5.1 =
- New: Wordpress 4.2.4 is supported
- Fix: An anonymous function was used which is supported since php 5.3. But older php versions failed in the administration. Now the "old" way is used and the plugin is now compatible with older php versions again.

= 6.5 =
- New: Tab navigation in the administration.
- New: The browser detection is now supporting "browser" and "desktop" also. 
- New: include_html was added which does write the given string directly instead an iframe. This is helpful e.g. for a fallback text/link when the browser detection is used and a device is detected where your content does not work or should not be shown. Now you can print a message or display an image there.
- New: Browscap version 6005 lite 7th June 2016 is now included. It is much smaller than the previous version which had a lot of overhead which where not needed here. (Pro)
- New: A button for full screen iframes was added it does set all the required styles and settings for a fullscreen iframe (pro). 
- New: hide_content_until_iframe_color was added. This hides the parent content with the given color until the iframe is loaded. This is very usefull if you want to use a fullscreen iframe and the parent content should never be shown (pro).
- New: css calc() support for width and height. This makes it possible to do calcuations like 100%-200px at the height and the width. See http://caniuse.com/#feat=calc for browser support (pro).
- New: Added a few new sections for better usability of the administation: "Zoom", "Lazy load" and "Url parameters"
- New: Above the editor a button next to the media button was added to include a basic iframe shortcode. For later versions it is planned that the attributes for the button can be specified in the config.
- New: When zoom is used the browser detection is needed. This does need a lot of memory. A temp file is now created before the check and removed after the check. So if the check does now fail because of a memory crash this file is not deleted and the script does not do the check. You only loose the IE8 support for zoom. The temp file is advanced-iframe-custom/browser-check-failed.txt and if you get mory memory you can remove this file to enable the check again (pro). 
- New: A message is shown if you include a http iframe to a https page as many major browsers do block this. Therefore it does not make sense to use this setup.
- New: The ai_external.js has now a timestamp. There you can then see if you use the latest version or maybe see a cached one!
- New: The resize on element resize script is overwritten if jQuery is loaded after the ai_external.js script again. Now a warning is shown (pro)
- New: user info and user meta of the src attribute have now an additional help which settings are available (pro)
- New: The generate shortcode button does now only generate the include_* values if they are set as the other settings are ignored than. 
- Fix: show_part_of_iframe_x and show_part_of_iframe_y are now always added to the generated iframe code if show_part_of_iframe is enabled (pro).
- Fix: Added overflow:auto to the wrapper div. This fixed the problem returning a height of 0 of the wrapper element in chrome if the elements inside are floating: http://webdesignerwall.com/tutorials/css-clearing-floats-with-overflow 
- Fix: The % info text of the area selector was improved. 
- Fix: [ and ] in the security error message where not html encoded. This lead to a strange error message if another plugin is wrapped around and calling do_shortcode. 
- Fix: The max-width for the sourounding div when responsive iframes are enabled where missing a ; which leads to a invalid css value.
- Fix: Added missing links in the documentation at the responsive iframe settings.
- Fix: auto_zoom_by_ratio was missing in the generated shortcode.
- Fix: position:absolute is now optional (use_zoom_absolute_fix = "true") as it seems is also causes problems at other layouts. 

= 6.4 =
- New: The first video tutorial is avilable: http://www.tinywebgallery.com/blog/advanced-iframe/advanced-iframe-video-tutorials 
- New: Links to external pages can be opened in a simple fullscreen lightbox (Pro). See example 32 on http://www.tinywebgallery.com/blog/advanced-iframe/advanced-iframe-pro-demo/change-links-targets
- New: The iframe url can be returned back to parent and added to the url (Pro). This url does than also load this iframe content again. Supported on the same domain and with the external workaround (Pro). See: http://www.tinywebgallery.com/blog/advanced-iframe/advanced-iframe-pro-demo/add-iframe-url-to-parent
- New: hide_part_of_iframe does now support links (Pro)! Therefore it is now possible to add areas with custom links. See the updated demo 8 on http://www.tinywebgallery.com/blog/advanced-iframe/advanced-iframe-pro-demo/hide-a-part-of-the-iframe  
- New: hide_part_of_iframe elements are hidden until the page is loaded to avoid that this blocks are shown without the iframe. this is only enabled if hide until loaded is enabled! 
- New: Support for pdfs inside the iframe (Pro). If you include a pdf google doc is used to include the pdf. This solution  looks the same on all browsers. If you want to use the native pdf renderer of the browser/your system add NATIVE: before the url. Like NATIVE:http://www.example.com/pdf.pdf  DEMO NEEDED
- New: All attributes from the user info and the user meta are available as replace parameters in the src attribute (Pro). 
- New: Extract parts from the parent url and adds it to the iframe url (Pro). See urlpath at the description of "Url"
- New: Extract parts from the parent query and add it to the iframe url (Pro). See query at the description of "Url"
- New: Parameters from POST requests are alse extracted. If GET and POST are given the GET parameter is used.
- New: Add css directly to an iframe on the same domain (Pro). This does than support !important also. 
- New: Add css and js files to the iframe for the same domain or with the external workaround (Pro)
- New: Custom css and js files can be created/viewed/edited/removed in the administration.
- New: Marker css classes are added to the body and the first level of the elements in the iframe: add_css_class_iframe (Pro). It is than now possible to apply different changes to different pages in the iframe.
- New: You can now reload the iframe in a certain interval: reload_interval (Pro)
- New: A filter for the settings does now exist. Simply type for a search term and only the matching settings are shown. 
- New: An icon is now shown which settings are saved to the ai_external.js
- New: An icon is now shown where a special demo does exist. 
- New: The dependeny to jQuery is now optional. This avoids double loading of jQuery if e.g. your theme does load jQuery not the wordpress way.
- New: ai.js is only loaded if the advanced_iframe shortcode is on the page. "Include ai.js in the footer" has to be set to true to enable this.
- New: Auto zoom by ratio if the height cannot be measured but the ratio is known (Pro).
- New  allowfullscreen is now also available in the free version as this is a default html element.
- New: Settings link on the plugin page
- New: External history page http://www.tinywebgallery.com/aip-history.htm 
- New: Improved documentation
- New: A text is shown if ai_extenal.js file does not exist yet.
- New: Width in the external workaround is now first checking if a width style is set and only if not found the measuring is done. This can solve problems with hidden elements! Also if you hide elements you should also set the width to 0 to avoid such issues.If you use the internal hide function hidden elements are set to a height and width of 0.
- New: Tested up to Wordpress 4.2.2
- Fix: The plugin does now work fine with the royal theme from codecanyon again! The theme and the plugin where using the same variable for the options. Now a unique variable name is used.
- Fix: Changed && in the Javascript to two if statements to avoid problems with wptexturize and other page optimizing plugins 
- Fix: Browser detection for mobile and android was not working because in the detection file e.g. isMobileDevice was changed to ismobiledevice. Now this works fine again ;). (Pro)
- Fix: Show one element on the local domain was fixed.
- Fix: aiResizeIframeHeightById has now a a try catch to detect configuration errors. 
- Fix: position:absolute is added to the iframe at zoom to fix issues on some pages.

= 6.3.7 =
- Testet with 4.2.3

= 6.3.6 =
- Testet with 4.2.2

= 6.3.5 =
- Testet with 4.1.2
-	Fix: Layout fix in the administration of the free version only. 

= 6.3.4 =
- Fix: Advanced iframe was not working together with the Royal theme as they where using a same variable name. Now they work fine together.

= 6.3.3 =
- Fix: Measuring of width does now check if it is > 1 as some full responsive sites do return such a value that is not valid. 

= 6.3.2 =
- Fix: Show one element on the local domain was fixed.
- Fix: Measuring of width does now check if it is > as some full responsive sites do return such a value that is not valid. 

= 6.3.1 =
- New: index.htm files where added to all directories to prevent directory listings if you server does allow this.
- Fix: Standalone version was working fine in the standalone folder. The internal path handling was improved to make is easier to include it anywhere. (Pro)  
- Fix: !important was removed for hide elements because this was is not supported in jQuery.
- Fix: All iframe attributes are trimmed now. This avoids errors because of spaces e.g. at the beginning of the src.
- Fix: Better error message if the security key was not found because of wrong quotes.
- Fix: > could not be used in the shortcode for jQuery patterns. You can now use ## which internaly converted to > 
- Fix: Save button was jumping when you try to click it on some browser. The css is fixed now.
- Fix: Menu anchor fixed 
- Fix: Save caused a php warning when normal save buttons where used.

= 6.3 =
- New: Standalone version. See standalone/readme.html for details (Pro)
- New: Config files for the external workaround. See example 7 (Pro) 
- New: Create, view, edit and remove of config files added (Pro)
- New: hide elements does now set !important when settings display:none as some themes have display:block !important somewhere.
- New: Internal version check as Wordpress only checks the free version. (Pro)
- New: Help for Advanced iFrame Pro Widget added. (Pro)
- New: Reset to default settings was added. (Pro)
- New: Settings are shown in the main menu now also. Can be turned off in the config.
- New: Element_to_measure is now also supported when resized later or the width is used. (Pro)
- New: "Hide until loaded" does now use css instead of jQuery to hide the iframe. 
- New: strtolower was added when css styles are applyed on the same domain. This fixes problems if e.g. important is written Important which is invalid!   
- New: Improved documentation
- New: Hide elements is now used with !important because depending on your css the elements are not hidden otherwise. Make sure to save the config as this is also implemented for the external workaround.
- New: Automatic resize 500 ms later in the external workaround if the measured height is > 10.000 as this is either an error or a huge page where the delay does not matter. (Pro)
- Fix: Resize is only done if the detected height is > 10. Everything below is expected that the height is not measured correctly. (Pro)
- Fix: Many typos fixed
- Fix: show_one_element_only has # already set on the same domain. The # was removed as in the external workaround the # was not set.
- Fix: hide_page_until_loaded_external is now not connected to hide_page_until_loaded anymore. Now hide_page_until_loaded has be set to false if hide_page_until_loaded_external is used. But the old way has caused that misconfguration was showing a blank page.  

= 6.2 =
- New: {adminemail} is available as replace parameters in the src attribute (Pro).
- Fix: modifyOnLoad... was not always rendered because show_part_of_iframe_next_viewports_hide was not checked properly
- Fix: The browser detection is now only used when the browser detection or zoom is used. browser detection needs quite some memory. So this reduces the memory usage of the plugin if these features are not used (Pro).  

= 6.1 =
- New: {userid}, {username}, {useremail} are available as replace parameters in the src attribute (Pro).
- Fix: {} in the src field could not be saved in the administration because of Wordpress esc_url. Now this works there too. It was always working in the shortcode attribute src.
- Fix: In the external workaround the resizeLater function had a hardcoded id (advanced_iframe). When using a different one the callback with the size failed.
- Fix: Browser detection needs at least php 5.3. Now a warning is shown when you don't have at least php 5.3 (Pro).
- Fix: Plugin needed at least php 5.3 because the browser detection was used always to detect IE8. Now this check is only done if php 5.3 is available (Pro).
- Fix: ?version=<internal version> it attached to js and css of the administration like in the site.

= 6.0 =
- New: Auto zoom. This feature does automatically calculates the needed zoom factor to fit the iframe page into the parent page. Works on the same and with the external workaround. Shortcode auto_zoom. See example 29-31 (Pro). 
- New: Lazy load with hidden elements. So this is a very good alternative for hidden tabs. See example 28 (Pro).
- New: You can define the element that should trigger manual lazy load. See example 25 (Pro).  
- New: Static save button in a transparent footer (Pro).
- New: Support for an alternative shortcode. So you can use e.g. "iframe" also if you want to switch/upgrade from iframe to advanced iframe pro. Please note: If you enable this, the security key is NOT checked anymore (Pro).
- New: Support for the BBCode [iframe]url[/iframe] (Pro). 
- New: Automatic resize 500 ms later in the external workaround if the measured height is < 10 (Pro)
- New: You can define the element you want to measure + a offset for fix content. This is sometimes needed for some themes where e.g. chrome returns 0 as height (Pro).
- New: You can set additional styles to the wrapper div like overflow:auto with additional_styles_wrapper_div in the external workaround (Pro).
- New: Show only one element does now also clones attached event listeners (Pro).
- New: Browser detection now supports tablets, android, androidtablet and browsecap version 5033, 23 Sep 2014 was added (Pro).
- Fix: transparent border of the wrapper div removed as it is not needed anymore. 
- Fix: Improved documentation for hide_part_of_iframe how to make a read only iframe (Pro).
- Fix: $include_scripts_in_footer and $add_css_class_parent or store_height_in_cookie could cause a config error. You need to set include_scripts_in_footer to false if you want to use add_css_class_parent or store_height_in_cookie. Now this is added to the documentation and also the script does not fail anymore if you do set this wrong. 
- Fix: Added stripcslashes() when reading parameters when magic_quotes_gpc is on. 
- Fix: Removed the detection at resize if the iframe width has changed because at auto zoom the detection was wrong (Pro).

= 5.10 =
- New: Resize on element resize is now supported. This enables you to resize the iframe if e.g. the content of the iframe changes because of div which expands. This feature is more powerfull and easier to configure than the "Resize on click/Ajax" setting and is also supported for the external workaround (Pro)
- New: Trigger loading manually (enable_lazy_load_manual) added. Now lazy loaded iframes can be shown manually. See the lazy load demo for an example. (Pro)
- New: Write css as script directly to the header. See the description (Write css directly) of the external workaround for details. (Pro)
- New: Add a css style to each parent element of the iframe (add_css_class_parent) to be able to find and modify the parent even when no styles exist or classes are not used exclusively. (Pro) 
- New: Support of shortcodes in the src attribute. Please note. Needed encodings have to be done in the shortcode! (Pro) 
- New: Dynamic src parameters. You can define placeholders for the site, host and port. This is useful if you e.g. have a multidomain install where the host is dynamic (Pro) 
- New: Add the id to the url of the iframe (pass_id_by_url). This feature adds the id of the iframe to the iframe url. The id is than extracted on the iframe and used as value for the callback to find the right iframe on the parent side.add_css_class_parent (Pro)        
- New: additional_js_iframe - The ai_external.js can also write additional Javscript. This is loaded at the end of ai_external.js. The advantage using this is that the Javascript is only loaded if the page is inside the iframe and is not loaded when accessed directly. (Pro)
- New: additional_js_file_iframe - The ai_external.js can also load an additional Javascript file. This is loaded at the end of ai_external.js. The advantage using this is that the file is only loaded if the page is inside the iframe and is not loaded when accessed directly. Please note that the file is loaded asynchronously. (Pro)
- New: URL forward parameters (url_forward_parameter) does now also support ALL as setting. This does simply add all incoming parameters to the iframe url.
- New: Scripts can now be loaded to the footer (include_scripts_in_footer). This is now default.
- New: Height is only sent by the external workaround when the height does change and not everytime a configured event is triggered.
- New: Browscap version 5030 lite 17th June 2014 is now included. (Pro)
- Fix: All css/Javascript are now loaded to header/footer for all Wordpress versions the wordpress way
- Fix: Improved documentation.

= 5.9 =
- New: Lazy load of iframes with treshold and fadein. Iframes can be loaded after the parent is done or the iframe is shown in the viewport! (Pro)
- New: Better input validation. Avoids configuration errors.
- New: Wordpress 3.9.1 is supported
- New: An alternative to the eval function is now used in Javascript to improve security and speed.
- New: Browscap version 5029 lite 8th May 2014 is now included. (Pro) 
- Fix: Code improvements found with the plugin checker plugin
- Fix: Hidden tabs was not working because of the responsive iframe feature. Now both do work independant again. (Pro)
- Fix: Improved shortcode generator (Pro) 
- Fix: Width is now measured without the extra space (which was 0 by default anyway ;))
- Fix: Whitelist for params was extended by :,? and &
- Fix: Wrong default for Set Iframe height by ratio (iframe_height_ratio) was fixed (Pro) 
- Fix: loader icon and responsive iframe do now work together! (Pro)

= 5.8 =
- New: Shortcode generator! In the administration you can now generate a default independent shortcode from the current settings.(Pro)
- New: Set Iframe height by ratio (iframe_height_ratio). This can be used to make resonsive iframes where the content has a certain ratio like swf's, videos... (Pro)
- New: Wordpress 3.9 is supported 
- New: map_parameter_to_url does now also support that an url can be passed to the iframe directly. So show=http%3A%2F%2Fwww.tinywebgallery.com would open http://wwww.tinywebgallery.com inside the iframe. (Pro)
- New: Browscap version 5027 lite 24th Apr 2014 is now included. (Pro)  
- Fix: Documentation improvements.

= 5.7 =
- New: html attribute allowfullscreen is now supported.
- New: Zoom and auto height with the external workaround with several iframes on the same page is now supported.
- New: Tested with Wordpress 3.8.2
- Fix: Advanced iframe pro can now be used together with php-browser-detection. Before using both where leading to a function redeclaration. 
- Fix: Functions of the old and new workaround had the same name with different parameters. Now this functions have different names and also work properly with several iframes on the same page. 

= 5.6 =
- New: Support that the height of responsive iframes is automatically set to the new content height. This means that if you resize the parent page and the iframe width changes, the height of the iframe is adopted automatically like when loaded the first time! Please note that both pages (parent and iframe page) needs to be responsive. Please also read the blog entry about responsive iframes. (Pro)
- New: Read-only iframes: hide_part_of_iframe does now support also %. This means together with color "transparent" you can create read-only iframes! See the pro demo. (Pro)
- New: No output (except conguration errors) is done in the script function anymore. Everything is returned as return value. 
- New: Added updated browsecap.ini: 5024 (2nd March 2014) from browscap.org
- Fix: Improved documentation in the administration.
- Fix: Loader is now displayed better for small iframes. See example 2. 
- Fix: additional_css and additional_js are now again supported as shortcode attribute if Wordpress >= 3.3. Before WP 3.3 you can only set this feature in the administration. 

= 5.5 =
- New: Support to resize to content height for iframes on hidden tabs (Pro). Works with e.g. Tabby Responsive Tabs and Post UI Tabs. This can also be used for simple hidden divs which opens e.g. on a mouse click or accordeon menus. Please read the documentation in the settings for details. 
- New: Loading of css and Javascript in the admin section is it only loaded when needed. 
- New: Loading of the additional css and Javascript in the page are also only loaded when you use Wordpress >= 3.3. Before the files are always included to all pages because wordpress api does not allow this differently. 
- New: Added updated browsecap.ini: 5023 (2nd Feb 2014)
- Fix: Loader css was always written even if not configured. Now only when this feature is enabled.
- Fix: renamed internally is_browser to ai_is_browser to avoid problems when e.g. a theme does define is_ie()...
- Fix: Area selector does now look good again. 

= 5.4 =
- New: The default security key is now based on the AUTH_KEY of Wordpress and the current time. Please change the default key to your own to increase security. 
- New: Zoom of iframe content: This feature is supported for the following browsers: IE8-11, Firefox, Chrome, Safari, Opera. Older versions of IE are not supported. Please test all the browsers you want to support with your page because not all pages do look good in a zoomed mode! This feature is also part of the demo. So you can test your browsers there! (Pro)
- New: iframe loading icon. You can now show a loding icon while the iframe is loaded. If you use the "hide until loaded feature" your users does see that something is happening. You can use your own image (loader.gif) with a size of 66x66 px by replacing the one in the img folder (Pro).
- New: Accordeon menu (Pro).
- New: Map parameter/value pairs to urls. You can specify parameter/value/url tripples which are used the following way.  If the parent has ?parameter=value than the url of the setting is used as src for the iframe (Pro).
- New: Reading of browser detection file is cached (Pro).
- New: Improved padding and better handling in expert mode (Pro)
- New: Input text fields have now dynamic sizes. So if you enlage the screen they should always fit. Textfields with numbers only are now much shorter as the numbers there never get longer.
- Fix: Administration was not shown properly on MAC.
- Fix: Expert mode description fixed (Pro)
- Fix: Error message when saving a special setting was fixed 

= 5.3 =
- New: Browser detection added. You can now specify browser specific iframes. This is important especially for the "Show only part of the iframe" where browser differences of a few pixels can matter. Also mobile, iphone, ipad can be detected. A modified version of php-browser-detection is used which uses browscap.org as data! Important: Read the documentation at "Browser detection" in the plugin how to use this! (Pro) 
- New: Change link targets on the parent that they open inside the iframe. Shortcode: change_parent_links_target (Pro)
- New: Change link targets inside the iframe if the iframe page is on the same domain or if you can use the external workaround. Shortcodes: change_iframe_links, change_iframe_links_target (Pro)
- New: Redirect direct access of the iframe page to the parent page. Does also add existing parameter to the parent url (Pro)
- New: url forward parameter mapping. Wordpress has many reserved word in the url so they cannot be used. Now parameters can be mapped to a different one in the confiuration. so e.g. name is e.g. a reserved word an cannot be used. using ainame|name in the configuration will forward 'ainame=hallo' as 'name=hallo' to the iframe (Pro). 
- New: "Show only a part of an iframe" has now a new setting $show_part_of_iframe_style where a style can be set for e.g. a border (Pro).
- New: Integrated jQuery help (Pro)
- New: Improved error messages
- Fix: Area selector does now select 'Yes' at the "Show only part of the iframe" when data is chosen (Pro).
- Fix: Area selector does now enable all disabled radio elements when data is chosen (Pro).  
- Fix: Additional spaces are removed when used in jQuery attributes 
- Fix: Typos in the descriptions where fixed.
- Fix: ereg was replaced by preg_match to avoid deprecated warnings with php < 5.3

= 5.2 =
- New: New feature "Hide a part of the iframe". Extra layers can be placed over the iframe. This enables you to e.g. hide a logo or even place your own logo on an iframe. See the pro demo for examples (Pro)
- New: Try catch is now used at features which could fail when features for the same domain are used on external domains. Now the exceptions are catched and logged to the console.   
- New: A dynamic auto id is now only generated if several iframes are detected on one page.
- New: Tested with Wordpress 3.8
- New: Improved documentation  
- Fix: At grayed out radios only the first radio box was grayed out - now all are disabled

= 5.1 =
- New: vertical and/or horizontal scrollbars in the pro feature "Show only part of the iframe" solution are possible. This makes it possible to include e.g. a whole inner content with scrollbars but without showing e.g. the header of the external page. See the pro version for a working example.
- New: Resize can now be delayed. This helps if the onload event is fired but the page is not completely build. This feature is also possible in the external workaround of the pro version.
- New: Administration options are grayed out if not available because of another setting.
- New: Expert mode. If you enable this the description is only shown if you click on the setting. You see more settings at once but only one description at once. Use this if you are common with the settings. 
- New: id is now set automatically if a src is set in the shortcode but no id is set. This avoids problems if people  forgets to set the id ;).  
- Fix: The external workaround does now hide the html element until all modifications are done. Before only the body was hidden which was showing the background in some browsers. If you still see a background for a very short time please look into ai_external.template.js - line 53

= 5.0.1 =
- New: Support of the external height workaround when the iframe is already in an iframe. Now the correct iframe is used and not the top one anymore.
- Removed not used file.

= 5.0 =
- New: 'Show only a part of the iframe' has now a graphical area selector where yu can simply select the area you want to show with the mouse! (Pro)
- New: Improved external workaround: It can now be configured to work with different settings for different iframes  
- New: Improved documentation of the external workaround
- New: Improved external workaround: "Modify the content of the iframe if the iframe page is on the same domain" is now supported in the workaround and can be configured for different domains (Pro).
- New: Improved external workaround: The iframe can be hidden until al external modifications are done!
- New: Improved external workaround: The same page can now be included into different wordpress installations. Only one configration is allowed here. For multiple configurations you need the onclude the different scripts depending on the parent with php. 
- New: Tested with Wordpress 3.7.1
- New: Fully compatible with php >= 5.3
- New: "Scroll to top" does now not need a workaround anymore and the setting was moved to a different section where it makes more sense.
- New: Whitelist for url foreward parameters. If the value does only contain parameters on the whitelist than the value is not encoded anymore. Whitelist: @a-zA-Z0-9À-ÖØ-öø-ÿ|)( minus and space.
- New: Support of the external workaround for IE7 and IE8
- New: Quickstart guide added to the administration page of advanced iframe pro.
- New: When the external workaround is set to true settings which only work on the same domain are disabled.
- New: Improved handling of the show_part_of_iframe_... feature. Not needed dependencies at configuration where removed. This enables more flexibility here! (Pro) 
- Fix: show_part_of_iframe_x and show_part_of_iframe_y where switched. now show_part_of_iframe_x = left and show_part_of_iframe_y = top (Pro)
- Fix: \n where removed from the code because some other plugins converted them to br which where adding unwanted empty lines.
- Fix: Hide elements until loaded is now again the last step of the onload values.
- Fix: em tags where replaced by p tags in the administration. Copying em tags where copying the em tags to the editor as well which could cause invalid shortcodes  
- Fix: "Restart the viewports from the beginning after the last step": old shortcode was in the description show_part_of_iframe_do_update -> show_part_of_iframe_next_viewports_loop (Pro)

= 4.2 =
- New: Improved external workaround. The body in the wrapper is not copied as simple string anymore (This removes e.g jQuery stuff that is attached in the DOM) but a div object is created where the child notes of the body are attached to. Thanks to Jason.
- New: Improved external workaround. The wrapper div is now only rendered if needed. 

= 4.1.1 =
- Fix: Hidden administration fields caused a notice when saving.

= 4.1 =
- New: New attribute use_shortcode_attributes_only. Enables not to use any of the defaults and only the settings specified as attributes.
- New: Fields could only be made empty by entering a space. Now simply removing the text does work again.
- Fix: minor fixes 
- Fix: Code and documentation improvements

= 4.0.1 =
- Fix: Fixed a copy and paste error where wrong shortcodes where used in the documentation 

= 4.0 =
- New: Pro version on codecanyon.net.
- New: Show only a part of an iframe - works on different domains! (Pro)
- New: Change the visible part of the iframe after each onload event (Pro)
- New: Open a new url after the last step (Pro)
- New: Open the iframe in a new tab or as parent after the last step (Pro)
- New: Widget. You can now include the shortcode also as widget (Pro)
- New: New attribute 'style'. You can now set any style directly at the iframe. The recommended way is to use a css file and the attribute class.

= 3.6 =
- New: Tested with Wordpress 3.6
- New: Updated example file.

= 3.5 =
- New: The external workaround was rewritten. It does now work by only including a script to the iframe page. 
- New: The resize of the external workaround does now also make the iframe smaller.
- New: The Javascript on the external page does only modifies the page if it is included in an iframe.
- New: advanced-iframe is now also possible instead of advanced_iframe as shortcode
- New: If you set scrolling to 'Not rendered' the attribute scrolling is not rendered to the iframe. This makes it possible to set this with css and make the scrollbar responsive as well.

= 3.4.3 =
- New: Added a section in the FAQ how to use the advanced iframe multiple times on one installation

= 3.4.2 =
- New: the style for the site is now inline because it was only one style. Now no extra css is loaded anymore.

= 3.4.1 =
- Fix: Url of the support page was not starting with http and therefore not working
- Fix: Url where checked with the sanizize functions of Wordpress. This was too strict. Now esc_url() is used and stuff like %E5 does work as well in the url.

= 3.4 =
- New: Basic support for multiple advanced iframes on one page. All generated public Javascript functions have now the id included in the name. Cookies and additional_height are not supported yet because they are used as global variables in the external js file. 
- New: additional_height has to be a number. px or % are now automatically removed to avoid Javascript errors.
- Fix: forewarded parameters are now urlencoded. e.g. keyword=gr%E5%E5sen is now passed properly.

= 3.3 =
- Fix: the height was not detected properly with firefox and some doctypes. Now a more advanced way to determine the height is used which works now fine for Firefox as well.

= 3.2 =
- New: Paid support. Because some settings are quite advenced I now also offer paid support.
- New: Iframe checker: Checks the headers if a page can be included into an iframe.
- New: Javascript onload solution hiding the iframe until the content is loaded. 
- Fix: some shortcodes in the administration where not correct because of copy and paste.

= 3.1 =
- New: Javascript onload solution for resizing the iframe dynamically to the width of the content. 
- New: Resize on AJAX events. Works for jQuery and direct XMLHttpRequest on the same domain. 
- New: Resize on click. You can specify the elements and a timeout when the resize should happen.
- New: Scroll position is now saved and restored after the resize.
- Fix: iFrames are now also made smaller at content resize in all browsers

= 3.0 =
- A page or part of a page can now be embedded directly to the page with jQuery if the page is on the same domain. See the  new section 'Include content directly'.
- Tested with Wordpress 3.5.1

= 2.1 =
- Show only a specifiy part of the page in the iframe if the pages are on the same domain.

= 2.0.2 =
- Tested with Wordpress 3.5

= 2.0.1 =
- Fix: The included footer was causing an Javascript error on non advanced iframe pages. Now I check if the function does exist.   

= 2.0 =
- New: onload attribute added
- New: Javascript onload solution for scolling the parent page to the top.
- New: Javascript onload solution for resizing the iframe dynamically to the height of the content. 
- New: Javascript solution for the scrolling and resizing that works cross domain as well.  
- New: Hide elements/modify css modify speed was dramatically improved. The function is now not called only in the ready event of JQuery but also directly before the footer. This causes that you don't see the changes most of the time anymore!
- New: An additional css file can be added to the parent page.
- New: An additional Javascript file can be added to the parent page.
- New: Hide areas inside iframe if the pages are on the same domain.
- New: Modify css styles inside iframe if the pages are on the same domain to e.g. change the width of the content area. 

= 1.5 =
Support for src values that are hotlinked by the editor. 
Fixed the typo in the doumentation. in securitykey sometimes the r was missing 

= 1.4 =
Documentation updated
New: id and name attribute added

= 1.3.2 =
Improved the help
Fix: css was not loaded because old css name was used

= 1.3.1 =
Fix: Improved error message if a &nbsp; is in the shortcode instead of a normal space.

= 1.3 =
Fix: content_id,content_styles,hide_elements was always used from the config even when a shortcode was given. Now the shortcode is used as well.

= 1.2 =
Fix: The src was not working in the shortcode. I missed to rename this parameter when making this plugin more generic.

= 1.1 =
Fix: The iframe was always printed first. Now it is printed exacly where the shortcode is inserted.

= 1.0 =
First version.