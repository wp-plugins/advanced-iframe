/**
 *  Advanced iframe free/pro functions v6.5 
*/ 
var aiEnableCookie=false; 
var aiId='';
var aiExtraSpace = 0;

aiReadyCallbacks = ( typeof aiReadyCallbacks !== 'undefined' && aiReadyCallbacks instanceof Array ) ? aiReadyCallbacks : [];
                    

/**
 *  This function resizes the iframe after loading to the height 
 *  of then content of the iframe. 
 *  
 *  The extra space is not stored in the cookie! The height would 
 *  be added every time otherwise and the iframe would grow,  
 */ 
function aiResizeIframe(obj, resize_width) { 
  try {
    if (obj.contentWindow.document.body != null) {
      var oldScrollposition = jQuery(document).scrollTop();     
      obj.height = 1; // set to 1 because otherwise the iframe does never get smaller.
      var newheight = aiGetIframeHeight(obj);
      obj.height = newheight + 'px'; 
      
      // set the height of the zoom div
      if (jQuery('#ai-zoom-div-' + obj.id).length != 0) {
         var zoom = window["zoom_" + obj.id];
         jQuery('#ai-zoom-div-' + obj.id).css("height", newheight * zoom);
      }
      
      if (aiEnableCookie && aiExtraSpace == 0 ) {  
          aiWriteCookie(newheight);
      }
      jQuery(document).scrollTop(oldScrollposition);
      if (resize_width == 'true') { 
        obj.width = aiGetIframeWidth(obj) + 'px';
      }
      var fCallback = window["resizeCallback" + obj.id];
      fCallback();
    } else {
      // body is not loaded yet - we wait 100 ms.
      setTimeout(function() { aiResizeIframe(obj, resize_width); },100); 
    }
  } catch(e) {
    if (console && console.log) {
      console.log("Advanced iframe configuration error: You have enabled the resize of the iframe for pages on the same domain. But you use an iframe page on a different domain. You need to use the external workaround like described in the settings. Also check the next log. There the browser message for this error is displayed.");
      console.log(e);
    } 
  }
}

/**
 *  Get the iframe height
 */ 
function aiGetIframeHeight(obj) {
      var bodyHeight = Math.max(obj.contentWindow.document.body.scrollHeight, 
       obj.contentWindow.document.body.offsetHeight, 
       obj.contentWindow.document.documentElement.scrollHeight, 
       obj.contentWindow.document.documentElement.offsetHeight);
       var newheight = bodyHeight + aiExtraSpace;
       return newheight; 
}

/**
 *  Get the iframe width
 */ 
function aiGetIframeWidth(obj) {
    var oldWidth =  obj.width;
    obj.width = 1; // set to 1 because otherwise I don't get the minimum width 
    var bodyWidth = Math.max(obj.contentWindow.document.body.scrollWidth, 
          obj.contentWindow.document.body.offsetWidth, 
          obj.contentWindow.document.documentElement.scrollWidth, 
          obj.contentWindow.document.documentElement.offsetWidth);
    if (bodyWidth != 1) { // avoid that fully responsive sites do not get displayed at all.
      obj.width = bodyWidth + 'px'; 
    } else {
      obj.width = oldWidth;   
    }       
    return bodyWidth;
}

/**
 *  Get the current width of the iframe inside the parent. 
 */ 
function aiGetParentIframeWidth(obj) {
    if (obj != null && jQuery("#" + obj.id).length != 0) {
        return jQuery("#" + obj.id).width();
    } else {
        return -1;
    } 
}


/**
 *  Resizes an iframe to a given height.
 *  this is used for xss enabled iframes.
 *  Please read the documentation!   
 */ 
function aiResizeIframeHeightById(id, nHeight) {
  try {  
    var fCallback = window["resizeCallback" + id];
    fCallback();
    var height = parseInt(nHeight) + aiExtraSpace;
    var iframe = document.getElementById(id); 
		var oldScrollposition = jQuery(document).scrollTop();
    iframe.setAttribute('height', height + 'px');
    jQuery(document).scrollTop(oldScrollposition);
    if (aiEnableCookie && aiExtraSpace == 0) {
      aiWriteCookie(height);
    }
  }  catch(e) {
    if (console && console.log) {
      console.log("Advanced iframe configuration error: The id of the parent and the external workaround are different! Check your settings.");
      console.log(e);
    } 
  }
}


/**
 * Scrolls the parent window to the top.
 * This is e.g. wanted when you have a link in the iframe and you want that the 
 * page starts at the top and not that only the iframe changes. 
 */ 
function aiScrollToTop() {
  window.scrollTo(0,0); 
}

/**
 * Writes the last height to the cookie.
 */ 
function aiWriteCookie(height) {
  var cookieName = 'ai-last-height'; 
  if (aiId != '') {
    cookieName =  cookieName + '-' + aiId ;
  }
  var cookieStr = cookieName + "=" + height;
  document.cookie=cookieStr;
}

/**
 * Reads the cookie and preset the height of the iframe
 */ 
function aiUseCookie() {
  var cookieName = 'ai-last-height'; 
  if (aiId != '') {
    cookieName = cookieName + '-' + aiId ;
  } 
  var allcookies = document.cookie;
  // Get all the cookies pairs in an array
  cookiearray  = allcookies.split(';');
  // Now take key value pair out of this array
  for(var i=0; i<cookiearray.length; i++){
    name = cookiearray[i].split('=')[0];
    value = cookiearray[i].split('=')[1];
    // alert("Key is : " + name + " and Value is : " + value);
    // cookie does exist and has a numeric value
    if (name == cookieName && value != null && ai_is_numeric(value)) { 
       var iframe = document.getElementById(aiId);
	     iframe.setAttribute('height', (parseInt(value)) + 'px');
    } 
  }                               
}

