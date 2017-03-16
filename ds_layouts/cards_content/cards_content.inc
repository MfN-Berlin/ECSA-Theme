<?php

/**
 * @file
 * Display Suite Cards Content configuration.
 */

function ds_cards_content() {
  return array(
    'label' => t('Cards Content'),
    'regions' => array(
      'cardsimage' => t('cardsimage'),
      'cardsheader' => t('cardsheader'),
      'cardscontent' => t('cardscontent'),
    ),
    // Uncomment if you want to include a CSS file for this layout (cards_content.css)
    // 'css' => TRUE,
    // Uncomment if you want to include a preview for this layout (cards_content.png)
    // 'image' => TRUE,
  );
}
