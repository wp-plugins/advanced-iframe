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
  if (obj.contentWindow.document.body != null) {
    var oldScrollposition = jQuery(document).scrollTop();     
    obj.height = 1; // set to 1 because otherwise the iframe does never get smaller.
    var bodyHeight = Math.max(obj.contentWindow.document.body.scrollHeight, 
      obj.contentWindow.document.body.offsetHeight, 
      obj.contentWindow.document.documentElement.scrollHeight, 
      obj.contentWindow.document.documentElement.offsetHeight);
    var newheight = bodyHeight + aiExtraSpace;
    obj.height = newheight + 'px'; 
    if (aiEnableCookie && aiExtraSpace == 0 ) {  
        aiWriteCookie(newheight);
    }
    jQuery(document).scrollTop(oldScrollposition);
    if (resize_width == 'true') {
      var bodyWidth = Math.max(obj.contentWindow.document.body.scrollWidth, 
        obj.contentWindow.document.body.offsetWidth, 
        obj.contentWindow.document.documentElement.scrollWidth, 
        obj.contentWindow.document.documentElement.offsetWidth); 
      obj.width = (bodyWidth + aiExtraSpace) + 'px';
    }
  } else {
    // body is not loaded yet - we wait 100 ms.
    setTimeout(function() { aiResizeIframe(obj, resize_width); },100); 
  }
}

/**
 *  Resizes an iframe to a given height.
 *  this is used for xss enabled iframes.
 *  Please read the documentation!   
 */ 
function aiResizeIframeHeightById(id, nHeight) {
    height = parseInt(nHeight) + aiExtraSpace;
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
  window.parent.window.scrollTo(0,0);
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
  var iframe = jQuery(iframeId).contents().find("body"); 
  var selectedBox = iframe.find(showElement).clone(); 
  iframe.find("*").remove(); 
  iframe.append(selectedBox);
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