/**
 *  check if we have a numeric input
 */ 
function ai_is_numeric(input){
    return !isNaN(input);
}

/**
* Disable the additional_height input field
*/     
function aiDisableHeight() {
  jQuery("#additional_height").attr('readonly','readonly');
  jQuery("#additional_height").val('0');
}

/**
* Enable the additional_height input field
*/    
function aiEnableHeight() {
  jQuery("#additional_height").removeAttr('readonly');
}

/**
 * Removes all elements from an iframe except the given one
 * 
 * @param iframeId id of the iframe
 * @param showElement the id, class (jQuery syntax) of the element that should be displayed. 
 */ 
function aiShowElementOnly( iframeId, showElement ) {
  try {
    var iframe = jQuery(iframeId).contents().find("body"); 
    var selectedBox = iframe.find(showElement).clone(true,true); 
    iframe.find("*").not(jQuery('script')).remove();
    iframe.prepend(selectedBox);
  }  catch(e) {
    if (console && console.log) {
      console.log("Advanced iframe configuration error: You have enabled to show only one element of the iframe for pages on the same domain. But you use an iframe page on a different domain. You need to use the pro version of the external workaround like described in the settings. Also check the next log. There the browser message for this error is displayed.");
      console.log(e);
    } 
  }
}

function checkIfValidTarget(evt, elements) {
  var targ;
  if (!evt) var e = window.event;
  if (evt.target) targ = evt.target;
  else if (evt.srcElement) targ = evt.srcElement;
  if (targ.nodeType == 3) {	targ = targ.parentNode; }
  
  var parts = elements.split(','); 
  // check each part if we have a match...
  for (var i=0; i< parts.length; ++i) {
    var selectorArray = parts[i].split(":");   
    if (selectorArray[0].toLowerCase() === targ.nodeName.toLowerCase()) {
      if (selectorArray.length > 1) {
           if (targ.id.toLowerCase().indexOf(selectorArray[1].toLowerCase()) !== -1) {
               return true;
           }
      } else {
        return true;
      }
    } 
  }
  return false;
}

function openSelectorWindow (url) {
   var local_width =  jQuery("#width").val();
   var local_height = jQuery("#height").val();

   if (local_width.indexOf("%") >= 0 || Number(local_width) < 900) {
       local_width = 900;   
   }
   local_width = Number(local_width) + 40;
   if ( local_width > (screen.width)) {
       local_width = screen.width; 
   }     
   if (local_height.indexOf("%") >= 0) {
       local_height = screen.height;   
   } else {
        local_height =  Number(local_height) + 480; 
   }
   if ( local_height > (screen.height-50)) {
       local_height = screen.height-50; 
   } 
   var options = "width="+local_width+",height="+local_height+",left=0,top=0,resizable=1,scrollbars=1";
   var popup_window = window.open(url, "", options);
   popup_window.focus();
}

function openTab(id) {
    jQuery(id).next().show(); 
}

var instance;

/**
 *  This function initializes all checks that are done by Javascript
 *  on the admin page like enabling disabling fields... 
 */ 
