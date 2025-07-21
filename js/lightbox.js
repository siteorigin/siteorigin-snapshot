/**
 * Lightbox functionality enhancements.
 *
 * Improves the WordPress core lightbox functionality for gallery blocks,
 * adding keyboard navigation and gallery navigation controls.
 *
 * @package siteorigin-snapshot
 * @since 1.0
 * @license GPLv3
 */

jQuery( function( $ ) {
	// Improve WordPress Lightbox for Gallery Blocks.
	const lightboxElement = $( '.wp-lightbox-overlay' );
	if ( ! lightboxElement.length ) {
		return;
	}

	/**
	 * Handles keyboard navigation for the lightbox.
	 *
	 * This function listens for the 'ArrowLeft' and 'ArrowRight' key. When pressed,
	 * it triggers a click event on the previous and next buttons respectively.
	 *
	 * @param {KeyboardEvent} event - The keyboard event triggered by the user.
	 */
	const lightboxKeyboardNavigation = ( event ) => {
		if ( event.key === 'ArrowLeft' ) {
			$( '.so-lightbox-prev' ).trigger( 'click' );
		}

		if ( event.key === 'ArrowRight' ) {
			$( '.so-lightbox-next' ).trigger( 'click' );
		}
	};

	/**
	 * Closes the lightbox when the Escape key is pressed.
	 *
	 * This function listens for the 'Escape' key event and triggers a click event
	 * on the lightbox's close button, effectively closing the lightbox.
	 *
	 * @param {KeyboardEvent} event - The keyboard event triggered by the user.
	 */
	const lightboxCloseOnEscape = (event) => {
		if ( event.key === 'Escape' ) {
			lightboxElement.find( '.close-button' ).trigger( 'click' );
		}
	};

	/**
	 * Focus trap inside of lightbox.
	 * This will help with keyboard navigation and accessibility.
	 *
	 * @param {Event} event - The event that triggered the function.
	 */
	const lightboxFocusTrap = (event) => {
		if ( event.key !== 'Tab' ) {
			return;
		}

		if ( ! lightboxElement.find( document.activeElement ).length ) {
			setTimeout( () => {
				lightboxElement.find( '.close-button' ).trigger( 'focus' );
			}, 1 );
		}
	};

	const destroyLightbox = () => {
		$( '.so-lightbox-pagination' ).remove();
		$( '.so-lightbox-prev' ).remove();
		$( '.so-lightbox-next' ).remove();

		$( document ).off( 'keydown', lightboxCloseOnEscape );
		$( document ).off( 'keydown', lightboxFocusTrap );
		$( document ).off( 'keydown', lightboxKeyboardNavigation );
	}

	// Detect when the lightbox is closed, and clear the navigation.
	const lightboxObserver = new MutationObserver( ( mutations ) => {
		mutations.forEach( ( mutation ) => {
			if ( mutation.attributeName !== 'aria-modal' ) {
				return;
			}

			if ( lightboxElement.attr( 'aria-modal' ) ) {
				return;
			}

			destroyLightbox();
		} );
	} );
	lightboxObserver.observe( lightboxElement[0], {
		attributes: true
	} );

	/**
	 * Navigates the lightbox to a specific image based on the index.
	 *
	 * @param {jQuery} container - The container element of the lightbox.
	 * @param {jQuery} images - The collection of image elements within the lightbox.
	 * @param {number} index - The index of the image to navigate to.
	*/
	const handleLightboxNumberNavigation = ( container, images, index ) => {
		destroyLightbox();
		images.eq( index ).find( '.lightbox-trigger' ).trigger( 'click' );
	};

	/**
	 * Sets up lightbox navigation including pagination and arrow navigation.
	 *
	 * @param {Event} event - The event object associated with the lightbox trigger click.
	*/
	const setupLightbox = ( event ) => {
		const container = event.data.container;
		const images = event.data.images;
		const currentActiveItem = event.data.currentItem;

		// Add a numbered list to act as pagination for the lightbox.
		const pagination = $( '<ul class="so-lightbox-pagination"></ul>' );
		images.each( function( index ) {
			const currentIndex = index + 1;
			const formattedNumber = currentIndex < 10 ? `0${ currentIndex }` : `${ currentIndex }`;
			const button = $( `<button>${ formattedNumber }</button>`)
				.on( 'click', ( event ) => {
					event.preventDefault();
					event.stopPropagation();

					handleLightboxNumberNavigation( container, images, index )
				} )
				.addClass( index === currentActiveItem ? 'so-active-item' : '' )
				.attr( 'aria-label', siteoriginSnapshot.lightbox.goTo.replace( '%s', currentIndex ) );

			const listItem = $( '<li></li>' ).append( button );
			pagination.append( listItem );
		} );

		const arrowNavigation = '<svg class="snapshot-icon arrow-icon" viewBox="0 0 24 24" fill="none"><path d="M9 6L15 12L9 18"></path></svg>';

		// Add arrow navigation.
		const createNavigationButton = ( buttonClass, arrowNavigation, text, calculateNewIndex ) => {
			return $(`<button class="${ buttonClass }" aria-label="${ text }">${ arrowNavigation }</button>`)
				.on( 'click', ( event ) => {
					event.preventDefault();
					event.stopPropagation();

					const newIndex = calculateNewIndex();
					handleLightboxNumberNavigation( container, images, newIndex );
				} );
		}

		const prevButton = createNavigationButton(
			'so-lightbox-prev',
			arrowNavigation,
			siteoriginSnapshot.lightbox.previous,
			() => currentActiveItem === 0 ? images.length - 1 : currentActiveItem - 1
		);

		const nextButton = createNavigationButton(
			'so-lightbox-next',
			arrowNavigation,
			siteoriginSnapshot.lightbox.next,
			() => currentActiveItem === images.length - 1 ? 0 : currentActiveItem + 1
		);

		lightboxElement.append( pagination, prevButton, nextButton );

		$( document ).on( 'keydown', lightboxCloseOnEscape );
		$( document ).on( 'keydown', lightboxFocusTrap );
		$( document ).on( 'keydown', lightboxKeyboardNavigation );
	};

	// Initializes lightbox functionality for gallery blocks with lightbox triggers.
	const lightboxGalleries = $( '.so-gallery-lightboxes' );
	lightboxGalleries.each( function() {
		const container = $( this );
		const images = $( this ).find( '.wp-lightbox-container' );

		images.each( function( index ) {
			$( this ).on( 'click', {
				container,
				images,
				currentItem: index
			}, setupLightbox );
		} );
	} );
} );
