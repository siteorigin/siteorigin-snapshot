<?php
if ( ! function_exists( 'siteorigin_snapshot_display_icon' ) ) {
	/**
	 * Displays SVG icons.
	 */
	function siteorigin_snapshot_display_icon( $type, $return = false ) {
		if ( $return ) {
			ob_start();
		}
		switch ( $type ) {
			case 'close': ?>
				<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" stroke="#000" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" aria-label="<?php esc_attr_e( 'Close Model', 'siteorigin-snapshot' ); ?>" class="snapshot-icon"><path d="M18 6 6 18M6 6l12 12"/></svg>
				<?php
				break;

			case 'search': ?>
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-label="<?php esc_attr_e( 'Search', 'siteorigin-snapshot' ); ?>" class="snapshot-icon"><g stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"><path d="M3 10a7 7 0 1 0 14 0 7 7 0 0 0-14 0ZM21 21l-6-6"/></g></svg>
				<?php
			break;

			case 'calendar': ?>
				<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="#000" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" aria-hidden="true" class="snapshot-icon"><path d="M4 7a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V7ZM16 3v4M8 3v4M4 11h16M11 15h1M12 15v3"/></svg>
				<?php
			break;

			case 'chevron-left':
				return '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" aria-hidden="true" class="snapshot-icon" viewBox="0 0 24 24"><path stroke="#000" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m15 18-6-6 6-6"/></svg>';
				break;

			case 'chevron-right':
				return '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" aria-hidden="true" class="snapshot-icon" viewBox="0 0 16 24"><path stroke="#000" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m9 6 6 6-6 6"/></svg>';
				break;

			case 'chevron-up':
				return '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" aria-hidden="true" class="snapshot-icon" viewBox="0 0 16 24"><path stroke="#000" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="m6 15 6-6 6 6"/></svg>';
				break;

			case 'chevron-down':
				return '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" aria-hidden="true" class="snapshot-icon" viewBox="0 0 16 24"><path stroke="#000" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="m6 9 6 6 6-6"/></svg>';
				break;

			case 'comment':
				return '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" aria-hidden="true" class="snapshot-icon"><path stroke="#000" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 9h8m-8 4h6M18 4h0a3 3 0 0 1 3 3v8a3 3 0 0 1-3 3h-5l-5 3v-3H6a3 3 0 0 1-3-3V7a3 3 0 0 1 3-3h12z"/></svg>';
				break;
		}

		if ( $return ) {
			return ob_get_clean();
		}
	}
}

/**
 * Modifies the default WordPress comment form.
 *
 * This function customizes the WordPress comment form for the SiteOrigin Snapshot theme.
 * It modifies the submit button to include an SVG icon and optionally adds placeholders
 * to the comment form fields based on a filter. This allows for a more customized and
 * visually appealing comment form.
 *
 * Placeholder modifications can be disabled by using the `siteorigin_snapshot_comments_add_placeholder` filter. For example, the following code snippet will disable the placeholders:
 *
 * `add_filter( 'siteorigin_snapshot_comments_add_placeholder', '__return_false' );`
 *
 * @param array $defaults The default comment form arguments.
 * @return array Modified comment form arguments.
 */
function siteorigin_snapshot_modify_comments_form( $defaults ) {
	// Modify submit button and add icon.
	$defaults['submit_button'] = '<button name="%1$s" type="submit" id="%2$s" class="wp-block-button__link wp-element-button">%4$s' .
		siteorigin_snapshot_display_icon( 'chevron-right' ) . '</button>';

	// We need to override certain fields to match the design.
	// Certain users may not want this though, so let's provide a filter.
	$add_placeholder = apply_filters( 'siteorigin_snapshot_comments_add_placeholder', true );
	if ( ! $add_placeholder ) {
		return $defaults;
	}

	if ( ! is_user_logged_in() ) {
		$must_fill_name_and_email = get_option( 'require_name_email' );

		$your_name    = __( 'Your Name', 'siteorigin-snapshot' );
		$your_email   = __( 'Your Email', 'siteorigin-snapshot' );
		$your_website = __( 'Your Website', 'siteorigin-snapshot' );

		$name_required     = $must_fill_name_and_email ? ' <span class="required">*</span>' : '';
		$email_required    = $must_fill_name_and_email ? ' <span class="required">*</span>' : '';
		$name_placeholder  = $must_fill_name_and_email ? esc_attr( $your_name ) . ' *' : esc_attr( $your_name );
		$email_placeholder = $must_fill_name_and_email ? esc_attr( $your_email ) . ' *' : esc_attr( $your_email );
		$required_attr     = $must_fill_name_and_email ? 'required' : '';

		$defaults['fields'] = array_merge(
			$defaults['fields'],
			array(
				'author' => sprintf(
					'<p class="comment-form-author"><label for="author" class="add-placeholder">%s%s</label> <input id="author" name="author" type="text" value="" size="30" maxlength="245" autocomplete="name" placeholder="%s" aria-label="%s" %s/></p>',
					esc_html( $your_name ),
					$name_required,
					$name_placeholder,
					esc_attr( $your_name ),
					$required_attr
				),
				'email'  => sprintf(
					'<p class="comment-form-email"><label for="email" class="add-placeholder">%s%s</label> <input id="email" name="email" type="email" value="" size="30" maxlength="100" aria-describedby="email-notes" autocomplete="email" placeholder="%s" aria-label="%s" %s/></p>',
					esc_html( $your_email ),
					$email_required,
					$email_placeholder,
					esc_attr( $your_email ),
					$required_attr
				),
				'url'    => sprintf(
					'<p class="comment-form-url"><label for="url" class="add-placeholder">%s</label> <input id="url" name="url" type="url" value="" size="30" maxlength="200" autocomplete="url" placeholder="%s" aria-label="%s"/></p>',
					esc_html( $your_website ),
					esc_attr( $your_website ),
					esc_attr( $your_website )
				),
			)
		);
	}

	$your_comment = __( 'Your Comment', 'siteorigin-snapshot' );

	$defaults['comment_field'] = sprintf(
		'<p class="comment-form-comment"><label for="comment" class="add-placeholder">%s <span class="required">*</span></label> <textarea id="comment" name="comment" cols="45" rows="4" maxlength="65525" placeholder="%s *" aria-label="%s" required></textarea></p>',
		esc_html( $your_comment ),
		esc_attr( $your_comment ),
		esc_attr( $your_comment )
	);

	return $defaults;
}
add_filter( 'comment_form_defaults', 'siteorigin_snapshot_modify_comments_form', 100, 1 );