function initAdminConfiguration(isPro, acc_type) {
  
    // enable checkbox of onload_resize_delay and if resize is set to true external workaround is set to false
    if (jQuery('input[type=radio][name=onload_resize]:checked').val() == 'false') {
        jQuery('#onload_resize_delay').prop('readonly',true);
    }     
    jQuery('input[type=radio][name=onload_resize]').click( function(){
    if (jQuery(this).val() == 'true') {
           jQuery('#onload_resize_delay').prop('readonly', false);
           jQuery('input:radio[name=enable_external_height_workaround]')[1].checked = true;
        } else {
           jQuery('#onload_resize_delay').prop('readonly', true);
           jQuery('#onload_resize_delay').val('');
        }
    });
    
    // if external workaround is set to to true resize on load is set to false and the 
    // onload_resize_delay is made readonly
    jQuery('input[type=radio][name=enable_external_height_workaround]').click( function(){
    if (jQuery(this).val() == 'true') {
           jQuery('input:radio[name=onload_resize]')[1].checked = true;
           jQuery('#onload_resize_delay').prop('readonly', true);
           jQuery('#onload_resize_delay').val('');
        }
    });
 
    // Show only a part of the iframe enable/disable
     if (jQuery('input[type=radio][name=show_part_of_iframe]:checked').val() == 'false') {
        jQuery('#show_part_of_iframe_x').prop('readonly',true);
        jQuery('#show_part_of_iframe_y').prop('readonly',true);
        jQuery('#show_part_of_iframe_height').prop('readonly',true);
        jQuery('#show_part_of_iframe_width').prop('readonly',true);         
        jQuery('input[id=show_part_of_iframe_allow_scrollbar_horizontal]:radio').attr('disabled',true);  
        jQuery('input[id=show_part_of_iframe_allow_scrollbar_vertical]:radio').attr('disabled',true);  
        jQuery('#show_part_of_iframe_next_viewports').prop('readonly',true);
        jQuery('input[id=show_part_of_iframe_next_viewports_loop]:radio').attr('disabled',true);
        jQuery('#show_part_of_iframe_new_window').prop('readonly',true);
        jQuery('#show_part_of_iframe_new_url').prop('readonly',true);
        jQuery('input[id=show_part_of_iframe_next_viewports_hide]:radio').attr('disabled',true); 
        jQuery('#show_part_of_iframe_style').prop('readonly',true);         
     }
      jQuery('input[type=radio][name=show_part_of_iframe]').click( function(){
    if (jQuery(this).val() == 'false') {
          jQuery('#show_part_of_iframe_x').prop('readonly',true);
          jQuery('#show_part_of_iframe_y').prop('readonly',true);
          jQuery('#show_part_of_iframe_height').prop('readonly',true);
          jQuery('#show_part_of_iframe_width').prop('readonly',true);
          jQuery('input[id=show_part_of_iframe_allow_scrollbar_horizontal]:radio').attr('disabled',true);  
          jQuery('input[id=show_part_of_iframe_allow_scrollbar_vertical]:radio').attr('disabled',true);  
          jQuery('#show_part_of_iframe_next_viewports').prop('readonly',true);
          jQuery('input[id=show_part_of_iframe_next_viewports_loop]:radio').attr('disabled',true);
          jQuery('#show_part_of_iframe_new_window').prop('readonly',true);
          jQuery('#show_part_of_iframe_new_url').prop('readonly',true);
          jQuery('input[id=show_part_of_iframe_next_viewports_hide]:radio').attr('disabled',true);
          jQuery('#show_part_of_iframe_style').prop('readonly',true);         
        } else {
          jQuery('#show_part_of_iframe_x').prop('readonly',false);
          jQuery('#show_part_of_iframe_y').prop('readonly',false);
          jQuery('#show_part_of_iframe_height').prop('readonly',false);
          jQuery('#show_part_of_iframe_width').prop('readonly',false);
          jQuery('input[id=show_part_of_iframe_allow_scrollbar_horizontal]:radio').attr('disabled',false);  
          jQuery('input[id=show_part_of_iframe_allow_scrollbar_vertical]:radio').attr('disabled',false);  
          jQuery('#show_part_of_iframe_next_viewports').prop('readonly',false);
          jQuery('input[id=show_part_of_iframe_next_viewports_loop]:radio').attr('disabled',false);
          jQuery('#show_part_of_iframe_new_window').prop('readonly',false);
          jQuery('#show_part_of_iframe_new_url').prop('readonly',false);
          jQuery('input[id=show_part_of_iframe_next_viewports_hide]:radio').attr('disabled',false);
          jQuery('#show_part_of_iframe_style').prop('readonly',false);         
    
        }
    }); 
    
    // if expert mode
    if (jQuery('input[type=radio][name=expert_mode]:checked').val() == 'true') {
      jQuery('.description').css('display','none');
      jQuery('table.form-table th').css('cursor','pointer');
      jQuery('table.form-table th').css('padding-top','8px').css('padding-bottom','2px'); 
      jQuery('table.form-table td').css('padding-top','5px').css('padding-bottom','5px'); 
      jQuery('table.form-table th').click(function() {
           jQuery('.description').css('display','none');
           jQuery('.description', jQuery(this).parent()).css('display','block');
        }); 
    }
    jQuery('input[type=radio][name=expert_mode]').click( function(){
      if (jQuery(this).val() == 'false') {
        jQuery('.description').css('display','block');
        jQuery('table.form-table th').css('cursor','auto');
        jQuery('table.form-table th').off("click");
        jQuery('table.form-table th').css('padding-top','20px').css('padding-bottom','20px'); 
        jQuery('table.form-table td').css('padding-top','15px').css('padding-bottom','15px'); 
      } else {
        jQuery('.description').css('display','none');
        jQuery('table.form-table th').css('cursor','pointer');  
        jQuery('table.form-table th').css('padding-top','8px').css('padding-bottom','2px'); 
        jQuery('table.form-table td').css('padding-top','5px').css('padding-bottom','5px'); 
        jQuery('table.form-table th').click(function() {
           jQuery('.description').css('display','none');
           jQuery('.description', jQuery(this).parent()).css('display','block');
        }); 
      }
    });

   
   if (isPro && (acc_type !== "false")) {
       jQuery('#accordion').find('h1').click(function(){
           jQuery(this).next().slideToggle();
       }).next().hide(); 
       
       jQuery('#accordion').find('a').click(function(){
           var hash = jQuery(this).prop("hash");
           var hash_only = "#h1-" + hash.substring(1);
           jQuery(hash_only).next().show(); 
           location.hash = hash_only;
       });
       var hash = jQuery("#" + acc_type).next().show(); 
   } 
   
    // lazy load
    if (jQuery('input[type=radio][name=enable_lazy_load_manual]:checked').val() == 'false') {
        jQuery('#enable_lazy_load_manual_element').prop('readonly',true);
    }  
   
    jQuery('input[type=radio][name=enable_lazy_load_manual]').click( function(){
    if (jQuery(this).val() == 'false' || jQuery(this).val() == 'auto') {
           jQuery('#enable_lazy_load_manual_element').prop('readonly',true);            
        } else {
           jQuery('#enable_lazy_load_manual_element').prop('readonly',false);
        }
    });
    
    if (jQuery('input[type=radio][name=enable_lazy_load]:checked').val() == 'false') {
        jQuery('#enable_lazy_load_threshold').prop('readonly',true);
        jQuery('#enable_lazy_load_fadetime').prop('readonly',true);
        jQuery('input[id=enable_lazy_load_manual1]:radio').attr('disabled',true);  
        jQuery('input[id=enable_lazy_load_manual2]:radio').attr('disabled',true);  
        jQuery('input[id=enable_lazy_load_manual3]:radio').attr('disabled',true);  
        jQuery('#enable_lazy_load_manual_element').prop('readonly',true);
    }  

    jQuery('input[type=radio][name=enable_lazy_load]').click( function(){
    if (jQuery(this).val() == 'false') {
           jQuery('#enable_lazy_load_threshold').prop('readonly', true); 
           jQuery('#enable_lazy_load_fadetime').prop('readonly', true); 
           jQuery('input[id=enable_lazy_load_manual1]:radio').attr('disabled',true); 
           jQuery('input[id=enable_lazy_load_manua12l]:radio').attr('disabled',true);  
           jQuery('input[id=enable_lazy_load_manual3]:radio').attr('disabled',true);           
           jQuery('#enable_lazy_load_manual_element').prop('readonly',true);            
        } else {
           jQuery('#enable_lazy_load_threshold').prop('readonly', false);
           jQuery('#enable_lazy_load_fadetime').prop('readonly', false); 
           jQuery('input[id=enable_lazy_load_manual1]:radio').attr('disabled',false);          
           jQuery('input[id=enable_lazy_load_manual2]:radio').attr('disabled',false); 
           jQuery('input[id=enable_lazy_load_manual3]:radio').attr('disabled',false); 
           if (jQuery('input[type=radio][name=enable_lazy_load_manual]:checked').val() == 'false' ||
               jQuery('input[type=radio][name=enable_lazy_load_manual]:checked').val() == 'auto' ) {
             jQuery('#enable_lazy_load_manual_element').prop('readonly',true);
           } else {
             jQuery('#enable_lazy_load_manual_element').prop('readonly', false);
           }
        }
    }); 
    
    jQuery('.confirmation').on('click', function () {
        return confirm('Are you sure?');
    }); 
    
     jQuery("a.post").click(function(e) {
          e.stopPropagation();
          e.preventDefault();
          var href = this.href;
          var parts = href.split('?');
          var url = parts[0];
          var params = parts[1].split('&');
          var pp, inputs = '';
          url += "?" + params[0]; 
          for(var i = 1, n = params.length; i < n; i++) {
              pp = params[i].split('=');
              inputs += '<input type="hidden" name="' + pp[0] + '" value="' + pp[1] + '" />';
          }
          jQuery("body").append('<form action="'+url+'" method="post" id="poster">'+inputs+'</form>');
          jQuery("#poster").submit();
      }); 
           
      jQuery(".ai-input-search").keyup(function(e) {
           var searchTerm = jQuery("input.ai-input-search").val().toLowerCase();
           aiSettingsSearch(searchTerm);
      });
       jQuery(".ai-input-search").on('click', function(e) {
           setTimeout(function() {
           var searchTerm = jQuery("input.ai-input-search").val().toLowerCase();
           aiSettingsSearch(searchTerm);
           }, 100);
      }); 
      
      jQuery(document).on( 'click', '.nav-tab-wrapper a', function() {
        var current_tab = jQuery(this).index();
        jQuery('section').hide();
        jQuery('section').eq(current_tab).show();
        jQuery('#current_tab').val(current_tab);
        jQuery('.nav-tab').removeClass('nav-tab-active');
        jQuery(this).addClass('nav-tab-active');
        jQuery(this).blur();
        return false;
      }) 
      
      // set the links between tabs and open the right one at the right section.
      if (acc_type === "false") {
        jQuery(document).on( 'click', 'a#external-workaround-link', function() {
          jQuery('.external-workaround').click();
          jQuery(document).scrollTop(0);
          return false;
        }) 
        jQuery(document).on( 'click', 'a#resize-same-link', function() {
          jQuery('.advanced-settings-tab').click();
          location.hash = 'rt';
          return false;
        })
        jQuery(document).on( 'click', 'a#modify-content-link', function() {
          jQuery('.advanced-settings-tab').click();
          location.hash = 'modifycontent';
          return false;
        })
         jQuery(document).on( 'click', 'a.jquery-help-link', function() {
          jQuery('.help-tab').click();
          jQuery('#jquery-help').show();
          location.hash = 'jqh';
          return false;
        })
        jQuery(document).on( 'click', 'a#browser-detection-link', function() {
          jQuery('.help-tab').click();
          jQuery('#browser-help').show();
          location.hash = 'browser-detection';
          return false;
        })
      }
      
      jQuery(document).on( 'click', 'a#user-help-link', function() {
          jQuery('#user-help').css('display', 'block');
          return false;
      }) 
      jQuery(document).on( 'click', 'a#user-meta-link', function() {
          jQuery('#meta-help').css('display', 'block');
          return false;
      })                      
}

