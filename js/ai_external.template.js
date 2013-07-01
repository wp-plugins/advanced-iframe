/**
 * The function creates a hidden iframe and determines the height of the 
 * current page. This is then set as height parameter for the iframe 
 * which triggers the resize function in the parent.  
 */ 
function aiUpdateIframeHeight() {
    if (window!=window.top) { /* I'm in a frame! */ 
      var domain = 'WORDPRESS_SITE_URL'; // replace with the real domain 
      var url = domain+'/wp-content/plugins/advanced-iframe/js/iframe_height.html';
       
      // add the iframe dynamically
      var newElementStr = '<iframe id="ai_hidden_iframe" style="visibility:hidden;" width="0" height="0" src="';
      newElementStr += url+'">Iframes not supported.</iframe>';
      var newElement = aiCreate(newElementStr);
      document.body.appendChild(newElement);
      
      // add a wrapper div below the body to measure - if you remove this you have to measure the height of the body! 
      // See below for this solution.
      var org_html = document.body.innerHTML;
      var new_html = '<div id="ai_wrapper_div" style="margin:0px;padding:0px;border: 1px solid transparent;">' + org_html + '</div>';
      document.body.innerHTML = new_html;
      
      // remove any margin,padding from the body because each browser handles this differently
      // Overflow hidden is used to avoid scrollbars that can be shown for a milisecond
      aiAddCss("body {margin:0px;padding:0px;overflow:hidden;}");
      
      // get the height of the element right below the body - Using this solution allows that the iframe shrinks also.
      var wrapperElement = document.body.children[0]
      var newHeight = parseInt(wrapperElement.offsetHeight,10);       
  
      //  Get the height from the body. The problem with this solution is that an iframe can not shrink anymore. 
      //  var newHeight = Math.max(document.body.scrollHeight, document.body.offsetHeight,
      //    document.documentElement.scrollHeight, document.documentElement.offsetHeight);  
  
      var iframe = document.getElementById('ai_hidden_iframe');
      // 4 pixels extra are needed because of IE! (2 for Chrome) - if you still have scrollbars add a little bit more offset.
      iframe.src = url + '?height=' + (newHeight + 4);
    }
}

/**
 *  Creates a new dom fragment from a string
 */ 
function aiCreate(htmlStr) {
    var frag = document.createDocumentFragment(),
    temp = document.createElement('div');
    temp.innerHTML = htmlStr;
    while (temp.firstChild) {
        frag.appendChild(temp.firstChild);
    }
    return frag;
}

/**
 *  Adds a css style to the head 
 */         
function aiAddCss(cssCode) {
    var styleElement = document.createElement("style");
    styleElement.type = "text/css";
    if (styleElement.styleSheet) {
      styleElement.styleSheet.cssText = cssCode;
    } else {
      styleElement.appendChild(document.createTextNode(cssCode));
    }
    document.getElementsByTagName("head")[0].appendChild(styleElement);
}


/**
 * Helper function without jQuery to add a onload event 
 * even if there is already one attached. 
 */ 
function addOnloadEvent(fnc){
  if ( typeof window.addEventListener != "undefined" )
    window.addEventListener( "load", fnc, false );
  else if ( typeof window.attachEvent != "undefined" ) {
    window.attachEvent( "onload", fnc );
  }
  else {
    if ( window.onload != null ) {
      var oldOnload = window.onload;
      window.onload = function ( e ) {
        oldOnload( e );
        window[fnc]();
      };
    }
    else 
      window.onload = fnc;
  }
}

// add the aiUpdateIframeHeight to the onload of the site.
addOnloadEvent(aiUpdateIframeHeight);