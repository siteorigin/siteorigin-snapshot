<?php
/**
 * Title: Post Loop
 * Slug: siteorigin-snapshot/post-loop
 * Categories: posts
 * Keywords: loop, blog, posts, query
 * Block Types: core/query
 */
?>
<!-- wp:query {"queryId":6,"query":{"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":true},"layout":{"type":"constrained"}} -->
<div class="wp-block-query"><!-- wp:post-template {"style":{"spacing":{"blockGap":"64px"}}} -->
<!-- wp:post-featured-image {"isLink":true,"aspectRatio":"auto","width":"784px","height":"496px"} /-->

<!-- wp:post-title {"level":3,"isLink":true,"style":{"typography":{"fontSize":"40px","lineHeight":"1.2"},"spacing":{"margin":{"bottom":"16px","top":"32px"}}}} /-->

<!-- wp:pattern {"slug":"siteorigin-snapshot/post-meta"} /-->

<!-- wp:post-excerpt {"style":{"typography":{"lineHeight":"1.75"}},"fontSize":"regular"} /-->

<!-- wp:read-more {"content":"<?php esc_attr_e( 'continue reading', 'siteorigin-snapshot' ); ?>","style":{"spacing":{"margin":{"top":"24px","bottom":"64px"}},"elements":"border":{"width":"1px"}}} /-->

<!-- /wp:post-template -->

<!-- wp:separator {"style":{"spacing":{"margin":{"bottom":"40px"}}},"backgroundColor":"platinum","className":"is-style-wide"} -->
<hr class="wp-block-separator has-text-color has-platinum-color has-alpha-channel-opacity has-platinum-background-color has-background is-style-wide" style="margin-bottom:40px"/>
<!-- /wp:separator -->

<!-- wp:query-pagination {"layout":{"type":"flex","justifyContent":"center"}} -->
<!-- wp:query-pagination-previous {"label":"<?php esc_attr_e( 'Previous', 'siteorigin-snapshot' ); ?>"} /-->

<!-- wp:query-pagination-numbers {"midSize":1,"style":{"typography":{"fontStyle":"normal","fontWeight":"500"}},"fontSize":"small","fontFamily":"open-sans"} /-->

<!-- wp:query-pagination-next {"label":"<?php esc_attr_e( 'Next', 'siteorigin-snapshot' ); ?>"} /-->
<!-- /wp:query-pagination --></div>
<!-- /wp:query -->