function aiSettingsSearch(searchTerm) {
 var found = 0;
 
 if (searchTerm !== '') { 
   jQuery("#ai p").not(".form-table p").hide();
   jQuery("#ai .ai-anchor").hide();
   jQuery("#ai ul").not(".form-table ul").hide();
   jQuery("#ai ol").not(".form-table ol").hide();
   jQuery("#ai h2,#ai .icon_ai,#ai h3,#ai h4").not(".show-always").hide();  
   jQuery("#ai .form-table").addClass("ai-remove-margin");
   jQuery("#ai hr, .signup_account_container").hide(); 
 } else {
   jQuery("#ai p").not(".form-table p").show();
   jQuery("#ai .ai-anchor").show();
   jQuery("#ai ul").not(".form-table ul").show();
   jQuery("#ai ol").not(".form-table ol").show();
   jQuery("#ai h2,#ai .icon_ai,#ai h3,#ai h4").not(".show-always").show();  
   jQuery("#ai .form-table").removeClass("ai-remove-margin");
   jQuery("#ai hr, .signup_account_container").show();
 }

 // check the search.
  jQuery("#ai tr").each(function() {
    $this = jQuery(this);
    var valueLabel = $this.find("th").text();
    var valueDescription = $this.find("p.description").text();
    
    valueLabel = (valueLabel !== undefined) ?  valueLabel.toLowerCase() : "XXXXXXX"; 
    valueDescription = (valueDescription !== undefined) ?  valueDescription.toLowerCase() : "XXXXXXX";
    
    if (valueLabel.indexOf(searchTerm) == -1 && valueDescription.indexOf(searchTerm) == -1) {
      $this.addClass("hide-setting");   
    } else {
      $this.closest("table").prevAll("h2:first").show(); 
      $this.closest("table").prevAll("#ai .icon_ai:first").show(); 
      $this.closest("table").nextAll("p.button-submit:first").show(); 
      $this.removeClass("hide-setting"); 
      found++;     
    }
  });
  if (found === 0) {
    jQuery("#ai-input-search-result").show();
  } else {
    jQuery("#ai-input-search-result").hide();
    // https://github.com/padolsey/findAndReplaceDOMText
    instance && instance.revert();
      if (searchTerm !== '' && searchTerm.length > 2) { 
      var regex = RegExp(searchTerm, 'gi');
      instance = findAndReplaceDOMText(document.getElementById('ai'), {
        find: regex,
        wrap: 'em'  
      });
    }
  }
}


