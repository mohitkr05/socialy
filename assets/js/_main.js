/* ========================================================================
 * DOM-based Routing
 * Based on http://goo.gl/EUTi53 by Paul Irish
 *
 * Only fires on body classes that match. If a body class contains a dash,
 * replace the dash with an underscore when adding it to the object below.
 *
 * .noConflict()
 * The routing is enclosed within an anonymous function so that you can 
 * always reference jQuery with $, even when in .noConflict() mode.
 *
 * Google CDN, Latest jQuery
 * To use the default WordPress version of jQuery, go to lib/config.php and
 * remove or comment out: add_theme_support('jquery-cdn');
 * ======================================================================== */

(function($) {

// Use this variable to set up the common and page specific functions. If you 
// rename this variable, you will also need to rename the namespace below.
var Roots = {
  // All pages
  common: {
    init: function() {
     $(function() {
	
	// IE detect
	function iedetect(v) {

	    var r = RegExp('msie' + (!isNaN(v) ? ('\\s' + v) : ''), 'i');
		return r.test(navigator.userAgent);
			
	}

	// For mobile screens, just show an image called 'poster.jpg'. Mobile
	// screens don't support autoplaying videos, or for IE.
	if(screen.width < 800 || iedetect(8) || iedetect(7) || 'ontouchstart' in window) {
	
		(adjSize = function() { // Create function called adjSize
			
			$width = $(window).width(); // Width of the screen
			$height = $(window).height(); // Height of the screen
		 	// Hide video
			$('vid').hide();
			
		})(); // Run instantly
		
		// Run on resize too
		$(window).resize(adjSize);
	}
	else {

		// Wait until the video meta data has loaded
		$('.video').on('loadedmetadata', function() {
			
			var $width, $height, // Width and height of screen
				$vidwidth = this.videoWidth, // Width of video (actual width)
				$vidheight = this.videoHeight, // Height of video (actual height)
				$aspectRatio = $vidwidth / $vidheight; // The ratio the video's height and width are in
						
			(adjSize = function() { // Create function called adjSize
							
				$width = $(window).width(); // Width of the screen
				$height = $(window).height(); // Height of the screen
							
				$boxRatio = $width / $height; // The ratio the screen is in
							
				$adjRatio = $aspectRatio / $boxRatio; // The ratio of the video divided by the screen size
							
				// Set the container to be the width and height of the screen
				$('.vid').css({'width' : $width+'px', 'height' : $height+'px'}); 
							
				if($boxRatio < $aspectRatio) { // If the screen ratio is less than the aspect ratio..
					// Set the width of the video to the screen size multiplied by $adjRatio
					$vid = $('.vid').css({'width' : $width*$adjRatio+'px'}); 
				} else {
					// Else just set the video to the width of the screen/container
					$vid = $('.vid').css({'width' : $width+'px'});
				}
								 
			})(); // Run function immediately
						
			// Run function also on window resize.
			$(window).resize(adjSize);
						
		});
	}
	
});
    }
  },
  // Home page
  home: {
    init: function() {
      // JavaScript to be fired on the home page
    }
  },
  // About us page, note the change from about-us to about_us.
  about_us: {
    init: function() {
      // JavaScript to be fired on the about us page
    }
  }
};

// The routing fires all common scripts, followed by the page specific scripts.
// Add additional events for more control over timing e.g. a finalize event
var UTIL = {
  fire: function(func, funcname, args) {
    var namespace = Roots;
    funcname = (funcname === undefined) ? 'init' : funcname;
    if (func !== '' && namespace[func] && typeof namespace[func][funcname] === 'function') {
      namespace[func][funcname](args);
    }
  },
  loadEvents: function() {
    UTIL.fire('common');

    $.each(document.body.className.replace(/-/g, '_').split(/\s+/),function(i,classnm) {
      UTIL.fire(classnm);
    });
  }
};

$(document).ready(UTIL.loadEvents);

})(jQuery); // Fully reference jQuery after this point.
