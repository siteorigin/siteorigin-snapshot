<?php
/**
 * Title: Blog Home
 * Slug: siteorigin-snapshot/home
 * Categories: hidden
 * Inserter: no
 */
?>
<!-- wp:template-part {"slug":"header","align":"full"} /-->

<!-- wp:pattern {"slug":"siteorigin-snapshot/posts-slider"} /-->

<!-- wp:group {"tagName":"main","layout":{"type":"constrained"}} -->
<main class="wp-block-group"><!-- wp:columns {"style":{"spacing":{"padding":{"right":"0px","left":"0px"}}}} -->
<div class="wp-block-columns" style="padding-right:0px;padding-left:0px"><!-- wp:column -->
<div class="wp-block-column"><!-- wp:pattern {"slug":"siteorigin-snapshot/post-loop"} /--></div>
<!-- /wp:column -->

<!-- wp:column {"width":"320px"} -->
<div class="wp-block-column" style="flex-basis:320px"><!-- wp:template-part {"slug":"sidebar","className":"snapshot-sidebar"} /--></div>
<!-- /wp:column --></div>
<!-- /wp:columns --></main>
<!-- /wp:group -->

<!-- wp:template-part {"slug":"footer","align":"full"} /-->