/**
 *  Resizes the iframe with a certain ratio.
 *  Width is read and the height is than calculated. 
 */ 
function aiResizeIframeRatio(obj, ratio) {
   var width = jQuery("#" + obj.id).width();  
   var valueRatio = parseFloat(ratio.replace(",", "."));
   var newHeight = Math.ceil(width * valueRatio); 
   obj.height = newHeight + 'px';  
}

/**
 * Generate a shortcode string from the current settings.
 */ 
function aiGenerateShortcode() {
    var output = '[advanced_iframe ';

    // default section
    output += 'securitykey="' + jQuery("#securitykey").val() + '" ';
    output += 'use_shortcode_attributes_only="true" ';
 
    var include_html_val = jQuery("#include_html").val();
    var include_url_val = jQuery("#include_url").val();
    if (include_html_val == "" && include_url_val == "")  { 
        var src = jQuery("#src").val();
        if (src == "") {
           alert("Required url is missing.");
        } else {
           output += 'src="' + src + '" ';
        }
        
        output += aiGenerateTextShortcode("width");
        output += aiGenerateTextShortcode("height");  
        output += aiGenerateRadioShortcode("scrolling","auto");      
        output += aiGenerateTextShortcode("marginwidth");
        output += aiGenerateTextShortcode("marginheight");     
        output += aiGenerateTextShortcode("frameborder");      
        output += aiGenerateRadioShortcode("transparency","true"); 
        output += aiGenerateTextShortcode("class");  
        output += aiGenerateTextShortcode("style");  
        output += aiGenerateTextShortcode("id");  
        output += aiGenerateTextShortcode("name");  
        output += aiGenerateRadioShortcode("allowfullscreen","false");
       
        // advanced settings
        output += aiGenerateTextShortcode("url_forward_parameter");  
        output += aiGenerateTextShortcode("map_parameter_to_url");  
        output += aiGenerateRadioShortcode("add_iframe_url_as_param","false");
        output += aiGenerateTextShortcode("add_iframe_url_as_param_prefix");   
        
        output += aiGenerateRadioShortcode("onload_scroll_top","false");
        output += aiGenerateRadioShortcode("hide_page_until_loaded","false");
        output += aiGenerateRadioShortcode("show_iframe_loader","false");   
        output += aiGenerateTextShortcode("hide_content_until_iframe_color");
        output += aiGenerateTextShortcode("iframe_zoom");
        output += aiGenerateRadioShortcode("iframe_zoom_ie8", "false");
        output += aiGenerateRadioShortcode("use_zoom_absolute_fix", "false"); 
        output += aiGenerateRadioShortcode("auto_zoom", "false");
        output += aiGenerateTextShortcode("auto_zoom_by_ratio");
        
        output += aiGenerateRadioShortcode("enable_responsive_iframe","false");
        output += aiGenerateTextShortcode("iframe_height_ratio");
        
          
        output += aiGenerateRadioShortcode("enable_lazy_load","false");
        output += aiGenerateTextShortcodeWithDefault("enable_lazy_load_threshold","3000");
        output += aiGenerateRadioShortcode("enable_lazy_load_reserve_space","true");
        
        output += aiGenerateTextShortcode("enable_lazy_load_fadetime");
        output += aiGenerateRadioShortcode("enable_lazy_load_manual","false");
        output += aiGenerateRadioShortcode("enable_lazy_load_manual_element","false");
        output += aiGenerateTextShortcode("reload_interval");
    
        // modify the parent page
       output += aiGenerateTextShortcode("hide_elements");
       output += aiGenerateTextShortcode("content_id");
       output += aiGenerateTextShortcode("content_styles");
       output += aiGenerateRadioShortcode("add_css_class_parent","false");  
    
       output += aiGenerateTextShortcode("change_parent_links_target");
       output += aiGenerateRadioShortcode("show_iframe_as_layer", "false");
    
       // show only a part of the iframe
       var showPartOfIframe = aiGenerateRadioShortcode("show_part_of_iframe","false");  
       output += showPartOfIframe;  
       
       if (showPartOfIframe != '') {
         output += aiGenerateTextShortcodeWithDefault("show_part_of_iframe_x",-1);
         output += aiGenerateTextShortcodeWithDefault("show_part_of_iframe_y",-1);
         output += aiGenerateTextShortcode("show_part_of_iframe_width");
         output += aiGenerateTextShortcode("show_part_of_iframe_height");
         output += aiGenerateRadioShortcode("show_part_of_iframe_allow_scrollbar_horizontal","false");  
         output += aiGenerateRadioShortcode("show_part_of_iframe_allow_scrollbar_vertical","false");  
         output += aiGenerateTextShortcode("show_part_of_iframe_style");
         
         output += aiGenerateTextShortcode("show_part_of_iframe_next_viewports");
         output += aiGenerateRadioShortcode("show_part_of_iframe_next_viewports_loop","false");  
         output += aiGenerateTextShortcode("show_part_of_iframe_new_window");
         output += aiGenerateTextShortcode("show_part_of_iframe_new_url");
         output += aiGenerateRadioShortcode("show_part_of_iframe_next_viewports_hide","false");  
       }
       output += aiGenerateTextShortcode("hide_part_of_iframe");
       // same domain
       output += aiGenerateRadioShortcode("add_css_class_iframe","false");  
       output += aiGenerateTextShortcode("iframe_hide_elements");
       output += aiGenerateTextShortcode("onload_show_element_only");
       output += aiGenerateTextShortcode("iframe_content_id");
       output += aiGenerateTextShortcode("iframe_content_styles");
       output += aiGenerateTextShortcode("iframe_content_css");
       output += aiGenerateTextShortcode("change_iframe_links");
       output += aiGenerateTextShortcode("change_iframe_links_target");
       // resize content height
       output += aiGenerateTextShortcode("onload");
       output += aiGenerateRadioShortcode("onload_resize","false");  
       output += aiGenerateTextShortcode("onload_resize_delay");
       output += aiGenerateRadioShortcode("store_height_in_cookie","false");  
       output += aiGenerateTextShortcode("additional_height");
       output += aiGenerateRadioShortcode("onload_resize_width","false");  
       output += aiGenerateTextShortcode("resize_on_ajax");
       output += aiGenerateRadioShortcode("resize_on_ajax_jquery","true");  
       output += aiGenerateTextShortcode("resize_on_click");
       output += aiGenerateTextShortcodeWithDefault("resize_on_click_elements","a");  
       
       output += aiGenerateTextShortcode("resize_on_element_resize");
       output += aiGenerateTextShortcodeWithDefault("resize_on_element_resize_delay","250");  
    
       // tabs
       output += aiGenerateTextShortcode("tab_hidden");
       output += aiGenerateTextShortcode("tab_visible");
       // cross domain ....
       output += aiGenerateRadioShortcode("enable_external_height_workaround","false");  
       output += aiGenerateRadioShortcode("hide_page_until_loaded_external","false");  
       output += aiGenerateTextShortcode("pass_id_by_url");
       // additional files
       output += aiGenerateTextShortcode("additional_css");
       output += aiGenerateTextShortcode("additional_js");
       output += aiGenerateTextShortcode("additional_js_file_iframe");
       output += aiGenerateTextShortcode("additional_css_file_iframe");
   } else { // include content directly
      if (include_html_val == "")  {
         output += aiGenerateTextShortcode("include_url");  
         output += aiGenerateTextShortcode("include_content");
         output += aiGenerateTextShortcode("include_height");
         output += aiGenerateTextShortcode("include_fade");
         output += aiGenerateRadioShortcode("include_hide_page_until_loaded","false"); 
      } else { 
         output += aiGenerateTextShortcode("include_html"); 
      } 
   }
    
   output += "]";
   jQuery('#gen-shortcode').html(output);  
}

