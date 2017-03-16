  <?php if (!empty($content['header'])): ?>
    <header id="header" class="header-wrapper ui container" <?php if (isset($bg)) print "style='background-image : url(".$bg.");' ";?>>
      	 <?php print render($content['header']); ?>
    </header>
  <?php endif; ?>
 <?php if (isset($content['menu_bar'])) : ?>
    <?php print $content['menu_bar'] ; ?>
 <?php endif; ?>
<div class="ui container" id="content">
	<?php if ( $content['sidebar']) : ?>
		<div class="ui internally celled padded stackable grid page-grid">
  			<div class="row">
    			<div class="ten wide column">
    				<?php print render($content['content']); ?>
    			</div>
    			<div class="six wide column">
      		 		<?php print render($content['sidebar']); ?>
    		 	</div>
    		</div>
		</div>
	<?php else: ?>
		<div class="ui internally celled padded stackable grid page-grid">
  			<div class="row">
    			<div class="sixteen wide column">
      		 		<?php print render($content['content']); ?>
    		 	</div>
    		</div>
		</div>
	 <?php endif;;?>
</div>
<?php if (!empty($content['footer'])): ?>
<footer class="footer-wrapper"><?php print render($content['footer']); ?></footer>
<?php endif; ?>
