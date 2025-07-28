<?php
if ( ! function_exists( 'siteorigin_snapshot_search_overlay' ) ) {
	/**
	 * Adds the search overlay to the footer.
	 *
	 * This function is hooked to the `wp_footer` action and outputs
	 * the search overlay HTML. The overlay is only displayed if
	 * the `siteorigin_snapshot_search_overlay` filter returns true.
	 */
	function siteorigin_snapshot_search_overlay() {
		if ( ! apply_filters( 'siteorigin_snapshot_search_overlay', true ) ) {
			return;
		}

		ob_start();
		get_template_part( 'patterns/hidden-overlay-search-form' );
		$search_form = ob_get_clean();
		if ( empty( $search_form ) ) {
			return;
		}
		?>
		<section
			class="siteorigin-snapshot-search-overlay"
			aria-label="<?php esc_attr_e( 'Search Overlay', 'siteorigin-snapshot' ); ?>"
			role="dialog"
		>
			<button type="button" class="siteorigin-snapshot-search-overlay-close">
				<?php siteorigin_snapshot_display_icon( 'close' ); ?>
				<span class="screen-reader-text">
					<?php esc_html_e( 'Close Search Overlay', 'siteorigin-snapshot' ); ?>
				</span>
			</button>

			<div class="siteorigin-snapshot-search-overlay-content">
				<?php
				echo do_blocks( $search_form );
				?>
			</div>
		</section>
		<?php
	}
}
add_action( 'wp_footer', 'siteorigin_snapshot_search_overlay' );
