$(window).load(function(){

	var body = $('body'),
		html = $('html'),
		main = $('#main'),
		height = $(window).height(),
		width = $(window).width(),
		greyscale = $('.greyscale');

	// Home page rotators
	var content = $('.home .content'),
		rotators = $('.rotators .module'),
		bar = $('.home .bar');

	content.first().css({ 'left': 0 });	

	// Initial rotating when first load page
	var n = 0,
		newie,
		oldie,
		rotate = setInterval(function(){
			n++;
			var pos;

			if (n%3 == 1) { // going to 2
				newie = content.eq(1);
				oldie = content.eq(0);
				pos = rotators.eq(1).position().left;
			} else if (n%3 == 2) { // going to 3
				newie = content.eq(2);
				oldie = content.eq(1);
				pos = rotators.eq(2).position().left;
			} else { // going to 1
				newie = content.eq(0);
				oldie = content.eq(2);
				pos = rotators.eq(0).position().left;
			}

			newie.animate({
				'left': 0
			}, 600, 'easeInOutQuad').css('z-index', n);
			oldie.animate({
				'left': '-100%'
			}, 600, 'easeInOutQuad', function(){
				oldie.css({
					'left': '100%',
					'z-index': 0
				})
			});

			// Slide that bar
			bar = $('.home .bar').last();
			bar.after('<div class="bar" style="left: 100%;"></div>');
			bar.animate({
				'left': '-100%'
			}, 600);
			bar = $('.home .bar').last();
			bar.animate({
				'left': pos
			}, 600);
		}, 6000);

	rotators.on('click',function(){
		clearInterval(rotate);
		
		$this = $(this);
		if (!$this.hasClass('active')) {
			n++;
			$this.addClass('active').siblings().removeClass('active');

			var name = $this.data('name'),
				pos = $this.position().left;

			// Slide that bar
			bar = $('.home .bar').last();
			bar.after('<div class="bar" style="left: 100%;"></div>');
			bar.animate({
				'left': '-100%'
			}, 600);
			bar = $('.home .bar').last();
			bar.animate({
				'left': pos
			}, 600);

			content.each(function(){
				$this = $(this);

				if ($this.data('name') == name) {
					// content.fadeOut(500);
					$this.animate({
						'left': 0
					}, 600, 'easeInOutQuad').css('z-index', n);
					var sibs = $this.siblings('.content');
					sibs.animate({
						'left': '-100%'
					}, 600, 'easeInOutQuad', function(){
						sibs.css({
							'left': '100%',
							'z-index': 0
						})
					});
				}
			});
		}
	});
	// Home page center big text in window (and in 404 page)
	var pad = height/2.5 - 120;
	if (pad > 110) {
		content.css('padding-top', pad);
	} else {
		content.css('padding-top', 110);
	}
	$(window).resize(function(){
		var pad = $(window).height()/2.5 - 120;
		if (pad > 110) {
			content.css('padding-top', pad);
		} else {
			content.css('padding-top', 110);
		}

		if (body.hasClass('home')) {
			var active = $('.module.active');
			bar.css( 'left', active.position().left );
		}
	});

	// ----- About page

	var hotspot = $('div.hotspot');

	hotspot.on('mouseenter', function(){
		$(this).closest('.hotspot-container').prev('.bg').stop().animate({
			'width': 300
		});
	}).on('mouseleave', function(){
		$(this).closest('.hotspot-container').prev('.bg').stop().animate({
			'width': 0
		}, 300);
	});
	if (main.hasClass('template-about')) {
		// Scale hotspot bg needs positioning (or runs off page)
		var scalePos = function(){ 
			var scale = $('.bg.scale'),
				scaleTop = scale.next('.hotspot-container').offset().top;
			if ($(window).width() > 1220) {
				scale.css({
					'top': scaleTop - 230
				});
			} else if ($(window).width() > 1000) {
				scale.css({
					'top': scaleTop - 220
				})
			}
			else if ($(window).width() > 800) {
				scale.css({
					'top': scaleTop - 210
				})
			}
		}
		scalePos();

		$(window).resize(function(){ 
			scalePos();
		});
	}

	// ----- Contact form
	var contactLink = $('.contact'),
		contactForm = $('#contact'),
		contactItems = $('.template-contact form li');

	contactLink.on('click', function(){
		if (contactForm.hasClass('active')) {
			contactForm.fadeOut();
		} else {
			contactForm.fadeIn();
		}
		contactForm.toggleClass('active');
		greyscale.fadeToggle();
	});
		
	contactItems.on('click',function(){
		$(this).toggleClass('chosen');
	});

	// ----- Services page
	var services = $('.template-services h2'),
		serviceCover = $('.template-services .cover.full'),
		serviceModule = $('.template-services .content .module'),
		serviceBar = $('.template-services .bar');
	
	// Make sure we're showing the right background image
	serviceCover.each(function(){
		$this = $(this);
		if (window.location.hash == '#' + $this.data('name')) {
			$this.show().css({
				'left': 0,
				'z-index': 1
			});
		} else if (window.location.hash.length == 0) {
			serviceCover.first().show().css({
				'left': 0,
				'z-index': 1
			});
		}
	});
	// Show the right module
	serviceModule.find('div').width($('.content').width()).hide();
	$(window).on('resize', function(){
		serviceModule.find('div').width($('.content').width());
	});
	serviceModule.each(function(){
		$this = $(this);
		if (window.location.hash == '#' + $this.data('name')) {
			$this.width('100%').addClass('active').find('div').show();
		} else if (window.location.hash.length == 0 && $this.data('name') == 'parts') {
			$('#parts').width('100%').addClass('active').find('div').show();
		}
	});
	// Set bar to right start location	
	if (window.location.hash == '#parts' || window.location.hash.length == 0) {
		serviceBar.css('top', 20);
	} else if (window.location.hash == '#junk') {
		serviceBar.css('top', 89);
	} else if (window.location.hash == '#scrap') {
		serviceBar.css('top', 158);
	}

	var i = 0;
	services.on('click',function(){
		i++;
		$this = $(this);
		var text = $this,
			name = $this.data('name');

		serviceCover.each(function(){
			var newCover = $(this);
			if (newCover.data('name') == name) {
				newCover.show();
				setTimeout(function(){
					newCover.css('z-index', i).animate({
						'left': 0
					}, 800, 'linear');
				}, 401);
			} else {
				setTimeout(function(){
					newCover.animate({
						'left': '-100%'
					}, 800, 'linear', function(){
						newCover.css({'left': '100%'}).hide();
					});
				}, 451);
				main.animate({
					'opacity': '0.98'
				}, 400, 'linear', function(){ 
					main.animate({
						'opacity': '1'
					}, 400, 'linear'); 
				});
			}
		});

		var IEpad = 0; // IE needs to put some padding on the bar
		if (html.hasClass('lt-ie9')) { IEpad = 70; }
		serviceModule.each(function(){
			$this = $(this);

			if ($this.data('name') == name && !$this.hasClass('active')) {
				var oldModule = $('.active');
				oldModule.animate({
					'width': 8
				}, 800, 'easeInOutQuad');
				setTimeout(function(){
					oldModule.css('width', 0);
				}, 1000);

				$this.addClass('active').siblings('.module').removeClass('active');

				setTimeout(function(){
					$('.active').animate({
						'width': '100%'
					}, 800, 'easeInOutQuad').find('div').fadeIn(800);
				}, 801);

				setTimeout(function(){
					serviceBar.animate({
						'top': text.position().top - 195 + IEpad
					}, 800, 'easeInOutQuad');
				}, 401);
				
			}
		});
	});

	// ----- Featured sales

	var sortBy = $('.template-featured-sales .sorter'),
		sorter = $('.template-featured-sales ul'),
		sales = $('.template-featured-sales'),
		salesModule = sales.find('.module'),
		description = $('.description');

	salesModule.each(function(){
		// hack for clearing left in IE8 and below
		$this = $(this);
		if ($this.index()%4 === 0) {
			$this.addClass('IE-left');
		}
	})	

	var sortBySize = sortBy.css('font-size');
	sortBy.css('margin-top', -parseInt(sortBySize));
	$(window).resize(function(){
		sortBy = $('.template-featured-sales .sorter');
		sortBySize = sortBy.css('font-size');
		sortBy.css('margin-top', -parseInt(sortBySize));
	});

	sorter.on('mouseenter', function(){
		$(this).addClass('collapse');
	}).on('mouseleave', function(){
		$(this).removeClass('collapse');
	});

	salesModule.each(function(){
		$this = $(this);
		$this.on('mouseenter', function(){
			$(this).find('.more').fadeToggle().css('top', 0.5*$(this).height() - 30);
		}).on('mouseleave', function(){
			$(this).find('.more').fadeToggle();
		});
	}).click(function(e){
		$this = $(this);

		var transfer = $(this).find('.extended').html(),
			height = $(window).height();
		greyscale.fadeIn();	

		description
			.addClass('active')
			.fadeIn()
			.css({
				'max-height': height - 340
			})
			.find('.scroll')
			.css({
				'top': 0
			}).html(transfer);
		
		var dHeight = description.height();
		if ($(window).width() > 800) {
			description.css('top', $(window).scrollTop() + 200);
		} else {
			var last = $('.module').last().offset().top;
			description.css({
				'margin-bottom': -dHeight-32,
				'top': e.pageY - last - 450
			});
		}

		setTimeout(function(){
			description.readyToScroll();
		}, 10);
	});

	// ----- Warranty and Exchange/Return Policy

	var warrantyLink = $('.warranty'),
		warranty = $('#warranty'),
		exchangeLink = $('.exchange'),
		exchange = $('#exchange'),
		box = $('#warranty, #exchange');

	warrantyLink.click(function(){
		if (exchange.hasClass('active')) {
			setTimeout(function(){
				if (warranty.hasClass('active')) {
					warranty.readyToScroll();
				}
			}, 610);
		} else {
			setTimeout(function(){
				if (warranty.hasClass('active')) {
					warranty.readyToScroll();
				}
			}, 10);
		}
	});
	exchangeLink.click(function(){
		if (warranty.hasClass('active')) {
			setTimeout(function(){
				if (exchange.hasClass('active')) {
					exchange.readyToScroll();
				}
			}, 610);
		} else {
			setTimeout(function(){
				if (exchange.hasClass('active')) {
					exchange.readyToScroll();
				}
			}, 10);
		}
	});

	box.hide();	

	function slideIt(target) {
		var height = $(window).height(),
			other = box.not(target);

		// On everything other than the featured sales page...
		if (!body.hasClass('page-template-pagessales-php')) {
			// For large screens
			if ($(window).width() > 800) {
				// If the other box is shown...
				if (other.hasClass('active')) {
					// Drop down the other one, wait for it, then hide it and show the new one
					other.removeClass('active').animate({
						'top': '100%'
					}, 800, 'easeInOutQuad');
					
					setTimeout(function(){
						other.hide();

						target.show().css({
							'height': height - 238
						}).animate({
							'top': 200 
						}, 600 , 'easeInOutQuad');
					
					}, 601);
				// If not...
				} else {
					if (target.hasClass('active')) {
						target.animate({
							'top': '100%'
						}, 600, 'easeInOutQuad');
						setTimeout(function(){
							target.hide();
						}, 601);
						greyscale.fadeOut();
					} else {
						target.show().css({
							'height': height - 238
						}).animate({
							'top': 200 
						}, 600 , 'easeInOutQuad');
					}
				}
			// Smaller screens
			} else {
				// If the other box is shown...
				if (other.hasClass('active')) {
					other.fadeOut().removeClass('active');
					target.fadeIn();
				// If not...
				} else {
					if (target.hasClass('active')) {
						target.fadeOut();
						greyscale.fadeOut();
					} else {
						target.fadeIn();
						greyscale.height($(document).height()).fadeIn();
					}
				}
			}
			target.toggleClass('active');

		// On the featured sales page,
		// we just fade them in and out
		} else {
			if (other.hasClass('active')) {
				// Drop down the other one, wait for it, then hide it and show the new one
				other.fadeOut().removeClass('active');
				target.fadeIn();
			// If not...
			} else {
				if (target.hasClass('active')) {
					target.fadeOut();
					greyscale.fadeOut();
				} else {
					target.fadeIn();
					greyscale.fadeIn();
				}
			}
			target.toggleClass('active');
		}
	}
	warrantyLink.on('click', function(){
		slideIt(warranty);
	});
	exchangeLink.on('click', function(){
		slideIt(exchange);
	});
	// Resize visible boxes on window resize
	$(window).on('resize', function(){
		height = $('#main').height();
		box.each(function(){
			$this = $(this);
			if ($this.hasClass('active')) {
				$this.height(height - 48);
			}
		});
	});

	// Function to hide description on featured sales, contact pages
	// and warranty, exchange/return boxes
	var hideDesc = function(){
		greyscale.fadeOut();
		description.removeClass('active').fadeOut();
		contactForm.removeClass('active').fadeOut();
		if (!body.hasClass('page-template-pagessales-php')) {
			box.removeClass('active').animate({
				'top': '200%'
			}, 800, 'easeInOutQuad');
			setTimeout(function(){
				box.hide();
			}, 801);
		} else {
			box.fadeOut().removeClass('active');
		}
		setTimeout(function(){
			$('.scroll_container').remove();
		}, 500);
		
	}
	body.on('keydown', function(e) {
		if (e.keyCode == 27) {
			hideDesc();
		}
	});
	$('.close').on('click', function(){
		hideDesc();
	});

	// ----- placeholders
	if(!Modernizr.input.placeholder){
		$('[placeholder]').focus(function() {
			var input = $(this);
			if (input.val() == input.attr('placeholder')) {
				input.val('');
				input.removeClass('placeholder');
		    }
		}).blur(function() {
		    var input = $(this);
		    if (input.val() == '' || input.val() == input.attr('placeholder')) {
				input.addClass('placeholder');
				input.val(input.attr('placeholder'));
		    }
		}).blur();
		$('[placeholder]').parents('form').submit(function() {
		    $(this).find('[placeholder]').each(function() {
				var input = $(this);
				if (input.val() == input.attr('placeholder')) {
				    input.val('');
				}
		    });
		});
	}

	body.removeClass('preload');

});