/**
 * Generate a text shortcode with default
 */ 
function aiGenerateTextShortcodeWithDefault(field, defaultValue) {
    var output = "";
    var value = jQuery('#' + field);
    var val = value.val();
    if (value.length > 0 && val != '' && val != defaultValue) {
        output = field + '="' + val + '" ';
    }  
    return output;     
}

/**
 * Generate a text shortcode if the value is not empty or != 0
 */ 
function aiGenerateTextShortcode(field) {
    var output = "";
    var value = jQuery('#' + field);
    var val = value.val();
    if (value.length > 0 && val != '' && val != '0') {
        output = field + '="' + val + '" ';
    }    
    return output;     
}

/**
 * Generate a radio shortcode with default
 */ 
function aiGenerateRadioShortcode(field, defaultValue) {
    var output = "";
    var value = jQuery('input:radio[name='+field+']:checked');
    var val = value.val();
    if (value.length > 0 && val != defaultValue) {
        output += field + '="' + val + '" ';
    }
    return output;    
}

/**
 * Add a css class to the parents to enable that the iframe parents 
 * can be identified very easy. Is an is ist set ai-class-<id> is used.
 * Otherwise a-class-<number> with an increasing number is used.   
 */ 
function aiAddCssClassAllParents(element) {
  var parents = jQuery(element).parentsUntil( "html" );
  var ai_class= "ai-class-";
  for(var i = 0; i < parents.length; i++){
    var id = jQuery(parents[i]).attr('id');
    if (typeof id !== 'undefined') {
      if (!(id.indexOf('ai-') == 0)) {
          jQuery(parents[i]).addClass(ai_class + id);
      }
    } else {
      jQuery(parents[i]).addClass(ai_class + i);
    } 
  }
}

