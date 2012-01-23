=== Plugin Name ===
Contributors: mdempfle, Michael Dempfle
Donate link: http://www.tinywebgallery.com
Tags: iframe, advanced,  shortcode, widget
Requires at least: 2.8.6
Tested up to: 3.2.1
Stable tag: 1.3.3

This plugin includes any webpage as shortcode in an advanced iframe.

== Description ==

This plugin includes any webpage as shortcode in an advanced iframe.

= Shortcode for advanced iframe =
By entering the shortcode '[advanced_iframe secuitykey=""]' you can include any webpage to any page or article. 
The following differences to a normal iframe are implemented:

- Security code: You can only insert the shortcode with a valid security code from the administration.
- Enable/disable the overwrite of default short code settings
- Hide areas of the layout to give the iframe more space (see screenshot) 
- Modify css styles to e.g. change the width of the content area (see screenshot)
- Forward parameters to the iframe 

The following shortcode attributes can be used. Please go to the administration for details:
[advanced_iframe secuitykey="" src="" width="" height="" scrolling="" marginwidth="" marginheight="" 
 frameborder="" content_id="" content_styles="" hide_elements="" class="" url_forward_parameter=""]

= Aministration =  
* See Settings -> Advanced iframe
* Enables the configuration of the defaults for the iframe and the modifications on the template.

== Installation ==
There are 2 ways to install the advanced iframe

*Using the Wordpress Admin screen*

1. Click Plugins, Add New
1. Search for advanced iframe
1. Install and Activate it
1. Place '[advanced_iframe secuitykey=""]' in your pages or posts. the security key can be found at Settings -> Advanced iframe

*Using FTP*

1. Upload 'advanced-iframe' to the '/wp-content/plugins/' directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Place '[advanced_iframe secuitykey=""]' in your pages or posts. the security key can be found at Settings -> Advanced iframe

== Screenshots ==
1. Comparison between normal iframe and advanced iframe wrapper. The red areas are modified by the advanced iframe to display the content better.
2. This image shows the difference with an url forward parameter. In the advanced iframe a sub album is shown while the normal iframe still shows the entry screen.
3. The basic admin screen to enable standard settings
4. The advanced admin screen to enable advanced settings like html and css changes
 
== Frequently Asked Questions ==
Please read the instructions in the administration careful.

== Upgrade Notice ==
= 1.0 =
First version.

== Changelog ==
= 1.3.3 =
Documentation updated

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