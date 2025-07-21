/**
 * Main theme functionality.
 *
 * Handles general theme behaviors including sticky header, mobile menu,
 * smooth scrolling, search modal, and video block modifications.
 *
 * @package siteorigin-snapshot
 * @since 1.0
 * @license GPLv3
 */

jQuery( function( $ ) {
	const $window = $( window );
	const $siteHeader = $( 'header.wp-block-template-part' );
	const $stickyHeader = $siteHeader.find( '> .wp-block-group' );
	const mobileMenuIsTextButton = $siteHeader.find( '.snapshot-nav-text-only' ).length > 0;
	const $mobileMenuContainer = $siteHeader.find( '.wp-block-navigation__responsive-container' );
	const adminBarHeight = $( '#wpadminbar' ).height() || 0;
	let headerHeight = $siteHeader.outerHeight();

	// Update scroll offset to help with smooth scrolling.
	$window.on( 'resize', function() {
		$window.css( 'scroll-padding-top', `calc(${$siteHeader.outerHeight()}px + 10px` );
	} ).trigger( 'resize' );

	const adjustMobileMenuContainerSpacing = () => {
		headerHeight = $siteHeader.outerHeight();

		// If there's no admin bar, offset for just the header.
		if ( adminBarHeight === 0 ) {
			$mobileMenuContainer.css(
				'top',
				`calc(${ headerHeight }px)`
			);

			return;
		}

		const currentScrollPosition = $window.scrollTop();
		const adminBarScrollOffset = currentScrollPosition > adminBarHeight ? adminBarHeight : currentScrollPosition;
		$mobileMenuContainer.css(
			'top',
			`calc(${ headerHeight }px + ${ adminBarHeight }px - ${ adminBarScrollOffset }px)`
		);
	};

	// If header is set to overlap, we need show its
	// background after the user scrolls past its initial position.
	$window.on( 'scroll', function() {
		if ( $( this ).scrollTop() > headerHeight ) {
			$stickyHeader.addClass( 'floating' );
		} else {
			$stickyHeader.removeClass( 'floating' );
		}
	} );

	/**
	 * Toggles submenu visibility in response to user interactions within the site header.
	 *
	 * This function is designed to enhance accessibility by handling click and keydown events. It specifically responds to Enter, Space, and Tab key
	 * presses to ensure compatibility with screen readers and other
	 * assistive technologies, which may simulate click events.
	 *
	 * @param {KeyboardEvent|MouseEvent} event - The event triggered by the user's interaction.
	 */
	let $activeSubMenu = null;
	$siteHeader.find( '.wp-block-navigation-submenu__toggle' ).on( 'click keydown', function( event ) {
		const current = $( this ).attr( 'aria-expanded' );

		if (
			event.type !== 'click' &&
			event.key !== 'Enter' &&
			event.key !== ' ' &&
			! (
				event.key === 'Tab' && current !== 'true'
			)
		) {
			return;
		}

		// Prevent submenu opening with Shift key to facilitate
		// Shift + Tab navigation.
		if ( event.shiftKey === true  ) {
			return;
		}

		event.preventDefault();

		$( this ).attr( 'aria-expanded', current === 'true' ? 'false' : 'true' );

		// Account for resetting the toggle state.
		$activeSubMenu = $( this ).parents( '.wp-block-navigation-item.has-child' );
		$activeSubMenu.on( 'focusout', subMenuFocusOutHandler );

		// If tab was pressed, we need to focus the first menu item.
		if ( event.key === 'Tab' ) {
			$activeSubMenu.find( '.wp-block-navigation__submenu-container .wp-block-navigation-item:first-of-type a' ).trigger( 'focus' );
		}
	} );

	/**
	 * Manages focus out behavior for submenu accessibility.
	 *
	 * Delays checking the document's active element to determine if focus has moved outside the submenu.
	 *
	 * If it has, collapses the submenu by setting 'aria-expanded' to 'false'.
	 * This function is then unbound from the submenu once it collapses to
	 * prevent unnecessary event handling.
	 */
	const subMenuFocusOutHandler = () => {
		setTimeout( function() {
			if ( ! $activeSubMenu.find( document.activeElement ).length ) {
				$siteHeader.find( '.wp-block-navigation-submenu__toggle[aria-expanded="true"]' ).attr( 'aria-expanded', 'false' );

				$activeSubMenu.off('focusout', subMenuFocusOutHandler);
			}
		}, 1 );
	};


	// Mobile menu improvements.
	const $button = $siteHeader.find( '.wp-block-navigation__responsive-container-open' );

	/**
	 * Handles closing mobile menu, toggling the menu button state, and removing event listeners.
	 *
	 * Fires when:
	 * - User presses escape Escape key.
	 * - User clicks outside of the mobile menu, or changes tab.
	 * - User clicks on the mobile menu close button.
	 *
	 * @param {KeyboardEvent|MouseEvent} event - The event object representing the user interaction.
	 */
	const closeMobileMenu = ( event ) => {
		if (
			event.key !== 'Escape' &&
			event.type !== 'click'
		 ) {
			return;
		}

		$button.off( 'click', closeMobileMenu );
		$( document ).off( 'keydown', closeMobileMenu );
		$( document ).on( 'keydown', mobileMenuFocusTrap );
		$window.off( 'scroll resize', adjustMobileMenuContainerSpacing );

		$button.addClass( 'so-menu-open' )
			.attr( 'aria-label', siteoriginSnapshot.menu.open );

		// Briefly delay to allow for WP event handling.
		setTimeout( () => {
			$mobileMenuContainer.find( '.wp-block-navigation__responsive-container-close' ).trigger( 'click' );
			$button.trigger( 'focus' );

			if ( mobileMenuIsTextButton ) {
				$button.text( siteoriginSnapshot.menu.btnOpenText );
			}

			// Delay the class removal and mobile menu top until the end of
			// the call stack to ensure the class has gone through.
			setTimeout( () => {
				$button.removeClass( 'so-menu-open' );
				$( 'html' ).removeClass( 'so-mobile-menu-open' );
				$mobileMenuContainer.css( 'top', 0 );
			}, 0 );
		}, 100 );
	}

	const $siteTitle = $siteHeader.find( '.site-title > a' );
	const lastMenuItem = $mobileMenuContainer.find( 'a' ).last().get( 0 );

	/**
	 * Override the default tab behavior for the mobile menu by tabbing back to the site title link, rather than the first menu item.
	 *
	 * @param {KeyboardEvent} event - The keyboard event triggered by user interaction.
	 */
	const mobileMenuFocusTrap = ( event ) => {
		// We're only looking to process tabs that don't have a shift modifier.
		// The mobile menu only prevents looping back to site title.
		if (
			event.key !== 'Tab' ||
			event.shiftKey
		) {
			return;
		}

		// Do we need to loop to the site title?
		if ( event.target !== lastMenuItem ) {
			return;
		}

		event.preventDefault();
		event.stopPropagation();
		$siteTitle.trigger( 'focus' );
	}

	// Fired on Mobile Menu open.
	$button.on( 'click', function() {
		if ( $button.hasClass( 'so-menu-open' ) ) {
			return;
		}

		$( 'html' ).addClass( 'so-mobile-menu-open' );

		$button.addClass( 'so-menu-open' )
			.attr( 'aria-label', siteoriginSnapshot.menu.close );

		if ( mobileMenuIsTextButton ) {
			$button.text( siteoriginSnapshot.menu.btnCloseText );
		}

		// Add events to close the mobile menu.
		$button.one( 'click', closeMobileMenu );
		$( document ).one( 'keydown', closeMobileMenu );
		$( document ).on( 'keydown', mobileMenuFocusTrap );

		// Spacing adjustments for the mobile menu.
		$window.on( 'resize scroll', adjustMobileMenuContainerSpacing ).trigger( 'scroll' );
	} );

	// Header Search Improvements.
	const searchButton = $siteHeader.find( '.wp-block-search__button' );
	const searchOverlay = $( '.siteorigin-snapshot-search-overlay' );
	if ( searchButton.length && searchOverlay.length ) {
		const searchField = searchOverlay.find( '.wp-block-search__input' );
		const searchOverlayCloseButton = searchOverlay.find( '.siteorigin-snapshot-search-overlay-close' );

		// Handle displaying search overlay.
		searchButton.on( 'click', function() {
			searchOverlay.addClass( 'so-active' );
			$( document ).on( 'keydown', closeSearchOverlayEsc );
			$( document ).on( 'keydown', focusTrapSearchOverlay );

			searchButton.attr( 'aria-expanded', true );

			$( document ).on( 'scroll', searchCloseButtonPlacementMobile ).trigger( 'scroll' );

			// Focus on the search input after a short delay.
			setTimeout( () => {
				searchField.trigger( 'focus' );
			}, 100 );
		} );

		/**
		 * Closes the search overlay.
		 *
		 * This function handles the closure of the search overlay by:
		 * - Removing the 'so-active' class from the search overlay,
		 * - Setting the 'aria-expanded' attribute of the search button to false.
		 * - Removing all event listeners that were added when opening the overlay.
		 */
		const closeSearchOverlay = () => {
			searchOverlay.removeClass( 'so-active' );
			searchButton.attr( 'aria-expanded', false );
			$( document ).off( 'keydown', closeSearchOverlayEsc );
			$( document ).off( 'keydown', focusTrapSearchOverlay );
			$( document ).off( 'scroll', searchCloseButtonPlacementMobile );
		};

		/**
		 * Handles closing the the search overlay when the close button is clicked or
		 * when the Enter key is pressed.
		 *
		 * @param {MouseEvent|KeyboardEvent} event - The event object representing the user interaction.
		 */
		searchOverlayCloseButton.on( 'click keypress', function( event ) {

			if ( event.type === 'keypress' && event.key !== 'Enter' ) {
				return;
			}

			closeSearchOverlay();
		} );

		// Position the search button close icon for mobile devices.
		const searchCloseButtonPlacementMobile = ( event ) => {
			if ( window.innerWidth > 782 ) {
				searchOverlayCloseButton.css( 'top', '' );
				return;
			}

			const baseHeight = 39;

			if ( adminBarHeight === 0 ) {
				console.log(99);
				searchOverlayCloseButton.css(
					'top',
					`${ baseHeight }px`
				);

				return;
			}

			const currentScrollPosition = $window.scrollTop();
			const adminBarScrollOffset = currentScrollPosition > adminBarHeight ? adminBarHeight : currentScrollPosition;

			searchOverlayCloseButton.css(
				'top',
				`calc(${ baseHeight }px + ${ adminBarHeight }px - ${ adminBarScrollOffset }px)`
			);
		};

		/**
		 * Closes the search overlay when the Escape key is pressed.
		 *
		 * @param {MouseEvent|KeyboardEvent} event - The event object representing the user interaction.
		 */
		const closeSearchOverlayEsc = ( event ) => {
			if ( event.key === 'Escape' ) {
				closeSearchOverlay();
			}
		}

		/**
		 * Focus trap inside of search overlay.
		 * This will help with keyboard navigation and accessibility.
		 *
		 * @param {Event} event - The event that triggered the function.
		 */
		const focusTrapSearchOverlay = (event) => {

			if ( event.key !== 'Tab' ) {
				return;
			}

			if ( ! searchOverlay.find( document.activeElement ).length ) {
				setTimeout( () => {
					searchField.trigger( 'focus' );
				}, 1 );
			}
		}
	}

	// Detect if a submenu displays offscreen, and a class to reposition it.
	const $submenuContainers = $siteHeader.find( '.wp-block-navigation__submenu-container' );
	const accountForOffscreenSubMenus = () => {
		// Don't try to do this on mobile.
		if ( window.innerWidth < 600 ) {
			return;
		}

		$submenuContainers.each( function() {
			const $submenu = $( this );
			const submenuOffset = $submenu.offset();
			const submenuWidth = $submenu.outerWidth();
			const viewportWidth = window.innerWidth;

			$submenu.toggleClass(
				'so-offscreen',
				submenuOffset.left + submenuWidth > viewportWidth
			);
		} );
	};
	$window.on( 'resize', accountForOffscreenSubMenus ).trigger( 'resize' );
} );
