<?php

/**
 * @file
 * Display Suite blog-teaser configuration.
 */

function ds_segment() {
  return array(
    'label' => t('UI Segment'),
    'regions' => array(
	  'title' => t('Title'),
	  'visible' => t('Visible Content'),
    ),
    // Uncomment if you want to include a CSS file for this layout (blogteaser.css)
    // 'css' => TRUE,
    // Uncomment if you want to include a preview for this layout (blogteaser.png)
    // 'image' => TRUE,
  );
}