function aiAutoZoomExternalHeight(id, width, height, responsive) {
    var parentWidth = aiAutoZoomExternal(id, width, responsive);
    var zoomRatio = window["zoom_" + id] 
    var oldScrollposition = jQuery(document).scrollTop();
    var newHeight = Math.ceil(height*zoomRatio);
    jQuery('#ai-zoom-div-' + id).css("height", newHeight);
    jQuery(document).scrollTop(oldScrollposition);
 return parentWidth; 
} 


function aiAutoZoomExternal(id, width, responsive) {
   var obj =  document.getElementById(id);
   var objAround =  document.getElementById("ai-zoom-div-" +id);
   var jObj = jQuery("#" + id);
     
   if (responsive === 'true') {
    jObj.css('max-width', '100%'); 
   }    
   var iframeWidth = width;
   var parentWidth = aiGetParentIframeWidth(obj);
   if (parentWidth == iframeWidth) {
     // we check again the sourounding div as some browser do return the zoomes value!
      var parentWidth = aiGetParentIframeWidth(objAround);
   }
   var zoomRatio = parentWidth / iframeWidth;
   var zoomRatioRounded = Math.floor(zoomRatio * 100) / 100;
   if (zoomRatioRounded > 1) {
     zoomRatioRounded = 1;
   }
   
   setZoom(id, zoomRatioRounded);   
   window["zoom_" + id] = zoomRatioRounded;
   jObj.width(iframeWidth).css('max-width', 'none');
   return parentWidth;
}
function aiAutoZoom(id, responsive, ratio) {
   var parts = ratio.split('|'); 
   ratio = parts[0];
   if (parts.length == 1) {
     var width = -1; 
   } else {
     var width = parts[1]; 
   }
   
   var obj = document.getElementById(id); 
   if (width === -1) {
     obj.width = 1; // set to 1 because otherwise the iframe does never get smaller. 
     var iframeWidth = aiGetIframeWidth(obj);
     obj.width = iframeWidth + 'px';  
   } else {
     iframeWidth = width;
   }
   
   var parentWidth = aiAutoZoomExternal(id, iframeWidth, responsive);  
   if (ratio === '') { 
     aiResizeIframe(obj, false);
   } else {
      var newheight = Math.ceil(iframeWidth * ratio);
      obj.height = newheight + 'px';
      // set the height of the zoom div  
      if (jQuery('#ai-zoom-div-' + obj.id).length != 0) {
         var zoom = window["zoom_" + obj.id];
         jQuery('#ai-zoom-div-' + obj.id).css("height", Math.ceil(newheight * zoom));
      }
   }
   return parentWidth;   
}

/**
 * Set the zoom div settings dynamically.
 */ 
function setZoom(id, zoom) {

  var obj = jQuery('#' + id);

  if (aiIsIe8 === true) {
    obj.css('-ms-zoom', zoom);
  }

  obj.css({
    '-ms-transform': 'scale(' + zoom + ')',
    '-moz-transform': 'scale(' + zoom + ')',
    '-o-transform': 'scale(' + zoom + ')',
    '-webkit-transform': 'scale(' + zoom + ')',
    'transform': 'scale(' + zoom + ')'
  });
}

function resetAiSettings() {
  jQuery('#action').val("reset");
}

function aiCheckInputNumber(inputField) {
    inputField.value = inputField.value.split(' ').join('');
    var f = inputField.value;
    if (inputField.value == '') return;
    // var match = f.match(/^(\-){0,1}[\d\.]+(px|%|em|pt)?[\+\-]?[\d\.]?(px|%|em|pt)?$/);
    var match = f.match(/^(\-){0,1}([\d\.])+(px|%|em|pt)?(\-|\+){0,1}([\d\.]){0,7}(px|%|em|pt)?$/);
    
    if (!match) {
        alert("Please check the value you have entered. Only numbers with a dot or with an optional px, %, em or pt are allowed.");
        setTimeout(function(){inputField.focus();}, 10);
    }
}

function setAiScrollposition() {
  var scrollposition = jQuery(document).scrollTop();   
  jQuery("#scrollposition").val(scrollposition);
}

function resetShowPartOfAnIframe(id) {
  jQuery("#" + id).css("top","0px").css("left","0px").css("position","static");
  jQuery("#ai-div-" + id).css("width","auto").css("height","auto").css("overflow","auto").css("position","static");
}

function ai_showLayerIframe(id, path) { 
  jQuery("#ai-zoom-div-" + id).show();
  jQuery("#" + id).show();
  
  jQuery('body').css("overflow","hidden");
  jQuery('body').append('<img id="ai_backlink" src="'+path+'close.png" onclick="javascript:ai_hideLayerIframe(\''+id+'\');" style="z-index:100001;position:fixed;top:0;right:0;cursor:pointer" />'); 
  jQuery('body').append('<div id="ai_backlayer" href="" style="z-index:999;position:fixed;top:0;left:0;width:100%;height:100%;background-color: rgba(50,50,50,0.5);overflow:hidden;"><!-- --></div>');   
}

