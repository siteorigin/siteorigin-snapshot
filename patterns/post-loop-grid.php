<?php
/**
 * Title: Post Loop Grid
 * Slug: siteorigin-snapshot/post-loop-grid
 * Categories: posts
 * Keywords: loop, blog, posts, grid, query
 * Block Types: core/query
 */
?>

<!-- wp:query {"queryId":6,"query":{"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":true},"className":"snapshot-grid","layout":{"type":"constrained"}} -->
<div class="wp-block-query snapshot-grid"><!-- wp:post-template {"style":{"spacing":{"blockGap":"24px"}},"layout":{"type":"grid","columnCount":2}} -->
<!-- wp:post-featured-image {"isLink":true,"aspectRatio":"auto","width":"360px","height":"240px","style":{"spacing":{"margin":{"bottom":"0px"}}}} /-->

<!-- wp:post-title {"level":3,"isLink":true,"style":{"typography":{"lineHeight":"1.2"},"spacing":{"margin":{"bottom":"16px","top":"32px"}}},"fontSize":"medium"} /-->

<!-- wp:pattern {"slug":"siteorigin-snapshot/post-meta"} /-->

<!-- wp:post-excerpt {"style":{"typography":{"lineHeight":"1.75"},"spacing":{"margin":{"top":"0px","bottom":"0px"}}},"fontSize":"regular"} /-->

<!-- wp:read-more {"content":"<?php esc_attr_e( 'continue reading', 'siteorigin-snapshot' ); ?>","style":{"spacing":{"margin":{"bottom":"40px"}},"elements":"border":{"width":"1px"}}} /-->

<!-- /wp:post-template --></div>
<!-- /wp:query -->
