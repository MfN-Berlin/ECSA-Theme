<?php
/**
 * @file
 * Stub template file to call the main FlexSlider theme
 *
 * We can't set the Views display to use the other theme directly since it
 * agressively changes settings of the core theme function if we do.
 * So we have to have this stub theme instead.
 *
 * @author Mathew Winstone <mwinstone@coldfrontlabs.ca>
 */
$columns = 4 ;
$newItems = array();
$curr = 0 ;

foreach ( $items as $key => $item ) {
  if ( !isset($newItems[$curr]) ) {
    $newItems[$curr] = array('slide' => '') ;
  }
  $newItems[$curr]['slide'] .= '<div class="column">' . $item['slide'] . '</div>' ;
  if ( ($key % $columns) == 3 ) {
    $curr++ ;
  }
}

foreach ( $newItems as $k => $item ) {
  $newItems[$k]['slide'] = '<div class="ui grid"><div class="doubling four column row">' . $item['slide'] . '</div></div>' ;
}

?>
<div class="events">
	<a href="<?php //echo $_SERVER['REQUEST_URI']; ?><?php global $base_url; print $base_url;?>/<?php global $language_url; print $language_url->language;?>/museum/events"><h2 class="pane-title"><?php print t('Upcoming events');?> <i class="calendar outline icon"><span class="calendar-date"><?php print date('j');?></span></i></h2></a>
	<div class="flexslider"><?php print  theme('flexslider', array('items' => $newItems, 'settings' => $settings)) ; ?></div>
</div>