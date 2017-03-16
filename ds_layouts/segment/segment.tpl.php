<?php
/**
 * @file
 * Display Suite blog-teaser template.
 *
 * Available variables:
 *
 * Layout:
 * - $classes: String of classes that can be used to style this layout.
 * - $contextual_links: Renderable array of contextual links.
 * - $layout_wrapper: wrapper surrounding the layout.
 *
 * Regions:
 *
 * - $blogcontent: Rendered content for the "blogcontent" region.
 * - $blogcontent_classes: String of classes that can be used to style the "blogcontent" region.
 */
?>
<!-- Needed to activate display suite support on forms -->

<section class="ui vertical segment no border">
  <?php if (isset($title_suffix['contextual_links'])): ?>
    <?php print render($title_suffix['contextual_links']); ?>
  <?php endif; ?>

  <?php if (!empty($title)): ?><div class="content"><?php print $title; ?></div><?php endif; ?>

  <?php print $visible; ?>
  <?php if (!empty($drupal_render_children)): ?>
    <?php print $drupal_render_children ?>
  <?php endif; ?>
</section>