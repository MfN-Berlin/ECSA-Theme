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
?>
<div class="events events3">
	<a href="<?php //echo $_SERVER['REQUEST_URI']; ?><?php global $base_url; print $base_url;?>/museum/events"><h2 class="pane-title"><?php print t('Upcoming events');?> <i class="calendar outline icon"><span class="calendar-date"><?php print date('j');?></span></i></h2></a>
</div>
<?php print theme('flexslider', array('items' => $items, 'settings' => $settings)); ?>
