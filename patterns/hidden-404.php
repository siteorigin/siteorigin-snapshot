<?php
/**
 * Title: 404
 * Slug: siteorigin-snapshot/hidden-404
 * Categories: hidden
 * Inserter: no
 */
?>
<!-- wp:template-part {"slug":"header","align":"full"} /-->

<!-- wp:group {"tagName":"main","layout":{"type":"constrained","contentSize":"784px"}} -->
<main class="wp-block-group"><!-- wp:heading {"level":1} -->
<h1 class="wp-block-heading"><?php esc_html_e( 'Page Not Found', 'siteorigin-snapshot' ); ?></h1>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p><?php esc_html_e( "Sorry, the page you're looking for isn't here. Try using the search form below to find what you're after, or use the menu to return to the home page.", 'siteorigin-snapshot' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:search {"label":"<?php esc_attr_e( 'Search', 'siteorigin-snapshot' ); ?>","showLabel":false,"buttonText":"<?php esc_attr_e( 'Search', 'siteorigin-snapshot' ); ?>"} /--></main>
<!-- /wp:group -->

<!-- wp:template-part {"slug":"footer","align":"full"} /-->
