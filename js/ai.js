var aiEnableCookie=false; 
var aiId='';
var aiExtraSpace = 0;

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
      var bodyHeight = Math.max(obj.contentWindow.document.body.scrollHeight, 
        obj.contentWindow.document.body.offsetHeight, 
        obj.contentWindow.document.documentElement.scrollHeight, 
        obj.contentWindow.document.documentElement.offsetHeight);
      var newheight = bodyHeight + aiExtraSpace;
      obj.height = newheight + 'px'; 
      
      // set the height of the zoom div
      if (jQuery('#ai-zoom-div-' + obj.id).length != 0) {
         var zoom = eval("zoom_" + obj.id)
         jQuery('#ai-zoom-div-' + obj.id).css("height", newheight * zoom);
      }
      
      if (aiEnableCookie && aiExtraSpace == 0 ) {  
          aiWriteCookie(newheight);
      }
      jQuery(document).scrollTop(oldScrollposition);
      if (resize_width == 'true') { 
        obj.width = aiGetIframeWidth(obj) + 'px';
      }
      eval ("resizeCallback" + obj.id + "()");
     
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
 *  Get the iframe width
 */ 
function aiGetIframeWidth(obj) {
    var bodyWidth = Math.max(obj.contentWindow.document.body.scrollWidth, 
          obj.contentWindow.document.body.offsetWidth, 
          obj.contentWindow.document.documentElement.scrollWidth, 
          obj.contentWindow.document.documentElement.offsetWidth);
    return bodyWidth + aiExtraSpace
}

/**
 *  Resizes an iframe to a given height.
 *  this is used for xss enabled iframes.
 *  Please read the documentation!   
 */ 
function aiResizeIframeHeightById(id, nHeight) {
    eval ("resizeCallback" + id + "()");
    var height = parseInt(nHeight) + aiExtraSpace;
    var iframe = document.getElementById(id); 
		var oldScrollposition = jQuery(document).scrollTop();
    iframe.setAttribute('height', height + 'px');
    jQuery(document).scrollTop(oldScrollposition);
    if (aiEnableCookie && aiExtraSpace == 0) {
      aiWriteCookie(height);
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
    var selectedBox = iframe.find(showElement).clone(); 
    iframe.find("*").remove(); 
    iframe.append(selectedBox);
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
        
   } else {
      jQuery('#accordion').find('h1').hide();
      jQuery('#accordion').attr("id","noacc");
   }  
}