<?php
/**
 * Title: Author
 * Slug: siteorigin-snapshot/author
 * Categories: hidden
 * Inserter: no
 */
?>
<!-- wp:template-part {"slug":"header","align":"full"} /-->

<!-- wp:group {"style":{"border":{"bottom":{"style":"none","width":"0px"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="border-bottom-style:none;border-bottom-width:0px"><!-- wp:group {"style":{"spacing":{"padding":{"bottom":"36px"},"margin":{"bottom":"48px"},"blockGap":"32px"},"border":{"bottom":{"color":"var:preset|color|platinum","width":"1px"},"top":[],"right":[],"left":[]}},"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"left"}} -->
<div class="wp-block-group" style="border-bottom-color:var(--wp--preset--color--platinum);border-bottom-width:1px;margin-bottom:48px;padding-bottom:36px"><!-- wp:avatar {"size":92} /-->

<!-- wp:group {"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:query-title {"type":"archive","textAlign":"left","showPrefix":false,"style":{"layout":{"selfStretch":"fit","flexSize":null},"typography":{"lineHeight":"1.5","textDecoration":"none","textTransform":"uppercase","letterSpacing":"2px","fontStyle":"normal","fontWeight":"700"}},"fontFamily":"open-sans"} /-->

<!-- wp:post-author-biography {"style":{"spacing":{"padding":{"bottom":"20px"},"margin":{"top":"0px","bottom":"0px"}}}} /--></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:group {"tagName":"main","layout":{"type":"constrained"}} -->
<main class="wp-block-group"><!-- wp:columns {"style":{"spacing":{"padding":{"right":"0px","left":"0px"}}}} -->
<div class="wp-block-columns" style="padding-right:0px;padding-left:0px"><!-- wp:column -->
<div class="wp-block-column">
<!-- wp:pattern {"slug":"siteorigin-snapshot/post-loop-grid"} /-->
<!-- wp:separator {"className":"is-style-wide pagination-separator","style":{"spacing":{"margin":{"bottom":"40px"}}},"backgroundColor":"platinum"} -->
<hr class="wp-block-separator has-text-color has-platinum-color has-alpha-channel-opacity has-platinum-background-color has-background is-style-wide pagination-separator" style="margin-bottom:40px"/>
<!-- /wp:separator -->
<!-- wp:query-pagination {"layout":{"type":"flex","justifyContent":"center"}} -->
<!-- wp:query-pagination-previous {"label":"<?php esc_attr_e( 'Previous', 'siteorigin-snapshot' ); ?>"} /-->
<!-- wp:query-pagination-numbers {"midSize":1,"style":{"typography":{"fontStyle":"normal","fontWeight":"500"}},"fontSize":"small","fontFamily":"open-sans"} /-->
<!-- wp:query-pagination-next {"label":"<?php esc_attr_e( 'Next', 'siteorigin-snapshot' ); ?>"} /-->
<!-- /wp:query-pagination -->
</div>
<!-- /wp:column -->

<!-- wp:column {"width":"320px"} -->
<div class="wp-block-column" style="flex-basis:320px"><!-- wp:template-part {"slug":"sidebar","className":"snapshot-sidebar"} /--></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></main>
<!-- /wp:group -->

<!-- wp:template-part {"slug":"footer","align":"full"} /-->
