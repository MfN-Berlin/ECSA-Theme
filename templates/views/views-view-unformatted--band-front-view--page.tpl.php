<div class="ui content">
<div class="ui grid stackable">
<?php foreach ($rows as $id => $row): ?>
  <div<?php if ($classes_array[$id]) { print ' class="' . $classes_array[$id] .'"';  } ?>>
    <?php print $row; ?>
    <div class="ui section divider"></div>
  </div>
<?php endforeach; ?>
</div>
</div>