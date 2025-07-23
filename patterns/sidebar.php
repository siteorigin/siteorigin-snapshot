<?php
/**
 * Title: Sidebar
 * Slug: siteorigin-snapshot/sidebar
 * Categories: hidden
 * Inserter: no
 */
?>
<!-- wp:group {"style":{"spacing":{"padding":{"left":"40px"},"blockGap":"48px"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="padding-left:40px"><!-- wp:group {"style":{"spacing":{"blockGap":"26px"}},"layout":{"type":"flex","orientation":"vertical"}} -->
<div class="wp-block-group"><!-- wp:heading {"level":3,"style":{"typography":{"fontSize":"1rem","fontStyle":"normal","fontWeight":"700","letterSpacing":"2px"}}} -->
<h3 class="wp-block-heading" style="font-size:1rem;font-style:normal;font-weight:700;letter-spacing:2px"><?php esc_html_e( 'Recent Posts', 'siteorigin-snapshot' ); ?></h3>
<!-- /wp:heading -->

<!-- wp:latest-posts {"postsToShow":3,"displayPostDate":true,"displayFeaturedImage":true,"featuredImageAlign":"left","featuredImageSizeWidth":72,"featuredImageSizeHeight":72,"addLinkToFeaturedImage":true,"style":{"elements":{"link":{"color":{"text":"var:preset|color|black"},":hover":{"color":{"text":"var:preset|color|accent"}}}}},"textColor":"primary"} /--></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"blockGap":"26px"}},"layout":{"type":"flex","orientation":"vertical"}} -->
<div class="wp-block-group"><!-- wp:heading {"level":3,"style":{"typography":{"letterSpacing":"2px","fontStyle":"normal","fontWeight":"700","fontSize":"1rem"}}} -->
<h3 class="wp-block-heading" style="font-size:1rem;font-style:normal;font-weight:700;letter-spacing:2px"><?php esc_html_e('Categories', 'siteorigin-snapshot');?></h3>
<!-- /wp:heading -->

<!-- wp:categories {"showEmpty":true} /--></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"blockGap":"26px"}},"layout":{"type":"flex","orientation":"vertical"}} -->
<div class="wp-block-group"><!-- wp:heading {"level":3,"style":{"typography":{"fontSize":"1rem","letterSpacing":"2px","fontStyle":"normal","fontWeight":"700"}}} -->
<h3 class="wp-block-heading" style="font-size:1rem;font-style:normal;font-weight:700;letter-spacing:2px"><?php esc_html_e( 'Tags', 'siteorigin-snapshot' ); ?></h3>
<!-- /wp:heading -->

<!-- wp:tag-cloud {"numberOfTags":10,"smallestFontSize":"13px","largestFontSize":"13px","className":"is-style-default"} /--></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
