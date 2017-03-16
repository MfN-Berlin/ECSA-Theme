
<header id="header" class="header-wrapper ui container">
	<div class="ui grid">
	<div class="four wide mobile four wide tablet four wide computer column middle aligned center aligned head-logo-m">
  	<?php if ($logo): ?>
         <a class="logo" href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>">
           <img src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>" />
         </a>
     <?php endif; ?>
     </div>

		<div class="two wide mobile two wide tablet two wide computer column middle aligned center aligned menuaut head-hamburger">
	   		<i id="popuper" title="<?php print t('Show menu');?>" class="icon sidebar link material-icons reorder trans"></i>
	   	</div>

   	<div class="two wide mobile two wide tablet two wide computer column middle aligned right aligned head-map">
   	  <?php if ( isset($map_link) ) : ?><a href="<?php print $map_link;?>"><?php endif; ?><?php if ( $page['header_first'] ) print render($page['header_first']); ?></a>
   	</div>

	<div class="five wide mobile three wide tablet three wide computer column middle aligned left aligned head-heute">
		<?php if ( $page['header_first'] ) print render($page['header_first']); ?>
   	</div>

	<div class="ham-ham1">
		<div class="mobile only language">
		<?php if ( module_exists('language_switcher') ){
	   		$legendblock = module_invoke('locale','block_view','language');
				print render($legendblock['content']);
	   	}?>

		</div>
	</div>
   	<div class="four wide tablet four wide column middle aligned right aligned computer only head-suche">
   	<?php if ( module_exists('language_switcher') ){
   		$legendblock = module_invoke('locale','block_view','language');
			print render($legendblock['content']);
   	}?>
		<?php if ( $page['header_second'] ) print render($page['header_second']); ?>
   	</div>

   </div>
  	 <?php print render($page['header']); ?>
</header>

<?php if (isset($primary_links)) : ?>
  <?php print $primary_links ; ?>
<?php endif; ?>

  <div class="ui container scroll" id="content">
	<?php if ( $page['sidebar']) : ?>
		<div class="ui internally stackable grid page-grid">
  			<div class="row">
    			<div class="ten wide column">
					<?php print $messages; ?>
    				<?php print render($page['content']); ?>
    			</div>
    			<div class="six wide column">
      		 		<?php print render($page['sidebar']); ?>
    		 	</div>
    		</div>
		</div>
	<?php else: ?>
		<div class="ui internally stackable grid page-grid">
  			<div class="row">
    			<div class="sixteen wide column">
					<?php print $messages; ?>
      		 		<?php print render($page['content']); ?>
    		 	</div>
    		</div>
		</div>
	 <?php endif;;?>
  </div>
  <div class="test">&nbsp;</div>
<footer class="footer-wrapper ui container"><?php print render($page['footer']); ?></footer>

<!-- <div class="helper-breadkpoints">
	<div class="smartphone only"><span></span></div>
	<div class="tablet only"><span></span></div>
	<div class="desktop only"><span></span></div>
	<div class="wide only"><span></span></div>
</div>
-->
