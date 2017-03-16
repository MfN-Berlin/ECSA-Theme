<?php

/**
 * @file
 * Display Suite blog-teaser configuration.
 */

function ds_reveal() {
  return array(
    'label' => t('Node Reveal View'),
    'regions' => array(
	  'title' => t('Title'),
	  'visible' => t('Visible Content'),
      'hide' => t('Hidden Content')
    ),
    // Uncomment if you want to include a CSS file for this layout (blogteaser.css)
    // 'css' => TRUE,
    // Uncomment if you want to include a preview for this layout (blogteaser.png)
    // 'image' => TRUE,
  );
}
