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
function aiResizeIframe(obj) {
  obj.height = obj.contentWindow.document.body.scrollHeight + aiExtraSpace; //IE6, IE7, IE9, Safari, FF and Chrome
  if (aiEnableCookie && aiExtraSpace == 0 ) {
      aiWriteCookie(obj.height);
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
		iframe.setAttribute('height', height + 'px');
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
	     iframe.setAttribute('height', (parseInt(value) + aiExtraSpace) + 'px');
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
