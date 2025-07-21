/**
 * Posts slider functionality.
 *
 * Handles the posts slider block variation, including pagination controls,
 * navigation, and header margin adjustments for slider layouts.
 *
 * @package siteorigin-snapshot
 * @since 1.0
 * @license GPLv3
 */

jQuery( function( $ ) {
	// Add/remove Header Margin based on Posts Slider presence.
	const hasPostsSlider = $( '.snapshot-posts-slider-loop' ).length > 0;
	if ( hasPostsSlider ) {
		$( 'body' ).addClass( 'no-header-margin' );
	} else {
		$( 'body' ).removeClass( 'no-header-margin' );
	}

	const activeItems = $( '.so-group-pagination-number button[aria-current]' );
	if ( ! activeItems.length ) {
		return;
	}

	// Set up default aria-labels for pagination buttons.
	activeItems.each( function() {
		const $current = $( this );
		$current.attr( 'data-previous-label', $current.attr( 'aria-label' ) );
		$current.attr( 'aria-label', siteoriginSnapshot.posts_slider.current );
	} );

	/**
	 * Change the active pagination button in the slider.
	 *
	 * @param {jQuery} $slider - The jQuery object representing the slider.
	 * @param {jQuery} $current - The jQuery object representing the current active button.
	 */
	const changeActivePagination = ( $slider, $current ) => {
		const $previous = $slider.find( '.so-group-pagination-number button[aria-current]' );

		$previous.removeAttr( 'aria-current' )
			.attr( 'aria-label', $current.attr( 'aria-label' ) );

		// Store the label if needed.
		if ( ! $current.attr( 'previous-label' ) ) {
			$current.attr( 'data-previous-label', $current.attr( 'data-previous-label' ) );
		}

		$current.attr( 'aria-current', 'true' )
			.attr( 'aria-label', siteoriginSnapshot.posts_slider.current );
	};

	// Posts Slider arrow navigation.
	$( document ).on( 'click', '.snapshot-posts-slider-loop .so-group-prev, .snapshot-posts-slider-loop .so-group-next', function() {
		const $postsHeroLoop = $( this ).closest( '.snapshot-posts-slider-loop' );
		if ( ! $postsHeroLoop.length ) {
			return;
		}

		const $current = $postsHeroLoop.find( '.wp-block-post[aria-current]' );
		const isNext = $( this ).hasClass( 'so-group-next' );
		const boundaryCheck = isNext ? $current.next().length : $current.prev().length;

		// Change active slide.
		$current
			.removeAttr( 'aria-current' )
			.attr( 'aria-hidden', true );

		let $targetSlide;
		let slideIndex;
		if ( ! boundaryCheck ) {
			// We're at the end of the slider, so we need to loop back to the start/end.
			const slides = $current.siblings();
			$targetSlide = isNext ? slides.first() : slides.last();
			slideIndex = isNext ? 0 : slides.length;
		} else {
			$targetSlide = isNext ? $current.next() : $current.prev();
			slideIndex = isNext ? $current.index() + 1 : $current.index() - 1;
		}

		$targetSlide
			.attr( 'aria-current', 'true' )
			.removeAttr( 'aria-hidden' );

		// Change active pagination.
		changeActivePagination(
			$postsHeroLoop,
			$postsHeroLoop.find( '.so-group-pagination-number li' ).eq( slideIndex ).find( 'button' )
		);
	} );

	// Posts Slider pagination.
	$( document ).on( 'click', '.snapshot-posts-slider-loop .so-group-pagination-number button', function() {
		const $current = $( this );
		const $postsHeroLoop = $current.closest( '.snapshot-posts-slider-loop' );
		const newPage = parseInt( $current.data( 'page' ) );

		changeActivePagination(
			$postsHeroLoop,
			$current
		);

		// Change active slide.
		$postsHeroLoop.find( '.wp-block-post[aria-current]' )
			.removeAttr( 'aria-current' )
			.attr( 'aria-hidden', true );

		$postsHeroLoop.find( '.wp-block-post-template .wp-block-post' )
			.eq( newPage )
			.attr( 'aria-current', 'true' )
			.removeAttr( 'aria-hidden' );
	} );
} );
