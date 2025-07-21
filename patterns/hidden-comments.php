<?php
/**
 * Title: Comments
 * Slug: siteorigin-snapshot/comments
 * Categories: hidden
 * Inserter: no
 */
?>
<!-- wp:comments {"style":{"spacing":{"margin":{"top":"64px"}}}} -->
<div class="wp-block-comments" style="margin-top:64px"><!-- wp:comments-title {"showPostTitle":false,"level":3,"style":{"spacing":{"margin":{"bottom":"40px"}},"typography":{"textTransform":"uppercase"}}} /-->

<!-- wp:comment-template -->
<!-- wp:columns {"style":{"spacing":{"blockGap":{"left":"24px"},"margin":{"top":"40px","bottom":"16px"}}}} -->
<div class="wp-block-columns" style="margin-top:40px;margin-bottom:16px"><!-- wp:column {"width":"64px","layout":{"type":"default"}} -->
<div class="wp-block-column" style="flex-basis:64px"><!-- wp:avatar {"size":64,"style":{"border":{"radius":"100px"}}} /--></div>
<!-- /wp:column -->

<!-- wp:column {"className":"author-column"} -->
<div class="wp-block-column author-column"><!-- wp:comment-author-name {"style":{"typography":{"letterSpacing":"2px","lineHeight":"1.14","fontStyle":"normal","fontWeight":"700","fontSize":"14px","textTransform":"uppercase"}},"fontFamily":"open-sans"} /-->

<!-- wp:group {"className":"comment-meta","style":{"spacing":{"margin":{"top":"6px"}}},"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"left"}} -->
<div class="wp-block-group comment-meta" style="margin-top:6px"><!-- wp:comment-date {"style":{"elements":{"link":{"color":{"text":"var:preset|color|smokey"},":hover":{"color":{"text":"var:preset|color|accent"}}}},"typography":{"textTransform":"uppercase","fontStyle":"normal","fontWeight":"500","lineHeight":"1.33","letterSpacing":"2px"}},"fontSize":"extra-small","fontFamily":"open-sans"} /-->

<!-- wp:comment-edit-link {"fontSize":"small"} /--></div>
<!-- /wp:group --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->

<!-- wp:columns {"style":{"spacing":{"blockGap":{"top":"0px","left":"24px"},"margin":{"top":"0px","bottom":"40px"}}}} -->
<div class="wp-block-columns" style="margin-top:0px;margin-bottom:40px"><!-- wp:column {"width":"64px","layout":{"type":"default"}} -->
<div class="wp-block-column" style="flex-basis:64px"></div>
<!-- /wp:column -->

<!-- wp:column {"style":{"spacing":{"blockGap":"16px"}}} -->
<div class="wp-block-column"><!-- wp:comment-content /-->

<!-- wp:comment-reply-link {"style":{"elements":{"link":{"color":{"text":"var:preset|color|primary"},":hover":{"color":{"text":"var:preset|color|accent"}}}},"typography":{"fontSize":"14px","lineHeight":"1.14","textTransform":"uppercase","fontStyle":"normal","fontWeight":"700","letterSpacing":"2px"}},"fontFamily":"open-sans"} /--></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->
<!-- /wp:comment-template -->

<!-- wp:comments-pagination {"paginationArrow":"arrow","layout":{"type":"flex","justifyContent":"center"}} -->
<!-- wp:comments-pagination-previous {"label":"<?php esc_attr_e( 'Previous', 'siteorigin-snapshot' ); ?>","style":{"typography":{"fontSize":"14px"}}} /-->

<!-- wp:comments-pagination-numbers /-->

<!-- wp:comments-pagination-next {"label":"<?php esc_attr_e( 'Next', 'siteorigin-snapshot' ); ?>","style":{"typography":{"fontSize":"14px"}}} /-->
<!-- /wp:comments-pagination -->

<!-- wp:post-comments-form {"style":{"typography":{"textTransform":"none","fontSize":"16px","fontStyle":"normal","fontWeight":"400"}}} /--></div>
<!-- /wp:comments -->
