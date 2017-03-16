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


<?php if (!empty($title)): ?><div class="content"><?php print $title; ?></div><?php endif; ?>

<div class="ui move reveal">
  <div class="visible content">
    <?php print $visible; ?>
  </div>
  <div class="hidden content">
    <div class="ui segment"><?php print $hide; ?></div>
  </div>
</div>
<?php if (!empty($drupal_render_children)): ?>
  <?php print $drupal_render_children ?>
<?php endif; ?>