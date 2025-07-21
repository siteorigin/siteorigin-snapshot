/**
 * Editor-specific functionality.
 *
 * Handles theme behaviors specific to the block editor environment,
 * including posts slider detection and header margin adjustments.
 *
 * @package siteorigin-snapshot
 * @since 1.0
 * @license GPLv3
 */

function snapshotCheckForPostsSlider() {
	const hasPostsSlider = document.querySelector( '.snapshot-posts-slider-loop' ) !== null;

	if ( hasPostsSlider ) {
		document.body.classList.add( 'no-header-margin' );
	} else {
		document.body.classList.remove( 'no-header-margin' );
	}
}
const snapshotPostsSliderObserver = new MutationObserver( snapshotCheckForPostsSlider );

snapshotPostsSliderObserver.observe( document.body, {
	childList: true,
	subtree: true
} );
snapshotCheckForPostsSlider();
