<?php

/**
 * @file
 * Default simple view template to display a rows in a grid.
 *
 * - $rows contains a nested array of rows. Each row contains an array of
 *   columns.
 *
 * @ingroup views_templates
 */

 $columns = (int) $options['columns'] ;
 $mapping = array(
     1 => 'one',
     2 => 'two',
     3 => 'three',
     4 => 'four',
     5 => 'five'
 );
 $column_class = $mapping[$columns] ;

?>
<?php if (!empty($title)) : ?>
  <h3><?php print $title; ?></h3>
<?php endif; ?>

<div class="ui grid">
    <?php foreach ($rows as $row_number => $columns): ?>
      <div class="doubling <?php print $column_class; ?> column row">
        <?php foreach ($columns as $column_number => $item): ?>
          <div class="column">
            <?php print $item; ?>
          </div>
        <?php endforeach; ?>
      </div>
    <?php endforeach; ?>
</div>