function ai_hideLayerIframe(id) {
  jQuery("#" + id).hide();
  jQuery("#ai-zoom-div-" + id).show();
  jQuery("#ai_backlink").remove();
  jQuery("#ai_backlayer").remove();
  jQuery('body').css("overflow","auto");
}

/**
 * This changes the current url and adds or updates the 
 * existing parameter with the given url
 */ 
function aiChangeUrlParam(loc, param, orig, prefix) {

   if (loc != encodeURIComponent(orig)) {
     var newUrl = aiSetGetParameter(param, loc);
     var removeProtocol = true;
     if (prefix) {
       var repUrl = newUrl.replace(prefix,"");
       if (repUrl === newUrl) {
         removeProtocol = false;
       }
       newUrl = repUrl;  
     }
     // remove protocoll
     if (removeProtocol) {
       newUrl = newUrl.replace("http%3A%2F%2F","");
       newUrl = newUrl.replace("https%3A%2F%2F","s|");
     } 
    } else {
      var fullUrl = window.location.href;
      newUrl = aiRemoveURLParameter(fullUrl, param);
    } 
    if (aiSupportsHistoryApi()) {
        window.history.pushState({}, "", newUrl);
        // I asume the back button is clicked.
        window.onpopstate = function(event) {    
          if(event && event.state) {
            window.history.back(); 
          }
        } 
    }
}

function aiSupportsHistoryApi() {
  return !!(window.history && history.pushState);
}

function aigetIframeLocation(id) {
  try {
    var location = document.getElementById(id).contentWindow.location
    return encodeURIComponent(location);
  }  catch(e) {
    if (console && console.log) {
      console.log("Advanced iframe configuration error: You have enabled to add the url to the url on the same domain. But you use an iframe page on a different domain. You need to use the pro version of the external workaround like described in the settings. Also check the next log. There the browser message for this error is displayed.");
      console.log(e);
    } 
  } 
}






/**
 * Replaces a url parameter with a given value.
 */  
function aiSetGetParameter(paramName, paramValue)
{
    var url = window.location.href;
    var splitAtAnchor = url.split('#');
    url = splitAtAnchor[0];
    var anchor = typeof splitAtAnchor[1] === 'undefined' ? '' : '#' + splitAtAnchor[1];
    if (url.indexOf(paramName + "=") >= 0) {
        var prefix = url.substring(0, url.indexOf(paramName));
        var suffix = url.substring(url.indexOf(paramName));
        suffix = suffix.substring(suffix.indexOf("=") + 1);
        suffix = (suffix.indexOf("&") >= 0) ? suffix.substring(suffix.indexOf("&")) : "";
        url = prefix + paramName + "=" + paramValue + suffix;
    } else {
    if (url.indexOf("?") < 0)
        url += "?" + paramName + "=" + paramValue;
    else
        url += "&" + paramName + "=" + paramValue;
    }
    return url + anchor;
}

/**
 * Remove a given parameter from the url
 */ 
function aiRemoveURLParameter(url, parameter) {
    //prefer to use l.search if you have a location/link object
    var urlparts= url.split('?');   
    if (urlparts.length>=2) {

        var prefix= encodeURIComponent(parameter)+'=';
        var pars= urlparts[1].split(/[&;]/g);

        //reverse iteration as may be destructive
        for (var i= pars.length; i-- > 0;) {    
            //idiom for string.startsWith
            if (pars[i].lastIndexOf(prefix, 0) !== -1) {  
                pars.splice(i, 1);
            }
        }
        if (pars.length != 0) {
            url= urlparts[0]+'?'+pars.join('&');
        } else {
            url= urlparts[0];
        }
        return url;
    } else {
        return url;
    }
}

/**
* Adds css to the end of the body to make sure that styles are 
* not overwritten by inline css of any kind.
*/
function aiAddCss(id,css){
    css = decodeURIComponent(css.replace(/\+/g, '%20'));
      
    var body = jQuery(id).contents().find('body');
    var s = document.createElement('style');
    s.setAttribute('type', 'text/css');
    if (s.styleSheet) {   // IE
        s.styleSheet.cssText = css;
    } else {                // the world
        s.appendChild(document.createTextNode(css));
    }
    body.append(s);
}

/**
 * add a css file to the end of the body to make sure that styles 
 *  are not overwritten by inline css of any kind. 
 */ 
function aiAddCssFile(id, filename) {
    var body = jQuery(id).contents().find('body');
    var link = document.createElement('link');
    link.rel = 'stylesheet';
    link.type ='text/css';
    link.href = filename;
    body.append(link);
} 

/**
 * Add a Javascript file to the end of the body
 */  
function aiAddJsFile(id, filename) {
    jQuery.ajaxSetup({ cache:true});
    
    var body = jQuery(id).contents().find('body'); 
    var script = document.createElement('script');
    script.type ='text/javascript';
    script.src = filename;
    body.append(script);
} 

function aiPresetFullscreen() {
    jQuery('#style').val('position:fixed;z-index:9000;top:0px;left:0px;margin:0px');
    jQuery('#width').val('100%');
    jQuery('#height').val('100%');
    jQuery('#content_id').val('html,body');
    jQuery('#content_styles').val('overflow:hidden');
    jQuery('#hide_content_until_iframe_color').val('#ffffff');      
}

/**
 * main ready function that calls all generated callbacks. 
 * Add dynamically created functions that should be loaded 
 * when the page is read to aiReadyCallbacks 
 */ 
jQuery(document).ready(function() {
    jQuery.each(aiReadyCallbacks, function(index, callback){
      callback(); 
    });
});