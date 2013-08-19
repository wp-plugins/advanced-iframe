=== Plugin Name ===
Contributors: mdempfle, Michael Dempfle
Donate link: http://www.tinywebgallery.com
Tags: iframe, embed, resize, content, advanced, shortcode, modify css, widget 
Requires at least: 2.8.6
Tested up to: 3.6
Stable tag: 4.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Include content the way YOU like in an iframe that can hide and modify elements and foreward parameters. You can also embed content directly.

== Description ==
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
- Widget support (Pro)

Please note: Modification inside the iframe are only possible if you are on the same domain or use a workaround like described in the settings.

So please check first if the iframe page and the parent page are one the same domain. www.example.com and text.example.com are different domains! Please check in the documentation if you can use the feature you like

A free iframe checker is available at 
http://www.tinywebgallery.com/blog/advanced-iframe/free-iframe-checker.
This tool does check if a page is allowed to be included! 

All settings can be set with shortcode attributes as well. If you only use one iframe please use the settings in the administration because there each parameter is explained in detail and also the defaults are set there.

**[Quick overview of all advanced iframe attributes](http://wordpress.org/extend/plugins/advanced-iframe/other_notes/)**

= Upgrading to Advanced IFrame Pro =

It's quick and painless to get Advanced IFrame Pro. Simply Get Advanced iFrame Pro on CodeCanyon.net (http://codecanyon.net/item/advanced-iframe-pro/5344999) and install your new plugin! You can than use the plugin on commercial, business, and professional sites and blogs. You furthermore get:

- Show only specific areas of the iframe even when the iframe is on different domain
- Widget support
- No view limit

= Administration =  
* Go to Settings -> Advanced iFrame

=	Quick start guide =
To include a webpage to your page please check the following things first:

*	Check if your page page is allowed to be included http://www.tinywebgallery.com/blog/advanced-iframe/free-iframe-checker!
* Check if the iframe page and the parent page are one the same domain. www.example.com and text.example.com are different domains!
* Can you modify the page that should be included?

Most likely you have one of the following setups:

1.	iframe cannot be included:  You cannot include the content because the owner does not allow this. 
1.	iframe can be included and you are on a different domain: You are not allowed to modify the content of the iframe but you can show it or a part of it. To resize the content to the height/width you need to modify the iframe page to enable the provided workaround.
1.	Iframe can be included and you are on the same domain: All features of the plugin can be used. 

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

[advanced_iframe securitykey="" src="" width="" height="" scrolling="" marginwidth="" 
 marginheight="" id="" name="" frameborder="" content_id="" content_styles="" hide_elements="" 
 class="" style="" url_forward_parameter="" onload="" onload_resize="" onload_scroll_top=""
 additional_js="" additional_css="" store_height_in_cookie="" additional_height="" 
 iframe_content_id="" iframe_content_styles="" iframe_hide_elements=""  
 onload_show_element_only=""  include_url="" include_content=""  include_height=""  
 include_fade="" include_hide_page_until_loaded=""  onload_resize_width="", resize_on_ajax=""  
 resize_on_ajax_jquery=""  resize_on_click="" resize_on_click_elements=""  
 hide_page_until_loaded=""]


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
See the demo here:
http://www.tinywebgallery.com/blog/advanced-iframe/demo-advanced-iframe-2-0/

== Upgrade Notice ==
Simply overwrite all files from your previous installation.
If you have some radio elements empty after the update simply 
select the one you like and save again.

== Changelog ==
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