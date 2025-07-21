<?php
/**
 * Title: Style Guide
 * Slug: siteorigin-snapshot/style-guide
 * Categories: guides
 */
?>
<!-- wp:heading {"level":1,"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<h1 class="wp-block-heading" style="margin-top:0;margin-bottom:0"><?php esc_html_e( 'Header H1', 'siteorigin-snapshot' );?></h1>
<!-- /wp:heading -->

<!-- wp:heading {"style":{"spacing":{"margin":{"top":"0px","bottom":"0px"}}}} -->
<h2 class="wp-block-heading" style="margin-top:0px;margin-bottom:0px"><?php esc_html_e( 'Header H2', 'siteorigin-snapshot' );?></h2>
<!-- /wp:heading -->

<!-- wp:heading {"level":3,"style":{"spacing":{"margin":{"top":"0px","bottom":"0px"}}}} -->
<h3 class="wp-block-heading" style="margin-top:0px;margin-bottom:0px"><?php esc_html_e( 'Header H3', 'siteorigin-snapshot' );?></h3>
<!-- /wp:heading -->

<!-- wp:heading {"level":4,"style":{"spacing":{"margin":{"top":"0px","bottom":"0px"}}}} -->
<h4 class="wp-block-heading" style="margin-top:0px;margin-bottom:0px"><?php esc_html_e( 'Header H4', 'siteorigin-snapshot' );?></h4>
<!-- /wp:heading -->

<!-- wp:heading {"level":5,"style":{"spacing":{"margin":{"top":"0px","bottom":"0px"}}}} -->
<h5 class="wp-block-heading" style="margin-top:0px;margin-bottom:0px"><?php esc_html_e( 'Header H5', 'siteorigin-snapshot' );?></h5>
<!-- /wp:heading -->

<!-- wp:heading {"level":6,"style":{"spacing":{"margin":{"top":"0px","bottom":"0px"}}}} -->
<h6 class="wp-block-heading" style="margin-top:0px;margin-bottom:0px"><?php esc_html_e( 'Header H6', 'siteorigin-snapshot' );?></h6>
<!-- /wp:heading -->

<!-- wp:heading -->
<h2 class="wp-block-heading"><?php esc_html_e( 'Blockquotes', 'siteorigin-snapshot' );?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p><?php esc_html_e( 'Single line blockquote:', 'siteorigin-snapshot' );?></p>
<!-- /wp:paragraph -->

<!-- wp:quote -->
<blockquote class="wp-block-quote"><!-- wp:paragraph -->
<p><?php esc_html_e( 'Stay hungry. Stay foolish.', 'siteorigin-snapshot' );?></p>
<!-- /wp:paragraph --></blockquote>
<!-- /wp:quote -->

<!-- wp:paragraph -->
<p><?php esc_html_e( 'Multi-line blockquote with a cite reference:', 'siteorigin-snapshot' );?></p>
<!-- /wp:paragraph -->

<!-- wp:quote {"className":"is-style-default"} -->
<blockquote class="wp-block-quote is-style-default"><!-- wp:paragraph -->
<p><?php esc_html_e( "People think focus means saying yes to the thing you've got to focus on. But that's not what it means at all. It means saying no to the hundred other good ideas that there are. You have to pick carefully. I'm actually as proud of the things we haven't done as the things I have done. Innovation is saying no to 1,000 things.", 'siteorigin-snapshot' );?></p>
<!-- /wp:paragraph --><cite><?php esc_html_e( "Steve Jobs – Apple Worldwide Developers' Conference, 1997", 'siteorigin-snapshot' );?></cite></blockquote>
<!-- /wp:quote -->

<!-- wp:quote {"className":"is-style-plain"} -->
<blockquote class="wp-block-quote is-style-plain"><!-- wp:paragraph -->
<p><?php esc_html_e( "People think focus means saying yes to the thing you've got to focus on. But that’s not what it means at all. It means saying no to the hundred other good ideas that there are. You have to pick carefully. I’m actually as proud of the things we haven't done as the things I have done. Innovation is saying no to 1,000 things.", 'siteorigin-snapshot' );?></p>
<!-- /wp:paragraph --><cite><?php esc_html_e( "Steve Jobs – Apple Worldwide Developers' Conference, 1997", 'siteorigin-snapshot' );?></cite></blockquote>
<!-- /wp:quote -->

<!-- wp:heading -->
<h2 class="wp-block-heading"><?php esc_html_e( 'Tables', 'siteorigin-snapshot' );?></h2>
<!-- /wp:heading -->

<!-- wp:table {"className":"is-style-regular"} -->
<figure class="wp-block-table is-style-regular"><table><thead><tr><th><?php esc_html_e( 'Employee', 'siteorigin-snapshot' );?></th><th><?php esc_html_e( 'Salary', 'siteorigin-snapshot' );?></th><th><?php esc_html_e( 'Description', 'siteorigin-snapshot' );?></th></tr></thead><tbody><tr><td><a href="#"><?php esc_html_e( 'John Doe', 'siteorigin-snapshot' );?></a></td><td><?php esc_html_e( '$1', 'siteorigin-snapshot' );?></td><td><?php esc_html_e( 'Because that’s all Steve Jobs needed for a salary.', 'siteorigin-snapshot' );?></td></tr><tr><td><a href="#"><?php esc_html_e( 'Jane Doe', 'siteorigin-snapshot' );?></a></td><td><?php esc_html_e( '100K', 'siteorigin-snapshot' );?></td><td><?php esc_html_e( 'For all the blogging she does.', 'siteorigin-snapshot' );?></td></tr><tr><td><a href="#"><?php esc_html_e( 'Fred Bloggs', 'siteorigin-snapshot' );?></a></td><td><?php esc_html_e( '$100M', 'siteorigin-snapshot' );?></td><td><?php esc_html_e( 'Pictures are worth a thousand words, right? So Jane x 1,000.', 'siteorigin-snapshot' );?></td></tr><tr><td><a href="#"><?php esc_html_e( 'Jane Bloggs', 'siteorigin-snapshot' );?></a></td><td><?php esc_html_e( '$100B', 'siteorigin-snapshot' );?></td><td><?php esc_html_e( 'With hair like that?! Enough said...', 'siteorigin-snapshot' );?></td></tr></tbody></table><figcaption class="wp-element-caption"><?php esc_html_e( 'Example Caption', 'siteorigin-snapshot' );?></figcaption></figure>
<!-- /wp:table -->

<!-- wp:table {"className":"is-style-unstyled"} -->
<figure class="wp-block-table is-style-unstyled"><table><thead><tr><th><?php esc_html_e( 'Employee', 'siteorigin-snapshot' );?></th><th><?php esc_html_e( 'Salary', 'siteorigin-snapshot' );?></th><th><?php esc_html_e( 'Description', 'siteorigin-snapshot' );?></th></tr></thead><tbody><tr><td><a href="#"><?php esc_html_e( 'John Doe', 'siteorigin-snapshot' );?></a></td><td><?php esc_html_e( '$1', 'siteorigin-snapshot' );?></td><td><?php esc_html_e( "Because that's all Steve Jobs needed for a salary.", 'siteorigin-snapshot' );?></td></tr><tr><td><a href="#"><?php esc_html_e( 'Jane Doe', 'siteorigin-snapshot' );?></a></td><td><?php esc_html_e( '100K', 'siteorigin-snapshot' ); ?></td><td><?php esc_html_e( 'For all the blogging she does.', 'siteorigin-snapshot' );?></td></tr><tr><td><a href="#"><?php esc_html_e( 'Fred Bloggs', 'siteorigin-snapshot' );?></a></td><td><?php esc_html_e( '
$100M', 'siteorigin-snapshot' ); ?></td><td><?php esc_html_e( 'Pictures are worth a thousand words, right? So Jane x 1,000.', 'siteorigin-snapshot' );?></td></tr><tr><td><a href="#"><?php esc_html_e( '
Jane Bloggs', 'siteorigin-snapshot' );?></a></td><td><?php esc_html_e( '$100B', 'siteorigin-snapshot' );?></td><td><?php esc_html_e( 'With hair like that?! Enough said...', 'siteorigin-snapshot' ); ?></td></tr></tbody></table><figcaption class="wp-element-caption"><?php esc_html_e( 'Example Caption', 'siteorigin-snapshot' );?></figcaption></figure>
<!-- /wp:table -->


///
<!-- wp:table {"className":"is-style-stripes"} -->
<figure class="wp-block-table is-style-stripes"><table><thead><tr><th><?php esc_html_e( '
Employee', 'siteorigin-snapshot' ); ?></th><th><?php esc_html_e( '
Salary', 'siteorigin-snapshot' ); ?></th><th><?php esc_html_e( 'Description', 'siteorigin-snapshot' );?></th></tr></thead><tbody><tr><td><a href="#"><?php esc_html_e( 'John Doe', 'siteorigin-snapshot' );?></a></td><td><?php esc_html_e( '$1', 'siteorigin-snapshot' ); ?></td><td><?php esc_html_e( "Because that's all Steve Jobs needed for a salary.", 'siteorigin-snapshot' );?></td></tr><tr><td><a href="#"><?php esc_html_e( 'Jane Doe', 'siteorigin-snapshot' ); ?></a></td><td><?php esc_html_e( '100K', 'siteorigin-snapshot' ); ?></td><td><?php esc_html_e( 'For all the blogging she does.', 'siteorigin-snapshot' ); ?></td></tr><tr><td><a href="#"><?php esc_html_e( 'Fred Bloggs', 'siteorigin-snapshot' );?></a></td><td><?php esc_html_e( '$100M', 'siteorigin-snapshot' ); ?></td><td><?php esc_html_e( 'Pictures are worth a thousand words, right? So Jane x 1,000.', 'siteorigin-snapshot' );?></td></tr><tr><td><a href="#"><?php esc_html_e( '
Jane Bloggs', 'siteorigin-snapshot' );?></a></td><td><?php esc_html_e( '$100B', 'siteorigin-snapshot' ); ?></td><td><?php esc_html_e( 'With hair like that?! Enough said...', 'siteorigin-snapshot' );?></td></tr></tbody></table><figcaption class="wp-element-caption"><?php esc_html_e( 'Example Caption', 'siteorigin-snapshot' );?></figcaption></figure>
<!-- /wp:table -->

<!-- wp:heading -->
<h2 class="wp-block-heading"><?php esc_html_e( 'Unordered List', 'siteorigin-snapshot' );?></h2>
<!-- /wp:heading -->

<!-- wp:list -->
<ul><!-- wp:list-item -->
<li><?php esc_html_e( 'List item one', 'siteorigin-snapshot' );?><!-- wp:list -->
<ul><!-- wp:list-item -->
<li><?php esc_html_e( 'List item one', 'siteorigin-snapshot' );?><!-- wp:list -->
<ul><!-- wp:list-item -->
<li><?php esc_html_e( 'List item one', 'siteorigin-snapshot' );?></li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><?php esc_html_e( 'List item two', 'siteorigin-snapshot' );?></li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><?php esc_html_e( 'List item three', 'siteorigin-snapshot' );?></li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><?php esc_html_e( 'List item four', 'siteorigin-snapshot' );?></li>
<!-- /wp:list-item --></ul>
<!-- /wp:list --></li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><?php esc_html_e( 'List item two', 'siteorigin-snapshot' );?></li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><?php esc_html_e( 'List item three', 'siteorigin-snapshot' );?></li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><?php esc_html_e( 'List item four', 'siteorigin-snapshot' );?></li>
<!-- /wp:list-item --></ul>
<!-- /wp:list --></li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><?php esc_html_e( 'List item two', 'siteorigin-snapshot' );?></li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><?php esc_html_e( 'List item three', 'siteorigin-snapshot' );?></li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><?php esc_html_e( 'List item four', 'siteorigin-snapshot' );?></li>
<!-- /wp:list-item --></ul>
<!-- /wp:list -->

<!-- wp:heading -->
<h2 class="wp-block-heading"><?php esc_html_e( 'Unordered List', 'siteorigin-snapshot' );?></h2>
<!-- /wp:heading -->

<!-- wp:list {"ordered":true} -->
<ol><!-- wp:list-item -->
<li><?php esc_html_e( 'List item one', 'siteorigin-snapshot' );?><!-- wp:list {"ordered":true} -->
<ol><!-- wp:list-item -->
<li><?php esc_html_e( 'List item one', 'siteorigin-snapshot' );?><!-- wp:list {"ordered":true} -->
<ol><!-- wp:list-item -->
<li><?php esc_html_e( 'List item one', 'siteorigin-snapshot' );?></li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><?php esc_html_e( 'List item two', 'siteorigin-snapshot' );?></li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><?php esc_html_e( 'List item three', 'siteorigin-snapshot' );?></li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><?php esc_html_e( 'List item four', 'siteorigin-snapshot' );?></li>
<!-- /wp:list-item --></ol>
<!-- /wp:list --></li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><?php esc_html_e( 'List item two', 'siteorigin-snapshot' );?></li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><?php esc_html_e( 'List item three', 'siteorigin-snapshot' );?></li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><?php esc_html_e( 'List item four', 'siteorigin-snapshot' );?></li>
<!-- /wp:list-item --></ol>
<!-- /wp:list --></li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><?php esc_html_e( 'List item two', 'siteorigin-snapshot' );?></li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><?php esc_html_e( 'List item three', 'siteorigin-snapshot' );?></li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><?php esc_html_e( 'List item four', 'siteorigin-snapshot' );?></li>
<!-- /wp:list-item --></ol>
<!-- /wp:list -->

<!-- wp:heading -->
<h2 class="wp-block-heading"><?php esc_html_e( 'Buttons', 'siteorigin-snapshot' );?></h2>
<!-- /wp:heading -->

<!-- wp:buttons {"layout":{"type":"flex","orientation":"vertical"}} -->
<div class="wp-block-buttons"><!-- wp:button {"className":"is-style-light"} -->
<div class="wp-block-button is-style-light"><a class="wp-block-button__link wp-element-button"><?php esc_html_e( 'Button', 'siteorigin-snapshot' );?></a></div>
<!-- /wp:button -->

<!-- wp:button {"className":"is-style-dark"} -->
<div class="wp-block-button is-style-dark"><a class="wp-block-button__link wp-element-button"><?php esc_html_e( 'Button', 'siteorigin-snapshot' );?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons -->

<!-- wp:buttons {"layout":{"type":"flex","orientation":"vertical"}} -->
<div class="wp-block-buttons"><!-- wp:button {"className":"is-style-tag is-style-tag"} -->
<div class="wp-block-button is-style-tag is-style-tag"><a class="wp-block-button__link wp-element-button"><?php esc_html_e( 'Tag', 'siteorigin-snapshot' );?></a></div>
<!-- /wp:button -->

<!-- wp:button {"className":"is-style-outline"} -->
<div class="wp-block-button is-style-outline"><a class="wp-block-button__link wp-element-button"><?php esc_html_e( 'Tag', 'siteorigin-snapshot' );?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons -->
