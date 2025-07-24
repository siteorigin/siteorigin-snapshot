<?php
/**
 * Title: Archive
 * Slug: siteorigin-snapshot/hidden-archive
 * Categories: hidden
 * Inserter: no
 */
?>
<!-- wp:template-part {"slug":"header","align":"full"} /-->

<!-- wp:group {"tagName":"main","layout":{"type":"constrained"}} -->
<main class="wp-block-group"><!-- wp:group {"tagName":"header","className":"is-style-default","style":{"border":{"top":{"width":"0px","style":"none"},"right":{"width":"0px","style":"none"},"left":{"width":"0px","style":"none"},"bottom":{"color":"var:preset|color|platinum","width":"1px","style":"solid"}},"spacing":{"margin":{"bottom":"48px"},"blockGap":"8px","padding":{"bottom":"36px"}}},"layout":{"type":"flex","orientation":"vertical","justifyContent":"left","verticalAlignment":"center"}} -->
<header class="wp-block-group is-style-default" style="border-top-style:none;border-top-width:0px;border-right-style:none;border-right-width:0px;border-bottom-style:solid;border-bottom-color:var(--wp--preset--color--platinum);border-bottom-width:1px;border-left-style:none;border-left-width:0px;margin-bottom:48px;padding-bottom:36px"><!-- wp:query-title {"type":"archive","textAlign":"left","showPrefix":false,"style":{"layout":{"selfStretch":"fit","flexSize":null},"typography":{"lineHeight":"1.5","textDecoration":"none","textTransform":"uppercase","fontStyle":"normal","fontWeight":"700"}},"fontFamily":"open-sans"} /-->

<!-- wp:term-description {"style":{"spacing":{"padding":{"bottom":"20px"}}}} /--></header>
<!-- /wp:group -->

<!-- wp:columns {"style":{"spacing":{"padding":{"right":"0px","left":"0px"}}}} -->
<div class="wp-block-columns" style="padding-right:0px;padding-left:0px"><!-- wp:column -->
<div class="wp-block-column"><!-- wp:query {"queryId":6,"query":{"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":true},"layout":{"type":"constrained"}} -->
<div class="wp-block-query"><!-- wp:post-template {"style":{"spacing":{"blockGap":"64px"}}} -->
<!-- wp:post-featured-image {"isLink":true,"aspectRatio":"auto","width":"784px","height":"496px"} /-->

<!-- wp:post-title {"level":3,"isLink":true,"style":{"typography":{"lineHeight":"1.2"},"spacing":{"margin":{"bottom":"16px","top":"32px"}}}} /-->

<!-- wp:pattern {"slug":"siteorigin-snapshot/hidden-post-meta-author"} /-->

<!-- wp:post-excerpt {"style":{"typography":{"lineHeight":"1.75"}},"fontSize":"regular"} /-->

<!-- wp:read-more {"content":"<?php esc_attr_e( 'continue reading', 'siteorigin-snapshot' ); ?>","className":"is-style-default","style":{"spacing":{"margin":{"bottom":"40px"}},"border":{"width":"1px"}}} /-->
<!-- /wp:post-template -->

<!-- wp:separator {"className":"is-style-wide pagination-separator","style":{"spacing":{"margin":{"bottom":"40px"}}},"backgroundColor":"platinum"} -->
<hr class="wp-block-separator has-text-color has-platinum-color has-alpha-channel-opacity has-platinum-background-color has-background is-style-wide pagination-separator" style="margin-bottom:40px"/>
<!-- /wp:separator -->

<!-- wp:query-pagination {"layout":{"type":"flex","justifyContent":"center"}} -->
<!-- wp:query-pagination-previous {"label":"<?php esc_attr_e( 'Previous', 'siteorigin-snapshot' ); ?>"} /-->

<!-- wp:query-pagination-numbers {"midSize":1,"style":{"typography":{"fontStyle":"normal","fontWeight":"500"}},"fontSize":"small","fontFamily":"open-sans"} /-->

<!-- wp:query-pagination-next {"label":"<?php esc_attr_e( 'Next', 'siteorigin-snapshot' ); ?>"} /-->
<!-- /wp:query-pagination --></div>
<!-- /wp:query --></div>
<!-- /wp:column -->

<!-- wp:column {"width":"320px"} -->
<div class="wp-block-column" style="flex-basis:320px"><!-- wp:template-part {"slug":"sidebar","className":"snapshot-sidebar"} /--></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></main>
<!-- /wp:group -->

<!-- wp:template-part {"slug":"footer","align":"full"} /-->
