<?php
/**
 * Title: Posts Slider
 * Slug: siteorigin-snapshot/posts-slider
 * Categories: banner, featured, posts
 * Keywords: slider, hero, featured, blog
 * Block Types: core/query
 */
?>

<!-- wp:query {"queryId":11,"query":{"perPage":3,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false},"enhancedPagination":true,"metadata":{"name":"Posts Hero Loop"},"align":"full","className":"snapshot-posts-slider-loop is-style-posts-slider","layout":{"type":"constrained","wideSize":"100vw"}} -->
<div class="wp-block-query alignfull snapshot-posts-slider-loop is-style-posts-slider"><!-- wp:post-template {"metadata":{"name":""},"align":"full","layout":{"type":"default"}} -->
<!-- wp:post-featured-image {"isLink":true,"overlayColor":"post-slider-overlay-color","dimRatio":30} /-->

<!-- wp:group {"className":"snapshot-featured-group","style":{"spacing":{"blockGap":"1px"}},"layout":{"type":"flex","orientation":"vertical"}} -->
<div class="wp-block-group snapshot-featured-group"><!-- wp:post-terms {"term":"category","style":{"typography":{"lineHeight":"1"}}} /-->

<!-- wp:post-title {"textAlign":"left","isLink":true,"style":{"typography":{"fontSize":"3.75rem","lineHeight":"1","fontStyle":"normal","fontWeight":"700","textTransform":"uppercase"},"spacing":{"margin":{"top":"0px","bottom":"4px"}}}} /-->

<!-- wp:read-more {"content":"<?php esc_attr_e( 'Read More', 'siteorigin-snapshot' ); ?>","style":{"border":{"width":"0px","style":"none"},"spacing":{"padding":{"top":"0px","bottom":"0px","left":"0px","right":"0px"},"margin":{"top":"0px"}},"typography":{"fontSize":"0.88rem","lineHeight":"1"}}} /--></div>
<!-- /wp:group -->
<!-- /wp:post-template --></div>
<!-- /wp:query -->
