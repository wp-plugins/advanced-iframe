=== Plugin Name ===
Contributors: mdempfle, Michael Dempfle
Donate link: http://www.tinywebgallery.com
Tags: iframe, advanced,  shortcode, widget
Requires at least: 2.8.6
Tested up to: 3.5.1
Stable tag: 2.1

This plugin includes any webpage as shortcode in an advanced iframe that can hide and modify elements and foreward parameters to the iframe.

== Description ==

This plugin includes any webpage as shortcode in an advanced iframe that can hide and modify elements and foreward parameters to the iframe.

= Shortcode for advanced iframe =
By entering the shortcode '[advanced_iframe securitykey=""]' you can include any webpage to any page or article. 
The following differences to a normal iframe are implemented:

- Security code: You can only insert the shortcode with a valid security code from the administration.
- Enable/disable the overwrite of default short code settings
- Hide areas of the layout to give the iframe more space (see screenshot) 
- Modify css styles to e.g. change the width of the content area (see screenshot)
- Forward parameters to the iframe 
- Resize the iframe to the content height (new 2.0)
- Scroll the parent to the top when the iframe is loaded (new 2.0)
- Hide areas inside iframe if the pages are on the same domain (new 2.0)
- Modify css styles inside iframe if the pages are on the same domain to e.g. change the width of the content area (new 2.0) 
- Add a css and js file to the parent page (new 2.0)
- Show only a specifiy part of the page in the iframe if the pages are on the same domain (new 2.1)

The following shortcode attributes can be used. Please go to the administration for details:

[advanced_iframe securitykey="" src="" width="" height="" scrolling="" marginwidth="" 
 marginheight="" id="" name="" frameborder="" content_id="" content_styles="" hide_elements="" 
 class="" url_forward_parameter="" onload="" onload_resize="" onload_scroll_top=""
 additional_js="" additional_css=""  store_height_in_cookie="" additional_height="" 
 iframe_content_id="", iframe_content_styles="",  iframe_hide_elements="", 
 onload_show_element_only=""]

= Aministration =  
* See Settings -> Advanced iframe
* Enables the configuration of the defaults for the iframe and the modifications on the template.

== Installation ==
There are 2 ways to install the advanced iframe

*Using the Wordpress Admin screen*

1. Click Plugins, Add New
1. Search for advanced iframe
1. Install and Activate it
1. Place '[advanced_iframe securitykey=""]' in your pages or posts. the security key can be found at Settings -> Advanced iframe

*Using FTP*

1. Upload 'advanced-iframe' to the '/wp-content/plugins/' directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Place '[advanced_iframe securitykey=""]' in your pages or posts. the security key can be found at Settings -> Advanced iframe

== Screenshots ==
1. Comparison between normal iframe and advanced iframe wrapper. The red areas are modified by the advanced iframe to display the content better.
2. This image shows the difference with an url forward parameter. In the advanced iframe a sub album is shown while the normal iframe still shows the entry screen.
3. The basic admin screen to enable standard settings
4. The advanced admin screen to enable advanced settings like html and css changes
5. The advanced admin screen to enable Javascript scroll to top and autoresize resize
 
== Frequently Asked Questions ==
= Shortcodes =
Please read the instructions in the administration careful. The documentation there should explain all of your questions!

= Demo =
See the demo here:
http://www.tinywebgallery.com/blog/advanced-iframe/demo-advanced-iframe-2-0/

== Upgrade Notice ==
= 1.0 =
First version.

== Changelog ==
= 2.1 =
Show only a specifiy part of the page in the iframe if the pages are on the same domain.

= 2.0.2 =
Tested with Wordpress 3.5

= 2.0.1 =
Fix: The included footer was causing an Javascript error on non advanced iframe pages. Now I check if the function does exist.   

= 2.0 =
New: onload attribute added
New: Javascript onload solution for scolling the parent page to the top.
New: Javascript onload solution for resizing the iframe dynamically to the height of the content. 
New: Javascript solution for the scrolling and resizing that works cross domain as well.  
New: Hide elements/modify css modify speed was dramatically improved. The function is now not called only in the ready event of JQuery but also directly before the footer. This causes that you don't see the changes most of the time anymore!
New: An additional css file can be added to the parent page.
New: An additional Javascript file can be added to the parent page.
New: Hide areas inside iframe if the pages are on the same domain.
New: Modify css styles inside iframe if the pages are on the same domain to e.g. change the width of the content area. 

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