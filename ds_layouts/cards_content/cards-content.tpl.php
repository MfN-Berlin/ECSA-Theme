<?php
/**
 * @file
 * Display Suite Cards Content template.
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
 * - $cardsimage: Rendered content for the "cardsimage" region.
 * - $cardsimage_classes: String of classes that can be used to style the "cardsimage" region.
 *
 * - $cardsheader: Rendered content for the "cardsheader" region.
 * - $cardsheader_classes: String of classes that can be used to style the "cardsheader" region.
 *
 * - $cardscontent: Rendered content for the "cardscontent" region.
 * - $cardscontent_classes: String of classes that can be used to style the "cardscontent" region.
 */
?>


  <div class="card">
    <div class="card-image">
      <?php print $cardsimage; ?>
    </div>
    <div class="card-header">
      <?php print $cardsheader; ?>
    </div>
    <div class="card-copy">
      <?php print $cardscontent; ?>
    </div>
  </div>
    <?php if (isset($title_suffix['contextual_links'])): ?>
    <?php print render($title_suffix['contextual_links']); ?>
  <?php endif; ?>

<?php if (!empty($drupal_render_children)): ?>
  <?php print $drupal_render_children ?>
<?php endif; ?>

