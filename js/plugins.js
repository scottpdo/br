// Avoid `console` errors in browsers that lack a console.
if (!(window.console && console.log)) {
    (function() {
        var noop = function() {};
        var methods = ['assert', 'clear', 'count', 'debug', 'dir', 'dirxml', 'error', 'exception', 'group', 'groupCollapsed', 'groupEnd', 'info', 'log', 'markTimeline', 'profile', 'profileEnd', 'markTimeline', 'table', 'time', 'timeEnd', 'timeStamp', 'trace', 'warn'];
        var length = methods.length;
        var console = window.console = {};
        while (length--) {
            console[methods[length]] = noop;
        }
    }());
}
/*! Copyright (c) 2011 Brandon Aaron (http://brandonaaron.net)
 * Licensed under the MIT License (LICENSE.txt).
 *
 * Thanks to: http://adomas.org/javascript-mouse-wheel/ for some pointers.
 * Thanks to: Mathias Bank(http://www.mathias-bank.de) for a scope bug fix.
 * Thanks to: Seamus Leahy for adding deltaX and deltaY
 *
 * Version: 3.0.6
 * 
 * Requires: 1.2.2+
 */
(function(a){function d(b){var c=b||window.event,d=[].slice.call(arguments,1),e=0,f=!0,g=0,h=0;return b=a.event.fix(c),b.type="mousewheel",c.wheelDelta&&(e=c.wheelDelta/120),c.detail&&(e=-c.detail/3),h=e,c.axis!==undefined&&c.axis===c.HORIZONTAL_AXIS&&(h=0,g=-1*e),c.wheelDeltaY!==undefined&&(h=c.wheelDeltaY/120),c.wheelDeltaX!==undefined&&(g=-1*c.wheelDeltaX/120),d.unshift(b,e,g,h),(a.event.dispatch||a.event.handle).apply(this,d)}var b=["DOMMouseScroll","mousewheel"];if(a.event.fixHooks)for(var c=b.length;c;)a.event.fixHooks[b[--c]]=a.event.mouseHooks;a.event.special.mousewheel={setup:function(){if(this.addEventListener)for(var a=b.length;a;)this.addEventListener(b[--a],d,!1);else this.onmousewheel=d},teardown:function(){if(this.removeEventListener)for(var a=b.length;a;)this.removeEventListener(b[--a],d,!1);else this.onmousewheel=null}},a.fn.extend({mousewheel:function(a){return a?this.bind("mousewheel",a):this.trigger("mousewheel")},unmousewheel:function(a){return this.unbind("mousewheel",a)}})})(jQuery);

(function($) {

	var scroll,
		scrollHeight,
		visible,
		scrollContainer, top,
		scrollBar, barTop,
		windowWidth,
		vel;

	$.fn.extend({
		readyToScroll: function(){
			$this = $(this);

			scroll = $this.find('.scroll'),
			scrollHeight = scroll.height(), // extra 40 for padding
			windowWidth = $(window).width();

			$(window).resize(function(){
				scrollHeight = scroll.height();
				windowWidth = $(window).width();
			})
			visible = $this.height();
			
			if (scrollHeight > visible) {

				// insert the scroll container and bar and set variables
				scroll.after('<div class="scroll_container"><div class="scrollbar"></div></div>');
				scrollContainer = $('.scroll_container');
				scrollBar = $('.scrollbar');

				// set height of scroll container
				scrollContainer.height(visible - 20); // ? not sure why 20... think it should be 30, but whatever

				$this.on('mousewheel DOMMouseScroll MozMousePixelScroll', function(e){
					if (windowWidth > 800) {
						e.preventDefault(); // stops browser scrolling
					
						if (e['originalEvent'].detail) {
							vel = -1.5*e['originalEvent'].detail;
						} else {
							vel = e['originalEvent'].wheelDeltaY;
						}
							top = parseInt(scroll.css('top'));
						console.log(e['originalEvent'].detail);

						// Only scroll below 0
						if (top + 0.15*vel <= 0) {
							// Stop at the bottom (visible - scrollHeight)
							if (top + 0.15*vel < visible - scrollHeight) {
								scroll.css('top', visible - scrollHeight);
								scrollBar.css('top', scrollContainer.height() - 60); // 60 is height of bar
							// This is default scrolling
							} else {
								scroll.css('top', top + 0.15*vel);
								scrollBar.css('top', -(top + 0.15*vel)*(visible/(scrollHeight-40)));
							}
						// Otherwise we're at the very top, so we stay there
						} else {
							scroll.css('top', 0);
							scrollBar.css('top', 0);
						}
					}
				});

				// Dragging the scrollbar
				$.fn.extend({
					dragBar: function(){
						var scrolling = false,
							offset;

						scrollBar.mousedown(function(){
							scrolling = true;
							offset = scrollBar.offset().top + 30; // 30 is 1/2 of scrollbar height
							barTop = parseInt(scrollBar.css('top'));
							top = parseInt(scroll.css('top'));
						});
						
						$(window).mouseup(function(){
							scrolling = false;
							
							// reset bar to 0 or max at bottom if it exceeded those
							setTimeout(function(){
								barTop = parseInt(scrollBar.css('top'));
								if (barTop < 0) {
									scrollBar.css('top', 0);
									scroll.css('top', 0);
								}
								if (barTop > visible - 90) {
									scrollBar.css('top', visible - 90);
									scroll.css('top', visible - scrollHeight);
								}
							}, 10);
						}).mousemove(function(e){

							if (scrolling) {
								e.preventDefault();

								if (barTop >= 0) {
									// Move the bar
									scrollBar.css('top', barTop + e.pageY - offset);

									// Move the content
									scroll.css('top', top-((scrollHeight - visible)/(visible - 90))*(e.pageY - offset));
								}
							}
						});
						
					}
				});
				scrollBar.dragBar();

				// Arrow keys to scroll
				$(window).keydown(function(e){
					barTop = parseInt(scrollBar.css('top'));
					top = parseInt(scroll.css('top'));
				
					if (windowWidth > 800) {
						// going up
						if (e.keyCode == 38) {
							scrollBar.css('top', barTop - 30*((visible - 90)/(scrollHeight - visible)));
							scroll.css('top', top + 30);
						// going down
						} else if (e.keyCode == 40) {
							scrollBar.css('top', barTop + 30*((visible - 90)/(scrollHeight - visible)));
							scroll.css('top', top - 30);
						}

						// reset bar to 0 or max at bottom if it exceeded those
						setTimeout(function(){
							barTop = parseInt(scrollBar.css('top'));
							if (barTop < 0) {
								scrollBar.css('top', 0);
								scroll.css('top', 0);
							}
							if (barTop > visible - 90) {
								scrollBar.css('top', visible - 90);
								scroll.css('top', visible - scrollHeight);
							}
						}, 10);
					}
				});

				/* Clicking and dragging (or swiping, on touch screens) */
				var isDragging = false;
				scroll.mousedown(function(e){
					e.preventDefault();

					isDragging = true;
					offset = scrollBar.offset().top + 30; // 30 is 1/2 of scrollbar height
					barTop = parseInt(scrollBar.css('top'));
					top = parseInt(scroll.css('top'));
				});
				
			} // End is content taller than visible space
		}
	});

})(jQuery);