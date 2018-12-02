/**
 *
 * Nav
 *
 */

;(function($){

	var Nav = function( dropdown ){

		// Dropdown parent
		this.dropdown = dropdown;

		// Nav items that contain dropdowns, mouseenter/leave events show/hide
		this.navItems = $('[data-nav-dropdown]');

		// We'll set a timeout whenever you leave the dropdown or nav item to
		// provide a more forgiving hover interaction
		this.waitToCloseTimer = null;

		// Point at which we break down to the mobile navigation
		this.breakpoint = 970;

		// This is the hamburger menu to toggle visibility of nav items
		this.mobileToggle = $('[data-nav-toggle]');

		// Set up our hover/click events
		this.bindEvents();
	};


	Nav.prototype.bindEvents = function(){
		if( !Modernizr.touchevents ) {
			this.bindMouseEvents();
		} else {
			this.bindTouchEvents();
		}

		this.bindTapClickEvents();
	};


	/**
	 * MOUSE EVENTS
	 */
	Nav.prototype.bindMouseEvents = function(){
		// For reference inside other functions
		var _this = this;

		this.navItems.mouseenter( $.proxy(this.showDropdown, this) );
		this.navItems.mouseleave( $.proxy(this.hideDropdown, this) );
		this.dropdown.mouseleave( $.proxy(this.hideDropdown, this) );

	};



	/**
	* TOUCH EVENTS
	*/
	Nav.prototype.bindTouchEvents = function(){
		// For reference inside other functions
		var _this = this;

		// Close the dropdown when non-nav items are clicked.
		$('body').on('click touchstart', function( event ){
			var isNotNavItem = !$( event.target ).closest( '[data-nav-dropdown]' ).length,
				isNotInsideDropdown = !$( event.target ).closest( '[data-nav-dropdown-content]' ).length,
				dropdownIsOpen = _this.dropdown.hasClass('is-visible');

			if (  isNotNavItem && isNotInsideDropdown && dropdownIsOpen ) {
				$.proxy( _this.hideDropdown( event ), _this );
			}
		});

		// Open/Close nav on tap
		this.navItems.on('click', function( event ){
			// If it's open and the same nav item has been tapped
			if ( _this.dropdown.hasClass('is-visible') && $(event.delegateTarget).hasClass('is-active') ) {
				$.proxy(_this.hideDropdown( event ), _this);
			} else {
				$.proxy(_this.showDropdown( event ), _this);
			}
		});
	};



	/**
	* Tap/Click EVENTS
	*/
	Nav.prototype.bindTapClickEvents = function(){
		// Mobile nav can be toggled w/touch or mouse
		this.mobileToggle.on('click', function(){
			$('#header').toggleClass('is-active');
			$(this).toggleClass('is-active');
		});

		this.navItems.on('click', $.proxy(this.toggleDropdown, this));
	};



	/**
	* SHOW DROPDOWN
	*/
	Nav.prototype.showDropdown = function( event ){
		var _this = this,
			currentNavItem = $( event.delegateTarget ),
			currentNavContent = $( currentNavItem.attr('data-nav-dropdown') ),
			previousNavItem = $('[data-nav-dropdown].is-active'),
			// "magic number" here accounts for arrow width
			navArrowPosition = currentNavItem.offset().left + currentNavItem.width() + 10,
			left;

		// Do nothing if we're on "mobile"
		if ( $(window).outerWidth() <= this.breakpoint ) { return; }

		// No timeouts necessary once we've hit this point. Reset those.
		clearTimeout( this.waitToCloseTimer );

		// If we're coming in from the dropdown not being visible
		// (previousNavItem.length would be 0) we add a class to remove the
		// transition of transform so that it just fades straight in.
		if ( !previousNavItem.length ) {
			// Add a class to only transition opacity when it's not first visible
			this.dropdown.addClass('is-not-morphing');
			this.dropdown.on('transitionend webkitTransitionEnd oTransitionEnd', function(){
				_this.dropdown.removeClass('is-not-morphing');
			});
		}

		// Remove class from old nav item
		previousNavItem.removeClass('is-active');
		previousNavItem.closest('li').removeClass('is-active-subnav');

		// Sets dropdown visible, and nav item active
		this.dropdown.addClass('is-visible');
		currentNavItem.addClass('is-active');

		// Deactivate old content
		// Activate the new content inside the nav item
		this.dropdown.find('.is-visible').removeClass('is-visible');
		currentNavContent.addClass('is-visible');

		// Set positioning *after* we activate the proper dropdown content
		left = navArrowPosition - (currentNavContent.outerWidth() / 2);
		this.dropdown.css({
			'-moz-transform': 'translateX(' + left + 'px)',
	    	'-webkit-transform': 'translateX(' + left + 'px)',
			'-ms-transform': 'translateX(' + left + 'px)',
			'-o-transform': 'translateX(' + left + 'px)',
			'transform': 'translateX(' + left + 'px)',
			'width': currentNavContent.innerWidth() + 'px',
			'height': currentNavContent.innerHeight() + 'px',
			'overflow': 'hidden'
		});

		// Overflow hidden *during* the transition prevents content from
		// spilling out this resets it after it's finished so that the shadow shows
		this.dropdown.on('transitionend webkitTransitionEnd oTransitionEnd', function(){
			_this.dropdown.css( 'overflow', '' );
		});

	}; // showDropdown



	/**
	* HIDE DROPDOWN
	*/
	Nav.prototype.hideDropdown = function( event ){
		var _this = this;

		this.waitToCloseTimer = setTimeout(function(){
			var isMobile = $(window).outerWidth() <= _this.breakpoint,
				isHoveringDropdown = _this.dropdown.is(':hover'),
				isHoveringNavItem = _this.navItems.filter('.is-active') === $( event.delegateTarget );

			// debugger;

			if ( isMobile || isHoveringDropdown || isHoveringNavItem ) {
				return;
			}

			// Remove all active/visible classes
			_this.navItems.removeClass('is-active');
			_this.dropdown.removeClass('is-visible');
			$('.is-active-subnav').removeClass('is-active-subnav');
			_this.dropdown.find('.is-visible').removeClass('is-visible');
		}, 100);
	};


	Nav.prototype.toggleDropdown = function( event ) {
		var tappedNavItem = $( event.delegateTarget );

		tappedNavItem.closest('li').toggleClass('is-active-subnav');
	};



	/**
	 * Instantiate the Nav object on document ready
	 */
	$(function(){
		var $dropdown = $('#dropdown');

		$dropdown.each( function( index, element) {
			new Nav( $(element) );
	    });
	});
}(jQuery));
